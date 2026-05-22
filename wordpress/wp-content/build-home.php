<?php
/**
 * Rebuild SFG Home page (ID 6) with parallax sections.
 * Usage: wp eval-file /var/www/html/wp-content/build-home.php --allow-root
 *
 * KEY: Always call wp_slash() on json_encode() output before update_post_meta().
 * WordPress's update_post_meta() runs wp_unslash() internally, stripping the
 * backslash-escapes that json_encode() adds around embedded double-quotes in
 * HTML attribute values (e.g. style="..."). wp_slash() pre-doubles them so the
 * final stored value is valid JSON.
 */

$hero_url  = 'http://localhost:8080/wp-content/uploads/2026/05/hero-fleet.jpg';
$about_url = 'http://localhost:8080/wp-content/uploads/2026/05/about-fleet.jpg';
$truck_url = 'http://localhost:8080/wp-content/uploads/2026/05/ford-truck.jpg';

$hero_img  = [ 'id' => 6595, 'url' => $hero_url ];
$about_img = [ 'id' => 6597, 'url' => $about_url ];

function sfg_uid() { return substr( md5( uniqid( '', true ) ), 0, 8 ); }

/* ── Section scaffold helpers ─────────────────────────────────────────────── */

function sfg_section( $settings, $columns ) {
    return [
        'id'       => sfg_uid(),
        'elType'   => 'section',
        'isInner'  => false,
        'settings' => $settings,
        'elements' => $columns,
    ];
}

function sfg_col( $size, $widgets ) {
    return [
        'id'       => sfg_uid(),
        'elType'   => 'column',
        'settings' => [ '_column_size' => $size ],
        'elements' => $widgets,
    ];
}

function sfg_inner( $settings, $columns ) {
    return [
        'id'       => sfg_uid(),
        'elType'   => 'section',
        'isInner'  => true,
        'settings' => $settings,
        'elements' => $columns,
    ];
}

function sfg_widget( $type, $settings ) {
    return [
        'id'         => sfg_uid(),
        'elType'     => 'widget',
        'widgetType' => $type,
        'settings'   => $settings,
        'elements'   => [],
    ];
}

function sfg_spacer( $px ) {
    return sfg_widget( 'spacer', [ 'space' => [ 'unit' => 'px', 'size' => $px ] ] );
}

/* ── Base section settings ────────────────────────────────────────────────── */

function sfg_bg_section( $color, $pad_top = 70, $pad_bottom = 70, $extra = [] ) {
    return array_merge( [
        'background_background' => 'classic',
        'background_color'      => $color,
        'layout'         => 'full_width',
        'content_width'  => [ 'unit' => 'px', 'size' => 1100 ],
        'padding' => [ 'unit' => 'px', 'top' => (string) $pad_top, 'right' => '20', 'bottom' => (string) $pad_bottom, 'left' => '20', 'isLinked' => false ],
    ], $extra );
}

function sfg_img_section( $img, $overlay_color, $pad_top = 80, $pad_bottom = 80, $extra = [] ) {
    return array_merge( [
        'background_background'         => 'classic',
        'background_image'              => $img,
        'background_position'           => 'center center',
        'background_repeat'             => 'no-repeat',
        'background_size'               => 'cover',
        'background_overlay_background' => 'classic',
        'background_overlay_color'      => $overlay_color,
        'layout'         => 'full_width',
        'content_width'  => [ 'unit' => 'px', 'size' => 1100 ],
        'content_position' => 'middle',
        'padding' => [ 'unit' => 'px', 'top' => (string) $pad_top, 'right' => '20', 'bottom' => (string) $pad_bottom, 'left' => '20', 'isLinked' => false ],
    ], $extra );
}

/* ════════════════════════════════════════════════════════════════════════════
   SECTION 1 — HERO (parallax, full-height)
   ════════════════════════════════════════════════════════════════════════════ */

$hero_settings = sfg_img_section( $hero_img, 'rgba(0,17,38,0.72)', 110, 110, [
    'min_height'       => [ 'unit' => 'vh', 'size' => 88 ],
    'css_classes'      => 'sfg-parallax',
] );

$hero = sfg_section( $hero_settings, [
    sfg_col( 100, [
        sfg_widget( 'heading', [
            'title'       => 'The Fleet Your Agency Needs — Ready to Deploy.',
            'header_size' => 'h1',
            'align'       => 'center',
            'title_color' => '#ffffff',
            'typography_typography'   => 'custom',
            'typography_font_size'    => [ 'unit' => 'px', 'size' => 52 ],
            'typography_font_size_tablet' => [ 'unit' => 'px', 'size' => 38 ],
            'typography_font_size_mobile' => [ 'unit' => 'px', 'size' => 28 ],
            'typography_font_weight'  => '800',
            'typography_line_height'  => [ 'unit' => 'em', 'size' => 1.15 ],
        ] ),
        sfg_spacer( 24 ),
        sfg_widget( 'text-editor', [
            'editor' => '<p style="color:#a8c8e8;font-size:18px;text-align:center;max-width:680px;margin:0 auto;line-height:1.75;">Silsbee Fleet Group is a Ford-certified fleet dealer serving government agencies, municipalities, and commercial fleets across Texas. HGAC &amp; state contract pricing available.</p>',
        ] ),
        sfg_spacer( 40 ),
        sfg_widget( 'button', [
            'text'             => 'Request a Quote',
            'link'             => [ 'url' => '/quote/' ],
            'align'            => 'center',
            'background_color' => '#CC1A1A',
            'button_text_color' => '#ffffff',
            'border_radius'    => [ 'unit' => 'px', 'top' => '4', 'right' => '4', 'bottom' => '4', 'left' => '4', 'isLinked' => true ],
            'size'             => 'lg',
        ] ),
    ] ),
] );

/* ════════════════════════════════════════════════════════════════════════════
   SECTION 2 — STATS STRIP
   ════════════════════════════════════════════════════════════════════════════ */

$stats_items = [
    [ '500+', 'Fleet Vehicles Delivered' ],
    [ '40+',  'Years Serving Texas' ],
    [ '12+',  'Govt Contract Vehicles' ],
    [ '3',    'States Served' ],
];

$stat_cols = [];
foreach ( $stats_items as $s ) {
    $stat_cols[] = sfg_col( 25, [
        sfg_widget( 'heading', [
            'title'       => $s[0],
            'header_size' => 'h3',
            'align'       => 'center',
            'title_color' => '#ffffff',
            'typography_typography' => 'custom',
            'typography_font_size'  => [ 'unit' => 'px', 'size' => 44 ],
            'typography_font_weight' => '800',
        ] ),
        sfg_widget( 'text-editor', [
            'editor' => '<p style="color:#8aacc4;font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:0.1em;text-align:center;margin:4px 0 0;">' . $s[1] . '</p>',
        ] ),
    ] );
}

$stats = sfg_section( sfg_bg_section( '#001528', 36, 36 ), [
    sfg_col( 100, [ sfg_inner( [], $stat_cols ) ] ),
] );

/* ════════════════════════════════════════════════════════════════════════════
   SECTION 3 — ABOUT SFG (two-column)
   ════════════════════════════════════════════════════════════════════════════ */

$about = sfg_section( sfg_bg_section( '#f7f9fc', 80, 80 ), [
    sfg_col( 100, [
        sfg_inner( [ 'gap' => 'extended', 'content_position' => 'middle' ], [
            sfg_col( 50, [
                sfg_widget( 'text-editor', [
                    'editor' => '<p style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.12em;color:#0077CC;margin:0 0 12px;">About Silsbee Fleet Group</p>',
                ] ),
                sfg_widget( 'heading', [
                    'title'       => "Texas's Trusted Government Fleet Partner",
                    'header_size' => 'h2',
                    'typography_typography' => 'custom',
                    'typography_font_size'  => [ 'unit' => 'px', 'size' => 34 ],
                    'typography_font_weight' => '700',
                ] ),
                sfg_widget( 'text-editor', [
                    'editor' => '<p>Silsbee Fleet Group has been serving government and commercial fleet customers for decades. As a Ford-certified fleet specialist, we supply law enforcement agencies, municipalities, school districts, and commercial operators with the right vehicles at competitive contract pricing.</p><p>We understand procurement. Whether you\'re purchasing through HGAC, TX SmartBuy, or a direct bid, our team guides you from spec selection to delivery.</p>',
                ] ),
                sfg_widget( 'text-editor', [
                    'editor' => '<ul style="list-style:none;padding:0;margin:16px 0 24px;display:flex;flex-direction:column;gap:10px;">
<li style="display:flex;align-items:center;gap:10px;font-size:15px;"><span style="width:20px;height:20px;background:#0077CC;border-radius:50%;display:inline-flex;align-items:center;justify-content:center;flex-shrink:0;color:#fff;font-size:11px;font-weight:700;">&#10003;</span>Ford Certified Fleet Dealer &mdash; direct factory pricing</li>
<li style="display:flex;align-items:center;gap:10px;font-size:15px;"><span style="width:20px;height:20px;background:#0077CC;border-radius:50%;display:inline-flex;align-items:center;justify-content:center;flex-shrink:0;color:#fff;font-size:11px;font-weight:700;">&#10003;</span>HGAC &amp; State Contract vehicles available</li>
<li style="display:flex;align-items:center;gap:10px;font-size:15px;"><span style="width:20px;height:20px;background:#0077CC;border-radius:50%;display:inline-flex;align-items:center;justify-content:center;flex-shrink:0;color:#fff;font-size:11px;font-weight:700;">&#10003;</span>Full upfitting &amp; build services on-site</li>
<li style="display:flex;align-items:center;gap:10px;font-size:15px;"><span style="width:20px;height:20px;background:#0077CC;border-radius:50%;display:inline-flex;align-items:center;justify-content:center;flex-shrink:0;color:#fff;font-size:11px;font-weight:700;">&#10003;</span>Serving police, fire, public works &amp; commercial fleets</li>
</ul>',
                ] ),
                sfg_widget( 'button', [
                    'text'  => 'Learn More About SFG',
                    'link'  => [ 'url' => '/about/' ],
                    'align' => 'left',
                    'background_color' => '#003B71',
                    'button_text_color' => '#ffffff',
                    'border_radius' => [ 'unit' => 'px', 'top' => '4', 'right' => '4', 'bottom' => '4', 'left' => '4', 'isLinked' => true ],
                ] ),
            ] ),
            sfg_col( 50, [
                sfg_widget( 'image', [
                    'image'      => $about_img,
                    'image_size' => 'full',
                    'width'      => [ 'unit' => '%', 'size' => 100 ],
                ] ),
            ] ),
        ] ),
    ] ),
] );

/* ════════════════════════════════════════════════════════════════════════════
   SECTION 4 — WHY CHOOSE SFG (parallax background)
   ════════════════════════════════════════════════════════════════════════════ */

$why_settings = sfg_img_section( $about_img, 'rgba(0,27,62,0.85)', 80, 80, [
    'css_classes'  => 'sfg-parallax',
] );

$why_features = [
    [ 'Contract Pricing',   'HGAC, TX SmartBuy &amp; direct-bid — compliant procurement with no RFP hassle.' ],
    [ 'Dedicated Rep',      'One point of contact from spec sheet to delivery manages everything for you.' ],
    [ 'Full Upfitting',     'Police packages, work-truck beds, emergency lighting — all done at our facility.' ],
    [ 'Texas-Based',        'Based in Silsbee, TX — local support, local accountability, fast state delivery.' ],
];

$why_cols = [];
foreach ( $why_features as $f ) {
    $why_cols[] = sfg_col( 25, [
        sfg_widget( 'text-editor', [
            'editor' => '<div style="text-align:center;padding:32px 20px;background:rgba(255,255,255,0.06);border-radius:6px;border:1px solid rgba(255,255,255,0.1);">
<div style="width:52px;height:52px;background:#0077CC;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="white"><path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z"/></svg>
</div>
<h3 style="color:#ffffff;font-size:16px;font-weight:700;margin:0 0 10px;">' . $f[0] . '</h3>
<p style="color:#8aacc4;font-size:14px;line-height:1.6;margin:0;">' . $f[1] . '</p>
</div>',
        ] ),
    ] );
}

$why = sfg_section( $why_settings, [
    sfg_col( 100, [
        sfg_widget( 'text-editor', [
            'editor' => '<p style="text-align:center;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.12em;color:#4fb3ff;margin:0 0 10px;">Why Choose Us</p>',
        ] ),
        sfg_widget( 'heading', [
            'title'       => 'Why Agencies Choose Silsbee Fleet Group',
            'header_size' => 'h2',
            'align'       => 'center',
            'title_color' => '#ffffff',
            'typography_typography' => 'custom',
            'typography_font_size'  => [ 'unit' => 'px', 'size' => 34 ],
            'typography_font_weight' => '700',
        ] ),
        sfg_spacer( 40 ),
        sfg_inner( [ 'gap' => 'extended' ], $why_cols ),
    ] ),
] );

/* ════════════════════════════════════════════════════════════════════════════
   SECTION 5 — FLEET BRANDS
   ════════════════════════════════════════════════════════════════════════════ */

$brands_data = [
    [ 'Ford',         '/brands/ford-fleet/',        '#003087' ],
    [ 'Chevrolet',    '/brands/chevrolet-fleet/',   '#CC1A1A' ],
    [ 'Dodge / Ram',  '/brands/dodge-ram-fleet/',   '#1a1a1a' ],
    [ 'Toyota',       '/brands/toyota-fleet/',      '#CC1A1A' ],
];

$brand_cols = [];
foreach ( $brands_data as $b ) {
    $brand_cols[] = sfg_col( 25, [
        sfg_widget( 'text-editor', [
            'editor' => '<div style="text-align:center;padding:32px 20px;background:#ffffff;border-radius:6px;box-shadow:0 2px 16px rgba(0,0,0,0.07);border-top:4px solid ' . $b[2] . ';">
<div style="font-size:22px;font-weight:800;color:' . $b[2] . ';letter-spacing:-0.5px;margin-bottom:8px;">' . $b[0] . '</div>
<div style="font-size:13px;color:#6b7280;margin-bottom:16px;">Fleet &amp; Commercial Vehicles</div>
<a href="' . $b[1] . '" style="font-size:13px;font-weight:600;color:' . $b[2] . ';text-decoration:none;">View Models &rarr;</a>
</div>',
        ] ),
    ] );
}

$brands = sfg_section( sfg_bg_section( '#f0f4f8', 70, 70 ), [
    sfg_col( 100, [
        sfg_widget( 'heading', [
            'title'       => 'Fleet Brands We Carry',
            'header_size' => 'h2',
            'align'       => 'center',
            'typography_typography' => 'custom',
            'typography_font_size'  => [ 'unit' => 'px', 'size' => 34 ],
            'typography_font_weight' => '700',
        ] ),
        sfg_widget( 'text-editor', [
            'editor' => '<p style="text-align:center;color:#6b7280;font-size:16px;max-width:560px;margin:8px auto 40px;">Government and commercial fleet vehicles across four trusted brands.</p>',
        ] ),
        sfg_inner( [ 'gap' => 'extended' ], $brand_cols ),
    ] ),
] );

/* ════════════════════════════════════════════════════════════════════════════
   SECTION 6 — UPFITTING CTA
   ════════════════════════════════════════════════════════════════════════════ */

$cta = sfg_section( sfg_bg_section( '#003B71', 60, 60 ), [
    sfg_col( 100, [
        sfg_inner( [ 'content_position' => 'middle' ], [
            sfg_col( 66, [
                sfg_widget( 'heading', [
                    'title'       => 'Need Custom Upfitting for Your Fleet?',
                    'header_size' => 'h2',
                    'title_color' => '#ffffff',
                    'typography_typography' => 'custom',
                    'typography_font_size'  => [ 'unit' => 'px', 'size' => 28 ],
                    'typography_font_weight' => '700',
                ] ),
                sfg_widget( 'text-editor', [
                    'editor' => '<p style="color:#a8c8e8;font-size:15px;margin:8px 0 0;">Police packages, work-truck beds, emergency lighting, vinyl graphics &mdash; spec and built at our Silsbee facility.</p>',
                ] ),
            ] ),
            sfg_col( 33, [
                sfg_widget( 'button', [
                    'text'  => 'Explore Upfitting',
                    'link'  => [ 'url' => '/upfitting/' ],
                    'align' => 'right',
                    'background_color'  => '#CC1A1A',
                    'button_text_color' => '#ffffff',
                    'border_radius'     => [ 'unit' => 'px', 'top' => '4', 'right' => '4', 'bottom' => '4', 'left' => '4', 'isLinked' => true ],
                    'size' => 'lg',
                ] ),
            ] ),
        ] ),
    ] ),
] );

/* ════════════════════════════════════════════════════════════════════════════
   SECTION 7 — FINAL QUOTE CTA (parallax)
   ════════════════════════════════════════════════════════════════════════════ */

$quote_settings = sfg_img_section( $hero_img, 'rgba(0,10,24,0.80)', 90, 90, [
    'css_classes'  => 'sfg-parallax',
    'content_width' => [ 'unit' => 'px', 'size' => 900 ],
] );

$quote_cta = sfg_section( $quote_settings, [
    sfg_col( 100, [
        sfg_widget( 'heading', [
            'title'       => 'Ready to Build Your Fleet?',
            'header_size' => 'h2',
            'align'       => 'center',
            'title_color' => '#ffffff',
            'typography_typography' => 'custom',
            'typography_font_size'  => [ 'unit' => 'px', 'size' => 40 ],
            'typography_font_weight' => '800',
        ] ),
        sfg_widget( 'text-editor', [
            'editor' => '<p style="color:#a8c8e8;font-size:17px;text-align:center;max-width:560px;margin:16px auto 0;">Get a no-obligation quote with contract pricing. Our fleet team responds within one business day.</p>',
        ] ),
        sfg_spacer( 32 ),
        sfg_widget( 'button', [
            'text'  => 'Request a Quote Today',
            'link'  => [ 'url' => '/quote/' ],
            'align' => 'center',
            'background_color'  => '#CC1A1A',
            'button_text_color' => '#ffffff',
            'border_radius'     => [ 'unit' => 'px', 'top' => '4', 'right' => '4', 'bottom' => '4', 'left' => '4', 'isLinked' => true ],
            'size'  => 'xl',
        ] ),
    ] ),
] );

/* ════════════════════════════════════════════════════════════════════════════
   SAVE
   ════════════════════════════════════════════════════════════════════════════ */

$sections = [ $hero, $stats, $about, $why, $brands, $cta, $quote_cta ];
$json     = json_encode( $sections, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

if ( json_last_error() !== JSON_ERROR_NONE ) {
    WP_CLI::error( 'JSON encode failed: ' . json_last_error_msg() );
}

// wp_slash() is required because update_post_meta() runs wp_unslash() internally,
// which would strip json_encode()'s backslash-escapes from embedded quotes.
update_post_meta( 6, '_elementor_data', wp_slash( $json ) );
update_post_meta( 6, '_elementor_edit_mode', 'builder' );
update_post_meta( 6, '_elementor_template', 'elementor_header_footer' );
update_post_meta( 6, '_wp_page_template', 'elementor_header_footer' );
delete_post_meta( 6, '_elementor_css' );

WP_CLI::success( 'Home page rebuilt. JSON length: ' . strlen( $json ) );
