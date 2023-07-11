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
 * Elementor Faq
 *
 * Elementor widget for team vision
 *
 * @since 1.0.0
 */
class Faq extends Widget_Base {

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
		return 'adte-faq';
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
		return esc_html__( 'Faq', 'elementorwidgetsmegapack' );
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
		return 'eicon-help-o';
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
				'label' => esc_html__( 'Faq', 'elementorwidgetsmegapack' ),
			]
		);

		$this->add_control(
			'open_faqs',
			[
				'label' => esc_html__( 'Open FAQ By Default', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default'		=> esc_html__( 'Default', 'elementorwidgetsmegapack' ),
					'open_all' 		=> esc_html__( 'Open All', 'elementorwidgetsmegapack' ),					
					'close_all' 	=> esc_html__( 'Close All', 'elementorwidgetsmegapack' )					
				]
			]
		);

		$this->add_control(
			'faqs',
			[
				'label' => esc_html__( 'FAQ', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => [
					[
						'name' => 'title',
						'label' => esc_html__( 'Title', 'elementorwidgetsmegapack' ),
						'type' => Controls_Manager::TEXT,
						'default' => esc_html__( 'Title FAQ' , 'elementorwidgetsmegapack' ),
						'label_block' => true,
					],
					[
						'name' => 'text',
						'label' => esc_html__( 'Text', 'elementorwidgetsmegapack' ),
						'type' =>  \Elementor\Controls_Manager::WYSIWYG,
						'default' => '',
						'placeholder' => esc_html__( 'Your Faq Text', 'elementorwidgetsmegapack' )
					]					
				],
				'title_field' => '{{{ title }}}',
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
			'header_icon',
			[
				'label' => esc_html__( 'Header Icon', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
						'value' => 'fas fa-plus',
						'library' => 'solid',
				]
			]
		);

		$this->add_control(
			'header_active_icon',
			[
				'label' => esc_html__( 'Header Active Icon', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
						'value' => 'fas fa-minus',
						'library' => 'solid',
				]
			]
		);

		$this->add_control(
			'style',
			[
				'label' => esc_html__( 'Style', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => [
					'style1'	=> esc_html__( 'Style 1', 'elementorwidgetsmegapack' ),
					'style2' 	=> esc_html__( 'Style 2', 'elementorwidgetsmegapack' ),				
					'style3' 	=> esc_html__( 'Style 3', 'elementorwidgetsmegapack' )			
				]
			]
		);

		$this->add_control(
			'active_color',
			[
				'label' => esc_html__( 'Active Background Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#003eff'
			]
		);

		$this->add_control(
			'title_active_text_color',
			[
				'label' => esc_html__( 'Title Active Text Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF'
			]
		);

		$this->add_control(
			'background_color',
			[
				'label' => esc_html__( 'Background Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF'
			]
		);

		$this->add_control(
			'default_color',
			[
				'label' => esc_html__( 'Default Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#003eff'
			]
		);

		$this->add_control(
			'default_text_color',
			[
				'label' => esc_html__( 'Default Text Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF'
			]
		);

		$this->add_control(
			'font_size_title',
			[
				'label' => esc_html__( 'Title Font Size', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::TEXT,
				'default' => '15px'
			]
		);	

		$this->add_control(
			'font_size_text',
			[
				'label' => esc_html__( 'Content Font Size', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::TEXT,
				'default' => '12px'
			]
		);	

		$this->add_control(
			'border',
			[
				'label' => esc_html__( 'Border Type', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'square',
				'options' => [
					'square'	=> esc_html__( 'Square', 'elementorwidgetsmegapack' ),
					'rounded' 	=> esc_html__( 'Rounded', 'elementorwidgetsmegapack' )			
				]
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label' => esc_html__( 'Border Rounded (px)', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::TEXT,
				'default' => '5px',
				'condition'	=> [
					'border'	=> 'rounded'
				]
			]
		);

		$this->add_control(
			'rtl',
			[
				'label' => esc_html__( 'RTL', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'ltr',
				'options' => [
					'ltr'	=> esc_html__( 'LTR', 'elementorwidgetsmegapack' ),
					'rtl' 		=> esc_html__( 'RTL', 'elementorwidgetsmegapack' )			
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
		
        $open_faqs					= esc_html($settings['open_faqs']);
        $style						= esc_html($settings['style']);
        $active_color				= esc_html($settings['active_color']);
		$title_active_text_color	= esc_html($settings['title_active_text_color']);
		$default_color				= esc_html($settings['default_color']);
		$default_text_color			= esc_html($settings['default_text_color']);
		$background_color			= esc_html($settings['background_color']);		
		$font_size_title			= esc_html($settings['font_size_title']);		
		$font_size_text				= esc_html($settings['font_size_text']);		
		$border						= esc_html($settings['border']);		
		$border_radius				= esc_html($settings['border_radius']);		
		$rtl						= esc_html($settings['rtl']);		
		
		// Animations
		$addon_animate				= esc_html($settings['addon_animate']);
		$effect						= esc_html($settings['effect']);
		$delay						= esc_html($settings['delay']);
		
		wp_enqueue_script( 'faq' );		
		wp_enqueue_script( 'appear' );			
		wp_enqueue_script( 'animate' );
		wp_enqueue_script( 'jquery-ui-core');
		wp_enqueue_script( 'jquery-ui-accordion' );
		wp_enqueue_style( 'animations' );
		wp_enqueue_style('jquery-ui.min');
		wp_enqueue_style('jquery-ui.theme.min');
		wp_enqueue_style( 'elementor-icons' );
		wp_enqueue_style( 'font-awesome' );
		wp_enqueue_style( 'elementor-editor' );
		wp_enqueue_style( 'elementor-icons' );	
		wp_enqueue_style( 'fontawesome' );
		
		echo '<script type=\'text/javascript\'>
						jQuery(document).ready(function($){
							var icons = {
							  header: "'.$settings['header_icon']['value'].'",
							  activeHeader: "'.$settings['header_active_icon']['value'].'"
							};							
								$(\'#adte-faq-'.esc_html($instance).'\').accordion({
									icons: icons,
									collapsible: true,
									heightStyle: "content"';
									if($open_faqs == 'close_all') {	
										echo ',active: false';							
									}	
						echo	'});
								';
								if($open_faqs == 'open_all') {	
									echo '$(\'#adte-faq-'.esc_html($instance).' .ui-accordion-content\').show()';							
								}		
						echo '});	
				</script>';
			echo '<style type="text/css">';
			
			if($style == 'style1') {
				echo '.adte-faq.adte-faq-'.esc_html($instance).'.adte-faq-style1 .ui-state-default, 
					.adte-faq.adte-faq-'.esc_html($instance).'.adte-faq-style1 .ui-widget-content .ui-state-default, 
					.adte-faq.adte-faq-'.esc_html($instance).'.adte-faq-style1 .ui-widget-header .ui-state-default, 
					.adte-faq.adte-faq-'.esc_html($instance).'.adte-faq-style1 .ui-button, 
					html .adte-faq.adte-faq-'.esc_html($instance).' .ui-button.ui-state-disabled:hover, 
					html .adte-faq.adte-faq-'.esc_html($instance).' .ui-button.ui-state-disabled:active	{		
						border: 1px solid '.esc_html($default_color).';
						background: '.esc_html($default_color).';
						color: '.esc_html($default_text_color).';
						font-size: '.esc_html($font_size_title).';
					}			
					.adte-faq.adte-faq-'.esc_html($instance).'.adte-faq-style1 .ui-state-active, 
					.adte-faq.adte-faq-'.esc_html($instance).'.adte-faq-style1 .ui-widget-content .ui-state-active, 
					.adte-faq.adte-faq-'.esc_html($instance).'.adte-faq-style1 .ui-widget-header .ui-state-active, 
					.adte-faq.adte-faq-'.esc_html($instance).'.adte-faq-style1 a.ui-button:active, 
					.adte-faq.adte-faq-'.esc_html($instance).'.adte-faq-style1 .ui-button:active, 
					.adte-faq.adte-faq-'.esc_html($instance).'.adte-faq-style1 .ui-button.ui-state-active:hover {
						border: 1px solid '.esc_html($active_color).';
						background: '.esc_html($active_color).';
						color: '.esc_html($title_active_text_color).';	
					}
					.adte-faq.adte-faq-'.esc_html($instance).'.adte-faq-style1 .ui-widget-content {
						background: '.esc_html($background_color).';
						border: 1px solid '.esc_html($active_color).';
						font-size: '.esc_html($font_size_text).';
					}';
			}

			if($style == 'style2') {
				echo '.adte-faq.adte-faq-'.esc_html($instance).'.adte-faq-style2 .ui-state-default, 
					.adte-faq.adte-faq-'.esc_html($instance).'.adte-faq-style2 .ui-widget-content .ui-state-default, 
					.adte-faq.adte-faq-'.esc_html($instance).'.adte-faq-style2 .ui-widget-header .ui-state-default, 
					.adte-faq.adte-faq-'.esc_html($instance).'.adte-faq-style2 .ui-button, 
					html .adte-faq.adte-faq-'.esc_html($instance).' .ui-button.ui-state-disabled:hover, 
					html .adte-faq.adte-faq-'.esc_html($instance).' .ui-button.ui-state-disabled:active	{		
						border: 1px solid '.esc_html($default_color).';
						background: '.esc_html($default_color).';
						color: '.esc_html($default_text_color).';
						font-size: '.esc_html($font_size_title).';
					}			
					.adte-faq.adte-faq-'.esc_html($instance).'.adte-faq-style2 .ui-state-active, 
					.adte-faq.adte-faq-'.esc_html($instance).'.adte-faq-style2 .ui-widget-content .ui-state-active, 
					.adte-faq.adte-faq-'.esc_html($instance).'.adte-faq-style2 .ui-widget-header .ui-state-active, 
					.adte-faq.adte-faq-'.esc_html($instance).'.adte-faq-style2 a.ui-button:active, 
					.adte-faq.adte-faq-'.esc_html($instance).'.adte-faq-style2 .ui-button:active, 
					.adte-faq.adte-faq-'.esc_html($instance).'.adte-faq-style2 .ui-button.ui-state-active:hover {
						border: 1px solid '.esc_html($active_color).';
						background: '.esc_html($active_color).';
						color: '.esc_html($title_active_text_color).';	
					}
					.adte-faq.adte-faq-'.esc_html($instance).'.adte-faq-style2 .ui-widget-content {
						background: '.esc_html($background_color).';
						border: 1px solid '.esc_html($active_color).';
						font-size: '.esc_html($font_size_text).';
					}';
			}

			if($style == 'style3') {
				echo '.adte-faq.adte-faq-'.esc_html($instance).'.adte-faq-style3 .ui-state-default, 
					.adte-faq.adte-faq-'.esc_html($instance).'.adte-faq-style3 .ui-widget-content .ui-state-default, 
					.adte-faq.adte-faq-'.esc_html($instance).'.adte-faq-style3 .ui-widget-header .ui-state-default, 
					.adte-faq.adte-faq-'.esc_html($instance).'.adte-faq-style3 .ui-button, 
					html .adte-faq.adte-faq-'.esc_html($instance).' .ui-button.ui-state-disabled:hover, 
					html .adte-faq.adte-faq-'.esc_html($instance).' .ui-button.ui-state-disabled:active	{		
						border: 0;
						background: none;
						color: '.esc_html($default_text_color).';
						font-size: '.esc_html($font_size_title).';
					}			
					.adte-faq.adte-faq-'.esc_html($instance).'.adte-faq-style3 .ui-state-active, 
					.adte-faq.adte-faq-'.esc_html($instance).'.adte-faq-style3 .ui-widget-content .ui-state-active, 
					.adte-faq.adte-faq-'.esc_html($instance).'.adte-faq-style3 .ui-widget-header .ui-state-active, 
					.adte-faq.adte-faq-'.esc_html($instance).'.adte-faq-style3 a.ui-button:active, 
					.adte-faq.adte-faq-'.esc_html($instance).'.adte-faq-style3 .ui-button:active, 
					.adte-faq.adte-faq-'.esc_html($instance).'.adte-faq-style3 .ui-button.ui-state-active:hover {
						border: 0;
						background: none;
						color: '.esc_html($title_active_text_color).';	
					}
					.adte-faq.adte-faq-'.esc_html($instance).'.adte-faq-style3 .ui-widget-content {
						background: none;
						border: 0;
						padding:.5em .5em .5em .7em;
						font-size: '.esc_html($font_size_text).';
					}';
			}
			
			if($border == 'square') {
				echo '.adte-faq.adte-faq-'.esc_html($instance).' .ui-corner-all, 
				.adte-faq.adte-faq-'.esc_html($instance).' .ui-corner-bottom, 
				.adte-faq.adte-faq-'.esc_html($instance).' .ui-corner-right, 
				.adte-faq.adte-faq-'.esc_html($instance).' .ui-corner-left, 
				.adte-faq.adte-faq-'.esc_html($instance).' .ui-corner-br,
				.adte-faq.adte-faq-'.esc_html($instance).' .ui-corner-tr,
				.adte-faq.adte-faq-'.esc_html($instance).' .ui-corner-tl,
				.adte-faq.adte-faq-'.esc_html($instance).' .ui-corner-top {
					border-radius:0!important;
				}';
			} else {
				echo '.adte-faq.adte-faq-'.esc_html($instance).' .ui-corner-all, 
				.adte-faq.adte-faq-'.esc_html($instance).' .ui-corner-bottom, 
				.adte-faq.adte-faq-'.esc_html($instance).' .ui-corner-right, 
				.adte-faq.adte-faq-'.esc_html($instance).' .ui-corner-left, 
				.adte-faq.adte-faq-'.esc_html($instance).' .ui-corner-br,
				.adte-faq.adte-faq-'.esc_html($instance).' .ui-corner-tr,
				.adte-faq.adte-faq-'.esc_html($instance).' .ui-corner-tl,
				.adte-faq.adte-faq-'.esc_html($instance).' .ui-corner-top {
					border-radius:'.esc_html($border_radius).'!important;
				}';							
			}
			
			
			echo '</style>';
		
		
		echo '<div id="adte-faq-'.esc_html($instance).'" class="adte-faq adte-faq-'.esc_html($instance).' adte-faq-'.esc_html($rtl).' adte-faq-'.esc_html($style).' '.ewmp_animate_class($addon_animate,$effect,$delay).'>';
		
		foreach($settings['faqs'] as $faq) {
			echo '<h3>'.$faq['title'].'</h3>';
			echo '<div>'.$faq['text'].'</div>';
		}
		
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
