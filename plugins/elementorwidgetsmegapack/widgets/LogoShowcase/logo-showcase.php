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
 * Elementor Logo Showcase
 *
 * Elementor widget for Logo Showcase
 *
 * @since 1.0.0
 */
class Logo_Showcase extends Widget_Base {

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
		return 'logo-showcase';
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
		return esc_html__( 'Logo Showcase', 'elementorwidgetsmegapack' );
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
		return 'eicon-media-carousel';
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
			'section_elements',
			[
				'label' => esc_html__( 'Logo Images', 'elementorwidgetsmegapack' ), // Section display name
			]
		);		
		
		$this->add_control(
			'elements',
			[
				'label' => esc_html__( 'Add Element', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => [
					[
						'name' => 'image_user',
						'label' => esc_html__( 'Logo Image', 'elementorwidgetsmegapack' ),
						'type' => \Elementor\Controls_Manager::MEDIA,
						'label_block' => true						
					],					
					[
						'name' => 'logo_size',
						'label' => esc_html__( 'Size', 'elementorwidgetsmegapack' ),
						'type' => Controls_Manager::SELECT,
						'default' => 'full',
						'options' => [
							'full'		=> 'Original Size',
							'thumbnail' => 'Thumbnail',					
							'medium' 	=> 'Medium',					
							'large' 	=> 'large'				
						]
					],					
					[
						'name' => 'link',
						'label' => esc_html__( 'Link', 'elementorwidgetsmegapack' ),
						'type' => Controls_Manager::SELECT,
						'default' => 'off',
						'options' => [
							'on'	=> 'On',
							'off' 	=> 'Off'				
						]
					],					
					[
						'name' => 'link_url',
						'label' => esc_html__( 'Url', 'elementorwidgetsmegapack' ),
						'type' => Controls_Manager::TEXT,
						'condition'	=> [
							'link'	=> 'on'
						]	
					],
					[
						'name' => 'link_target',
						'label' => esc_html__( 'Link Target', 'elementorwidgetsmegapack' ),
						'type' => Controls_Manager::SELECT,
						'default' => '_blank',
						'options' => [
							'_blank'	=> esc_html__('Blank (New Window)','elementorwidgetsmegapack'),
							'_self' 	=> esc_html__('Self (Same Window)','elementorwidgetsmegapack') 				
						],
						'condition'	=> [
							'link'	=> 'on'
						]	
					],					
					[
						'name' => 'addon_animate',
						'label' => esc_html__( 'Animate', 'elementorwidgetsmegapack' ),
						'type' => Controls_Manager::SELECT,
						'default' => 'off',
						'options' => [
							'off'	=> 'Off',
							'on' 	=> 'On'					
						]
					],					
					[
						'name' => 'effect',
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
					],
					[
						'name' => 'delay',
						'label' => esc_html__( 'Animate Delay (ms)', 'elementorwidgetsmegapack' ),
						'type' => Controls_Manager::TEXT,
						'default' => '1000',
						'condition'	=> [
							'addon_animate'	=> 'on'
						]
					]
				],
				'title_field' => '',
			]
		);		
		
		$this->end_controls_section();

  		$this->start_controls_section(
  			'section_settings',
  			[
  				'label' => esc_html__( 'Settings', 'elementorwidgetsmegapack' )
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
				'label' => esc_html__( 'Item Show for content between 600px to 900px', 'elementorwidgetsmegapack' ),
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
				'label' => esc_html__( 'Item Show for content between 0px to 599px', 'elementorwidgetsmegapack' ),
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
				'label' => esc_html__( 'Loop', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => [
					'true' 		=> esc_html__( 'On', 'elementorwidgetsmegapack' ),
					'false' 	=> esc_html__( 'Off', 'elementorwidgetsmegapack' )
				]
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label' => esc_html__( 'Autoplay (ms) - ex 2000 or leave empty for default', 'elementorwidgetsmegapack' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => '2000'
			]
		);

		$this->add_control(
			'smart_speed',
			[
				'label' => esc_html__( 'Speed (ms) - ex 2000 or leave empty for default', 'elementorwidgetsmegapack' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => '2000'
			]
		);
		
		$this->add_control(
			'margin',
			[
				'label' => esc_html__( 'Margin between Items - empty to disable. Or for example: 10', 'elementorwidgetsmegapack' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => ''
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
				]
			]
		);
		
		$this->add_control(
			'pagination',
			[
				'label' => esc_html__( 'Pagination', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => [
					'true' 		=> esc_html__( 'Show', 'elementorwidgetsmegapack' ),
					'false' 	=> esc_html__( 'Hidden', 'elementorwidgetsmegapack' )
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
			'custom_style',
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
			'nav_color',
			[
				'label' => esc_html__( 'Navigation/Pagination Carousel Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#333333',
				'condition'	=> [
					'custom_style'	=> 'on'
				]				
			]
		);

		$this->add_control(
			'nav_h_color',
			[
				'label' => esc_html__( 'Navigation/Pagination Carousel Hover Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#333333',
				'condition'	=> [
					'custom_style'	=> 'on'
				]				
			]
		);
		
		$this->add_control(
			'nav_bg_color',
			[
				'label' => esc_html__( 'Navigation Carousel Background Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
				'condition'	=> [
					'custom_style'	=> 'on'
				]				
			]
		);		

		$this->add_control(
			'nav_bg_h_color',
			[
				'label' => esc_html__( 'Navigation Carousel Background Hover Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
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

		$item_show				= esc_html($settings['item_show']);
		$item_show_900			= esc_html($settings['item_show_900']);
		$item_show_600			= esc_html($settings['item_show_600']);
		$loop					= esc_html($settings['loop']);
		$autoplay				= esc_html($settings['autoplay']);
		$smart_speed			= esc_html($settings['smart_speed']);
		$navigation				= esc_html($settings['navigation']);
		$pagination				= esc_html($settings['pagination']);
		$margin					= esc_html($settings['margin']);
		$rtl					= esc_html($settings['rtl']);
		$custom_style 			= esc_html($settings['custom_style']);
		$nav_color				= esc_html($settings['nav_color']);
		$nav_h_color			= esc_html($settings['nav_h_color']);
		$nav_bg_color			= esc_html($settings['nav_bg_color']);
		$nav_bg_h_color			= esc_html($settings['nav_bg_h_color']);

		wp_enqueue_script( 'logoshowcase' );
		wp_enqueue_style( 'fonts-vc' );
		wp_enqueue_style( 'owlcarousel' );
		wp_enqueue_style( 'owltheme' );
		wp_enqueue_style( 'animations' );				
		wp_enqueue_script( 'owlcarousel' );			
		wp_enqueue_script( 'appear' );			
		wp_enqueue_script( 'animate' );
		wp_enqueue_style( 'elementor-icons' );
		wp_enqueue_style( 'font-awesome' );
			
		if($custom_style == 'on') :
		
			$css_style_to_append = "<style>
			.logo-showcase-elementor-logo-owl-carousel.logo-showcase-elementor-logo-carousel-".esc_html($instance).".owl-theme .owl-controls .owl-nav [class*=owl-]:hover { color:".esc_html($nav_h_color)."; background:".esc_html($nav_bg_h_color).";}
			.logo-showcase-elementor-logo-owl-carousel.logo-showcase-elementor-logo-carousel-".esc_html($instance).".owl-theme .owl-controls .owl-nav [class*=owl-] { color:".esc_html($nav_color)."; background:".esc_html($nav_bg_color).";}
			.logo-showcase-elementor-logo-owl-carousel.logo-showcase-elementor-logo-carousel-".esc_html($instance).".owl-theme .owl-dots .owl-dot span { background:".esc_html($nav_bg_color).";}
			</style>";
			$data_value = 'data-logo-showcase-elementor-custom-css="'.$css_style_to_append.'"';
			$js_class = 'logo-showcase-elementor-custom-js';
		
		else :

			$js_class = $data_value = '';

		endif;
		
			$output = '<div '.$data_value.'
							data-logo-showcase-elementor-logo-owl-items="'.esc_html($item_show).'" 
							data-logo-showcase-elementor-logo-owl-items-900="'.esc_html($item_show_900).'" 
							data-logo-showcase-elementor-logo-owl-items-600="'.esc_html($item_show_600).'" 
							data-logo-showcase-elementor-logo-owl-loop="'.esc_html($loop).'" 
							data-logo-showcase-elementor-logo-owl-autoplay="'.esc_html($autoplay).'" 
							data-logo-showcase-elementor-logo-owl-smart-speed="'.esc_html($smart_speed).'" 
							data-logo-showcase-elementor-logo-owl-navigation="'.esc_html($navigation).'" 
							data-logo-showcase-elementor-logo-owl-pagination="'.esc_html($pagination).'" 
							data-logo-showcase-elementor-logo-owl-margin="'.esc_html($margin).'" 
							data-logo-showcase-elementor-logo-owl-rtl="'.esc_html($rtl).'"
							class="logo-showcase-elementor logo-showcase-elementor-logo-owl-carousel logo-showcase-elementor-logo-carousel logo-showcase-elementor-logo-carousel-col-'.esc_html($item_show).' logo-showcase-elementor-logo-carousel-pagination-'.esc_html($pagination).' logo-showcase-elementor-logo-carousel-'.esc_html($instance).' '.esc_html($js_class).'">';
							
							
			foreach ( $settings['elements'] as $element ) {				
				$logo_image_array = wp_get_attachment_image_src( $element['image_user']['id'], $element['logo_size'] );
				$output .= '<div class="logo-showcase-elementor-logo-carousel logo-showcase-elementor-item-'.esc_html($instance).ewmp_animate_class($element['addon_animate'],$element['effect'],$element['delay']).'>';
				$output .= '<div class="logo-showcase-elementor-logo-carousel-container">';
				if($element['link'] == 'on') : 
					$output .= '<a href="'.esc_url($element['link_url']).'" target="'.esc_html($element['link_target']).'"><img src="'.esc_url($logo_image_array[0]).'"></a>';
				else :			
					$output .= '<img src="'.esc_url($logo_image_array[0]).'">';
				endif;
				$output .= '</div></div>';			
			}
						
			$output .= '</div>';
			
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
