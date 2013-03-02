<!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->

<head>

  <meta charset="<?php bloginfo('charset'); ?>">

  <!-- Set the viewport width to device width for mobile -->
  <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">

  <title><?php wp_title('|',true,'right'); ?><?php bloginfo('name'); ?></title>
  
  <link rel="profile" href="http://gmpg.org/xfn/11" />
  
  <!-- ENQUEUE COMMENTS -->
  <?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
  
  <!-- INCLUDE JQUERY -->
  <?php wp_enqueue_script("jquery"); ?>
  
  <!-- INCLUDE WORDPRESS INJECTION -->
  <?php wp_head(); ?>
  
  <!-- INCLUDE FAVICON & APPLE ICON -->
  
  <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico?v=3">
  <link rel="apple-touch-icon-precomposed" href="<?php echo get_stylesheet_directory_uri(); ?>/apple-touch-icon.png">
  
  <!-- startup image for web apps - iPad - landscape (748x1024) 
     Note: iPad landscape startup image has to be exactly 748x1024 pixels (portrait, with contents rotated).-->
     <link rel="apple-touch-startup-image" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)" href="<?php echo get_stylesheet_directory_uri(); ?>/startup_ipad.png"/>

  <!-- startup image for web apps - iPad - portrait (768x1004) -->
  <link rel="apple-touch-startup-image" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)" href="<?php echo get_stylesheet_directory_uri(); ?>/startup_ipad_portrait.png"/>
  
  <!-- RETINA IPAD -->
  <link rel="apple-touch-startup-image" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape) and (-webkit-min-device-pixel-ratio: 2)" href="<?php echo get_stylesheet_directory_uri(); ?>/startup_ipad_retina.png"/>

  <!-- iPhone -->
  <link rel="apple-touch-startup-image" media="(device-width: 320px)" href="<?php echo get_stylesheet_directory_uri(); ?>/startup.png">
  <!-- iPhone (Retina) -->
  <link rel="apple-touch-startup-image" media="(device-width: 320px) and (-webkit-device-pixel-ratio: 2)" href="<?php echo get_stylesheet_directory_uri(); ?>/startup-retina.png">
      
  
  <!-- WEBAPP MODE -->
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />

  <!-- Included Foundation CSS Files -->
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/stylesheets/foundation.min.css">
  
  <!-- WORDPRESS DEFAULTS REBUILD -->
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/stylesheets/wp.css">
  
  <!--[if lt IE 9]>
    <link rel="stylesheet" href="stylesheets/ie.css">
  <![endif]-->
  
  <!-- INJECT THEME STYLESHEET -->
  <link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>">

  <!-- IE Fix for HTML5 Tags -->
  <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
 
  
  <!-- OPENGRAPH META -->
	
	<?php if (have_posts()):while(have_posts()):the_post(); endwhile; endif;?>  
	  
	<!-- if page is content page -->  
	<?php if (is_single()) { ?>  
	<meta property="og:url" content="<?php the_permalink() ?>"/>  
	<meta property="og:description" content="<?php echo strip_tags(get_the_excerpt($post->ID)); ?>" />  
	<meta property="og:type" content="article" />  
	<meta property="og:image" content="<?php if (function_exists('wp_get_attachment_thumb_url')) {echo wp_get_attachment_thumb_url(get_post_thumbnail_id($post->ID)); }?>" />  
	  
	<!-- if page is others -->  
	<?php } else { ?>  
	<meta property="og:site_name" content="<?php bloginfo('name'); ?>" />  
	<meta property="og:description" content="<?php bloginfo('description'); ?>" />  
	<meta property="og:type" content="website" />  
	<meta property="og:image" content="<?php echo get_stylesheet_directory_uri(); ?>/logo.png" /> <?php } ?>  
  
  <!-- JAVASCRIPT FIX ALLOWING ZOOM ON HANDLED DEVICES -->
  <script type="text/javascript">
		(function(doc) {

		 var addEvent = 'addEventListener',
		     type = 'gesturestart',
		     qsa = 'querySelectorAll',
		     scales = [1, 1],
		     meta = qsa in doc ? doc[qsa]('meta[name=viewport]') : [];
		 function fix() {
		  meta.content = 'width=device-width,minimum-scale=' + scales[0] + ',maximum-scale=' + scales[1];
		  doc.removeEventListener(type, fix, true);
		 }
		 if ((meta = meta[meta.length - 1]) && addEvent in doc) {
		  fix();
		  scales = [.25, 1.6];
		  doc[addEvent](type, fix, true);
		 }
		}(document));
	</script>
	
	<!-- ALLOW PINGBACK -->
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	
	<?php get_template_part('inject','header'); ?>

</head>

<!-- SPEED UP WORDPRESS BY SENDING HEADER FIRST -->
<?php flush(); ?>

<body <?php body_class('off-canvas slide-nav');?> >