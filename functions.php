<?php

// Adding Translation Option
load_theme_textdomain( 'fortytwo', TEMPLATEPATH.'/languages' );

// ADDING THEME SUPPORT */

add_theme_support( 'automatic-feed-links' );
add_theme_support( 'nav-menus' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'menus' );
add_theme_support( 'custom-background' );

// ADDING A PRIMARY NAVIGATION */
register_nav_menus( array(
	'primary' => __( 'Header Menu','fortytwo'),
) );

// RIGHT SIDEBAR

register_sidebar(array(
  'name' => __( 'Right Sidebar','fortytwo'),
  'id' => 'right-sidebar',
  'description' => __( 'Widgets in this area will be shown on the right-hand side.','fortytwo' ),
  'before_title' => '<h1>',
  'after_title' => '</h1>'
));

// Ensure maximum image size

if ( ! isset( $content_width ) ) $content_width = 980;

/************************
Revamp Login Function
************************/

function fortytwo_custom_login_style() {
    echo '<link rel="stylesheet" type="text/css" href="http://nithou.net/assets/login.css" />';
}
add_action('login_head', 'fortytwo_custom_login_style');

/************************
Set post revisions to 10 versions
************************/

if (!defined('WP_POST_REVISIONS')) define('WP_POST_REVISIONS', 10);

/******************************
Allow Shortcodes in Widgets
******************************/

if ( !is_admin() ){
    add_filter('widget_text', 'do_shortcode', 11);
}

/******************************
Allow html in user profile
******************************/

remove_filter('pre_user_description', 'wp_filter_kses');

/******************************
Update Author Informations
******************************/

add_filter('user_contactmethods','hide_profile_fields',10,1);

function hide_profile_fields( $contactmethods ) {
	unset($contactmethods['aim']);
	unset($contactmethods['jabber']);
	unset($contactmethods['yim']);
	return $contactmethods;
}

function fortytwo_contactmethods( $contactmethods ) {

// 	Add Twitter
$contactmethods['twitter'] = 'Twitter';

//	Add Facebook
$contactmethods['facebook'] = 'Facebook';

//  Add Linkedin
$contactmethods['linkedin'] = 'Linkedin';

//  Add Google+
$contactmethods['gplus'] = 'Google+';

return $contactmethods;
}
add_filter('user_contactmethods','fortytwo_contactmethods',10,1);

/******************************
 REMOVE WP ICON FROM HEADER BAR
 ******************************/

add_action( 'admin_bar_menu', 'remove_wp_logo', 999 );
function remove_wp_logo( $wp_admin_bar ) {
    $wp_admin_bar->remove_node('wp-logo');
}


/******************************
Dynamic Copyright
******************************/

function dynamic_copyright() {
	global $wpdb;
	$copyright_dates = $wpdb->get_results("
	SELECT
		YEAR(min(post_date_gmt)) AS firstdate,
		YEAR(max(post_date_gmt)) AS lastdate
	FROM
		$wpdb->posts
	WHERE
		post_status = 'publish'
		");
		$output = '';
		if($copyright_dates) {
			$copyright = "&copy; " . $copyright_dates[0]->firstdate;
			if($copyright_dates[0]->firstdate != $copyright_dates[0]->lastdate) {
				$copyright .= '-' . $copyright_dates[0]->lastdate;
		}
		$output = $copyright;
		}
return $output;
}


/************* ENQUEUE JS *************************/

function fortytwo_enqueue_scripts() {
       wp_deregister_script('jquery');
       wp_register_script('jquery', ("http://code.jquery.com/jquery-latest.min.js"), false, '1.10.2');
       wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'fortytwo_enqueue_scripts');


if ( ! function_exists( 'foundation_assets' ) ) :

function foundation_assets() {

  if (!is_admin()) {

    // Load JavaScripts
    wp_enqueue_script( 'foundation', '//cdn.jsdelivr.net/foundation/5.0.0/js/foundation/foundation.js', null, '4.0', true );

  }

}

add_action( 'wp_enqueue_scripts', 'foundation_assets' );

endif;

/**
 * Initialise Foundation JS
 * @see: http://foundation.zurb.com/docs/javascript.html
 */

if ( ! function_exists( 'foundation_js_init' ) ) :

function foundation_js_init () {
    echo '<script>$(document).foundation();</script>';
}

add_action('wp_footer', 'foundation_js_init', 50);

endif;

include get_template_directory() .'/includes/comments.php';
include get_template_directory() .'/includes/security.php';
include get_template_directory() .'/includes/dashboard.php';
include get_template_directory() .'/includes/content.php';