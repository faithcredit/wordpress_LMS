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
class Fast_Media_Gallery extends Widget_Base {

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
		return 'fast-media-gallery';
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
		return esc_html__( 'Fast Media Gallery', 'elementorwidgetsmegapack' );
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
			'name',
			[
				'label' => esc_html__( 'Title Gallery', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'name_show',
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

		$this->end_controls_section();

  		$this->start_controls_section(
  			'section_options',
  			[
  				'label' => esc_html__( 'Options', 'essential-addons-elementor' )
  			]
		);

		$this->add_control(
			'layout',
			[
				'label' => esc_html__( 'Masonry / Grid', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'fmg-normal',
				'options' => [
					'fmg-normal' 		=> 'Grid',
					'fmg-masonry' 		=> 'Masonry'
				]
			]
		);

		$this->add_control(
			'responsive_type',
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
			'over_image',
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
			'caption',
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
			'lazyload',
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
			'lazyload_effect',
			[
				'label' => esc_html__( 'Lazy Load Animation (Fade in Effect)', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'yes',
				'options' => [
					'yes'	=> 'Yes',
					'no' 	=> 'No'					
				],
				'condition'	=> [
					'lazyload'	=> 'on'
				]
			]
		);

		$this->add_control(
			'pagination_active',
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
			'pagination_number',
			[
				'label' => esc_html__( 'Number of images for each page (for example 10)', 'elementorwidgetsmegapack' ),
				'label_block' => true,
				'default' => '10',
				'type' => Controls_Manager::TEXT,
				'condition'	=> [
					'pagination_active'	=> 'on'
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_elements',
			[
				'label' => esc_html__( 'Elements', 'elementorwidgetsmegapack' ), // Section display name
			]
		);
		
		$this->add_control(
			'elements',
			[
				'label' => esc_html__( 'Add Element', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => [
					[
						'name' => 'element_label_name',
						'label' => esc_html__( 'Element Label Name', 'elementorwidgetsmegapack' ),
						'type' => Controls_Manager::TEXT,
						'default' => esc_html__( 'Item Name' , 'elementorwidgetsmegapack' ),
						'label_block' => true
					],
					[
						'name' => 'element_type',
						'label' => esc_html__( 'Type', 'elementorwidgetsmegapack' ),
						'type' => Controls_Manager::SELECT,
						'default' => 'off',
						'options' => [
							'image'	=> 'Image',
							'video' 	=> 'Video',					
							'audio' 	=> 'Audio',					
							'iframe' 	=> 'Iframe',					
							'custom_url' 	=> 'Custom URL (element without lightbox)',					
						],
						'label_block' => true
					],
					/* VIDEO TYPE */
					[
						'name' => 'element_url_video_type',
						'label' => esc_html__( 'Video URL Type', 'elementorwidgetsmegapack' ),
						'type' => Controls_Manager::SELECT,
						'default' => 'local',
						'options' => [
							'local'			=> esc_html__('Local','elementorwidgetsmegapack'),
							'youtube_vimeo' => esc_html__('Youtube or Vimeo','elementorwidgetsmegapack')					
						],
						'label_block' => true,
						'condition'	=> [
							'element_type'	=> 'video'
						]
					],
					[
						'name' => 'element_type_local_video',
						'label' => esc_html__( 'Video URL (ex http://yoursite.com/video.mp4)', 'elementorwidgetsmegapack' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
						'condition'	=> [
							'element_type'	=> 'video'
						]
					],
					[
						'name' => 'element_type_youtube_vimeo_video',
						'label' => esc_html__( 'Youtube or Vimeo Video URL (ex https://www.youtube.com/watch?v=asQx7laC9Ww)', 'elementorwidgetsmegapack' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
						'condition'	=> [
							'element_type'	=> 'video'
						]
					],			

					/* AUDIO TYPE */
					[
						'name' => 'element_url_audio_type',
						'label' => esc_html__( 'Audio URL Type', 'elementorwidgetsmegapack' ),
						'type' => Controls_Manager::SELECT,
						'default' => 'local',
						'options' => [
							'local'			=> esc_html__('Local','elementorwidgetsmegapack'),
							'soundcloud' 	=> esc_html__('Sound Cloud','elementorwidgetsmegapack')					
						],
						'label_block' => true,
						'condition'	=> [
							'element_type'	=> 'audio'
						]
					],
					[
						'name' => 'element_type_local_audio',
						'label' => esc_html__( 'Audio URL (ex http://yoursite.com/sound.mp3)', 'elementorwidgetsmegapack' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
						'condition'	=> [
							'element_type'	=> 'audio'
						]
					],
					[
						'name' => 'element_type_soundcloud_audio',
						'label' => esc_html__( 'Audio URL Sound Cloud (ex https://soundcloud.com/travisscott-2/wonderful-ftthe-weeknd)', 'elementorwidgetsmegapack' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
						'condition'	=> [
							'element_type'	=> 'audio'
						]
					],	
					
					/* IFRAME TYPE */
					[
						'name' => 'element_type_iframe',
						'label' => esc_html__( 'Iframe (ex https://www.google.com)', 'elementorwidgetsmegapack' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
						'condition'	=> [
							'element_type'	=> 'iframe'
						]
					],
					[
						'name' => 'element_poster_image_type',
						'label' => esc_html__( 'Image Poster Type', 'elementorwidgetsmegapack' ),
						'type' => Controls_Manager::SELECT,
						'default' => 'local',
						'options' => [
							'default'			=> esc_html__('Default','elementorwidgetsmegapack'),
							'custom' 	=> esc_html__('Custom','elementorwidgetsmegapack')					
						],
						'label_block' => true,
						'condition'	=> [
							'element_type'	=> array( 'video','audio','iframe' )
						]
					],				
					[
						'name' => 'element_image_poster',
						'label' => esc_html__( 'Image Poster Custom (If you get image from library (not uploaded) we reccomended you to regenerate your thumbs)', 'elementorwidgetsmegapack' ),
						'type' => \Elementor\Controls_Manager::MEDIA,
						'label_block' => true,
						'condition'	=> [
							'element_type'	=> array( 'video','audio','iframe' )
						]						
					],
					/* IMAGE TYPE */
					[
						'name' => 'element_type_image',
						'label' => esc_html__( 'Upload Your Image (If you get image from library (not uploaded) we reccomended you to regenerate your thumbs)', 'elementorwidgetsmegapack' ),
						'type' => \Elementor\Controls_Manager::MEDIA,
						'label_block' => true,
						'condition'	=> [
							'element_type'	=> 'image'
						]						
					],					
					[
						'name' => 'element_type_image_custom_url',
						'label' => esc_html__( 'Upload Your Image (If you get image from library (not uploaded) we reccomended you to regenerate your thumbs)', 'elementorwidgetsmegapack' ),
						'type' => \Elementor\Controls_Manager::MEDIA,
						'label_block' => true,
						'condition'	=> [
							'element_type'	=> 'custom_url'
						]						
					],					
					[
						'name' => 'element_custom_url',
						'label' => esc_html__( 'Custom URL', 'elementorwidgetsmegapack' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
						'condition'	=> [
							'element_type'	=> 'custom_url'
						]
					],					
					[
						'name' => 'element_custom_url_target',
						'label' => esc_html__( 'Custom URL Target', 'elementorwidgetsmegapack' ),
						'type' => Controls_Manager::SELECT,
						'default' => 'local',
						'options' => [
							'_blank'	=> esc_html__('Blank (new window)','elementorwidgetsmegapack'),
							'_self' 	=> esc_html__('Self (Same window)','elementorwidgetsmegapack')					
						],
						'label_block' => true,
						'condition'	=> [
							'element_type'	=> 'custom_url'
						]
					],					
					[
						'name' => 'element_caption_active',
						'label' => esc_html__( 'Caption', 'elementorwidgetsmegapack' ),
						'type' => Controls_Manager::SELECT,
						'default' => 'off',
						'options' => [
							'off'	=> esc_html__('Off','elementorwidgetsmegapack'),
							'on' 	=> esc_html__('On','elementorwidgetsmegapack')					
						]
					],					
					[
						'name' => 'element_caption',
						'label' => esc_html__( 'Caption Text', 'elementorwidgetsmegapack' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
						'condition'	=> [
							'element_caption_active'	=> 'on'
						]
					]						
				],
				'title_field' => '{{{ element_label_name }}}',
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

		// Light Gallery

		$this->add_control(
			'lg_speed',
			[
				'label' => esc_html__( 'Speed time in ms', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::TEXT,
				'default' => '2000'
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
				]
			]
		);	

		$this->add_control(
			'lg_yt_modestbranding',
			[
				'label' => esc_html__( 'Youtube Modest branding', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
					'1'	=> 'On',
					'0' => 'Off'				
				]
			]
		);	

		$this->add_control(
			'lg_yt_showinfo',
			[
				'label' => esc_html__( 'Youtube Show Info', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
					'1'	=> 'On',
					'0' => 'Off'				
				]
			]
		);

		$this->add_control(
			'lg_yt_rel',
			[
				'label' => esc_html__( 'Youtube Rel', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
					'1'	=> 'On',
					'0' => 'Off'				
				]
			]
		);

		$this->add_control(
			'lg_yt_controls',
			[
				'label' => esc_html__( 'Youtube Controls', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
					'1'	=> 'On',
					'0' => 'Off'				
				]
			]
		);

		$this->add_control(
			'lg_vi_byline',
			[
				'label' => esc_html__( 'Vimeo Byline (Show the user’s byline on the video)', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => '1',
				'label_block' => true,
				'options' => [
					'1'	=> 'On',
					'0' => 'Off'				
				]
			]
		);

		$this->add_control(
			'lg_vi_portrait',
			[
				'label' => esc_html__( 'Vimeo Portrait (Show the user’s portrait on the video)', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => '1',
				'label_block' => true,
				'options' => [
					'1'	=> 'On',
					'0' => 'Off'				
				]
			]
		);

		$this->add_control(
			'lg_vi_title',
			[
				'label' => esc_html__( 'Vimeo Title (Show the title on the video)', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => '1',
				'label_block' => true,
				'options' => [
					'1'	=> 'On',
					'0' => 'Off'				
				]
			]
		);

		$this->add_control(
			'lg_vi_badge',
			[
				'label' => esc_html__( 'Vimeo Badge (Enables or disables the badge on the video)', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => '1',
				'label_block' => true,
				'options' => [
					'1'	=> 'On',
					'0' => 'Off'				
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
			'image_thumb_size',
			[
				'label' => esc_html__( 'Image Thumbnail Size', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'ewmp-normal',
				'options' => [
					'ewmp-normal'	=> 'Default (1000px cropped)',
					'thumbnail' => 'Thumbnail',				
					'medium' 	=> 'Medium',				
					'large' 	=> 'Large',				
					'full' 		=> 'Full'			
				],
				'condition'	=> [
					'layout'	=> 'fmg-normal'
				]
			]
		);

		$this->add_control(
			'thumbs_masonry',
			[
				'label' => esc_html__( 'Masonry Thumbnails Size', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'ewmp-masonry',
				'options' => [
					'ewmp-masonry'	=> 'Default (800px)',
					'thumbnail' 				=> 'Thumbnail',				
					'medium' 					=> 'Medium',				
					'large' 					=> 'Large',				
					'full' 						=> 'Full'			
				],
				'condition'	=> [
					'layout'	=> 'fmg-masonry'
				]
			]
		);

		$this->add_control(
			'image_lightbox_size',
			[
				'label' => esc_html__( 'Image Lightbox Size', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'ewmp-large',
				'options' => [
					'ewmp-large' 			=> 'Default (1200px cropped)',
					'large' 				=> 'Large',
					'full' 					=> 'Full',
					'medium' 				=> 'Medium',
					'thumbnail' 			=> 'Thumbnail'							
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
			'active_custom_responsive',
			[
				'label' => esc_html__( 'Active Custom Responsive', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'fg_responsive',
				'options' => [
					'fg_responsive' 			=> 'Defatul Value',
					'active_custom_responsive' 	=> 'Active Custom Responsive'						
				],
				'condition'	=> [
					'responsive_type'	=> 'fg_responsive'
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
					'active_custom_responsive'	=> 'active_custom_responsive'
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
					'active_custom_responsive'	=> 'active_custom_responsive'
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
					'active_custom_responsive'	=> 'active_custom_responsive'
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
					'active_custom_responsive'	=> 'active_custom_responsive'
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
					'active_custom_responsive'	=> 'active_custom_responsive'
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
					'active_custom_responsive'	=> 'active_custom_responsive'
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
			'style',
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
			'main_color',
			[
				'label' => esc_html__( 'Main Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FC615D'
			]
		);

		$this->add_control(
			'main_color_opacity',
			[
				'label' => esc_html__( 'Main Color Opacity (value 0.1 to 1)', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => '1'
			]
		);

		$this->add_control(
			'secondary_color',
			[
				'label' => esc_html__( 'Secondary Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF'
			]
		);
		
		$this->add_control(
			'spacing_active',
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
			'spacing',
			[
				'label' => esc_html__( 'Spacing between the images (for example 20)', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => '20',
				'condition'	=> [
					'spacing_active'	=> 'on'
				]
			]
		);

		$this->add_control(
			'gallery_name_font_size',
			[
				'label' => esc_html__( 'Gallery Name Font Size (for example 20)', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => '20',
				'condition'	=> [
					'name_show'	=> 'true'
				]
			]
		);

		$this->add_control(
			'gallery_name_font_color',
			[
				'label' => esc_html__( 'Gallery Name Font Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FC615D',
				'condition'	=> [
					'name_show'	=> 'true'
				]
			]
		);

		$this->add_control(
			'gallery_name_text_align',
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
					'name_show'	=> 'true'
				]
			]
		);	

		$this->add_control(
			'image_width',
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
			'pagination_style',
			[
				'label' => esc_html__( 'Pagination Style', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'fg_pagination_style1',
				'options' => [
						'fg_pagination_style1' 	=> 'Style 1',
						'fg_pagination_style2' 	=> 'Style 2'
				],
				'condition'	=> [
					'pagination_active'	=> 'on'
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

					$name 						= esc_html($settings['name']);
					$name_show 					= esc_html($settings['name_show']);
					$columns 					= esc_html($settings['columns']);
					$type 						= 'lightgallery'; // FUTURE USE
					$layout 					= esc_html($settings['layout']);
					$responsive_type 			= esc_html($settings['responsive_type']);
					$over_image 				= esc_html($settings['over_image']);
					$caption 					= esc_html($settings['caption']);
					$lazyload 					= esc_html($settings['lazyload']);
					$lazyload_effect 			= esc_html($settings['lazyload_effect']);
					$pagination_active 			= esc_html($settings['pagination_active']);
					$pagination_number	 		= esc_html($settings['pagination_number']);
					
					$style						= esc_html($settings['style']);
					$main_color					= esc_html($settings['main_color']);
					$main_color_opacity			= esc_html($settings['main_color_opacity']);
					$secondary_color			= esc_html($settings['secondary_color']);
					$spacing_active				= esc_html($settings['spacing_active']);
					$spacing					= esc_html($settings['spacing']);
					$gallery_name_font_size		= esc_html($settings['gallery_name_font_size']);
					$gallery_name_font_color	= esc_html($settings['gallery_name_font_color']);
					$gallery_name_text_align	= esc_html($settings['gallery_name_text_align']);
					$pagination_style			= esc_html($settings['pagination_style']);
					$image_width				= esc_html($settings['image_width']);
					
					$image_lightbox_size		= esc_html($settings['image_lightbox_size']);
					$image_thumb_size			= esc_html($settings['image_thumb_size']);
					$thumbs_masonry				= esc_html($settings['thumbs_masonry']);
					
					$lg_speed 					= esc_html($settings['lg_speed']);
					$lg_thumbnail 				= esc_html($settings['lg_thumbnail']);
					$lg_controls				= esc_html($settings['lg_controls']);
					$lg_yt_modestbranding		= esc_html($settings['lg_yt_modestbranding']);
					$lg_yt_showinfo				= esc_html($settings['lg_yt_showinfo']);
					$lg_yt_rel					= esc_html($settings['lg_yt_rel']);
					$lg_yt_controls				= esc_html($settings['lg_yt_controls']);
					$lg_vi_byline				= esc_html($settings['lg_vi_byline']);
					$lg_vi_portrait				= esc_html($settings['lg_vi_portrait']);
					$lg_vi_title				= esc_html($settings['lg_vi_title']);
					$lg_vi_badge				= esc_html($settings['lg_vi_badge']);
										        
					$active_custom_responsive	= esc_html($settings['active_custom_responsive']);
					$fg_smartphone_p_columns 	= esc_html($settings['fg_smartphone_p_columns']);
					$fg_smartphone_l_columns 	= esc_html($settings['fg_smartphone_l_columns']);
					$fg_tablet_p_columns 		= esc_html($settings['fg_tablet_p_columns']);
					$fg_tablet_l_columns 		= esc_html($settings['fg_tablet_l_columns']);
					$fg_desktop_medium_columns 	= esc_html($settings['fg_desktop_medium_columns']);
					$fg_desktop_small_columns 	= esc_html($settings['fg_desktop_small_columns']);
					                           
					$fg_animate 				= esc_html($settings['fg_animate']);
					$fg_animate_effect 			= esc_html($settings['fg_animate_effect']);
					$fg_delay 					= esc_html($settings['fg_delay']);
					
					
			/* CHECK CUSTOM RESPONSIVE */
			if($responsive_type == 'fg_responsive') {
				if($active_custom_responsive == 'fg_responsive') {
					$responsive_type = 'fg_responsive';
				} else {
					$responsive_type = 'fg_smartphone_p_col-'.$fg_smartphone_p_columns.' fg_smartphone_l_col-'.$fg_smartphone_l_columns.' fg_tablet_p_col-'.$fg_tablet_p_columns.' fg_tablet_l_col-'.$fg_tablet_l_columns.' fg_desktop_medium_col-'.$fg_desktop_medium_columns.' fg_desktop_small_col-'.$fg_desktop_small_columns.'';				
				}	
			}

			// ANIMATION
			if($fg_animate == 'on') {
				$animation_info = " animate-in' data-anim-type='".$fg_animate_effect."' data-anim-delay='".$fg_delay."";			
			} else {
				$animation_info = "";					
			}
			// #ANIMATION




			
			// LOAD ALL STYLE AND CSS		
			ewmp_fastmediagallery_elementor_enqueue_css_and_javascript($type,$layout,$responsive_type,$lazyload,$active_custom_responsive,$fg_animate);			
			
			// START MEDIA GALLERY OUTPUT
			
			$selector = "gallery-{$instance}";
			
			$output = ewmp_fastmediagallery_elementor_style($selector,$main_color,$main_color_opacity,$secondary_color,$spacing_active,
					  $spacing,$name_show,$gallery_name_font_size,$gallery_name_font_color,
					  $gallery_name_text_align,$pagination_active,$pagination_style,$image_width);			
			
			/*************************************************** 
			#### GALLERY NAME SHOW OPTION ######################
			#### Since: version 1.0 ############################
			***************************************************/			
						
			$gallery_name = '';
						
			if($name_show == 'true') {
				$gallery_name = '<h2 class="fg_gallery_title-'.$selector.' fg_gallery_name">'.$name.'</h2>';	
			}			

			/*************************************************** 
			#### LIGHT GALLERY OPTION ##########################
			#### Since: version 1.0 ############################
			***************************************************/			

			$output .= '<script type="text/javascript">
						jQuery(function($){
							$(\'#'.$selector.'.fastgallery\').lightGallery({
								selector: \'.fmg-lightbox\',
								speed: '.$lg_speed.',
								thumbnail: '.$lg_thumbnail.',
								controls: '.$lg_controls.',
								youtubePlayerParams: {
									modestbranding: '.$lg_yt_modestbranding.',
									showinfo: '.$lg_yt_showinfo.',
									rel: '.$lg_yt_rel.',
									controls: '.$lg_yt_controls.'
								},
								vimeoPlayerParams: {
									byline : '.$lg_vi_byline.',
									portrait : '.$lg_vi_portrait.',
									title: '.$lg_vi_title.',
									badge: '.$lg_vi_badge.',     
								}																																
							});
						});		
					</script>';	
										
			$lazyload_class = '';
			
			$output_local = '';

				// LAZY LOAD GRID
				$lazyload_class = 'fg_lazyload_off';
				if($lazyload == 'on' && $layout == 'fmg-normal') {
					
					$output .= '<script type="text/javascript">
						jQuery(function($){
							$(\'#'.$selector.' .fg-gallery-item img.fg_lazy\').lazyload(';
							if($lazyload_effect == 'yes') {	
									 	
								$output .= '{
												effect: "fadeIn",
												effectspeed: 2000
											}';
							
							}							
					$output .= ');
						});		
					</script>';				
					$lazyload_class = 'fg_lazyload';
													
				}


				if($layout == 'fmg-masonry') {
					
					$image_thumb_size = $thumbs_masonry;
					if($lazyload == 'off') { // MASONRY WHEN LAZY LOAD IS OFF
											
						$output .= '<script type="text/javascript">
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
					
						$output .= '<script type="text/javascript">
							jQuery(document).ready(function($){
						$("#'.$selector.' .fg-gallery-item img.fg_lazy").lazyload(';
							if($lazyload_effect == 'yes') {	
										
								$output .= '{
													effect: \'fadeIn\',
													effectspeed: 2000
													}';
							
							}
							
							$output .= ');

						$(\'#'.$selector.' .fg-gallery-item img.fg_lazy\').load(function() {
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
						$lazyload_class = 'fg_lazyload';
						
					} #LAZY LOAD IS ON
				}		
							
			// OUTPUT
			$output .= "".$gallery_name."<div id='$selector' class='gallery galleryid-{$instance} gallery-columns-{$columns} fastgallery fpg brick-masonry ".$responsive_type." ".$layout." ".$style." ".$lazyload_class." ".$over_image." ".$animation_info."'>";
			
	
			
			// LOAD ELEMENT
			$elements = $settings['elements'];

			// PAGINATION ### Change array for pagination ###
			if($pagination_active == 'on') {
				
					$pagination = get_query_var('fmg_page');		
					
					if(!isset($pagination) || empty($pagination)) { $pagination = 1; }
					
					$images_array = array_chunk($elements,$pagination_number);
													
					$pag = $pagination - 1;
					
					$settings['elements'] = $images_array[$pag];				

					$num_page_for_pagination = count($images_array); // VALUE FOR PAGINATION FUNCTION

			}
			// #PAGINATION


			
			$counter = 1;

			foreach ( $settings['elements'] as $element ) {
					
					
					$element_type = $element['element_type'];		
					
					$element_caption_active = $element['element_caption_active'];
					$element_caption = '';
					
					if($element_caption_active == 'on') {
						$element_caption = $element['element_caption'];
					}
					
					// CHECK CAPTION
					$caption_check = '';
					if($caption == 'off' || empty($element_caption)) {
							$caption_check = 'no-caption';
					}
					// END CHECK CAPTION		
										
					if($element_type == 'image') { /* ELEMENT TYPE: IMAGE */
						
						$image_lightbox = wp_get_attachment_image_src($element['element_type_image']['id'],$image_lightbox_size);
						$url_lightbox = $image_lightbox[0];
						
						$image_thumb = wp_get_attachment_image_src($element['element_type_image']['id'],$image_thumb_size);
						$url_thumb = $image_thumb[0];	
											
							if($lazyload == 'on') {
								$img_src = '<img class="fg_lazy" data-original="'.$url_thumb.'" width="'.$image_thumb[1].'" height="'.$image_thumb[2].'">';
							} else {
								$img_src = '<img src="'.$url_thumb.'">';
							}
							
							$output .= '<div class="fg-gallery-item"><div class="fastgallery-gallery-icon '.$caption_check.'">
											<div class="fg_zoom">'.$img_src.'
												<a href="'.$url_lightbox.'" class="fmg-lightbox" data-sub-html="'.$element_caption.'">
													<span class="fg-zoom-icon icon-image"></span>
													<img src="'.$url_thumb.'" style="display:none">
												</a>
											</div>';
											
											if ($caption == 'on' && !empty($element_caption)) {
											
											$output .= '<div class="fg-wp-caption-text fg-gallery-caption">
												<div class="caption-container">
													'.$element_caption.'
												</div>
											</div>';
							
											}
							
							$output .= '</div></div>';	
			
					} elseif($element_type == 'video') { /* ELEMENT TYPE: VIDEO */
					
						wp_enqueue_script( 'lightgallery-vimeo');
						
						$element_type_image_poster = $element['element_poster_image_type'];
						
						if($element_type_image_poster == 'custom') {
						
							$poster = wp_get_attachment_image_src($element['element_image_poster']['id'],$image_lightbox_size);
						
							$poster_url = $poster[0];
						
							$poster_thumb = wp_get_attachment_image_src($element['element_image_poster']['id'],$image_thumb_size);
							
							$poster_url_thumb = $poster_thumb[0];
						
						} else {
							
							$poster_url = $poster_url_thumb = plugins_url( 'fastmediagalleryelementor/assets/img/video_poster.jpg');
						
						}
						
						$url_type = $element['element_url_video_type'];
						
						if($lazyload == 'on') {
							$img_src = '<img class="fg_lazy" data-original="'.$poster_url_thumb.'" width="'.$poster_thumb[1].'" height="'.$poster_thumb[2].'">';
						} else {
							$img_src = '<img src="'.$poster_url_thumb.'">';
						}	
												
						if($url_type == 'local') { // LOCAL
							
							$url = $element['element_type_local_video'];
							
							$output_local .= '<div style="display:none;" id="fmg-video'.$counter.'">
								<video class="lg-video-object lg-html5" controls preload="none">
									<source src="'.$url.'" type="video/mp4">
									 Your browser does not support HTML5 video.
								</video>
							</div>';
							
							$output .= '<div class="fastgallery-gallery-icon '.$caption_check.' fg-gallery-item">
											<div class="fg_zoom">'.$img_src.'
												<a class="fmg-lightbox" data-sub-html="'.$element_caption.'" data-poster="'.$poster_url.'" data-html="#fmg-video'.$counter.'">
													<span class="fg-zoom-icon icon-youtube"></span>
													<img src="'.$poster_url_thumb.'" style="display:none">
												</a>
											</div>';
											
											if ($caption == 'on' && !empty($element_caption)) {
											
											$output .= '<div class="fg-wp-caption-text fg-gallery-caption">
												<div class="caption-container">
													'.$element_caption.'
												</div>
											</div>';
							
											}
							
							$output .= '</div>';							

						} else { /* #LOCAL */
							
							$url = $element['element_type_youtube_vimeo_video'];

							$output .= '<div class="fastgallery-gallery-icon '.$caption_check.' fg-gallery-item">
											<div class="fg_zoom">'.$img_src.'
												<a href="'.$url.'" class="fmg-lightbox" data-sub-html="'.$element_caption.'" data-poster="'.$poster_url.'">
													<span class="fg-zoom-icon icon-youtube"></span>
													<img src="'.$poster_url_thumb.'" style="display:none">
												</a>
											</div>';
											
											if ($caption == 'on' && !empty($element_caption)) {
											
											$output .= '<div class="fg-wp-caption-text fg-gallery-caption">
												<div class="caption-container">
													'.$element_caption.'
												</div>
											</div>';
							
											}
							
							$output .= '</div>';

						}
						
						
						
						
					} elseif($element_type == 'audio') { /* ELEMENT TYPE: AUDIO */

						
						$element_type_image_poster = $element['element_poster_image_type'];
						
						if($element_type_image_poster == 'custom') { // CUSTOM
						
							$poster = wp_get_attachment_image_src($element['element_image_poster']['id'],$image_lightbox_size);
						
							$poster_url = $poster[0];
						
							$poster_thumb = wp_get_attachment_image_src($element['element_image_poster']['id'],$image_thumb_size);
							
							$poster_url_thumb = $poster_thumb[0];
						
						} else { // #CUSTOM
							
							$poster_url = $poster_url_thumb = plugins_url( 'fastmediagalleryelementor/assets/img/audio_poster.jpg');
						
						} // #DEFAULT
						
						if($lazyload == 'on') {
							$img_src = '<img class="fg_lazy" data-original="'.$poster_url_thumb.'" width="'.$poster_thumb[1].'" height="'.$poster_thumb[2].'">';
						} else {
							$img_src = '<img src="'.$poster_url_thumb.'">';
						}
												
						$url_type = $element['element_url_audio_type'];
						
						if($url_type == 'local') { // LOCAL
							
							$url = $element['element_type_local_audio'];
							
							$output_local .= '<div style="display:none;" id="fmg-audio'.$counter.'">
								<audio class="lg-video-object lg-html5" controls preload="none">
									<source src="'.$url.'" type="audio/mp3">
									 Your browser does not support HTML5 video.
								</audio>
							</div>';
							
							$output .= '<div class="fastgallery-gallery-icon '.$caption_check.' fg-gallery-item">
											<div class="fg_zoom">'.$img_src.'
												<a class="fmg-lightbox" data-sub-html="'.$element_caption.'" data-poster="'.$poster_url.'" data-html="#fmg-audio'.$counter.'">
													<span class="fg-zoom-icon icon-headphones"></span>
													<img src="'.$poster_url_thumb.'" style="display:none">
												</a> 
											</div>';
											
											if ($caption == 'on' && !empty($element_caption)) {
											
											$output .= '<div class="fg-wp-caption-text fg-gallery-caption">
												<div class="caption-container">
													'.$element_caption.'
												</div>
											</div>';
							
											}
							
							$output .= '</div>';														
								
						} else { /* #LOCAL */
							
							$url = $element['element_type_soundcloud_audio'];

							$output .= '<div class="fastgallery-gallery-icon '.$caption_check.' fg-gallery-item">
											<div class="fg_zoom">'.$img_src.'
												<a class="fmg-lightbox" data-sub-html="'.$element_caption.'" data-src="https://w.soundcloud.com/player/?url='.$url.'" data-iframe="true">
													<span class="fg-zoom-icon icon-headphones"></span>
													<img src="'.$poster_url_thumb.'" style="display:none">
												</a> 
											</div>';
											
											if ($caption == 'on' && !empty($element_caption)) {
											
											$output .= '<div class="fg-wp-caption-text fg-gallery-caption">
												<div class="caption-container">
													'.$element_caption.'
												</div>
											</div>';
							
											}
							
							$output .= '</div>';							
							
						} /* #SOUNDCLOUD */
						
									
					} elseif($element_type == 'iframe') { /* ELEMENT TYPE: IFRAME */

						$url = $element['element_type_iframe'];
						$element_type_image_poster = $element['element_poster_image_type'];
						
						if($element_type_image_poster == 'custom') {

							$poster_thumb = wp_get_attachment_image_src($element['element_image_poster']['id'],$image_thumb_size);
							
							$poster_url_thumb = $poster_thumb[0];
						
						} else {
							
							$poster_url_thumb = plugins_url( 'fastmediagalleryelementor/assets/img/iframe_poster.jpg');
						
						}
						
						if($lazyload == 'on') {
							$img_src = '<img class="fg_lazy" data-original="'.$poster_url_thumb.'" width="'.$poster_thumb[1].'" height="'.$poster_thumb[2].'">';
						} else {
							$img_src = '<img src="'.$poster_url_thumb.'">';
						}
						
							$output .= '<div class="fastgallery-gallery-icon '.$caption_check.' fg-gallery-item">
											<div class="fg_zoom">'.$img_src.'
												<a class="fmg-lightbox" data-sub-html="'.$element_caption.'" data-src="'.$url.'" data-iframe="true">
													<span class="fg-zoom-icon icon-file"></span>
													<img src="'.$poster_url_thumb.'" style="display:none">
												</a> 
											</div>';
											
											if ($caption == 'on' && !empty($element_caption)) {
											
											$output .= '<div class="fg-wp-caption-text fg-gallery-caption">
												<div class="caption-container">
													'.$element_caption.'
												</div>
											</div>';
							
											}
							
							$output .= '</div>';				
					
					} else { /* ELEMENT TYPE: IMAGE WITH CUSTOM URL */

							$image_thumb = wp_get_attachment_image_src($element['element_type_image_custom_url']['id'],$image_thumb_size);
							$url_thumb = $image_thumb[0];
						
							$custom_url = $element['element_custom_url'];
							$custom_url_target = $element['element_custom_url_target'];					

							if($lazyload == 'on') {
								$img_src = '<img class="fg_lazy" data-original="'.$url_thumb.'" width="'.$image_thumb[1].'" height="'.$image_thumb[2].'">';
							} else {
								$img_src = '<img src="'.$url_thumb.'">';
							}

							$output .= '<div class="fastgallery-gallery-icon '.$caption_check.' fg-gallery-item">
											<div class="fg_zoom">'.$img_src.'
												<a href="'.$custom_url.'" target="'.$custom_url_target.'">
													<span class="fg-zoom-icon icon-image"></span>
													<img src="'.$url_thumb.'" style="display:none">
												</a>
											</div>';
											
											if ($caption == 'on' && !empty($element_caption)) {
											
											$output .= '<div class="fg-wp-caption-text fg-gallery-caption">
												<div class="caption-container">
													'.$element_caption.'
												</div>
											</div>';
							
											}
							
							$output .= '</div>';						
						
					}
					

					
			
			$counter++;
			} // END FOREACH
			
			$output .= "</div>";

			if($pagination_active == 'on') {
				
				$output .= '<div id="'.$selector.'" class="fastgallery '.$pagination_style.'">'.ewmp_elementor_pagination($num_page_for_pagination,$pagination).'</div>';
				
			}
			
			$output = $output_local . $output;					
				
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
