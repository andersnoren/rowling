<div class="credits">
			
	<div class="section-inner">
		
		<a href="#" class="to-the-top" title="<?php _e( 'To the top', 'rowling' ); ?>">
            <div class="fa fw fa-angle-up"></div>
        </a>
		
		<p class="copyright">&copy; <?php echo date( 'Y' ); ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'title' ) ); ?> &mdash; <?php echo esc_attr( get_bloginfo( 'description' ) ); ?>" rel="home"><?php echo esc_attr( get_bloginfo( 'title' ) ); ?></a></p>
		
		<p class="attribution"><?php printf( __( 'Theme by %s', 'rowling' ), '<a href="http://www.andersnoren.se">Anders Nor&eacute;n</a>' ); ?></p>
		
	</div><!-- .section-inner -->
	
</div><!-- .credits -->

<?php wp_footer(); ?>

</body>
</html>