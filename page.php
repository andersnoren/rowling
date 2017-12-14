<?php get_header(); ?>

<div class="wrapper section-inner">
	
	<div class="content">
												        
		<?php if ( have_posts() ) : while( have_posts() ) : the_post(); ?>
			
			<div id="post-<?php the_ID(); ?>" <?php post_class( 'post single single-post' ); ?>>
			
				<div class="post-header">
					
					<?php the_title( '<h1 class="post-title">', '</h1>' ); ?>
				    	    
				</div><!-- .post-header -->
				
				<?php if ( has_post_thumbnail() ) : ?>
		
					<div class="post-image">
							
						<?php the_post_thumbnail( 'post-image' ); ?>
						
						<?php if ( ! empty( get_post( get_post_thumbnail_id() )->post_excerpt ) ) : ?>
						
							<p class="post-image-caption"><span class="fa fw fa-camera"></span><?php echo get_post( get_post_thumbnail_id() )->post_excerpt; ?></p>
														
						<?php endif; ?>
						
					</div><!-- .post-image -->
						
				<?php endif; ?>
				
				<div class="post-inner">
				
					<div class="post-content">
					
						<?php 
						
						the_content();
						
						edit_post_link(__( 'Edit', 'rowling' ), '<p class="page-edit-link"><span class="fa fw fa-wrench"></span>', '</p>' ); 
						
						?>
					
					</div><!-- .post-content -->
					
					<div class="clear"></div>
					
				</div><!-- .post-inner -->
														
				<?php comments_template( '', true ); ?>
			
			</div><!-- .post -->
										                        
		<?php 
		endwhile; 
		else: ?>
	
			<p><?php _e( "We couldn't find any posts that matched your query. Please try again.", "rowling" ); ?></p>
		
		<?php endif; ?>    
	
	</div><!-- .content -->
	
	<?php get_sidebar(); ?>
	
	<div class="clear"></div>
	
</div><!-- .wrapper.section-inner -->
								
<?php get_footer(); ?>