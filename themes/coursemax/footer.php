<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package coursemax
 */

$coursemax_options = coursemax_theme_options();

$show_prefooter = $coursemax_options['show_prefooter'];

?>

<footer id="colophon" class="site-footer">


	<?php if ($show_prefooter== 1){ ?>
	    <section class="footer-sec">
	        <div class="container">
	            <div class="row">
	                <?php if (is_active_sidebar('coursemax_footer_1')) : ?>
	                    <div class="col-md-4">
	                        <?php dynamic_sidebar('coursemax_footer_1') ?>
	                    </div>
	                    <?php
	                else: coursemax_blank_widget();
	                endif; ?>
	                <?php if (is_active_sidebar('coursemax_footer_2')) : ?>
	                    <div class="col-md-4">
	                        <?php dynamic_sidebar('coursemax_footer_2') ?>
	                    </div>
	                    <?php
	                else: coursemax_blank_widget();
	                endif; ?>
	                <?php if (is_active_sidebar('coursemax_footer_3')) : ?>
	                    <div class="col-md-4">
	                        <?php dynamic_sidebar('coursemax_footer_3') ?>
	                    </div>
	                    <?php
	                else: coursemax_blank_widget();
	                endif; ?>
	            </div>
	        </div>
	    </section>
	<?php } ?>

		<div class="site-info">
		<p><?php esc_html_e('Powered By WordPress', 'coursemax');
                    esc_html_e(' | ', 'coursemax') ?>
					<span><a target="_blank" href="https://www.flawlessthemes.com/theme/coursemax-best-online-course-wordpress-theme/"><?php esc_html_e('Coursemax' , 'coursemax'); ?></a></span>
                </p> 
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
