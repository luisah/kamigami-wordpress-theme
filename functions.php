<?php
/**
 * A safe way of adding javascripts to a WordPress generated page.
 */
if (!is_admin())
    add_action('wp_enqueue_scripts', 'responsive_child_js');

if (!function_exists('responsive_child_js')) {

    function responsive_child_js () {
        // JavaScript at the bottom for fast page loading.
		  wp_enqueue_script('images-loaded', get_stylesheet_directory_uri() . '/js/imagesloaded.pkgd.min.js', array('jquery'), true);
        wp_enqueue_script('masonry', get_stylesheet_directory_uri() . '/js/masonry.pkgd.min.js', array('jquery'), true);
        wp_enqueue_script('jcarousel', get_stylesheet_directory_uri() . '/js/jquery.jcarousel.min.js', array('jquery'), true);
        wp_enqueue_script('script', get_stylesheet_directory_uri() . '/js/script.js', array('jquery', 'images-loaded', 'masonry', 'jcarousel'), true);
    }

}

/**
 * WooCommerce
 *
 * Unhook sidebar
 */
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

/**
 * WooCommerce
 *
 * Unhook/Hook the WooCommerce Wrappers
 */

function responsive_child_theme_setup() {
    remove_action('woocommerce_before_main_content', 'responsive_woocommerce_wrapper', 10);
    remove_action('woocommerce_after_main_content', 'responsive_woocommerce_wrapper_end', 10);

    add_action('woocommerce_before_main_content', 'responsive_child_woocommerce_wrapper', 10);
    add_action('woocommerce_after_main_content', 'responsive_child_woocommerce_wrapper_end', 10);
 
    function responsive_child_woocommerce_wrapper() {
      echo '<div id="content-woocommerce" class="grid col-940">';
    }
 
    function responsive_child_woocommerce_wrapper_end() {
      echo '</div><!-- end of #content-woocommerce -->';
    }
}

add_action( 'after_setup_theme', 'responsive_child_theme_setup' );

/**
 * Breadcrumb Lists
 * Allows visitors to quickly navigate back to a previous section or the root page.
 *
 * Adopted from Dimox
 *
 */
if (!function_exists('responsive_breadcrumb_lists')) :

function responsive_breadcrumb_lists() {

	/* === OPTIONS === */
	$text['home']     = __('Home','responsive'); // text for the 'Home' link
	$text['category'] = __('%s','responsive'); // text for a category page
	$text['search']   = __('Search results for: %s','responsive'); // text for a search results page
	$text['tag']      = __('Posts tagged %s','responsive'); // text for a tag page
	$text['author']   = __('View all posts by %s','responsive'); // text for an author page
	$text['404']      = __('Error 404','responsive'); // text for the 404 page

	$showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
	$showOnHome  = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
	$delimiter   = ' <span class="chevron">&#8250;</span> '; // delimiter between crumbs
	$before      = '<span class="breadcrumb-current">'; // tag before the current crumb
	$after       = '</span>'; // tag after the current crumb
	/* === END OF OPTIONS === */

	global $post, $paged, $page;
	$homeLink = home_url('/');
	$linkBefore = '<span class="breadcrumb" typeof="v:Breadcrumb">';
	$linkAfter = '</span>';
	$linkAttr = ' rel="v:url" property="v:title"';
	$link = $linkBefore . '<a' . $linkAttr . ' href="%1$s">%2$s</a>' . $linkAfter;

	if ( is_front_page()) {

		if ($showOnHome == 1) echo '<div class="breadcrumb-list"><a href="' . $homeLink . '">' . $text['home'] . '</a></div>';

	} else {

		echo '<div class="breadcrumb-list" xmlns:v="http://rdf.data-vocabulary.org/#">' . sprintf($link, $homeLink, $text['home']) . $delimiter;

		if ( is_home() ) {
			if ($showCurrent == 1) echo $before . get_the_title( get_option('page_for_posts', true) ) . $after;

		} elseif ( is_category() ) {
			$thisCat = get_category(get_query_var('cat'), false);
			if ($thisCat->parent != 0) {
				$cats = get_category_parents($thisCat->parent, true, $delimiter);
				$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
				$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
				echo $cats;
			}
			echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;

		} elseif ( is_search() ) {
			echo $before . sprintf($text['search'], get_search_query()) . $after;

		} elseif ( is_day() ) {
			echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
			echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
			echo $before . get_the_time('d') . $after;

		} elseif ( is_month() ) {
			echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
			echo $before . get_the_time('F') . $after;

		} elseif ( is_year() ) {
			echo $before . get_the_time('Y') . $after;

		} elseif ( is_single() && !is_attachment() ) {
			if ( get_post_type() != 'post' ) {
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				printf($link, $homeLink . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);
				if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;
			} else {
				$cat = get_the_category(); $cat = $cat[0];
				$cats = get_category_parents($cat, true, $delimiter);
				if ($showCurrent == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
				$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
				$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
				echo $cats;
				if ($showCurrent == 1) echo $before . get_the_title() . $after;
			}

		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
			$post_type = get_post_type_object(get_post_type());
			echo $before . $post_type->labels->singular_name . $after;

		} elseif ( is_attachment() ) {
			$parent = get_post($post->post_parent);
			$cat = get_the_category($parent->ID); $cat = $cat[0];
			$cats = get_category_parents($cat, true, $delimiter);
			$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
			$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
			echo $cats;
			printf($link, get_permalink($parent), $parent->post_title);
			if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;

		} elseif ( is_page() && !$post->post_parent ) {
			if ($showCurrent == 1) echo $before . get_the_title() . $after;

		} elseif ( is_page() && $post->post_parent ) {
			$parent_id  = $post->post_parent;
			$breadcrumbs = array();
			while ($parent_id) {
				$page_child = get_page($parent_id);
				$breadcrumbs[] = sprintf($link, get_permalink($page_child->ID), get_the_title($page_child->ID));
				$parent_id  = $page_child->post_parent;
			}
			$breadcrumbs = array_reverse($breadcrumbs);
			for ($i = 0; $i < count($breadcrumbs); $i++) {
				echo $breadcrumbs[$i];
				if ($i != count($breadcrumbs)-1) echo $delimiter;
			}
			if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;

		} elseif ( is_tag() ) {
			echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;

		} elseif ( is_author() ) {
	 		global $author;
			$userdata = get_userdata($author);
			echo $before . sprintf($text['author'], $userdata->display_name) . $after;

		} elseif ( is_404() ) {
			echo $before . $text['404'] . $after;

		}if ( get_query_var('paged') ) {
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
			echo $delimiter . sprintf( __( 'Page %s', 'responsive' ), max( $paged, $page ) );
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
		}

		echo '</div>';

	}
} // end responsive_breadcrumb_lists

endif;

?>