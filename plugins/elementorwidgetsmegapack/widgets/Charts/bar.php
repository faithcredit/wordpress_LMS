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
 * Elementor Charts
 *
 * Elementor widget for team vision
 *
 * @since 1.0.0
 */
class BarCharts extends Widget_Base {

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
		return 'bar-charts';
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
		return esc_html__( 'Bar Charts', 'elementor-charts' );
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
		return 'eicon-menu-bar';
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
				'label' => esc_html__( 'Content', 'elementor-charts' ),
			]
		);

		$this->add_control(
			'percent',
			[
				'label' => esc_html__( 'Percent', 'elementor-charts' ),
				'type' => Controls_Manager::SELECT,
				'default' => '50',
				'options' => [
										'1' 	=>   '1', 
										'2' 	=>   '2', 
										'3' 	=>   '3', 
										'4' 	=>   '4', 
										'5' 	=>   '5', 
										'6' 	=>   '6', 
										'7' 	=>   '7', 
										'8' 	=>   '8', 
										'9' 	=>   '9', 
										'10' 	=>   '10',
										'11' 	=>   '11',
										'12' 	=>   '12',
										'13' 	=>   '13',
										'14' 	=>   '14',
										'15' 	=>   '15',
										'16' 	=>   '16',
										'17' 	=>   '17',
										'18' 	=>   '18',
										'19' 	=>   '19',
										'20' 	=>   '20',
										'21' 	=>   '21',
										'22' 	=>   '22',
										'23' 	=>   '23',
										'24' 	=>   '24',
										'25' 	=>   '25',
										'26' 	=>   '26',
										'27' 	=>   '27',
										'28' 	=>   '28',
										'29' 	=>   '29',
										'30' 	=>   '30',
										'31' 	=>   '31',
										'32' 	=>   '32',
										'33' 	=>   '33',
										'34' 	=>   '34',
										'35' 	=>   '35',
										'36' 	=>   '36',
										'37' 	=>   '37',
										'38' 	=>   '38',
										'39' 	=>   '39',
										'40' 	=>   '40',
										'41' 	=>   '41',
										'42' 	=>   '42',
										'43' 	=>   '43',
										'44' 	=>   '44',
										'45' 	=>   '45',
										'46' 	=>   '46',
										'47' 	=>   '47',
										'48' 	=>   '48',
										'49' 	=>   '49',
										'50' 	=>   '50',
										'51' 	=>   '51',
										'52' 	=>   '52',
										'53' 	=>   '53',
										'54' 	=>   '54',
										'55' 	=>   '55',
										'56' 	=>   '56',
										'57' 	=>   '57',
										'58' 	=>   '58',
										'59' 	=>   '59',
										'60' 	=>   '60',
										'61' 	=>   '61',
										'62' 	=>   '62',
										'63' 	=>   '63',
										'64' 	=>   '64',
										'65' 	=>   '65',
										'66' 	=>   '66',
										'67' 	=>   '67',
										'68' 	=>   '68',
										'69' 	=>   '69',
										'70' 	=>   '70',
										'71' 	=>   '71',
										'72' 	=>   '72',
										'73' 	=>   '73',
										'74' 	=>   '74',
										'75' 	=>   '75',
										'76' 	=>   '76',
										'77' 	=>   '77',
										'78' 	=>   '78',
										'79' 	=>   '79',
										'80' 	=>   '80',
										'81' 	=>   '81',
										'82' 	=>   '82',
										'83' 	=>   '83',
										'84' 	=>   '84',
										'85' 	=>   '85',
										'86' 	=>   '86',
										'87' 	=>   '87',
										'88' 	=>   '88',
										'89' 	=>   '89',
										'90' 	=>   '90',
										'91' 	=>   '91',
										'92' 	=>   '92',
										'93' 	=>   '93',
										'94' 	=>   '94',
										'95' 	=>   '95',
										'96' 	=>   '96',
										'97' 	=>   '97',
										'98' 	=>   '98',
										'99' 	=>   '99',
										'100' 	=>	 '100'				
				]
			]
		);

		$this->add_control(
			'width',
			[
				'label' => esc_html__( 'Width (example: 400px or 100%)', 'elementor-charts' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,				
				'default' => '400px'
			]
		);
		
		$this->end_controls_section();

		$this->start_controls_section(
			'section_animation',
			[
				'label' => esc_html__( 'Animations', 'elementor-charts' )
			]
		);
		
		$this->add_control(
			'addon_animate',
			[
				'label' => esc_html__( 'Animate', 'elementor-charts' ),
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
				'label' => esc_html__( 'Animate Effects', 'elementor-charts' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'fade-in',
				'options' => [
							'fade-in'			=> esc_html__( 'Fade In', 'elementor-charts' ),
							'fade-in-up' 		=> esc_html__( 'fade in up', 'elementor-charts' ),					
							'fade-in-down' 		=> esc_html__( 'fade in down', 'elementor-charts' ),					
							'fade-in-left' 		=> esc_html__( 'fade in Left', 'elementor-charts' ),					
							'fade-in-right' 	=> esc_html__( 'fade in Right', 'elementor-charts' ),					
							'fade-out'			=> esc_html__( 'Fade In', 'elementor-charts' ),
							'fade-out-up' 		=> esc_html__( 'Fade Out up', 'elementor-charts' ),					
							'fade-out-down' 	=> esc_html__( 'Fade Out down', 'elementor-charts' ),					
							'fade-out-left' 	=> esc_html__( 'Fade Out Left', 'elementor-charts' ),					
							'fade-out-right' 	=> esc_html__( 'Fade Out Right', 'elementor-charts' ),
							'bounce-in'			=> esc_html__( 'Bounce In', 'elementor-charts' ),
							'bounce-in-up' 		=> esc_html__( 'Bounce in up', 'elementor-charts' ),					
							'bounce-in-down' 	=> esc_html__( 'Bounce in down', 'elementor-charts' ),					
							'bounce-in-left' 	=> esc_html__( 'Bounce in Left', 'elementor-charts' ),					
							'bounce-in-right' 	=> esc_html__( 'Bounce in Right', 'elementor-charts' ),					
							'bounce-out'		=> esc_html__( 'Bounce In', 'elementor-charts' ),
							'bounce-out-up' 	=> esc_html__( 'Bounce Out up', 'elementor-charts' ),					
							'bounce-out-down' 	=> esc_html__( 'Bounce Out down', 'elementor-charts' ),					
							'bounce-out-left' 	=> esc_html__( 'Bounce Out Left', 'elementor-charts' ),					
							'bounce-out-right' 	=> esc_html__( 'Bounce Out Right', 'elementor-charts' ),	
							'zoom-in'			=> esc_html__( 'Zoom In', 'elementor-charts' ),
							'zoom-in-up' 		=> esc_html__( 'Zoom in up', 'elementor-charts' ),					
							'zoom-in-down' 		=> esc_html__( 'Zoom in down', 'elementor-charts' ),					
							'zoom-in-left' 		=> esc_html__( 'Zoom in Left', 'elementor-charts' ),					
							'zoom-in-right' 	=> esc_html__( 'Zoom in Right', 'elementor-charts' ),					
							'zoom-out'			=> esc_html__( 'Zoom In', 'elementor-charts' ),
							'zoom-out-up' 		=> esc_html__( 'Zoom Out up', 'elementor-charts' ),					
							'zoom-out-down' 	=> esc_html__( 'Zoom Out down', 'elementor-charts' ),					
							'zoom-out-left' 	=> esc_html__( 'Zoom Out Left', 'elementor-charts' ),					
							'zoom-out-right' 	=> esc_html__( 'Zoom Out Right', 'elementor-charts' ),
							'flash' 			=> esc_html__( 'Flash', 'elementor-charts' ),
							'strobe'			=> esc_html__( 'Strobe', 'elementor-charts' ),
							'shake-x'			=> esc_html__( 'Shake X', 'elementor-charts' ),
							'shake-y'			=> esc_html__( 'Shake Y', 'elementor-charts' ),
							'bounce' 			=> esc_html__( 'Bounce', 'elementor-charts' ),
							'tada'				=> esc_html__( 'Tada', 'elementor-charts' ),
							'rubber-band'		=> esc_html__( 'Rubber Band', 'elementor-charts' ),
							'swing' 			=> esc_html__( 'Swing', 'elementor-charts' ),
							'spin'				=> esc_html__( 'Spin', 'elementor-charts' ),
							'spin-reverse'		=> esc_html__( 'Spin Reverse', 'elementor-charts' ),
							'slingshot'			=> esc_html__( 'Slingshot', 'elementor-charts' ),
							'slingshot-reverse'	=> esc_html__( 'Slingshot Reverse', 'elementor-charts' ),
							'wobble'			=> esc_html__( 'Wobble', 'elementor-charts' ),
							'pulse' 			=> esc_html__( 'Pulse', 'elementor-charts' ),
							'pulsate'			=> esc_html__( 'Pulsate', 'elementor-charts' ),
							'heartbeat'			=> esc_html__( 'Heartbeat', 'elementor-charts' ),
							'panic' 			=> esc_html__( 'Panic', 'elementor-charts' )				
				],
				'condition'	=> [
					'addon_animate'	=> 'on'
				]
			]
		);			

		$this->add_control(
			'delay',
			[
				'label' => esc_html__( 'Animate Delay (ms)', 'elementor-charts' ),
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
				'label' => esc_html__( 'Style', 'elementor-charts' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'style',
			[
				'label' => esc_html__( 'Style', 'elementor-charts' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => [
					'style1'	=> esc_html__( 'Style 1', 'elementor-charts' ),
					'style2' 	=> esc_html__( 'Style 2', 'elementor-charts' )				
				]
			]
		);

		$this->add_control(
			'bar_color',
			[
				'label' => esc_html__( 'Bar Color', 'elementor-charts' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FC615D'
			]
		);


		$this->add_control(
			'bg_bar_color',
			[
				'label' => esc_html__( 'Background Bar Color', 'elementor-charts' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#00FFFF'
			]
		);

		$this->add_control(
			'bg_number_color',
			[
				'label' => esc_html__( 'Bg Number Color', 'elementor-charts' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FF0000',
				'condition'	=> [
					'style'	=> 'style1'
				]
			]
		);

		$this->add_control(
			'number_color',
			[
				'label' => esc_html__( 'Number Color', 'elementor-charts' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#00FFFF'
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

		$bar_color					= esc_html($settings['bar_color']);
		$bg_bar_color				= esc_html($settings['bg_bar_color']);
		$bg_number_color			= esc_html($settings['bg_number_color']);
		$number_color				= esc_html($settings['number_color']);
		$percent					= esc_html($settings['percent']);
		$width						= esc_html($settings['width']);
		$style						= esc_html($settings['style']);
		
		// Animations
		$addon_animate			= esc_html($settings['addon_animate']);
		$effect					= esc_html($settings['effect']);
		$delay					= esc_html($settings['delay']);
		
		wp_enqueue_script( 'easypiechart' );
		wp_enqueue_style( 'animations' );
		wp_enqueue_script( 'appear' );			
		wp_enqueue_script( 'animate' );
		
		if($style == 'style1') : $css_style = 'style="background:'.esc_html($bg_number_color).';"'; else : $css_style = ''; endif;
		
       echo '<div class="chartselementor chartselementor-bar-chart chartselementor-bar-main-container chartselementor-bar-chart-'.esc_html($style).' '.ewmp_animate_class($addon_animate,$effect,$delay).' style="width:'.esc_html($width).';color:'.esc_html($number_color).';">';
			
			echo '<div class="chartselementor-bar-chart-wrap">
							<div class="chartselementor-bar-percentage" data-percentage="'.esc_html($percent).'" '.$css_style.'></div>
							<div class="chartselementor-bar-container" style="background:'.esc_html($bg_bar_color).'">
								<div class="chartselementor-bar" style="background:'.esc_html($bar_color).'"></div>
							</div>
						</div>';

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
