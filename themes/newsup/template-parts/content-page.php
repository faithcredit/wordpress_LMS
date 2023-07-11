<?php if( class_exists('woocommerce') && (is_account_page() || is_cart() || is_checkout())) { ?>
	<div class="col-md-12 mg-card-box padding-20">
		<?php if (have_posts()) {  while (have_posts()) : the_post(); ?>
		<?php the_content(); endwhile; } } else {?>
			<div class="col-md-8">
				<div class="mg-card-box padding-20">
					<?php while ( have_posts() ) : the_post(); 
	            	  the_post_thumbnail( '', array( 'class'=>'img-responsive' ) );
					  the_content();
					
						wp_link_pages(array(
				        	'before' => '<div class="link btn-theme">' . esc_html__('Pages:', 'newsup'),
				        	'after' => '</div>',
	    				));
					
					   	endwhile;
					   	newsup_edit_link();

						if (comments_open() || get_comments_number()) :
		                  comments_template();
		                 endif;
						?>	
				</div>
			</div>
			<!--Sidebar Area-->
			<aside class="col-md-4">
				<?php get_sidebar(); ?>
			</aside>
			<?php } ?>
			<!--Sidebar Area-->
	</div>