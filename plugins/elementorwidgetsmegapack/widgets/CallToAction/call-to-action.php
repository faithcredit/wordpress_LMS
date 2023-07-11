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
 * Elementor Calltoaction
 *
 * Elementor widget for team vision
 *
 * @since 1.0.0
 */
class Calltoaction extends Widget_Base {

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
		return 'calltoaction';
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
		return esc_html__( 'Call to Action', 'elementorwidgetsmegapack' );
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
		return 'eicon-call-to-action';
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
			'button_type',
			[
				'label' => esc_html__( 'Call to Action Type', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'flat-button-mini',
				'options' => [
					'flat-button-mini'		=> esc_html__( 'Flat Mini', 'elementorwidgetsmegapack' ),
					'flat-button-small'		=> esc_html__( 'Flat Small', 'elementorwidgetsmegapack' ),
					'flat-button-medium'	=> esc_html__( 'Flat Medium', 'elementorwidgetsmegapack' ),
					'flat-button-large'		=> esc_html__( 'Flat Large', 'elementorwidgetsmegapack' ),
					'bg-none-button-mini'	=> esc_html__( 'Backgraund Transparent Mini', 'elementorwidgetsmegapack' ),
					'bg-none-button-small'	=> esc_html__( 'Backgraund Transparent Small', 'elementorwidgetsmegapack' ),
					'bg-none-button-medium'	=> esc_html__( 'Backgraund Transparent Medium', 'elementorwidgetsmegapack' ),
					'bg-none-button-large'	=> esc_html__( 'Backgraund Transparent Large', 'elementorwidgetsmegapack' ),
					'd-button-mini'			=> esc_html__( '3D Mini', 'elementorwidgetsmegapack' ),
					'd-button-small'		=> esc_html__( '3D Small', 'elementorwidgetsmegapack' ),
					'd-button-medium'		=> esc_html__( '3D Medium', 'elementorwidgetsmegapack' ),
					'd-button-large'		=> esc_html__( '3D Large', 'elementorwidgetsmegapack' ),
					'button-custom'			=> esc_html__( 'Custom', 'elementorwidgetsmegapack' )				
				]
			]
		);		

		$this->add_control(
			'button_text',
			[
				'label' => esc_html__( 'Text', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'Call to Action Text'
			]
		);

		$this->add_control(
			'button_url',
			[
				'label' => esc_html__( 'Url Button (ex http://www.google.com)', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true
			]
		);

		$this->add_control(
			'button_target_url',
			[
				'label' => esc_html__( 'Target Button', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => '_self',
				'options' => [
					'_self'		=> esc_html__( 'Self (Same Window)', 'elementorwidgetsmegapack' ),
					'_blank'	=> esc_html__( 'Blank (New Window)', 'elementorwidgetsmegapack' )				]
			]
		);	

		$this->add_control(
			'button_icon_show',
			[
				'label' => esc_html__( 'Icon Show', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'calltoaction-icon-hidden',
				'options' => [
					'calltoaction-icon-hidden'	=> esc_html__( 'Hidden', 'elementorwidgetsmegapack' ),
					'calltoaction-icon-show'	=> esc_html__( 'Show', 'elementorwidgetsmegapack' )				]
			]
		);	

		$this->add_control(
			'button_icon',
			[
				'label' => esc_html__( 'Icon', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
						'value' => 'fas fa-star',
						'library' => 'solid',
				],
				'condition'	=> [
					'button_icon_show'	=> 'calltoaction-icon-show'
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
			'button_font_type',
			[
				'label' => esc_html__( 'Font Type', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'calltoaction-font-default',
				'options' => [
					'calltoaction-font-default'	=> esc_html__( 'Default Site', 'elementorwidgetsmegapack' ),
					'calltoaction-google-font' 	=> esc_html__( 'Google Fonts Custom', 'elementorwidgetsmegapack' )				
				]
			]
		);

		$this->add_control(
			'google_fonts',
			[
				'label' => esc_html__( 'Google Font Family', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::FONT,
				'default' => "'Open Sans', sans-serif",
				'condition'	=> [
					'button_font_type'	=> 'calltoaction-google-font'
				]
			]
		);

		$this->add_control(
			'button_size',
			[
				'label' => esc_html__( 'Text Size (px)', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::TEXT,
				'default' => '30px'
			]
		);

		$this->add_control(
			'button_align',
			[
				'label' => esc_html__( 'Text Align', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'calltoaction-align-center',
				'options' => [
					'calltoaction-align-center'	=> esc_html__( 'Center', 'elementorwidgetsmegapack' ),
					'calltoaction-align-left' 		=> esc_html__( 'Left', 'elementorwidgetsmegapack' ),				
					'calltoaction-align-right' 	=> esc_html__( 'Right', 'elementorwidgetsmegapack' )				
				]
			]
		);

		$this->add_control(
			'button_custom_padding',
			[
				'label' => esc_html__( 'Padding (px)', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::TEXT,
				'default' => '15px',
				'condition'	=> [
					'button_type'	=> 'button-custom'
				]
			]
		);

		$this->add_control(
			'button_custom_margin',
			[
				'label' => esc_html__( 'Margin (px)', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::TEXT,
				'default' => '15px',
				'condition'	=> [
					'button_type'	=> 'button-custom'
				]
			]
		);

		$this->add_control(
			'button_custom_border_radius',
			[
				'label' => esc_html__( 'Border Radius (px)', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::TEXT,
				'default' => '15px',
				'condition'	=> [
					'button_type'	=> 'button-custom'
				]
			]
		);

		$this->add_control(
			'button_display',
			[
				'label' => esc_html__( 'Display', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'block',
				'options' => [
					'block'			=> esc_html__( 'Block', 'elementorwidgetsmegapack' ),
					'inline-block' 	=> esc_html__( 'Inline', 'elementorwidgetsmegapack' )				
				]
			]
		);

		$this->add_control(
			'button_position',
			[
				'label' => esc_html__( 'Position', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'relative',
				'options' => [
					'relative'	=> esc_html__( 'Relative', 'elementorwidgetsmegapack' ),
					'fixed' 	=> esc_html__( 'Fixed', 'elementorwidgetsmegapack' )				
				]
			]
		);

		$this->add_control(
			'button_position_bt',
			[
				'label' => esc_html__( 'Position', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'bottom',
				'options' => [
					'bottom'	=> esc_html__( 'Bottom', 'elementorwidgetsmegapack' ),
					'top' 		=> esc_html__( 'Top', 'elementorwidgetsmegapack' )				
				],
				'condition'	=> [
					'button_position'	=> 'fixed'
				]
			]
		);

		$this->add_control(
			'button_fixed_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FC615D',
				'condition'	=> [
					'button_position'	=> 'fixed'
				]
			]
		);

		$this->add_control(
			'button_border_type',
			[
				'label' => esc_html__( 'Border Type', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'calltoaction-border-square',
				'options' => [
					'calltoaction-border-square'	=> esc_html__( 'Square', 'elementorwidgetsmegapack' ),
					'calltoaction-border-round' 	=> esc_html__( 'Round', 'elementorwidgetsmegapack' )				
				],
				'condition'	=> [
					'button_type'	=> array(
											'bg-none-button-mini', 
											'bg-none-button-small',
											'bg-none-button-medium',
											'bg-none-button-large',
											'flat-button-mini', 
											'flat-button-small',
											'flat-button-medium',
											'flat-button-large',							
											'd-button-mini', 
											'd-button-small',
											'd-button-medium',
											'd-button-large'																													
										)
				]
			]
		);


		$this->add_control(
			'button_border_style',
			[
				'label' => esc_html__( 'Border Style', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'solid',
				'options' => [
					'solid'		=> esc_html__( 'Solid', 'elementorwidgetsmegapack' ),
					'dotted' 	=> esc_html__( 'Dotted', 'elementorwidgetsmegapack' ),				
					'dashed' 	=> esc_html__( 'Dashed', 'elementorwidgetsmegapack' ),				
					'double' 	=> esc_html__( 'Double', 'elementorwidgetsmegapack' ),				
					'inset' 	=> esc_html__( 'Inset', 'elementorwidgetsmegapack' ),				
					'outset' 	=> esc_html__( 'Outset', 'elementorwidgetsmegapack' )				
				],
				'condition'	=> [
					'button_type'	=> array(
											'bg-none-button-mini', 
											'bg-none-button-small',
											'bg-none-button-medium',
											'bg-none-button-large'																			
										)
				]
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label' => esc_html__( 'Text Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF'
			]
		);

		$this->add_control(
			'button_over_color',
			[
				'label' => esc_html__( 'Over Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FC615D',
				'condition'	=> [
					'button_type'	=> array(
											'bg-none-button-mini', 
											'bg-none-button-small',
											'bg-none-button-medium',
											'bg-none-button-large'																			
										)
				]
			]
		);

		$this->add_control(
			'button_background_color',
			[
				'label' => esc_html__( 'Background Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FC615D',
				'condition'	=> [
					'button_type'	=> array( 
											'flat-button-mini', 
											'flat-button-small',
											'flat-button-medium',
											'flat-button-large',							
											'd-button-mini', 
											'd-button-small',
											'd-button-medium',
											'd-button-large',
											'button-custom',
										)
				]
			]
		);


		$this->add_control(
			'button_border_color',
			[
				'label' => esc_html__( 'Border Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FC615D',
				'condition'	=> [
					'button_type'	=> array(
											'bg-none-button-mini', 
											'bg-none-button-small',
											'bg-none-button-medium',
											'bg-none-button-large'																			
										)
				]
			]
		);


		$this->add_control(
			'button_custom_border_active',
			[
				'label' => esc_html__( 'Border Show', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'on',
				'options' => [
					'on'			=> esc_html__( 'On', 'elementorwidgetsmegapack' ),
					'off' 	=> esc_html__( 'Off', 'elementorwidgetsmegapack' )				
				],
				'condition'	=> [
					'button_type'	=> 'button-custom'
				]
			]
		);

		$this->add_control(
			'button_custom_border_width',
			[
				'label' => esc_html__( 'Border Width (px)', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::TEXT,
				'default' => '1px',
				'condition'	=> [
					'button_type'	=> 'button-custom'
				]
			]
		);

		$this->add_control(
			'button_custom_border_color',
			[
				'label' => esc_html__( 'Border Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FC615D',
				'condition'	=> [
					'button_type'	=> 'button-custom'
				]
			]
		);

		$this->add_control(
			'button_custom_border_style',
			[
				'label' => esc_html__( 'Border Style', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'solid',
				'options' => [
					'solid'		=> esc_html__( 'Solid', 'elementorwidgetsmegapack' ),
					'dotted' 	=> esc_html__( 'Dotted', 'elementorwidgetsmegapack' ),				
					'dashed' 	=> esc_html__( 'Dashed', 'elementorwidgetsmegapack' ),				
					'double' 	=> esc_html__( 'Double', 'elementorwidgetsmegapack' ),				
					'inset' 	=> esc_html__( 'Inset', 'elementorwidgetsmegapack' ),				
					'outset' 	=> esc_html__( 'Outset', 'elementorwidgetsmegapack' )				
				],
				'condition'	=> [
					'button_type'	=> 'button-custom'
				]
			]
		);
		
		$this->add_control(
			'button_custom_text_over_color',
			[
				'label' => esc_html__( 'Text Over Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
				'condition'	=> [
					'button_type'	=> 'button-custom'
				]
			]
		);		
		
		$this->add_control(
			'button_custom_background_over_color',
			[
				'label' => esc_html__( 'Background Over Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FC615D',
				'condition'	=> [
					'button_type'	=> 'button-custom'
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
		
		$button_type 							= esc_html($settings['button_type']);	
		$button_text 							= esc_html($settings['button_text']);	
		$button_url 							= esc_html($settings['button_url']);
		$button_target_url 						= esc_html($settings['button_target_url']);
		$button_align 							= esc_html($settings['button_align']);
		$button_custom_padding 					= esc_html($settings['button_custom_padding']);
		$button_custom_margin 					= esc_html($settings['button_custom_margin']);
		$button_custom_border_radius 			= esc_html($settings['button_custom_border_radius']);
		$button_display 						= esc_html($settings['button_display']);
		$button_position 						= esc_html($settings['button_position']);
		$button_position_bt 					= esc_html($settings['button_position_bt']);
		$button_fixed_bg_color 					= esc_html($settings['button_fixed_bg_color']);
		$button_icon_show 						= esc_html($settings['button_icon_show']);
		$button_font_type 						= esc_html($settings['button_font_type']); 
		$google_fonts 							= esc_html($settings['google_fonts']);
		$button_size 							= esc_html($settings['button_size']);
		$button_text_color 						= esc_html($settings['button_text_color']);
		$button_over_color 						= esc_html($settings['button_over_color']);
		$button_background_color 				= esc_html($settings['button_background_color']);
		$button_border_color 					= esc_html($settings['button_border_color']);
		$button_border_type 					= esc_html($settings['button_border_type']);
		$button_border_style 					= esc_html($settings['button_border_style']);
		$button_custom_border_active 			= esc_html($settings['button_custom_border_active']);
		$button_custom_border_color 			= esc_html($settings['button_custom_border_color']);
		$button_custom_border_width 			= esc_html($settings['button_custom_border_width']);
		$button_custom_border_style 			= esc_html($settings['button_custom_border_style']);
		$button_custom_text_over_color 			= esc_html($settings['button_custom_text_over_color']);
		$button_custom_background_over_color 	= esc_html($settings['button_custom_background_over_color']);
		$addon_animate							= esc_html($settings['addon_animate']);
		$effect									= esc_html($settings['effect']);
		$delay									= esc_html($settings['delay']);

		wp_enqueue_script( 'calltoaction' );
		wp_enqueue_style( 'animations' );
		wp_enqueue_script( 'appear' );			
		wp_enqueue_script( 'animate' );

		$css_container_inline = $css_a_inline = 'style="';
		$css_i_inline = '';
		$css_style_to_append = '';
		
		// Google Fonts
		if($button_font_type == 'calltoaction-google-font') :
		
			$css_a_inline .= 'font-family: ' . $google_fonts . ';';   

		endif;
		
		$css_container_inline .= 'display:'.esc_html($button_display).';';
		$css_i_inline .= 'font-size:'.esc_html($button_size).';';				
		$css_a_inline .= 'font-size:'.esc_html($button_size).';';

		
		if(	$button_type == 'flat-button-mini' || 
			$button_type == 'flat-button-small' || 
			$button_type == 'flat-button-medium' || 
			$button_type == 'flat-button-large') :

			$css_a_inline .= 'color:'.esc_html($button_text_color).';
							  background:'.esc_html($button_background_color).';
							  border-color:'.esc_html($button_background_color).';
							  border-style:'.esc_html($button_border_style).';';


							  
			$css_style_to_append = '<style>
			.calltoaction-button.'.esc_html($button_type).'.calltoaction-button-'.esc_html($instance).' a:hover {
							color:'.esc_html($button_background_color).'!important;
							background:'.esc_html($button_text_color).'!important;
							border-color:'.esc_html($button_text_color).'!important; 
			}
			</style>';
		endif;

		if(	$button_type == 'bg-none-button-mini' || 
			$button_type == 'bg-none-button-small' || 
			$button_type == 'bg-none-button-medium' || 
			$button_type == 'bg-none-button-large') :

			$css_a_inline .= 'color:'.esc_html($button_text_color).';
							border-color:'.esc_html($button_text_color).';
							border-style:'.esc_html($button_border_style).';';
			
			
			$css_style_to_append = '<style>
					.calltoaction-button.'.esc_html($button_type).'.calltoaction-button-'.esc_html($instance).' a:hover {
						color:'.esc_html($button_over_color).'!important;
						border-color:'.esc_html($button_over_color).'!important;					
					}
			</style>';

		endif;
		
		if(	$button_type == 'd-button-mini' || 
			$button_type == 'd-button-small' || 
			$button_type == 'd-button-medium' || 
			$button_type == 'd-button-large') :							
			
			if($button_type == 'd-button-mini') { $shadow_size = '4'; }
			if($button_type == 'd-button-small') { $shadow_size = '6'; }
			if($button_type == 'd-button-medium') { $shadow_size = '8'; }
			if($button_type == 'd-button-large') { $shadow_size = '10'; }
			
			
			$css_a_inline .= 'color:'.esc_html($button_text_color).';
							background:'.esc_html($button_background_color).';
							box-shadow: 0 '.esc_html($shadow_size).'px 0 '.esc_html($button_border_color).';';
							
			$css_style_to_append = '<style>				
						.calltoaction-button.'.esc_html($button_type).'.calltoaction-button-'.esc_html($instance).' a:hover {
							box-shadow: 0 2px 0 '.esc_html($button_border_color).'!important;					
						}
			</style>';
		endif;		
		
		if($button_type == 'button-custom') {
			$css_a_inline .= '
							color:'.esc_html($button_text_color).';
							background:'.esc_html($button_background_color).';
							padding:'.esc_html($button_custom_padding).';
							margin:'.esc_html($button_custom_margin).';
							border-radius:'.esc_html($button_custom_border_radius).';
						';
			$css_style_to_append = '<style>				
						.calltoaction-button.'.esc_html($button_type).'.calltoaction-button-'.esc_html($instance).' a:hover {
							color:'.esc_html($button_custom_text_over_color).'!important;
							background:'.esc_html($button_custom_background_over_color).'!important;
							border-color:'.esc_html($button_text_color).'!important;					
						}
			</style>';
			
			if($button_custom_border_active == 'on') {
				$css_a_inline .= '
							border-color:'.esc_html($button_custom_border_color).';	
							border-width:'.esc_html($button_custom_border_width).';
							border-style:'.esc_html($button_custom_border_style).';			
				';
			}
		}		
		
		$position_button = $position_button_bt = '';
		if($button_position == 'fixed') {
			$position_button = 'calltoaction-fixed';
			$position_button_bt = 'calltoaction-fixed-'.esc_html($button_position_bt).'';
			$css_container_inline .= 'background:'.esc_html($button_fixed_bg_color).';';
		}
		
		$css_i_inline .= '';
		$css_container_inline .= '"';
		$css_a_inline .= '"';
		
		
		
		
		$data_value = 'data-calltoaction-custom-css="'.$css_style_to_append.'"';
		
				
		$inline_block = '';
		if($button_display == 'inline-block') {
			$inline_block .= 'calltoaction-inline-block';
		}		

		
		
		
		echo '<span '.$css_container_inline.' '.$data_value.' class="calltoaction-button calltoaction-custom-js '.esc_html($button_type).' '.esc_html($inline_block).' '.esc_html($position_button).' '.esc_html($position_button_bt).' '.esc_html($button_border_type).' '.esc_html($button_align).' calltoaction-button-'.esc_html($instance).ewmp_animate_class($addon_animate,$effect,$delay).'>';
			echo '<a '.$css_a_inline.' href="'.esc_url($button_url).'" target="'.esc_html($button_target_url).'">';
				
			if($button_icon_show == 'calltoaction-icon-show') {
				\Elementor\Icons_Manager::render_icon( $settings['button_icon'], [ 'aria-hidden' => 'true', 'style' => $css_i_inline ] );
			}				
					
			echo esc_html($button_text) . '</a>';
		echo '</span>';	
		

		
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
