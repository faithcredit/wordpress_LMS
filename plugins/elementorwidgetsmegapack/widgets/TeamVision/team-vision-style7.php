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
 * Elementor Team Vision
 *
 * Elementor widget for team vision
 *
 * @since 1.0.0
 */
class Team_Vision_Style7 extends Widget_Base {

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
		return 'team-vision-style7';
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
		return esc_html__( 'Team Vision Style 7', 'elementorwidgetsmegapack' );
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
		return 'eicon-person';
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
  			'section_settings',
  			[
  				'label' => esc_html__( 'Settings', 'elementorwidgetsmegapack' )
  			]
		);

		$this->add_control(
			'columns',
			[
				'label' => esc_html__( 'Columns', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => '2',
				'options' => [
					'1'	=> '1',
					'2' => '2',					
					'3' => '3',					
					'4' => '4'					
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
			'title_color',
			[
				'label' => esc_html__( 'Title Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
				'condition'	=> [
					'custom_style'	=> 'on'
				]
			]
		);

		$this->add_control(
			'role_color',
			[
				'label' => esc_html__( 'Role Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#000000',
				'condition'	=> [
					'custom_style'	=> 'on'
				]
			]
		);
		
		$this->add_control(
			'social_color',
			[
				'label' => esc_html__( 'Social Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
				'condition'	=> [
					'custom_style'	=> 'on'
				]
			]
		);

		$this->add_control(
			'h_color',
			[
				'label' => esc_html__( 'Social Hover Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#333333',
				'condition'	=> [
					'custom_style'	=> 'on'
				]
			]
		);

		$this->end_controls_section();
		
		
		$this->end_controls_section();

		$this->start_controls_section(
			'section_elements',
			[
				'label' => esc_html__( 'Team Members', 'elementorwidgetsmegapack' ), // Section display name
			]
		);
		
		$this->add_control(
			'elements',
			[
				'label' => esc_html__( 'Add Member', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => [
					[
						'name' => 'image_user',
						'label' => esc_html__( 'Image User Team', 'elementorwidgetsmegapack' ),
						'type' => \Elementor\Controls_Manager::MEDIA,
						'label_block' => true						
					],
					[
						'name' => 'name',
						'label' => esc_html__( 'Name', 'elementorwidgetsmegapack' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true					
					],
					[
						'name' => 'role',
						'label' => esc_html__( 'Role', 'elementorwidgetsmegapack' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true					
					],						
					[
						'name' => 'social',
						'label' => esc_html__( 'Social', 'elementorwidgetsmegapack' ),
						'type' => Controls_Manager::SELECT,
						'default' => 'on',
						'options' => [
							'on'	=> esc_html__('On','elementorwidgetsmegapack'),
							'off' 	=> esc_html__('Off','elementorwidgetsmegapack')					
						]
					],						
					[
						'name' => 'social_target',
						'label' => esc_html__( 'Social Target', 'elementorwidgetsmegapack' ),
						'type' => Controls_Manager::SELECT,
						'default' => '_blank',
						'options' => [
							'_blank'	=> esc_html__('Blank (new window)','elementorwidgetsmegapack'),
							'_self' 	=> esc_html__('Self (Same window)','elementorwidgetsmegapack')					
						],
						'label_block' => true,
						'condition'	=> [
							'social'	=> 'on'
						]
					],
					[
						'name' => 'social_icon_1',
						'label' => esc_html__( 'Social Icons', 'elementorwidgetsmegapack' ),
						'type' => \Elementor\Controls_Manager::ICON,
						'default' => 'fa fa-facebook',
						'condition'	=> [
							'social'	=> 'on'
						]
					],
					[
						'name' => 'url_social_1',
						'label' => esc_html__( 'Url Social', 'elementorwidgetsmegapack' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
						'condition'	=> [
							'social'	=> 'on'
						]					
					],	
					[
						'name' => 'social_icon_2',
						'label' => esc_html__( 'Social Icons 2', 'elementorwidgetsmegapack' ),
						'type' => \Elementor\Controls_Manager::ICON,
						'default' => 'fa fa-facebook',
						'condition'	=> [
							'social'	=> 'on'
						]
					],
					[
						'name' => 'url_social_2',
						'label' => esc_html__( 'Url Social 2', 'elementorwidgetsmegapack' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
						'condition'	=> [
							'social'	=> 'on'
						]					
					],
					[
						'name' => 'social_icon_3',
						'label' => esc_html__( 'Social Icons 3', 'elementorwidgetsmegapack' ),
						'type' => \Elementor\Controls_Manager::ICON,
						'default' => 'fa fa-facebook',
						'condition'	=> [
							'social'	=> 'on'
						]
					],
					[
						'name' => 'url_social_3',
						'label' => esc_html__( 'Url Social 3', 'elementorwidgetsmegapack' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
						'condition'	=> [
							'social'	=> 'on'
						]					
					],
					[
						'name' => 'social_icon_4',
						'label' => esc_html__( 'Social Icons 4', 'elementorwidgetsmegapack' ),
						'type' => \Elementor\Controls_Manager::ICON,
						'default' => 'fa fa-facebook',
						'condition'	=> [
							'social'	=> 'on'
						]
					],
					[
						'name' => 'url_social_4',
						'label' => esc_html__( 'Url Social', 'elementorwidgetsmegapack' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
						'condition'	=> [
							'social'	=> 'on'
						]					
					],
					[
						'name' => 'social_icon_5',
						'label' => esc_html__( 'Social Icons 5', 'elementorwidgetsmegapack' ),
						'type' => \Elementor\Controls_Manager::ICON,
						'default' => 'fa fa-facebook',
						'condition'	=> [
							'social'	=> 'on'
						]
					],
					[
						'name' => 'url_social_5',
						'label' => esc_html__( 'Url Social 5', 'elementorwidgetsmegapack' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
						'condition'	=> [
							'social'	=> 'on'
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
				'title_field' => '{{{ name }}}',
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
	
		$columns			= esc_html($settings['columns']);
		$custom_style 		= esc_html($settings['custom_style']);
		$title_color		= esc_html($settings['title_color']);
		$role_color			= esc_html($settings['role_color']);
		$social_color		= esc_html($settings['social_color']);
		$h_color			= esc_html($settings['h_color']);
		
		wp_enqueue_style( 'fonts-vc' );
		wp_enqueue_style( 'animations' );					
		wp_enqueue_style( 'teamvision' );
		wp_enqueue_script( 'teamvision' );
		wp_enqueue_style( 'font-awesome' );
		wp_enqueue_style( 'elementor-editor' );
		wp_enqueue_style( 'elementor-icons' );	
		wp_enqueue_style( 'fontawesome' );						

		if($custom_style == 'on') :
		
			$css_style_to_append = "<style>
			.teamvision-team-style7-".esc_html($instance)." .teamvision-team-name, 
			.teamvision-team-style7-".esc_html($instance)." .teamvision-team-container-wrap span.teamvision-team-name { color:".esc_html($title_color).";}
			.teamvision-team-style7-".esc_html($instance)." .teamvision-team-container-wrap span.teamvision-team-role { color:".esc_html($role_color).";}
			.teamvision-team-style7-".esc_html($instance)." .teamvision-team-social-container a { color:".esc_html($social_color).";}
			.teamvision-team-style7-".esc_html($instance)." a:hover { color:".esc_html($h_color)."; }
			</style>";
			$data_value = 'data-teamvision-custom-css="'.$css_style_to_append.'"';
			$js_class = 'teamvision-custom-js';
		
		else :

			$js_class = $data_value = '';

		endif;
		
			echo '<div '.$data_value.' class="teamvision teamvision-team-style7 teamvision-team-col-'.esc_html($columns).' teamvision-team-style7-'.esc_html($instance).' '.esc_html($js_class).'">';
							
							
			foreach ( $settings['elements'] as $element ) {
				$team_image_array = wp_get_attachment_image_src( $element['image_user']['id'], 'ewmp-large');
				echo '<div class="teamvision-team teamvision-item-'.esc_html($instance).ewmp_animate_class($element['addon_animate'],$element['effect'],$element['delay']).'>';
					echo '<div class="teamvision-team-container" style="background-image:url('.esc_url($team_image_array[0]).');">';
								echo '<div class="teamvision-team-container-wrap">';
												
					echo '<div class="teamvision-team-social-container">';
						if($element['url_social_1']) :										
							echo '<a href="'.esc_url($element['url_social_1']).'" class="'.esc_html($element['social_icon_1']).'" target="'.esc_html($element['social_target']).'"></a>';   
						endif;
						if($element['url_social_2']) :							
							echo '<a href="'.esc_url($element['url_social_2']).'" class="'.esc_html($element['social_icon_2']).'" target="'.esc_html($element['social_target']).'"></a>';   
						endif;
						if($element['url_social_3']) :			
							echo '<a href="'.esc_url($element['url_social_3']).'" class="'.esc_html($element['social_icon_3']).'" target="'.esc_html($element['social_target']).'"></a>';
						endif;
						if($element['url_social_4']) :			
							echo '<a href="'.esc_url($element['url_social_4']).'" class="'.esc_html($element['social_icon_4']).'" target="'.esc_html($element['social_target']).'"></a>';
						endif;
						if($element['url_social_5']) :			
							echo '<a href="'.esc_url($element['url_social_5']).'" class="'.esc_html($element['social_icon_5']).'" target="'.esc_html($element['social_target']).'"></a>';
						endif;	
					echo '</div>';		
					echo '</div></div>
							<span class="teamvision-team-name">'.esc_html($element['name']).'</span>
							<span class="teamvision-team-role">'.esc_html($element['role']).'</span>					
					</div>';							
			}

			echo '<div class="teamvision-clear"></div></div>';
		
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
