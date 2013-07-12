<?php

/* Buttons */
function buttons( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'type' => 'radius', /* radius, round */
	'size' => 'medium', /* small, medium, large */
	'color' => 'blue',
	'nice' => 'false',
	'url'  => '',
	'text' => '', 
	), $atts ) );
	
	$output = '<a href="' . $url . '" class="button '. $type . ' ' . $size . ' ' . $color;
	if( $nice == 'true' ){ $output .= ' nice';}
	$output .= '">';
	$output .= $text;
	$output .= '</a>';
	
	return $output;
}

add_shortcode('button', 'buttons'); 

?>