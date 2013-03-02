<?php

// Adding Translation Option
load_theme_textdomain( 'fortytwo', TEMPLATEPATH.'/languages' );
$locale = get_locale();
$locale_file = TEMPLATEPATH."/languages/$locale.php";
if ( is_readable($locale_file) ) require_once($locale_file);

// ADDING THEME SUPPORT */

add_theme_support( 'automatic-feed-links' );
add_theme_support( 'nav-menus' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'menus' );

// ADDING A PRIMARY NAVIGATION */
register_nav_menus( array(
	'primary' => __( 'Header Menu' ),
) );

/******************************/
// Inject OpenGraph
/******************************/

function add_opengraph_doctype( $output ) {
		return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
	}
add_filter('language_attributes', 'add_opengraph_doctype');

// Ensure maximum image size 

if ( ! isset( $content_width ) ) $content_width = 980;

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
          <time><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a></time>
          <?php edit_comment_link(__('(Edit)'),'  ','') ?>
       </header>
       <?php if ($comment->comment_approved == '0') : ?>
          <em><?php _e('Your comment is awaiting moderation.') ?></em>
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


################################################################################
// Order required plugins
################################################################################


/**
 * Include the TGM_Plugin_Activation class.
 */
require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );
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
function my_theme_register_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// This is an example of how to include a plugin pre-packaged with a theme
				
		array(
			'name'     				=> 'Nithou Plugin', // The plugin name
			'slug'     				=> 'nithou-plugin', // The plugin slug (typically the folder name)
			'source'   				=> 'https://github.com/nithou/Nithou-Plugin/archive/master.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'force_activation' 		=> true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> 'http://www.nithou.net', // If set, overrides default API URL and points to an external URL
		),


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
	$theme_text_domain = 'tgmpa';

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