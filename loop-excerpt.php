<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			
	<article>

		<!-- Display the Title as a link to the Post's permalink. -->
		 <h2 itemprop="headline"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Link to','fortytwo'); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
		
		 <!-- Display the Post's Content in a div box. -->
		 <div class="entry" itemprop="articleBody">
		   <?php the_excerpt(); ?>
		 </div>
		
	 <!-- Display a comma separated list of the Post's Categories. -->
	 </article> <!-- closes the first div box -->
	
	 <!-- Stop The Loop (but note the "else:" - see next line). -->
	 <?php endwhile; else: ?>
	
	 <!-- The very first "if" tested to see if there were any Posts to -->
	 <!-- display.  This "else" part tells what do if there weren't any. -->
	 <p><?php _e('Sorry, no posts matched your criteria.','fortytwo'); ?></p>
	
	 <!-- REALLY stop The Loop. -->
		 
<?php endif; ?>