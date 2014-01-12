<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Blog Template
 *
 * @file           home.php
 * @package        Responsive 
 * @author         Emil Uzelac 
 * @copyright      2003 - 2013 ThemeID
 * @license        license.txt
 * @version        Release: 1.1.0
 * @filesource     wp-content/themes/responsive/home.php
 * @link           http://codex.wordpress.org/Templates
 * @since          available since Release 1.0
 */

get_header(); 

global $more; $more = 0; 
?>

<div id="content-blog" class="<?php echo implode( ' ', responsive_get_content_classes() ); ?>">
      
</div><!-- end of #content-blog -->

<?php get_footer('home'); ?>