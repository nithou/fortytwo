<?php

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
Better Quotes Marks
******************************/

remove_filter('the_content', 'wptexturize');
remove_filter('comment_text', 'wptexturize');

/******************************
Avoid bad links
******************************/

add_action( 'the_content', 'fortytwo_bad_formed_links' );
function fortytwo_bad_formed_links( $content ) {
    $badform = array();
    $goodform = array();

    $badform[] = 'href="www.';
    $goodform[] = 'href="http://www.';

    $badform[] = 'href="http//';
    $goodform[] = 'href="http://';

    $badform[] = 'href=" http://';
    $goodform[] = 'href="http://';

    $content = str_replace( $badform, $goodform, $content );
    return $content;
}