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
  
  <!-- ENQUEUE -->
  <?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
  <?php wp_enqueue_script("jquery"); ?>
  
  <!-- INCLUDE FAVICON -->
  
  <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico?v=3">
  
  <!-- INJECT THEME STYLESHEET -->
  <link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>">

    <!--[if lt IE 9]>
    <link rel="stylesheet" href="stylesheets/ie.css">
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  	<![endif]-->
  
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
  
  <!-- INCLUDE WORDPRESS INJECTION -->
  <?php wp_head(); ?>
  
</head>

<!-- SPEED UP WORDPRESS BY SENDING HEADER FIRST -->
<?php flush(); ?>

<body <?php body_class();?> >