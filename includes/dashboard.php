<?

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

// Remove Welcome Box
remove_action( 'welcome_panel', 'wp_welcome_panel' );

/***************************************
Nithou Admin Footer
***************************************/

function fortytwo_admin_footer() {
        echo 'Crafted & developed by <a href="http://www.nithou.net">Nithou</a>';
}
add_filter('admin_footer_text', 'fortytwo_admin_footer');