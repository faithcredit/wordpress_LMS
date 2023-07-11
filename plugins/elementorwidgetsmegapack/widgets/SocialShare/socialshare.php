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
 * Elementor SocialShare
 *
 * Elementor widget for team vision
 *
 * @since 1.0.0
 */
class SocialShare extends Widget_Base {

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
		return 'adte-social-share';
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
		return esc_html__( 'Social Share', 'elementorwidgetsmegapack' );
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
		return 'eicon-share';
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
				'label' => esc_html__( 'SocialShare', 'elementorwidgetsmegapack' ),
			]
		);

		$this->add_control(
			'facebook',
			[
				'label' => esc_html__( 'Facebook', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'elementorwidgetsmegapack' ),
				'label_off' => esc_html__( 'Off', 'elementorwidgetsmegapack' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'twitter',
			[
				'label' => esc_html__( 'Twitter', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'elementorwidgetsmegapack' ),
				'label_off' => esc_html__( 'Off', 'elementorwidgetsmegapack' ),
				'return_value' => 'yes',
				'default' => false,
			]
		);
		
		$this->add_control(
			'pintrest',
			[
				'label' => esc_html__( 'Pintrest', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'elementorwidgetsmegapack' ),
				'label_off' => esc_html__( 'Off', 'elementorwidgetsmegapack' ),
				'return_value' => 'yes',
				'default' => false,
			]
		);

		$this->add_control(
			'linkedin',
			[
				'label' => esc_html__( 'Linkedin', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'elementorwidgetsmegapack' ),
				'label_off' => esc_html__( 'Off', 'elementorwidgetsmegapack' ),
				'return_value' => 'yes',
				'default' => false,
			]
		);		

		$this->add_control(
			'vkontakte',
			[
				'label' => esc_html__( 'VKontakte', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'elementorwidgetsmegapack' ),
				'label_off' => esc_html__( 'Off', 'elementorwidgetsmegapack' ),
				'return_value' => 'yes',
				'default' => false,
			]
		);

		$this->add_control(
			'tumblr',
			[
				'label' => esc_html__( 'Tumblr', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'elementorwidgetsmegapack' ),
				'label_off' => esc_html__( 'Off', 'elementorwidgetsmegapack' ),
				'return_value' => 'yes',
				'default' => false,
			]
		);

		$this->add_control(
			'blogger',
			[
				'label' => esc_html__( 'Blogger', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'elementorwidgetsmegapack' ),
				'label_off' => esc_html__( 'Off', 'elementorwidgetsmegapack' ),
				'return_value' => 'yes',
				'default' => false,
			]
		);
		
		$this->add_control(
			'digg',
			[
				'label' => esc_html__( 'Digg', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'elementorwidgetsmegapack' ),
				'label_off' => esc_html__( 'Off', 'elementorwidgetsmegapack' ),
				'return_value' => 'yes',
				'default' => false,
			]
		);

		$this->add_control(
			'reddit',
			[
				'label' => esc_html__( 'Reddit', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'elementorwidgetsmegapack' ),
				'label_off' => esc_html__( 'Off', 'elementorwidgetsmegapack' ),
				'return_value' => 'yes',
				'default' => false,
			]
		);		

		$this->add_control(
			'delicious',
			[
				'label' => esc_html__( 'Delicious', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'elementorwidgetsmegapack' ),
				'label_off' => esc_html__( 'Off', 'elementorwidgetsmegapack' ),
				'return_value' => 'yes',
				'default' => false,
			]
		);

		$this->add_control(
			'wordpress',
			[
				'label' => esc_html__( 'WordPress', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'elementorwidgetsmegapack' ),
				'label_off' => esc_html__( 'Off', 'elementorwidgetsmegapack' ),
				'return_value' => 'yes',
				'default' => false,
			]
		);

		$this->add_control(
			'skype',
			[
				'label' => esc_html__( 'Skype', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'elementorwidgetsmegapack' ),
				'label_off' => esc_html__( 'Off', 'elementorwidgetsmegapack' ),
				'return_value' => 'yes',
				'default' => false,
			]
		);

		$this->add_control(
			'telegram',
			[
				'label' => esc_html__( 'Telegram', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'elementorwidgetsmegapack' ),
				'label_off' => esc_html__( 'Off', 'elementorwidgetsmegapack' ),
				'return_value' => 'yes',
				'default' => false,
			]
		);
		
		$this->add_control(
			'whatsapp',
			[
				'label' => esc_html__( 'Whatsapp', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'elementorwidgetsmegapack' ),
				'label_off' => esc_html__( 'Off', 'elementorwidgetsmegapack' ),
				'return_value' => 'yes',
				'default' => false,
			]
		);

		$this->add_control(
			'wechat',
			[
				'label' => esc_html__( 'WeChat', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'elementorwidgetsmegapack' ),
				'label_off' => esc_html__( 'Off', 'elementorwidgetsmegapack' ),
				'return_value' => 'yes',
				'default' => false,
			]
		);

		$this->add_control(
			'line',
			[
				'label' => esc_html__( 'Line', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'elementorwidgetsmegapack' ),
				'label_off' => esc_html__( 'Off', 'elementorwidgetsmegapack' ),
				'return_value' => 'yes',
				'default' => false,
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
			'style',
			[
				'label' => esc_html__( 'Style', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default'		=> esc_html__( 'Default Style', 'elementorwidgetsmegapack' ),
					'only-icons' 	=> esc_html__( 'Only Icons', 'elementorwidgetsmegapack' ),				
					'only-text' 	=> esc_html__( 'Only Text', 'elementorwidgetsmegapack' ),			
					'boxed' 		=> esc_html__( 'Boxed', 'elementorwidgetsmegapack' ),			
					'border' 		=> esc_html__( 'Border', 'elementorwidgetsmegapack' )			
				]
			]
		);

		$this->add_control(
			'size',
			[
				'label' => esc_html__( 'Size', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'small',
				'options' => [
					'small'		=> esc_html__( 'Small', 'elementorwidgetsmegapack' ),
					'normal' 	=> esc_html__( 'Normal', 'elementorwidgetsmegapack' ),				
					'big' 		=> esc_html__( 'Big', 'elementorwidgetsmegapack' )			
				]
			]
		);

		$this->add_control(
			'border',
			[
				'label' => esc_html__( 'Border', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'normal',
				'options' => [
					'normal'	=> esc_html__( 'Normal', 'elementorwidgetsmegapack' ),
					'rounded' 	=> esc_html__( 'Rounded', 'elementorwidgetsmegapack' ),				
					'circle' 	=> esc_html__( 'Circle', 'elementorwidgetsmegapack' )			
				]
			]
		);

		$this->add_control(
			'custom_color',
			[
				'label' => esc_html__( 'Custom Color', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'off',
				'options' => [
					'off'	=> 'Off',
					'on' 	=> 'On'					
				]
			]
		);

		$this->add_control(
			'background_color',
			[
				'label' => esc_html__( 'Background Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#3b5998',
				'condition'	=> [
					'custom_color'	=> 'on'
				]				
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Text Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
				'condition'	=> [
					'custom_color'	=> 'on'
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
		
        $facebook					= esc_html($settings['facebook']);
        $twitter					= esc_html($settings['twitter']);
        $pintrest					= esc_html($settings['pintrest']);
		$linkedin					= esc_html($settings['linkedin']);
		$vkontakte					= esc_html($settings['vkontakte']);
		$tumblr						= esc_html($settings['tumblr']);
		$blogger					= esc_html($settings['blogger']);		
		$digg						= esc_html($settings['digg']);		
		$reddit						= esc_html($settings['reddit']);		
		$delicious					= esc_html($settings['delicious']);		
		$wordpress					= esc_html($settings['wordpress']);	
		$skype						= esc_html($settings['skype']);		
		$telegram					= esc_html($settings['telegram']);		
		$whatsapp					= esc_html($settings['whatsapp']);		
		$wechat						= esc_html($settings['wechat']);		
		$line						= esc_html($settings['line']);	
		$style						= esc_html($settings['style']);	
		$size						= esc_html($settings['size']);	
		$border						= esc_html($settings['border']);	
		$custom_color				= esc_html($settings['custom_color']);	
		$background_color			= esc_html($settings['background_color']);	
		$title_color				= esc_html($settings['title_color']);	
		$rtl						= esc_html($settings['rtl']);	
		
		// Animations
		$addon_animate				= esc_html($settings['addon_animate']);
		$effect						= esc_html($settings['effect']);
		$delay						= esc_html($settings['delay']);
		
		wp_enqueue_script( 'appear' );			
		wp_enqueue_script( 'animate' );
		wp_enqueue_style( 'animations' );
		wp_enqueue_style( 'socialshare-style' );
		
		$title = get_the_title();
		$url = get_the_permalink();
		
		if($custom_color == 'on') {
			echo '<style type="text/css">
				#adte-social-share-'.esc_html($instance).'.adte-social-share a {
					color:'.esc_html($title_color).'!important;
					background-color:'.esc_html($background_color).'!important;
					border:2px solid '.esc_html($background_color).'!important;
				}
				#adte-social-share-'.esc_html($instance).'.adte-social-share-boxed a .adte-social-share-text {
					color:'.esc_html($title_color).'!important;
					background-color:'.esc_html($background_color).'!important;
				}
			</style>';
			
		}
		
		
		echo '<div id="adte-social-share-'.esc_html($instance).'" class="adte-social-share adte-social-share-'.esc_html($instance).' adte-social-share-size-'.esc_html($size).' adte-social-share-border-'.esc_html($border).' adte-social-share-'.esc_html($style).' adte-social-share-'.esc_html($rtl).' '.ewmp_animate_class($addon_animate,$effect,$delay).'>';
			
			if($style == 'default') {

				if($facebook == 'yes') { echo '<a target="_blank" class="adte-facebook" href="http://www.facebook.com/sharer.php?u='.get_the_permalink().'&amp;t='.get_the_title().'"><i class="adte-icon fa-facebook-f"></i><span class="adte-social-share-text">'.esc_html__('Facebook','elementorwidgetsmegapack').'</span></a>'; }
				if($twitter == 'yes') { echo '<a target="_blank" class="adte-twitter" href="http://twitter.com/home?status='.get_the_permalink().'"><i class="adte-icon fa-twitter"></i><span class="adte-social-share-text">'.esc_html__('Twitter','elementorwidgetsmegapack').'</span></a>'; }
				if($pintrest == 'yes') { echo '<a target="_blank" class="adte-pintrest" href="http://pinterest.com/pin/create/button/?url='.get_the_permalink().'"><i class="adte-icon fa-pinterest-p"></i><span class="adte-social-share-text">'.esc_html__('Pintrest','elementorwidgetsmegapack').'</span></a>'; }
				if($linkedin == 'yes') { echo '<a target="_blank" class="adte-linkedin" href="http://www.linkedin.com/shareArticle?mini=true&amp;url='.get_the_permalink().'"><i class="adte-icon fa-linkedin-in"></i><span class="adte-social-share-text">'.esc_html__('Linkedin','elementorwidgetsmegapack').'</span></a>'; }
				if($vkontakte == 'yes') { echo '<a target="_blank" class="adte-vkontakte" href="http://vk.com/share.php?url='.esc_url($url).'&title='.esc_html($title).'"><i class="adte-icon fa-vk"></i><span class="adte-social-share-text">'.esc_html__('Vkontakte','elementorwidgetsmegapack').'</span></a>'; }
				if($tumblr == 'yes') { echo '<a target="_blank" class="adte-tumblr" href="https://www.tumblr.com/share/link?url='.esc_url($url).'&name='.esc_html($title).'"><i class="adte-icon fa-tumblr"></i><span class="adte-social-share-text">'.esc_html__('Tumblr','elementorwidgetsmegapack').'</span></a>'; }
				if($blogger == 'yes') { echo '<a target="_blank" class="adte-blogger" href="https://www.blogger.com/blog-this.g?u='.esc_url($url).'&n='.esc_html($title).'"><i class="adte-icon fa-blogger-b"></i><span class="adte-social-share-text">'.esc_html__('Blogger','elementorwidgetsmegapack').'</span></a>'; }
				if($digg == 'yes') { echo '<a target="_blank" class="adte-digg" href="http://digg.com/submit?url='.esc_url($url).'&title='.esc_html($title).'"><i class="adte-icon fa-digg"></i><span class="adte-social-share-text">'.esc_html__('Digg','elementorwidgetsmegapack').'</span></a>'; }
				if($reddit == 'yes') { echo '<a target="_blank" class="adte-reddit" href="https://reddit.com/submit?url='.esc_url($url).'&title='.esc_html($title).'"><i class="adte-icon fa-reddit"></i><span class="adte-social-share-text">'.esc_html__('Reddit','elementorwidgetsmegapack').'</span></a>'; }
				if($delicious == 'yes') { echo '<a target="_blank" class="adte-delicious" href="https://www.evernote.com/clip.action?url='.esc_url($url).'&title='.esc_html($title).'"><i class="adte-icon fa-delicious"></i><span class="adte-social-share-text">'.esc_html__('Delicious','elementorwidgetsmegapack').'</span></a>'; }
				if($wordpress == 'yes') { echo '<a target="_blank" class="adte-wordpress" href="https://wordpress.com/press-this.php?u='.esc_url($url).'&t='.esc_html($title).'"><i class="adte-icon fa-wordpress"></i><span class="adte-social-share-text">'.esc_html__('WordPress','elementorwidgetsmegapack').'</span></a>'; }
				if($skype == 'yes') { echo '<a target="_blank" class="adte-skype" href="https://web.skype.com/share?url='.esc_url($url).'&text='.esc_html($title).'"><i class="adte-icon fa-skype"></i><span class="adte-social-share-text">'.esc_html__('Skype','elementorwidgetsmegapack').'</span></a>'; }
				if($telegram == 'yes') { echo '<a target="_blank" class="adte-telegram" href="https://t.me/share/url?url='.esc_url($url).'&text='.esc_html($title).'"><i class="adte-icon fa-telegram-plane"></i><span class="adte-social-share-text">'.esc_html__('Telegram','elementorwidgetsmegapack').'</span></a>'; }
				if($whatsapp == 'yes') { echo '<a target="_blank" class="adte-whatsapp" href="https://api.whatsapp.com/send?phone=&text='.esc_html($title)." ".esc_url($url).'"><i class="adte-icon fa-whatsapp"></i><span class="adte-social-share-text">'.esc_html__('Whatsapp','elementorwidgetsmegapack').'</span></a>'; }
				if($wechat == 'yes') { echo '<a target="_blank" class="adte-wechat" href="https://chart.googleapis.com/chart?cht=qr&chs=196x196&chd=t:60,40&chl='.esc_url($url).'"><i class="adte-icon fa-weixin"></i><span class="adte-social-share-text">'.esc_html__('Wechat','elementorwidgetsmegapack').'</span></a>'; }
				if($line == 'yes') { echo '<a target="_blank" class="adte-line" href="ttps://lineit.line.me/share/ui?url='.esc_url($url).'&text='.esc_html($title).'"><i class="adte-icon fa-line"></i><span class="adte-social-share-text">'.esc_html__('Line','elementorwidgetsmegapack').'</span></a>'; }
				
			}
			
			if($style == 'only-icons') {
			
				if($facebook == 'yes') { echo '<a target="_blank" class="adte-facebook" href="http://www.facebook.com/sharer.php?u='.get_the_permalink().'&amp;t='.get_the_title().'"><i class="adte-icon fa-facebook-f"></i></a>'; }
				if($twitter == 'yes') { echo '<a target="_blank" class="adte-twitter" href="http://twitter.com/home?status='.get_the_permalink().'"><i class="adte-icon fa-twitter"></i></a>'; }
				if($pintrest == 'yes') { echo '<a target="_blank" class="adte-pintrest" href="http://pinterest.com/pin/create/button/?url='.get_the_permalink().'"><i class="adte-icon fa-pinterest-p"></i></a>'; }
				if($linkedin == 'yes') { echo '<a target="_blank" class="adte-linkedin" href="http://www.linkedin.com/shareArticle?mini=true&amp;url='.get_the_permalink().'"><i class="adte-icon fa-linkedin-in"></i></a>'; }
				if($vkontakte == 'yes') { echo '<a target="_blank" class="adte-vkontakte" href="http://vk.com/share.php?url='.esc_url($url).'&title='.esc_html($title).'"><i class="adte-icon fa-vk"></i></a>'; }
				if($tumblr == 'yes') { echo '<a target="_blank" class="adte-tumblr" href="https://www.tumblr.com/share/link?url='.esc_url($url).'&name='.esc_html($title).'"><i class="adte-icon fa-tumblr"></i></a>'; }
				if($blogger == 'yes') { echo '<a target="_blank" class="adte-blogger" href="https://www.blogger.com/blog-this.g?u='.esc_url($url).'&n='.esc_html($title).'"><i class="adte-icon fa-blogger-b"></i></a>'; }
				if($digg == 'yes') { echo '<a target="_blank" class="adte-digg" href="http://digg.com/submit?url='.esc_url($url).'&title='.esc_html($title).'"><i class="adte-icon fa-digg"></i></a>'; }
				if($reddit == 'yes') { echo '<a target="_blank" class="adte-reddit" href="https://reddit.com/submit?url='.esc_url($url).'&title='.esc_html($title).'"><i class="adte-icon fa-reddit"></i></a>'; }
				if($delicious == 'yes') { echo '<a target="_blank" class="adte-delicious" href="https://www.evernote.com/clip.action?url='.esc_url($url).'&title='.esc_html($title).'"><i class="adte-icon fa-delicious"></i></a>'; }
				if($wordpress == 'yes') { echo '<a target="_blank" class="adte-wordpress" href="https://wordpress.com/press-this.php?u='.esc_url($url).'&t='.esc_html($title).'"><i class="adte-icon fa-wordpress"></i></a>'; }
				if($skype == 'yes') { echo '<a target="_blank" class="adte-skype" href="https://web.skype.com/share?url='.esc_url($url).'&text='.esc_html($title).'"><i class="adte-icon fa-skype"></i></a>'; }
				if($telegram == 'yes') { echo '<a target="_blank" class="adte-telegram" href="https://t.me/share/url?url='.esc_url($url).'&text='.esc_html($title).'"><i class="adte-icon fa-telegram-plane"></i></a>'; }
				if($whatsapp == 'yes') { echo '<a target="_blank" class="adte-whatsapp" href="https://api.whatsapp.com/send?phone=&text='.esc_html($title)." ".esc_url($url).'"><i class="adte-icon fa-whatsapp"></i></a>'; }
				if($wechat == 'yes') { echo '<a target="_blank" class="adte-wechat" href="https://chart.googleapis.com/chart?cht=qr&chs=196x196&chd=t:60,40&chl='.esc_url($url).'"><i class="adte-icon fa-weixin"></i></a>'; }
				if($line == 'yes') { echo '<a target="_blank" class="adte-line" href="ttps://lineit.line.me/share/ui?url='.esc_url($url).'&text='.esc_html($title).'"><i class="adte-icon fa-line"></i></a>'; }

			}
			
			if($style == 'only-text') {

				if($facebook == 'yes') { echo '<a target="_blank" class="adte-facebook" href="http://www.facebook.com/sharer.php?u='.get_the_permalink().'&amp;t='.get_the_title().'"><span class="adte-social-share-text">'.esc_html__('Facebook','elementorwidgetsmegapack').'</span></a>'; }
				if($twitter == 'yes') { echo '<a target="_blank" class="adte-twitter" href="http://twitter.com/home?status='.get_the_permalink().'"><span class="adte-social-share-text">'.esc_html__('Twitter','elementorwidgetsmegapack').'</span></a>'; }
				if($pintrest == 'yes') { echo '<a target="_blank" class="adte-pintrest" href="http://pinterest.com/pin/create/button/?url='.get_the_permalink().'"><span class="adte-social-share-text">'.esc_html__('Pintrest','elementorwidgetsmegapack').'</span></a>'; }
				if($linkedin == 'yes') { echo '<a target="_blank" class="adte-linkedin" href="http://www.linkedin.com/shareArticle?mini=true&amp;url='.get_the_permalink().'"><span class="adte-social-share-text">'.esc_html__('Linkedin','elementorwidgetsmegapack').'</span></a>'; }
				if($vkontakte == 'yes') { echo '<a target="_blank" class="adte-vkontakte" href="http://vk.com/share.php?url='.esc_url($url).'&title='.esc_html($title).'"><span class="adte-social-share-text">'.esc_html__('Vkontakte','elementorwidgetsmegapack').'</span></a>'; }
				if($tumblr == 'yes') { echo '<a target="_blank" class="adte-tumblr" href="https://www.tumblr.com/share/link?url='.esc_url($url).'&name='.esc_html($title).'"><span class="adte-social-share-text">'.esc_html__('Tumblr','elementorwidgetsmegapack').'</span></a>'; }
				if($blogger == 'yes') { echo '<a target="_blank" class="adte-blogger" href="https://www.blogger.com/blog-this.g?u='.esc_url($url).'&n='.esc_html($title).'"><span class="adte-social-share-text">'.esc_html__('Blogger','elementorwidgetsmegapack').'</span></a>'; }
				if($digg == 'yes') { echo '<a target="_blank" class="adte-digg" href="http://digg.com/submit?url='.esc_url($url).'&title='.esc_html($title).'"><span class="adte-social-share-text">'.esc_html__('Digg','elementorwidgetsmegapack').'</span></a>'; }
				if($reddit == 'yes') { echo '<a target="_blank" class="adte-reddit" href="https://reddit.com/submit?url='.esc_url($url).'&title='.esc_html($title).'"><span class="adte-social-share-text">'.esc_html__('Reddit','elementorwidgetsmegapack').'</span></a>'; }
				if($delicious == 'yes') { echo '<a target="_blank" class="adte-delicious" href="https://www.evernote.com/clip.action?url='.esc_url($url).'&title='.esc_html($title).'"><span class="adte-social-share-text">'.esc_html__('Delicious','elementorwidgetsmegapack').'</span></a>'; }
				if($wordpress == 'yes') { echo '<a target="_blank" class="adte-wordpress" href="https://wordpress.com/press-this.php?u='.esc_url($url).'&t='.esc_html($title).'"><span class="adte-social-share-text">'.esc_html__('WordPress','elementorwidgetsmegapack').'</span></a>'; }
				if($skype == 'yes') { echo '<a target="_blank" class="adte-skype" href="https://web.skype.com/share?url='.esc_url($url).'&text='.esc_html($title).'"><span class="adte-social-share-text">'.esc_html__('Skype','elementorwidgetsmegapack').'</span></a>'; }
				if($telegram == 'yes') { echo '<a target="_blank" class="adte-telegram" href="https://t.me/share/url?url='.esc_url($url).'&text='.esc_html($title).'"><span class="adte-social-share-text">'.esc_html__('Telegram','elementorwidgetsmegapack').'</span></a>'; }
				if($whatsapp == 'yes') { echo '<a target="_blank" class="adte-whatsapp" href="https://api.whatsapp.com/send?phone=&text='.esc_html($title)." ".esc_url($url).'"><span class="adte-social-share-text">'.esc_html__('Whatsapp','elementorwidgetsmegapack').'</span></a>'; }
				if($wechat == 'yes') { echo '<a target="_blank" class="adte-wechat" href="https://chart.googleapis.com/chart?cht=qr&chs=196x196&chd=t:60,40&chl='.esc_url($url).'"><span class="adte-social-share-text">'.esc_html__('Wechat','elementorwidgetsmegapack').'</span></a>'; }
				if($line == 'yes') { echo '<a target="_blank" class="adte-line" href="ttps://lineit.line.me/share/ui?url='.esc_url($url).'&text='.esc_html($title).'"><span class="adte-social-share-text">'.esc_html__('Line','elementorwidgetsmegapack').'</span></a>'; }
				
				
			}			

			if($style == 'boxed') {

				if($facebook == 'yes') { echo '<a target="_blank" class="adte-facebook" href="http://www.facebook.com/sharer.php?u='.get_the_permalink().'&amp;t='.get_the_title().'"><i class="adte-icon fa-facebook-f"></i><span class="adte-social-share-text">'.esc_html__('Facebook','elementorwidgetsmegapack').'</span></a>'; }
				if($twitter == 'yes') { echo '<a target="_blank" class="adte-twitter" href="http://twitter.com/home?status='.get_the_permalink().'"><i class="adte-icon fa-twitter"></i><span class="adte-social-share-text">'.esc_html__('Twitter','elementorwidgetsmegapack').'</span></a>'; }
				if($pintrest == 'yes') { echo '<a target="_blank" class="adte-pintrest" href="http://pinterest.com/pin/create/button/?url='.get_the_permalink().'"><i class="adte-icon fa-pinterest-p"></i><span class="adte-social-share-text">'.esc_html__('Pintrest','elementorwidgetsmegapack').'</span></a>'; }
				if($linkedin == 'yes') { echo '<a target="_blank" class="adte-linkedin" href="http://www.linkedin.com/shareArticle?mini=true&amp;url='.get_the_permalink().'"><i class="adte-icon fa-linkedin-in"></i><span class="adte-social-share-text">'.esc_html__('Linkedin','elementorwidgetsmegapack').'</span></a>'; }
				if($vkontakte == 'yes') { echo '<a target="_blank" class="adte-vkontakte" href="http://vk.com/share.php?url='.esc_url($url).'&title='.esc_html($title).'"><i class="adte-icon fa-vk"></i><span class="adte-social-share-text">'.esc_html__('Vkontakte','elementorwidgetsmegapack').'</span></a>'; }
				if($tumblr == 'yes') { echo '<a target="_blank" class="adte-tumblr" href="https://www.tumblr.com/share/link?url='.esc_url($url).'&name='.esc_html($title).'"><i class="adte-icon fa-tumblr"></i><span class="adte-social-share-text">'.esc_html__('Tumblr','elementorwidgetsmegapack').'</span></a>'; }
				if($blogger == 'yes') { echo '<a target="_blank" class="adte-blogger" href="https://www.blogger.com/blog-this.g?u='.esc_url($url).'&n='.esc_html($title).'"><i class="adte-icon fa-blogger-b"></i><span class="adte-social-share-text">'.esc_html__('Blogger','elementorwidgetsmegapack').'</span></a>'; }
				if($digg == 'yes') { echo '<a target="_blank" class="adte-digg" href="http://digg.com/submit?url='.esc_url($url).'&title='.esc_html($title).'"><i class="adte-icon fa-digg"></i><span class="adte-social-share-text">'.esc_html__('Digg','elementorwidgetsmegapack').'</span></a>'; }
				if($reddit == 'yes') { echo '<a target="_blank" class="adte-reddit" href="https://reddit.com/submit?url='.esc_url($url).'&title='.esc_html($title).'"><i class="adte-icon fa-reddit"></i><span class="adte-social-share-text">'.esc_html__('Reddit','elementorwidgetsmegapack').'</span></a>'; }
				if($delicious == 'yes') { echo '<a target="_blank" class="adte-delicious" href="https://www.evernote.com/clip.action?url='.esc_url($url).'&title='.esc_html($title).'"><i class="adte-icon fa-delicious"></i><span class="adte-social-share-text">'.esc_html__('Delicious','elementorwidgetsmegapack').'</span></a>'; }
				if($wordpress == 'yes') { echo '<a target="_blank" class="adte-wordpress" href="https://wordpress.com/press-this.php?u='.esc_url($url).'&t='.esc_html($title).'"><i class="adte-icon fa-wordpress"></i><span class="adte-social-share-text">'.esc_html__('WordPress','elementorwidgetsmegapack').'</span></a>'; }
				if($skype == 'yes') { echo '<a target="_blank" class="adte-skype" href="https://web.skype.com/share?url='.esc_url($url).'&text='.esc_html($title).'"><i class="adte-icon fa-skype"></i><span class="adte-social-share-text">'.esc_html__('Skype','elementorwidgetsmegapack').'</span></a>'; }
				if($telegram == 'yes') { echo '<a target="_blank" class="adte-telegram" href="https://t.me/share/url?url='.esc_url($url).'&text='.esc_html($title).'"><i class="adte-icon fa-telegram-plane"></i><span class="adte-social-share-text">'.esc_html__('Telegram','elementorwidgetsmegapack').'</span></a>'; }
				if($whatsapp == 'yes') { echo '<a target="_blank" class="adte-whatsapp" href="https://api.whatsapp.com/send?phone=&text='.esc_html($title)." ".esc_url($url).'"><i class="adte-icon fa-whatsapp"></i><span class="adte-social-share-text">'.esc_html__('Whatsapp','elementorwidgetsmegapack').'</span></a>'; }
				if($wechat == 'yes') { echo '<a target="_blank" class="adte-wechat" href="https://chart.googleapis.com/chart?cht=qr&chs=196x196&chd=t:60,40&chl='.esc_url($url).'"><i class="adte-icon fa-weixin"></i><span class="adte-social-share-text">'.esc_html__('Wechat','elementorwidgetsmegapack').'</span></a>'; }
				if($line == 'yes') { echo '<a target="_blank" class="adte-line" href="ttps://lineit.line.me/share/ui?url='.esc_url($url).'&text='.esc_html($title).'"><i class="adte-icon fa-line"></i><span class="adte-social-share-text">'.esc_html__('Line','elementorwidgetsmegapack').'</span></a>'; }
								
			}

			if($style == 'border') {

				if($facebook == 'yes') { echo '<a target="_blank" class="adte-facebook" href="http://www.facebook.com/sharer.php?u='.get_the_permalink().'&amp;t='.get_the_title().'"><i class="adte-icon fa-facebook-f"></i><span class="adte-social-share-text">'.esc_html__('Facebook','elementorwidgetsmegapack').'</span></a>'; }
				if($twitter == 'yes') { echo '<a target="_blank" class="adte-twitter" href="http://twitter.com/home?status='.get_the_permalink().'"><i class="adte-icon fa-twitter"></i><span class="adte-social-share-text">'.esc_html__('Twitter','elementorwidgetsmegapack').'</span></a>'; }
				if($pintrest == 'yes') { echo '<a target="_blank" class="adte-pintrest" href="http://pinterest.com/pin/create/button/?url='.get_the_permalink().'"><i class="adte-icon fa-pinterest-p"></i><span class="adte-social-share-text">'.esc_html__('Pintrest','elementorwidgetsmegapack').'</span></a>'; }
				if($linkedin == 'yes') { echo '<a target="_blank" class="adte-linkedin" href="http://www.linkedin.com/shareArticle?mini=true&amp;url='.get_the_permalink().'"><i class="adte-icon fa-linkedin-in"></i><span class="adte-social-share-text">'.esc_html__('Linkedin','elementorwidgetsmegapack').'</span></a>'; }
				if($vkontakte == 'yes') { echo '<a target="_blank" class="adte-vkontakte" href="http://vk.com/share.php?url='.esc_url($url).'&title='.esc_html($title).'"><i class="adte-icon fa-vk"></i><span class="adte-social-share-text">'.esc_html__('Vkontakte','elementorwidgetsmegapack').'</span></a>'; }
				if($tumblr == 'yes') { echo '<a target="_blank" class="adte-tumblr" href="https://www.tumblr.com/share/link?url='.esc_url($url).'&name='.esc_html($title).'"><i class="adte-icon fa-tumblr"></i><span class="adte-social-share-text">'.esc_html__('Tumblr','elementorwidgetsmegapack').'</span></a>'; }
				if($blogger == 'yes') { echo '<a target="_blank" class="adte-blogger" href="https://www.blogger.com/blog-this.g?u='.esc_url($url).'&n='.esc_html($title).'"><i class="adte-icon fa-blogger-b"></i><span class="adte-social-share-text">'.esc_html__('Blogger','elementorwidgetsmegapack').'</span></a>'; }
				if($digg == 'yes') { echo '<a target="_blank" class="adte-digg" href="http://digg.com/submit?url='.esc_url($url).'&title='.esc_html($title).'"><i class="adte-icon fa-digg"></i><span class="adte-social-share-text">'.esc_html__('Digg','elementorwidgetsmegapack').'</span></a>'; }
				if($reddit == 'yes') { echo '<a target="_blank" class="adte-reddit" href="https://reddit.com/submit?url='.esc_url($url).'&title='.esc_html($title).'"><i class="adte-icon fa-reddit"></i><span class="adte-social-share-text">'.esc_html__('Reddit','elementorwidgetsmegapack').'</span></a>'; }
				if($delicious == 'yes') { echo '<a target="_blank" class="adte-delicious" href="https://www.evernote.com/clip.action?url='.esc_url($url).'&title='.esc_html($title).'"><i class="adte-icon fa-delicious"></i><span class="adte-social-share-text">'.esc_html__('Delicious','elementorwidgetsmegapack').'</span></a>'; }
				if($wordpress == 'yes') { echo '<a target="_blank" class="adte-wordpress" href="https://wordpress.com/press-this.php?u='.esc_url($url).'&t='.esc_html($title).'"><i class="adte-icon fa-wordpress"></i><span class="adte-social-share-text">'.esc_html__('WordPress','elementorwidgetsmegapack').'</span></a>'; }
				if($skype == 'yes') { echo '<a target="_blank" class="adte-skype" href="https://web.skype.com/share?url='.esc_url($url).'&text='.esc_html($title).'"><i class="adte-icon fa-skype"></i><span class="adte-social-share-text">'.esc_html__('Skype','elementorwidgetsmegapack').'</span></a>'; }
				if($telegram == 'yes') { echo '<a target="_blank" class="adte-telegram" href="https://t.me/share/url?url='.esc_url($url).'&text='.esc_html($title).'"><i class="adte-icon fa-telegram-plane"></i><span class="adte-social-share-text">'.esc_html__('Telegram','elementorwidgetsmegapack').'</span></a>'; }
				if($whatsapp == 'yes') { echo '<a target="_blank" class="adte-whatsapp" href="https://api.whatsapp.com/send?phone=&text='.esc_html($title)." ".esc_url($url).'"><i class="adte-icon fa-whatsapp"></i><span class="adte-social-share-text">'.esc_html__('Whatsapp','elementorwidgetsmegapack').'</span></a>'; }
				if($wechat == 'yes') { echo '<a target="_blank" class="adte-wechat" href="https://chart.googleapis.com/chart?cht=qr&chs=196x196&chd=t:60,40&chl='.esc_url($url).'"><i class="adte-icon fa-weixin"></i><span class="adte-social-share-text">'.esc_html__('Wechat','elementorwidgetsmegapack').'</span></a>'; }
				if($line == 'yes') { echo '<a target="_blank" class="adte-line" href="ttps://lineit.line.me/share/ui?url='.esc_url($url).'&text='.esc_html($title).'"><i class="adte-icon fa-line"></i><span class="adte-social-share-text">'.esc_html__('Line','elementorwidgetsmegapack').'</span></a>'; }
								
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
