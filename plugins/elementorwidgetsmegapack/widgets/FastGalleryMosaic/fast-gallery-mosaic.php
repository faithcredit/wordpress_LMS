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
 * Elementor Fast Gallery
 *
 * Elementor widget for fast gallery
 *
 * @since 1.0.0
 */
class Fast_Gallery_Mosaic extends Widget_Base {

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
		return 'fast-gallery-mosaic';
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
		return esc_html__( 'Fast Gallery Mosaic', 'elementorwidgetsmegapack' );
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
		return 'eicon-gallery-grid';
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
				'label' => esc_html__( 'Gallery Name Show', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'false',
				'options' => [
					'false' => 'Hidden',
					'true'  => 'Show'
				]
			]
		);

		$this->add_control(
			'fgm_layout',
			[
				'label' => esc_html__( 'Layout', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'fg_layout1',
				'options' => [
					'fg_layout1' => 'Layout 1',
					'fg_layout2' => 'Layout 2',
					'fg_layout3' => 'Layout 3',
					'fg_layout4' => 'Layout 4',
					'fg_layout5' => 'Layout 5'
				]
			]
		);

		$this->add_control(
			'fg_type',
			[
				'label' => esc_html__( 'Gallery Type', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'magnific-popup',
				'options' => [
					'prettyphoto' 		=> 'PrettyPhoto',
					'magnific-popup' 	=> 'Magnific Popup',
					'lightgallery' 		=> 'Light Gallery',
					'custom_url' 		=> 'Custom Url'
				]
			]
		);

		$this->add_control(
			'fgm_height',
			[
				'label' => esc_html__( 'Standard Image Height', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => '100',
				'options' => [
					'100' 				=> 'Very small (100px)',
					'150' 				=> 'Small (150px)',
					'200' 				=> 'Medium (200px)',
					'300' 				=> 'Big (300px)',
					'500' 				=> 'Very Big (500px)',
					'custom_value' 		=> 'Custom Value'
				]
			]
		);

		$this->add_control(
			'fgm_custom_height',
			[
				'label' => esc_html__( 'Custom Image Height', 'elementorwidgetsmegapack' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => '150',
				'condition'	=> [
					'fgm_height'	=> 'custom_value'
				]
			]
		);

		$this->add_control(
			'fgm_allow',
			[
				'label' => esc_html__( 'Fix Last Image', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'false',
				'options' => [
					'false' 			=> 'Off',
					'true' 				=> 'On'
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
			'fg_responsive',
			[
				'label' => esc_html__( 'Responsive / Fluid', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'fg_responsive',
				'options' => [
					'fg_responsive' => 'Responsive',
					'fg_fluid' 		=> 'Fluid'
				]
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
			'fg_pagination_active',
			[
				'label' => esc_html__( 'Pagination', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'off',
				'options' => [
					'off'	=> 'Off',
					'on' 	=> 'On'					
				]
			]
		);

		$this->add_control(
			'fg_pagination_number',
			[
				'label' => esc_html__( 'Number of images for each page (for example 10)', 'elementorwidgetsmegapack' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'condition'	=> [
					'fg_pagination_active'	=> 'on'
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

		// Magnific Popup

		$this->add_control(
			'mp_gallery',
			[
				'label' => esc_html__( 'Gallery', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => [
					'true'		=> 'On',
					'false' 	=> 'Off'					
				],
				'condition'	=> [
					'fg_type'	=> 'magnific-popup'
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
			'fgm_image_lightbox_size',
			[
				'label' => esc_html__( 'Image Lightbox Size', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'ewmp-large',
				'options' => [
					'ewmp-large'	=> '1000px x 800px cropped',
					'thumbnail' => 'Thumbnail',				
					'medium' 	=> 'Medium',				
					'large' 	=> 'Large',				
					'full' 		=> 'Full'			
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_seo',
			[
				'label' => esc_html__( 'Seo Options', 'elementorwidgetsmegapack' )
			]
		);

		$this->add_control(
			'fg_seo',
			[
				'label' => esc_html__( 'SEO Setting. If you set ON you need to insert all ALT and TITLE Tags image for correct settings', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'off',
				'label_block' => true,
				'options' => [					
					'off'   => 'Off',	
					'on'	=> 'On'		
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
						'fg_no_style'  	=> 'No Style'
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
			'fg_spacing_active',
			[
				'label' => esc_html__( 'Custom spacing between images', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'label_block' => true,
				'default' => 'off',
				'options' => [
						'off' 	=> 'Off',
						'on' 	=> 'On'
				]
			]
		);	

		$this->add_control(
			'fgm_padding',
			[
				'label' => esc_html__( 'Spacing between the images (for example 20)', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => '20',
				'condition'	=> [
					'fg_spacing_active'	=> 'on'
				]
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
			'fgm_image_lightbox',
			[
				'label' => esc_html__( 'Icon Image Lightbox', 'elementorwidgetsmegapack' ),
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

		$this->add_control(
			'fgm_image_width',
			[
				'label' => esc_html__( 'Icon Image Lightbox Width', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'small',
				'options' => [
						'small' 		=> 'Small (Default)',
						'medium' 		=> 'Medium',
						'large' 		=> 'Large'
				]
			]
		);

		$this->add_control(
			'fg_pagination_style',
			[
				'label' => esc_html__( 'Pagination Style', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'fg_pagination_style1',
				'options' => [
						'fg_pagination_style1' 	=> 'Style 1',
						'fg_pagination_style2' 	=> 'Style 2'
				],
				'condition'	=> [
					'fg_pagination_active'	=> 'on'
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
				$fgm_layout 						= esc_html($settings['fgm_layout']);
				$fg_type 							= esc_html($settings['fg_type']);
				$fgm_height 						= esc_html($settings['fgm_height']);
				$fgm_custom_height 					= esc_html($settings['fgm_custom_height']);
				$fgm_allow 							= esc_html($settings['fgm_allow']);
				$fg_responsive 						= esc_html($settings['fg_responsive']);
				$fg_style 							= esc_html($settings['fg_style']);
				$fg_over_image 						= esc_html($settings['fg_over_image']);
				$fg_pagination_active 				= esc_html($settings['fg_pagination_active']);
				$fg_pagination_number 				= esc_html($settings['fg_pagination_number']);
				if(empty($fg_pagination_number)) { $fg_pagination_number = '10'; }
				$fg_pagination_style 				= esc_html($settings['fg_pagination_style']);
				$fg_main_color 						= esc_html($settings['fg_main_color']);
				$fg_main_color_opacity 				= esc_html($settings['fg_main_color_opacity']);
				$fg_secondary_color 				= esc_html($settings['fg_secondary_color']);
				$fgm_padding 						= esc_html($settings['fgm_padding']);
				if(empty($fgm_padding)) { $fgm_padding = 5; } 
				$fgm_image_lightbox 				= esc_html($settings['fgm_image_lightbox']);
				$fgm_image_width 					= esc_html($settings['fgm_image_width']);
				$fg_gallery_name_font_size 			= esc_html($settings['fg_gallery_name_font_size']);
				$fg_gallery_name_font_color 		= esc_html($settings['fg_gallery_name_font_color']);
				$fg_gallery_name_text_align 		= esc_html($settings['fg_gallery_name_text_align']);		
				$images = '';
				if($settings['images']) {
					foreach ( $settings['images'] as $image ) {
						$id = $image['id'];
						$images .= $id . ',';
					}
					$images 							= rtrim($images,',');
				} else {
					$images = '';
				}
				$itemtag 							= 'div'; 
				$icontag 							= 'div';
				$captiontag 						= 'div';
				$pp_animation_speed 				= esc_html($settings['pp_animation_speed']);
				$pp_autoplay 						= esc_html($settings['pp_autoplay']);
				$pp_time 							= esc_html($settings['pp_time']);
				$pp_title 							= esc_html($settings['pp_title']);
				$pp_social 							= esc_html($settings['pp_social']);
				$lg_mode 							= esc_html($settings['lg_mode']);
				$lg_speed 							= esc_html($settings['lg_speed']);
				$lg_thumbnail 						= esc_html($settings['lg_thumbnail']);
				$lg_controls 						= esc_html($settings['lg_controls']);
				$custom_url_target 					= esc_html($settings['custom_url_target']); 
				$mp_gallery 						= esc_html($settings['mp_gallery']);
				$fgm_image_lightbox_size 			= esc_html($settings['fgm_image_lightbox_size']);
				$fg_seo 							= esc_html($settings['fg_seo']);
				$fg_animate 						= esc_html($settings['fg_animate']);
				$fg_animate_effect 					= esc_html($settings['fg_animate_effect']);
				$fg_delay 							= esc_html($settings['fg_delay']); 	
			
			wp_enqueue_script( 'removeWhitespace' );
 			wp_enqueue_script( 'collagePlus' );	
			wp_enqueue_script('fast-gallery-mosaic-frontend');
			wp_enqueue_style('fonts-vc');
			wp_enqueue_style('fast-gallery-mosaic');
			wp_enqueue_style( 'elementor-icons' );
			wp_enqueue_style( 'font-awesome' );
			wp_enqueue_style( 'elementor-editor' );
			wp_enqueue_style( 'elementor-icons' );	
			wp_enqueue_style( 'fontawesome' );
			wp_enqueue_style( 'fast-gallery-mosaic' );

			
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

			// CHECK MAIN COLOR
			$rgb_main_color = ewmp_elementor_hex2rgb($fg_main_color);
			$rgba_main_color = "rgba( ".$rgb_main_color[0]." , ".$rgb_main_color[1]." , ".$rgb_main_color[2]." , ".$fg_main_color_opacity.")";	
			$rgb_secondary_color = ewmp_elementor_hex2rgb($fg_secondary_color);
			$rgba_secondary_color = "rgba( ".$rgb_secondary_color[0]." , ".$rgb_secondary_color[1]." , ".$rgb_secondary_color[2]." , 0.3)";	
			// END MAIN COLOR
 
			$selector = "gallery-{$instance}";
		  
			$gallery_style = $gallery_div = '';
				$gallery_style = "<style type='text/css'>
				.FGM-Collage .fg-gallery-item .gallery-icon {
					opacity:0;
				}
				#{$selector} {
					margin: auto;
				}
				#{$selector}.FGM-Collage .fg-gallery-item {
					text-align: center;			
				}
				#{$selector} .fg-gallery-caption {
					margin-left: 0;
				}
				#{$selector}.fastgallery_mosaic .fg-gallery-caption, 
				#{$selector}.fastgallery_mosaic .fg-gallery-caption:hover {
					background-color:".$rgba_main_color.";
				}
				#{$selector}.fastgallery_mosaic.gallery .gallery-icon .fg_zoom a, 
				#{$selector}.fastgallery_mosaic.gallery .gallery-icon .fg_zoom a:hover {
					color:".$fg_main_color.";
				}
				#{$selector}.fastgallery_mosaic.fg_style1 .fg-gallery-caption {
					color:".$fg_secondary_color.";	
				}
				#{$selector}.fastgallery_mosaic.gallery.fg_style2 .gallery-icon .fg_zoom a {
					background:".$rgba_secondary_color.";
				}
				#{$selector}.fastgallery_mosaic.fg_style2 .fg-gallery-caption {
					color:".$fg_secondary_color.";	
				}			
				#{$selector}.fastgallery_mosaic.gallery.fg_style3 .fg_zoom, #{$selector}.fastgallery_mosaic.gallery.fg_style3 .fg_zoom:hover {
					background:".$rgba_main_color.";
				}
				#{$selector}.fastgallery_mosaic.fg_style3 .fg-gallery-caption {
					color:".$fg_secondary_color.";	
				}				
				#{$selector}.fastgallery_mosaic.fg_style4 .fg-gallery-caption,			
				#{$selector}.fastgallery_mosaic.gallery.fg_style4 .gallery-icon .fg_zoom a, 
				#{$selector}.fastgallery_mosaic.gallery.fg_style4 .gallery-icon .fg_zoom a:hover {
					color:".$fg_secondary_color.";
				}
				#{$selector}.fastgallery_mosaic.gallery.fg_style4 .gallery-icon .fg_zoom a, 
				#{$selector}.fastgallery_mosaic.gallery.fg_style4 .gallery-icon .fg_zoom a:hover	{
					background:".$rgba_main_color.";
				}			
				#{$selector}.fastgallery_mosaic.gallery.fg_style5 .gallery-icon .fg_zoom a, 
				#{$selector}.fastgallery_mosaic.gallery.fg_style5 .gallery-icon .fg_zoom a:hover	{
					color:".$fg_secondary_color.";
					background-color:".$rgba_main_color.";
				}					
				#{$selector}.fastgallery_mosaic.gallery.fg_style6 .gallery-icon .fg_zoom a,
				#{$selector}.fastgallery_mosaic.gallery.fg_style6 .gallery-icon .fg_zoom a:hover {
					color:".$fg_secondary_color.";
					background:".$rgba_main_color.";				
				}
			
				#{$selector}.fastgallery_mosaic.fg_style6 .fg-gallery-caption {
					color:".$fg_secondary_color.";	
				}
				#{$selector}.fastgallery_mosaic.gallery.fg_style7 .gallery-icon .fg_zoom a,
				#{$selector}.fastgallery_mosaic.gallery.fg_style7 .gallery-icon .fg_zoom a:hover {
					color:".$fg_secondary_color.";
					background:".$rgba_main_color.";				
				}		
				#{$selector}.fastgallery_mosaic.fg_style7 .fg-gallery-caption {
					color:".$fg_secondary_color.";	
				}
				
				#{$selector}.fastgallery_mosaic.gallery.fg_style8 .gallery-icon .fg_zoom a,
				#{$selector}.fastgallery_mosaic.gallery.fg_style8 .gallery-icon .fg_zoom a:hover {
					color:".$fg_secondary_color.";
					background:".$rgba_main_color.";				
				}
			
				#{$selector}.fastgallery_mosaic.fg_style8 .fg-gallery-caption {
					color:".$fg_secondary_color.";	
				}
				
				#{$selector}.fastgallery_mosaic.gallery.fg_style9 .gallery-icon .fg_zoom a,
				#{$selector}.fastgallery_mosaic.gallery.fg_style9 .gallery-icon .fg_zoom a:hover {
					color:".$fg_secondary_color.";
					background:".$rgba_main_color.";				
				}		
				#{$selector}.fastgallery_mosaic.fg_style9 .fg-gallery-caption {
					color:".$fg_secondary_color.";	
				}
				
				#{$selector}.fastgallery_mosaic.gallery.fg_style10 .gallery-icon .fg_zoom a,
				#{$selector}.fastgallery_mosaic.gallery.fg_style10 .gallery-icon .fg_zoom a:hover {
					color:".$fg_secondary_color.";
					background:".$rgba_main_color.";				
				}		
				#{$selector}.fastgallery_mosaic.fg_style10 .fg-gallery-caption {
					color:".$fg_secondary_color.";	
				}";
		
				if($fgm_image_lightbox == 'zoomin') {
					$gallery_style .= '#'.$selector.'.fastgallery_mosaic.gallery .gallery-icon .icon-plus:before {	
										content: "\e6ef"!important;
					}';
				}
				if($fgm_image_lightbox == 'image') {
					$gallery_style .= '#'.$selector.'.fastgallery_mosaic.gallery .gallery-icon .icon-plus:before {	
										content: "\e687"!important;
					}';
				}	
				if($fgm_image_lightbox == 'images') {
					$gallery_style .= '#'.$selector.'.fastgallery_mosaic.gallery .gallery-icon .icon-plus:before {	
										content: "\e605"!important;
					}';
				}	
				if($fgm_image_lightbox == 'spinner') {
					$gallery_style .= '#'.$selector.'.fastgallery_mosaic.gallery .gallery-icon .icon-plus:before {	
										content: "\e6e7"!important;
					}';
				}
				if($fgm_image_lightbox == 'search') {
					$gallery_style .= '#'.$selector.'.fastgallery_mosaic.gallery .gallery-icon .icon-plus:before {	
										content: "\e6ee"!important;
					}';
				}

				if($fgm_image_width == 'small') {
					$gallery_style .= "#{$selector}.fastgallery_mosaic.gallery span {
										font-size:20px!important;
					}
					#{$selector}.fastgallery_mosaic.gallery .gallery-icon .fg-zoom-icon {
										margin-left:-10px!important;
										margin-top:-40px;
					}
					#{$selector}.fastgallery_mosaic.gallery.fg_style2 .gallery-icon .fg-zoom-icon,
					#{$selector}.fastgallery_mosaic.gallery.fg_style5 .gallery-icon .fg-zoom-icon  {
										margin-top:-10px;
					}		
					#{$selector}.fastgallery_mosaic.gallery .gallery-icon.no-caption .fg-zoom-icon {
										margin-top:-10px!important;
					}
					#{$selector}.fastgallery_mosaic.fg_style7 .fg-gallery-caption,
					#{$selector}.fastgallery_mosaic.fg_style8 .fg-gallery-caption {
										top:55%;
					}
					";
				}
				
				if($fgm_image_width == 'medium') {
					$gallery_style .= "#{$selector}.fastgallery_mosaic.gallery span {
										font-size:30px!important;
					}
					#{$selector}.fastgallery_mosaic.gallery .gallery-icon .fg-zoom-icon {
										margin-left:-15px!important;
										margin-top:-40px;
					}
					#{$selector}.fastgallery_mosaic.gallery.fg_style2 .gallery-icon .fg-zoom-icon,
					#{$selector}.fastgallery_mosaic.gallery.fg_style5 .gallery-icon .fg-zoom-icon  {
										margin-top:-15px;
					}		
					#{$selector}.fastgallery_mosaic.gallery .gallery-icon.no-caption .fg-zoom-icon {
										margin-top:-15px!important;
					}
					#{$selector}.fastgallery_mosaic.fg_style7 .fg-gallery-caption,
					#{$selector}.fastgallery_mosaic.fg_style8 .fg-gallery-caption {
										top:55%;
					}
					";
				}
		
				if($fgm_image_width == 'large') {
					$gallery_style .= "#{$selector}.fastgallery_mosaic.gallery span {
										font-size:50px!important;
					}
					#{$selector}.fastgallery_mosaic.gallery .gallery-icon .fg-zoom-icon {
										margin-left:-25px!important;
										margin-top:-50px;
					}
					#{$selector}.fastgallery_mosaic.gallery.fg_style2 .gallery-icon .fg-zoom-icon,
					#{$selector}.fastgallery_mosaic.gallery.fg_style5 .gallery-icon .fg-zoom-icon {
										margin-top:-25px;
					}		
					#{$selector}.fastgallery_mosaic.gallery .gallery-icon.no-caption .fg-zoom-icon {
										margin-top:-25px!important;
					}
					#{$selector}.fastgallery_mosaic.fg_style7 .fg-gallery-caption,
					#{$selector}.fastgallery_mosaic.fg_style8 .fg-gallery-caption {
										top:55%;
					}
					";
				}	

				if($fg_pagination_active == 'on') {
					$gallery_style .= "
						#{$selector}.fastgallery_mosaic.fg_pagination_style1 ul.fg_pagination li a {
							background:".$rgba_main_color.";
							color:".$fg_secondary_color.";
						}
						#{$selector}.fastgallery_mosaic.fg_pagination_style1 ul.fg_pagination li a:hover {
							background:".$fg_secondary_color.";
							color:".$rgba_main_color.";
						}
						#{$selector}.fastgallery_mosaic.fg_pagination_style1 ul.fg_pagination li.fg_current {
							background:".$fg_secondary_color.";
							color:".$rgba_main_color.";
						}
						#{$selector}.fastgallery_mosaic.fg_pagination_style2 ul.fg_pagination li a {
							color:".$fg_secondary_color.";
						}
						#{$selector}.fastgallery_mosaic.fg_pagination_style2 ul.fg_pagination li a:hover {
							color:".$rgba_main_color.";
						}
						#{$selector}.fastgallery_mosaic.fg_pagination_style2 ul.fg_pagination li.fg_current {
							color:".$rgba_main_color.";
						}																		
					";
				}
				
				if($fg_gallery_name_show == 'true') {
					$gallery_style .= ".fg_gallery_title-{$instance}.fg_gallery_name {
							font-size:".$fg_gallery_name_font_size."px;
							color:".$fg_gallery_name_font_color.";
							text-align:".$fg_gallery_name_text_align.";
					}";
				}
				
				$gallery_style .= "</style>";	

				if($fgm_height == 'custom_value') {
					$fgm_height = $fgm_custom_height;
				}

				// JAVASCRIPT MOSAIC //

				$gallery_script = "<script type=\"text/javascript\">";
				
				if($fg_responsive == 'fg_responsive') {
			
					$gallery_script .= "jQuery(function($){";
					if(\Elementor\Plugin::$instance->preview->is_preview_mode() || \Elementor\Plugin::$instance->editor->is_edit_mode()) {
						$gallery_script .= "$(window).ready(function () {";
					} else {
						$gallery_script .= "$(window).load(function () {";
					}
						$gallery_script .= "function collage() {
										$('#$selector.FGM-Collage').removeWhitespace().collagePlus(
										{
												'targetHeight'  		: ".$fgm_height.",
												'padding'				: ".$fgm_padding.",
												'allowPartialLastRow'   : ".$fgm_allow."
											}
										);
									};						
									$(document).ready(function(){
										collage();
										$('.FGM-Collage .fg-gallery-item .gallery-icon').css(\"opacity\", 1);
									});	
									var resizeTimer = null;
									var windowSize = $(window).width();

									
									$(window).bind('resize', function() {
										$('.FGM-Collage .fg-gallery-item').css(\"opacity\", 0);
										if($(window).width() != windowSize){
												if (windowSize < 1160 ) {
													var size = 250;
												}
												else {
													var size = ".$fgm_height.";
												}
										//console.log(size);

										if (resizeTimer) clearTimeout(resizeTimer);
										resizeTimer = setTimeout(collage(size), 250);
										windowSize = $(window).width();
										}
									});									
									
					});
					});";
						
				} else {
					
					$gallery_script .= "jQuery(function($){";
					if(\Elementor\Plugin::$instance->preview->is_preview_mode() || \Elementor\Plugin::$instance->editor->is_edit_mode()) {
						$gallery_script .= "$(window).ready(function () {";
					} else {
						$gallery_script .= "$(window).load(function () {";
					}
						$gallery_script .= "function collage() {
										collage();
										$('.FGM-Collage .fg-gallery-item .gallery-icon').css(\"opacity\", 1);
									});
									function collage() {
										$('#$selector.FGM-Collage').removeWhitespace().collagePlus(
										{
												'targetHeight'  		: ".$fgm_height.",
												'padding'				: ".$fgm_padding.",
												'allowPartialLastRow'   : ".$fgm_allow."
											}
										);
									};	
									var resizeTimer = null;
									$(window).bind('resize', function() {
										$('.FGM-Collage .fg-gallery-item').css(\"opacity\", 0);
										if (resizeTimer) clearTimeout(resizeTimer);
										resizeTimer = setTimeout(collage, 200);
									});	
					});
					});";		
						
				}
											
				$gallery_script .= "</script>";
	
				// #JAVASCRIPT MOSAIC //
	
				// PHOTOBOX
				if($fg_type == 'photobox') { // PHOTOBOX CSS/JS
						
					$gallery_script .= '<script type="text/javascript">
						jQuery(function($){
							$(\'#'.$selector.'\').photobox(\'a\', { 
								thumbs: '.$pb_thumbs.', 
								time: '.$pb_time.',
								autoplay: '.$pb_autoplay.',
								counter: '.$pb_counter.',
								history: '.$pb_history.',
								loop: '.$pb_loop.',				 
							});
						});
					</script>';
					
				} // CLOSE PHOTOBOX CSS/JS

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
									enabled:'.$mp_gallery.'
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
							$(\'#'.$selector.'.gallery.fastgallery_mosaic\').lightGallery({
								mode:\''.$lg_mode.'\',
								speed: '.$lg_speed.',
								thumbnail: '.$lg_thumbnail.',
								controls: '.$lg_controls.'								
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
				if($fg_type == 'custom_url' || $fg_type == 'only_image') {
					$gallery_script .= '';
				}

				// GALLERY NAME
				$gallery_name = '';
				if($fg_gallery_name_show == 'true') {
					$gallery_name = '<h2 class="fg_gallery_title-'.$instance.' fg_gallery_name">'.$fg_gallery_name.'</h2>';	
				}
				
				$size_class = sanitize_html_class( $fgm_layout );
				$gallery_div = $gallery_name . "<div id='$selector' class='FGM-Collage gallery galleryid-{$instance} gallery-size-{$size_class} fastgallery_mosaic fpg ".$fg_responsive." ".$fg_style." ".$fg_over_image." ".$fgm_layout."'>";
				$output = apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_script . "\n\t\t" . $gallery_div );
				
				$images = explode( ',', $images );
				
				// PAGINATION ### Change array for pagination ###
				if($fg_pagination_active == 'on') {
				
					$pagination = get_query_var('fg_page');		
					
					if(!isset($pagination) || empty($pagination)) { $pagination = 1; }
					
					$images_array = array_chunk($images,$fg_pagination_number);
													
					$pag = $pagination - 1;
					
					$images = $images_array[$pag];				

					$num_page_for_pagination = count($images_array); // VALUE FOR PAGINATION FUNCTION

				}
				// #PAGINATION				
							
				$i = 0;
									
				foreach ( $images as $id ) {
					
					// ALT IMAGE
					$alt = get_post_meta($id, '_wp_attachment_image_alt', true);
					// END ALT IMAGE

					$image_meta = wp_get_attachment_metadata( $id );
	 
					$orientation = '';
					if ( isset( $image_meta['height'], $image_meta['width'] ) )
					$orientation = ( $image_meta['height'] > $image_meta['width'] ) ? 'portrait' : 'landscape';

					
					if($fgm_layout == 'fg_layout1') {
					
						$tag_grid_array = array('fgm-2-6','fgm-1-6','fgm-3-6','fgm-1-6','fgm-2-6','fgm-3-6','fgm-3-6','fgm-2-6','fgm-1-6','fgm-2-6','fgm-1-6','fgm-3-6',
												'fgm-2-6','fgm-1-6','fgm-3-6','fgm-1-6','fgm-2-6','fgm-3-6','fgm-3-6','fgm-2-6','fgm-1-6','fgm-2-6','fgm-1-6','fgm-3-6',
												'fgm-2-6','fgm-1-6','fgm-3-6','fgm-1-6','fgm-2-6','fgm-3-6','fgm-3-6','fgm-2-6','fgm-1-6','fgm-2-6','fgm-1-6','fgm-3-6',
												'fgm-2-6','fgm-1-6','fgm-3-6','fgm-1-6','fgm-2-6','fgm-3-6','fgm-3-6','fgm-2-6','fgm-1-6','fgm-2-6','fgm-1-6','fgm-3-6',
												'fgm-2-6','fgm-1-6','fgm-3-6','fgm-1-6','fgm-2-6','fgm-3-6','fgm-3-6','fgm-2-6','fgm-1-6','fgm-2-6','fgm-1-6','fgm-3-6');
					}
					if($fgm_layout == 'fg_layout2') {
						
						$tag_grid_array = array('fgm-1-6','fgm-1-6','fgm-1-6','fgm-3-6','fgm-2-6','fgm-1-6','fgm-2-6','fgm-3-6','fgm-3-6','fgm-2-6','fgm-2-6','fgm-1-6',
												'fgm-1-6','fgm-1-6','fgm-1-6','fgm-3-6','fgm-2-6','fgm-1-6','fgm-2-6','fgm-3-6','fgm-3-6','fgm-2-6','fgm-2-6','fgm-1-6',									
												'fgm-1-6','fgm-1-6','fgm-1-6','fgm-3-6','fgm-2-6','fgm-1-6','fgm-2-6','fgm-3-6','fgm-3-6','fgm-2-6','fgm-2-6','fgm-1-6',
												'fgm-1-6','fgm-1-6','fgm-1-6','fgm-3-6','fgm-2-6','fgm-1-6','fgm-2-6','fgm-3-6','fgm-3-6','fgm-2-6','fgm-2-6','fgm-1-6',
												'fgm-1-6','fgm-1-6','fgm-1-6','fgm-3-6','fgm-2-6','fgm-1-6','fgm-2-6','fgm-3-6','fgm-3-6','fgm-2-6','fgm-2-6','fgm-1-6');
					
					}
					if($fgm_layout == 'fg_layout3') {
						
						$tag_grid_array = array('fgm-3-6','fgm-3-6','fgm-3-6','fgm-2-6','fgm-2-6','fgm-2-6','fgm-1-6','fgm-1-6','fgm-1-6','fgm-3-6','fgm-2-6','fgm-1-6',
												'fgm-3-6','fgm-3-6','fgm-3-6','fgm-2-6','fgm-2-6','fgm-2-6','fgm-1-6','fgm-1-6','fgm-1-6','fgm-3-6','fgm-2-6','fgm-1-6',									
												'fgm-3-6','fgm-3-6','fgm-3-6','fgm-2-6','fgm-2-6','fgm-2-6','fgm-1-6','fgm-1-6','fgm-1-6','fgm-3-6','fgm-2-6','fgm-1-6',
												'fgm-3-6','fgm-3-6','fgm-3-6','fgm-2-6','fgm-2-6','fgm-2-6','fgm-1-6','fgm-1-6','fgm-1-6','fgm-3-6','fgm-2-6','fgm-1-6',
												'fgm-3-6','fgm-3-6','fgm-3-6','fgm-2-6','fgm-2-6','fgm-2-6','fgm-1-6','fgm-1-6','fgm-1-6','fgm-3-6','fgm-2-6','fgm-1-6');
					
					}
					if($fgm_layout == 'fg_layout4') {
						
						$tag_grid_array = array('fgm-1-6','fgm-2-6','fgm-3-6','fgm-1-6','fgm-2-6','fgm-3-6','fgm-1-6','fgm-2-6','fgm-2-6','fgm-2-6','fgm-1-6','fgm-3-6',
												'fgm-1-6','fgm-2-6','fgm-3-6','fgm-1-6','fgm-2-6','fgm-3-6','fgm-1-6','fgm-2-6','fgm-2-6','fgm-2-6','fgm-1-6','fgm-3-6',									
												'fgm-1-6','fgm-2-6','fgm-3-6','fgm-1-6','fgm-2-6','fgm-3-6','fgm-1-6','fgm-2-6','fgm-2-6','fgm-2-6','fgm-1-6','fgm-3-6',
												'fgm-1-6','fgm-2-6','fgm-3-6','fgm-1-6','fgm-2-6','fgm-3-6','fgm-1-6','fgm-2-6','fgm-2-6','fgm-2-6','fgm-1-6','fgm-3-6',
												'fgm-1-6','fgm-2-6','fgm-3-6','fgm-1-6','fgm-2-6','fgm-3-6','fgm-1-6','fgm-2-6','fgm-2-6','fgm-2-6','fgm-1-6','fgm-3-6');
					
					}
					if($fgm_layout == 'fg_layout5') {
						
						$tag_grid_array = array('fgm-1-6','fgm-1-6','fgm-2-6','fgm-2-6','fgm-3-6','fgm-3-6','fgm-1-6','fgm-1-6','fgm-2-6','fgm-2-6','fgm-3-6','fgm-3-6',
												'fgm-1-6','fgm-1-6','fgm-2-6','fgm-2-6','fgm-3-6','fgm-3-6','fgm-1-6','fgm-1-6','fgm-2-6','fgm-2-6','fgm-3-6','fgm-3-6',									
												'fgm-1-6','fgm-1-6','fgm-2-6','fgm-2-6','fgm-3-6','fgm-3-6','fgm-1-6','fgm-1-6','fgm-2-6','fgm-2-6','fgm-3-6','fgm-3-6',
												'fgm-1-6','fgm-1-6','fgm-2-6','fgm-2-6','fgm-3-6','fgm-3-6','fgm-1-6','fgm-1-6','fgm-2-6','fgm-2-6','fgm-3-6','fgm-3-6',
												'fgm-1-6','fgm-1-6','fgm-2-6','fgm-2-6','fgm-3-6','fgm-3-6','fgm-1-6','fgm-1-6','fgm-2-6','fgm-2-6','fgm-3-6','fgm-3-6');
					
					}
											
					if(empty($tag_grid_array[$i])) { $tag_grid_array[$i] = 'fgm-2-6'; }
							
					$tag_grid = $tag_grid_array[$i];	
					
					if($fg_seo == 'on') {
						
						$default_attr = array(
								'title' => trim(strip_tags(($attachment->post_title))),
								'alt'   => trim(strip_tags( get_post_meta($attachment->ID, '_wp_attachment_image_alt', true) ))			
						);
						$link_text = wp_get_attachment_image( $id, $tag_grid_array[$i], false, $default_attr );
					
					} else {
						
						$link_text = wp_get_attachment_image( $id, $tag_grid_array[$i] );
					
					}					
					
					
					
					/* FUNCTION THUMBS */
					
					$_post = get_post( $id );
					$image_attributes = wp_get_attachment_image_src( $_post->ID, $fgm_image_lightbox_size );
					if($fg_type == 'custom_url') {					
						$url = get_post_meta( $id, '_custom_url', true );						
					} else {
						$url = $image_attributes[0];
					}
					$attachment_caption_array = get_post( $_post->ID );
					$attachment_caption	= $attachment_caption_array->post_excerpt;		

					// CHECK CAPTION
					$caption_check = '';
					if(empty($attachment_caption)) {
						$caption_check = 'no-caption';
					}
					// END CHECK CAPTION
								
					// LIGHTGALLERY
					if($fg_type != 'lightgallery') {	
						$output .= "<{$itemtag} class='fg-gallery-item ".$animation_info."";
					} else {
						$output .= "<{$itemtag} data-src='$url' class='fg-gallery-item ".$animation_info."";	
					}
					// #LIGHTGALLERY					

					$output .= "<{$icontag} class='gallery-icon {$orientation} $caption_check'>";

					if($fg_type == 'lightgallery') {
						$output .= "<div class='fg_zoom'>$link_text<a href='$url'><span class='fg-zoom-icon icon-plus'></span></a></div>";
					} elseif($fg_type == 'custom_url') {
						$output .= "<div class='fg_zoom'>$link_text<a href='$url' target='$custom_url_target'><span class='fg-zoom-icon icon-plus'></span></a></div>";					
					} else {
						$output .= "<div class='fg_zoom'>$link_text<a href='$url' title=\"$attachment_caption\" data-rel-fg='prettyPhoto[album-{$instance}]' class='fg_magnificPopup'><span class='fg-zoom-icon icon-plus'></span><span style='display:none'>$link_text</span></a></div>";							
					}					
			
					/* #FUNCTION THUMBS */
							
					if (!empty($attachment_caption)) {
					$output .= "
						<{$captiontag} class='fg-wp-caption-text fg-gallery-caption'><div class='caption-container'>
						" . $attachment_caption . "
						</div></{$captiontag}>";
					}
					$output .= "</{$icontag}></{$itemtag}>";
					$i++;
					}	// CLOSE FOREACH
					
					
					
								 
					$output .= "
					</div>\n";	
					
				if($fg_pagination_active == 'on') {
				
					$output .= '<div id="'.$selector.'" class="fastgallery_mosaic '.$fg_pagination_style.'">'.ewmp_elementor_pagination($num_page_for_pagination,$pagination).'</div>';
				
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
