<?php get_header(); ?>

<div class="wrapper section-inner">
			
	<div class="content">				
																							                    
		<?php if ( have_posts() ) : ?>
		
			<?php $paged = get_query_var( 'paged' ) ?: 1;
			
			if ( 1 < $paged ) : ?>
			
				<div class="page-title">
					
					<h4><?php _e( 'Archive', 'rowling' ); ?></h4>
				
					<p><?php echo __( 'Page', 'rowling' ) . ' ' . $paged . '<span class="sep">/</span>' . $wp_query->max_num_pages; ?></p>
					
					<div class="clear"></div>
					
				</div><!-- .page-title -->
							
			<?php endif; ?>
		
			<div class="posts" id="posts">
					
				<?php 
				while ( have_posts() ) : the_post(); 
		    	
		    		get_template_part( 'content', get_post_format() );
		    			        		            
				endwhile; 
				?>
	        	                    			
			</div><!-- .posts -->
		
			<?php 
			
			rowling_archive_navigation();
		
		endif; 
		
		?>
		
	</div><!-- .content -->
	
	<?php get_sidebar(); ?>
	
	<div class="clear"></div>
	
</div><!-- .wrapper.section-inner -->
	              	        
<?php get_footer(); ?>