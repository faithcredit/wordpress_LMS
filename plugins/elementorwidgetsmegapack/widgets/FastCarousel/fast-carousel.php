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
 * Elementor Fast Carousel
 *
 * Elementor widget for fast gallery
 *
 * @since 1.0.0
 */
class Fast_Carousel extends Widget_Base {

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
		return 'fast-carousel';
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
		return esc_html__( 'Fast Carousel', 'elementorwidgetsmegapack' );
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
			'fg_gallery_name',
			[
				'label' => esc_html__( 'Title Gallery', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'fg_gallery_name_show',
			[
				'label' => esc_html__( 'Carousel Name Show', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'false',
				'options' => [
					'false' => 'Hidden',
					'true'  => 'Show'
				]
			]
		);

		$this->add_control(
			'fg_type',
			[
				'label' => esc_html__( 'Carousel Type', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'magnific-popup',
				'options' => [
					'prettyphoto' 		=> 'PrettyPhoto',
					'magnific-popup' 	=> 'Magnific Popup',
					'lightgallery' 		=> 'Light Gallery',
					'custom_url' 		=> 'Custom Url',
					'only_image' 		=> 'Only Image (no Lightbox)' 
				]
			]
		);

		$this->add_control(
			'images',
			[
				'label' => esc_html__( 'Add Images', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::GALLERY,
				'default' => [],
			]
		);

		$this->end_controls_section();

  		$this->start_controls_section(
  			'section_options',
  			[
  				'label' => esc_html__( 'Options', 'essential-addons-elementor' )
  			]
		);

		$this->add_control(
			'fg_over_image',
			[
				'label' => esc_html__( 'Over Image', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'fg_over_image_on',
				'options' => [
					'fg_over_image_on' 	=> 'On',
					'fg_over_image_off'	=> 'Off'
				]
			]
		);

		$this->add_control(
			'fg_caption',
			[
				'label' => esc_html__( 'Show Caption Image', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'on',
				'options' => [
					'on' 	=> 'On',
					'off'	=> 'Off'
				]
			]
		);

		$this->end_controls_section();

  		$this->start_controls_section(
  			'section_settings',
  			[
  				'label' => esc_html__( 'Settings', 'elementor-logo-showcase' )
  			]
		);

		$this->add_control(
			'item_show',
			[
				'label' => esc_html__( 'Number Item Show', 'elementor-logo-showcase' ),
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
				]
			]
		);

		$this->add_control(
			'item_show_900',
			[
				'label' => esc_html__( 'Item Show for content between 600px to 900px', 'elementor-logo-showcase' ),
				'type' => Controls_Manager::SELECT,
				'label_block' => true,
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
				]
			]
		);
		
		$this->add_control(
			'item_show_600',
			[
				'label' => esc_html__( 'Item Show for content between 0px to 599px', 'elementor-logo-showcase' ),
				'type' => Controls_Manager::SELECT,
				'default' => '4',
				'label_block' => true,
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
				]
			]
		);		

		$this->add_control(
			'loop',
			[
				'label' => esc_html__( 'Loop', 'elementor-logo-showcase' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => [
					'true' 		=> esc_html__( 'On', 'elementor-logo-showcase' ),
					'false' 	=> esc_html__( 'Off', 'elementor-logo-showcase' )
				]
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label' => esc_html__( 'Autoplay (ms) - ex 2000 or leave empty for default', 'elementor-logo-showcase' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => '2000'
			]
		);

		$this->add_control(
			'smart_speed',
			[
				'label' => esc_html__( 'Speed (ms) - ex 2000 or leave empty for default', 'elementor-logo-showcase' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => '2000'
			]
		);
		
		$this->add_control(
			'margin',
			[
				'label' => esc_html__( 'Margin between Items - empty to disable. Or for example: 10', 'elementor-logo-showcase' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => ''
			]
		);		

		$this->add_control(
			'navigation',
			[
				'label' => esc_html__( 'Navigation', 'elementor-logo-showcase' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => [
					'true' 		=> esc_html__( 'Show', 'elementor-logo-showcase' ),
					'false' 	=> esc_html__( 'Hidden', 'elementor-logo-showcase' )
				]
			]
		);
		
		$this->add_control(
			'pagination',
			[
				'label' => esc_html__( 'Pagination', 'elementor-logo-showcase' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => [
					'true' 		=> esc_html__( 'Show', 'elementor-logo-showcase' ),
					'false' 	=> esc_html__( 'Hidden', 'elementor-logo-showcase' )
				]
			]
		);

		$this->add_control(
			'rtl',
			[
				'label' => esc_html__( 'RTL', 'elementor-logo-showcase' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'false',
				'options' => [
					'true' 		=> esc_html__( 'On', 'elementor-logo-showcase' ),
					'false' 	=> esc_html__( 'Off', 'elementor-logo-showcase' )
				]
			]
		);

		$this->end_controls_section();

		// Lightbox Option
  		$this->start_controls_section(
  			'section_lightbox_options',
  			[
  				'label' => esc_html__( 'Lightbox Options', 'essential-addons-elementor' )
  			]
		);

		// PrettyPhoto
		$this->add_control(
			'pp_animation_speed',
			[
				'label' => esc_html__( 'Animation Speed', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'fast',
				'options' => [
					'fast'		=> 'Fast',
					'normal' 	=> 'Normal',					
					'slow' 		=> 'Slow'					
				],
				'condition'	=> [
					'fg_type'	=> 'prettyphoto'
				]
			]
		);

		$this->add_control(
			'pp_autoplay',
			[
				'label' => esc_html__( 'Autoplay', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => [
					'true'		=> 'On',
					'false' 	=> 'Off'					
				],
				'condition'	=> [
					'fg_type'	=> 'prettyphoto'
				]
			]
		);

		$this->add_control(
			'pp_time',
			[
				'label' => esc_html__( 'Autoplay Time in ms (1000 = 1sec)', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::TEXT,
				'default' => '2000',
				'condition'	=> [
					'fg_type'	=> 'prettyphoto'
				]
			]
		);

		$this->add_control(
			'pp_title',
			[
				'label' => esc_html__( 'Show Title', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => [
					'true'		=> 'On',
					'false' 	=> 'Off'					
				],
				'condition'	=> [
					'fg_type'	=> 'prettyphoto'
				]
			]
		);

		$this->add_control(
			'pp_social',
			[
				'label' => esc_html__( 'Show Social', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => [
					'true'		=> 'On',
					'false' 	=> 'Off'					
				],
				'condition'	=> [
					'fg_type'	=> 'prettyphoto'
				]
			]
		);

		// Light Gallery

		$this->add_control(
			'lg_mode',
			[
				'label' => esc_html__( 'Mode', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'lg-slide',
				'options' => [
					'lg-slide'	=> 'Slide',
					'lg-fade' => 'Fade'				
				],
				'condition'	=> [
					'fg_type'	=> 'lightgallery'
				]
			]
		);

		$this->add_control(
			'lg_speed',
			[
				'label' => esc_html__( 'Speed time in ms', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::TEXT,
				'default' => '2000',
				'condition'	=> [
					'fg_type'	=> 'lightgallery'
				]
			]
		);

		$this->add_control(
			'lg_thumbnail',
			[
				'label' => esc_html__( 'Thumbnail', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => [
					'true'	=> 'On',
					'false' => 'Off'				
				],
				'condition'	=> [
					'fg_type'	=> 'lightgallery'
				]
			]
		);

		$this->add_control(
			'lg_controls',
			[
				'label' => esc_html__( 'Controls', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => [
					'true'	=> 'On',
					'false' => 'Off'				
				],
				'condition'	=> [
					'fg_type'	=> 'lightgallery'
				]
			]
		);
		
		// Custom URL

		$this->add_control(
			'custom_url_target',
			[
				'label' => esc_html__( 'Target', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => '_blank',
				'options' => [
					'_blank'	=> 'Blank (New Window)',
					'_selft' 	=> 'Self (Same Widow)'				
				],
				'condition'	=> [
					'fg_type'	=> 'custom_url'
				]
			]
		);		
		
		$this->end_controls_section();

		$this->start_controls_section(
			'section_thumbnails',
			[
				'label' => esc_html__( 'Thumbnails Options', 'elementorwidgetsmegapack' )
			]
		);

		$this->add_control(
			'fg_thumbs_grid',
			[
				'label' => esc_html__( 'Grid Thumbnails Size', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'fg-normal',
				'options' => [
					'fg-normal'	=> 'Default (800px)',
					'thumbnail' => 'Thumbnail',				
					'medium' 	=> 'Medium',				
					'large' 	=> 'Large',				
					'full' 		=> 'Full'			
				]
			]
		);

		$this->add_control(
			'fg_thumbs_lightbox',
			[
				'label' => esc_html__( 'Lightbox Thumbs', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'large',
				'options' => [
					'large' 		=> 'Large (Default)',
					'full' 			=> 'Full',
					'medium' 		=> 'Medium',
					'thumbnail' 	=> 'Thumbnail'							
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
			'fg_animate',
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
			'fg_animate_effect',
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
					'fg_animate'	=> 'on'
				]
			]
		);			

		$this->add_control(
			'fg_delay',
			[
				'label' => esc_html__( 'Animate Delay (ms)', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::TEXT,
				'default' => '1000',
				'condition'	=> [
					'fg_animate'	=> 'on'
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
			'fg_style',
			[
				'label' => esc_html__( 'Style', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'fg_style1',
				'options' => [
						'fg_style1' 	=> 'Style 1',
						'fg_style2' 	=> 'Style 2',
						'fg_style3' 	=> 'Style 3',
						'fg_style4' 	=> 'Style 4',
						'fg_style5' 	=> 'Style 5',
						'fg_style6' 	=> 'Style 6',
						'fg_style7' 	=> 'Style 7',
						'fg_style8' 	=> 'Style 8',
						'fg_style9' 	=> 'Style 9',
						'fg_style10' 	=> 'Style 10',
						'fg_style11' 	=> 'Style 11',
						'fg_style12' 	=> 'Style 12',
						'fg_no_style'  	=> 'No Style'
				]
			]
		);

		$this->add_control(
			'fg_nav_style',
			[
				'label' => esc_html__( 'Navigation Style', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'fc_nav_style1',
				'options' => [
						'fc_nav_style1' 	=> 'Style 1',
						'fc_nav_style2' 	=> 'Style 2',
						'fc_nav_style3' 	=> 'Style 3',
						'fc_nav_style4' 	=> 'Style 4',
						'fc_nav_style5' 	=> 'Style 5',
						'fc_nav_style6' 	=> 'Style 6',
						'fc_nav_style7' 	=> 'Style 7',
						'fc_nav_style8' 	=> 'Style 8'
				]
			]
		);

		$this->add_control(
			'fg_main_color',
			[
				'label' => esc_html__( 'Main Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FC615D'
			]
		);

		$this->add_control(
			'fg_main_color_opacity',
			[
				'label' => esc_html__( 'Main Color Opacity (value 0.1 to 1)', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => '1'
			]
		);

		$this->add_control(
			'fg_secondary_color',
			[
				'label' => esc_html__( 'Secondary Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF'
			]
		);

		$this->add_control(
			'fg_gallery_name_font_size',
			[
				'label' => esc_html__( 'Gallery Name Font Size (for example 20)', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => '20',
				'condition'	=> [
					'fg_gallery_name_show'	=> 'true'
				]
			]
		);

		$this->add_control(
			'fg_gallery_name_font_color',
			[
				'label' => esc_html__( 'Gallery Name Font Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FC615D',
				'condition'	=> [
					'fg_gallery_name_show'	=> 'true'
				]
			]
		);

		$this->add_control(
			'fg_gallery_name_text_align',
			[
				'label' => esc_html__( 'Gallery Name Text Align', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'center',
				'options' => [
						'center' 	=> 'Center',
						'left' 		=> 'Left',
						'right' 	=> 'Right'
				],
				'condition'	=> [
					'fg_gallery_name_show'	=> 'true'
				]
			]
		);	

		$this->add_control(
			'fg_image_lightbox',
			[
				'label' => esc_html__( 'Image Lightbox', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'plus',
				'options' => [
						'plus' 			=> 'Plus',
						'zoomin' 		=> 'Zoom In',
						'image' 		=> 'Image',
						'images' 		=> 'Images',
						'spinner_icon' 	=> 'Spinner',
						'search_icon' 	=> 'Search'
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

		$fg_gallery_name 					= esc_html($settings['fg_gallery_name']);
		$fg_gallery_name_show 				= esc_html($settings['fg_gallery_name_show']);
		$columns 							= '';
		$fg_type 							= esc_html($settings['fg_type']);
		$size 								= 'fg-normal';
		$fg_responsive 						= '';
		$fg_style 							= esc_html($settings['fg_style']);
		$fg_nav_style 						= esc_html($settings['fg_nav_style']);
		$fg_over_image 						= esc_html($settings['fg_over_image']);
		$fg_caption 						= esc_html($settings['fg_caption']);
		$fg_thumbs_one 						= '';
		$fg_lazyload 						= '';
		$fg_lazyload_effect 				= '';
		$fg_pagination_active 				= '';
		$fg_pagination_number 				= '';
		$fg_main_color 						= esc_html($settings['fg_main_color']);
		$fg_main_color_opacity 				= esc_html($settings['fg_main_color_opacity']);
		$fg_secondary_color 				= esc_html($settings['fg_secondary_color']);
		$fg_gallery_name_font_size 			= esc_html($settings['fg_gallery_name_font_size']);
		$fg_gallery_name_font_color 		= esc_html($settings['fg_gallery_name_font_color']);
		$fg_gallery_name_text_align 		= esc_html($settings['fg_gallery_name_text_align']);
		$fg_image_lightbox 					= esc_html($settings['fg_image_lightbox']);		
		$images 							= '';   
		$itemtag 							= 'div'; 
		$icontag 							= 'div';
		$captiontag 						= 'div';
		$pp_animation_speed 				= esc_html($settings['pp_animation_speed']);
		$pp_autoplay 						= esc_html($settings['pp_autoplay']);
		$pp_time 							= esc_html($settings['pp_time']);
		$pp_title 							= esc_html($settings['pp_title']);
		$pp_social 							= esc_html($settings['pp_social']);
		$fg_thumbs_grid 					= esc_html($settings['fg_thumbs_grid']);
		$fg_thumbs_lightbox 				= esc_html($settings['fg_thumbs_lightbox']);
		$lg_mode 							= esc_html($settings['lg_mode']);
		$lg_speed 							= esc_html($settings['lg_speed']);
		$lg_thumbnail 						= esc_html($settings['lg_thumbnail']);
		$lg_controls 						= esc_html($settings['lg_controls']);
		$custom_url_target 					= esc_html($settings['custom_url_target']); 
		$fg_animate 						= esc_html($settings['fg_animate']);
		$fg_animate_effect 					= esc_html($settings['fg_animate_effect']);
		$fg_delay 							= esc_html($settings['fg_delay']); 	
		$item_show							= esc_html($settings['item_show']);
		$item_show_900						= esc_html($settings['item_show_900']);
		$item_show_600						= esc_html($settings['item_show_600']);
		$loop								= esc_html($settings['loop']);
		$autoplay							= esc_html($settings['autoplay']);
		$smart_speed						= esc_html($settings['smart_speed']);
		$navigation							= esc_html($settings['navigation']);
		$pagination							= esc_html($settings['pagination']);
		$margin								= esc_html($settings['margin']);
		$rtl								= esc_html($settings['rtl']);
		
		wp_enqueue_script('fastcarousel-frontend');
		wp_enqueue_style( 'fonts-vc' );
		wp_enqueue_style( 'owlcarousel' );
		wp_enqueue_style( 'owltheme' );
		wp_enqueue_style( 'animations' );				
		wp_enqueue_script( 'owlcarousel' );
		wp_enqueue_style( 'elementor-icons' );
		wp_enqueue_style( 'font-awesome' );
		wp_enqueue_style( 'elementor-editor' );
		wp_enqueue_style( 'elementor-icons' );	
		wp_enqueue_style( 'fontawesome' );
		wp_enqueue_script( 'fastcarousel' );
		
		if($fg_type == 'prettyphoto') {
			wp_enqueue_style( 'prettyPhoto' );
			wp_enqueue_script( 'prettyPhoto');
		}
		if($fg_type == 'magnific-popup') {
			wp_enqueue_style( 'magnific-popup' );
			wp_enqueue_script( 'magnific-popup');
		}
		if($fg_type == 'lightgallery') {
			wp_enqueue_style( 'lightgallery' );
			wp_enqueue_script( 'lightgallery');
		}
		if($fg_type == 'photoswipe') {
			wp_enqueue_style( 'photoswipe' );
			wp_enqueue_style( 'photoswipe-default-skin' );
			wp_enqueue_script( 'photoswipe');
			wp_enqueue_script( 'photoswipe-ui-default-js');
			wp_enqueue_script( 'photoswipe-general-js');
		}
		
		$output = '';
						
			/* LOAD VAR */
			$itemtag = tag_escape($itemtag);
			$captiontag = tag_escape($captiontag);
			$icontag = tag_escape($icontag);
			$valid_tags = wp_kses_allowed_html( 'post' );
			if ( ! isset( $valid_tags[ $itemtag ] ) )
				$itemtag = 'dl';
			if ( ! isset( $valid_tags[ $captiontag ] ) )
				$captiontag = 'dd';
			if ( ! isset( $valid_tags[ $icontag ] ) )
				$icontag = 'dt';
 
			$columns = intval($columns);
			$itemwidth = $columns > 0 ? floor(100/$columns) : 100;
			$float = is_rtl() ? 'right' : 'left';

			// CHECK MAIN COLOR
			$rgb_main_color = ewmp_elementor_hex2rgb($fg_main_color);
			$rgba_main_color = "rgba( ".$rgb_main_color[0]." , ".$rgb_main_color[1]." , ".$rgb_main_color[2]." , ".$fg_main_color_opacity.")";	
			$rgb_secondary_color = ewmp_elementor_hex2rgb($fg_secondary_color);
			$rgba_secondary_color = "rgba( ".$rgb_secondary_color[0]." , ".$rgb_secondary_color[1]." , ".$rgb_secondary_color[2]." , 0.3)";	
			// END MAIN COLOR
 
			$selector = "gallery-{$instance}";
		  
			$gallery_style = $gallery_div = '';
			
			if($fg_type == 'photoswipe') { // IF PHOTOSWIPE STYLE
				
				$gallery_style = ewmp_elementor_photoswipe_style($rgba_main_color,
												  $fg_main_color,
												  $fg_secondary_color,
												  $rgba_secondary_color,
												  $fg_pagination_active,
												  '', 
												  '', 
												  $fg_image_lightbox, 
												  $selector, 
												  $fg_gallery_name_font_size, 
												  $fg_gallery_name_font_color, 
												  $fg_gallery_name_text_align,
												  $float,
						  						  $itemwidth,
						  						  $fg_gallery_name_show);
			
			} else {
				$gallery_style = "
				<style type='text/css'>
					#{$selector} {
					margin: auto;
					}
					#{$selector} .fg-gallery-item {
					float: {$float};
					margin-top: 10px;
					text-align: center;
					width: {$itemwidth}%;
					}
					#{$selector} .fg-gallery-caption {
					margin-left: 0;
					}
					#{$selector}.fastcarousel .fg-gallery-caption, 
					#{$selector}.fastcarousel .fg-gallery-caption:hover {
						background-color:".$rgba_main_color.";
					}
					#{$selector}.fastcarousel.gallery .fastcarousel-gallery-icon .fg_zoom a, 
					#{$selector}.fastcarousel.gallery .fastcarousel-gallery-icon .fg_zoom a:hover {
						color:".$fg_main_color.";
					}
					#{$selector}.fastcarousel.fg_style1 .fg-gallery-caption {
						color:".$fg_secondary_color.";	
					}
					#{$selector}.fastcarousel.gallery.fg_style2 .fastcarousel-gallery-icon .fg_zoom a {
						background:".$rgba_secondary_color.";
					}
					#{$selector}.fastcarousel.fg_style2 .fg-gallery-caption {
						color:".$fg_secondary_color.";	
					}			
					#{$selector}.fastcarousel.gallery.fg_style3 .fg_zoom, #{$selector}.fastcarousel.gallery.fg_style3 .fg_zoom:hover {
						background:".$rgba_main_color.";
					}
					#{$selector}.fastcarousel.fg_style3 .fg-gallery-caption {
						color:".$fg_secondary_color.";	
					}				
					#{$selector}.fastcarousel.fg_style4 .fg-gallery-caption,			
					#{$selector}.fastcarousel.gallery.fg_style4 .fastcarousel-gallery-icon .fg_zoom a, 
					#{$selector}.fastcarousel.gallery.fg_style4 .fastcarousel-gallery-icon .fg_zoom a:hover {
						color:".$fg_secondary_color.";
					}
					#{$selector}.fastcarousel.gallery.fg_style4 .fastcarousel-gallery-icon .fg_zoom a, 
					#{$selector}.fastcarousel.gallery.fg_style4 .fastcarousel-gallery-icon .fg_zoom a:hover	{
						background:".$rgba_main_color.";
					}			
					#{$selector}.fastcarousel.gallery.fg_style5 .fastcarousel-gallery-icon .fg_zoom a, 
					#{$selector}.fastcarousel.gallery.fg_style5 .fastcarousel-gallery-icon .fg_zoom a:hover	{
						color:".$fg_secondary_color.";
						background-color:".$rgba_main_color.";
					}					
					#{$selector}.fastcarousel.gallery.fg_style6 .fastcarousel-gallery-icon .fg_zoom a,
					#{$selector}.fastcarousel.gallery.fg_style6 .fastcarousel-gallery-icon .fg_zoom a:hover {
						color:".$fg_secondary_color.";
						background:".$rgba_main_color.";				
					}
				
					#{$selector}.fastcarousel.fg_style6 .fg-gallery-caption {
						color:".$fg_secondary_color.";	
					}
					#{$selector}.fastcarousel.gallery.fg_style7 .fastcarousel-gallery-icon .fg_zoom a,
					#{$selector}.fastcarousel.gallery.fg_style7 .fastcarousel-gallery-icon .fg_zoom a:hover {
						color:".$fg_secondary_color.";
						background:".$rgba_main_color.";				
					}		
					#{$selector}.fastcarousel.fg_style7 .fg-gallery-caption {
						color:".$fg_secondary_color.";	
					}
					
					#{$selector}.fastcarousel.gallery.fg_style8 .fastcarousel-gallery-icon .fg_zoom a,
					#{$selector}.fastcarousel.gallery.fg_style8 .fastcarousel-gallery-icon .fg_zoom a:hover {
						color:".$fg_secondary_color.";
						background:".$rgba_main_color.";				
					}
				
					#{$selector}.fastcarousel.fg_style8 .fg-gallery-caption {
						color:".$fg_secondary_color.";	
					}
					
					#{$selector}.fastcarousel.gallery.fg_style9 .fastcarousel-gallery-icon .fg_zoom a,
					#{$selector}.fastcarousel.gallery.fg_style9 .fastcarousel-gallery-icon .fg_zoom a:hover {
						color:".$fg_secondary_color.";
						background:".$rgba_main_color.";				
					}		
					#{$selector}.fastcarousel.fg_style9 .fg-gallery-caption {
						color:".$fg_secondary_color.";	
					}
					
					#{$selector}.fastcarousel.gallery.fg_style10 .fastcarousel-gallery-icon .fg_zoom a,
					#{$selector}.fastcarousel.gallery.fg_style10 .fastcarousel-gallery-icon .fg_zoom a:hover {
						color:".$fg_secondary_color.";
						background:".$rgba_main_color.";				
					}		
					#{$selector}.fastcarousel.fg_style10 .fg-gallery-caption {
						color:".$fg_secondary_color.";	
					}
					#{$selector}.fastcarousel.fg_style11 .fg-gallery-caption {
						color:".$fg_secondary_color.";	
					}
					#{$selector}.fastcarousel.fg_style11 .fastcarousel-gallery-icon .fg_zoom a, 
					#{$selector}.fastcarousel.fg_style11 .fastcarousel-gallery-icon .fg_zoom a:hover {
						color:".$fg_main_color.";
						background:".$rgba_secondary_color.";
					}
					#{$selector}.fastcarousel.fg_style12 .fg-gallery-caption {
						color:".$fg_secondary_color.";	
					}
					#{$selector}.fastcarousel.fg_style12 .fastcarousel-gallery-icon .fg_zoom a, 
					#{$selector}.fastcarousel.fg_style12 .fastcarousel-gallery-icon .fg_zoom a:hover {
						color:".$fg_main_color.";
						background:".$rgba_secondary_color.";
					}	
					#{$selector}.fastcarousel.owl-theme .owl-controls .owl-nav [class*=\"owl-\"] {
						background:".$rgba_main_color.";
						color:".$fg_secondary_color.";
					}
					#{$selector}.fastcarousel.owl-theme .owl-controls .owl-nav [class*=\"owl-\"]:hover {
						background:".$fg_main_color.";
					}
					#{$selector}.fastcarousel.owl-theme .owl-dots .owl-dot span {
						background:".$fg_main_color.";
					}
					#{$selector}.fastcarousel.owl-theme .owl-dots .owl-dot.active span, .owl-theme .owl-dots .owl-dot:hover span {
						background:".$rgba_main_color.";
					}					
				";
				
				if($fg_type == 'only_image') {
					$gallery_style .= "
					#{$selector}.fastcarousel .fg_zoom a {
						display:none;	
					}
					";
				}

				if($fg_image_lightbox == 'zoomin') {
					$gallery_style .= '#'.$selector.'.fastcarousel .icon-plus:before {	
										content: "\e6ef"!important;
					}';
				}
				if($fg_image_lightbox == 'image') {
					$gallery_style .= '#'.$selector.'.fastcarousel .icon-plus:before {	
										content: "\e687"!important;
					}';
				}	
				if($fg_image_lightbox == 'images') {
					$gallery_style .= '#'.$selector.'.fastcarousel .icon-plus:before {	
										content: "\e605"!important;
					}';
				}	
				if($fg_image_lightbox == 'spinner_icon') {
					$gallery_style .= '#'.$selector.'.fastcarousel .icon-plus:before {	
										content: "\e6e7"!important;
					}';
				}
				if($fg_image_lightbox == 'search_icon') {
					$gallery_style .= '#'.$selector.'.fastcarousel .icon-plus:before {	
										content: "\e6ee"!important;
					}';
				}				
				
				if($fg_gallery_name_show == 'true') {
					$gallery_style .= ".fg_gallery_title-{$instance}.fg_gallery_name {
							font-size:".$fg_gallery_name_font_size."px;
							color:".$fg_gallery_name_font_color.";
							text-align:".$fg_gallery_name_text_align.";
					}";
				}
				
				$gallery_style .= "</style>";	
			
				} // # IF PHOTOSWIPE STYLE 

				$gallery_script = '';

				// PRETTYPHOTO
				if($fg_type == 'prettyphoto') {
					$gallery_script .= '<script type="text/javascript">		
					jQuery(function($){
						jQuery(document).ready(function($){
								$("#'.$selector.' a[data-rel-fg^=\'prettyPhoto\']").prettyPhoto({
									animation_speed: \''.$pp_animation_speed.'\',
									slideshow: '.$pp_time.',
									autoplay_slideshow: '.$pp_autoplay.',
									show_title: '.$pp_title.',';
									if($pp_social == 'false') {				
										$gallery_script .= 'social_tools: false';
									}
					$gallery_script .= '});
						}); 
					});
					</script>';
				}
				
				// MAGNIFIC POPUP
				if($fg_type == 'magnific-popup') {
					$gallery_script .= '<script type="text/javascript">
						jQuery(function($){
							$(\'#'.$selector.' .fg_magnificPopup\').magnificPopup({
								type: \'image\',					
								gallery:{
									enabled:true
								}
								});
						});		
					</script>';
				}
				
				// LIGHTGALLERY
				if($fg_type == 'lightgallery') {
					if($lg_mode == 'lg-fade') {
						$lg_mode = 'fade';	
					} else {
						$lg_mode = 'slide';
					}
					$gallery_script .= '<script type="text/javascript">
						jQuery(function($){
							$(\'#'.$selector.'.gallery.fastcarousel\').lightGallery({
								mode:\''.$lg_mode.'\',
								speed: '.$lg_speed.',
								thumbnail: '.$lg_thumbnail.',
								controls: '.$lg_controls.',
								selector: \'.fg-gallery-item\'
							});
						});		
					</script>';												
				}
								
				// ANIMATION
				if($fg_animate == 'on') {
					wp_enqueue_style( 'animations' );
					wp_enqueue_script( 'appear');
					wp_enqueue_script( 'animate');
					$animation_info = " animate-in' data-anim-type='".$fg_animate_effect."' data-anim-delay='".$fg_delay."'>";			
				} else {
					$animation_info = " '>";					
				}
				// #ANIMATION
				
				
				// CUSTOM URL
				if($fg_type == 'custom_url' || $fg_type == 'only_image' || $fg_type == 'photoswipe') {
					$gallery_script = '';
				}

				// GALLERY NAME
				$gallery_name = '';
				if($fg_gallery_name_show == 'true') {
					$gallery_name = '<h2 class="fg_gallery_title-'.$instance.' fg_gallery_name">'.esc_html($fg_gallery_name).'</h2>';	
				}
				
				$size_class = sanitize_html_class( $size );
					if ($fg_type == 'photoswipe') {
						$gallery_div = "".$gallery_name."<div id='$selector'
							data-fast-carousel-owl-items='".esc_html($item_show)."' 
							data-fast-carousel-owl-items-900='".esc_html($item_show_900)."' 
							data-fast-carousel-owl-items-600='".esc_html($item_show_600)."'  
							data-fast-carousel-owl-loop='".esc_html($loop)."' 
							data-fast-carousel-owl-autoplay='".esc_html($autoplay)."' 
							data-fast-carousel-owl-smart-speed='".esc_html($smart_speed)."' 
							data-fast-carousel-owl-navigation='".esc_html($navigation)."'  
							data-fast-carousel-owl-pagination='".esc_html($pagination)."' 
							data-fast-carousel-owl-margin='".esc_html($margin)."'  
							data-fast-carousel-owl-rtl='".esc_html($rtl)."' 

						class='gallery galleryid-{$instance} gallery-columns-{$columns} gallery-size-{$size_class} fastcarousel fastcarouselelementor fpg ".$size." ".$fg_responsive." ".$fg_nav_style." ".$fg_style." ".$fg_thumbs_one." ".$fg_over_image."'><div class='fg-photoswipe'>";
					} else {
						$gallery_div = "".$gallery_name."<div id='$selector' 
							data-fast-carousel-owl-items='".esc_html($item_show)."' 
							data-fast-carousel-owl-items-900='".esc_html($item_show_900)."' 
							data-fast-carousel-owl-items-600='".esc_html($item_show_600)."'  
							data-fast-carousel-owl-loop='".esc_html($loop)."' 
							data-fast-carousel-owl-autoplay='".esc_html($autoplay)."' 
							data-fast-carousel-owl-smart-speed='".esc_html($smart_speed)."' 
							data-fast-carousel-owl-navigation='".esc_html($navigation)."'  
							data-fast-carousel-owl-pagination='".esc_html($pagination)."' 
							data-fast-carousel-owl-margin='".esc_html($margin)."'  
							data-fast-carousel-owl-rtl='".esc_html($rtl)."' 						
						class='gallery galleryid-{$instance} gallery-columns-{$columns} gallery-size-{$size_class} fastcarousel fastcarouselelementor fpg ".$size." ".$fg_responsive." ".$fg_nav_style." ".$fg_style." ".$fg_thumbs_one." ".$fg_over_image."'>";
					}
					$output = $gallery_style . $gallery_script . $gallery_div;
				
				// PAGINATION ### Change array for pagination ###
				$images = '';
				foreach ( $settings['images'] as $image ) {
					$id = $image['id'];
					$images .= $id . ',';
				}
				$images = rtrim($images,',');
				$images = explode( ',', $images );
				// #PAGINATION
				
				
				
				$i = -1;
				
				if ($fg_type == 'photoswipe') { // IF PHOTOSWIPE 
				
					foreach ( $settings['images'] as $image ) {
						$id = $image['id'];
				
						$image_url = wp_get_attachment_image_src( $id, $fg_thumbs_lightbox );
						

						$link_text = wp_get_attachment_image( $id , $fg_thumbs_grid);
						
											
						$attachment_caption_array = get_post( $id );
						$attachment_caption	= $attachment_caption_array->post_excerpt;
						if(empty($attachment_caption)) { $attachment_caption = ' '; }	
						
						// CHECK CAPTION
						$caption_check = '';
						if($fg_caption == 'off'  || empty($attachment_caption) || $attachment_caption == ' ') {
							$caption_check = 'no-caption';
						}
						// END CHECK CAPTION						
						
						$output .= '<figure class=\'fg-gallery-item fastcarousel-gallery-icon '.$caption_check .' fg_zoom\'>
										<a href="'.$image_url[0].'" itemprop="contentUrl" data-size="'.$image_url[1].'x'.$image_url[2].'">
											'.$link_text.'<span class=\'fg-zoom-icon icon-plus\'></span>
										</a>
										<figcaption itemprop="caption description">'.esc_html($attachment_caption).'</figcaption>';	
									

					
						if ($fg_caption == 'on' && !empty($attachment_caption) && $attachment_caption != ' ') {
						$output .= "
							<{$captiontag} class='fg-wp-caption-text fg-gallery-caption'><div class='caption-container'>
							" . $attachment_caption . "
							</div></{$captiontag}>";
						}			
									
						if($fg_style == 'fg_style4' || $fg_style == 'fg_style5' || $fg_style == 'fg_style6'
							|| $fg_style == 'fg_style7' || $fg_style == 'fg_style8' || $fg_style == 'fg_style9'
							|| $fg_style == 'fg_style10') {
							
							$output .= '<div class="fastcarousel-mask"></div>';
							
						}
									
																			
						$output .=	'</figure>';				
					}
					
					$output .= '</div></div><div style="clear:both"></div>';
					$output .= '<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true"><div class="pswp__bg"></div>
								<div class="pswp__scroll-wrap">
									<div class="pswp__container">
										<div class="pswp__item"></div>
										<div class="pswp__item"></div>
										<div class="pswp__item"></div>
									</div>
									<div class="pswp__ui pswp__ui--hidden">
										<div class="pswp__top-bar">
											<div class="pswp__counter"></div>
											<button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
											<button class="pswp__button pswp__button--share" title="Share"></button>
											<button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
											<button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
											<div class="pswp__preloader">
												<div class="pswp__preloader__icn">
												  <div class="pswp__preloader__cut">
													<div class="pswp__preloader__donut"></div>
												  </div>
												</div>
											</div>
										</div>
										<div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
											<div class="pswp__share-tooltip"></div> 
										</div>
										<button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
										</button>
										<button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
										</button>
										<div class="pswp__caption">
											<div class="pswp__caption__center"></div>
										</div>
									  </div>
									</div></div>';
				
				} else { // IF #PHOTOSWIPE 
							
				foreach ( $settings['images'] as $image ) {
					$id = $image['id'];
					$_post = get_post( $id );
					$image_attributes = wp_get_attachment_image_src( $_post->ID, $fg_thumbs_lightbox );
					if($fg_type == 'custom_url') {					
						$url = get_post_meta( $id, '_custom_url', true );						
					} else {
						$url = $image_attributes[0];
					}
					$attachment_caption_array = get_post( $_post->ID );
					$attachment_caption	= $attachment_caption_array->post_excerpt;
					
					
					$link_text = wp_get_attachment_image( $id , $fg_thumbs_grid);
					
					if($fg_type == 'lightgallery') {
						$image_output = "<div class='fg_zoom'>$link_text<a href='$url'><span class='fg-zoom-icon icon-plus'></span></a></div>";
					} elseif($fg_type == 'custom_url') {
						$image_output = "<div class='fg_zoom'>$link_text<a href='$url' target='$custom_url_target'><span class='fg-zoom-icon icon-plus'></span></a></div>";					
					} else {
						$image_output = "<div class='fg_zoom'>$link_text<a href='$url' title=\"$attachment_caption\" data-rel-fg='prettyPhoto[album-{$instance}]' class='fg_magnificPopup'><span class='fg-zoom-icon icon-plus'></span><span style='display:none'>$link_text</span></a></div>";							
					}
					$orientation = '';
					if ( isset( $image_meta['height'], $image_meta['width'] ) )
					$orientation = ( $image_meta['height'] > $image_meta['width'] ) ? 'portrait' : 'landscape';
					
					// LIGHTGALLERY
					if($fg_type != 'lightgallery') {	
						$output .= "<{$itemtag} class='fg-gallery-item ".$animation_info."";
					} else {
						$output .= "<{$itemtag} data-src='$url' class='fg-gallery-item ".$animation_info."";	
					}
					// #LIGHTGALLERY
					
					// CHECK CAPTION
					$caption_check = '';
					if($fg_caption == 'off' || empty($attachment_caption)) {
						$caption_check = 'no-caption';
					}
					// END CHECK CAPTION
					
					$output .= "
					<{$icontag} class='fastcarousel-gallery-icon $caption_check'>$image_output";
					if ($fg_caption == 'on' && !empty($attachment_caption)) {
					$output .= "
						<{$captiontag} class='fg-wp-caption-text fg-gallery-caption'><div class='caption-container'>
						" . $attachment_caption . "
						</div></{$captiontag}>";
					}
					$output .= "</{$icontag}></{$itemtag}>";
					}				 
					$output .= "
					</div>\n";
						
				}
				
		echo '<br>' . $output;
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
