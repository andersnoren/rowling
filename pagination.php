<?php

global $wp_query;

if ( $wp_query->max_num_pages > 1 ) : ?>
			
	<div class="archive-nav">
			
		<?php 
		if ( get_previous_posts_link() ) echo '<li class="archive-nav-newer">' . get_previous_posts_link( '&larr; ' . __( 'Previous', 'rowling' ) ) . '</li>';

		$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
		$max   = intval( $wp_query->max_num_pages );
	
		// Add current page to the array
		if ( $paged >= 1 ) {
			$links[] = $paged;
		}
	
		// Add the pages around the current page to the array
		if ( $paged >= 3 ) {
			$links[] = $paged - 1;
			$links[] = $paged - 2;
		}
	
		if ( ( $paged + 2 ) <= $max ) {
			$links[] = $paged + 2;
			$links[] = $paged + 1;
		}
	
		// Link to first page, plus ellipses if necessary
		if ( ! in_array( 1, $links ) ) {
			$class = 1 == $paged ? ' active' : '';
	
			printf( '<li class="number%s"><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );
	
			if ( ! in_array( 2, $links ) ) {
				echo '<li>...</li>';
			}
		}
	
		// Link to current page, plus 2 pages in either direction if necessary
		sort( $links );
		foreach ( (array) $links as $link ) {
			$class = $paged == $link ? ' active' : '';
			printf( '<li class="number%s"><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
		}
	
		// Link to last page, plus ellipses if necessary
		if ( ! in_array( $max, $links ) ) {
			if ( ! in_array( $max - 1, $links ) )
				echo '<li class="number">...</li>' . "\n";
	
			$class = $paged == $max ? ' active' : '';
			printf( '<li class="number%s"><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
		}
					
		if ( get_next_posts_link() ) echo '<li class="archive-nav-older">' . get_next_posts_link( __( 'Next', 'rowling' ) . ' &rarr;' ) . '</li>'; 
		?>
		
		<div class="clear"></div>
					
	</div><!-- .archive-nav -->
					
<?php endif;