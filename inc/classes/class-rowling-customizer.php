<?php

/* ---------------------------------------------------------------------------------------------
   CUSTOMIZER SETTINGS
   --------------------------------------------------------------------------------------------- */

if ( ! class_exists( 'Rowling_Customize' ) ) :
	class Rowling_Customize {

		public static function register( $wp_customize ) {

			/* SECTION: ROWLING OPTIONS */

			$wp_customize->add_section( 'rowling_options', array(
				'title' 		=> __( 'Options for Rowling', 'rowling' ),
				'priority' 		=> 10,
				'capability' 	=> 'edit_theme_options',
				'description' 	=> __( 'Allows you to customize theme settings for Rowling.', 'rowling' ),
			) );

			/* SETTING: ACCENT COLOR */

			$wp_customize->add_setting( 'accent_color', array(
				'default' 			=> '#0093C2',
				'type' 				=> 'theme_mod',
				'sanitize_callback' => 'sanitize_hex_color'
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'rowling_accent_color', array(
				'label' 	=> __( 'Accent Color', 'rowling' ),
				'section' 	=> 'rowling_options',
				'settings' 	=> 'accent_color',
				'priority' 	=> 10,
			) ) );
			
			/* SETTING: CUSTOM LOGO */

			// Only display the Customizer section for the rowling_logo setting if it already has a value.
			// This means that site owners with existing logos can remove them, but new site owners can't add them.
			// Since v2.0.0, the core custom_logo setting (in the Site Identity Customizer panel) should be used instead.
			if ( get_theme_mod( 'rowling_logo' ) ) {
				
				$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'rowling_logo', array(
					'label'    => __( 'Logo', 'rowling' ),
					'section'  => 'rowling_options',
					'settings' => 'rowling_logo',
				) ) );
				
				$wp_customize->add_setting( 'rowling_logo', array( 
					'sanitize_callback' => 'esc_url_raw'
				) );

			}
			
		}

		public static function header_output() {

			$accent_default = '#0093C2';
			$accent = get_theme_mod( 'accent_color', $accent_default );

			if ( ! $accent || $accent == $accent_default ) return;

			echo '<!-- Customizer CSS -->';
			echo '<style type="text/css">';

			self::generate_css( 'a', 'color', $accent );

			self::generate_css( '.blog-title a:hover', 'color', $accent );
			self::generate_css( '.navigation .section-inner', 'background-color', $accent );
			self::generate_css( '.primary-menu ul li:hover > a', 'color', $accent );
			self::generate_css( '.search-container .search-button:hover', 'color', $accent );

			self::generate_css( '.sticky .sticky-tag', 'background-color', $accent );
			self::generate_css( '.sticky .sticky-tag:after', 'border-right-color', $accent );
			self::generate_css( '.sticky .sticky-tag:after', 'border-left-color', $accent );
			self::generate_css( '.post-categories', 'color', $accent );
			self::generate_css( '.single .post-meta a', 'color', $accent );
			self::generate_css( '.single .post-meta a:hover', 'border-bottom-color', $accent );
			self::generate_css( '.single-post .post-image-caption .fa', 'color', $accent );
			self::generate_css( '.related-post .category', 'color', $accent );

			self::generate_css( 'p.intro', 'color', $accent );
			self::generate_css( 'blockquote:after', 'color', $accent );
			self::generate_css( 'fieldset legend', 'background-color', $accent );

			self::generate_css( 'button, .button, .faux-button, :root .wp-block-button__link, :root .wp-block-file__button, input[type="button"], input[type="reset"], input[type="submit"]', 'background-color', $accent );

			self::generate_css( ':root .has-accent-color', 'color', $accent );
			self::generate_css( ':root .has-accent-background-color', 'background-color', $accent );

			self::generate_css( '.page-edit-link', 'color', $accent );
			self::generate_css( '.post-content .page-links a:hover', 'background-color', $accent );
			self::generate_css( '.post-tags a:hover', 'background-color', $accent );
			self::generate_css( '.post-tags a:hover:before', 'border-right-color', $accent );
			self::generate_css( '.post-navigation h4 a:hover', 'color', $accent );

			self::generate_css( '.comments-title-container .fa', 'color', $accent );
			self::generate_css( '.comment-reply-title .fa', 'color', $accent );
			self::generate_css( '.comments .pingbacks li a:hover', 'color', $accent );
			self::generate_css( '.comment-header h4 a', 'color', $accent );
			self::generate_css( '.bypostauthor .comment-author-icon', 'background-color', $accent );
			self::generate_css( '.comments-nav a:hover', 'color', $accent );
			self::generate_css( '.pingbacks-title', 'border-bottom-color', $accent );

			self::generate_css( '.archive-title', 'border-bottom-color', $accent );
			self::generate_css( '.archive-nav a:hover', 'color', $accent );

			self::generate_css( '.widget-title', 'border-bottom-color', $accent );	           
			self::generate_css( '.widget-content .textwidget a:hover', 'color', $accent );
			self::generate_css( '.widget_archive li a:hover', 'color', $accent );
			self::generate_css( '.widget_categories li a:hover', 'color', $accent );
			self::generate_css( '.widget_meta li a:hover', 'color', $accent );
			self::generate_css( '.widget_nav_menu li a:hover', 'color', $accent );
			self::generate_css( '.widget_rss .widget-content ul a.rsswidget:hover', 'color', $accent );
			self::generate_css( '#wp-calendar thead th', 'color', $accent );
			self::generate_css( '#wp-calendar tfoot a:hover', 'color', $accent );
			self::generate_css( '.widget .tagcloud a:hover', 'background-color', $accent );
			self::generate_css( '.widget .tagcloud a:hover:before', 'border-right-color', $accent );
			self::generate_css( '.footer .widget .tagcloud a:hover', 'background-color', $accent );
			self::generate_css( '.footer .widget .tagcloud a:hover:before', 'border-right-color', $accent );
			self::generate_css( '.wrapper .search-button:hover', 'color', $accent );

			self::generate_css( '.to-the-top', 'background-color', $accent );
			self::generate_css( '.credits .copyright a:hover', 'color', $accent );

			self::generate_css( '.nav-toggle', 'background-color', $accent );
			self::generate_css( '.mobile-menu', 'background-color', $accent );

			echo '</style>';
			echo '<!--/Customizer CSS-->';
				
		}

		public static function generate_css( $selector, $style, $value, $prefix='', $postfix='', $echo=true ) {
			$return = '';
			if ( $value ) {
				$return = sprintf( '%s { %s:%s; }',
					$selector,
					$style,
					$prefix.$value.$postfix
				);
				if ( $echo ) echo $return;
			}
			return $return;
		}

	}

	add_action( 'customize_register', array( 'Rowling_Customize', 'register' ) );
	add_action( 'wp_head', array( 'Rowling_Customize', 'header_output' ) );

endif;