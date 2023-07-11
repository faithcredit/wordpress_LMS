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
 * Elementor Header Blocks
 *
 * Elementor widget for team vision
 *
 * @since 1.0.0
 */
class Header_Blocks extends Widget_Base {

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
		return 'header-blocks';
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
		return esc_html__( 'Header Blocks', 'elementorwidgetsmegapack' );
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
			'date',
			[
				'label' => esc_html__( 'Show Date', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => [
					'true' => esc_html__('Show', 'elementorwidgetsmegapack' ),
					'false' => esc_html__('Hidden', 'elementorwidgetsmegapack' )
				]
			]
		);

		$this->add_control(
			'date_format',
			[
				'label' => esc_html__( 'Date Format', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'F j, Y g:i a',
				'options' => [
				  	'F j, Y g:i a' 		=> esc_html__('November 6, 2010 12:50 am','headerblocks'),
					'F j, Y' 			=> esc_html__('November 6, 2010','headerblocks'),
				  	'F, Y' 				=> esc_html__('November, 2010','headerblocks'),
					'g:i a'				=> esc_html__('12:50 am','headerblocks'),
				  	'g:i:s a'			=> esc_html__('12:50:48 am','headerblocks'),
					'l, F jS, Y'		=> esc_html__('Saturday, November 6th, 2010','headerblocks'),
				  	'M j, Y @ G:i'		=> esc_html__('Nov 6, 2010 @ 0:50','headerblocks'),
					'Y/m/d \a\t g:i A'	=> esc_html__('2010/11/06 at 12:50 AM','headerblocks'),
				  	'Y/m/d \a\t g:ia'	=> esc_html__('2010/11/06 at 12:50am','headerblocks'),
					'Y/m/d g:i:s A'		=> esc_html__('2010/11/06 12:50:48 AM','headerblocks'),
					'Y/m/d'				=> esc_html__('2010/11/06','headerblocks')						
				],
				'condition'	=> [
					'date'	=> 'true'
				]				
			]
		);

		$this->add_control(
			'comments',
			[
				'label' => esc_html__( 'Show comments', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => [
					'true' => esc_html__('Show', 'elementorwidgetsmegapack' ),
					'false' => esc_html__('Hidden', 'elementorwidgetsmegapack' )
				]
			]
		);
		
		$this->add_control(
			'author',
			[
				'label' => esc_html__( 'Show Author', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => [
					'true' => esc_html__('Show', 'elementorwidgetsmegapack' ),
					'false' => esc_html__('Hidden', 'elementorwidgetsmegapack' )
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
			'view',
			[
				'label' => esc_html__( 'Show Views', 'elementorwidgetsmegapack' ),
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
  				'label' => esc_html__( 'QUERY', 'essential-addons-elementor' )
  			]
		);

		$this->add_control(
			'source',
			[
				'label' => esc_html__( 'Source', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'wp_posts',
				'options' => [
					'wp_posts' 				=> esc_html__( 'Wordpress Posts', 'essential-addons-elementor' ),
					'post_type' 	=> esc_html__( 'Custom Posts Type', 'essential-addons-elementor' )
				]
			]
		);

		$this->add_control(
			'posts_source',
			[
				'label' => esc_html__( 'All Posts/Sticky posts', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'all_posts',
				'options' => [ 
					'all_posts' 			=> esc_html__( 'All Posts', 'essential-addons-elementor' ),
					'onlystickyposts'	=> esc_html__( 'Only Sticky Posts', 'essential-addons-elementor' )
				],
				'condition'	=> [
					'source'	=> 'wp_posts'
				]
			]
		);

		$this->add_control(
			'posts_type',
			[
				'label' => esc_html__( 'Select Post Type Source', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'options' => $this->grid_get_all_custom_post_types(),
				'condition'	=> [
					'source'	=> 'post_type'
				]
			]
		);

		$this->add_control(
			'categories',
			[
				'label' => esc_html__( 'Categories', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => $this->grid_get_all_post_type_categories('post'),
				'condition'	=> [
					'source'	=> 'wp_posts'
				]				
			]
		);

		$this->add_control(
			'order',
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
			'orderby',
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

		$this->end_controls_section();

  		$this->start_controls_section(
  			'section_settings',
  			[
  				'label' => esc_html__( 'Carousel Settings Style 4', 'elementorwidgetsmegapack' )
  			]
		);

		$this->add_control(
			'item_show',
			[
				'label' => esc_html__( 'Number Item Show', 'elementorwidgetsmegapack' ),
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
				'label' => esc_html__( 'Item Show for content between 600px to 900px', 'elementorwidgetsmegapack' ),
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
				'label' => esc_html__( 'Item Show for content between 0px to 599px', 'elementorwidgetsmegapack' ),
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
				'label' => esc_html__( 'Loop', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => [
					'true' 		=> esc_html__( 'On', 'elementorwidgetsmegapack' ),
					'false' 	=> esc_html__( 'Off', 'elementorwidgetsmegapack' )
				],
				'condition'	=> [
					'type'	=> 'type4'
				]
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label' => esc_html__( 'Autoplay (ms) - ex 2000 or leave empty for default', 'elementorwidgetsmegapack' ),
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
				'label' => esc_html__( 'Speed (ms) - ex 2000 or leave empty for default', 'elementorwidgetsmegapack' ),
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
				'label' => esc_html__( 'Margin between Items - empty to disable. Or for example: 10', 'elementorwidgetsmegapack' ),
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
				'label' => esc_html__( 'Navigation', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => [
					'true' 		=> esc_html__( 'Show', 'elementorwidgetsmegapack' ),
					'false' 	=> esc_html__( 'Hidden', 'elementorwidgetsmegapack' )
				],
				'condition'	=> [
					'type'	=> 'type4'
				]
			]
		);

		$this->add_control(
			'rtl',
			[
				'label' => esc_html__( 'RTL', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'false',
				'options' => [
					'true' 		=> esc_html__( 'On', 'elementorwidgetsmegapack' ),
					'false' 	=> esc_html__( 'Off', 'elementorwidgetsmegapack' )
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
        $date					= esc_html($settings['date']);
        $date_format			= esc_html($settings['date_format']);
        $comments				= esc_html($settings['comments']);
        $author					= esc_html($settings['author']);
        $view					= esc_html($settings['view']);
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
		$source					= esc_html($settings['source']);
		$posts_source			= esc_html($settings['posts_source']);
		$posts_type				= esc_html($settings['posts_type']);
		$categories				= '';
		if(!empty($settings['categories'])) {
			$num_cat = count($settings['categories']);
			$i = 1;
			foreach ( $settings['categories'] as $element ) {
				$categories .= $element;
				if($i != $num_cat) {
					$categories .= ',';
				}
				$i++;
			}		
		}		
		$categories_post_type	= '';
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
				$header_type = 'wpmp_post_display4 headerblocks-owl-carousel'; 
			} else {
				$header_type = 'wpmp_post_display4_bis headerblocks-owl-carousel';
			}
			$num_posts = '';
			wp_enqueue_script( 'owlcarousel' );	
			wp_enqueue_style( 'owlcarousel' );
			wp_enqueue_style( 'owltheme' );	
			wp_enqueue_script( 'headerblocks' );			
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
			echo ewmp_header_custom_style($instance,$type,$layout,$maincolor,$secondarycolor,$thirdcolor);
		}
		
		wp_enqueue_style( 'animations' );
		wp_enqueue_script( 'appear' );			
		wp_enqueue_script( 'animate' );		
		wp_enqueue_style( 'fonts-vc' );
		wp_enqueue_style( 'font-awesome' );
		
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
			echo '<div class="headerblocks '.$header_type.' wpmepack-header-'.$instance.' '.ewmp_animate_class($addon_animate,$effect,$delay).'>';
		} else {
			echo '<div 
							data-headerblocks-owl-items="'.esc_html($item_show).'" 
							data-headerblocks-owl-items-900="'.esc_html($item_show_900).'" 
							data-headerblocks-owl-items-600="'.esc_html($item_show_600).'" 
							data-headerblocks-owl-loop="'.esc_html($loop).'" 
							data-headerblocks-owl-autoplay="'.esc_html($autoplay).'" 
							data-headerblocks-owl-smart-speed="'.esc_html($smart_speed).'" 
							data-headerblocks-owl-navigation="'.esc_html($navigation).'" 
							data-headerblocks-owl-pagination="false" 
							data-headerblocks-owl-margin="'.esc_html($margin).'" 
							data-headerblocks-owl-rtl="'.esc_html($rtl).'"				
			class="headerblocks '.$header_type.' wpmepack-header-'.$instance.' '.ewmp_animate_class($addon_animate,$effect,$delay).'>';
		}
		$loop = new \WP_Query($query);
		if($loop) { 
		while ( $loop->have_posts() ) : $loop->the_post();
		$id_post = get_the_id();
		$link = get_permalink(); 
		
		/**********************************************************************/
		/******************************** TYPE 1 ******************************/
		/**********************************************************************/
				
		if($type == 'type1') {

			if($layout == 'layout1') {

				/**********************************************************************/
				/****************************** LAYOUT 1 ******************************/
				/**********************************************************************/			

			if($count == '0') {
				
				echo '<style>.headerblocks.wpmp_post_display1.wpmepack-header-'.$instance.' .ad_three_fifth { background-image:url('.ewmp_thumbs_url($id_post).'); }</style>';		

				echo '<div class="headerblocks-item ad_three_fifth big-post">';
				
				if($category_show == 'true') {
				
					echo '<div class="category">
									'.ewmp_get_category($source,$posts_type,$css_link = '').'
								</div>';	
									
				}
				
				if($social == 'true') {
									
            		echo ewmp_headerblocks_post_social_share($css_link = '');					

				}

            	echo '<div class="title-info-post">
							<h2 class="title-post">
								<a href="'.$link.'">'.get_the_title().'</a>
							</h2>';
				
				if($date == 'true') {
							
					echo  '<span class="data"><div class="fa fa-calendar icon-calendar"></div>'.get_the_date($date_format).'</span>';
				
				}
				
				
				if( $comments == 'true' || 
					$author == 'true' || 
					$view == 'true'  ) {
				
					echo '<div class="info-post">';
				
				}
				
				if($comments == 'true') {
				
					echo '<a href="'.get_comments_link().'" class="comments"><i class="fa fa-comments"></i>'.get_comments_number().'</a>';
					
					if($author == 'true' || $view == 'true') {
					
						echo '<div class="separator">-</div>';
						
					}
					
				}
				
				if($author == 'true') {
						
					echo '<a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'"><i class="fa fa-user"></i>'.get_the_author_meta( 'display_name' ).'</a>';
								
								
					if($view == 'true') {
					
						echo '<div class="separator">-</div>';
						
					}
					
				}			
					
				if($view == 'true') {
						
					echo '<span class="view"><i class="fa fa-eye"></i>'.ewmp_get_post_views(get_the_ID()).'</span>';
						
				}
				
				if( $comments == 'true' || 
					$author == 'true' || 
					$view == 'true'  ) {
				
						echo '</div>'; // #INFO-POST
                
					}
				
            	echo '</div></div>'; 

			
			} else { // OTHERS POSTS
			
				echo '<style>.headerblocks.wpmp_post_display1.wpmepack-header-'.$instance.' .headerblocks-item.ad_two_fifth.wpmepack-element-'.$count.' { background-image:url('.ewmp_thumbs_url($id_post).'); }</style>';		
				
				echo  '<div class="headerblocks-item ad_two_fifth ad_margin first wpmepack-element-'.$count.'">';
				
				if($category_show == 'true') {
				
					echo '<div class="category">
									'.ewmp_get_category($source,$posts_type,$css_link = '').'
								</div>';	
									
				}
				
				if($social == 'true') {
									
            		echo ewmp_headerblocks_post_social_share($css_link = '');					

				}

            	echo '<div class="title-info-post">
							<h2 class="title-post">
								<a href="'.$link.'">'.get_the_title().'</a>
							</h2>';
				
				if($date == 'true') {
							
					echo  '<span class="data"><div class="fa fa-calendar icon-calendar"></div>'.get_the_date($date_format).'</span>';
				
				}
				
				
				if( $comments == 'true' || 
					$author == 'true' || 
					$view == 'true'  ) {
				
					echo '<div class="info-post">';
				
				}
				
				if($comments == 'true') {
				
					echo '<a href="'.get_comments_link().'" class="comments"><i class="fa fa-comments"></i>'.get_comments_number().'</a>';
					
					if($author == 'true' || $view == 'true') {
					
						echo '<div class="separator">-</div>';
						
					}
					
				}
				
				if($author == 'true') {
						
					echo '<a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'"><i class="fa fa-user"></i>'.get_the_author_meta( 'display_name' ).'</a>';
								
								
					if($view == 'true') {
					
						echo '<div class="separator">-</div>';
						
					}
					
				}			
					
				if($view == 'true') {
						
					echo '<span class="view"><i class="fa fa-eye"></i>'.ewmp_get_post_views(get_the_ID()).'</span>';
						
				}
				
				if( $comments == 'true' || 
					$author == 'true' || 
					$view == 'true'  ) {
				
						echo '</div>'; // #INFO-POST
                
					}
				
            	echo '</div></div>'; 	
				
			
			
			}
		
			} else {

				/**********************************************************************/
				/****************************** LAYOUT 2 ******************************/
				/**********************************************************************/
				
				if($count == '0') {
					
					echo '<style>.headerblocks.wpmp_post_display1_bis.wpmepack-header-'.$instance.' .ad_three_fifth { background-image:url('.ewmp_thumbs_url($id_post).'); }</style>';
					echo '<div class="headerblocks-item ad_three_fifth big-post">';				
					if($category_show == 'true') { echo '<div class="category">'.ewmp_get_category($source,$posts_type,$css_link = '').'</div>'; }	
					
					if( $comments == 'true' || $author == 'true' || $view == 'true'  ) { echo '<div class="info-post">'; }
						if($comments == 'true') {	echo '<a href="'.get_comments_link().'" class="comments"><i class="fa fa-comments"></i>'.get_comments_number().'</a>';
							if($author == 'true' || $view == 'true') {	echo '<div class="separator">-</div>'; }
						}				
						if($author == 'true') { echo '<a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'"><i class="fa fa-user"></i>'.get_the_author_meta( 'display_name' ).'</a>';
							if($view == 'true') { echo '<div class="separator">-</div>'; }
						}					
						if($view == 'true') { echo '<span class="view"><i class="fa fa-eye"></i>'.ewmp_get_post_views(get_the_ID()).'</span>'; }
					if( $comments == 'true' || $author == 'true' || $view == 'true'  ) { echo '</div>'; /* #INFO-POST */ }					
					
					if($social == 'true') { echo ewmp_headerblocks_post_social_share($css_link = ''); }
					
            		echo '<div class="title-info-post"><h2 class="title-post"><a href="'.$link.'">'.get_the_title().'</a></h2>';			
					if($date == 'true') { echo '<span class="data"><div class="fa fa-calendar icon-calendar"></div>'.get_the_date($date_format).'</span>'; }					
					echo '</div>';				
					echo '</div>';
				
				} else {				

					echo '<style>.headerblocks.wpmp_post_display1_bis.wpmepack-header-'.$instance.' .headerblocks-item.ad_two_fifth.wpmepack-element-'.$count.' { background-image:url('.ewmp_thumbs_url($id_post).'); }</style>';		
					echo  '<div class="headerblocks-item ad_two_fifth ad_margin first wpmepack-element-'.$count.'">';
					if($category_show == 'true') { echo '<div class="category">'.ewmp_get_category($source,$posts_type,$css_link = '').'</div>';	

					if( $comments == 'true' || $author == 'true' || $view == 'true'  ) { echo '<div class="info-post">'; }
						if($comments == 'true') {	echo '<a href="'.get_comments_link().'" class="comments"><i class="fa fa-comments"></i>'.get_comments_number().'</a>';
							if($author == 'true' || $view == 'true') {	echo '<div class="separator">-</div>'; }
						}				
						if($author == 'true') { echo '<a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'"><i class="fa fa-user"></i>'.get_the_author_meta( 'display_name' ).'</a>';
							if($view == 'true') { echo '<div class="separator">-</div>'; }
						}					
						if($view == 'true') { echo '<span class="view"><i class="fa fa-eye"></i>'.ewmp_get_post_views(get_the_ID()).'</span>'; }
					if( $comments == 'true' || $author == 'true' || $view == 'true'  ) { echo '</div>'; /* #INFO-POST */ }					

					if($social == 'true') { echo ewmp_headerblocks_post_social_share($css_link = ''); }
					
            		echo '<div class="title-info-post"><h2 class="title-post"><a href="'.$link.'">'.get_the_title().'</a></h2>';			
					if($date == 'true') { echo '<span class="data"><div class="fa fa-calendar icon-calendar"></div>'.get_the_date($date_format).'</span>'; }					
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
			
				echo '<style>.headerblocks.wpmp_post_display2.wpmepack-header-'.$instance.' .ad_one_one.ad_last.wpmepack-element-'.$count.' { background-image:url('.ewmp_thumbs_url($id_post).'); }</style>';		
		
				echo '<div class="headerblocks-item ad_one_one ad_last big-post wpmepack-element-'.$count.'">';
		
				if($category_show == 'true') {
				
					echo '<div class="category">
									'.ewmp_get_category($source,$posts_type,$css_link = '').'
								</div>';	
									
				}
				
				if($social == 'true') {
									
            		echo ewmp_headerblocks_post_social_share($css_link = '');					

				}

            	echo '<div class="title-info-post">
							<h2 class="title-post">
								<a href="'.$link.'">'.get_the_title().'</a>
							</h2>';
				
				if($date == 'true') {
							
					echo  '<span class="data"><div class="fa fa-calendar icon-calendar"></div>'.get_the_date($date_format).'</span>';
				
				}
				
				
				if( $comments == 'true' || 
					$author == 'true' || 
					$view == 'true'  ) {
				
					echo '<div class="info-post">';
				
				}
				
				if($comments == 'true') {
				
					echo '<a href="'.get_comments_link().'" class="comments"><i class="fa fa-comments"></i>'.get_comments_number().'</a>';
					
					if($author == 'true' || $view == 'true') {
					
						echo '<div class="separator">-</div>';
						
					}
					
				}
				
				if($author == 'true') {
						
					echo '<a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'"><i class="fa fa-user"></i>'.get_the_author_meta( 'display_name' ).'</a>';
								
								
					if($view == 'true') {
					
						echo '<div class="separator">-</div>';
						
					}
					
				}			
					
				if($view == 'true') {
						
					echo '<span class="view"><i class="fa fa-eye"></i>'.ewmp_get_post_views(get_the_ID()).'</span>';
						
				}
				
				if( $comments == 'true' || 
					$author == 'true' || 
					$view == 'true'  ) {
				
						echo '</div>'; // #INFO-POST
                
					}
				
            	echo '</div></div>'; 		
		
		} else {
			
				if($count == '1') { $count_class = 'first'; }
				if($count == '2') { $count_class = 'second'; }
				if($count == '3') { $count_class = 'third'; }
			
			echo '<style>.headerblocks.wpmp_post_display2.wpmepack-header-'.$instance.' .wpmepack-element-'.$count.' .photo { background-image:url('.ewmp_thumbs_url($id_post).'); }</style>';		
			
        	echo '<div class="headerblocks-item ad_one_third ad_margin wpmepack-element-'.$count.' '.$count_class.'"><div class="photo"></div>';
        	
            echo '<div class="box-post">';
                
				if($category_show == 'true') {
				
					echo '<div class="category">
									'.ewmp_get_category($source,$posts_type,$css_link = '').'
								</div>';	
									
				}
				
               echo ' <div class="title-info-post">
                    <h4 class="title-post">
                        <a href="'.$link.'">'.get_the_title().'</a>
                    </h4>';
					
				if($date == 'true') {
							
					echo  '<span class="data"><div class="fa fa-calendar icon-calendar"></div>'.get_the_date($date_format).'</span>';
				
				}                
				
				echo '</div>';
				
				
            echo '</div>';
			
			   
        echo '</div>';		
			
		}
		
			} else { 

				/**********************************************************************/
				/****************************** LAYOUT 2 ******************************/
				/**********************************************************************/				
				
				if($count == '0') {
				
					echo '<style>.headerblocks.wpmp_post_display2_bis.wpmepack-header-'.$instance.' .ad_one_one.ad_last.wpmepack-element-'.$count.' { background-image:url('.ewmp_thumbs_url($id_post).'); }</style>';	
					echo '<div class="headerblocks-item ad_one_one ad_last big-post wpmepack-element-'.$count.'">';				
					if($category_show == 'true') { echo '<div class="category">'.ewmp_get_category($source,$posts_type,$css_link = '').'</div>'; }				
				
					if( $comments == 'true' || $author == 'true' || $view == 'true'  ) { echo '<div class="info-post">'; }
						if($comments == 'true') {	echo '<a href="'.get_comments_link().'" class="comments"><i class="fa fa-comments"></i>'.get_comments_number().'</a>';
							if($author == 'true' || $view == 'true') {	echo '<div class="separator">-</div>'; }
						}				
						if($author == 'true') { echo '<a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'"><i class="fa fa-user"></i>'.get_the_author_meta( 'display_name' ).'</a>';
							if($view == 'true') { echo '<div class="separator">-</div>'; }
						}					
						if($view == 'true') { echo '<span class="view"><i class="fa fa-eye"></i>'.ewmp_get_post_views(get_the_ID()).'</span>'; }
					if( $comments == 'true' || $author == 'true' || $view == 'true'  ) { echo '</div>'; /* #INFO-POST */ }					
					
					if($social == 'true') { echo ewmp_headerblocks_post_social_share($css_link = ''); }
					
            		echo '<div class="title-info-post"><h2 class="title-post"><a href="'.$link.'">'.get_the_title().'</a></h2>';			
					if($date == 'true') { echo '<span class="data"><div class="fa fa-calendar icon-calendar"></div>'.get_the_date($date_format).'</span>'; }					
					echo '</div>';				
					echo '</div>';				
				
				} else {
					
					if($count == '1') { $count_class = 'first'; }
					if($count == '2') { $count_class = 'second'; }
					if($count == '3') { $count_class = 'third'; }					
					
					echo '<style>.headerblocks.wpmp_post_display2_bis.wpmepack-header-'.$instance.' .wpmepack-element-'.$count.' .photo { background-image:url('.ewmp_thumbs_url($id_post).'); }</style>';
        			echo '<div class="headerblocks-item ad_one_third ad_margin wpmepack-element-'.$count.' '.$count_class.'">';
					
					echo '<div class="photo">';	
						if($category_show == 'true') { echo '<div class="category">'.ewmp_get_category($source,$posts_type,$css_link = '').'</div>'; }	
					echo '</div>';
            		
					echo '<div class="box-post">';				
               			echo '<div class="title-info-post"><h4 class="title-post"><a href="'.$link.'">'.get_the_title().'</a></h4>';
						if($date == 'true') {	echo  '<span class="data"><div class="fa fa-calendar icon-calendar"></div>'.get_the_date($date_format).'</span>'; }				
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
				
		
				echo '<style>.headerblocks.wpmp_post_display3.wpmepack-header-'.$instance.' .wpmepack-element-'.$count.' { background-image:url('.ewmp_thumbs_url($id_post).'); }</style>';		
		
				echo '<div class="headerblocks-item ad_three_fifth big-post wpmepack-element-'.$count.'">';
		
				if($category_show == 'true') {
				
					echo '<div class="category">
									'.ewmp_get_category($source,$posts_type,$css_link = '').'
								</div>';	
									
				}
				
				if($social == 'true') {
									
            		echo ewmp_headerblocks_post_social_share($css_link = '');					

				}

            	echo '<div class="title-info-post">
							<h2 class="title-post">
								<a href="'.$link.'">'.get_the_title().'</a>
							</h2>';
				
				if($date == 'true') {
							
					echo  '<span class="data"><div class="fa fa-calendar icon-calendar"></div>'.get_the_date($date_format).'</span>';
				
				}
				
				
				if( $comments == 'true' || 
					$author == 'true' || 
					$view == 'true'  ) {
				
					echo '<div class="info-post">';
				
				}
				
				if($comments == 'true') {
				
					echo '<a href="'.get_comments_link().'" class="comments"><i class="fa fa-comments"></i>'.get_comments_number().'</a>';
					
					if($author == 'true' || $view == 'true') {
					
						echo '<div class="separator">-</div>';
						
					}
					
				}
				
				if($author == 'true') {
						
					echo '<a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'"><i class="fa fa-user"></i>'.get_the_author_meta( 'display_name' ).'</a>';
								
								
					if($view == 'true') {
					
						echo '<div class="separator">-</div>';
						
					}
					
				}			
					
				if($view == 'true') {
						
					echo '<span class="view"><i class="fa fa-eye"></i>'.ewmp_get_post_views(get_the_ID()).'</span>';
						
				}
				
				if( $comments == 'true' || 
					$author == 'true' || 
					$view == 'true'  ) {
				
						echo '</div>'; // #INFO-POST
                
					}
				
            	echo '</div></div>'; 		
		
			} else {			

				if($count == '1') { $count_class = 'first'; $columns_class = 'ad_one_fifth'; }
				if($count == '2') { $count_class = 'second'; $columns_class = 'ad_one_fifth'; }
				if($count == '3') { $count_class = 'third'; $columns_class = 'ad_two_fifth'; }

				
				echo '<style>.headerblocks.wpmp_post_display3.wpmepack-header-'.$instance.' .wpmepack-element-'.$count.' { background-image:url('.ewmp_thumbs_url($id_post).'); }</style>';		
				
				echo '<div class="headerblocks-item '.$columns_class.' ad_margin wpmepack-element-'.$count.' '.$count_class.'">';
					
					if($category_show == 'true') {
					
						echo '<div class="category">
										'.ewmp_get_category($source,$posts_type,$css_link = '').'
									</div>';	
										
					}

					if($social == 'true') {
										
						echo ewmp_headerblocks_post_social_share($css_link = '');					
	
					}
					
				   echo ' <div class="title-info-post">
						<h4 class="title-post">
							<a href="'.$link.'">'.get_the_title().'</a>
						</h4>';
						
					if($date == 'true') {
								
						echo  '<span class="data"><div class="fa fa-calendar icon-calendar"></div>'.get_the_date($date_format).'</span>';
					
					}    
					
				if($count == '3') { #COUNT 3
					
					if( $comments == 'true' || 
					$author == 'true' || 
					$view == 'true'  ) {
				
					echo '<div class="info-post">';
				
					}
				
					if($comments == 'true') {
					
						echo '<a href="'.get_comments_link().'" class="comments"><i class="fa fa-comments"></i>'.get_comments_number().'</a>';
						
						if($author == 'true' || $view == 'true') {
						
							echo '<div class="separator">-</div>';
							
						}
						
					}
				
					if($author == 'true') {
							
						echo '<a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'"><i class="fa fa-user"></i>'.get_the_author_meta( 'display_name' ).'</a>';
									
									
						if($view == 'true') {
						
							echo '<div class="separator">-</div>';
							
						}
						
					}			
					
					if($view == 'true') {
							
						echo '<span class="view"><i class="fa fa-eye"></i>'.ewmp_get_post_views(get_the_ID()).'</span>';
							
					}
				
					if( $comments == 'true' || 
					$author == 'true' || 
					$view == 'true'  ) {
				
						echo '</div>'; // #INFO-POST
                
					}
						
				
				   } #END IF COUNT 3
			
			echo '</div>'; /* #Close title-info-post */  
				   
			echo '</div>'; 		
				
			}
			
			} else {
				
				/**********************************************************************/
				/****************************** LAYOUT 2 ******************************/
				/**********************************************************************/				
				
				if($count == '0') {
				
					echo '<style>.headerblocks.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .wpmepack-element-'.$count.' { background-image:url('.ewmp_thumbs_url($id_post).'); }</style>';		
					echo '<div class="headerblocks-item ad_three_fifth big-post wpmepack-element-'.$count.'">';				
					if($category_show == 'true') { echo '<div class="category">'.ewmp_get_category($source,$posts_type,$css_link = '').'</div>'; }
				
					if( $comments == 'true' || $author == 'true' || $view == 'true'  ) { echo '<div class="info-post">'; }
						if($comments == 'true') {	echo '<a href="'.get_comments_link().'" class="comments"><i class="fa fa-comments"></i>'.get_comments_number().'</a>';
							if($author == 'true' || $view == 'true') {	echo '<div class="separator">-</div>'; }
						}				
						if($author == 'true') { echo '<a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'"><i class="fa fa-user"></i>'.get_the_author_meta( 'display_name' ).'</a>';
							if($view == 'true') { echo '<div class="separator">-</div>'; }
						}					
						if($view == 'true') { echo '<span class="view"><i class="fa fa-eye"></i>'.ewmp_get_post_views(get_the_ID()).'</span>'; }
					if( $comments == 'true' || $author == 'true' || $view == 'true'  ) { echo '</div>'; /* #INFO-POST */ }					
					
					if($social == 'true') { echo ewmp_headerblocks_post_social_share($css_link = ''); }				
				
            		echo '<div class="title-info-post"><h2 class="title-post"><a href="'.$link.'">'.get_the_title().'</a></h2>';			
					if($date == 'true') { echo '<span class="data"><div class="fa fa-calendar icon-calendar"></div>'.get_the_date($date_format).'</span>'; }					
					echo '</div>';				
					echo '</div>';					
				
				} else {
							
					if($count == '1') { $count_class = 'first'; $columns_class = 'ad_one_fifth'; }
					if($count == '2') { $count_class = 'second'; $columns_class = 'ad_one_fifth'; }
					if($count == '3') { $count_class = 'third'; $columns_class = 'ad_two_fifth'; }					
					
					echo '<style>.headerblocks.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .wpmepack-element-'.$count.' { background-image:url('.ewmp_thumbs_url($id_post).'); }</style>';
        			echo '<div class="headerblocks-item '.$columns_class.' ad_margin wpmepack-element-'.$count.' '.$count_class.'">';
						
					if($category_show == 'true') { echo '<div class="category">'.ewmp_get_category($source,$posts_type,$css_link = '').'</div>'; }	
					
					if($count == '3') {
					
						if( $comments == 'true' || $author == 'true' || $view == 'true'  ) { echo '<div class="info-post">'; }
							if($comments == 'true') {	echo '<a href="'.get_comments_link().'" class="comments"><i class="fa fa-comments"></i>'.get_comments_number().'</a>';
								if($author == 'true' || $view == 'true') {	echo '<div class="separator">-</div>'; }
							}				
							if($author == 'true') { echo '<a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'"><i class="fa fa-user"></i>'.get_the_author_meta( 'display_name' ).'</a>';
								if($view == 'true') { echo '<div class="separator">-</div>'; }
							}					
							if($view == 'true') { echo '<span class="view"><i class="fa fa-eye"></i>'.ewmp_get_post_views(get_the_ID()).'</span>'; }
						if( $comments == 'true' || $author == 'true' || $view == 'true'  ) { echo '</div>'; /* #INFO-POST */ }	

					}
            		
					if($social == 'true') { echo ewmp_headerblocks_post_social_share($css_link = ''); }
					
					echo '<div class="box-post">';				
               			echo '<div class="title-info-post"><h4 class="title-post"><a href="'.$link.'">'.get_the_title().'</a></h4>';
						if($date == 'true') {	echo  '<span class="data"><div class="fa fa-calendar icon-calendar"></div>'.get_the_date($date_format).'</span>'; }				
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
				
				echo '<div class="headerblocks-item ad_one_one ad_last big-post first item wpmepack-element-'.$count.'">';
				
				echo '<style>.headerblocks.wpmp_post_display4.wpmepack-header-'.$instance.' .wpmepack-element-'.$count.' { background-image:url('.ewmp_thumbs_url($id_post).'); }</style>';		

				if($social == 'true') {
									
            		echo ewmp_headerblocks_post_social_share($css_link = '');					

				}
	
				echo '<div class="title-info-post">';
		
				if($category_show == 'true') {
					
						echo '<div class="category">
										'.ewmp_get_category($source,$posts_type,$css_link = '').'
									</div>';	
										
				}
		
				echo '<h2 class="title-post">
								<a href="'.$link.'">'.get_the_title().'</a>
							</h2>';
							
				if($date == 'true') {
								
						echo  '<span class="data"><div class="fa fa-calendar icon-calendar"></div>'.get_the_date($date_format).'</span>';
					
				}							
							
				echo '</div></div>';		
		
			} else {
				
				/**********************************************************************/
				/****************************** LAYOUT 2 ******************************/
				/**********************************************************************/				

				echo '<div class="headerblocks-item ad_one_one ad_last big-post first item wpmepack-element-'.$count.'">';		
				echo '<style>.headerblocks.wpmp_post_display4_bis.wpmepack-header-'.$instance.' .wpmepack-element-'.$count.' { background-image:url('.ewmp_thumbs_url($id_post).'); }</style>';		
				
				if($category_show == 'true') { echo '<div class="category">'.ewmp_get_category($source,$posts_type,$css_link = '').'</div>'; }				
				if($social == 'true') { echo ewmp_headerblocks_post_social_share($css_link = ''); }
				echo '<div class="title-info-post">';				
					echo '<h2 class="title-post"><a href="'.$link.'">'.get_the_title().'</a></h2>';
					if($date == 'true') { echo  '<span class="data"><div class="fa fa-calendar icon-calendar"></div>'.get_the_date($date_format).'</span>'; }				
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
