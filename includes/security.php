<?

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