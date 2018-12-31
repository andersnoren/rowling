<div id="post-<?php the_ID(); ?>" <?php post_class( 'post' ); ?>>

	<?php $post_format = get_post_format() ? get_post_format() : 'standard'; ?>

	<?php if ( has_post_thumbnail() || $post_format == 'gallery' ) : ?>
	
		<div class="post-image">
			
			<?php if ( is_sticky() ) : ?>
				<a class="sticky-tag" title="<?php echo __( 'Sticky post:', 'rowling' ) . ' ' . the_title_attribute( array( 'echo' => false ) ); ?>" href="<?php the_permalink(); ?>">
					<span class="fa fw fa-star"></span>
				</a>
			<?php endif; ?>

			<?php if ( $post_format == 'gallery' ) : ?>

				<?php rowling_flexslider( 'post-image-thumb' ); ?>

			<?php elseif ( has_post_thumbnail() ) : ?>
		
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail( 'post-image-thumb' ); ?>
				</a>

			<?php endif; ?>
			
		</div><!-- .post-image -->
			
	<?php endif; ?>
	
	<div class="post-header">
							
		<?php if ( has_category() ) : ?>
			<p class="post-categories"><?php the_category( ', ' ); ?></p>
		<?php endif; ?>
		
		<?php if ( get_the_title() ) : ?>
			
		    <h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		    
		<?php endif; ?>
		
		<p class="post-meta">
			<a href="<?php the_permalink(); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a> 
			<?php 
				if ( comments_open() ) {
					echo " &mdash; ";
					comments_popup_link( __( '0 Comments', 'rowling' ), __( '1 Comment', 'rowling' ), __( '% Comments' , 'rowling' ) );
				} 
			?>
		</p>
		
	</div><!-- .post-header -->
						
</div><!-- .post -->