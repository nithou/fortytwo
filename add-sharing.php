<aside class="sharing">

	<!-- PAY ATTENTION THAT SHARING ICONS ARE DOWNSIZED FOR RETINA DISPLAY -->

	<!-- FACEBOOK -->
	<a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>&t=<?php the_title(); ?>" target="_blank" title="<?php _e('Share This on Facebook');?>">
		<img width="40" title="<?php _e('Share This on Facebook');?>" src="<?php echo get_stylesheet_directory_uri(); ?>/images/sharing-icons/facebook.png" alt="<?php _e('Share This on Facebook');?>" />
	</a>
	
	<!-- TWITTER /!\ CHANGE TWITTER NICKNAME - NITHOU-->
	<a href="http://twitter.com/share?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>&via=nithou" target="_blank" alt="<?php _e('Tweet This');?>" title="<?php _e('Tweet This');?>">
		<img width="40" src="<?php echo get_stylesheet_directory_uri(); ?>/images/sharing-icons/twitter.png" alt="Tweet This" title="<?php _e('Tweet This');?>">
	</a>
	
	<!-- LINKEDIN -->
	<a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=<?php the_title(); ?>" target="_blank" title="<?php _e('Share This on LinkedIn'); ?>">
		<img width="40" title="<?php _e('Share This on LinkedIn'); ?>" src="<?php echo get_stylesheet_directory_uri(); ?>/images/sharing-icons/linkedin.png" alt="<?php _e('Share This on LinkedIn'); ?>" />
	</a>
	
	<!-- GOOGLE+ -->
	<a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" target="_blank" title="<?php _e('Post it on Google+'); ?>">
		<img width="40" title="<?php _e('Post it on Google+'); ?>" src="<?php echo get_stylesheet_directory_uri(); ?>/images/sharing-icons/googleplus.png" alt="<?php _e('Post it on Google+'); ?>" />
	</a>

</aside>