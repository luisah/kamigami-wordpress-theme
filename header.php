<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Header Template
 *
 *
 * @file           header.php
 * @package        Responsive 
 * @author         Emil Uzelac 
 * @copyright      2003 - 2013 ThemeID
 * @license        license.txt
 * @version        Release: 1.3
 * @filesource     wp-content/themes/responsive/header.php
 * @link           http://codex.wordpress.org/Theme_Development#Document_Head_.28header.php.29
 * @since          available since Release 1.0
 */
?>
<!doctype html>
<!--[if !IE]>      <html class="no-js non-ie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>    <html class="no-js ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>    <html class="no-js ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9 ]>    <html class="no-js ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>

<meta charset="<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">

<title><?php wp_title('&#124;', true, 'right'); ?></title>

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php
global $responsive_options;
$responsive_options = responsive_get_options();
?>
                 
<?php responsive_container(); // before container hook ?>
<div id="container" class="hfeed">
         
    <?php responsive_header(); // before header hook ?>
    <div id="header">

		<?php responsive_header_top(); // before header content hook ?>
    
        <?php if (has_nav_menu('top-menu', 'responsive')) { ?>
	        <?php wp_nav_menu(array(
				    'container'       => '',
					'fallback_cb'	  =>  false,
					'menu_class'      => 'top-menu ropa-sans',
					'theme_location'  => 'top-menu')
					); 
				?>
        <?php } ?>
        
        <div id="menu-icon"><img src="<?php echo get_stylesheet_directory_uri() ?>/core/icons/menu-icon.png" alt="menu-icon" width="32" height="26"></div>
        
    <?php responsive_in_header(); // header hook ?>
    
    <div class="menu-overlay">
   
	<?php if ( get_header_image() != '' ) : ?>
               
        <div id="logo">
            <a href="<?php echo home_url('/'); ?>"><img src="<?php header_image(); ?>" width="<?php if(function_exists('get_custom_header')) { echo get_custom_header() -> width;} else { echo HEADER_IMAGE_WIDTH;} ?>" height="<?php if(function_exists('get_custom_header')) { echo get_custom_header() -> height;} else { echo HEADER_IMAGE_HEIGHT;} ?>" alt="<?php bloginfo('name'); ?>" /></a>
        </div><!-- end of #logo -->
        
    <?php endif; // header image was removed ?>

    <?php if ( !get_header_image() ) : ?>
                
        <div id="logo">
            <span class="site-name"><a href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><?php bloginfo('name'); ?></a></span>
            <span class="site-description"><?php bloginfo('description'); ?></span>
        </div><!-- end of #logo -->  

    <?php endif; // header image was removed (again) ?>
    
    <?php get_sidebar('top'); ?>
    	<div class="main-nav">
			<?php wp_nav_menu(array(
			    	'container'       => 'div',
					'container_class' => 'main-menu-container',
					'fallback_cb'	  => 'responsive_fallback_menu',
					'theme_location'  => 'header-menu')
				); 
			?>
			<div class="jcarousel-scroll">
		        <a href="#" id="mycarousel-prev">&#8249;</a>
		        <a href="#" id="mycarousel-next">&#8250;</a>
		    </div>
    	</div>

		<?php responsive_header_bottom(); // after header content hook ?>
			
		<div class="grid col-940 fit">
         <?php
					
            // First let's check if any of this was set
		
                echo '<ul class="social-icons">';
                
                if (!empty($responsive_options['instagram_uid'])) echo '<li class="instagram-icon"><a href="' . $responsive_options['instagram_uid'] . '" target="_blank">'
                    .'<img src="' . get_stylesheet_directory_uri() . '/core/icons/instagram-icon.png" width="52" height="49" alt="Instagram">'
                    .'</a></li>';
                    
                if (!empty($responsive_options['facebook_uid'])) echo '<li class="facebook-icon"><a href="' . $responsive_options['facebook_uid'] . '" target="_blank">'
                    .'<img src="' . get_stylesheet_directory_uri() . '/core/icons/facebook-icon.png" width="52" height="49" alt="Facebook">'
                    .'</a></li>';
					
                if (!empty($responsive_options['twitter_uid'])) echo '<li class="twitter-icon"><a href="' . $responsive_options['twitter_uid'] . '" target="_blank">'
                    .'<img src="' . get_stylesheet_directory_uri() . '/core/icons/twitter-icon.png" width="52" height="49" alt="Twitter">'
                    .'</a></li>';
  
                if (!empty($responsive_options['linkedin_uid'])) echo '<li class="linkedin-icon"><a href="' . $responsive_options['linkedin_uid'] . '" target="_blank">'
                    .'<img src="' . get_stylesheet_directory_uri() . '/core/icons/linkedin-icon.png" width="52" height="49" alt="LinkedIn">'
                    .'</a></li>';
					
                if (!empty($responsive_options['youtube_uid'])) echo '<li class="youtube-icon"><a href="' . $responsive_options['youtube_uid'] . '" target="_blank">'
                    .'<img src="' . get_stylesheet_directory_uri() . '/core/icons/youtube-icon.png" width="52" height="49" alt="YouTube">'
                    .'</a></li>';
					
                if (!empty($responsive_options['stumble_uid'])) echo '<li class="stumble-upon-icon"><a href="' . $responsive_options['stumble_uid'] . '" target="_blank">'
                    .'<img src="' . get_stylesheet_directory_uri() . '/core/icons/stumble-upon-icon.png" width="52" height="49" alt="StumbleUpon">'
                    .'</a></li>';
					
                if (!empty($responsive_options['rss_uid'])) echo '<li class="rss-feed-icon"><a href="' . $responsive_options['rss_uid'] . '" target="_blank">'
                    .'<img src="' . get_stylesheet_directory_uri() . '/core/icons/rss-feed-icon.png" width="52" height="49" alt="RSS Feed">'
                    .'</a></li>';
       
                if (!empty($responsive_options['google_plus_uid'])) echo '<li class="google-plus-icon"><a href="' . $responsive_options['google_plus_uid'] . '"> target="_blank"'
                    .'<img src="' . get_stylesheet_directory_uri() . '/core/icons/googleplus-icon.png" width="52" height="49" alt="Google Plus">'
                    .'</a></li>';
					
                if (!empty($responsive_options['pinterest_uid'])) echo '<li class="pinterest-icon"><a href="' . $responsive_options['pinterest_uid'] . '"> target="_blank"'
                    .'<img src="' . get_stylesheet_directory_uri() . '/core/icons/pinterest-icon.png" width="52" height="49" alt="Pinterest">'
                    .'</a></li>';
					
                if (!empty($responsive_options['yelp_uid'])) echo '<li class="yelp-icon"><a href="' . $responsive_options['yelp_uid'] . '"> target="_blank"'
                    .'<img src="' . get_stylesheet_directory_uri() . '/core/icons/yelp-icon.png" width="52" height="49" alt="Yelp!">'
                    .'</a></li>';
					
                if (!empty($responsive_options['vimeo_uid'])) echo '<li class="vimeo-icon"><a href="' . $responsive_options['vimeo_uid'] . '">'
                    .'<img src="' . get_stylesheet_directory_uri() . '/core/icons/vimeo-icon.png" width="52" height="49" alt="Vimeo">'
                    .'</a></li>';
					
                if (!empty($responsive_options['foursquare_uid'])) echo '<li class="foursquare-icon"><a href="' . $responsive_options['foursquare_uid'] . '" target="_blank">'
                    .'<img src="' . get_stylesheet_directory_uri() . '/core/icons/foursquare-icon.png" width="52" height="49" alt="foursquare">'
                    .'</a></li>';
             
                echo '</ul><!-- end of .social-icons -->';
         ?>
         </div><!-- end of col-380 fit -->
         
         <?php if (has_nav_menu('sub-header-menu', 'responsive')) { ?>
            <?php wp_nav_menu(array(
			    'container'       => '',
				'menu_class'      => 'sub-header-menu ropa-sans',
				'theme_location'  => 'sub-header-menu')
				); 
			?>
         <?php } ?>
         
         <div id="hide" class="ropa-sans">Hide Menu</div>
         
    </div>
 
    </div><!-- end of #header -->
    <?php responsive_header_end(); // after header container hook ?>
    
	<?php responsive_wrapper(); // before wrapper container hook ?>
    <div id="wrapper" class="clearfix">
		<?php responsive_wrapper_top(); // before wrapper content hook ?>
		<?php responsive_in_wrapper(); // wrapper hook ?>