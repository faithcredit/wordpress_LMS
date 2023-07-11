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
 * Elementor Boxmessage
 *
 * Elementor widget for team vision
 *
 * @since 1.0.0
 */
class Boxmessage extends Widget_Base {

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
		return 'boxmessage';
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
		return esc_html__( 'Box Message', 'elementorwidgetsmegapack' );
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
		return 'eicon-info-box';
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
			'boxmessagge_type',
			[
				'label' => esc_html__( 'Type Box Message', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default'	=> esc_html__( 'Default', 'elementorwidgetsmegapack' ),
					'custom' 	=> esc_html__( 'Custom', 'elementorwidgetsmegapack' )				
				]
			]
		);	

		$this->add_control(
			'boxmessagge_default_type',
			[
				'label' => esc_html__( 'Type Default Message', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'bme_message-info',
				'options' => [
					'bme_message-info'		=> esc_html__( 'Info', 'elementorwidgetsmegapack' ),
					'bme_message-warning' 	=> esc_html__( 'Alert', 'elementorwidgetsmegapack' ),				
					'bme_message-success' 	=> esc_html__( 'Success', 'elementorwidgetsmegapack' ),				
					'bme_message-danger' 		=> esc_html__( 'Error', 'elementorwidgetsmegapack' )				
				],
				'condition'	=> [
					'boxmessagge_type'	=> 'default'
				]
			]
		);	

		$this->add_control(
			'boxmessagge_default_rtl',
			[
				'label' => esc_html__( 'RTL', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'off',
				'options' => [
					'off'	=> esc_html__( 'Off', 'elementorwidgetsmegapack' ),
					'on' 	=> esc_html__( 'On', 'elementorwidgetsmegapack' )			
				],
				'condition'	=> [
					'boxmessagge_type'	=> 'default'
				]
			]
		);

		$this->add_control(
			'boxmessagge_default_style',
			[
				'label' => esc_html__( 'Style', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'vc_alert_rounded',
				'options' => [
					'vc_alert_rounded'			=> esc_html__( 'Rounded', 'elementorwidgetsmegapack' ),
					'vc_alert_square' 			=> esc_html__( 'Square', 'elementorwidgetsmegapack' ),				
					'vc_alert_round' 			=> esc_html__( 'Round', 'elementorwidgetsmegapack' ),				
					'vc_alert_outlined' 		=> esc_html__( 'Outlined', 'elementorwidgetsmegapack' ),				
					'vc_alert_3d' 				=> esc_html__( '3D', 'elementorwidgetsmegapack' ),				
					'vc_alert_square_outlined' 	=> esc_html__( 'Square Outlined', 'elementorwidgetsmegapack' )				
				]
			]
		);

		$this->add_control(
			'boxmessagge_custom_icon',
			[
				'label' => esc_html__( 'Icon', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
						'value' => 'fas fa-star',
						'library' => 'solid',
				],
				'condition'	=> [
					'boxmessagge_type'	=> 'custom'
				]
			]
		);

		$this->add_control(
			'boxmessagge_custom_icon_float',
			[
				'label' => esc_html__( 'Icon Float', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left'			=> esc_html__( 'Left', 'elementorwidgetsmegapack' ),
					'right' 		=> esc_html__( 'Right', 'elementorwidgetsmegapack' ),				
					'none' 			=> esc_html__( 'None', 'elementorwidgetsmegapack' )				
				],
				'condition'	=> [
					'boxmessagge_type'	=> 'custom'
				]
			]
		);

		$this->add_control(
			'boxmessagge_text',
			[
				'label' => esc_html__( 'Text Message', 'elementor-calltoaction' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => ''
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
			'boxmessagge_custom_text_size',
			[
				'label' => esc_html__( 'Text Size (px)', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::TEXT,
				'default' => '14px'
			]
		);

		$this->add_control(
			'boxmessagge_custom_size',
			[
				'label' => esc_html__( 'Icon Size (px)', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::TEXT,
				'default' => '20px'
			]
		);	

		$this->add_control(
			'boxmessagge_custom_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
				'condition'	=> [
					'boxmessagge_type'	=> 'custom'
				]
			]
		);

		$this->add_control(
			'boxmessagge_custom_margin',
			[
				'label' => esc_html__( 'Icon Margin', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::TEXT,
				'default' => '2px',
				'condition'	=> [
					'boxmessagge_type'	=> 'custom'
				]
			]
		);	

		$this->add_control(
			'boxmessagge_custom_padding',
			[
				'label' => esc_html__( 'Icon Padding', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::TEXT,
				'default' => '23px'
			]
		);	

		$this->add_control(
			'boxmessagge_custom_background_color',
			[
				'label' => esc_html__( 'Background Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#23a455',
				'condition'	=> [
					'boxmessagge_type'	=> 'custom'
				]
			]
		);

		$this->add_control(
			'boxmessagge_custom_background_border_3d_color',
			[
				'label' => esc_html__( 'Border Color only For 3d Box', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FC615D',
				'condition'	=> [
					'boxmessagge_type'	=> 'custom'
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
		
        $boxmessagge_type									= esc_html($settings['boxmessagge_type']);		
        $boxmessagge_default_type							= esc_html($settings['boxmessagge_default_type']);		
		$boxmessagge_default_style							= esc_html($settings['boxmessagge_default_style']);
		$boxmessagge_default_rtl							= esc_html($settings['boxmessagge_default_rtl']);
        $boxmessagge_custom_text_size						= esc_html($settings['boxmessagge_custom_text_size']);
        $boxmessagge_custom_size							= esc_html($settings['boxmessagge_custom_size']);
        $boxmessagge_custom_icon_float						= esc_html($settings['boxmessagge_custom_icon_float']);
		$boxmessagge_custom_icon_color						= esc_html($settings['boxmessagge_custom_icon_color']);
		$boxmessagge_custom_background_color				= esc_html($settings['boxmessagge_custom_background_color']);
		$boxmessagge_custom_margin							= esc_html($settings['boxmessagge_custom_margin']);
		$boxmessagge_custom_padding							= esc_html($settings['boxmessagge_custom_padding']);		
		$boxmessagge_custom_background_border_3d_color		= esc_html($settings['boxmessagge_custom_background_border_3d_color']);		
		$boxmessagge_text									= esc_html($settings['boxmessagge_text']);		
		
		// Animations
		$addon_animate			= esc_html($settings['addon_animate']);
		$effect					= esc_html($settings['effect']);
		$delay					= esc_html($settings['delay']);
		
		wp_enqueue_style( 'animations' );
		wp_enqueue_script( 'appear' );			
		wp_enqueue_script( 'animate' );
		wp_enqueue_style( 'elementor-icons' );
		wp_enqueue_style( 'font-awesome' );	
		
	
	// DEFAULT
	if($boxmessagge_type == 'default') {
			echo '<style type="text/css">
							.boxmessage-'.esc_html($instance).' .boxmessage_text {
								font-size:'.esc_html($boxmessagge_custom_text_size).';
							}
							.boxmessage-'.esc_html($instance).' i {
								font-size:'.esc_html($boxmessagge_custom_size).';
								padding:'.esc_html($boxmessagge_custom_padding).';
							}</style>';		
		if($addon_animate == 'on') {
			echo '<div class="boxmessage-'.esc_html($instance).' bme_message bme_content_element '.esc_html($boxmessagge_default_type).' boxmessage-rtl-'.esc_html($boxmessagge_default_rtl).' '.esc_html($boxmessagge_default_style).' animate-in" data-anim-type="'.esc_html($effect).'" data-anim-delay="'.esc_html($delay).'">
							<div class="boxmessage_text"><div class="icon-container"><i class="fa ';
							
							if($boxmessagge_default_type == 'bme_message-info') {	
								echo 'fa-info-circle';								
							}
							if($boxmessagge_default_type == 'bme_message-warning') {	
								echo 'fa-exclamation-triangle';								
							}
							if($boxmessagge_default_type == 'bme_message-success') {	
								echo 'fa-check';								
							}
							if($boxmessagge_default_type == 'bme_message-danger') {	
								echo 'fa-times';								
							}							
							
							echo '"></i></div><div class="message-text">'.esc_html($boxmessagge_text).'</div><div class="clearfix"></div></div>
						</div>';
		} else {
			echo '<div class="boxmessage-'.esc_html($instance).' bme_message bme_content_element '.esc_html($boxmessagge_default_type).' boxmessage-rtl-'.esc_html($boxmessagge_default_rtl).' '.esc_html($boxmessagge_default_style).'">
							<div class="boxmessage_text"><div class="icon-container"><i class="fa ';
							
							if($boxmessagge_default_type == 'bme_message-info') {	
								echo 'fa-info-circle';								
							}
							if($boxmessagge_default_type == 'bme_message-warning') {	
								echo 'fa-exclamation-triangle';								
							}
							if($boxmessagge_default_type == 'bme_message-success') {	
								echo 'fa-check';								
							}
							if($boxmessagge_default_type == 'bme_message-danger') {	
								echo 'fa-times';								
							}							
							
							echo '"></i></div><div class="message-text">'.esc_html($boxmessagge_text).'</div><div class="clearfix"></div></div>
						</div>';				
		}
		
	}
	
	// CUSTOM
	if($boxmessagge_type == 'custom') {
		if($addon_animate == 'on') {
			echo '<style type="text/css">
							.boxmessage-'.esc_html($instance).' .boxmessage_text {
								background:none!important;
								text-shadow:0 0 0;
								color:'.esc_html($boxmessagge_custom_icon_color).';
								font-size:'.esc_html($boxmessagge_custom_text_size).';
							}
							.boxmessage-'.esc_html($instance).' {
								background-color:'.esc_html($boxmessagge_custom_background_color).'!important;							
								border-color:'.esc_html($boxmessagge_custom_background_color).'!important;
																						
							}
							.boxmessage-'.esc_html($instance).' i {
								float:'.esc_html($boxmessagge_custom_icon_float).';
								margin:'.esc_html($boxmessagge_custom_margin).';
								padding:'.esc_html($boxmessagge_custom_padding).';
								color:'.esc_html($boxmessagge_custom_icon_color).';
								font-size:'.esc_html($boxmessagge_custom_size).';
							}';
			if($boxmessagge_default_style == 'vc_alert_3d') {				
					echo '.boxmessage-'.esc_html($instance).' {
								box-shadow:0 5px 0 '.esc_html($boxmessagge_custom_background_border_3d_color).';
					}';
			}			
			echo	'</style>';
			
			echo '<div class="boxmessage-'.esc_html($instance).' bme_message bme_content_element '.esc_html($boxmessagge_default_style).' animate-in" data-anim-type="'.esc_html($effect).'" data-anim-delay="'.esc_html($delay).'">
								<div class="boxmessage_text">';
								
								\Elementor\Icons_Manager::render_icon( $settings['boxmessagge_custom_icon'], [ 'aria-hidden' => 'true' ] );
								
								echo esc_html($boxmessagge_text).'</div>
						</div>';
		} else {
			echo '<style type="text/css">
							.boxmessage-'.esc_html($instance).' .boxmessage_text {
								background:none!important;
								text-shadow:0 0 0;
								color:'.esc_html($boxmessagge_custom_icon_color).';
								font-size:'.esc_html($boxmessagge_custom_text_size).';
							}
							.boxmessage-'.esc_html($instance).' {
								background-color:'.esc_html($boxmessagge_custom_background_color).'!important;							
								border-color:'.esc_html($boxmessagge_custom_background_color).'!important;														
							}
							.boxmessage-'.esc_html($instance).' i {
								float:'.esc_html($boxmessagge_custom_icon_float).';
								margin:'.esc_html($boxmessagge_custom_margin).';
								padding:'.esc_html($boxmessagge_custom_padding).';
								color:'.esc_html($boxmessagge_custom_icon_color).';
								font-size:'.esc_html($boxmessagge_custom_size).';
							}';
			if($boxmessagge_default_style == 'vc_alert_3d') {				
					echo '.boxmessage-'.esc_html($instance).' {
								box-shadow:0 5px 0 '.esc_html($boxmessagge_custom_background_border_3d_color).';
					}';
			}							
			echo '</style>';

			echo '<div class="boxmessage-'.esc_html($instance).' bme_message bme_content_element '.esc_html($boxmessagge_default_style).'">
						<div class="boxmessage_text">';
								
					    \Elementor\Icons_Manager::render_icon( $settings['boxmessagge_custom_icon'], [ 'aria-hidden' => 'true' ] );
								
						echo esc_html($boxmessagge_text).'</div>
			</div>';		
		}
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
