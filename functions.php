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
Nithou Login Function
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
Clean Dashboard & add Nithou Support
***************************************/

function fortytwo_remove_dashboard_widgets() {
	// Globalize the metaboxes array, this holds all the widgets for wp-admin
 	global $wp_meta_boxes;

	// Remove the incomming links widget
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);	
	
	// Remove Dashboard Plugins
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);	

	// Remove right now
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
}

// Hoook into the 'wp_dashboard_setup' action to register our function
add_action('wp_dashboard_setup', 'fortytwo_remove_dashboard_widgets' );

// Add custom message in the Dashboard

add_action('wp_dashboard_setup', 'fortytwo_dashboard_widgets');

function fortytwo_dashboard_widgets() {
global $wp_meta_boxes;

wp_add_dashboard_widget('custom_help_widget', 'Nithou Support', 'fortytwo_dashboard_help');
}

function fortytwo_dashboard_help() {
echo '<p>Welcome to your website! If you need any help, I\'ll be glad to help you at <a href="simon@pnithou.net">simon@nithou.net</a></p>';
}

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
Email protection shortcode [mailto]
******************************/

function fortytwo_mail_shortcode( $atts , $content=null ) {
    for ($i = 0; $i < strlen($content); $i++) $encodedmail .= "&#" . ord($content[$i]) . ';'; 
    return '<a href="mailto:'.$encodedmail.'">'.$encodedmail.'</a>';
}
add_shortcode('mailto', 'fortytwo_mail_shortcode');

/******************************
Text only if member [member]
******************************/

function fortytwo_member_check_shortcode( $atts, $content = null ) {
	 if ( is_user_logged_in() && !is_null( $content ) && !is_feed() )
		return $content;
	return '';
}

add_shortcode( 'member', 'fortytwo_member_check_shortcode' );

/******************************
MetaBox for shortcodes instructions
******************************/
add_action( 'add_meta_boxes', 'fortytwo_meta_box_add' );  
function fortytwo_meta_box_add()  
{
add_meta_box( 'fortytwo_meta_box', 'Nithou Shortcodes', 'display_html', 'post', 'side', 'high' );
}

function display_html()
{
	echo '<p>Use <b>[mailto]</b>adress@domain.com<b>[/mailto]</b> to protect your email from spam.</p>';
	echo '<p>Use <b>[member]</b>Your text<b>[/member]</b> to make a text visible only by members.</p>';
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

/************************
ADD NITHOU TO ADMIN BAR
************************/

add_action( 'admin_bar_menu', 'remove_wp_logo', 999 );
function remove_wp_logo( $wp_admin_bar ) {
    $wp_admin_bar->remove_node('wp-logo');
}

add_action( 'admin_bar_menu', 'add_nodes_and_groups_to_toolbar', 999 );

  function add_nodes_and_groups_to_toolbar( $wp_admin_bar ) {
  
    // add Nithou Parent
    $args = array('id' => 'nth_node', 'title' => 'Nithou'); 
    $wp_admin_bar->add_node($args);
    
    // Add link to Nithou
    $args = array('id' => 'nth_web_node', 'title' => 'Website', 'parent' => 'nth_node', 'href' => 'http://www.nithou.net'); 
    $wp_admin_bar->add_node($args);
    
     // Add link to Contact
    $args = array('id' => 'nth_contact_node', 'title' => 'General Conditions', 'parent' => 'nth_node', 'href' => 'http://www.nithou.net/conditions-generales'); 
    $wp_admin_bar->add_node($args);
    
  }

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
    wp_register_script( 'foundation-reveal', 'http://assets.nithou.net/scripts/fnd4/foundation/foundation.alerts.js' ); 
    wp_enqueue_script( 'foundation-reveal', 'jQuery', '1.1', true );
    wp_register_script( 'foundation-reveal', 'http://assets.nithou.net/scripts/fnd4/foundation/foundation.clearing.js' ); 
    wp_enqueue_script( 'foundation-reveal', 'jQuery', '1.1', true );
    wp_register_script( 'foundation-reveal', 'http://assets.nithou.net/scripts/fnd4/foundation/foundation.cookie.js' ); 
    wp_enqueue_script( 'foundation-reveal', 'jQuery', '1.1', true );
    wp_register_script( 'foundation-reveal', 'http://assets.nithou.net/scripts/fnd4/foundation/foundation.dropdown.js' ); 
    wp_enqueue_script( 'foundation-reveal', 'jQuery', '1.1', true );
    wp_register_script( 'foundation-reveal', 'http://assets.nithou.net/scripts/fnd4/foundation/foundation.forms.js' ); 
    wp_enqueue_script( 'foundation-reveal', 'jQuery', '1.1', true );
    wp_register_script( 'foundation-reveal', 'http://assets.nithou.net/scripts/fnd4/foundation/foundation.joyride.js' ); 
    wp_enqueue_script( 'foundation-reveal', 'jQuery', '1.1', true );
    wp_register_script( 'foundation-reveal', 'http://assets.nithou.net/scripts/fnd4/foundation/foundation.magellan.js' ); 
    wp_enqueue_script( 'foundation-reveal', 'jQuery', '1.1', true );
    wp_register_script( 'foundation-reveal', 'http://assets.nithou.net/scripts/fnd4/foundation/foundation.orbit.js' ); 
    wp_enqueue_script( 'foundation-reveal', 'jQuery', '1.1', true );
    wp_register_script( 'foundation-reveal', 'http://assets.nithou.net/scripts/fnd4/foundation/foundation.placeholder.js' ); 
    wp_enqueue_script( 'foundation-reveal', 'jQuery', '1.1', true );
    wp_register_script( 'foundation-reveal', 'http://assets.nithou.net/scripts/fnd4/foundation/foundation.reveal.js' ); 
    wp_enqueue_script( 'foundation-reveal', 'jQuery', '1.1', true );
    wp_register_script( 'foundation-reveal', 'http://assets.nithou.net/scripts/fnd4/foundation/foundation.section.js' ); 
    wp_enqueue_script( 'foundation-reveal', 'jQuery', '1.1', true );
    wp_register_script( 'foundation-reveal', 'http://assets.nithou.net/scripts/fnd4/foundation/foundation.tooltip.js' ); 
    wp_enqueue_script( 'foundation-reveal', 'jQuery', '1.1', true );
    wp_register_script( 'foundation-reveal', 'http://assets.nithou.net/scripts/fnd4/foundation/foundation.topbar.js' ); 
    wp_enqueue_script( 'foundation-reveal', 'jQuery', '1.1', true );
    wp_register_script( 'foundation-app', 'http://assets.nithou.net/scripts/app.js' ); 
    wp_enqueue_script( 'foundation-app', 'jQuery', '1.0', true );
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

################################################################################
// Order required plugins
################################################################################


/**
 * Include the TGM_Plugin_Activation class.
 */
require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'fortytwo_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function fortytwo_register_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// This is an example of how to include a plugin from the WordPress Plugin Repository
		array(
			'name' 		=> 'WP-Piwik',
			'slug' 		=> 'wp-piwik',
			'required' 	=> false,
			'force_activation' => true,
		),
		
		array(
			'name' 		=> 'InfiniteWP Client',
			'slug' 		=> 'iwp-client',
			'required' 	=> false,
			'force_activation' => true,
		),
		
		array(
			'name' 		=> 'Maintenance Mode',
			'slug' 		=> 'maintenance-mode',
			'required' 	=> false,
			'force_activation' => true,
			
		),
		
		array(
			'name' 		=> 'Breadcrumb NavXT',
			'slug' 		=> 'breadcrumb-navxt',
			'required' 	=> false,
			'force_activation' => true,
		),
		

	);

	// Change this to your theme text domain, used for internationalising strings
	$theme_text_domain = 'fourtytwo';

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'domain'       		=> $theme_text_domain,         	// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
		'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> false,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> __( 'Install Required Plugins', $theme_text_domain ),
			'menu_title'                       			=> __( 'Install Plugins', $theme_text_domain ),
			'installing'                       			=> __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
			'oops'                             			=> __( 'Something went wrong with the plugin API.', $theme_text_domain ),
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'                           			=> __( 'Return to Required Plugins Installer', $theme_text_domain ),
			'plugin_activated'                 			=> __( 'Plugin activated successfully.', $theme_text_domain ),
			'complete' 									=> __( 'All plugins installed and activated successfully. %s', $theme_text_domain ), // %1$s = dashboard link
			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);

	tgmpa( $plugins, $config );

}