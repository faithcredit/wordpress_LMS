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
 * Elementor Countdown
 *
 * Elementor widget for team vision
 *
 * @since 1.0.0
 */
class Countdown extends Widget_Base {

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
		return 'simple-countdown';
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
		return esc_html__( 'Countdown', 'elementorwidgetsmegapack' );
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
		return 'eicon-countdown';
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
				'label' => esc_html__( 'Countdown', 'elementorwidgetsmegapack' ),
			]
		);

		$this->add_control(
			'vcmp_countdown_year',
			[
				'label' => esc_html__( 'Year (format: YYYY)', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::TEXT,
				'default' => '10'
			]
		);

		$this->add_control(
			'vcmp_countdown_month',
			[
				'label' => esc_html__( 'Month (format: MM)', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::TEXT,
				'default' => '10'
			]
		);
		
		$this->add_control(
			'vcmp_countdown_day',
			[
				'label' => esc_html__( 'Day (format: DD)', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::TEXT,
				'default' => '10'
			]
		);		

		$this->add_control(
			'vcmp_countdown_type',
			[
				'label' => esc_html__( 'Type Coundown', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'type1',
				'options' => [
					'type1'		=> esc_html__( '382 Days 05:44:12', 'elementorwidgetsmegapack' ),
					'type2' 	=> esc_html__( '25 weeks 4 days 23 hr 57 min 56 sec', 'elementorwidgetsmegapack' ),					
					'type3' 	=> esc_html__( '47 hr 59 min 14 sec', 'elementorwidgetsmegapack' )					
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
			'vcmp_countdown_style',
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
			'vcmp_countdown_style_active',
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
			'vcmp_countdown_color',
			[
				'label' => esc_html__( 'Main Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FC615D',
				'condition'	=> [
					'vcmp_countdown_style_active'	=> 'on'
				]
			]
		);

		$this->add_control(
			'vcmp_countdown_secondary_color',
			[
				'label' => esc_html__( 'Secondary Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#00FFFF',
				'condition'	=> [
					'vcmp_countdown_style_active'	=> 'on'
				]
			]
		);

		$this->add_control(
			'vcmp_countdown_background_color',
			[
				'label' => esc_html__( 'Background Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
				'condition'	=> [
					'vcmp_countdown_style_active'	=> 'on'
				]
			]
		);

		$this->add_control(
			'vcmp_countdown_font_size',
			[
				'label' => esc_html__( 'Font Size (px)', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::TEXT,
				'default' => '30px',
				'condition'	=> [
					'custom_style'	=> 'on'
				]
			]
		);	

		$this->add_control(
			'vcmp_countdown_padding',
			[
				'label' => esc_html__( 'Padding (px)', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::TEXT,
				'default' => '30px',
				'condition'	=> [
					'custom_style'	=> 'on'
				]
			]
		);

		$this->add_control(
			'vcmp_countdown_margin',
			[
				'label' => esc_html__( 'Margin (px)', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::TEXT,
				'default' => '30px',
				'condition'	=> [
					'custom_style'	=> 'on'
				]
			]
		);

		$this->add_control(
			'vcmp_countdown_align',
			[
				'label' => esc_html__( 'Style', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'vcmp_countdown_align_center',
				'options' => [
					'vcmp_countdown_align_center'	=> esc_html__( 'Center', 'elementorwidgetsmegapack' ),
					'vcmp_countdown_align_left' 	=> esc_html__( 'Left', 'elementorwidgetsmegapack' ),				
					'vcmp_countdown_align_right' 	=> esc_html__( 'Right', 'elementorwidgetsmegapack' )			
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
		
        $vcmp_countdown_year				= esc_html($settings['vcmp_countdown_year']);		
        $vcmp_countdown_month				= esc_html($settings['vcmp_countdown_month']);		
		$vcmp_countdown_day					= esc_html($settings['vcmp_countdown_day']);
        $vcmp_countdown_type				= esc_html($settings['vcmp_countdown_type']);
        $vcmp_countdown_style				= esc_html($settings['vcmp_countdown_style']);
        $vcmp_countdown_style_active		= esc_html($settings['vcmp_countdown_style_active']);
		$vcmp_countdown_color				= esc_html($settings['vcmp_countdown_color']);
		$vcmp_countdown_secondary_color		= esc_html($settings['vcmp_countdown_secondary_color']);
		$vcmp_countdown_background_color	= esc_html($settings['vcmp_countdown_background_color']);
		$vcmp_countdown_font_size			= esc_html($settings['vcmp_countdown_font_size']);		
		$vcmp_countdown_padding				= esc_html($settings['vcmp_countdown_padding']);		
		$vcmp_countdown_margin				= esc_html($settings['vcmp_countdown_margin']);		
		$vcmp_countdown_align				= esc_html($settings['vcmp_countdown_align']);		
		
		// Animations
		$addon_animate						= esc_html($settings['addon_animate']);
		$effect								= esc_html($settings['effect']);
		$delay								= esc_html($settings['delay']);
		
		wp_enqueue_script( 'countdown' );
		wp_enqueue_style( 'animations' );
		wp_enqueue_script( 'appear' );			
		wp_enqueue_script( 'animate' );
		
		if($vcmp_countdown_type == 'type1') {		
			echo '<script type=\'text/javascript\'>
						jQuery(document).ready(function($){
							$(\'.vcmp_clock.type1\').each(function() {
								var $this = $(this), finalDate = $(this).data(\'countdown\');
								$this.countdown(finalDate, function(event) {
									$this.html(event.strftime(\'<span class="vcmp-day">%D days</span> <span class="vcmp-time">%H:%M:%S</span>\'));
								});
							});
						});	
					   </script>';			   
		}
		
		if($vcmp_countdown_type == 'type2') {
			echo '<script type=\'text/javascript\'>
						jQuery(document).ready(function($){
							$(\'.vcmp_clock.type2\').each(function() {
								var $this = $(this), finalDate = $(this).data(\'countdown\');
								$this.countdown(finalDate, function(event) {
									$this.html(event.strftime(\'\'
										+ \'<span>%-w week%!w</span>\'
										+ \'<span>%-d day%!d</span>\'
										+ \'<span>%H hr</span>\'
										+ \'<span>%M min</span>\'
										+ \'<span>%S sec</span>\'));
								});
							});
						});	
					   </script>';
		}

		if($vcmp_countdown_type == 'type3') {
			echo '<script type=\'text/javascript\'>
						jQuery(document).ready(function($){
							$(\'#clock-'.esc_html($instance).'\').countdown("'.esc_html($vcmp_countdown_year).'/'.esc_html($vcmp_countdown_month).'/'.esc_html($vcmp_countdown_day).'", function(event) {
							  var totalHours = event.offset.totalDays * 24 + event.offset.hours;
							  $(this).html(event.strftime(\'<span>\' + totalHours + \' hr</span> <span>%M min</span> <span>%S sec</span>\'));
							});
						});	
					   </script>';
		}
		
		if($vcmp_countdown_style_active == 'on') {
			if($vcmp_countdown_type == 'type1') {
				echo '<style type="text/css">';
				echo '.countdown-'.esc_html($instance).' .'.esc_html($vcmp_countdown_type).'.'.esc_html($vcmp_countdown_style).' { 
								font-size:'.esc_html($vcmp_countdown_font_size).'; 
								color:'.esc_html($vcmp_countdown_secondary_color).' 
							}'; 
				echo '.countdown-'.esc_html($instance).' .'.esc_html($vcmp_countdown_type).'.'.esc_html($vcmp_countdown_style).' .vcmp-day, 
							.countdown-'.esc_html($instance).' .'.esc_html($vcmp_countdown_type).'.'.esc_html($vcmp_countdown_style).' .vcmp-time {
								border-color:'.esc_html($vcmp_countdown_color).';	
								padding:'.esc_html($vcmp_countdown_padding).';
								background:'.esc_html($vcmp_countdown_background_color).';
								margin:'.esc_html($vcmp_countdown_margin).';								
							}';
				echo '</style>';		
			}
			if($vcmp_countdown_type == 'type2' || $vcmp_countdown_type == 'type3') {
				echo '<style type="text/css">';
				echo '.countdown-'.esc_html($instance).' .'.esc_html($vcmp_countdown_type).'.'.esc_html($vcmp_countdown_style).' { 
								font-size:'.esc_html($vcmp_countdown_font_size).'; 
								color:'.esc_html($vcmp_countdown_secondary_color).' 
							}'; 
				echo '.countdown-'.esc_html($instance).' .'.esc_html($vcmp_countdown_type).'.'.esc_html($vcmp_countdown_style).' span {
								border-color:'.esc_html($vcmp_countdown_color).';	
								padding:'.esc_html($vcmp_countdown_padding).';
								background:'.esc_html($vcmp_countdown_background_color).';
								margin:'.esc_html($vcmp_countdown_margin).';
							}';
				echo '</style>';		
			}		
		}
		
		if($addon_animate == 'on') {
			echo  '<div class="countdown-'.esc_html($instance).' animate-in" data-anim-type="'.esc_html($effect).'" data-anim-delay="'.esc_html($delay).'">';   
		} else {
			echo '<div class="countdown-'.esc_html($instance).'">';	
		}
		echo '<div id="clock-'.esc_html($instance).'" class="vcmp_clock '.esc_html($vcmp_countdown_type).' '.esc_html($vcmp_countdown_align).' '.esc_html($vcmp_countdown_style).'" data-countdown="'.esc_html($vcmp_countdown_year).'/'.esc_html($vcmp_countdown_month).'/'.esc_html($vcmp_countdown_day).'"></div><div class="adclear"></div>';	
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
