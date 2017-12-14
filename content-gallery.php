<div id="post-<?php the_ID(); ?>" <?php post_class( 'post' ); ?>>

	<div class="post-image">
	
		<?php rowling_flexslider( 'post-image-thumb' ); ?>
		
		<?php if ( is_sticky() ) : ?>
			<a class="sticky-tag" title="<?php echo __( 'Sticky post:', 'rowling' ) . ' ' . the_title_attribute( array( 'echo' => false ) ); ?>" href="<?php the_permalink(); ?>">
				<span class="fa fw fa-star"></span>
			</a>
		<?php endif; ?>
		
	</div><!-- .post-image -->
	
	<div class="post-header">
							
		<?php if ( has_category() ) : ?>
			<p class="post-categories"><?php the_category( ', ' ); ?></p>
		<?php endif; ?>
		
		<?php if ( get_the_title() ) : ?>
			
		    <h2 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
		    
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