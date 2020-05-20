<!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

	<head profile="http://gmpg.org/xfn/11">
		
		<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" >
		 
		<?php wp_head(); ?>
	
	</head>
	
	<body <?php body_class(); ?>>

		<?php 
		if ( function_exists( 'wp_body_open' ) ) {
			wp_body_open(); 
		}
		?>

		<a class="skip-link button" href="#site-content"><?php _e( 'Skip to the content', 'rowling' ); ?></a>
		
		<?php if ( has_nav_menu( 'secondary' ) || has_nav_menu( 'social' ) ) : ?>
		
			<div class="top-nav">
				
				<div class="section-inner group">

					<?php if ( has_nav_menu( 'secondary' ) ) : ?>

						<ul class="secondary-menu dropdown-menu reset-list-style">
							<?php 
							wp_nav_menu( array( 
								'container' 		=> '', 
								'items_wrap' 		=> '%3$s',
								'theme_location' 	=> 'secondary'
							) ); 
							?>
						</ul><!-- .secondary-menu -->

					<?php endif; ?>

					<?php if ( has_nav_menu( 'social' ) ) : ?>
				
						<ul class="social-menu reset-list-style">
							<?php 
							wp_nav_menu( array(
								'theme_location'	=>	'social',
								'container'			=>	'',
								'container_class'	=>	'menu-social',
								'items_wrap'		=>	'%3$s',
								'menu_id'			=>	'menu-social-items',
								'menu_class'		=>	'menu-items',
								'depth'				=>	1,
								'link_before'		=>	'<span class="screen-reader-text">',
								'link_after'		=>	'</span>',
								'fallback_cb'		=>	'',
							) );
							echo '<li id="menu-item-151" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-151"><a class="search-toggle" href="?s"><span class="screen-reader-text">Search</span></a></li>';
							?>
						</ul><!-- .social-menu -->

					<?php endif; ?>
				
				</div><!-- .section-inner -->
				
			</div><!-- .top-nav -->
			
		<?php endif; ?>
		
		<div class="search-container">
			
			<div class="section-inner">
			
				<?php get_search_form(); ?>
			
			</div><!-- .section-inner -->
			
		</div><!-- .search-container -->
		
		<header class="header-wrapper">
		
			<div class="header">
					
				<div class="section-inner">
				
					<?php 

					$custom_logo_id 	= get_theme_mod( 'custom_logo' );
					$legacy_logo_url 	= get_theme_mod( 'rowling_logo' );
					$blog_title_elem 	= ( ( is_front_page() || is_home() ) && ! is_page() ) ? 'h1' : 'div';
					$blog_title_class 	= $custom_logo_id ? 'blog-logo' : 'blog-title';

					$blog_title 		= get_bloginfo( 'title' );
					$blog_description 	= get_bloginfo( 'description' );

					if ( $custom_logo_id  || $legacy_logo_url ) : 

						$custom_logo_url = $legacy_logo_url ? $legacy_logo_url : wp_get_attachment_image_url( $custom_logo_id, 'full' );
					
						?>

						<<?php echo $blog_title_elem; ?> class="<?php echo esc_attr( $blog_title_class ); ?>">
							<a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
								<img src="<?php echo esc_url( $custom_logo_url ); ?>">
								<span class="screen-reader-text"><?php echo $blog_title; ?></span>
							</a>
						</<?php echo $blog_title_elem; ?>>
			
					<?php elseif ( $blog_description || $blog_title ) : ?>

						<<?php echo $blog_title_elem; ?> class="<?php echo esc_attr( $blog_title_class ); ?>">
							<a href="<?php echo esc_url( home_url() ); ?>" rel="home"><?php echo $blog_title; ?></a>
						</<?php echo $blog_title_elem; ?>>
					
						<?php if ( $blog_description ) : ?>
							<div class="blog-description"><?php echo wpautop( $blog_description ); ?></div>
						<?php endif; ?>
					
					<?php endif; ?>
					
					<div class="nav-toggle">
						
						<div class="bars">
							<div class="bar"></div>
							<div class="bar"></div>
							<div class="bar"></div>
						</div>
						
					</div><!-- .nav-toggle -->
				
				</div><!-- .section-inner -->
				
			</div><!-- .header -->
			
			<div class="navigation">
				
				<div class="section-inner group">
					
					<ul class="primary-menu reset-list-style dropdown-menu">
						
						<?php if ( has_nav_menu( 'primary' ) ) {

							$nav_args = array( 
								'container' => '', 
								'items_wrap' => '%3$s',
								'theme_location' => 'primary'
							);
																		
							wp_nav_menu( $nav_args ); 
						
						} else {

							$list_pages_args = array(
								'container' => '',
								'title_li' 	=> ''
							);

							wp_list_pages( $list_pages_args );
							
						} ?>
															
					</ul>
					
				</div><!-- .section-inner -->
				
			</div><!-- .navigation -->
				
			<ul class="mobile-menu reset-list-style">
				
				<?php 
				if ( has_nav_menu( 'primary' ) ) {
					wp_nav_menu( $nav_args ); 
				} else {
					wp_list_pages( $list_pages_args );
				}
				?>
				
			</ul><!-- .mobile-menu -->
				
		</header><!-- .header-wrapper -->

		<main id="site-content">