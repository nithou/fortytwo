<?php get_header();?>

  <div class="row">
    <div class="twelve columns">
      <h2><a href="<?php bloginfo('url'); ?>/"><?php bloginfo('name'); ?></a></h2>
      <nav id="main-nav" role="navigation"><?php wp_nav_menu( array( 'container_class' => 'header-menu', 'theme_location' => 'primary' ) ); ?></nav>

    </div>
  </div>

  <div class="row">
    <div class="eight columns">

      <!-- The Default Loop -->
      <div class="row">
        <div class="twelve columns">

			 <?php get_template_part('loop','single'); ?>
			 
        </div>
      </div>
    </div>

     
    <div class="four columns">
	    <?php get_sidebar(); ?>
	</div>

  </div>

<?php get_footer(); ?>
