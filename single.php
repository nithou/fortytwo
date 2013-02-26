<?php get_header();?>

  <div class="row">
    <div class="twelve columns">
      <h2><a href="<?php bloginfo('url'); ?>/">Welcome to Nithou's 42 Framework</a></h2>
      <nav id="main-nav" role="navigation"><?php wp_nav_menu( array( 'container_class' => 'header-menu', 'theme_location' => 'primary' ) ); ?></nav>
      
      <!-- ACTIVATE SOCIAL MEDIAS ICONS FROM WEBSITE OWNER -->
      <?php get_template_part('add','social'); ?>
      
      <hr />
    </div>
  </div>

  <div class="row">
    <div class="eight columns">
      <h3>The Loop</h3>

      <!-- The Default Loop -->
      <div class="row">
        <div class="twelve columns">

			 <?php get_template_part('loop','single'); ?>
			 
        </div>
      </div>
    </div>

     
    <div class="four columns">
	    <h3>The Sidebar</h3>
	    <?php get_sidebar(); ?>
	</div>

  </div>

<?php get_footer(); ?>
