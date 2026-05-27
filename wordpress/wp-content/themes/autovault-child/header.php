<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="profile" href="https://gmpg.org/xfn/11" />
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <div id="page" class="site">

        <header id="reactheme-header" class="rts-default-header sfg-header-two-row">
            <div class="sfg-header-inner">

                <!-- Logo column: left, spans full height -->
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="sfg-topbar-logo" rel="home" aria-label="<?php bloginfo( 'name' ); ?>">
                    <span class="sfg-logo-silsbee">SILSBEE</span>
                    <span class="sfg-logo-fleet"><span class="sfg-fleet-word">FLEET</span> <span class="sfg-group-word">GROUP</span></span>
                </a>

                <!-- Right column: contact row / divider / nav row -->
                <div class="sfg-header-right">

                    <!-- Top: Contact + Social -->
                    <div class="sfg-topbar-row">
                        <div class="sfg-topbar-contact">
                            <a href="tel:8004642749" class="sfg-topbar-item">
                                <span class="sfg-icon-badge">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M6.6 10.8c1.4 2.8 3.8 5.1 6.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.1.4 2.3.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1-9.4 0-17-7.6-17-17 0-.6.4-1 1-1h3.5c.6 0 1 .4 1 1 0 1.3.2 2.5.6 3.6.1.3 0 .7-.2 1L6.6 10.8z"/></svg>
                                </span>
                                <span class="sfg-item-text">
                                    <span class="sfg-item-label">Call Us</span>
                                    <span class="sfg-item-value">800.464.2749</span>
                                </span>
                            </a>
                            <a href="mailto:info@silsbeefleet.com" class="sfg-topbar-item">
                                <span class="sfg-icon-badge">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
                                </span>
                                <span class="sfg-item-text">
                                    <span class="sfg-item-label">Email Us</span>
                                    <span class="sfg-item-value">info@silsbeefleet.com</span>
                                </span>
                            </a>
                            <span class="sfg-topbar-item sfg-topbar-location">
                                <span class="sfg-icon-badge">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                                </span>
                                <span class="sfg-item-text">
                                    <span class="sfg-item-label">Location</span>
                                    <span class="sfg-item-value">Silsbee, TX</span>
                                </span>
                            </span>
                        </div>
                        <div class="sfg-topbar-right">
                            <span class="sfg-topbar-tagline">Ford Certified Fleet Specialist</span>
                            <div class="sfg-social-row">
                                <span class="sfg-social-label">Follow Us On:</span>
                                <div class="sfg-social-icons">
                                    <a href="#" class="sfg-social-icon" aria-label="Facebook" target="_blank" rel="noopener noreferrer">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                                    </a>
                                    <a href="#" class="sfg-social-icon" aria-label="LinkedIn" target="_blank" rel="noopener noreferrer">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="currentColor"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6zM2 9h4v12H2z"/><circle cx="4" cy="4" r="2"/></svg>
                                    </a>
                                    <a href="#" class="sfg-social-icon" aria-label="Twitter / X" target="_blank" rel="noopener noreferrer">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.746l7.73-8.835L2.25 2.25h6.993l4.255 5.623zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Horizontal divider (only spans the right column) -->
                    <div class="sfg-header-divider"></div>

                    <!-- Bottom: Navigation -->
                    <div class="sfg-mainnav-row">
                        <?php get_template_part( 'inc/header/off-canvas' ); ?>
                        <div class="rt-row-header">
                            <div class="rt-menu-responsive menu-area">
                                <?php require get_parent_theme_file_path( 'inc/header/menu.php' ); ?>
                                <a href="#" class="nav-menu-link menu-button" aria-label="Open Menu">
                                    <svg width="20" height="16" viewBox="0 0 20 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect y="14" width="18" height="2" fill="#ffffff"></rect>
                                        <rect y="7" width="18" height="2" fill="#ffffff"></rect>
                                        <rect width="18" height="2" fill="#ffffff"></rect>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>

                </div><!-- .sfg-header-right -->

            </div><!-- .sfg-header-inner -->
        </header>

        <?php if ( get_page_template_slug() !== 'elementor_header_footer' && ! is_front_page() ) : ?>
        <div class="main-contain">
            <div class="container">
                <div id="content">
        <?php endif; ?>
