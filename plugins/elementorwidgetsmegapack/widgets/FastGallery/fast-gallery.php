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
class Fast_Gallery extends Widget_Base {

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
		return 'fast-gallery';
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
		return esc_html__( 'Fast Gallery', 'elementorwidgetsmegapack' );
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
					'fotorama' 			=> 'Fotorama Slideshow',
					'lightgallery' 		=> 'Light Gallery',
					'photoswipe' 		=> 'Photoswipe',
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
			'size',
			[
				'label' => esc_html__( 'Masonry / Grid', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'fg-normal',
				'options' => [
					'fg-normal' 		=> 'Grid',
					'fg-masonry' 		=> 'Masonry'
				]
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

		$this->add_control(
			'fg_thumbs_one',
			[
				'label' => esc_html__( 'One Thumbs for Gallery', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'off',
				'options' => [
					'off'	=> 'Off',
					'fg_thumbs_one' 	=> 'On'					
				]
			]
		);

		$this->add_control(
			'fg_lazyload',
			[
				'label' => esc_html__( 'Lazy Load', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'off',
				'options' => [
					'off'	=> 'Off',
					'on' 	=> 'On'					
				]
			]
		);

		$this->add_control(
			'fg_lazyload_effect',
			[
				'label' => esc_html__( 'Lazy Load Animation (Fade in Effect)', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'yes',
				'options' => [
					'yes'	=> 'Yes',
					'no' 	=> 'No'					
				],
				'condition'	=> [
					'fg_lazyload'	=> 'on'
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

		// Fotorama
		$this->add_control(
			'fg_title',
			[
				'label' => esc_html__( 'Fotorama Extra Option', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::TEXT,
				'condition'	=> [
					'fg_type'	=> 'fotorama'
				]
			]
		);

		$this->add_control(
			'fg_autoplay',
			[
				'label' => esc_html__( 'Autoplay', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => [
					'true'		=> 'On',
					'false' 	=> 'Off'					
				],
				'condition'	=> [
					'fg_type'	=> 'fotorama'
				]
			]
		);

		$this->add_control(
			'fg_nav',
			[
				'label' => esc_html__( 'Nav', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'thumbs',
				'options' => [
					'Thumbs'	=> 'Thumbs',
					'dot' 		=> 'Dot',					
					'hidden' 		=> 'Hidden'					
				],
				'condition'	=> [
					'fg_type'	=> 'fotorama'
				]
			]
		);

		$this->add_control(
			'fg_navposition',
			[
				'label' => esc_html__( 'Nav Position', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'bottom',
				'options' => [
					'bottom'	=> 'Bottom',
					'top' 		=> 'Top'				
				],
				'condition'	=> [
					'fg_type'	=> 'fotorama'
				]
			]
		);

		$this->add_control(
			'fg_allowfullscreen',
			[
				'label' => esc_html__( 'Allow fullscreen', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => [
					'true'	=> 'On',
					'false' => 'Off'				
				],
				'condition'	=> [
					'fg_type'	=> 'fotorama'
				]
			]
		);

		$this->add_control(
			'fg_transition',
			[
				'label' => esc_html__( 'Transition', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'slide',
				'options' => [
					'slide'	=> 'Slide',
					'crossfade' => 'Crossfade',				
					'dissolve' => 'Dissolve'				
				],
				'condition'	=> [
					'fg_type'	=> 'fotorama'
				]
			]
		);

		$this->add_control(
			'fg_arrow',
			[
				'label' => esc_html__( 'Arrow', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => [
					'true'	=> 'On',
					'false' => 'Off'				
				],
				'condition'	=> [
					'fg_type'	=> 'fotorama'
				]
			]
		);

		$this->add_control(
			'fg_fit',
			[
				'label' => esc_html__( 'Fit', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none'	=> 'None',
					'contain' => 'Contain',				
					'cover' => 'Cover',				
					'scaledown' => 'Scaledown'				
				],
				'condition'	=> [
					'fg_type'	=> 'fotorama'
				]
			]
		);

		$this->add_control(
			'fg_loop',
			[
				'label' => esc_html__( 'Loop', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => [
					'true'	=> 'On',
					'false' => 'Off'				
				],
				'condition'	=> [
					'fg_type'	=> 'fotorama'
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
				'default' => 'ewmp-normal',
				'options' => [
					'ewmp-normal'	=> 'Default (800px)',
					'thumbnail' 	=> 'Thumbnail',				
					'medium' 		=> 'Medium',				
					'large' 		=> 'Large',				
					'full' 			=> 'Full'			
				],
				'condition'	=> [
					'size'	=> 'fg-normal'
				]
			]
		);

		$this->add_control(
			'fg_thumbs_masonry',
			[
				'label' => esc_html__( 'Masonry Thumbnails Size', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'ewmp-masonry',
				'options' => [
					'ewmp-masonry'	=> 'Default (500px)',
					'thumbnail' 	=> 'Thumbnail',				
					'medium' 		=> 'Medium',				
					'large' 		=> 'Large',				
					'full' 			=> 'Full'			
				],
				'condition'	=> [
					'size'	=> 'fg-masonry'
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
			'section_responsive',
			[
				'label' => esc_html__( 'Responsive', 'elementorwidgetsmegapack' )
			]
		);
		
		$this->add_control(
			'fg_active_custom_responsive',
			[
				'label' => esc_html__( 'Active Custom Responsive', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'fg_responsive',
				'options' => [
					'fg_responsive' 			=> 'Defatul Value',
					'active_custom_responsive' 	=> 'Active Custom Responsive'						
				],
				'condition'	=> [
					'fg_responsive'	=> 'fg_responsive'
				]
			]
		);		
		
		$this->add_control(
			'fg_smartphone_p_columns',
			[
				'label' => esc_html__( 'Smartphone Portrait', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => '2',
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
					'fg_responsive'	=> 'fg_responsive'
				]
			]
		);		

		$this->add_control(
			'fg_smartphone_l_columns',
			[
				'label' => esc_html__( 'Smartphone Landscape', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => '2',
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
					'fg_responsive'	=> 'fg_responsive'
				]
			]
		);

		$this->add_control(
			'fg_tablet_p_columns',
			[
				'label' => esc_html__( 'Tablet Portrait', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => '3',
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
					'fg_responsive'	=> 'fg_responsive'
				]
			]
		);

		$this->add_control(
			'fg_tablet_l_columns',
			[
				'label' => esc_html__( 'Tablet Landscape', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => '3',
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
					'fg_responsive'	=> 'fg_responsive'
				]
			]
		);

		$this->add_control(
			'fg_desktop_medium_columns',
			[
				'label' => esc_html__( 'Desktop (min 640px - max 1024px)', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'label_block' => true,
				'default' => '2',
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
					'fg_responsive'	=> 'fg_responsive'
				]
			]
		);

		$this->add_control(
			'fg_desktop_small_columns',
			[
				'label' => esc_html__( 'Desktop (max 639px)', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => '2',
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
					'fg_responsive'	=> 'fg_responsive'
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
			'fg_spacing',
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
				$columns 							= esc_html($settings['columns']);
				$fg_type 							= esc_html($settings['fg_type']);
				$size 								= esc_html($settings['size']);
				$fg_responsive 						= esc_html($settings['fg_responsive']);
				$fg_style 							= esc_html($settings['fg_style']);
				$fg_over_image 						= esc_html($settings['fg_over_image']);
				$fg_thumbs_one 						= esc_html($settings['fg_thumbs_one']);
				$fg_lazyload 						= esc_html($settings['fg_lazyload']);
				$fg_lazyload_effect 				= esc_html($settings['fg_lazyload_effect']);
				$fg_pagination_active 				= esc_html($settings['fg_pagination_active']);
				$fg_pagination_number 				= esc_html($settings['fg_pagination_number']);
				if(empty($fg_pagination_number)) { $fg_pagination_number = '10'; }
				$fg_pagination_style 				= esc_html($settings['fg_pagination_style']);
				$fg_main_color 						= esc_html($settings['fg_main_color']);
				$fg_main_color_opacity 				= esc_html($settings['fg_main_color_opacity']);
				$fg_secondary_color 				= esc_html($settings['fg_secondary_color']);
				$fg_spacing_active 					= esc_html($settings['fg_spacing_active']);
				$fg_spacing 						= esc_html($settings['fg_spacing']);
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
				$fg_caption 						= esc_html($settings['fg_caption']);
				$fg_autoplay 						= esc_html($settings['fg_autoplay']);
				$fg_nav 							= esc_html($settings['fg_nav']);
				$fg_navposition 					= esc_html($settings['fg_navposition']);
				$fg_allowfullscreen 				= esc_html($settings['fg_allowfullscreen']);
				$fg_transition 						= esc_html($settings['fg_transition']);
				$fg_arrow 							= esc_html($settings['fg_arrow']);
				$fg_fit 							= esc_html($settings['fg_fit']);
				$fg_loop 							= esc_html($settings['fg_loop']);
				$fg_thumbs_grid 					= esc_html($settings['fg_thumbs_grid']);
				$fg_thumbs_masonry 					= esc_html($settings['fg_thumbs_masonry']);
				$fg_thumbs_lightbox 				= esc_html($settings['fg_thumbs_lightbox']);
				$lg_mode 							= esc_html($settings['lg_mode']);
				$lg_speed 							= esc_html($settings['lg_speed']);
				$lg_thumbnail 						= esc_html($settings['lg_thumbnail']);
				$lg_controls 						= esc_html($settings['lg_controls']);
				$custom_url_target 					= esc_html($settings['custom_url_target']); 
				$fg_active_custom_responsive 		= esc_html($settings['fg_active_custom_responsive']);
				$fg_smartphone_p_columns 			= esc_html($settings['fg_smartphone_p_columns']);
				$fg_smartphone_l_columns 			= esc_html($settings['fg_smartphone_l_columns']);
				$fg_tablet_p_columns 				= esc_html($settings['fg_tablet_p_columns']);
				$fg_tablet_l_columns 				= esc_html($settings['fg_tablet_l_columns']);
				$fg_desktop_medium_columns 			= esc_html($settings['fg_desktop_medium_columns']);
				$fg_desktop_small_columns 			= esc_html($settings['fg_desktop_small_columns']);
				$fg_animate 						= esc_html($settings['fg_animate']);
				$fg_animate_effect 					= esc_html($settings['fg_animate_effect']);
				$fg_delay 							= esc_html($settings['fg_delay']); 	

			wp_enqueue_script('fast-gallery-frontend');
			wp_enqueue_style('fonts-vc');
			wp_enqueue_style( 'elementor-icons' );
			wp_enqueue_style( 'font-awesome' );
			wp_enqueue_style( 'elementor-editor' );
			wp_enqueue_style( 'elementor-icons' );	
			wp_enqueue_style( 'fontawesome' );		
			
			if($fg_type == 'prettyphoto') {
				wp_enqueue_style( 'prettyPhoto' );
				wp_enqueue_script( 'prettyPhoto');
			}
			if($fg_type == 'magnific-popup') {
				wp_enqueue_style( 'magnific-popup' );
				wp_enqueue_script( 'magnific-popup');
			}			
			if($fg_type == 'fotorama') {
				wp_enqueue_style( 'fotorama' );
				wp_enqueue_script( 'fotorama');
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
			if($size == 'fg-masonry') {
				wp_enqueue_script( 'masonry' );
			}
		
		$output = '';
		
			/* CHECK CUSTOM RESPONSIVE */
			if($fg_responsive = 'fg_responsive') {
				if($fg_active_custom_responsive == 'fg_responsive') {
					$fg_responsive = 'fg_responsive';
				} else {
					wp_enqueue_style( 'custom-responsive-vc' );
					$fg_responsive = 'fg_smartphone_p_col-'.$fg_smartphone_p_columns.' fg_smartphone_l_col-'.$fg_smartphone_l_columns.' fg_tablet_p_col-'.$fg_tablet_p_columns.' fg_tablet_l_col-'.$fg_tablet_l_columns.' fg_desktop_medium_col-'.$fg_desktop_medium_columns.' fg_desktop_small_col-'.$fg_desktop_small_columns.'';				
				}	
			}
						
			//$content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content

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
												  $fg_spacing_active, 
												  $fg_spacing, 
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
					#{$selector}.fastgallery .fg-gallery-caption, 
					#{$selector}.fastgallery .fg-gallery-caption:hover {
						background-color:".$rgba_main_color.";
					}
					#{$selector}.fastgallery.gallery .fastgallery-gallery-icon .fg_zoom a, 
					#{$selector}.fastgallery.gallery .fastgallery-gallery-icon .fg_zoom a:hover {
						color:".$fg_main_color.";
					}
					#{$selector}.fastgallery.fg_style1 .fg-gallery-caption {
						color:".$fg_secondary_color.";	
					}
					#{$selector}.fastgallery.gallery.fg_style2 .fastgallery-gallery-icon .fg_zoom a {
						background:".$rgba_secondary_color.";
					}
					#{$selector}.fastgallery.fg_style2 .fg-gallery-caption {
						color:".$fg_secondary_color.";	
					}			
					#{$selector}.fastgallery.gallery.fg_style3 .fg_zoom, #{$selector}.fastgallery.gallery.fg_style3 .fg_zoom:hover {
						background:".$rgba_main_color.";
					}
					#{$selector}.fastgallery.fg_style3 .fg-gallery-caption {
						color:".$fg_secondary_color.";	
					}				
					#{$selector}.fastgallery.fg_style4 .fg-gallery-caption,			
					#{$selector}.fastgallery.gallery.fg_style4 .fastgallery-gallery-icon .fg_zoom a, 
					#{$selector}.fastgallery.gallery.fg_style4 .fastgallery-gallery-icon .fg_zoom a:hover {
						color:".$fg_secondary_color.";
					}
					#{$selector}.fastgallery.gallery.fg_style4 .fastgallery-gallery-icon .fg_zoom a, 
					#{$selector}.fastgallery.gallery.fg_style4 .fastgallery-gallery-icon .fg_zoom a:hover	{
						background:".$rgba_main_color.";
					}			
					#{$selector}.fastgallery.gallery.fg_style5 .fastgallery-gallery-icon .fg_zoom a, 
					#{$selector}.fastgallery.gallery.fg_style5 .fastgallery-gallery-icon .fg_zoom a:hover	{
						color:".$fg_secondary_color.";
						background-color:".$rgba_main_color.";
					}					
					#{$selector}.fastgallery.gallery.fg_style6 .fastgallery-gallery-icon .fg_zoom a,
					#{$selector}.fastgallery.gallery.fg_style6 .fastgallery-gallery-icon .fg_zoom a:hover {
						color:".$fg_secondary_color.";
						background:".$rgba_main_color.";				
					}
				
					#{$selector}.fastgallery.fg_style6 .fg-gallery-caption {
						color:".$fg_secondary_color.";	
					}
					#{$selector}.fastgallery.gallery.fg_style7 .fastgallery-gallery-icon .fg_zoom a,
					#{$selector}.fastgallery.gallery.fg_style7 .fastgallery-gallery-icon .fg_zoom a:hover {
						color:".$fg_secondary_color.";
						background:".$rgba_main_color.";				
					}		
					#{$selector}.fastgallery.fg_style7 .fg-gallery-caption {
						color:".$fg_secondary_color.";	
					}
					
					#{$selector}.fastgallery.gallery.fg_style8 .fastgallery-gallery-icon .fg_zoom a,
					#{$selector}.fastgallery.gallery.fg_style8 .fastgallery-gallery-icon .fg_zoom a:hover {
						color:".$fg_secondary_color.";
						background:".$rgba_main_color.";				
					}
				
					#{$selector}.fastgallery.fg_style8 .fg-gallery-caption {
						color:".$fg_secondary_color.";	
					}
					
					#{$selector}.fastgallery.gallery.fg_style9 .fastgallery-gallery-icon .fg_zoom a,
					#{$selector}.fastgallery.gallery.fg_style9 .fastgallery-gallery-icon .fg_zoom a:hover {
						color:".$fg_secondary_color.";
						background:".$rgba_main_color.";				
					}		
					#{$selector}.fastgallery.fg_style9 .fg-gallery-caption {
						color:".$fg_secondary_color.";	
					}
					
					#{$selector}.fastgallery.gallery.fg_style10 .fastgallery-gallery-icon .fg_zoom a,
					#{$selector}.fastgallery.gallery.fg_style10 .fastgallery-gallery-icon .fg_zoom a:hover {
						color:".$fg_secondary_color.";
						background:".$rgba_main_color.";				
					}		
					#{$selector}.fastgallery.fg_style10 .fg-gallery-caption {
						color:".$fg_secondary_color.";	
					}
					#{$selector}.fastgallery.fg_style11 .fg-gallery-caption {
						color:".$fg_secondary_color.";	
					}
					#{$selector}.fastgallery.fg_style11 .fastgallery-gallery-icon .fg_zoom a, 
					#{$selector}.fastgallery.fg_style11 .fastgallery-gallery-icon .fg_zoom a:hover {
						color:".$fg_main_color.";
						background:".$rgba_secondary_color.";
					}
					#{$selector}.fastgallery.fg_style12 .fg-gallery-caption {
						color:".$fg_secondary_color.";	
					}
					#{$selector}.fastgallery.fg_style12 .fastgallery-gallery-icon .fg_zoom a, 
					#{$selector}.fastgallery.fg_style12 .fastgallery-gallery-icon .fg_zoom a:hover {
						color:".$fg_main_color.";
						background:".$rgba_secondary_color.";
					}																
					/* FOTORAMA */
					#{$selector}.fastgallery.fotorama.fg_style1 .fotorama__thumb-border {
						border-color:".$rgba_main_color.";
					}
					#{$selector}.fastgallery.fotorama.fg_style1 .fotorama__html > div {
						background:".$rgba_main_color.";
						color:".$fg_secondary_color.";
					}
					#{$selector}.fastgallery.fotorama.fg_style2 .fotorama__thumb-border {
						border-color:".$rgba_main_color.";
					}
					#{$selector}.fastgallery.fotorama.fg_style2 .fotorama__html > div {
						background:".$rgba_main_color.";
						color:".$fg_secondary_color.";
					}
					#{$selector}.fastgallery.fotorama.fg_style3 .fotorama__thumb-border {
						border-color:".$rgba_main_color.";
					}						
					#{$selector}.fastgallery.fotorama.fg_style3 .fotorama__html > div {
						color:".$fg_secondary_color.";
					}
					#{$selector}.fastgallery.fotorama.fg_style4 .fotorama__thumb-border {
						border-color:".$rgba_main_color.";
					}						
					#{$selector}.fastgallery.fotorama.fg_style4 .fotorama__html > div {
						color:".$fg_secondary_color.";
					}
					#{$selector}.fastgallery.fotorama.fg_style5 .fotorama__thumb-border {
						border-color:".$rgba_main_color.";
						background:".$rgba_main_color.";
					}						
					#{$selector}.fastgallery.fotorama.fg_style5 .fotorama__html > div {
						color:".$fg_secondary_color.";
					}
					#{$selector}.fastgallery.fotorama.fg_style6 .fotorama__thumb-border {
						border-color:".$rgba_main_color.";
						background:".$rgba_main_color.";
					}						
					#{$selector}.fastgallery.fotorama.fg_style6 .fotorama__html > div {
						color:".$fg_secondary_color.";
					}
					#{$selector}.fastgallery.fotorama.fg_style7 .fotorama__thumb-border {
						border-color:".$rgba_main_color.";
						background:".$rgba_main_color.";
					}						
					#{$selector}.fastgallery.fotorama.fg_style7 .fotorama__html > div {
						color:".$fg_secondary_color.";
						background:".$rgba_main_color.";
					}
					#{$selector}.fastgallery.fotorama.fg_style8 .fotorama__thumb-border {
						border-color:".$rgba_main_color.";
						background:".$rgba_main_color.";
					}						
					#{$selector}.fastgallery.fotorama.fg_style8 .fotorama__html > div {
						color:".$fg_secondary_color.";
						background:".$rgba_main_color.";
					}
					#{$selector}.fastgallery.fotorama.fg_style9 .fotorama__thumb-border {
						border-color:".$rgba_main_color.";
						background:".$rgba_main_color.";
					}						
					#{$selector}.fastgallery.fotorama.fg_style9 .fotorama__html > div {
						color:".$fg_secondary_color.";
						background:".$rgba_main_color.";
					}
					#{$selector}.fastgallery.fotorama.fg_style10 .fotorama__thumb-border {
						border-color:".$rgba_main_color.";
						background:".$rgba_main_color.";
					}						
					#{$selector}.fastgallery.fotorama.fg_style10 .fotorama__html > div {
						color:".$fg_secondary_color.";
						background:".$rgba_main_color.";
					}
					#{$selector}.fastgallery.fotorama.fg_style11 .fotorama__thumb-border {
						border-color:".$rgba_main_color.";
					}
					#{$selector}.fastgallery.fotorama.fg_style11 .fotorama__html > div {
						background:".$rgba_main_color.";
						color:".$fg_secondary_color.";
					}
					#{$selector}.fastgallery.fotorama.fg_style12 .fotorama__thumb-border {
						border-color:".$rgba_main_color.";
					}
					#{$selector}.fastgallery.fotorama.fg_style12 .fotorama__html > div {
						background:".$rgba_main_color.";
						color:".$fg_secondary_color.";
					}										
					/* THUMBS ONE ON */
					#{$selector}.fastgallery.fg_thumbs_one .fg-gallery-item {
						display:none;
					}
					#{$selector}.fastgallery.fg_thumbs_one .fg-gallery-item:first-child {
						display:block;
					}
					#{$selector}.fastgallery.fg_thumbs_one {
						width:auto!important;
					}
				";
				
				if($fg_pagination_active == 'on') {
					$gallery_style .= "
						#{$selector}.fastgallery.fg_pagination_style1 ul.fg_pagination li a {
							background:".$rgba_main_color.";
							color:".$fg_secondary_color.";
						}
						#{$selector}.fastgallery.fg_pagination_style1 ul.fg_pagination li a:hover {
							background:".$fg_secondary_color.";
							color:".$rgba_main_color.";
						}
						#{$selector}.fastgallery.fg_pagination_style1 ul.fg_pagination li.fg_current {
							background:".$fg_secondary_color.";
							color:".$rgba_main_color.";
						}
						#{$selector}.fastgallery.fg_pagination_style2 ul.fg_pagination li a {
							color:".$fg_secondary_color.";
						}
						#{$selector}.fastgallery.fg_pagination_style2 ul.fg_pagination li a:hover {
							color:".$rgba_main_color.";
						}
						#{$selector}.fastgallery.fg_pagination_style2 ul.fg_pagination li.fg_current {
							color:".$rgba_main_color.";
						}																		
					";
				}
				
				
				
				
				if($fg_spacing_active == 'on') {
					$gallery_style .= "
						.fastgallery.gallery {
							width:100%;
							width: -webkit-calc(100% + ".$fg_spacing."px);
							width: calc(100% + ".$fg_spacing."px);
							/*margin-left:".$fg_spacing."px;*/
						}
						.fastgallery .fg-gallery-item {
							margin-right:".$fg_spacing."px!important;
							margin-bottom:".$fg_spacing."px!important;
						}
						.fastgallery.gallery-columns-2 .fg-gallery-item {
							max-width: 48%;
							max-width: -webkit-calc(50% - ".$fg_spacing."px);
							max-width:         calc(50% - ".$fg_spacing."px);
						}
						
						.fastgallery.gallery-columns-3 .fg-gallery-item {
							max-width: 32%;
							max-width: -webkit-calc(33.3% - ".$fg_spacing."px);
							max-width:         calc(33.3% - ".$fg_spacing."px);
						}
						
						.fastgallery.gallery-columns-4 .fg-gallery-item {
							max-width: 23%;
							max-width: -webkit-calc(25% - ".$fg_spacing."px);
							max-width:         calc(25% - ".$fg_spacing."px);
						}
						
						.fastgallery.gallery-columns-5 .fg-gallery-item {
							max-width: 19%;
							max-width: -webkit-calc(20% - ".$fg_spacing."px);
							max-width:         calc(20% - ".$fg_spacing."px);
						}
						
						.fastgallery.gallery-columns-6 .fg-gallery-item {
							max-width: 15%;
							max-width: -webkit-calc(16.7% - ".$fg_spacing."px);
							max-width:         calc(16.7% - ".$fg_spacing."px);
						}
						
						.fastgallery.gallery-columns-7 .fg-gallery-item {
							max-width: 13%;
							max-width: -webkit-calc(14.28% - ".$fg_spacing."px);
							max-width:         calc(14.28% - ".$fg_spacing."px);
						}
						
						.fastgallery.gallery-columns-8 .fg-gallery-item {
							max-width: 11%;
							max-width: -webkit-calc(12.5% - ".$fg_spacing."px);
							max-width:         calc(12.5% - ".$fg_spacing."px);
						}
						
						.fastgallery.gallery-columns-9 .fg-gallery-item {
							max-width: 9%;
							max-width: -webkit-calc(11.1% - ".$fg_spacing."px);
							max-width:         calc(11.1% - ".$fg_spacing."px);
						}
					";
				}
				
				if($fg_type == 'only_image') {
					$gallery_style .= "
					#{$selector}.fastgallery .fg_zoom a {
						display:none;	
					}
					";
				}

				if($fg_image_lightbox == 'zoomin') {
					$gallery_style .= '#'.$selector.'.fastgallery .icon-plus:before {	
										content: "\e6ef"!important;
					}';
				}
				if($fg_image_lightbox == 'image') {
					$gallery_style .= '#'.$selector.'.fastgallery .icon-plus:before {	
										content: "\e687"!important;
					}';
				}	
				if($fg_image_lightbox == 'images') {
					$gallery_style .= '#'.$selector.'.fastgallery .icon-plus:before {	
										content: "\e605"!important;
					}';
				}	
				if($fg_image_lightbox == 'spinner_icon') {
					$gallery_style .= '#'.$selector.'.fastgallery .icon-plus:before {	
										content: "\e6e7"!important;
					}';
				}
				if($fg_image_lightbox == 'search_icon') {
					$gallery_style .= '#'.$selector.'.fastgallery .icon-plus:before {	
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

				// PHOTOBOX
				if($fg_type == 'photobox') { // PHOTOBOX CSS/JS
				
					if($fg_lazyload == 'on') {
						$pb_thumbs = 'false';
					}
			
					$gallery_script = '<script type="text/javascript">
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
					$gallery_script = '<script type="text/javascript">		
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
					$gallery_script = '<script type="text/javascript">
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
				
				
				
				
				// FOTORAMA
				if($fg_type == 'fotorama') {
					
				$gallery_script = "<script type=\"text/javascript\">
					jQuery(function($){
						$('#$selector.fastgallery').fotorama({
							maxwidth: '100%',
							arrows: ".$fg_arrow.",
							autoplay: ".$fg_autoplay.",
							";
							if($fg_nav != 'dot') { 
								$gallery_script .= "nav: '".$fg_nav."',"; 
							}	
				$gallery_script .=	"navposition: '".$fg_navposition."',
							transition: '".$fg_transition."',
							
							allowfullscreen: ".$fg_allowfullscreen.",
							
							loop: ".$fg_loop.",
							fit: '".$fg_fit."',									  
						});
					});
					</script>";
				}
				
				// LIGHTGALLERY
				if($fg_type == 'lightgallery') {
					if($lg_mode == 'lg-fade') {
						$lg_mode = 'fade';	
					} else {
						$lg_mode = 'slide';
					}
					$gallery_script = '<script type="text/javascript">
						jQuery(function($){
							$(\'#'.$selector.'.gallery.fastgallery\').lightGallery({
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
				if($fg_type == 'custom_url' || $fg_type == 'only_image' || $fg_type == 'photoswipe') {
					$gallery_script = '';
				}
				
				// LAZY LOAD GRID
				$lazyload_class = '';
				if($fg_lazyload == 'on' && $size == 'fg-normal') {
					wp_enqueue_script( 'lazyload');
					wp_enqueue_script( 'imagesLoaded');
					$gallery_script .= '<script type="text/javascript">
						jQuery(function($){
							$(\'#'.$selector.' .fg-gallery-item img\').lazyload(';
							if($fg_lazyload_effect == 'yes') {	
										
								$gallery_script .= '{
													effect: \'fadeIn\',
													effectspeed: 2000
													}';
							
							}							
					$gallery_script .= ');
						});		
					</script>';
					$lazyload_class = 'fg_lazyload';								
				}
				
				// LAZY LOAD MASONRY
				if($size == 'fg-masonry') {
					
					if($fg_lazyload == 'off') { // MASONRY WHEN LAZY LOAD IS OFF
											
						$gallery_script .= '<script type="text/javascript">
						jQuery(window).load(function() {
							jQuery(document).ready(function($){
								$(\'.fastgallery.brick-masonry\').masonry({
									singleMode: true,
									itemSelector: \'.fg-gallery-item\'
								});
							});
						});
						</script>';
						
					} else { // LAZY LOAD IS ON
						
						wp_enqueue_script( 'fg-lazyload-js');
						wp_enqueue_script( 'fg-imagesLoaded-js');
						$gallery_script .= '<script type="text/javascript">
							jQuery(document).ready(function($){
						$("#'.$selector.' .fg-gallery-item img").lazyload(';
							if($fg_lazyload_effect == 'yes') {	
										
								$gallery_script .= '{
													effect: \'fadeIn\',
													effectspeed: 2000
													}';
							
							}
							
							$gallery_script .= ');

						$(\'#'.$selector.' .fg-gallery-item img\').load(function() {
							masonry_update();
						});

						function masonry_update() {     
							var $works_list = $(\'#'.$selector.'\');
							$works_list.imagesLoaded(function(){
								$works_list.masonry({
									itemSelector: \'.fg-gallery-item\',　
								});
							});
						 }    
						 
						 
						});
						</script>';
						
					}
				}

				// GALLERY NAME
				$gallery_name = '';
				if($fg_gallery_name_show == 'true') {
					$gallery_name = '<h2 class="fg_gallery_title-'.$instance.' fg_gallery_name">'.$fg_gallery_name.'</h2>';	
				}
				
				$size_class = sanitize_html_class( $size );
				// != FOTORAMA
				if($fg_type == 'fotorama') {	
					$gallery_div = "".$gallery_name."<div id='$selector' class='fastgallery fpg ".$fg_style." ".$animation_info." ".$lazyload_class."";
					$output = $gallery_style . $gallery_script . $gallery_div;
				} elseif ($fg_thumbs_one == 'fg_thumbs_one') {
					
					if ($fg_type == 'photoswipe') {
					
					$gallery_div = "".$gallery_name."<div id='$selector' class='gallery galleryid-{$instance} gallery-columns-{$columns} gallery-size-{$size_class} fastgallery fpg ".$fg_responsive." ".$fg_style." ".$fg_thumbs_one." ".$lazyload_class." ".$fg_over_image."'><div class='fg-photoswipe'>";
					
					} else {
						
					$gallery_div = "".$gallery_name."<div id='$selector' class='gallery galleryid-{$instance} gallery-columns-{$columns} gallery-size-{$size_class} fastgallery fpg ".$fg_responsive." ".$fg_style." ".$fg_thumbs_one." ".$lazyload_class." ".$fg_over_image."'>";

					}
					
					$output = $gallery_style . $gallery_script . $gallery_div;		
				} else {
					if ($fg_type == 'photoswipe') {
						$gallery_div = "".$gallery_name."<div id='$selector' class='gallery galleryid-{$instance} gallery-columns-{$columns} gallery-size-{$size_class} fastgallery fpg brick-masonry ".$size." ".$fg_responsive." ".$fg_style." ".$fg_thumbs_one." ".$lazyload_class." ".$fg_over_image."'><div class='fg-photoswipe'>";
					} else {
						$gallery_div = "".$gallery_name."<div id='$selector' class='gallery galleryid-{$instance} gallery-columns-{$columns} gallery-size-{$size_class} fastgallery fpg brick-masonry ".$size." ".$fg_responsive." ".$fg_style." ".$fg_thumbs_one." ".$lazyload_class." ".$fg_over_image."'>";
					}
					$output = $gallery_style . $gallery_script . $gallery_div;
				}
				
				// PAGINATION ### Change array for pagination ###
				$images = '';
				foreach ( $settings['images'] as $image ) {
					$id = $image['id'];
					$images .= $id . ',';
				}
				$images = rtrim($images,',');
				$images = explode( ',', $images );
				if($fg_pagination_active == 'on') {
				
					$pagination = get_query_var('fg_page');		
					
					if(!isset($pagination) || empty($pagination)) { $pagination = 1; }
					
					$images_array = array_chunk($images,$fg_pagination_number);
													
					$pag = $pagination - 1;
					$images_pag = $images_array[$pag];
					$settings['images'] = '';
					foreach($images_pag as $image_pag) {
						$settings['images'][] = array('id' => $image_pag);
					}
					
					$num_page_for_pagination = count($images_array); // VALUE FOR PAGINATION FUNCTION

				}
				// #PAGINATION
				
				
				
				$i = -1;
				
				// IF FOTORAMA CHANGE FOREACH
				if($fg_type == 'fotorama') {	
			 
					foreach ( $settings['images'] as $image ) {
						$id = $image['id'];
			 
						$image_url = wp_get_attachment_image_src( $id, $fg_thumbs_lightbox );
						$attachment_caption_array = get_post( $id );
						$attachment_caption	= $attachment_caption_array->post_excerpt;
						if(empty($attachment_caption)) { $attachment_caption = ' '; }
						$output .= '<div data-img="'.$image_url[0].'">'.$attachment_caption.'</div>';
			
					}
			 
			 
			 
					$output .= '<div style="clear:both"></div></div>';
			 
			 
				} elseif ($fg_type == 'photoswipe') { // IF PHOTOSWIPE 
				
					foreach ( $settings['images'] as $image ) {
						$id = $image['id'];
				
						$image_url = wp_get_attachment_image_src( $id, $fg_thumbs_lightbox );
						
						if($size == 'fg-normal') {
							$link_text = wp_get_attachment_image( $id , $fg_thumbs_grid);
						} else {
							$link_text = wp_get_attachment_image( $id , $fg_thumbs_masonry);
						}
						
						if($fg_lazyload == 'on') {
							if($size == 'fg-normal') {
								$link_text = wp_get_attachment_image_src( $id , $fg_thumbs_grid);
							} else {
								$link_text = wp_get_attachment_image_src( $id , $fg_thumbs_masonry);
							}
							$link_text = '<img data-original="'.$link_text[0].'" width="'.$link_text[1].'" height="'.$link_text[2].'">';
						
						}	
											
						$attachment_caption_array = get_post( $id );
						$attachment_caption	= $attachment_caption_array->post_excerpt;
						if(empty($attachment_caption)) { $attachment_caption = ' '; }	
						
						// CHECK CAPTION
						$caption_check = '';
						if($fg_caption == 'off'  || empty($attachment_caption) || $attachment_caption == ' ') {
							$caption_check = 'no-caption';
						}
						// END CHECK CAPTION						
						
						$output .= '<figure class=\'fg-gallery-item fastgallery-gallery-icon '.$caption_check .' fg_zoom\'>
										<a href="'.$image_url[0].'" itemprop="contentUrl" data-size="'.$image_url[1].'x'.$image_url[2].'">
											'.$link_text.'<span class=\'fg-zoom-icon icon-plus\'></span>
										</a>
										<figcaption itemprop="caption description">'.$attachment_caption.'</figcaption>';	
									

					
						if ($fg_caption == 'on' && !empty($attachment_caption) && $attachment_caption != ' ') {
						$output .= "
							<{$captiontag} class='fg-wp-caption-text fg-gallery-caption'><div class='caption-container'>
							" . $attachment_caption . "
							</div></{$captiontag}>";
						}			
									
						if($fg_style == 'fg_style4' || $fg_style == 'fg_style5' || $fg_style == 'fg_style6'
							|| $fg_style == 'fg_style7' || $fg_style == 'fg_style8' || $fg_style == 'fg_style9'
							|| $fg_style == 'fg_style10') {
							
							$output .= '<div class="fastgallery-mask"></div>';
							
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
					
					if($size == 'fg-normal') {
						$link_text = wp_get_attachment_image( $id , $fg_thumbs_grid);
					} else {
						$link_text = wp_get_attachment_image( $id , $fg_thumbs_masonry);
					}
					
					if($fg_lazyload == 'on') {
						if($size == 'fg-normal') {
							$link_text = wp_get_attachment_image_src( $id , $fg_thumbs_grid);
						} else {
							$link_text = wp_get_attachment_image_src( $id , $fg_thumbs_masonry);
						}
						$link_text = '<img data-original="'.$link_text[0].'" width="'.$link_text[1].'" height="'.$link_text[2].'">';
					
					}
					
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
					<{$icontag} class='fastgallery-gallery-icon $caption_check'>$image_output";
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
					
					if($fg_thumbs_one == 'off') {
						$output .= '<div class="fg_clear"></div>';
					}
						
				}
				
				if($fg_pagination_active == 'on') {
				
					$output .= '<div id="'.$selector.'" class="fastgallery '.$fg_pagination_style.'">'.ewmp_elementor_pagination($num_page_for_pagination,$pagination).'</div>';
				
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
