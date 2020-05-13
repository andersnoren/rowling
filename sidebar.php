<div class="sidebar">

	<?php 
	if ( is_active_sidebar( 'sidebar' ) ) { 
		
		dynamic_sidebar( 'sidebar' ); 
		
	} else { // Fallback if the sidebar widget area is empty
		
		echo '<div class="widgets">';
		
		the_widget( 'WP_Widget_Search', 
			array(),
			array(
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>',
				'before_widget' => '<div class="widget widget_search"><div class="widget-content">',
				'after_widget' => '</div></div>'
			) 
		);
		
		the_widget( 'rowling_recent_posts', 
			array(
				'number_of_posts' 	=>	'5',
				'widget_title'		=>	__( 'Recent Posts', 'rowling' ),
			),
			array(
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>',
				'before_widget' => '<div class="widget widget_rowling_recent_posts"><div class="widget-content">',
				'after_widget' => '</div></div>'
			) 
		);
		
		the_widget( 'WP_Widget_Categories', 
			array(
				'count'			=>	'1',
				'hierarchical'	=>	'1',
			),
			array(
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>',
				'before_widget' => '<div class="widget widget_categories"><div class="widget-content">',
				'after_widget' => '</div></div>'
			) 
		);
		
		the_widget( 'WP_Widget_Archives', 
			array(
				'count'			=>	'1',
				'hierarchical'	=>	'1',
			),
			array(
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>',
				'before_widget' => '<div class="widget widget_archive"><div class="widget-content">',
				'after_widget' => '</div></div>'
			) 
		);
		
		echo '</div>';
		
	}
	?>

</div>