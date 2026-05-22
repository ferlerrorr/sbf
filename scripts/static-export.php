<?php
/**
 * Run Simply Static synchronously from WP-CLI.
 *
 * Usage (from project root):
 *   docker compose exec -T --user www-data wordpress wp eval-file \
 *     /var/www/html/wp-content/uploads/static-export.php
 *
 * Or via the wrapper: scripts/build-static.sh
 */

use Simply_Static\Archive_Creation_Job;
use Simply_Static\Options;
use Simply_Static\Plugin;
use Simply_Static\Util;

if ( ! defined( 'ABSPATH' ) ) {
	fwrite( STDERR, "Must be run via wp eval-file.\n" );
	exit( 1 );
}

if ( ! class_exists( '\\Simply_Static\\Plugin' ) ) {
	fwrite( STDERR, "Simply Static plugin not loaded.\n" );
	exit( 1 );
}

$plugin  = Plugin::instance();
$options = Options::instance();
$job     = $plugin->get_archive_creation_job();

if ( $job->is_running() ) {
	fwrite( STDOUT, "Cancelling stale in-flight job...\n" );
	$job->cancel();
	sleep( 1 );
}

$task_list = apply_filters(
	'simplystatic.archive_creation_job.task_list',
	array(),
	$options->get( 'delivery_method' )
);

if ( empty( $task_list ) ) {
	fwrite( STDERR, "Empty task list — Simply Static not initialised properly.\n" );
	exit( 1 );
}

fwrite( STDOUT, "Task pipeline: " . implode( ' → ', $task_list ) . "\n" );

$blog_id      = get_current_blog_id();
$archive_name = join( '-', array( Plugin::SLUG, $blog_id, time() ) );

$options
	->set( 'archive_name', $archive_name )
	->set( 'archive_status_messages', array() )
	->set( 'archive_start_time', Util::formatted_datetime() )
	->set( 'archive_end_time', null )
	->set( 'generate_type', 'export' )
	->save();

Util::clear_debug_log();
Util::clear_transients();

do_action( 'ss_before_static_export', $blog_id, 'export' );
do_action( 'ss_archive_creation_job_before_start', $blog_id, $job );
do_action( 'ss_archive_creation_job_before_start_queue', $blog_id, $job );

$reflection           = new ReflectionClass( $job );
$set_current_task     = $reflection->getMethod( 'set_current_task' );
$set_current_task->setAccessible( true );
$set_current_site_id  = $reflection->getMethod( 'set_current_site_id' );
$set_current_site_id->setAccessible( true );
$set_current_site_id->invoke( $job, $blog_id );

$max_iterations = 5000;
$iteration      = 0;

foreach ( $task_list as $task_name ) {
	fwrite( STDOUT, "\n=== Task: {$task_name} ===\n" );
	$set_current_task->invoke( $job, $task_name );

	$class_name = '\\Simply_Static\\' . ucwords( $task_name ) . '_Task';
	$class_name = apply_filters( 'simply_static_class_name', $class_name, $task_name );

	if ( ! class_exists( $class_name ) ) {
		fwrite( STDERR, "Task class missing: {$class_name}\n" );
		exit( 1 );
	}

	$task = new $class_name();

	$done = false;
	while ( ! $done && $iteration < $max_iterations ) {
		$iteration++;
		try {
			$result = $task->perform();
		} catch ( \Throwable $e ) {
			fwrite( STDERR, "Task {$task_name} threw: " . $e->getMessage() . "\n" );
			fwrite( STDERR, $e->getTraceAsString() . "\n" );
			exit( 1 );
		}

		if ( true === $result ) {
			$done = true;
		} elseif ( false === $result ) {
			// Task wants to be called again on next iteration.
			fwrite( STDOUT, "  ... continuing {$task_name} (iter {$iteration})\n" );
			continue;
		} else {
			// Some tasks may return WP_Error or other; treat non-true as needing another pass.
			if ( is_wp_error( $result ) ) {
				fwrite( STDERR, "Task {$task_name} returned error: " . $result->get_error_message() . "\n" );
				exit( 1 );
			}
			fwrite( STDOUT, "  ... result: " . var_export( $result, true ) . "\n" );
			$done = true;
		}
	}

	if ( ! $done ) {
		fwrite( STDERR, "Task {$task_name} did not complete within {$max_iterations} iterations.\n" );
		exit( 1 );
	}
}

$options->set( 'archive_end_time', Util::formatted_datetime() )->save();

do_action( 'ss_after_static_export', $blog_id, 'export' );

$local_dir = $options->get( 'local_dir' );
fwrite( STDOUT, "\nDone. Static files written under: {$local_dir}\n" );
fwrite( STDOUT, "Archive name: {$archive_name}\n" );
