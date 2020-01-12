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
				
				<div class="section-inner">
					
					<ul class="secondary-menu">
						
						<?php 
						if ( has_nav_menu( 'secondary' ) ) {
							wp_nav_menu( array( 
								'container' 		=> '', 
								'items_wrap' 		=> '%3$s',
								'theme_location' 	=> 'secondary'
							) ); 
						}
						?>
															
					</ul><!-- .secondary-menu -->
				
					<ul class="social-menu">
						
						<?php 
						if ( has_nav_menu( 'social' ) ) {
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
							echo '<li id="menu-item-151" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-151"><a class="search-toggle" href="#"><span class="screen-reader-text">Search</span></a></li>';
						}
						?>
						
					</ul><!-- .social-menu -->
				
				<div class="clear"></div>
				
				</div><!-- .section-inner -->
				
			</div><!-- .top-nav -->
			
		<?php endif; ?>
		
		<div class="search-container">
			
			<div class="section-inner">
			
				<?php get_search_form(); ?>
			
			</div><!-- .section-inner -->
			
		</div><!-- .search-container -->
		
		<div class="header-wrapper">
		
			<div class="header">
					
				<div class="section-inner">
				
					<?php if ( get_theme_mod( 'rowling_logo' ) ) : ?>
				
				        <a class="blog-logo" href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'title' ) ); ?> &mdash; <?php echo esc_attr( get_bloginfo( 'description' ) ); ?>' rel='home'>
				        	<img src='<?php echo esc_url( get_theme_mod( 'rowling_logo' ) ); ?>' alt='<?php echo esc_attr( get_bloginfo( 'title' ) ); ?>'>
				        </a>
				
					<?php elseif ( get_bloginfo( 'description' ) || get_bloginfo( 'title' ) ) : 
						
						$title_type = is_singular() ? '2' : '1';
						?>
				
						<h<?php echo $title_type ?> class="blog-title">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'title' ) ); ?> &mdash; <?php echo esc_attr( get_bloginfo( 'description' ) ); ?>" rel="home"><?php echo esc_attr( get_bloginfo( 'title' ) ); ?></a>
						</h<?php echo $title_type ?>>
						
						<?php if ( get_bloginfo( 'description' ) ) : ?>
						
							<h4 class="blog-description">
								<?php bloginfo( 'description' ); ?>
							</h4>
							
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
				
				<div class="section-inner">
					
					<ul class="primary-menu">
						
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
					
					<div class="clear"></div>
					
				</div>
				
			</div><!-- .navigation -->
				
			<ul class="mobile-menu">
				
				<?php 
				if ( has_nav_menu( 'primary' ) ) {
					wp_nav_menu( $nav_args ); 
				} else {
					wp_list_pages( $list_pages_args );
				}
				?>
				
			</ul><!-- .mobile-menu -->
				
		</div><!-- .header-wrapper -->

		<main id="site-content">