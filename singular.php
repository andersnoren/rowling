<?php get_header(); ?>

<div class="wrapper section-inner">
	
	<div class="content">
												        
		<?php 
		
		if ( have_posts() ) : 
			
			while ( have_posts() ) : the_post(); 

				$author_id = get_the_author_meta( 'ID' );
				$author_posts_url = get_author_posts_url( $author_id );
			
				?>
		
				<div id="post-<?php the_ID(); ?>" <?php post_class( 'single single-post' ); ?>>
					
					<div class="post-header">
											
						<?php if ( is_single() && has_category() ) : ?>
							<p class="post-categories"><?php the_category( ', ' ); ?></p>
							<?php 
						endif;
						
						the_title( '<h1 class="post-title">', '</h1>' );
						
						if ( is_single() ) : ?>
						
							<div class="post-meta">

								<span class="resp"><?php _e( 'Posted', 'rowling' ); ?></span> <span class="post-meta-author"><?php _e( 'by', 'rowling' ); ?> <a href="<?php echo $author_posts_url; ?>"><?php the_author_meta( 'display_name' ); ?></a></span> <span class="post-meta-date"><?php _e( 'on', 'rowling' ); ?> <a href="<?php the_permalink(); ?>"><?php the_time(get_option( 'date_format' ) ); ?></a></span> <?php edit_post_link(__( 'Edit', 'rowling' ), ' &mdash; ' ); ?>

								<?php if ( comments_open() ) : ?>
									<span class="post-comments">
										<?php 
											comments_popup_link(
												'<span class="fa fw fa-comment"></span>0<span class="resp"> ' . __( 'Comments', 'rowling' ) . '</span>', 
												'<span class="fa fw fa-comment"></span>1<span class="resp"> ' . __( 'Comment', 'rowling' ) . '</span>', 
												'<span class="fa fw fa-comment"></span>%<span class="resp"> ' . __( 'Comments', 'rowling' ) . '</span>'
											); 
										?>
									</span>
								<?php endif; ?>

							</div><!-- .post-meta -->

						<?php endif; ?>
						
					</div><!-- .post-header -->
					
					<?php 

					$post_format = get_post_format() ? get_post_format() : 'standard';

					if ( $post_format == 'gallery' ) :
					
						rowling_flexslider( 'post-image' );
						
					elseif ( has_post_thumbnail() ) : ?>
			
						<div class="post-image">
								
							<?php 
								
							the_post_thumbnail( 'post-image' );

							$image_caption = get_post( get_post_thumbnail_id() )->post_excerpt;
							
							if ( $image_caption ) : ?>
							
								<p class="post-image-caption"><span class="fa fw fa-camera"></span><?php echo $image_caption; ?></p>

							<?php endif; ?>
							
						</div><!-- .post-image -->
							
					<?php endif; ?>
					
					<div class="clear"></div>

					<?php 
					
					if ( is_single() ) {
						rowling_related_posts();
					}

					?>
							
					<div class="post-inner">
		
						<div class="post-content">
						
							<?php the_content(); ?>
							
							<?php 
								$args = array(
									'before'           => '<div class="clear"></div><p class="page-links"><span class="title">' . __( 'Pages:', 'rowling' ) . '</span>',
									'after'            => '</p>',
									'link_before'      => '<span>',
									'link_after'       => '</span>',
									'separator'        => '',
									'pagelink'         => '%',
									'echo'             => 1
								);
							
								wp_link_pages( $args ); 
							?>
						
						</div>
						
						<div class="clear"></div>

						<?php if ( is_single() ) : ?>

							<?php the_tags( '<div class="post-tags">', '', '</div>' ); ?>
							
							<div class="post-author">
								
								<a class="avatar" href="<?php echo $author_posts_url; ?>">
									<?php echo get_avatar( $author_id, 100 ); ?>
								</a>
								
								<h4 class="title"><a href="<?php echo $author_posts_url; ?>"><?php the_author_meta( 'display_name' ); ?></a></h4>
								
								<?php echo wpautop( get_the_author_meta( 'description' ) ); ?>

							</div><!-- .post-author -->

							<?php rowling_related_posts(); ?>
						
						<?php endif; ?>
										
					</div><!-- .post-inner -->
					
					<div class="clear"></div>
					
				</div><!-- .post -->
				
				<?php 
				
				comments_template( '', true );
			
			endwhile; 
	
		endif; 
		
		?>
	
	</div><!-- .content -->
	
	<?php get_sidebar(); ?>
	
	<div class="clear"></div>
	
</div><!-- .wrapper -->
		
<?php get_footer(); ?>