<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Loop Header Template-Part File
 *
 * @file           loop-header.php
 * @package        Responsive 
 * @author         Emil Uzelac 
 * @copyright      2003 - 2013 ThemeID
 * @license        license.txt
 * @version        Release: 1.1.0
 * @filesource     wp-content/themes/responsive/loop-header.php
 * @link           http://codex.wordpress.org/Templates
 * @since          available since Release 1.0
 */

/**
 * Globalize Theme Options
 */
global $responsive_options;
$responsive_options = responsive_get_options(); 

/**
 * Display breadcrumb
 */
if ( 0 == $responsive_options['breadcrumb'] ) :
	echo responsive_breadcrumb_lists();
endif; 

/**
 * Display archive information
 */

if ( is_category() || is_tag() || is_author() || is_date() ) {
	?>
	<h6 class="title-archive codename"><?php single_cat_title(); ?></h6>
	<?php
}