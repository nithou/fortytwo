<aside id="sidebar">
	
	<?php if ( is_active_sidebar( 'primary-widget-area' ) ) : ?>
	
		<?php if ( function_exists('dynamic_sidebar') ) dynamic_sidebar( 'primary-widget-area' ); ?>
		
				
	<?php else : ?>
	
		<p><?php _e('No Sidebar defined'); ?></p>
		
	<?php endif; ?>
</aside>
