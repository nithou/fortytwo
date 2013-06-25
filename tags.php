<?php get_header();?>

  <div class="row">
    <div class="small-1 large-12 columns">
      <h2><a href="<?php echo home_url(''); ?>"><?php bloginfo('name'); ?></a></h2>
      <nav id="main-nav" role="navigation"><?php wp_nav_menu( array( 'container_class' => 'header-menu', 'theme_location' => 'primary' ) ); ?></nav>

    </div>
  </div>

  <div class="row">
    <div class="small-1 large-8 columns">

      <!-- The Default Loop -->
      <div class="row">
        <div class="small-1 large-12 columns">

			 <?php get_template_part('loop','excerpt'); ?>
			 
        </div>
      </div>
    </div>

     
    <div class="small-1 large-4 columns">
	    <?php get_sidebar(); ?>
	</div>

  </div>

<?php get_footer(); ?>
