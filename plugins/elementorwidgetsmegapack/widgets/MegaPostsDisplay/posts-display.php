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
 * Elementor Mega Posts Display
 *
 * Elementor widget for mega posts display
 *
 * @since 1.0.0
 */
class Mega_Posts_Display extends Widget_Base {

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
		return 'emp-mega-posts-display';
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
		return esc_html__( 'Mega Posts Display', 'elementorwidgetsmegapack' );
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
		return 'eicon-posts-grid';
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
			'vcmp_post_display_type',
			[
				'label' => esc_html__( 'Post Display Type', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'posts_type1',
				'options' => [
					'posts_type1' => 'Post Display Type 1',
					'posts_type2' => 'Post Display Type 2',
					'posts_type3' => 'Post Display Type 3',
					'posts_type4' => 'Post Display Type 4',
					'posts_type5' => 'Post Display Type 5'
				]
			]
		);

		$this->add_control(
			'vcmp_post_display_excerpt',
			[
				'label' => esc_html__( 'Show Excerpt', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => [
					'true' 		=> esc_html__( 'Show', 'elementorwidgetsmegapack' ),
					'false' 	=> esc_html__( 'Hidden', 'elementorwidgetsmegapack' )
				]
			]
		);


		$this->add_control(
			'vcmp_post_display_excerpt_number',
			[
				'label' => esc_html__( 'Number Experpt', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::TEXT,
				'default' => '150',
				'condition'	=> [
					'vcmp_post_display_excerpt'	=> 'true'
				]
			]
		);

		$this->add_control(
			'vcmp_post_display_date',
			[
				'label' => esc_html__( 'Show Date', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => [
					'true' 		=> esc_html__( 'Show', 'elementorwidgetsmegapack' ),
					'false' 	=> esc_html__( 'Hidden', 'elementorwidgetsmegapack' )
				]
			]
		);

		$this->add_control(
			'vcmp_post_display_date_format',
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
					'vcmp_post_display_date'	=> 'true'
				]
			]
		);

		$this->add_control(
			'vcmp_post_display_comments',
			[
				'label' => esc_html__( 'Show Comments', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => [
					'true' 		=> esc_html__( 'Show', 'elementorwidgetsmegapack' ),
					'false' 	=> esc_html__( 'Hidden', 'elementorwidgetsmegapack' )
				]
			]
		);
		
		$this->add_control(
			'vcmp_post_display_author',
			[
				'label' => esc_html__( 'Show Author', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => [
					'true' 		=> esc_html__( 'Show', 'elementorwidgetsmegapack' ),
					'false' 	=> esc_html__( 'Hidden', 'elementorwidgetsmegapack' )
				]
			]
		);		

		$this->add_control(
			'vcmp_post_display_category',
			[
				'label' => esc_html__( 'Show Category', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => [
					'true' 		=> esc_html__( 'Show', 'elementorwidgetsmegapack' ),
					'false' 	=> esc_html__( 'Hidden', 'elementorwidgetsmegapack' )
				]
			]
		);	

		$this->add_control(
			'vcmp_post_display_views',
			[
				'label' => esc_html__( 'Show Views', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => [
					'true' 		=> esc_html__( 'Show', 'elementorwidgetsmegapack' ),
					'false' 	=> esc_html__( 'Hidden', 'elementorwidgetsmegapack' )
				]
			]
		);

		$this->add_control(
			'columns',
			[
				'label' => esc_html__( 'Columns', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => '4',
				'options' => [
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
					'7' => '7',
					'8' => '8',
					'9' => '9'
				],
				'condition'	=> [
					'vcmp_post_display_type'	=> 'posts_type3'
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
			'vcmp_query_pagination',
			[
				'label' => esc_html__( 'Pagination', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [
					'no'	=> 'No',
					'yes' 	=> 'Yes'					
				]
			]
		);

		$this->add_control(
			'vcmp_query_number',
			[
				'label' => esc_html__( 'Number Posts', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::TEXT,
				'default' => '10',
				'condition'	=> [
					'vcmp_query_pagination'	=> 'no'
				]
			]
		);

		$this->add_control(
			'vcmp_query_pagination_type',
			[
				'label' => esc_html__( 'Pagination Type', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'numeric',
				'options' => [
					'numeric'	=> 'Numeric',
					'normal' 	=> 'Normal'					
				],
				'condition'	=> [
					'vcmp_query_pagination'	=> 'yes'
				]				
			]
		);

		$this->add_control(
			'vcmp_query_posts_for_page',
			[
				'label' => esc_html__( 'Number Posts For Page', 'elementorwidgetsmegapack' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => '10',
				'condition'	=> [
					'vcmp_query_pagination'	=> 'yes'
				]
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

		$vcmp_post_display_type 			= esc_html($settings['vcmp_post_display_type']);
		$vcmp_post_display_excerpt 			= esc_html($settings['vcmp_post_display_excerpt']);			
		$vcmp_post_display_excerpt_number	= esc_html($settings['vcmp_post_display_excerpt_number']);
		$vcmp_post_display_date				= esc_html($settings['vcmp_post_display_date']);
		$vcmp_post_display_date_format	 	= esc_html($settings['vcmp_post_display_date_format']);
		$vcmp_post_display_comments 		= esc_html($settings['vcmp_post_display_comments']);
		$vcmp_post_display_author 			= esc_html($settings['vcmp_post_display_author']);
		$vcmp_post_display_category 		= esc_html($settings['vcmp_post_display_category']);
		$vcmp_post_display_views 			= esc_html($settings['vcmp_post_display_views']);
		$columns 							= esc_html($settings['columns']);
						
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
		$vcmp_query_pagination 				= esc_html($settings['vcmp_query_pagination']);
		$vcmp_query_pagination_type 		= esc_html($settings['vcmp_query_pagination_type']);
		$vcmp_query_number 					= esc_html($settings['vcmp_query_number']);
		$vcmp_query_posts_for_page 			= esc_html($settings['vcmp_query_posts_for_page']);
		                                   
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
	
	/* CHECK VALUE EMPTY */
	if($vcmp_post_display_excerpt_number == '') { $vcmp_post_display_excerpt_number = '50'; }
	
	echo '<style type="text/css">';
	if($vcmp_custom_style == 'on') {
		if($vcmp_post_display_type == 'posts_type1') {
			echo  '.admegaposts.posts_type1.admpselector-'.$instance.' .ad_two_third .admegaposts-icon-format {
							background:'.$vcmp_main_color.'!important;
						}
						.admegaposts.posts_type1.admpselector-'.$instance.' .admp-info-right {
							background:'.$vcmp_main_color.'!important;
						}';
		}
		if($vcmp_post_display_type == 'posts_type2') {
			echo  '.admegaposts.posts_type2.admpselector-'.$instance.' .firstpost .admp-details, .admegaposts.posts_type2.admpselector-'.$instance.' .moreposts {
						border-top-color:'.$vcmp_main_color.'!important;
						}';
		}
		if($vcmp_post_display_type == 'type3') {
			echo  '#admp-post_display-'.$instance.' .owl-controls .owl-buttons div {		
		 	     		background:'.$vcmp_main_color.'!important;
					}';
		}
		if($vcmp_post_display_type == 'posts_type4') {
			echo  '.admegaposts.posts_type4.admpselector-'.$instance.' .admp-views {
							background:'.$vcmp_main_color.'!important;
						}
						.admegaposts.posts_type4.admpselector-'.$instance.' .container-display4 {
							border-bottom-color:'.$vcmp_main_color.'!important;
						}';
		}
		if($vcmp_post_display_type == 'posts_type5') {
			echo  '.admegaposts.posts_type5.admpselector-'.$instance.' .admp-info-left.ad_one_half {
							background:'.$vcmp_main_color.'!important;
						}
						.admegaposts.posts_type5.admpselector-'.$instance.' .admp-info-right.ad_one_half.ad_last .admp-title {
							border-bottom-color:'.$vcmp_main_color.'!important;
						}';
		}		
	}
	echo '</style>';

		// PAGINATION		
		if($vcmp_query_pagination == 'yes') {
			if ( get_query_var('paged') ) {
				$paged = get_query_var('paged');				
			} elseif ( get_query_var('page') ) {			
				$paged = get_query_var('page');			
			} else {			
				$paged = 1;			
			}
		}
		// #PAGINATION	


		// LOOP QUERY
		$query = ewmp_query($vcmp_query_source,
							$vcmp_query_sticky_posts, 
							$vcmp_query_posts_type, 
							$vcmp_query_categories, 
							'', 
							$vcmp_query_order, 
							$vcmp_query_orderby, 
							$vcmp_query_pagination, 
							$vcmp_query_pagination_type,
							$vcmp_query_number, 
							$vcmp_query_posts_for_page);


			echo '<div class="adclear"></div>';

		if($vcmp_animate == 'on') { // ANIMATION ON
			echo '<div class="animate-in" data-anim-type="'.$vcmp_animate_effect.'" data-anim-delay="'.$vcmp_delay.'">';
		}


			echo '<div class="admegaposts '.$vcmp_post_display_type.' admpselector-'.$instance.'">';
										
			$count = 0;
			
			if($vcmp_post_display_type == 'posts_type3') {
				$count = 1;	
			}
			
			$loop = new \WP_Query($query);
			if($loop) { 
			while ( $loop->have_posts() ) : $loop->the_post();
			$link = get_permalink(); 
			$categories = get_the_category();	








		/**********************************************************************/
		/******************************** TYPE 1 ******************************/
		/**********************************************************************/
		
		if($vcmp_post_display_type == 'posts_type1') {
			
			if($count == '0') {
				
				echo '<div class="ad_two_third">';
				
				echo '<div class="admegaposts-thumbs-container">'.ewmp_vcmegaposts_thumbs();
				
				echo '<span class="admegaposts-icon-format">'.ewmp_vcmegaposts_format_icon().'</span>';
				
				echo '</div>';
				
				echo '<div class="admp-info-left">';
					echo '<span class="admp-title"><a href="'.$link.'">'.get_the_title().'</a></span>';
					if($vcmp_post_display_date == 'true') {
						echo '<span class="admp-date"><i class="icon-calendar"></i>'.get_the_date($vcmp_post_display_date_format).'</span>';
					}
					if($vcmp_post_display_excerpt == 'true') {
						echo '<span class="admp-content">'.ewmp_vcmegaposts_excerpt($vcmp_post_display_excerpt_number).'</span>';
					}
				echo '</div>';
				
				echo '<div class="admp-details">'.ewmp_post_info(false,$vcmp_post_display_comments,$vcmp_post_display_author,$vcmp_post_display_category,$vcmp_post_display_views,$vcmp_query_source,$vcmp_query_posts_type,$vcmp_post_display_date_format).'</div>';
				
				echo '</div>';
			
			} else {
			
				echo '<div class="ad_one_third ad_last">';
				
				echo '<div class="admegaposts-thumbs-container">'.ewmp_vcmegaposts_thumbs().'</div>';
				
				echo '<div class="admp-info-right">
							<span class="admegaposts-icon-format">'.ewmp_vcmegaposts_format_icon().'</span>
							<span class="admp-title"><a href="'.$link.'">'.get_the_title().'</a></span>
							</div>';
				
				echo '</div>';		
			
			}	


		/**********************************************************************/
		/******************************** TYPE 2 ******************************/
		/**********************************************************************/
		
		} elseif($vcmp_post_display_type == 'posts_type2') {
			
		if($count == '0') {
			
			echo '<div class="admp-columns-1 firstpost">';
			
			echo '<div class="admegaposts-thumbs-container">'.ewmp_vcmegaposts_thumbs();
			
			echo '</div>';
			
			echo '<div class="admp-info-left">';
				echo '<span class="admp-title"><a href="'.$link.'">'.get_the_title().'</a></span>';
				echo '<span class="admp-content">'.ewmp_vcmegaposts_excerpt($vcmp_post_display_excerpt_number).'<a href="'.$link.'">...</a></span>';
			echo '</div>';
			
			echo '<div class="admp-details">'.ewmp_post_info($vcmp_post_display_date,$vcmp_post_display_comments,$vcmp_post_display_author,$vcmp_post_display_category,$vcmp_post_display_views,$vcmp_query_source,$vcmp_query_posts_type,$vcmp_post_display_date_format).'</div>';
			
			echo '</div>';
		
		} else {
		
			echo '<div class="admp-columns-1 moreposts">';
			
			echo '<div class="admegaposts-thumbs-container admp_one_third">'.ewmp_vcmegaposts_thumbs().'</div>';
			
			echo '<div class="admp-info-right admp_two_third ad_last">';
			echo '<span class="admp-category">'.ewmp_post_info($vcmp_post_display_date,false,false,false,false,false,false,$vcmp_post_display_date_format).'</span>';						
			echo '<span class="admp-title"><a href="'.$link.'">'.get_the_title().'</a></span>';
			echo '<span class="admp-details">'.ewmp_post_info(false,$vcmp_post_display_comments,$vcmp_post_display_author,$vcmp_post_display_category,$vcmp_post_display_views,$vcmp_query_source,$vcmp_query_posts_type,$vcmp_post_display_date_format).'</span>';						
			echo '</div><div class="adclear"></div>';
			
			echo '</div>';		
		
		}			
			
		/**********************************************************************/
		/******************************** TYPE 3 ******************************/
		/**********************************************************************/
		
		} elseif($vcmp_post_display_type == 'posts_type3') {
			
			echo '<div class="admp-columns-'.$columns.'">';
				
			echo '<div class="admegaposts-thumbs-container">'.ewmp_vcmegaposts_thumbs();
	
			echo '</div>';
				
			echo '<div class="admp-info-left">';				
			echo '<div class="admp-details">'.ewmp_post_info(false,$vcmp_post_display_comments,$vcmp_post_display_author,$vcmp_post_display_category,$vcmp_post_display_views,$vcmp_query_source,$vcmp_query_posts_type,$vcmp_post_display_date_format).'</div>';
			echo '<span class="admp-title"><a href="'.$link.'">'.get_the_title().'</a></span>';
			if($vcmp_post_display_date == 'true') {
				echo '<span class="admp-date"><i class="icon-calendar"></i>'.get_the_date($vcmp_post_display_date_format).'</span>';
			}
			if($vcmp_post_display_excerpt == 'true') {
				echo '<span class="admp-content">'.ewmp_vcmegaposts_excerpt($vcmp_post_display_excerpt_number).'</span>';
			}
			echo '<a class="admp-read-more" href="'.$link.'">'.esc_html__('Read More','elementorwidgetsmegapack').'</a>';
			echo '</div>';			
			echo '</div>';
			
			if($count % $columns == '0') {		
				echo '<br class="adclear">';
			}			

		/**********************************************************************/
		/******************************** TYPE 4 ******************************/
		/**********************************************************************/
					
		} elseif($vcmp_post_display_type == 'posts_type4') {
			
			echo '<div class="container-display4"><div class="admegaposts-thumbs-container ad_one_half">'.ewmp_vcmegaposts_thumbs().'
						<span class="admp-view">'.ewmp_post_info(false,false,false,false,$vcmp_post_display_views,$vcmp_query_source,$vcmp_query_posts_type,$vcmp_post_display_date_format).'</span>		
						</div>';
	
			echo '<div class="admp-info-right ad_one_half ad_last">';		
			echo '<span class="admp-title"><a href="'.$link.'">'.get_the_title().'</a></span>';
			echo '<span class="admp-details">'.ewmp_post_info($vcmp_post_display_date,$vcmp_post_display_comments,$vcmp_post_display_author,$vcmp_post_display_category,false,$vcmp_query_source,$vcmp_query_posts_type,$vcmp_post_display_date_format).'</span>';
			if($vcmp_post_display_excerpt == 'true') {
				echo '<span class="admp-content">'.ewmp_vcmegaposts_excerpt($vcmp_post_display_excerpt_number).'</span>';
			}
			echo '<a class="admp-read-more" href="'.$link.'">'.esc_html__('Read More','elementorwidgetsmegapack').'</a>';		
			echo '</div>';
			echo '<div class="adclear"></div></div>';			
			
			
		/**********************************************************************/
		/******************************** TYPE 5 ******************************/
		/**********************************************************************/
					
		} elseif($vcmp_post_display_type == 'posts_type5') {
			
			if($count == '0') {
				
				echo '<div class="admp-info-left ad_one_half"><div class="admp-thumbs-container">'.ewmp_vcmegaposts_thumbs().'</div>';
				echo ewmp_post_info($vcmp_post_display_date,false,false,false,false,$vcmp_query_source,$vcmp_query_posts_type,$vcmp_post_display_date_format);			
				echo '<span class="admp-title"><a href="'.$link.'">'.get_the_title().'</a></span>';		
				if($vcmp_post_display_excerpt == 'true') {
					echo '<span class="admp-content">'.ewmp_vcmegaposts_excerpt($vcmp_post_display_excerpt_number).'</span>';
				}
				echo '<a class="admp-read-more" href="'.$link.'">'.esc_html__('Read More','elementorwidgetsmegapack').'</a>';		
				echo '<span class="admp-details">'.ewmp_post_info(false,$vcmp_post_display_comments,$vcmp_post_display_author,$vcmp_post_display_category,false,$vcmp_query_source,$vcmp_query_posts_type,$vcmp_post_display_date_format).'</span>';
				echo '</div>';
	
			} else {
				
				echo '<div class="admp-info-right ad_one_half ad_last">';		
				echo '<span class="admp-title"><a href="'.$link.'">'.get_the_title().'</a></span>';
				echo '</div>';		
				
			}					
			
		}
		
		$count++;
		endwhile;
		}		

		/**********************************************************************/
		/****************************** PAGINATION ****************************/
		/**********************************************************************/ 
		if($vcmp_query_pagination == 'yes') {
				echo '<div class="adclear"></div><div class="vcmp-post-display-'.$instance.' vcmp-pagination">';
				if($vcmp_query_pagination_type == 'numeric') {
					echo ewmp_posts_numeric_pagination($pages = '', $range = 2,$loop,$paged,'','');
				} else {
					echo get_next_posts_link( 'Older posts', $loop->max_num_pages );
					echo get_previous_posts_link( 'Newer posts' );				
				}
				echo '</div>';
		}
		/**********************************************************************/
		/***************************** #PAGINATION ****************************/
		/**********************************************************************/ 

		
		echo '</div>'; // CLOSE MAIN DIV


		/**********************************************************************/
		/******************************** TYPE 2 ******************************/
		/**********************************************************************/		
		

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
