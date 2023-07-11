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
 * Elementor WooCommerce Header Products Display
 *
 * Elementor widget for team vision
 *
 * @since 1.0.0
 */
class WooCommerce_Header_Products extends Widget_Base {

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
		return 'woocommerce-header-products';
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
		return esc_html__( 'WooCommerce Header Products Display', 'elementorwidgetsmegapack' );
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
			'type',
			[
				'label' => esc_html__( 'Style', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'type1',
				'options' => [
					'type1' => esc_html__('Style 1', 'elementorwidgetsmegapack' ),
					'type2' => esc_html__('Style 2', 'elementorwidgetsmegapack' ),
					'type3' => esc_html__('Style 3', 'elementorwidgetsmegapack' ),
					'type4' => esc_html__('Style 4 (Carousel)', 'elementorwidgetsmegapack' )
				]
			]
		);

		$this->add_control(
			'category_show',
			[
				'label' => esc_html__( 'Show Category', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => [
					'true' => esc_html__('Show', 'elementorwidgetsmegapack' ),
					'false' => esc_html__('Hidden', 'elementorwidgetsmegapack' )
				]
			]
		);

		$this->add_control(
			'social',
			[
				'label' => esc_html__( 'Show Social', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => [
					'true' => esc_html__('Show', 'elementorwidgetsmegapack' ),
					'false' => esc_html__('Hidden', 'elementorwidgetsmegapack' )
				]
			]
		);	
		
		$this->end_controls_section();

  		$this->start_controls_section(
  			'section_query',
  			[
  				'label' => esc_html__( 'QUERY', 'woocommerceproductstabelementor' )
  			]
		);

		$this->add_control(
			'categories_post_type',
			[
				'label' => esc_html__( 'Categories', 'woocommerceproductstabelementor' ),
				'type' => Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => $this->grid_get_all_post_type_categories('product_cat')			
			]
		);

		$this->add_control(
			'order',
			[
				'label' => esc_html__( 'Order', 'woocommerceproductstabelementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'DESC',
				'options' => [
					'DESC'	=> 'DESC',
					'ASC' 	=> 'ASC'					
				]
			]
		);

		$this->add_control(
			'orderby',
			[
				'label' => esc_html__( 'Order By', 'woocommerceproductstabelementor' ),
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

		$this->end_controls_section();

  		$this->start_controls_section(
  			'section_settings',
  			[
  				'label' => esc_html__( 'Carousel Settings Style 4', 'elementor-blog-layouts' )
  			]
		);

		$this->add_control(
			'item_show',
			[
				'label' => esc_html__( 'Number Item Show', 'elementor-blog-layouts' ),
				'type' => Controls_Manager::SELECT,
				'default' => '4',
				'options' => [
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4'
				],
				'condition'	=> [
					'type'	=> 'type4'
				]
			]
		);

		$this->add_control(
			'item_show_900',
			[
				'label' => esc_html__( 'Item Show for content between 600px to 900px', 'elementor-blog-layouts' ),
				'type' => Controls_Manager::SELECT,
				'label_block' => true,
				'default' => '4',
				'options' => [
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4'
				],
				'condition'	=> [
					'type'	=> 'type4'
				]
			]
		);
		
		$this->add_control(
			'item_show_600',
			[
				'label' => esc_html__( 'Item Show for content between 0px to 599px', 'elementor-blog-layouts' ),
				'type' => Controls_Manager::SELECT,
				'default' => '4',
				'label_block' => true,
				'options' => [
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4'
				],
				'condition'	=> [
					'type'	=> 'type4'
				]
			]
		);		

		$this->add_control(
			'loop',
			[
				'label' => esc_html__( 'Loop', 'elementor-blog-layouts' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => [
					'true' 		=> esc_html__( 'On', 'elementor-blog-layouts' ),
					'false' 	=> esc_html__( 'Off', 'elementor-blog-layouts' )
				],
				'condition'	=> [
					'type'	=> 'type4'
				]
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label' => esc_html__( 'Autoplay (ms) - ex 2000 or leave empty for default', 'elementor-blog-layouts' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => '2000',
				'condition'	=> [
					'type'	=> 'type4'
				]
			]
		);

		$this->add_control(
			'smart_speed',
			[
				'label' => esc_html__( 'Speed (ms) - ex 2000 or leave empty for default', 'elementor-blog-layouts' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => '2000',
				'condition'	=> [
					'type'	=> 'type4'
				]
			]
		);
		
		$this->add_control(
			'margin',
			[
				'label' => esc_html__( 'Margin between Items - empty to disable. Or for example: 10', 'elementor-blog-layouts' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'condition'	=> [
					'type'	=> 'type4'
				]
			]
		);		

		$this->add_control(
			'navigation',
			[
				'label' => esc_html__( 'Navigation', 'elementor-blog-layouts' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => [
					'true' 		=> esc_html__( 'Show', 'elementor-blog-layouts' ),
					'false' 	=> esc_html__( 'Hidden', 'elementor-blog-layouts' )
				],
				'condition'	=> [
					'type'	=> 'type4'
				]
			]
		);

		$this->add_control(
			'rtl',
			[
				'label' => esc_html__( 'RTL', 'elementor-blog-layouts' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'false',
				'options' => [
					'true' 		=> esc_html__( 'On', 'elementor-blog-layouts' ),
					'false' 	=> esc_html__( 'Off', 'elementor-blog-layouts' )
				],
				'condition'	=> [
					'type'	=> 'type4'
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
			'addon_animate',
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
			'effect',
			[
				'label' => esc_html__( 'Animate Effects', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'fade-in',
				'options' => [
							'fade-in'			=> esc_html__( 'Fade In', 'elementorwidgetsmegapack' ),
							'fade-in-up' 		=> esc_html__( 'fade in up', 'elementorwidgetsmegapack' ),					
							'fade-in-down' 		=> esc_html__( 'fade in down', 'elementorwidgetsmegapack' ),					
							'fade-in-left' 		=> esc_html__( 'fade in Left', 'elementorwidgetsmegapack' ),					
							'fade-in-right' 	=> esc_html__( 'fade in Right', 'elementorwidgetsmegapack' ),					
							'fade-out'			=> esc_html__( 'Fade In', 'elementorwidgetsmegapack' ),
							'fade-out-up' 		=> esc_html__( 'Fade Out up', 'elementorwidgetsmegapack' ),					
							'fade-out-down' 	=> esc_html__( 'Fade Out down', 'elementorwidgetsmegapack' ),					
							'fade-out-left' 	=> esc_html__( 'Fade Out Left', 'elementorwidgetsmegapack' ),					
							'fade-out-right' 	=> esc_html__( 'Fade Out Right', 'elementorwidgetsmegapack' ),
							'bounce-in'			=> esc_html__( 'Bounce In', 'elementorwidgetsmegapack' ),
							'bounce-in-up' 		=> esc_html__( 'Bounce in up', 'elementorwidgetsmegapack' ),					
							'bounce-in-down' 	=> esc_html__( 'Bounce in down', 'elementorwidgetsmegapack' ),					
							'bounce-in-left' 	=> esc_html__( 'Bounce in Left', 'elementorwidgetsmegapack' ),					
							'bounce-in-right' 	=> esc_html__( 'Bounce in Right', 'elementorwidgetsmegapack' ),					
							'bounce-out'		=> esc_html__( 'Bounce In', 'elementorwidgetsmegapack' ),
							'bounce-out-up' 	=> esc_html__( 'Bounce Out up', 'elementorwidgetsmegapack' ),					
							'bounce-out-down' 	=> esc_html__( 'Bounce Out down', 'elementorwidgetsmegapack' ),					
							'bounce-out-left' 	=> esc_html__( 'Bounce Out Left', 'elementorwidgetsmegapack' ),					
							'bounce-out-right' 	=> esc_html__( 'Bounce Out Right', 'elementorwidgetsmegapack' ),	
							'zoom-in'			=> esc_html__( 'Zoom In', 'elementorwidgetsmegapack' ),
							'zoom-in-up' 		=> esc_html__( 'Zoom in up', 'elementorwidgetsmegapack' ),					
							'zoom-in-down' 		=> esc_html__( 'Zoom in down', 'elementorwidgetsmegapack' ),					
							'zoom-in-left' 		=> esc_html__( 'Zoom in Left', 'elementorwidgetsmegapack' ),					
							'zoom-in-right' 	=> esc_html__( 'Zoom in Right', 'elementorwidgetsmegapack' ),					
							'zoom-out'			=> esc_html__( 'Zoom In', 'elementorwidgetsmegapack' ),
							'zoom-out-up' 		=> esc_html__( 'Zoom Out up', 'elementorwidgetsmegapack' ),					
							'zoom-out-down' 	=> esc_html__( 'Zoom Out down', 'elementorwidgetsmegapack' ),					
							'zoom-out-left' 	=> esc_html__( 'Zoom Out Left', 'elementorwidgetsmegapack' ),					
							'zoom-out-right' 	=> esc_html__( 'Zoom Out Right', 'elementorwidgetsmegapack' ),
							'flash' 			=> esc_html__( 'Flash', 'elementorwidgetsmegapack' ),
							'strobe'			=> esc_html__( 'Strobe', 'elementorwidgetsmegapack' ),
							'shake-x'			=> esc_html__( 'Shake X', 'elementorwidgetsmegapack' ),
							'shake-y'			=> esc_html__( 'Shake Y', 'elementorwidgetsmegapack' ),
							'bounce' 			=> esc_html__( 'Bounce', 'elementorwidgetsmegapack' ),
							'tada'				=> esc_html__( 'Tada', 'elementorwidgetsmegapack' ),
							'rubber-band'		=> esc_html__( 'Rubber Band', 'elementorwidgetsmegapack' ),
							'swing' 			=> esc_html__( 'Swing', 'elementorwidgetsmegapack' ),
							'spin'				=> esc_html__( 'Spin', 'elementorwidgetsmegapack' ),
							'spin-reverse'		=> esc_html__( 'Spin Reverse', 'elementorwidgetsmegapack' ),
							'slingshot'			=> esc_html__( 'Slingshot', 'elementorwidgetsmegapack' ),
							'slingshot-reverse'	=> esc_html__( 'Slingshot Reverse', 'elementorwidgetsmegapack' ),
							'wobble'			=> esc_html__( 'Wobble', 'elementorwidgetsmegapack' ),
							'pulse' 			=> esc_html__( 'Pulse', 'elementorwidgetsmegapack' ),
							'pulsate'			=> esc_html__( 'Pulsate', 'elementorwidgetsmegapack' ),
							'heartbeat'			=> esc_html__( 'Heartbeat', 'elementorwidgetsmegapack' ),
							'panic' 			=> esc_html__( 'Panic', 'elementorwidgetsmegapack' )				
				],
				'condition'	=> [
					'addon_animate'	=> 'on'
				]
			]
		);			

		$this->add_control(
			'delay',
			[
				'label' => esc_html__( 'Animate Delay (ms)', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::TEXT,
				'default' => '1000',
				'condition'	=> [
					'addon_animate'	=> 'on'
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
			'layout',
			[
				'label' => esc_html__( 'Layout', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'layout1',
				'options' => [
					'layout1'	=> esc_html__( 'Layout 1', 'elementorwidgetsmegapack' ),
					'layout2' 	=> esc_html__( 'Layout 2', 'elementorwidgetsmegapack' )					
				],
				'condition'	=> [
					'type'	=> array( 'type1', 'type2', 'type3',  'type4', 'type5')
				]
			]
		);

		$this->add_control(
			'custom_style',
			[
				'label' => esc_html__( 'Custom Style', 'elementor-counter' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'off',
				'options' => [
					'off'	=> esc_html__( 'Off', 'elementor-counter' ),
					'on' 	=> esc_html__( 'On', 'elementor-counter' )					
				]
			]
		);

		$this->add_control(
			'maincolor',
			[
				'label' => esc_html__( 'Main Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#e74c3c',
				'condition'	=> [
					'custom_style'	=> 'on'
				]
			]
		);

		$this->add_control(
			'secondarycolor',
			[
				'label' => esc_html__( 'Second Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
				'condition'	=> [
					'custom_style'	=> 'on'
				]
			]
		);
		
		$this->add_control(
			'thirdcolor',
			[
				'label' => esc_html__( 'Third Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#000000',
				'condition'	=> [
					'custom_style'	=> 'on'
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

        $type					= esc_html($settings['type']);
        $date					= '';
        $date_format			= '';
        $category_show			= esc_html($settings['category_show']);
        $social					= esc_html($settings['social']);
		
		$item_show				= esc_html($settings['item_show']);
		$item_show_900			= esc_html($settings['item_show_900']);
		$item_show_600			= esc_html($settings['item_show_600']);
		$loop					= esc_html($settings['loop']);
		$autoplay				= esc_html($settings['autoplay']);
		$smart_speed			= esc_html($settings['smart_speed']);
		$navigation				= esc_html($settings['navigation']);
		$margin					= esc_html($settings['margin']);
		$rtl					= esc_html($settings['rtl']);
		
		// Query
		$source					= 'post_type';
		$posts_source			= '';
		$posts_type				= 'product';
		$categories				= '';
		$categories_post_type	= '';
		if(!empty($settings['categories_post_type'])) {
			$num_cat = count($settings['categories_post_type']);
			$i = 1;
			foreach ( $settings['categories_post_type'] as $element ) {
				$categories_post_type .= $element;
				if($i != $num_cat) {
					$categories_post_type .= ',';
				}
				$i++;
			}		
		}
		
		$orderby				= esc_html($settings['orderby']);
		$order					= esc_html($settings['order']);
					
		// Style
		$layout					= esc_html($settings['layout']);
        $custom_style			= esc_html($settings['custom_style']);
        $maincolor				= esc_html($settings['maincolor']);
        $secondarycolor			= esc_html($settings['secondarycolor']);
        $thirdcolor				= esc_html($settings['thirdcolor']);
		
		// Animations
		$addon_animate			= esc_html($settings['addon_animate']);
		$effect					= esc_html($settings['effect']);
		$delay					= esc_html($settings['delay']);
		
		if($type == 'type1') { 
			if($layout == 'layout1') {
				$header_type = 'wpmp_post_display1'; 
			} else {
				$header_type = 'wpmp_post_display1_bis';
			}
			$num_posts = 3;
		}
		if($type == 'type2') {
			if($layout == 'layout1') {
				$header_type = 'wpmp_post_display2'; 
			} else {
				$header_type = 'wpmp_post_display2_bis';
			}
			$num_posts = 4;			
		}
		if($type == 'type3') {
			if($layout == 'layout1') {
				$header_type = 'wpmp_post_display3'; 
			} else {
				$header_type = 'wpmp_post_display3_bis';
			}
			$num_posts = 4;			
		}
		if($type == 'type4') {
			if($layout == 'layout1') {
				$header_type = 'wpmp_post_display4 woocommerceheaderproducts-owl-carousel'; 
			} else {
				$header_type = 'wpmp_post_display4_bis woocommerceheaderproducts-owl-carousel';
			}
			$num_posts = '';
			wp_enqueue_script( 'owlcarousel' );	
			wp_enqueue_style( 'owlcarousel' );
			wp_enqueue_style( 'owltheme' );			
		}
		if($type == 'type5') {
			if($layout == 'layout1') {
				$header_type = 'wpmp_post_display5'; 
			} else {
				$header_type = 'wpmp_post_display5_bis';
			}
			$num_posts = 4;	
			$type5_big_post = $type5_small_post = '';			
		}	

		if($custom_style == 'on') {	
			echo ewmp_woocommerceheaderproducts_header_custom_style($instance,$type,$layout,$maincolor,$secondarycolor,$thirdcolor);
		}
		
		wp_enqueue_style( 'fonts-vc' );
		wp_enqueue_style( 'animations' );
		wp_enqueue_style( 'elementor-icons' );
		wp_enqueue_style( 'font-awesome' );
		wp_enqueue_script( 'woocommerceheaderproducts' );
		wp_enqueue_style( 'woocommerce-ewmp' );
		
		// LOOP QUERY
		$query = ewmp_query($source,
								  $posts_source, 
								  $posts_type, 
								  $categories,
								  $categories_post_type, 
								  $order, 
								  $orderby, 
								  'no', 
								  '',
								  $num_posts, 
								  '');
		
		echo '<div class="wpmp-clear"></div>';
		$count = 0;
		if($type != 'type4') {
			echo '<div class="woocommerceheaderproducts '.$header_type.' fpg wpmepack-header-'.$instance.' '.ewmp_animate_class($addon_animate,$effect,$delay).'>';
		} else {
			echo '<div 
							data-woocommerceheaderproducts-owl-items="'.esc_html($item_show).'" 
							data-woocommerceheaderproducts-owl-items-900="'.esc_html($item_show_900).'" 
							data-woocommerceheaderproducts-owl-items-600="'.esc_html($item_show_600).'" 
							data-woocommerceheaderproducts-owl-loop="'.esc_html($loop).'" 
							data-woocommerceheaderproducts-owl-autoplay="'.esc_html($autoplay).'" 
							data-woocommerceheaderproducts-owl-smart-speed="'.esc_html($smart_speed).'" 
							data-woocommerceheaderproducts-owl-navigation="'.esc_html($navigation).'" 
							data-woocommerceheaderproducts-owl-pagination="false" 
							data-woocommerceheaderproducts-owl-margin="'.esc_html($margin).'" 
							data-woocommerceheaderproducts-owl-rtl="'.esc_html($rtl).'"				
			class="woocommerceheaderproducts '.$header_type.' fpg wpmepack-header-'.$instance.' '.ewmp_animate_class($addon_animate,$effect,$delay).'>';
		}
		$loop = new \WP_Query($query);
		if($loop) { 
		while ( $loop->have_posts() ) : $loop->the_post();
		
		$link = get_permalink();
		$id_post = get_the_id();
		$product = new \WC_Product( $id_post );
		$price = $product->get_regular_price();
		if(empty($price)) {
			$price = $product->get_price();
		}
		$price_sales = $product->get_sale_price();
		$symbol = get_woocommerce_currency_symbol();
		
		/**********************************************************************/
		/******************************** TYPE 1 ******************************/
		/**********************************************************************/
				
		if($type == 'type1') {

			if($layout == 'layout1') {

				/**********************************************************************/
				/****************************** LAYOUT 1 ******************************/
				/**********************************************************************/			

			if($count == '0') {
				
				echo '<style>.woocommerceheaderproducts.wpmp_post_display1.wpmepack-header-'.$instance.' .ad_three_fifth { background-image:url('.ewmp_thumbs_url($id_post).'); }</style>';		

				echo '<div class="woocommerceheaderproducts-item ad_three_fifth big-post">';				
				
				if($category_show == 'true') {
				
					echo '<div class="category">
									'.ewmp_get_category($source,$posts_type,$css_link='').'
								</div>';	
									
				}
				
				if($social == 'true') {
									
            		echo ewmp_woocommerceheaderproducts_post_social_share();					

				}

            	echo '<div class="title-info-post">
					  
							<h2 class="title-post">
								<a href="'.$link.'">'.get_the_title().'</a>
							</h2>';
				
							
					echo '<div class="price-content"><span class="regular-price';
						
						if(!empty($price_sales) || $price_sales != '') {
							echo ' line-through';	
						}
						
						echo '">'. $price . ' ' . $symbol .'</span>';
						
						if(!empty($price_sales) || $price_sales != '') {
							echo '<span class="sale-price">'. $price_sales . ' ' .$symbol .'</span>';
						}
				
					echo '</div>';
				
				echo '<div class="cart-button-container">
					<a class="product_type_simple add_to_cart_button ajax_add_to_cart" data-product_sku="" data-product_id="'.$id_post.'" rel="nofollow" href="?add-to-cart='.$id_post.'">'.esc_html__('Add To Cart','elementorwidgetsmegapack').'</a>
				</div>';
								
				if(!empty($price_sales) || $price_sales != '') {
					echo '<div class="info-post"><span class="item-sale">'.esc_html__('Sale','elementorwidgetsmegapack').'</span></div>';	
				}	
				
            	echo '</div></div>'; 

			
			} else { // OTHERS POSTS
			
				echo '<style>.woocommerceheaderproducts.wpmp_post_display1.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_two_fifth.wpmepack-element-'.$count.' { background-image:url('.ewmp_thumbs_url($id_post).'); }</style>';		
				
				echo  '<div class="woocommerceheaderproducts-item ad_two_fifth ad_margin first wpmepack-element-'.$count.'">';
				
				if($category_show == 'true') {
				
					echo '<div class="category">
									'.ewmp_get_category($source,$posts_type,$css_link='').'
								</div>';	
									
				}
				
				if($social == 'true') {
									
            		echo ewmp_woocommerceheaderproducts_post_social_share();					

				}

            	echo '<div class="title-info-post">
							<h2 class="title-post">
								<a href="'.$link.'">'.get_the_title().'</a>
							</h2>';
				
					echo '<div class="price-content"><span class="regular-price';
						
						if(!empty($price_sales) || $price_sales != '') {
							echo ' line-through';	
						}
						
						echo '">'. $price . ' ' . $symbol .'</span>';
						
						if(!empty($price_sales) || $price_sales != '') {
							echo '<span class="sale-price">'. $price_sales . ' ' .$symbol .'</span>';
						}
				
					echo '</div>';

				echo '<div class="cart-button-container">
					<a class="product_type_simple add_to_cart_button ajax_add_to_cart" data-product_sku="" data-product_id="'.$id_post.'" rel="nofollow" href="?add-to-cart='.$id_post.'">'.esc_html__('Add To Cart','elementorwidgetsmegapack').'</a>
				</div>';				
				
				if(!empty($price_sales) || $price_sales != '') {
					echo '<div class="info-post"><span class="item-sale">'.esc_html__('Sale','elementorwidgetsmegapack').'</span></div>';	
				}	
				
            	echo '</div></div>'; 	
				
			
			
			}
		
			} else {

				/**********************************************************************/
				/****************************** LAYOUT 2 ******************************/
				/**********************************************************************/
				
				if($count == '0') {
					
					echo '<style>.woocommerceheaderproducts.wpmp_post_display1_bis.wpmepack-header-'.$instance.' .ad_three_fifth { background-image:url('.ewmp_thumbs_url($id_post).'); }</style>';
					echo '<div class="woocommerceheaderproducts-item ad_three_fifth big-post">';				
					if($category_show == 'true') { echo '<div class="category">'.ewmp_get_category($source,$posts_type,$css_link='').'</div>'; }	
										
					if($social == 'true') { echo ewmp_woocommerceheaderproducts_post_social_share(); }
					
            		echo '<div class="title-info-post"><h2 class="title-post"><a href="'.$link.'">'.get_the_title().'</a></h2>';			
					echo '<div class="price-content"><span class="regular-price';
						
						if(!empty($price_sales) || $price_sales != '') {
							echo ' line-through';	
						}
						
						echo '">'. $price . ' ' . $symbol .'</span>';
						
						if(!empty($price_sales) || $price_sales != '') {
							echo '<span class="sale-price">'. $price_sales . ' ' .$symbol .'</span>';
						}
				
					echo '</div>';
				
				echo '<div class="cart-button-container">
					<a class="product_type_simple add_to_cart_button ajax_add_to_cart" data-product_sku="" data-product_id="'.$id_post.'" rel="nofollow" href="?add-to-cart='.$id_post.'">'.esc_html__('Add To Cart','elementorwidgetsmegapack').'</a>
				</div>';
								
				if(!empty($price_sales) || $price_sales != '') {
					echo '<div class="info-post"><span class="item-sale">'.esc_html__('Sale','elementorwidgetsmegapack').'</span></div>';	
				}						
					echo '</div>';				
					echo '</div>';
				
				} else {				

					echo '<style>.woocommerceheaderproducts.wpmp_post_display1_bis.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_two_fifth.wpmepack-element-'.$count.' { background-image:url('.ewmp_thumbs_url($id_post).'); }</style>';		
					echo  '<div class="woocommerceheaderproducts-item ad_two_fifth ad_margin first wpmepack-element-'.$count.'">';
					if($category_show == 'true') { echo '<div class="category">'.ewmp_get_category($source,$posts_type,$css_link='').'</div>';	

					if($social == 'true') { echo ewmp_woocommerceheaderproducts_post_social_share(); }
					
            		echo '<div class="title-info-post"><h2 class="title-post"><a href="'.$link.'">'.get_the_title().'</a></h2>';			
					echo '<div class="price-content"><span class="regular-price';
						
						if(!empty($price_sales) || $price_sales != '') {
							echo ' line-through';	
						}
						
						echo '">'. $price . ' ' . $symbol .'</span>';
						
						if(!empty($price_sales) || $price_sales != '') {
							echo '<span class="sale-price">'. $price_sales . ' ' .$symbol .'</span>';
						}
				
					echo '</div>';
				
				echo '<div class="cart-button-container">
					<a class="product_type_simple add_to_cart_button ajax_add_to_cart" data-product_sku="" data-product_id="'.$id_post.'" rel="nofollow" href="?add-to-cart='.$id_post.'">'.esc_html__('Add To Cart','elementorwidgetsmegapack').'</a>
				</div>';
								
				if(!empty($price_sales) || $price_sales != '') {
					echo '<div class="info-post"><span class="item-sale">'.esc_html__('Sale','elementorwidgetsmegapack').'</span></div>';	
				}						
					echo '</div>';
					echo '</div>';				
				}
				
				
				} // CLOSE COUNT POSTS
				
			} // CLOSE LAYOUT 2
		
		} // CLOSE HEADER TYPE 1
		
		/**********************************************************************/
		/******************************** TYPE 2 ******************************/
		/**********************************************************************/		
		
		if($type == 'type2') {
			
			if($layout == 'layout1') {
				
				/**********************************************************************/
				/****************************** LAYOUT 1 ******************************/
				/**********************************************************************/				
			
			if($count == '0') {
			
				echo '<style>.woocommerceheaderproducts.wpmp_post_display2.wpmepack-header-'.$instance.' .ad_one_one.ad_last.wpmepack-element-'.$count.' { background-image:url('.ewmp_thumbs_url($id_post).'); }</style>';		
		
				echo '<div class="woocommerceheaderproducts-item ad_one_one ad_last big-post wpmepack-element-'.$count.'">';
		
				if($category_show == 'true') {
				
					echo '<div class="category">
									'.ewmp_get_category($source,$posts_type,$css_link='').'
								</div>';	
									
				}
				
				if($social == 'true') {
									
            		echo ewmp_woocommerceheaderproducts_post_social_share();					

				}

            	echo '<div class="title-info-post">
							<h2 class="title-post">
								<a href="'.$link.'">'.get_the_title().'</a>
							</h2>';
				
					echo '<div class="price-content"><span class="regular-price';
						
						if(!empty($price_sales) || $price_sales != '') {
							echo ' line-through';	
						}
						
						echo '">'. $price . ' ' . $symbol .'</span>';
						
						if(!empty($price_sales) || $price_sales != '') {
							echo '<span class="sale-price">'. $price_sales . ' ' .$symbol .'</span>';
						}
				
					echo '</div>';
				
				echo '<div class="cart-button-container">
					<a class="product_type_simple add_to_cart_button ajax_add_to_cart" data-product_sku="" data-product_id="'.$id_post.'" rel="nofollow" href="?add-to-cart='.$id_post.'">'.esc_html__('Add To Cart','elementorwidgetsmegapack').'</a>
				</div>';
								
				if(!empty($price_sales) || $price_sales != '') {
					echo '<div class="info-post"><span class="item-sale">'.esc_html__('Sale','elementorwidgetsmegapack').'</span></div>';	
				}	
				
            	echo '</div></div>'; 		
		
		} else {
			
				if($count == '1') { $count_class = 'first'; }
				if($count == '2') { $count_class = 'second'; }
				if($count == '3') { $count_class = 'third'; }
			
			echo '<style>.woocommerceheaderproducts.wpmp_post_display2.wpmepack-header-'.$instance.' .wpmepack-element-'.$count.' .photo { background-image:url('.ewmp_thumbs_url($id_post).'); }</style>';		
			
        	echo '<div class="woocommerceheaderproducts-item ad_one_third ad_margin wpmepack-element-'.$count.' '.$count_class.'"><div class="photo"></div>';
        	
            echo '<div class="box-post">';
                
				if($category_show == 'true') {
				
					echo '<div class="category">
									'.ewmp_get_category($source,$posts_type,$css_link='').'
								</div>';	
									
				}
				
               echo ' <div class="title-info-post">
                    <h4 class="title-post">
                        <a href="'.$link.'">'.get_the_title().'</a>
                    </h4>';
					
					echo '<div class="price-content"><span class="regular-price';
						
						if(!empty($price_sales) || $price_sales != '') {
							echo ' line-through';	
						}
						
						echo '">'. $price . ' ' . $symbol .'</span>';
						
						if(!empty($price_sales) || $price_sales != '') {
							echo '<span class="sale-price">'. $price_sales . ' ' .$symbol .'</span>';
						}
				
					echo '</div>';
				
				echo '<div class="cart-button-container">
					<a class="product_type_simple add_to_cart_button ajax_add_to_cart" data-product_sku="" data-product_id="'.$id_post.'" rel="nofollow" href="?add-to-cart='.$id_post.'">'.esc_html__('Add To Cart','elementorwidgetsmegapack').'</a>
				</div>';	             
				
				echo '</div>';
				
				
            echo '</div>';
			
			   
        echo '</div>';		
			
		}
		
			} else { 

				/**********************************************************************/
				/****************************** LAYOUT 2 ******************************/
				/**********************************************************************/				
				
				if($count == '0') {
				
					echo '<style>.woocommerceheaderproducts.wpmp_post_display2_bis.wpmepack-header-'.$instance.' .ad_one_one.ad_last.wpmepack-element-'.$count.' { background-image:url('.ewmp_thumbs_url($id_post).'); }</style>';	
					echo '<div class="woocommerceheaderproducts-item ad_one_one ad_last big-post wpmepack-element-'.$count.'">';				
					if($category_show == 'true') { echo '<div class="category">'.ewmp_get_category($source,$posts_type,$css_link='').'</div>'; }				
									
					if($social == 'true') { echo ewmp_woocommerceheaderproducts_post_social_share(); }
					
            		echo '<div class="title-info-post"><h2 class="title-post"><a href="'.$link.'">'.get_the_title().'</a></h2>';			
					echo '<div class="price-content"><span class="regular-price';
						
						if(!empty($price_sales) || $price_sales != '') {
							echo ' line-through';	
						}
						
						echo '">'. $price . ' ' . $symbol .'</span>';
						
						if(!empty($price_sales) || $price_sales != '') {
							echo '<span class="sale-price">'. $price_sales . ' ' .$symbol .'</span>';
						}
				
					echo '</div>';
				
					echo '<div class="cart-button-container">
						<a class="product_type_simple add_to_cart_button ajax_add_to_cart" data-product_sku="" data-product_id="'.$id_post.'" rel="nofollow" href="?add-to-cart='.$id_post.'">'.esc_html__('Add To Cart','elementorwidgetsmegapack').'</a>
					</div>';
									
					if(!empty($price_sales) || $price_sales != '') {
						echo '<div class="info-post"><span class="item-sale">'.esc_html__('Sale','elementorwidgetsmegapack').'</span></div>';	
					}					
					echo '</div>';				
					echo '</div>';				
				
				} else {
					
					if($count == '1') { $count_class = 'first'; }
					if($count == '2') { $count_class = 'second'; }
					if($count == '3') { $count_class = 'third'; }					
					
					echo '<style>.woocommerceheaderproducts.wpmp_post_display2_bis.wpmepack-header-'.$instance.' .wpmepack-element-'.$count.' .photo { background-image:url('.ewmp_thumbs_url($id_post).'); }</style>';
        			echo '<div class="woocommerceheaderproducts-item ad_one_third ad_margin wpmepack-element-'.$count.' '.$count_class.'">';
					
					echo '<div class="photo">';	
						if($category_show == 'true') { echo '<div class="category">'.ewmp_get_category($source,$posts_type,$css_link='').'</div>'; }	
					echo '</div>';
            		
					echo '<div class="box-post">';				
               			echo '<div class="title-info-post"><h4 class="title-post"><a href="'.$link.'">'.get_the_title().'</a></h4>';
						echo '<div class="price-content"><span class="regular-price';
							
							if(!empty($price_sales) || $price_sales != '') {
								echo ' line-through';	
							}
							
							echo '">'. $price . ' ' . $symbol .'</span>';
	
								if(!empty($price_sales) || $price_sales != '') {
									echo '<span class="sale-price">'. $price_sales . ' ' .$symbol .'</span>';
								}
						
							echo '</div>';
	
							echo '<div class="cart-button-container">
								<a class="product_type_simple add_to_cart_button ajax_add_to_cart" data-product_sku="" data-product_id="'.$id_post.'" rel="nofollow" href="?add-to-cart='.$id_post.'">'.esc_html__('Add To Cart','elementorwidgetsmegapack').'</a>
							</div>';
								
						echo '</div>';
					echo '</div>';
									
					echo '</div>';
					
				} // #COUNT	
				
			} // #LAYOUT 2
		
		} // #TYPE 2
		
		
		
		
		/**********************************************************************/
		/******************************** TYPE 3 ******************************/
		/**********************************************************************/
				
		if($type == 'type3') {		

			if($layout == 'layout1') {
				
				/**********************************************************************/
				/****************************** LAYOUT 1 ******************************/
				/**********************************************************************/

		
			if($count == '0') {
				
		
				echo '<style>.woocommerceheaderproducts.wpmp_post_display3.wpmepack-header-'.$instance.' .wpmepack-element-'.$count.' { background-image:url('.ewmp_thumbs_url($id_post).'); }</style>';		
		
				echo '<div class="woocommerceheaderproducts-item ad_three_fifth big-post wpmepack-element-'.$count.'">';
		
				if($category_show == 'true') {
				
					echo '<div class="category">
									'.ewmp_get_category($source,$posts_type,$css_link='').'
								</div>';	
									
				}
				
				if($social == 'true') {
									
            		echo ewmp_woocommerceheaderproducts_post_social_share();					

				}

            	echo '<div class="title-info-post">
							<h2 class="title-post">
								<a href="'.$link.'">'.get_the_title().'</a>
							</h2>';
				
					echo '<div class="price-content"><span class="regular-price';
						
						if(!empty($price_sales) || $price_sales != '') {
							echo ' line-through';	
						}
						
						echo '">'. $price . ' ' . $symbol .'</span>';
						
						if(!empty($price_sales) || $price_sales != '') {
							echo '<span class="sale-price">'. $price_sales . ' ' .$symbol .'</span>';
						}
				
					echo '</div>';

				echo '<div class="cart-button-container">
					<a class="product_type_simple add_to_cart_button ajax_add_to_cart" data-product_sku="" data-product_id="'.$id_post.'" rel="nofollow" href="?add-to-cart='.$id_post.'">'.esc_html__('Add To Cart','elementorwidgetsmegapack').'</a>
				</div>';				
				
				if(!empty($price_sales) || $price_sales != '') {
					echo '<div class="info-post"><span class="item-sale">'.esc_html__('Sale','elementorwidgetsmegapack').'</span></div>';	
				}	
				
            	echo '</div></div>'; 		
		
			} else {			

				if($count == '1') { $count_class = 'first'; $columns_class = 'ad_one_fifth'; }
				if($count == '2') { $count_class = 'second'; $columns_class = 'ad_one_fifth'; }
				if($count == '3') { $count_class = 'third'; $columns_class = 'ad_two_fifth'; }

				
				echo '<style>.woocommerceheaderproducts.wpmp_post_display3.wpmepack-header-'.$instance.' .wpmepack-element-'.$count.' { background-image:url('.ewmp_thumbs_url($id_post).'); }</style>';		
				
				echo '<div class="woocommerceheaderproducts-item '.$columns_class.' ad_margin wpmepack-element-'.$count.' '.$count_class.'">';
					
					if($category_show == 'true') {
					
						echo '<div class="category">
										'.ewmp_get_category($source,$posts_type,$css_link='').'
									</div>';	
										
					}

					if($social == 'true') {
										
						echo ewmp_woocommerceheaderproducts_post_social_share();					
	
					}
					
				   echo ' <div class="title-info-post">
						<h4 class="title-post">
							<a href="'.$link.'">'.get_the_title().'</a>
						</h4>';
						
					echo '<div class="price-content"><span class="regular-price';
						
						if(!empty($price_sales) || $price_sales != '') {
							echo ' line-through';	
						}
						
						echo '">'. $price . ' ' . $symbol .'</span>';
						
						if(!empty($price_sales) || $price_sales != '') {
							echo '<span class="sale-price">'. $price_sales . ' ' .$symbol .'</span>';
						}
				
					echo '</div>';

				echo '<div class="cart-button-container">
					<a class="product_type_simple add_to_cart_button ajax_add_to_cart" data-product_sku="" data-product_id="'.$id_post.'" rel="nofollow" href="?add-to-cart='.$id_post.'">'.esc_html__('Add To Cart','elementorwidgetsmegapack').'</a>
				</div>';
			
			echo '</div>'; /* #Close title-info-post */  
				   
			echo '</div>'; 		
				
			}
			
			} else {
				
				/**********************************************************************/
				/****************************** LAYOUT 2 ******************************/
				/**********************************************************************/				
				
				if($count == '0') {
				
					echo '<style>.woocommerceheaderproducts.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .wpmepack-element-'.$count.' { background-image:url('.ewmp_thumbs_url($id_post).'); }</style>';		
					echo '<div class="woocommerceheaderproducts-item ad_three_fifth big-post wpmepack-element-'.$count.'">';				
					if($category_show == 'true') { echo '<div class="category">'.ewmp_get_category($source,$posts_type,$css_link='').'</div>'; }
									
					if($social == 'true') { echo ewmp_woocommerceheaderproducts_post_social_share(); }				
				
            		echo '<div class="title-info-post"><h2 class="title-post"><a href="'.$link.'">'.get_the_title().'</a></h2>';			
					echo '<div class="price-content"><span class="regular-price';
						
						if(!empty($price_sales) || $price_sales != '') {
							echo ' line-through';	
						}
						
						echo '">'. $price . ' ' . $symbol .'</span>';
						
						if(!empty($price_sales) || $price_sales != '') {
							echo '<span class="sale-price">'. $price_sales . ' ' .$symbol .'</span>';
						}
				
					echo '</div>';
				
					echo '<div class="cart-button-container">
						<a class="product_type_simple add_to_cart_button ajax_add_to_cart" data-product_sku="" data-product_id="'.$id_post.'" rel="nofollow" href="?add-to-cart='.$id_post.'">'.esc_html__('Add To Cart','elementorwidgetsmegapack').'</a>
					</div>';
									
					if(!empty($price_sales) || $price_sales != '') {
						echo '<div class="info-post"><span class="item-sale">'.esc_html__('Sale','elementorwidgetsmegapack').'</span></div>';	
					}					echo '</div>';				
					echo '</div>';					
				
				} else {
							
					if($count == '1') { $count_class = 'first'; $columns_class = 'ad_one_fifth'; }
					if($count == '2') { $count_class = 'second'; $columns_class = 'ad_one_fifth'; }
					if($count == '3') { $count_class = 'third'; $columns_class = 'ad_two_fifth'; }					
					
					echo '<style>.woocommerceheaderproducts.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .wpmepack-element-'.$count.' { background-image:url('.ewmp_thumbs_url($id_post).'); }</style>';
        			echo '<div class="woocommerceheaderproducts-item '.$columns_class.' ad_margin wpmepack-element-'.$count.' '.$count_class.'">';
						
					if($category_show == 'true') { echo '<div class="category">'.ewmp_get_category($source,$posts_type,$css_link='').'</div>'; }
            		
					if($social == 'true') { echo ewmp_woocommerceheaderproducts_post_social_share(); }
					
					echo '<div class="box-post">';				
               			echo '<div class="title-info-post"><h4 class="title-post"><a href="'.$link.'">'.get_the_title().'</a></h4>';
					echo '<div class="price-content"><span class="regular-price';
						
						if(!empty($price_sales) || $price_sales != '') {
							echo ' line-through';	
						}
						
						echo '">'. $price . ' ' . $symbol .'</span>';
						
						if(!empty($price_sales) || $price_sales != '') {
							echo '<span class="sale-price">'. $price_sales . ' ' .$symbol .'</span>';
						}
				
					echo '</div>';
				
					echo '<div class="cart-button-container">
						<a class="product_type_simple add_to_cart_button ajax_add_to_cart" data-product_sku="" data-product_id="'.$id_post.'" rel="nofollow" href="?add-to-cart='.$id_post.'">'.esc_html__('Add To Cart','elementorwidgetsmegapack').'</a>
					</div>';						
					echo '</div>';
					echo '</div>';
									
					echo '</div>';		
					
					
				} // #COUNT			
				
			} // #LAYOUT 2
			
		} // #TYPE 3	
		
		
		/**********************************************************************/
		/******************************** TYPE 4 ******************************/
		/**********************************************************************/
				
		if($type == 'type4') {	
				
			if($layout == 'layout1') {
				
				/**********************************************************************/
				/****************************** LAYOUT 1 ******************************/
				/**********************************************************************/
				
				echo '<div class="woocommerceheaderproducts-item ad_one_one ad_last big-post first item wpmepack-element-'.$count.'">';
				
				echo '<style>.woocommerceheaderproducts.wpmp_post_display4.wpmepack-header-'.$instance.' .wpmepack-element-'.$count.' { background-image:url('.ewmp_thumbs_url($id_post).'); }</style>';		

				if($social == 'true') {
									
            		echo ewmp_woocommerceheaderproducts_post_social_share();					

				}
	
				echo '<div class="title-info-post">';
		
				if($category_show == 'true') {
					
						echo '<div class="category">
										'.ewmp_get_category($source,$posts_type,$css_link='').'
									</div>';	
										
				}
		
				echo '<h2 class="title-post">
								<a href="'.$link.'">'.get_the_title().'</a>
							</h2>';
							
					echo '<div class="price-content"><span class="regular-price';
						
						if(!empty($price_sales) || $price_sales != '') {
							echo ' line-through';	
						}
						
						echo '">'. $price . ' ' . $symbol .'</span>';
						
						if(!empty($price_sales) || $price_sales != '') {
							echo '<span class="sale-price">'. $price_sales . ' ' .$symbol .'</span>';
						}
				
					echo '</div>';
				
				echo '<div class="cart-button-container">
					<a class="product_type_simple add_to_cart_button ajax_add_to_cart" data-product_sku="" data-product_id="'.$id_post.'" rel="nofollow" href="?add-to-cart='.$id_post.'">'.esc_html__('Add To Cart','elementorwidgetsmegapack').'</a>
				</div>';
								
				if(!empty($price_sales) || $price_sales != '') {
					echo '<div class="info-post"><span class="item-sale">'.esc_html__('Sale','elementorwidgetsmegapack').'</span></div>';	
				}								
							
				echo '</div></div>';		
		
			} else {
				
				/**********************************************************************/
				/****************************** LAYOUT 2 ******************************/
				/**********************************************************************/				

				echo '<div class="woocommerceheaderproducts-item ad_one_one ad_last big-post first item wpmepack-element-'.$count.'">';		
				echo '<style>.woocommerceheaderproducts.wpmp_post_display4_bis.wpmepack-header-'.$instance.' .wpmepack-element-'.$count.' { background-image:url('.ewmp_thumbs_url($id_post).'); }</style>';		
				
				if($category_show == 'true') { echo '<div class="category">'.ewmp_get_category($source,$posts_type,$css_link='').'</div>'; }				
				if($social == 'true') { echo ewmp_woocommerceheaderproducts_post_social_share(); }
				echo '<div class="title-info-post">';				
					echo '<h2 class="title-post"><a href="'.$link.'">'.get_the_title().'</a></h2>';
					echo '<div class="price-content"><span class="regular-price';
						
						if(!empty($price_sales) || $price_sales != '') {
							echo ' line-through';	
						}
						
						echo '">'. $price . ' ' . $symbol .'</span>';
						
						if(!empty($price_sales) || $price_sales != '') {
							echo '<span class="sale-price">'. $price_sales . ' ' .$symbol .'</span>';
						}
				
					echo '</div>';
				
				echo '<div class="cart-button-container">
					<a class="product_type_simple add_to_cart_button ajax_add_to_cart" data-product_sku="" data-product_id="'.$id_post.'" rel="nofollow" href="?add-to-cart='.$id_post.'">'.esc_html__('Add To Cart','elementorwidgetsmegapack').'</a>
				</div>';
								
				if(!empty($price_sales) || $price_sales != '') {
					echo '<div class="info-post"><span class="item-sale">'.esc_html__('Sale','elementorwidgetsmegapack').'</span></div>';	
				}	

				echo '</div>';
				
				echo '</div>';
				
			} // #LAYOUT 2
			
		} // #TYPE 4		
			
		$count++;
		endwhile; // #WHILE
		} // #LOOP	
		
		// RETURN VALUE FOR TYPE 5
		if($type == 'type5') {
			if($layout == 'layout1') { 
			
				echo '<script>jQuery(document).ready(function($){';
				
				echo '$(".wpmp_post_display5 .mini-post .title-post a").on(\'click\', function(event) {
					var id_value = $(this).attr(\'id\');
					$(this).parent().parent().parent().parent().find(\'.ad_two_third\').css("display", "none");
					$(this).parent().parent().parent().parent().find(\'.\' + id_value).parent().fadeIn();
				})';
				
				echo '});	</script>';
			
				echo ''.$type5_big_post . $type5_small_post; 
			
			} else { 
			
				echo '<script>jQuery(document).ready(function($){';
				
				echo '$(".wpmp_post_display5_bis .mini-post .title-post a").on(\'click\', function(event) {
					var id_value = $(this).attr(\'id\');
					$(this).parent().parent().parent().parent().parent().find(\'.ad_two_third\').css("display", "none");
					$(this).parent().parent().parent().parent().parent().find(\'.\' + id_value).parent().fadeIn();
				})';
				
				echo '});	</script>';			
			
				echo  '<div class="ad_one_third">'.$type5_small_post.'</div>' . $type5_big_post; 
			}
		}	
				
		echo '</div>';
		
		echo '<div class="wpmp-clear"></div>';		
		
		
		wp_reset_query();
		echo '</div>';
		

		
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
