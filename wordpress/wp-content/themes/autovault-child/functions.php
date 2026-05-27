<?php
/*** Child Theme Function  ***/
function autovault_enqueue_child_theme_styles() {
    wp_enqueue_style( 'autovault-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', [ 'autovault-style' ] );
}
add_action( 'wp_enqueue_scripts', 'autovault_enqueue_child_theme_styles' );

// SFG global typography & component overrides
function sfg_enqueue_overrides() {
    wp_enqueue_style( 'sfg-overrides', get_stylesheet_directory_uri() . '/elementor-overrides.css', [], '10.2' );
}
add_action( 'wp_enqueue_scripts', 'sfg_enqueue_overrides' );

// Sitewide contract-bar styles (cbar renders on every page via wp_body_open + get_footer)
function sfg_enqueue_cbar() {
    wp_enqueue_style( 'sfg-cbar', get_stylesheet_directory_uri() . '/sfg-cbar.css', [], '1.1' );
}
add_action( 'wp_enqueue_scripts', 'sfg_enqueue_cbar' );

// Render the Active Contracts trust strip. Single source of truth — called from
// get_footer (sitewide above footer), front-page.php (homepage hero-bottom),
// and the_content filter (P09 page-content top).
// Each item looks for /wp-content/uploads/contracts/{slug}.{svg,png} and renders
// the logo if present, falling back to the text name otherwise.
function sfg_render_cbar() {
    $contracts_url = '';
    $page = get_page_by_path( 'contracts' );
    if ( $page ) {
        $contracts_url = get_permalink( $page );
    }
    $items = [
        [ 'slug' => 'hgacbuy',        'name' => 'HGAC',           'note' => 'Since 1997' ],
        [ 'slug' => 'txsmartbuy',     'name' => 'TxSmartBuy',     'note' => 'State of Texas' ],
        [ 'slug' => 'buyboard',       'name' => 'BuyBoard',       'note' => 'Since 2002' ],
        [ 'slug' => 'goodbuy',        'name' => 'GoodBuy',        'note' => 'Region II ESC' ],
        [ 'slug' => 'tips',           'name' => 'TIPS',           'note' => 'National' ],
        [ 'slug' => 'tarrant-county', 'name' => 'Tarrant County', 'note' => 'Tarrant Co., TX' ],
    ];
    $uploads_dir = wp_upload_dir();
    $base_path   = trailingslashit( $uploads_dir['basedir'] ) . 'contracts/';
    $base_url    = trailingslashit( $uploads_dir['baseurl'] ) . 'contracts/';
    ob_start();
    ?>
    <div class="cbar" id="contracts">
      <div class="cbar-label">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 12l2 2 4-4"/><rect x="3" y="3" width="18" height="18" rx="2"/></svg>
        <span>Active Contracts</span>
      </div>
      <div class="cbar-items">
        <?php foreach ( $items as $item ) :
            $logo_url = '';
            foreach ( [ 'svg', 'png', 'webp', 'jpg', 'jpeg' ] as $ext ) {
                if ( file_exists( $base_path . $item['slug'] . '.' . $ext ) ) {
                    $logo_url = $base_url . $item['slug'] . '.' . $ext;
                    break;
                }
            }
        ?>
          <a class="cbar-item" href="<?php echo esc_url( $contracts_url ); ?>">
            <?php if ( $logo_url ) : ?>
              <img class="ci-logo" src="<?php echo esc_url( $logo_url ); ?>" alt="<?php echo esc_attr( $item['name'] ); ?>" loading="lazy" />
            <?php else : ?>
              <div class="ci-name"><?php echo esc_html( $item['name'] ); ?></div>
            <?php endif; ?>
            <div class="ci-note"><?php echo esc_html( $item['note'] ); ?></div>
          </a>
        <?php endforeach; ?>
      </div>
    </div>
    <?php
    return ob_get_clean();
}

// Sitewide above-footer: get_footer fires when footer.php is loaded.
// Homepage already renders its own cbar inline.
function sfg_cbar_before_footer() {
    if ( is_front_page() ) { return; }
    echo sfg_render_cbar();
}
add_action( 'get_footer', 'sfg_cbar_before_footer' );


// Header transparent → solid on scroll
function sfg_enqueue_header_scroll() {
    wp_enqueue_script( 'sfg-header-scroll', get_stylesheet_directory_uri() . '/sfg-header-scroll.js', [], '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'sfg_enqueue_header_scroll' );

// Jarallax parallax library + SFG init
function sfg_enqueue_parallax() {
    wp_enqueue_script( 'sfg-jarallax', get_stylesheet_directory_uri() . '/jarallax.min.js', [], '2.2.1', true );
    wp_enqueue_script( 'sfg-parallax-init', get_stylesheet_directory_uri() . '/sfg-parallax.js', [ 'sfg-jarallax' ], '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'sfg_enqueue_parallax' );

// Homepage-specific assets
function sfg_enqueue_homepage_assets() {
    if ( ! is_front_page() ) {
        return;
    }
    wp_enqueue_style(
        'sfg-inter',
        'https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700;800&display=swap',
        [],
        null
    );
    wp_enqueue_style(
        'sfg-home',
        get_stylesheet_directory_uri() . '/sfg-home.css',
        [ 'sfg-inter' ],
        '1.0'
    );
    wp_enqueue_script(
        'sfg-home-js',
        get_stylesheet_directory_uri() . '/sfg-home.js',
        [],
        '1.0',
        true
    );
}
add_action( 'wp_enqueue_scripts', 'sfg_enqueue_homepage_assets' );

// Request a Quote button — output last in <head> so nothing overrides it.
// NOTE: uses .menu-item-6593 (class) not #menu-item-6593 (id) because the menu
// is rendered twice (off-canvas + main nav) and only the first render keeps the id.
function sfg_quote_button_late_css() {
    echo '<style id="sfg-quote-btn">
/* Force the nav chain to full width so margin-left:auto can push the button to the row edge.
   Parent theme caps .menu-area at max-width:75% — must override max-width too. */
#reactheme-header .rt-row-header,
#reactheme-header .rt-menu-responsive.menu-area,
#reactheme-header .rt-row-header nav.nav.navbar,
#reactheme-header .rt-row-header .navbar-menu,
#reactheme-header .rt-row-header .menu-sfg-primary-nav-container,
#reactheme-header .rt-row-header ul#primary-menu-main {
    width: 100% !important;
    max-width: 100% !important;
    flex: 1 1 100% !important;
}
#reactheme-header .rt-row-header nav.nav.navbar { justify-content: flex-start !important; }
#reactheme-header .navbar-menu ul#primary-menu-main > li.menu-item-6593 {
    margin-left: auto !important;
    margin-right: -6.5em !important;  /* cancel 6.5em of the 7.5em row padding — leaves 1em gap to viewport edge */
    padding: 0 !important;
    display: flex !important;
    align-items: center !important;
}
#reactheme-header .navbar-menu ul#primary-menu-main > li.menu-item-6593 > a {
    background: #CE1141 !important;
    background-color: #CE1141 !important;
    color: #ffffff !important;
    padding: 11px 26px !important;
    border-radius: 6px !important;
    font-weight: 700 !important;
    font-size: 14px !important;
    letter-spacing: 0.3px !important;
    text-shadow: none !important;
    box-shadow: none !important;
    display: inline-flex !important;
    align-items: center !important;
    line-height: 1 !important;
    transition: background .15s ease, transform .15s ease !important;
}
#reactheme-header .navbar-menu ul#primary-menu-main > li.menu-item-6593 > a:hover {
    background: #a80d34 !important;
    background-color: #a80d34 !important;
    color: #ffffff !important;
    text-shadow: none !important;
    box-shadow: none !important;
    transform: translateY(-1px) !important;
}
</style>';
}
add_action( 'wp_head', 'sfg_quote_button_late_css', 9999 );
