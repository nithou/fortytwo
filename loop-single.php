<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			
	<article>

		<?php get_template_part('add','breadcrumbs'); ?> <!-- ACTIVE ONLY IF BREADCRUMB NAVXT IS INSTALLED -->
		<!-- Display the Title as a link to the Post's permalink. -->
		 <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Link to'); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
		 
		 <!-- Display the date (November 16th, 2009 format) and a link to other posts by this posts author. -->
		 <p><?php _e('Posted in');?> <?php the_category(', '); ?> <?php _e('the');?> <?php the_time('F jS, Y') ?> <?php _e('by');?> <?php the_author_posts_link() ?></p>
		
		 <!-- Display the Post's Content in a div box. -->
		 <div class="entry">
		   <?php the_content(); ?>
		 </div>
		
		<?php get_template_part('add','sharing'); ?>
		      
	 <!-- Display a comma separated list of the Post's Categories. -->
	 </article> <!-- closes the first div box -->
	 
	 <!-- CALL THE COMMENTS TEMPLATE -->
	 <?php comments_template(); ?> 
	
	 <!-- Stop The Loop (but note the "else:" - see next line). -->
	 <?php endwhile; else: ?>
	
	 <!-- The very first "if" tested to see if there were any Posts to -->
	 <!-- display.  This "else" part tells what do if there weren't any. -->
	 <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
	
	 <!-- REALLY stop The Loop. -->
		 
<?php endif; ?>