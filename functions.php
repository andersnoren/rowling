<?php


/* ---------------------------------------------------------------------------------------------
   THEME SETUP
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'rowling_setup' ) ) {

	function rowling_setup() {
		
		// Automatic feed
		add_theme_support( 'automatic-feed-links' );
		
		// Title tag
		add_theme_support( 'title-tag' );
		
		// Add post format support
		add_theme_support( 'post-formats', array( 'gallery' ) );
		
		// Set content-width
		global $content_width;
		if ( ! isset( $content_width ) ) $content_width = 616;
		
		// Post thumbnails
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size ( 88, 88, true );
		
		add_image_size( 'post-image', 816, 9999 );
		add_image_size( 'post-image-thumb', 400, 200, true );
			
		// Add nav menus
		register_nav_menu( 'primary', __( 'Primary Menu', 'rowling' ) );
		register_nav_menu( 'secondary', __( 'Secondary Menu', 'rowling' ) );
		register_nav_menu( 'social', __( 'Social Menu', 'rowling' ) );
		
		// Make the theme translation ready
		load_theme_textdomain( 'rowling', get_template_directory() . '/languages' );
		
		$locale = get_locale();
		$locale_file = get_template_directory() . "/languages/$locale.php";
		if ( is_readable( $locale_file ) ) {
			require_once( $locale_file );
		}
		
	}
	add_action( 'after_setup_theme', 'rowling_setup' );

}


/* ---------------------------------------------------------------------------------------------
   ENQUEUE JAVASCRIPT
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'rowling_load_javascript_files' ) ) {

	function rowling_load_javascript_files() {

		if ( ! is_admin() ) {

			wp_register_script( 'rowling_flexslider', get_template_directory_uri() . '/js/flexslider.js', '', true );	
			wp_register_script( 'rowling_doubletap', get_template_directory_uri() . '/js/doubletaptogo.js', '', true );

			wp_enqueue_script( 'rowling_global', get_template_directory_uri() . '/js/global.js', array( 'jquery', 'rowling_flexslider', 'rowling_doubletap' ), '', true );

			if ( is_singular() ) wp_enqueue_script( "comment-reply" );
		}

	}
	add_action( 'wp_enqueue_scripts', 'rowling_load_javascript_files' );

}


/* ---------------------------------------------------------------------------------------------
   ENQUEUE STYLES
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'rowling_load_style' ) ) {

	function rowling_load_style() {

		if ( ! is_admin() ) {

			$dependencies = array();

			/**
			 * Translators: If there are characters in your language that are not
			 * supported by the theme fonts, translate this to 'off'. Do not translate
			 * into your own language.
			 */
			$google_fonts = _x( 'on', 'Google Fonts: on or off', 'rowling' );

			if ( 'off' !== $google_fonts ) {

				// Register Google Fonts
				wp_register_style( 'rowling_google_fonts', '//fonts.googleapis.com/css?family=Lato:400,700,900,400italic,700italic|Merriweather:700,900,400italic' );
				$dependencies[] = 'rowling_google_fonts';

			}

			wp_register_style( 'rowling_fontawesome', get_template_directory_uri() . '/fa/css/font-awesome.css' );

			$dependencies[] = 'rowling_fontawesome';

			wp_enqueue_style( 'rowling_style', get_stylesheet_uri(), $dependencies );

		}

	}
	add_action( 'wp_print_styles', 'rowling_load_style' );

}


/* ---------------------------------------------------------------------------------------------
   ADD EDITOR STYLES
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'rowling_add_editor_styles' ) ) {
   
	function rowling_add_editor_styles() {

		add_editor_style( 'rowling-editor-styles.css' );

		/**
		 * Translators: If there are characters in your language that are not
		 * supported by the theme fonts, translate this to 'off'. Do not translate
		 * into your own language.
		 */
		$google_fonts = _x( 'on', 'Google Fonts: on or off', 'rowling' );

		if ( 'off' !== $google_fonts ) {
			$font_url = '//fonts.googleapis.com/css?family=Lato:400,700,900|Playfair+Display:400,700,400italic';
			add_editor_style( str_replace( ', ', '%2C', $font_url ) );
		}

	}
	add_action( 'init', 'rowling_add_editor_styles' );

}


/* ---------------------------------------------------------------------------------------------
   ADD WIDGET AREAS
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'rowling_sidebar_registration' ) ) {

	function rowling_sidebar_registration() {

		register_sidebar( array(
			'name' 			=> __( 'Sidebar', 'rowling' ),
			'id' 			=> 'sidebar',
			'description' 	=> __( 'Widgets in this area will be shown in the sidebar.', 'rowling' ),
			'before_title' 	=> '<h3 class="widget-title">',
			'after_title' 	=> '</h3>',
			'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
			'after_widget' 	=> '</div><div class="clear"></div></div>'
		) );

	}
	add_action( 'widgets_init', 'rowling_sidebar_registration' ); 

}


/* ---------------------------------------------------------------------------------------------
   ADD THEME WIDGETS
   --------------------------------------------------------------------------------------------- */


require_once( get_template_directory() . '/widgets/flickr-widget.php' );
require_once( get_template_directory() . '/widgets/recent-comments.php' );
require_once( get_template_directory() . '/widgets/recent-posts.php' );


/* ---------------------------------------------------------------------------------------------
   DELIST WORDPRESS WIDGETS REPLACED BY THEME ONES
   --------------------------------------------------------------------------------------------- */

 
if ( ! function_exists( 'rowling_unregister_default_widgets' ) ) {

	function rowling_unregister_default_widgets() {
		unregister_widget( 'WP_Widget_Recent_Comments' );
		unregister_widget( 'WP_Widget_Recent_Posts' );
	}
	add_action( 'widgets_init', 'rowling_unregister_default_widgets', 11 );

}


/* ---------------------------------------------------------------------------------------------
   CHECK FOR JAVASCRIPT
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'rowling_html_js_class' ) ) {

	function rowling_html_js_class () {
		echo '<script>document.documentElement.className = document.documentElement.className.replace("no-js","js");</script>'. "\n";
	}
	add_action( 'wp_head', 'rowling_html_js_class', 1 );

}


/* ---------------------------------------------------------------------------------------------
   RELATED POSTS FUNCTION
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'rowling_related_posts' ) ) {

	function rowling_related_posts( $number_of_posts = 3 ) { ?>
		
		<div class="related-posts">
			
			<p class="related-posts-title"><?php _e( 'Read Next', 'rowling' ); ?> &rarr;</p>
			
			<div class="row">
							
				<?php

				global $post;

				// Base args, used for both the term query and random query
				$base_args = array(
					'ignore_sticky_posts'	=>	true,
					'meta_key'				=>	'_thumbnail_id',
					'posts_per_page'		=>	$number_of_posts,
					'post_status'			=>	'publish',
					'post__not_in'			=>	array( $post->ID ),	
				);

				// Create a query for posts in the same category as the ones for the current post
				$cat_ids = array();

				$categories = get_the_category();

				foreach( $categories as $category ) {
					$cat_ids[] = $category->cat_ID;
				}

				$term_posts_args = array_merge( $base_args, array( 'category__in' => $cat_ids ) );
				
				$related_posts = get_posts( $term_posts_args );

				// No results for the categories? Get random posts instead
				if ( ! $related_posts ) :

					$random_posts_args = array_merge( $base_args, array( 'orderby' => 'rand' ) );

					$related_posts = get_posts( $random_posts_args );

				endif;

				// If either the category query or random query hit pay dirt, output the posts
				if ( $related_posts ) :
					
					foreach( $related_posts as $related_post ) : ?>
				
						<a class="related-post" href="<?php echo get_the_permalink( $related_post->ID ); ?>" title="<?php the_title_attribute( array( 'post' => $related_post->ID ) ); ?>">
							
							<?php if ( has_post_thumbnail( $related_post->ID ) ) : ?>
								
								<?php echo get_the_post_thumbnail( $related_post->ID, 'post-image-thumb' ) ?>
								
							<?php endif; ?>
							
							<p class="category">
								<?php 
								$category = get_the_category( $related_post->ID ); 
								echo $category[0]->cat_name;
								?>
							</p>
					
							<h3 class="title"><?php echo get_the_title( $related_post->ID ); ?></h3>
								
						</a>
					
						<?php 

					endforeach;
				
				endif;
				
				?>
			
			</div><!-- .row -->

		</div><!-- .related-posts -->
		
		<?php
	}

}



/* ---------------------------------------------------------------------------------------------
   ARCHIVE NAVIGATION FUNCTION
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'rowling_archive_navigation' ) ) {

	function rowling_archive_navigation() {
		
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
	}
}


/* ---------------------------------------------------------------------------------------------
   CUSTOM READ MORE TEXT
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'rowling_modify_read_more_link' ) ) {

	function rowling_modify_read_more_link() {
		return '<p><a class="more-link" href="' . get_permalink() . '">' . __( 'Read More', 'rowling' ) . '</a></p>';
	}
	add_filter( 'the_content_more_link', 'rowling_modify_read_more_link' );

}


/* ---------------------------------------------------------------------------------------------
   BODY CLASSES
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'rowling_body_classes' ) ) {
	
	function rowling_body_classes( $classes ) {
	
		// If has post thumbnail
		if ( is_single() && has_post_thumbnail() ){
			$classes[] = 'has-featured-image';
		}
		
		return $classes;
	}
	add_filter( 'body_class', 'rowling_body_classes' );

}


/* ---------------------------------------------------------------------------------------------
   GET COMMENT EXCERPT LENGTH
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'rowling_get_comment_excerpt' ) ) {

	function rowling_get_comment_excerpt( $comment_ID = 0, $num_words = 20 ) {
		$comment = get_comment( $comment_ID );
		$comment_text = strip_tags( $comment->comment_content );
		$blah = explode( ' ', $comment_text );
		if ( count( $blah ) > $num_words ) {
			$k = $num_words;
			$use_dotdotdot = 1;
		} else {
			$k = count( $blah );
			$use_dotdotdot = 0;
		}
		$excerpt = '';
		for ( $i = 0; $i < $k; $i++ ) {
			$excerpt .= $blah[$i] . ' ';
		}
		$excerpt .= ( $use_dotdotdot ) ? '...' : '';
		return apply_filters( 'get_comment_excerpt', $excerpt );
	}

}


/* ---------------------------------------------------------------------------------------------
   ADMIN CSS
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'rowling_admin_css' ) ) {
   
	function rowling_admin_css() { ?>
		<style type="text/css">
			#postimagediv #set-post-thumbnail img {
				max-width: 100%;
				height: auto;
			}
		</style>
		<?php
	}
	add_action( 'admin_head', 'rowling_admin_css' );

}


/* ---------------------------------------------------------------------------------------------
   FLEXSLIDER FUNCTION
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'rowling_flexslider' ) ) {

	function rowling_flexslider( $size ) {

		$attachment_parent = is_page() ? $post->ID : get_the_ID();

		$images = get_posts( array(
			'numberposts'    => -1,
			'orderby'        => 'menu_order',
			'order'          => 'ASC',
			'post_mime_type' => 'image',
			'post_parent'    => $attachment_parent,
			'post_status'    => null,
			'post_type'      => 'attachment',
		) );

		if ( $images ) { ?>
		
			<?php if ( ! is_single() ) : // Make it a link if it's an archive ?>
		
				<a class="flexslider" href="<?php the_permalink(); ?>">
					
			<?php else : // ...and just a div if it's a single post ?>
			
				<div class="flexslider">
					
			<?php endif; ?>
			
			<ul class="slides">
	
				<?php foreach( $images as $image ) { 

					$attimg = wp_get_attachment_image( $image->ID, $size ); 
					
					?>
					
					<li>
						<?php 
						
						echo $attimg;

						if ( ! empty( $image->post_excerpt ) && is_single() ) : ?>
						
							<p class="post-image-caption"><span class="fa fw fa-camera"></span><?php echo $image->post_excerpt; ?></p>
							
						<?php endif; ?>
					</li>
					
					<?php 
				} 
				?>

			</ul>
			
			<?php 
			echo ! is_single() ? '</a>' : '</div>';
		}
	}

}


/* ---------------------------------------------------------------------------------------------
   COMMENT FUNCTION
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'rowling_comment' ) ) {

	function rowling_comment( $comment, $args, $depth ) {
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
		?>
		
		<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		
			<?php __( 'Pingback:', 'rowling' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'rowling' ), '<span class="edit-link">', '</span>' ); ?>
			
		</li>
		<?php
				break;
			default :
			global $post;
		?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		
			<div id="comment-<?php comment_ID(); ?>" class="comment">
				
				<?php echo get_avatar( $comment, 160 ); ?>
				
				<?php if ( $comment->user_id === $post->post_author ) : ?>
						
					<a class="comment-author-icon" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>" title="<?php _e( 'Comment by post author', 'rowling' ); ?>"><div class="fa fw fa-user"></div></a>
				
				<?php endif; ?>
				
				<div class="comment-inner">
				
					<div class="comment-header">
												
						<h4><?php echo get_comment_author_link(); ?></h4>
					
					</div><!-- .comment-header -->
					
					<div class="comment-content post-content">
				
						<?php comment_text(); ?>
						
					</div><!-- .comment-content -->
					
					<div class="comment-meta">
						
						<div class="fleft">
							<div class="fa fw fa-clock-o"></div><a class="comment-date-link" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>" title="<?php echo get_comment_date() . ' at ' . get_comment_time(); ?>"><?php echo get_comment_date(get_option( 'date_format' ) ); ?></a>
							<?php edit_comment_link( __( 'Edit', 'rowling' ), '<div class="fa fw fa-wrench"></div>', '' ); ?>
						</div>
						
						<?php if ( '0' == $comment->comment_approved ) : ?>
					
							<div class="comment-awaiting-moderation fright">
								<div class="fa fw fa-exclamation-circle"></div><?php _e( 'Awaiting moderation', 'rowling' ); ?>
							</div>
							
						<?php else :

							comment_reply_link( array( 
								'reply_text' 	=>  	__( 'Reply', 'rowling' ),
								'depth'			=> 		$depth, 
								'max_depth' 	=> 		$args['max_depth'],
								'before'		=>		'<div class="fright"><div class="fa fw fa-reply"></div>',
								'after'			=>		'</div>'
							) ); 
							
						endif; ?>
						
						<div class="clear"></div>
						
					</div><!-- .comment-meta -->
									
				</div><!-- .comment-inner -->
											
			</div><!-- .comment-## -->
					
		<?php
			break;
		endswitch;
	}
}


/* ---------------------------------------------------------------------------------------------
   CUSTOMIZER SETTINGS
   --------------------------------------------------------------------------------------------- */


class rowling_customize {

   public static function rowling_register( $wp_customize ) {
   
      //1. Define a new section (if desired) to the Theme Customizer
      $wp_customize->add_section( 'rowling_options', 
         array(
            'title' 		=> __( 'Options for Rowling', 'rowling' ), //Visible title of section
            'priority' 		=> 35, //Determines what order this appears in
            'capability' 	=> 'edit_theme_options', //Capability needed to tweak
            'description' 	=> __( 'Allows you to customize theme settings for Rowling.', 'rowling' ), //Descriptive tooltip
         ) 
      );
      
      $wp_customize->add_section( 'rowling_logo_section' , array(
		    'title'       => __( 'Logo', 'rowling' ),
		    'priority'    => 40,
		    'description' => __( 'Upload a logo to replace the default site title in the header.', 'rowling' ),
	  ) );
      
      
      //2. Register new settings to the WP database...
      $wp_customize->add_setting( 'accent_color', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
         array(
            'default' 			=> '#0093C2', //Default setting/value to save
            'type' 				=> 'theme_mod', //Is this an 'option' or a 'theme_mod'?
            'transport' 		=> 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
      		'sanitize_callback' => 'sanitize_hex_color'
         ) 
      );
	  
	  $wp_customize->add_setting( 'rowling_logo', 
      	array( 
      		'sanitize_callback' => 'esc_url_raw'
      	) 
      );
      
      
      //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
      $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
         $wp_customize, //Pass the $wp_customize object (required)
         'rowling_accent_color', //Set a unique ID for the control
         array(
            'label' 	=> __( 'Accent Color', 'rowling' ), //Admin-visible name of the control
            'section' 	=> 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'settings' 	=> 'accent_color', //Which setting to load and manipulate (serialized is okay)
            'priority' 	=> 10, //Determines the order this control appears in for the specified section
         ) 
      ) );
      
      $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'rowling_logo', array(
		    'label'    => __( 'Logo', 'rowling' ),
		    'section'  => 'rowling_logo_section',
		    'settings' => 'rowling_logo',
	  ) ) );
      
      //4. We can also change built-in settings by modifying properties. For instance, let's make some stuff use live preview JS...
      $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
      $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
   }

   public static function rowling_header_output() {
      
		echo '<!-- Customizer CSS -->';
		echo '<style type="text/css">';

			self::rowling_generate_css( 'body a', 'color', 'accent_color' );
			self::rowling_generate_css( 'body a:hover', 'color', 'accent_color' );

			self::rowling_generate_css( '.blog-title a:hover', 'color', 'accent_color' );
			self::rowling_generate_css( '.navigation .section-inner', 'background', 'accent_color' );
			self::rowling_generate_css( '.primary-menu ul li:hover > a', 'color', 'accent_color' );
			self::rowling_generate_css( '.search-container .search-button:hover', 'color', 'accent_color' );

			self::rowling_generate_css( '.sticky .sticky-tag', 'background', 'accent_color' );
			self::rowling_generate_css( '.sticky .sticky-tag:after', 'border-right-color', 'accent_color' );
			self::rowling_generate_css( '.sticky .sticky-tag:after', 'border-left-color', 'accent_color' );
			self::rowling_generate_css( '.post-categories', 'color', 'accent_color' );
			self::rowling_generate_css( '.single .post-meta a', 'color', 'accent_color' );
			self::rowling_generate_css( '.single .post-meta a:hover', 'border-bottom-color', 'accent_color' );
			self::rowling_generate_css( '.single-post .post-image-caption .fa', 'color', 'accent_color' );
			self::rowling_generate_css( '.related-post .category', 'color', 'accent_color' );

			self::rowling_generate_css( '.post-content a', 'color', 'accent_color' );
			self::rowling_generate_css( '.post-content a:hover', 'color', 'accent_color' );
			self::rowling_generate_css( '.post-content a:hover', 'border-bottom-color', 'accent_color' );
			self::rowling_generate_css( '.post-content p.intro', 'color', 'accent_color' );
			self::rowling_generate_css( '.post-content blockquote:after', 'color', 'accent_color' );
			self::rowling_generate_css( '.post-content fieldset legend', 'background', 'accent_color' );
			self::rowling_generate_css( '.post-content input[type="submit"]', 'background', 'accent_color' );
			self::rowling_generate_css( '.post-content input[type="button"]', 'background', 'accent_color' );
			self::rowling_generate_css( '.post-content input[type="reset"]', 'background', 'accent_color' );
			self::rowling_generate_css( '.post-content input[type="submit"]:hover', 'background', 'accent_color' );
			self::rowling_generate_css( '.post-content input[type="button"]:hover', 'background', 'accent_color' );
			self::rowling_generate_css( '.post-content input[type="reset"]:hover', 'background', 'accent_color' );

			self::rowling_generate_css( '.post-content .has-accent-color', 'color', 'accent_color' );
			self::rowling_generate_css( '.post-content .has-accent-background-color', 'background-color', 'accent_color' );

			self::rowling_generate_css( '.page-edit-link', 'color', 'accent_color' );
			self::rowling_generate_css( '.post-content .page-links a:hover', 'background', 'accent_color' );
			self::rowling_generate_css( '.post-tags a:hover', 'background', 'accent_color' );
			self::rowling_generate_css( '.post-tags a:hover:before', 'border-right-color', 'accent_color' );
			self::rowling_generate_css( '.post-navigation h4 a:hover', 'color', 'accent_color' );

			self::rowling_generate_css( '.no-comments .fa', 'color', 'accent_color' );
			self::rowling_generate_css( '.comments-title-container .fa', 'color', 'accent_color' );
			self::rowling_generate_css( '.comment-reply-title .fa', 'color', 'accent_color' );
			self::rowling_generate_css( '.comments-title-link a', 'color', 'accent_color' );
			self::rowling_generate_css( '.comments-title-link a:hover', 'border-bottom-color', 'accent_color' );
			self::rowling_generate_css( '.comments .pingbacks li a:hover', 'color', 'accent_color' );
			self::rowling_generate_css( '.comment-header h4 a', 'color', 'accent_color' );
			self::rowling_generate_css( '.bypostauthor .comment-author-icon', 'background', 'accent_color' );
			self::rowling_generate_css( '.form-submit #submit', 'background-color', 'accent_color' );
			self::rowling_generate_css( '.comments-nav a:hover', 'color', 'accent_color' );
			self::rowling_generate_css( '.pingbacks-title', 'border-bottom-color', 'accent_color' );

			self::rowling_generate_css( '.page-title h4', 'border-bottom-color', 'accent_color' );	           
			self::rowling_generate_css( '.archive-nav a:hover', 'color', 'accent_color' );
			self::rowling_generate_css( '.archive-nav a:hover', 'border-top-color', 'accent_color' );

			self::rowling_generate_css( '.widget-title', 'border-bottom-color', 'accent_color' );	           
			self::rowling_generate_css( '.widget-content .textwidget a:hover', 'color', 'accent_color' );
			self::rowling_generate_css( '.widget_archive li a:hover', 'color', 'accent_color' );
			self::rowling_generate_css( '.widget_categories li a:hover', 'color', 'accent_color' );
			self::rowling_generate_css( '.widget_meta li a:hover', 'color', 'accent_color' );
			self::rowling_generate_css( '.widget_nav_menu li a:hover', 'color', 'accent_color' );
			self::rowling_generate_css( '.widget_rss .widget-content ul a.rsswidget:hover', 'color', 'accent_color' );
			self::rowling_generate_css( '#wp-calendar thead th', 'color', 'accent_color' );
			self::rowling_generate_css( '#wp-calendar tfoot a:hover', 'color', 'accent_color' );
			self::rowling_generate_css( '.widget .tagcloud a:hover', 'background', 'accent_color' );
			self::rowling_generate_css( '.widget .tagcloud a:hover:before', 'border-right-color', 'accent_color' );
			self::rowling_generate_css( '.footer .widget .tagcloud a:hover', 'background', 'accent_color' );
			self::rowling_generate_css( '.footer .widget .tagcloud a:hover:before', 'border-right-color', 'accent_color' );
			self::rowling_generate_css( '.wrapper .search-button:hover', 'color', 'accent_color' );

			self::rowling_generate_css( '.to-the-top', 'background', 'accent_color' );
			self::rowling_generate_css( '.credits .copyright a:hover', 'color', 'accent_color' );

			self::rowling_generate_css( '.nav-toggle', 'background-color', 'accent_color' );
			self::rowling_generate_css( '.mobile-menu', 'background', 'accent_color' );

		echo '</style>';
		echo '<!--/Customizer CSS-->';
	      
   }
   
	public static function rowling_live_preview() {
		wp_enqueue_script( 'rowling-themecustomizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'jquery', 'customize-preview' ), '', true );
	}

   public static function rowling_generate_css( $selector, $style, $mod_name, $prefix='', $postfix='', $echo=true ) {
      $return = '';
      $mod = get_theme_mod($mod_name);
      if ( ! empty( $mod ) ) {
         $return = sprintf( '%s { %s:%s; }',
            $selector,
            $style,
            $prefix.$mod.$postfix
         );
         if ( $echo ) {
            echo $return;
         }
      }
      return $return;
    }
}

// Setup the Theme Customizer settings and controls...
add_action( 'customize_register' , array( 'rowling_customize' , 'rowling_register' ) );

// Output custom CSS to live site
add_action( 'wp_head' , array( 'rowling_customize' , 'rowling_header_output' ) );

// Enqueue live preview javascript in Theme Customizer admin screen
add_action( 'customize_preview_init' , array( 'rowling_customize' , 'rowling_live_preview' ) );


/* ---------------------------------------------------------------------------------------------
   SPECIFY GUTENBERG SUPPORT
------------------------------------------------------------------------------------------------ */


if ( ! function_exists( 'rowling_add_gutenberg_features' ) ) :

	function rowling_add_gutenberg_features() {

		/* Gutenberg Features --------------------------------------- */

		add_theme_support( 'align-wide' );

		/* Gutenberg Palette --------------------------------------- */

		$accent_color = get_theme_mod( 'accent_color' ) ? get_theme_mod( 'accent_color' ) : '#0093C2';

		add_theme_support( 'editor-color-palette', array(
			array(
				'name' 	=> _x( 'Accent', 'Name of the accent color in the Gutenberg palette', 'rowling' ),
				'slug' 	=> 'accent',
				'color' => $accent_color,
			),
			array(
				'name' 	=> _x( 'Black', 'Name of the black color in the Gutenberg palette', 'rowling' ),
				'slug' 	=> 'black',
				'color' => '#111',
			),
			array(
				'name' 	=> _x( 'Dark Gray', 'Name of the dark gray color in the Gutenberg palette', 'rowling' ),
				'slug' 	=> 'dark-gray',
				'color' => '#333',
			),
			array(
				'name' 	=> _x( 'Medium Gray', 'Name of the medium gray color in the Gutenberg palette', 'rowling' ),
				'slug' 	=> 'medium-gray',
				'color' => '#555',
			),
			array(
				'name' 	=> _x( 'Light Gray', 'Name of the light gray color in the Gutenberg palette', 'rowling' ),
				'slug' 	=> 'light-gray',
				'color' => '#777',
			),
			array(
				'name' 	=> _x( 'White', 'Name of the white color in the Gutenberg palette', 'rowling' ),
				'slug' 	=> 'white',
				'color' => '#fff',
			),
		) );

		/* Gutenberg Font Sizes --------------------------------------- */

		add_theme_support( 'editor-font-sizes', array(
			array(
				'name' 		=> _x( 'Small', 'Name of the small font size in Gutenberg', 'rowling' ),
				'shortName' => _x( 'S', 'Short name of the small font size in the Gutenberg editor.', 'rowling' ),
				'size' 		=> 15,
				'slug' 		=> 'small',
			),
			array(
				'name' 		=> _x( 'Regular', 'Name of the regular font size in Gutenberg', 'rowling' ),
				'shortName' => _x( 'M', 'Short name of the regular font size in the Gutenberg editor.', 'rowling' ),
				'size' 		=> 17,
				'slug' 		=> 'regular',
			),
			array(
				'name' 		=> _x( 'Large', 'Name of the large font size in Gutenberg', 'rowling' ),
				'shortName' => _x( 'L', 'Short name of the large font size in the Gutenberg editor.', 'rowling' ),
				'size' 		=> 24,
				'slug' 		=> 'large',
			),
			array(
				'name' 		=> _x( 'Larger', 'Name of the larger font size in Gutenberg', 'rowling' ),
				'shortName' => _x( 'XL', 'Short name of the larger font size in the Gutenberg editor.', 'rowling' ),
				'size' 		=> 28,
				'slug' 		=> 'larger',
			),
		) );

	}
	add_action( 'after_setup_theme', 'rowling_add_gutenberg_features' );

endif;


/* ---------------------------------------------------------------------------------------------
   GUTENBERG EDITOR STYLES
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'rowling_block_editor_styles' ) ) :

	function rowling_block_editor_styles() {

		$dependencies = array();

		/**
		 * Translators: If there are characters in your language that are not
		 * supported by the theme fonts, translate this to 'off'. Do not translate
		 * into your own language.
		 */
		$google_fonts = _x( 'on', 'Google Fonts: on or off', 'rowling' );

		if ( 'off' !== $google_fonts ) {

			// Register Google Fonts
			wp_register_style( 'rowling-block-editor-styles-font', '//fonts.googleapis.com/css?family=Lato:400,700,900,400italic,700italic|Merriweather:700,900,400italic', false, 1.0, 'all' );
			$dependencies[] = 'rowling-block-editor-styles-font';

		}

		// Enqueue the editor styles
		wp_enqueue_style( 'rowling-block-editor-styles', get_theme_file_uri( '/rowling-gutenberg-editor-style.css' ), $dependencies, '1.0', 'all' );

	}
	add_action( 'enqueue_block_editor_assets', 'rowling_block_editor_styles', 1 );

endif;

?>