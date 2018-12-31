<?php get_header(); ?>

<div class="wrapper section-inner">
			
	<div class="content">

		<?php

		$archive_title = '';
		$archive_subtitle = '';

		$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

		if ( 1 < $paged || is_archive() || is_search() ) {

			if ( is_archive() ) {
				$archive_title = get_the_archive_title();
			} elseif ( is_search() ) {
				$archive_title = sprintf( __( 'Search results: "%s"', 'rowling' ), get_search_query() );
			} else {
				$archive_title = __( 'Archive', 'rowling' );
			}

			$archive_subtitle = __( 'Page', 'rowling' ) . ' ' . $paged . '<span class="sep">/</span>' . $wp_query->max_num_pages;

		}
			
		if ( $archive_title || $archive_subtitle ) : ?>
		
			<div class="page-title">

				<?php if ( $archive_title ) : ?>
				
					<h4><?php echo $archive_title; ?></h4>

				<?php endif; ?>
				
				<?php if ( $archive_subtitle ) : ?>
			
					<p><?php echo $archive_subtitle; ?></p>

				<?php endif; ?>
				
				<div class="clear"></div>
				
			</div><!-- .page-title -->
						
		<?php endif; ?>
																							                    
		<?php if ( have_posts() ) : ?>
		
			<div class="posts" id="posts">
					
				<?php 
				while ( have_posts() ) : the_post(); 
		    	
		    		get_template_part( 'content', get_post_format() );
		    			        		            
				endwhile; 
				?>
	        	                    			
			</div><!-- .posts -->
		
			<?php
			
			rowling_archive_navigation();
		
		elseif ( is_search() ) : 

			?>

			<div class="post single single-post">
			
				<div class="post-inner">
			
					<div class="post-content">
					
						<p><?php _e( 'No results. Try again, would you kindly?', 'rowling' ); ?></p>
						
						<?php get_search_form(); ?>
					
					</div><!-- .post-content -->
				
				</div><!-- .post-inner -->
				
				<div class="clear"></div>
			
			</div><!-- .post -->

			<?php
		endif; 
		?>
		
	</div><!-- .content -->
	
	<?php get_sidebar(); ?>
	
	<div class="clear"></div>
	
</div><!-- .wrapper.section-inner -->
	              	        
<?php get_footer(); ?>