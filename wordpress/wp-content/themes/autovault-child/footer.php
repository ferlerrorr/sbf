<?php if ( get_page_template_slug() !== 'elementor_header_footer' ) : ?>
        </div><!-- .content -->
    </div><!-- .container -->
</div><!-- .main-contain -->
<?php endif; ?>

<footer>
    <div class="footer-bottom">
        <div class="container">
            <p><?php echo esc_html( '&copy;' ); ?> <?php echo date( 'Y' ); ?>. <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" aria-label="All rights reserved."><?php bloginfo( 'name' ); ?></a></p>
        </div>
    </div>
</footer>
</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>
