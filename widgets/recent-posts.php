<?php 

class rowling_recent_posts extends WP_Widget {

	function __construct() {
        $widget_ops = array( 
			'classname' 	=> 'widget_rowling_recent_posts', 
			'description' 	=> __( 'Displays recent blog entries.', 'rowling' ) 
		);
        parent::__construct( 'widget_rowling_recent_posts', __( 'Recent Posts', 'rowling' ), $widget_ops );
    }
	
	function widget( $args, $instance ) {
	
		// Outputs the content of the widget
		extract( $args ); // Make before_widget, etc available.
		
		$widget_title = null; 
		$number_of_posts = null; 
		
		$widget_title = esc_attr( apply_filters( 'widget_title', $instance['widget_title'] ) );
		$number_of_posts = esc_attr( $instance['number_of_posts'] );
		
		echo $before_widget;

		if ( ! empty( $widget_title ) ) {
		
			echo $before_title . $widget_title . $after_title;
			
		} ?>
		
		<ul class="rowling-widget-list">
			
			<?php

				global $post;

				if ( $number_of_posts == 0 ) $number_of_posts = 5;

				$recent_posts = get_posts( array(
					'ignore_sticky_posts' => true,
					'post_status'         => 'publish',
					'posts_per_page'      => $number_of_posts,
				) );
				
				if ( $recent_posts ) :
					
					foreach( $recent_posts as $post ) : ?>
				
						<li>
						
							<?php setup_postdata( $post ); ?>
						
							<a href="<?php the_permalink(); ?>">
									
								<div class="post-icon">
								
									<?php 
									$post_format = get_post_format() ? get_post_format() : 'standard';

									if ( has_post_thumbnail() )
										the_post_thumbnail( 'thumbnail' );
									elseif ( $post_format == 'gallery' )									
										echo '<div class="fa fw fa-camera"></div>';
									else
										echo '<div class="fa fw fa-file-text"></div>';
									?>
									
								</div>
								
								<div class="inner">
												
									<p class="title"><?php the_title(); ?></p>
									<p class="meta"><?php the_time( get_option( 'date_format' ) ); ?></p>
								
								</div>
								
								<div class="clear"></div>
													
							</a>
							
						</li>
				
					<?php endforeach; ?>

				<?php endif; ?>
		
			</ul>
					
		<?php echo $after_widget; 
	}
	
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		
		$instance['widget_title'] = strip_tags( $new_instance['widget_title'] );
        // make sure we are getting a number
        $instance['number_of_posts'] = is_int( intval( $new_instance['number_of_posts'] ) ) ? intval( $new_instance['number_of_posts'] ): 5;
	
		//update and save the widget
		return $instance;		
	}
	
	function form( $instance ) {
		
		// Set defaults
		if ( ! isset( $instance['widget_title']) ) $instance['widget_title'] = '';
		if ( ! isset( $instance['number_of_posts']) ) $instance['number_of_posts'] = 5;
	
		// Get the options into variables, escaping html characters on the way
		$widget_title = esc_attr( $instance['widget_title'] );
		$number_of_posts = esc_attr( $instance['number_of_posts'] );
		?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'widget_title' ); ?>"><?php _e( 'Title', 'rowling' ); ?>:
			<input id="<?php echo $this->get_field_id( 'widget_title' ); ?>" name="<?php echo $this->get_field_name( 'widget_title' ); ?>" type="text" class="widefat" value="<?php echo esc_attr( $widget_title ); ?>" /></label>
		</p>
						
		<p>
			<label for="<?php echo $this->get_field_id( 'number_of_posts' ); ?>"><?php _e( 'Number of posts to display', 'rowling' ); ?>:
			<input id="<?php echo $this->get_field_id( 'number_of_posts' ); ?>" name="<?php echo $this->get_field_name( 'number_of_posts' ); ?>" type="text" class="widefat" value="<?php echo esc_attr( $number_of_posts ); ?>" /></label>
			<small>(<?php _e( 'Defaults to 5 if empty', 'rowling' ); ?>)</small>
		</p>
		
		<?php
	}
}
register_widget( 'rowling_recent_posts' ); ?>