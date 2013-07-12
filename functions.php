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

/***************************************
Clean Dashboard
***************************************/

function fortytwo_remove_dashboard_widgets() {
	// Globalize the metaboxes array, this holds all the widgets for wp-admin
 	global $wp_meta_boxes;

  // Remove the incomming links widget
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
	
	// Remove Dashboard Plugins
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);

	// Remove right now
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
}

// Hoook into the 'wp_dashboard_setup' action to register our function
add_action('wp_dashboard_setup', 'fortytwo_remove_dashboard_widgets' );

/***************************************
Nithou Admin Footer
***************************************/

function fortytwo_admin_footer() {
        echo 'Crafted & developed by <a href="http://www.nithou.net">Nithou</a>';
} 
add_filter('admin_footer_text', 'fortytwo_admin_footer');

/******************************
Allow Shortcodes in Widgets
******************************/

if ( !is_admin() ){
    add_filter('widget_text', 'do_shortcode', 11);
}

/******************************
Better Quotes Marks
******************************/

remove_filter('the_content', 'wptexturize');
remove_filter('comment_text', 'wptexturize');

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
Remove for security)
******************************/

remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);

function fortytwo_remove_version() {
	return '';
}
add_filter('the_generator', 'fortytwo_remove_version');

/******************************
Autoclean editor by closing tags
******************************/

function clean_bad_content($bPrint = false) {
 global $post;
 $szPostContent  = $post->post_content;
 $szRemoveFilter = array("~<p[^>]*>\s?</p>~", "~<a[^>]*>\s?</a>~", "~<font[^>]*>~", "~<\/font>~", "~style\=\"[^\"]*\"~", "~<span[^>]*>\s?</span>~");
 $szPostContent  = preg_replace($szRemoveFilter, '', $szPostContent);
 $szPostContent  = apply_filters('the_content', $szPostContent);
 if ($bPrint == false) return $szPostContent; 
 else echo $szPostContent;
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

/**************
Notifications fix
***************/

function update_active_plugins($value = '') {
    /*
    The $value array passed in contains the list of plugins with time
    marks when the last time the groups was checked for version match
    The $value->reponse node contains an array of the items that are
    out of date. This response node is use by the 'Plugins' menu
    for example to indicate there are updates. Also on the actual
    plugins listing to provide the yellow box below a given plugin
    to indicate action is needed by the user.
    */
    if ((isset($value->response)) && (count($value->response))) {

        // Get the list cut current active plugins
        $active_plugins = get_option('active_plugins');    
        if ($active_plugins) {

            //  Here we start to compare the $value->response
            //  items checking each against the active plugins list.
            foreach($value->response as $plugin_idx => $plugin_item) {

                // If the response item is not an active plugin then remove it.
                // This will prevent WordPress from indicating the plugin needs update actions.
                if (!in_array($plugin_idx, $active_plugins))
                    unset($value->response[$plugin_idx]);
            }
        }
        else {
             // If no active plugins then ignore the inactive out of date ones.
            foreach($value->response as $plugin_idx => $plugin_item) {
                unset($value->response);
            }          
        }
    }  
    return $value;
}
add_filter('transient_update_plugins', 'update_active_plugins');

/******************************
Remove Auto Ping
******************************/

function no_self_ping( &$links ) {
    $home = get_option( 'home_url' );
    foreach ( $links as $l => $link )
        if ( 0 === strpos( $link, $home ) )
            unset($links[$l]);
}
add_action( 'pre_ping', 'no_self_ping' );



################################################################################
// Comment formatting
################################################################################

function theme_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
   	<li>
     <article <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
       <header class="comment-author vcard">
          <?php echo get_avatar($comment,$size='48',$default='<path_to_url>' ); ?>
          <?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
          <time><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s','fortytwo'), get_comment_date(),  get_comment_time()) ?></a></time>
          <?php edit_comment_link(__('(Edit)','fortytwo'),'  ','') ?>
       </header>
       <?php if ($comment->comment_approved == '0') : ?>
          <em><?php _e('Your comment is awaiting moderation.','fortytwo') ?></em>
          <br />
       <?php endif; ?>

       <?php comment_text() ?>

       <nav>
         <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
       </nav>
     </article>
    <!-- </li> is added by wordpress automatically -->
    <?php
}

/************* ENQUEUE JS *************************/

/* Load Foundation Scripts */

function foundation_js(){
    wp_register_script( 'foundation-reveal', 'http://assets.nithou.net/scripts/fnd4/foundation/foundation.forms.js' ); 
    wp_enqueue_script( 'foundation-reveal', 'jQuery', '1.1', true );
    wp_register_script( 'foundation-reveal', 'http://assets.nithou.net/scripts/fnd4/foundation/foundation.placeholder.js' ); 
    wp_enqueue_script( 'foundation-reveal', 'jQuery', '1.1', true );
}

add_action('wp_enqueue_scripts', 'foundation_js');

function wp_foundation_js(){
    wp_register_script( 'wp-foundation-js', 'http://assets.nithou.net/scripts/fnd4/foundation.min.js', 'jQuery', '', true);
    wp_enqueue_script( 'wp-foundation-js' );
}

add_action('wp_enqueue_scripts', 'wp_foundation_js');


/* Call jquery in the footer */

function my_init() {
	if (!is_admin()) {
		wp_deregister_script('jquery');

		// load the local copy of jQuery in the footer
		wp_register_script('jquery', '/wp-includes/js/jquery/jquery.js', false, '1.8.3', true);

		wp_enqueue_script('jquery');
	}
}
add_action('init', 'my_init');
