<?php
namespace ElementorWidgetsMegaPack\Widgets;

use \Elementor\Controls_Manager as Controls_Manager;
use \Elementor\Frontend;
use \Elementor\Group_Control_Border as Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow as Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography as Group_Control_Typography;
use \Elementor\Utils as Utils;
use \Elementor\Widget_Base as Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor News Ticker
 *
 * Elementor widget for news ticker
 *
 * @since 1.0.0
 */
class Mega_News_Ticker extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'emp-mega-news-ticker';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'News Ticker', 'elementorwidgetsmegapack' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-slideshow';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'ewmp-category' ];
	}


	/**
	 * Get post type categories.
	 */
	private function grid_get_all_post_type_categories( $post_type ) {
		$options = array();

		if ( $post_type == 'post' ) {
			$taxonomy = 'category';
		} else {
			$taxonomy = $post_type;
		}

		if ( ! empty( $taxonomy ) ) {
			// Get categories for post type.
			$terms = get_terms(
				array(
					'taxonomy'   => $taxonomy,
					'hide_empty' => false,
				)
			);
			if ( ! empty( $terms ) ) {
				foreach ( $terms as $term ) {
					if ( isset( $term ) ) {
						if ( isset( $term->slug ) && isset( $term->name ) ) {
							$options[ $term->slug ] = $term->name;
						}
					}
				}
			}
		}

		return $options;
	}


	/**
	 * Get post type categories.
	 */
	private function grid_get_all_custom_post_types() {
		$options = array();

		$args = array( '_builtin' => false );
		$post_types = get_post_types( $args, 'objects' ); 

		foreach ( $post_types as $post_type ) {
			if ( isset( $post_type ) ) {
					$options[ $post_type->name ] = $post_type->label;
			}
		}

		return $options;
	}



	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'widget_scripts' ];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'elementorwidgetsmegapack' ),
			]
		);

		$this->add_control(
			'vcmp_newsticker_type',
			[
				'label' => esc_html__( 'News Ticker Type', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'newsticker1',
				'options' => [
					'newsticker1' => 'Type 1',
					'newsticker2' => 'Type 2'
				]
			]
		);

		$this->add_control(
			'vcmp_newsticker_item_show',
			[
				'label' => esc_html__( 'Item Views', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::TEXT,
				'default' => '5',
				'condition'	=> [
					'vcmp_newsticker_type'	=> 'newsticker1'
				]
			]
		);

		$this->add_control(
			'vcmp_newsticker_type2_excerpt_number',
			[
				'label' => esc_html__( 'Number Experpt', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::TEXT,
				'default' => '5',
				'condition'	=> [
					'vcmp_newsticker_type'	=> 'newsticker2'
				]
			]
		);

		$this->add_control(
			'vcmp_newsticker_date',
			[
				'label' => esc_html__( 'Show Date', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => [
					'true' 		=> esc_html__( 'Show', 'elementorwidgetsmegapack' ),
					'false' 	=> esc_html__( 'Hidden', 'elementorwidgetsmegapack' )
				],
				'condition'	=> [
					'vcmp_newsticker_type'	=> 'newsticker1'
				]
			]
		);

		$this->add_control(
			'vcmp_newsticker_date_format',
			[
				'label' => esc_html__( 'Date Format', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'F j, Y',
				'options' => [
				  	'F j, Y g:i a'			=> esc_html__( 'November 6, 2010 12:50 am','elementorwidgetsmegapack'),
					'F j, Y'				=> esc_html__( 'November 6, 2010','elementorwidgetsmegapack'),
				  	'F, Y'					=> esc_html__( 'November, 2010','elementorwidgetsmegapack'),
					'g:i a'					=> esc_html__( '12:50 am','elementorwidgetsmegapack'),
				  	'g:i:s a'				=> esc_html__( '12:50:48 am','elementorwidgetsmegapack'),
					'l, F jS, Y'			=> esc_html__( 'Saturday, November 6th, 2010','elementorwidgetsmegapack'),
				  	'M j, Y @ G:i'			=> esc_html__( 'Nov 6, 2010 @ 0:50','elementorwidgetsmegapack'),
					'Y/m/d \a\t g:i A'		=> esc_html__( '2010/11/06 at 12:50 AM','elementorwidgetsmegapack'),
				  	'Y/m/d \a\t g:ia'		=> esc_html__( '2010/11/06 at 12:50am','elementorwidgetsmegapack'),
					'Y/m/d g:i:s A'			=> esc_html__( '2010/11/06 12:50:48 AM','elementorwidgetsmegapack'),
					'Y/m/d'					=> esc_html__( '2010/11/06','elementorwidgetsmegapack')							
				],
				'condition'	=> [
					'vcmp_newsticker_type'	=> 'newsticker1'
				]
			]
		);

		$this->add_control(
			'vcmp_newsticker_comments',
			[
				'label' => esc_html__( 'Show Comments', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => [
					'true' 		=> esc_html__( 'Show', 'elementorwidgetsmegapack' ),
					'false' 	=> esc_html__( 'Hidden', 'elementorwidgetsmegapack' )
				],
				'condition'	=> [
					'vcmp_newsticker_type'	=> 'newsticker1'
				]
			]
		);
		
		$this->add_control(
			'vcmp_newsticker_author',
			[
				'label' => esc_html__( 'Show Author', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => [
					'true' 		=> esc_html__( 'Show', 'elementorwidgetsmegapack' ),
					'false' 	=> esc_html__( 'Hidden', 'elementorwidgetsmegapack' )
				],
				'condition'	=> [
					'vcmp_newsticker_type'	=> 'newsticker1'
				]
			]
		);		

		$this->add_control(
			'vcmp_newsticker_category',
			[
				'label' => esc_html__( 'Show Category', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => [
					'true' 		=> esc_html__( 'Show', 'elementorwidgetsmegapack' ),
					'false' 	=> esc_html__( 'Hidden', 'elementorwidgetsmegapack' )
				],
				'condition'	=> [
					'vcmp_newsticker_type'	=> 'newsticker1'
				]
			]
		);	

		$this->add_control(
			'vcmp_newsticker_views',
			[
				'label' => esc_html__( 'Show Views', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => [
					'true' 		=> esc_html__( 'Show', 'elementorwidgetsmegapack' ),
					'false' 	=> esc_html__( 'Hidden', 'elementorwidgetsmegapack' )
				],
				'condition'	=> [
					'vcmp_newsticker_type'	=> 'newsticker1'
				]
			]
		);
		
		$this->end_controls_section();

  		$this->start_controls_section(
  			'section_query',
  			[
  				'label' => esc_html__( 'QUERY', 'essential-addons-elementor' )
  			]
		);

		$this->add_control(
			'vcmp_query_source',
			[
				'label' => esc_html__( 'Source', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'wp_posts',
				'options' => [
					'wp_posts' 				=> esc_html__( 'Wordpress Posts', 'essential-addons-elementor' ),
					'wp_custom_posts_type' 	=> esc_html__( 'Custom Posts Type', 'essential-addons-elementor' )
				]
			]
		);

		$this->add_control(
			'vcmp_query_sticky_posts',
			[
				'label' => esc_html__( 'All Posts/Sticky posts', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'allposts',
				'options' => [ 
					'allposts' 			=> esc_html__( 'All Posts', 'essential-addons-elementor' ),
					'onlystickyposts'	=> esc_html__( 'Only Sticky Posts', 'essential-addons-elementor' )
				],
				'condition'	=> [
					'vcmp_query_source'	=> 'wp_posts'
				]
			]
		);

		$this->add_control(
			'vcmp_query_posts_type',
			[
				'label' => esc_html__( 'Select Post Type Source', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'options' => $this->grid_get_all_custom_post_types(),
				'condition'	=> [
					'vcmp_query_source'	=> 'wp_custom_posts_type'
				]
			]
		);

		$this->add_control(
			'vcmp_query_categories',
			[
				'label' => esc_html__( 'Categories', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => $this->grid_get_all_post_type_categories('post'),
				'condition'	=> [
					'vcmp_query_source'	=> 'wp_posts'
				]				
			]
		);

		$this->add_control(
			'vcmp_query_order',
			[
				'label' => esc_html__( 'Order', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'DESC',
				'options' => [
					'DESC'	=> 'DESC',
					'ASC' 	=> 'ASC'					
				]
			]
		);

		$this->add_control(
			'vcmp_query_orderby',
			[
				'label' => esc_html__( 'Order By', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => [
					'date'			=> 'Date',
					'ID' 			=> 'ID',					
					'author' 		=> 'Author',					
					'title' 		=> 'Title',					
					'name' 			=> 'Name',
					'modified'		=> 'Modified',
					'parent' 		=> 'Parent',					
					'rand' 			=> 'Rand',					
					'comment_count' => 'Comments Count',					
					'none' 			=> 'None'						
				]
			]
		);

		$this->add_control(
			'vcmp_query_number',
			[
				'label' => esc_html__( 'Number Posts', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::TEXT,
				'default' => '5'
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_animation',
			[
				'label' => esc_html__( 'Animations', 'elementorwidgetsmegapack' )
			]
		);
		
		$this->add_control(
			'vcmp_animate',
			[
				'label' => esc_html__( 'Animate', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'off',
				'options' => [
					'off'	=> 'Off',
					'on' 	=> 'On'					
				]
			]
		);		

		$this->add_control(
			'vcmp_animate_effect',
			[
				'label' => esc_html__( 'Animate Effects', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'fade-in',
				'options' => [
					'fade-in'		=> 'Fade In',
					'fade-in-up' 	=> 'fade in up',					
					'fade-in-down' 	=> 'fade in down',					
					'fade-in-left' 	=> 'fade in Left',					
					'fade-in-right' => 'fade in Right',					
					'fade-out'		=> 'Fade In',
					'fade-out-up' 	=> 'Fade Out up',					
					'fade-out-down' => 'Fade Out down',					
					'fade-out-left' => 'Fade Out Left',					
					'fade-out-right' => 'Fade Out Right',
					'bounce-in'			=> 'Bounce In',
					'bounce-in-up' 		=> 'Bounce in up',					
					'bounce-in-down' 	=> 'Bounce in down',					
					'bounce-in-left' 	=> 'Bounce in Left',					
					'bounce-in-right' 	=> 'Bounce in Right',					
					'bounce-out'		=> 'Bounce In',
					'bounce-out-up' 	=> 'Bounce Out up',					
					'bounce-out-down' 	=> 'Bounce Out down',					
					'bounce-out-left' 	=> 'Bounce Out Left',					
					'bounce-out-right' 	=> 'Bounce Out Right',	
					'zoom-in'			=> 'Zoom In',
					'zoom-in-up' 		=> 'Zoom in up',					
					'zoom-in-down' 		=> 'Zoom in down',					
					'zoom-in-left' 		=> 'Zoom in Left',					
					'zoom-in-right' 	=> 'Zoom in Right',					
					'zoom-out'			=> 'Zoom In',
					'zoom-out-up' 		=> 'Zoom Out up',					
					'zoom-out-down' 	=> 'Zoom Out down',					
					'zoom-out-left' 	=> 'Zoom Out Left',					
					'zoom-out-right' 	=> 'Zoom Out Right',
					'flash' 			=> 'Flash',
					'strobe'			=> 'Strobe',
					'shake-x'			=> 'Shake X',
					'shake-y'			=> 'Shake Y',
					'bounce' 			=> 'Bounce',
					'tada'				=> 'Tada',
					'rubber-band'		=> 'Rubber Band',
					'swing' 			=> 'Swing',
					'spin'				=> 'Spin',
					'spin-reverse'		=> 'Spin Reverse',
					'slingshot'			=> 'Slingshot',
					'slingshot-reverse'	=> 'Slingshot Reverse',
					'wobble'			=> 'Wobble',
					'pulse' 			=> 'Pulse',
					'pulsate'			=> 'Pulsate' ,
					'heartbeat'			=> 'Heartbeat',
					'panic' 			=> 'Panic'					
				],
				'condition'	=> [
					'vcmp_animate'	=> 'on'
				]
			]
		);			

		$this->add_control(
			'vcmp_delay',
			[
				'label' => esc_html__( 'Animate Delay (ms)', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::TEXT,
				'default' => '1000',
				'condition'	=> [
					'vcmp_animate'	=> 'on'
				]
			]
		);	
		
		$this->end_controls_section();


		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'Style', 'elementorwidgetsmegapack' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'vcmp_custom_style',
			[
				'label' => esc_html__( 'Custom Style', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'off',
				'options' => [
					'off'	=> 'Off',
					'on' 	=> 'On'					
				]
			]
		);

		$this->add_control(
			'vcmp_main_color',
			[
				'label' => esc_html__( 'Main Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FC615D',
				'condition'	=> [
					'vcmp_custom_style'	=> 'on'
				]				
			]
		);

		$this->end_controls_section();
	}

	 
	 /**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		static $instance = 0;
		$instance++;		
		$settings = $this->get_settings_for_display();

				$vcmp_newsticker_type 					= esc_html($settings['vcmp_newsticker_type']);				
				$vcmp_newsticker_excerpt_number 		= '50';
				$vcmp_newsticker_type2_excerpt_number 	= esc_html($settings['vcmp_newsticker_type2_excerpt_number']);
				$vcmp_newsticker_date					= esc_html($settings['vcmp_newsticker_date']);
				$vcmp_newsticker_date_format 			= esc_html($settings['vcmp_newsticker_date_format']);
				$vcmp_newsticker_comments 				= esc_html($settings['vcmp_newsticker_comments']);
				$vcmp_newsticker_author					= esc_html($settings['vcmp_newsticker_author']);
				$vcmp_newsticker_category 				= esc_html($settings['vcmp_newsticker_category']);
				$vcmp_newsticker_views					= esc_html($settings['vcmp_newsticker_views']);
				$vcmp_newsticker_item_show				= esc_html($settings['vcmp_newsticker_item_show']);
							
				$vcmp_query_source					= esc_html($settings['vcmp_query_source']);
				$vcmp_query_sticky_posts 			= esc_html($settings['vcmp_query_sticky_posts']);
				$vcmp_query_posts_type 				= esc_html($settings['vcmp_query_posts_type']);
				$vcmp_query_categories = '';
				if(!empty($settings['vcmp_query_categories'])) {
					$num_cat = count($settings['vcmp_query_categories']);
					$i = 1;
					foreach ( $settings['vcmp_query_categories'] as $element ) {
						$vcmp_query_categories .= $element;
						if($i != $num_cat) {
							$vcmp_query_categories .= ',';
						}
						$i++;
					}		
				}			
				$vcmp_query_order 					= esc_html($settings['vcmp_query_order']);
				$vcmp_query_orderby 				= esc_html($settings['vcmp_query_orderby']);
				$vcmp_query_pagination	 			= '';
				$vcmp_query_pagination_type 			= '';
				$vcmp_query_number	 					= esc_html($settings['vcmp_query_number']);
				$vcmp_query_posts_for_page	 			= '';
				
				$vcmp_custom_style					= esc_html($settings['vcmp_custom_style']);
				$vcmp_main_color 					= esc_html($settings['vcmp_main_color']);					
													
				$vcmp_animate 						= esc_html($settings['vcmp_animate']);
				$vcmp_animate_effect 				= esc_html($settings['vcmp_animate_effect']);
				$vcmp_delay 						= esc_html($settings['vcmp_delay']);

	/* LOAD CSS && JS */	
	wp_enqueue_style( 'normalize' );
	wp_enqueue_style( 'animations' );
	wp_enqueue_style( 'fonts-vc' );
	wp_enqueue_style( 'elementor-icons' );
	wp_enqueue_style( 'font-awesome' );
	wp_enqueue_style( 'elementor-editor' );
	wp_enqueue_style( 'elementor-icons' );	
	wp_enqueue_style( 'fontawesome' );		
	wp_enqueue_style( 'megaposts' );
	wp_enqueue_script( 'appear' );
	wp_enqueue_script( 'animate' );	
	wp_enqueue_script( 'newsTicker' );
	
	/* CHECK VALUE EMPTY */
	if($vcmp_newsticker_excerpt_number == '') { $vcmp_newsticker_excerpt_number = '50'; }


		// LOOP QUERY
		$query = ewmp_query($vcmp_query_source,
							$vcmp_query_sticky_posts, 
							$vcmp_query_posts_type, 
							$vcmp_query_categories,
							'', 
							$vcmp_query_order, 
							$vcmp_query_orderby, 
							'no', 
							$vcmp_query_pagination_type,
							$vcmp_query_number, 
							$vcmp_query_posts_for_page);


			echo '<div class="adclear"></div>';

		if($vcmp_animate == 'on') { // ANIMATION ON
			echo '<div class="animate-in" data-anim-type="'.$vcmp_animate_effect.'" data-anim-delay="'.$vcmp_delay.'">';
		}


		/**********************************************************************/
		/******************************** TYPE 1 ******************************/
		/**********************************************************************/
		
		if($vcmp_newsticker_type == 'newsticker1') {

		

			echo "<style type=\"text/css\">";	
			if($vcmp_custom_style == 'on') {
						
				echo ".posts_newsticker_type1.admpselector-$instance li {
							border-bottom-color:{$vcmp_main_color};
						}
						</style>";
					
			} else {
				
				echo '</style>';				
			
			}
					
		echo '<script type="text/javascript">
					jQuery(document).ready(function($){
            			var nt_example1 = $(\'#admp-newsticker-type1-'.$instance.'\').newsTicker({
							row_height: 83,
							max_rows: '.$vcmp_newsticker_item_show.',
							duration: 4000,
							prevButton: $(\'#newsticker-prev-'.$instance.'\'),
							nextButton: $(\'#newsticker-next-'.$instance.'\')
            			});				
					}); 
					</script>';			
		
		echo '<div class="adclear"></div><div class="admp-newsticker-'.$instance.' admegaposts posts_newsticker_type1 admpselector-'.$instance.'">'; // OPEN MAIN DIV
		echo '<i class="fa fa-angle-up fa-2x" id="newsticker-prev-'.$instance.'"></i>';
		echo '<ul id="admp-newsticker-type1-'.$instance.'">';
		$count = 0;
		$loop = new \WP_Query($query);
		if($loop) { 
		while ( $loop->have_posts() ) : $loop->the_post();		
		$id_post = get_the_id();		
		?>
        <?php echo '<li>'; ?>
        
		<?php if (has_post_thumbnail() ) { 
		
        echo '<div class="mega-thumb">';
		echo '<a href="'.get_the_permalink().'" title="'.get_the_title().'">'.ewmp_vcmegaposts_thumbs().'</a>';
		echo '</div>';	
        
		}
        
        echo '<div class="mega-info">
        <div class="mega-title">
        <a href="'.get_the_permalink().'" title="'.get_the_title().'">		
		'.get_the_title().'
        </a>
		</div>';
		
		if ( get_the_date() ) {
        
        echo '<div class="mega-date">';
		echo ewmp_post_info($vcmp_newsticker_date,$vcmp_newsticker_comments,$vcmp_newsticker_author,$vcmp_newsticker_category,$vcmp_newsticker_views,$vcmp_query_source,$vcmp_query_posts_type,$vcmp_newsticker_date_format);        
        echo '</div>';
        
        }       
        
		echo '</div>
        
        <div class="clearfix"></div>
        
        </li>';
		
		$count++;
		endwhile;
		}		
		
		echo '</ul><i class="fa fa-angle-down fa-2x" id="newsticker-next-'.$instance.'"></i></div>'; // CLOSE MAIN DIV
		
		/**********************************************************************/
		/******************************** TYPE 2 ******************************/
		/**********************************************************************/
		
		} elseif($vcmp_newsticker_type == 'newsticker2') {

			echo "<style type=\"text/css\">";
						
		if($vcmp_custom_style == 'on') {
							
			echo ".posts_newsticker_type2.admpselector-$instance li {
							background:{$vcmp_main_color};
						}
						.posts_newsticker_type2.admpselector-$instance .newsticker-info {
							background:{$vcmp_main_color};
						}
						.posts_newsticker_type2.admpselector-$instance #newsticker-infos-triangle {
							border-color:rgba(0,0,0,0.0) rgba(0,0,0,0.0) {$vcmp_main_color};
						}
		 	     	</style>";
		
		} else {
			
			echo '</style>';	
		
		}
		echo '<script type="text/javascript">
					jQuery(document).ready(function($){
            			var nt_example1 = $(\'#admp-newsticker-'.$instance.'\').newsTicker({
							row_height: 55,
							max_rows: 1,
							duration: 4000,
							speed: 300,
							prevButton: $(\'#newsticker-prev-'.$instance.'\'),
							nextButton: $(\'#newsticker-next-'.$instance.'\'),
							hasMoved: function() {
								$(\'#newsticker-infos-container'.$instance.'\').fadeOut(200, function(){
								$(\'#newsticker-infos-'.$instance.' .infos-hour\').text($(\'#admp-newsticker-'.$instance.' li:first span\').text());
								$(\'#newsticker-infos-'.$instance.' .infos-text\').text($(\'#admp-newsticker-'.$instance.' li:first\').data(\'infos\'));
								$(this).fadeIn(400);
	                		});
                			},
                			pause: function() {
                				$(\'#admp-newsticker-'.$instance.' li i\').removeClass(\'icon-play3\').addClass(\'icon-pause2\');
                			},
                			unpause: function() {
                			$(\'#admp-newsticker-'.$instance.' li i\').removeClass(\'icon-pause2\').addClass(\'icon-play3\');
                		}
            		});								
					}); 
					</script>';			
		
		echo '<div class="adclear"></div><div class="admp-newsticker-'.$instance.' admegaposts posts_newsticker_type2 admpselector-'.$instance.'">'; // OPEN MAIN DIV
		echo '<ul id="admp-newsticker-'.$instance.'">';
		$count = 0;
		$loop = new \WP_Query($query);
		if($loop) { 
		while ( $loop->have_posts() ) : $loop->the_post();		
		$id_post = get_the_id();
		$link = get_permalink(); 		
		?>
        <?php echo '<li data-infos="'.ewmp_vcmegaposts_excerpt($vcmp_newsticker_type2_excerpt_number).'">'; 
        
        echo '<i class="icon-play3"></i><span class="hour">'.get_the_date($vcmp_newsticker_date_format).'</span><a href="'.$link.'">'.get_the_title().'</a>';
		
        
        echo '</li>';
		
		$count++;
		endwhile;
		}		
		
		echo '</ul>';
		
		$count2 = '0';
		if($loop) { 
		while ( $loop->have_posts() ) : $loop->the_post();	
		
		if($count2 == '0') {
				echo	'<div id="newsticker-infos-container'.$instance.'" class="newsticker-info">
									<div id="newsticker-infos-triangle"></div>
									<div id="newsticker-infos-'.$instance.'" >
										<div class="ad_one_fourth">
											<div class="infos-hour">
												'.get_the_date($vcmp_newsticker_date_format).'
											</div>
											<i class="icon-arrow-left" id="newsticker-prev-'.$instance.'"></i>
											<i class="icon-arrow-right" id="newsticker-next-'.$instance.'"></i>
										</div>
										<div class="ad_three_fourth ad_last">
											<div class="infos-text">'.ewmp_vcmegaposts_excerpt($vcmp_newsticker_type2_excerpt_number).'</div>
										</div>
									</div>
									<div class="adclear"></div>
								</div>';
			} else {
				break;
			}
		$count2++;	
		endwhile;
		}
		
				
		echo '</div>'; // CLOSE MAIN DIV
			
		}

		if($vcmp_animate == 'on') { 
		
			echo '</div>';
			
		}

	}

	/**
	 * Render the widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function _content_template() {}
}
