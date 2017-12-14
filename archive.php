<?php get_header(); ?>

<div class="wrapper section-inner">

	<div class="content">
	
		<div class="page-title">
				
			<h4>
				<?php 
				if ( is_day() ) :
					printf( __( 'Date: %s', 'rowling' ), '' . get_the_date( get_option( 'date_format' ) ) . '' );
				elseif ( is_month() ) :
					printf( __( 'Month: %s', 'rowling' ), '' . get_the_date( 'F Y' ) . '' );
				elseif ( is_year() ) :
					printf( __( 'Year: %s', 'rowling' ), '' . get_the_date( 'Y' ) . '' );
				elseif ( is_category() ) :
					printf( __( 'Category: %s', 'rowling' ), '' . single_cat_title( '', false ) . '' );
				elseif ( is_tag() ) :
					printf( __( 'Tag: %s', 'rowling' ), '' . single_tag_title( '', false ) . '' );
				elseif ( is_author() ) :
					$curauth = ( isset( $_GET['author_name'] ) ) ? get_user_by( 'slug', $author_name ) : get_userdata( intval( $author ) );
					printf( __( 'Author: %s', 'rowling' ), $curauth->display_name );
				else :
					_e( 'Archive', 'rowling' );
				endif; 
				?>
			</h4>
			
			<?php
			$paged = get_query_var( 'paged' ) ?: 1;
			
			if ( 1 < $wp_query->max_num_pages ) : ?>
			
				<p><?php _e( 'Page', 'rowling' ); echo ' ' . $paged . '<span class="sep">/</span>' . $wp_query->max_num_pages; ?></p>
				
				<div class="clear"></div>
			
			<?php endif; ?>
			
			<div class="clear"></div>
			
		</div><!-- .page-title -->
		
		<?php if ( have_posts() ) : ?>
				
			<div class="posts" id="posts">
				
				<?php 
				while ( have_posts() ) : the_post();
							
					get_template_part( 'content', get_post_format() );
					
				endwhile; 
				?>
								
			</div><!-- .posts -->
			
			<?php rowling_archive_navigation(); ?>
					
		<?php endif; ?>
	
	</div><!-- .content -->
	
	<?php get_sidebar(); ?>
	
	<div class="clear"></div>

</div><!-- .wrapper.section-inner -->

<?php get_footer(); ?>