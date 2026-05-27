<?php if ( get_page_template_slug() !== 'elementor_header_footer' && ! is_front_page() ) : ?>
        </div><!-- #content -->
    </div><!-- .container -->
</div><!-- .main-contain -->
<?php endif; ?>

<footer class="sfg-footer">
  <div class="f-top">
    <div>
      <a class="f-logo" href="<?php echo esc_url( home_url('/') ); ?>">
        <span class="l-top">Silsbee</span>
        <div class="l-main"><span class="l-fleet">FLEET&nbsp;</span><span class="l-group">GROUP</span></div>
      </a>
      <p class="f-tagline">Silsbee Fleet Group &middot; Silsbee, TX &middot; Government fleet procurement since 1996.</p>
      <div class="f-contact"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg><span>1211 US HWY 96 N, Silsbee, TX 77656</span></div>
      <div class="f-contact"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.1 10.81 19.79 19.79 0 01.03 2.14 2 2 0 012 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.91 7.91a16 16 0 006.72 6.72l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg><a href="tel:8004642749">800.464.2749</a></div>
      <div class="f-contact"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg><a href="mailto:info@silsbeefleet.com">info@silsbeefleet.com</a></div>
      <div class="f-social">
        <a class="f-sl" href="#" aria-label="Facebook"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/></svg></a>
        <a class="f-sl" href="#" aria-label="LinkedIn"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"/><circle cx="4" cy="4" r="2"/></svg></a>
        <a class="f-sl" href="#" aria-label="Twitter/X"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"/></svg></a>
      </div>
    </div>
    <div class="f-col">
      <div class="f-col-t">Vehicles</div>
      <a href="<?php echo esc_url( get_permalink( get_page_by_path('ford-fleet') ) ); ?>">Police &amp; Law Enforcement</a>
      <a href="<?php echo esc_url( get_permalink( get_page_by_path('chevrolet-fleet') ) ); ?>">White Fleet &amp; Work Trucks</a>
      <a href="<?php echo esc_url( get_permalink( get_page_by_path('dodge-ram-fleet') ) ); ?>">Transportation</a>
      <a href="<?php echo esc_url( get_permalink( get_page_by_path('toyota-fleet') ) ); ?>">Specialty Fleet</a>
    </div>
    <div class="f-col">
      <div class="f-col-t">Services</div>
      <a href="<?php echo esc_url( get_permalink( get_page_by_path('upfitting') ) ); ?>">Upfitting &amp; Build</a>
      <a href="<?php echo esc_url( get_permalink( get_page_by_path('contracts') ) ); ?>">Contracts &amp; Procurement</a>
      <a href="<?php echo esc_url( get_permalink( get_page_by_path('dealers') ) ); ?>">Affiliated Dealers</a>
      <a href="<?php echo esc_url( get_permalink( get_page_by_path('quote') ) ); ?>">Request a Quote</a>
    </div>
    <div class="f-col">
      <div class="f-col-t">Contracts</div>
      <a href="<?php echo esc_url( get_permalink( get_page_by_path('contracts') ) ); ?>">HGAC</a>
      <a href="<?php echo esc_url( get_permalink( get_page_by_path('contracts') ) ); ?>">TxSmartBuy</a>
      <a href="<?php echo esc_url( get_permalink( get_page_by_path('contracts') ) ); ?>">BuyBoard</a>
      <a href="<?php echo esc_url( get_permalink( get_page_by_path('contracts') ) ); ?>">GoodBuy</a>
      <a href="<?php echo esc_url( get_permalink( get_page_by_path('contracts') ) ); ?>">TIPS</a>
    </div>
  </div>
  <div class="f-bottom">
    <p>&copy; <?php echo date('Y'); ?> Silsbee Fleet Group. All rights reserved.</p>
    <div class="f-bottom-r">
      <a href="<?php echo esc_url( get_permalink( get_page_by_path('privacy-policy') ) ); ?>">Privacy Policy</a>
      <a href="<?php echo esc_url( get_permalink( get_page_by_path('contact') ) ); ?>">Contact</a>
      <a href="<?php echo esc_url( home_url('/sitemap.xml') ); ?>">Sitemap</a>
    </div>
  </div>
</footer>

</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>
