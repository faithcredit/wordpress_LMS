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
 * Elementor Fast Portfolio & Grid
 *
 * Elementor widget for team vision
 *
 * @since 1.0.0
 */
class FPG_Carousel extends Widget_Base {

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
		return 'fpg-carousel';
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
		return esc_html__( 'FPG Carousel', 'elementorwidgetsmegapack' );
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
		return 'eicon-carousel';
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
	 * Get post type categories.
	 */
	private function grid_get_all_post_type_categories( $post_type ) {
		$options = array();

		if ( $post_type == 'post' ) {
			$taxonomy = 'category';
		} else {
			$taxonomy = $post_type;
		}

		if ( ! empty( $taxonomy ) ) {
			// Get categories for post type.
			$terms = get_terms(
				array(
					'taxonomy'   => $taxonomy,
					'hide_empty' => false,
				)
			);
			if ( ! empty( $terms ) ) {
				foreach ( $terms as $term ) {
					if ( isset( $term ) ) {
						if ( isset( $term->slug ) && isset( $term->name ) ) {
							$options[ $term->slug ] = $term->name;
						}
					}
				}
			}
		}

		return $options;
	}

	/**
	 * Get post type categories.
	 */
	private function grid_get_all_custom_post_types() {
		$options = array();

		$args = array( '_builtin' => false );
		$post_types = get_post_types( $args, 'objects' ); 

		foreach ( $post_types as $post_type ) {
			if ( isset( $post_type ) ) {
					$options[ $post_type->name ] = $post_type->label;
			}
		}

		return $options;
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
			'skin',
			[
				'label' => esc_html__( 'Skin', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'campidoglio',
				'options' => [
					'campidoglio' 			=> esc_html__('Campidoglio', 'elementorwidgetsmegapack' ),
					'quirinale' 			=> esc_html__('Quirinale', 'elementorwidgetsmegapack' ),
					'arcodicostantino' 		=> esc_html__('Arco di Costantino', 'elementorwidgetsmegapack' ),
					'santamariamaggiore' 	=> esc_html__('Santa Maria Maggiore', 'elementorwidgetsmegapack' ),
					'sangiovanni' 			=> esc_html__('San Giovanni', 'elementorwidgetsmegapack' ),
					'catacombedidomitilla' 	=> esc_html__('Catacombe di domitilla', 'elementorwidgetsmegapack' ),
					'villaadriana' 			=> esc_html__('Villa Adriana', 'elementorwidgetsmegapack' ),
					'palatino' 				=> esc_html__('Palatino', 'elementorwidgetsmegapack' )
				]
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
					'5' => '5'
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
					'5' => '5'
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
					'5' => '5'
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
  			'section_query',
  			[
  				'label' => esc_html__( 'QUERY', 'essential-addons-elementor' )
  			]
		);

		$this->add_control(
			'source',
			[
				'label' => esc_html__( 'Source', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'wp_posts',
				'options' => [
					'wp_posts' 				=> esc_html__( 'Wordpress Posts', 'essential-addons-elementor' ),
					'post_type' 	=> esc_html__( 'Custom Posts Type', 'essential-addons-elementor' )
				]
			]
		);

		$this->add_control(
			'posts_source',
			[
				'label' => esc_html__( 'All Posts/Sticky posts', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'all_posts',
				'options' => [ 
					'all_posts' 			=> esc_html__( 'All Posts', 'essential-addons-elementor' ),
					'onlystickyposts'	=> esc_html__( 'Only Sticky Posts', 'essential-addons-elementor' )
				],
				'condition'	=> [
					'source'	=> 'wp_posts'
				]
			]
		);

		$this->add_control(
			'posts_type',
			[
				'label' => esc_html__( 'Select Post Type Source', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'options' => $this->grid_get_all_custom_post_types(),
				'condition'	=> [
					'source'	=> 'post_type'
				]
			]
		);

		$this->add_control(
			'categories',
			[
				'label' => esc_html__( 'Categories', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => $this->grid_get_all_post_type_categories('post'),
				'condition'	=> [
					'source'	=> 'wp_posts'
				]				
			]
		);

		$this->add_control(
			'order',
			[
				'label' => esc_html__( 'Order', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'DESC',
				'options' => [
					'DESC'	=> 'DESC',
					'ASC' 	=> 'ASC'					
				]
			]
		);

		$this->add_control(
			'orderby',
			[
				'label' => esc_html__( 'Order By', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => [
					'date'			=> 'Date',
					'ID' 			=> 'ID',					
					'author' 		=> 'Author',					
					'title' 		=> 'Title',					
					'name' 			=> 'Name',
					'modified'		=> 'Modified',
					'parent' 		=> 'Parent',					
					'rand' 			=> 'Rand',					
					'comment_count' => 'Comments Count',					
					'none' 			=> 'None'						
				]
			]
		);

		$this->add_control(
			'num_posts',
			[
				'label' => esc_html__( 'Number Posts', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::TEXT,
				'default' => '10'
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
			'title_fs',
			[
				'label' => esc_html__( 'Title Font Size (px)', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::TEXT,
				'default' => '25',
				'condition'	=> [
					'custom_style'	=> 'on'
				]
			]
		);

		$this->add_control(
			'content_fs',
			[
				'label' => esc_html__( 'Content Font Size (px)', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::TEXT,
				'default' => '20',
				'condition'	=> [
					'custom_style'	=> 'on'
				]
			]
		);	

		$this->add_control(
			'main_color',
			[
				'label' => esc_html__( 'Main Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#333333',
				'condition'	=> [
					'custom_style'	=> 'on'
				]
			]
		);

		$this->add_control(
			'secondary_color',
			[
				'label' => esc_html__( 'Second Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#747474',
				'condition'	=> [
					'custom_style'	=> 'on'
				]
			]
		);
		
		$this->add_control(
			'font_color',
			[
				'label' => esc_html__( 'Font Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#AAAAAA',
				'condition'	=> [
					'custom_style'	=> 'on'
				]
			]
		);

		$this->add_control(
			'a_color',
			[
				'label' => esc_html__( 'Link Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
				'condition'	=> [
					'custom_style'	=> 'on'
				]
			]
		);

		$this->add_control(
			'over_color',
			[
				'label' => esc_html__( 'Hover Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#000000',
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
	
        $skin					= esc_html($settings['skin']);
		$grid_masonry			= 'wpfpg_grid';
		$columns 				= '1'; 
		$item_show				= esc_html($settings['item_show']);
		$item_show_900			= esc_html($settings['item_show_900']);
		$item_show_600			= esc_html($settings['item_show_600']);
		$loop					= esc_html($settings['loop']);
		$autoplay				= esc_html($settings['autoplay']);
		$smart_speed			= esc_html($settings['smart_speed']);
		$navigation				= esc_html($settings['navigation']);
		$c_pagination			= esc_html($settings['pagination']);
		$margin					= esc_html($settings['margin']);
		$rtl					= esc_html($settings['rtl']);
		
		// Query
		$source					= esc_html($settings['source']);
		$posts_source			= esc_html($settings['posts_source']);
		$posts_type				= esc_html($settings['posts_type']);
		$categories				= '';
		if(!empty($settings['categories'])) {
			$num_cat = count($settings['categories']);
			$i = 1;
			foreach ( $settings['categories'] as $element ) {
				$categories .= $element;
				if($i != $num_cat) {
					$categories .= ',';
				}
				$i++;
			}		
		}		
		$categories_post_type	= '';
		$pagination				= '';
		$pagination_type		= '';
		$num_posts_page			= '';
		$num_posts				= esc_html($settings['num_posts']);	
		$orderby				= esc_html($settings['orderby']);
		$order					= esc_html($settings['order']);
					
		// Style
        $custom_style			= esc_html($settings['custom_style']);
        $title_fs				= esc_html($settings['title_fs']);
        $content_fs				= esc_html($settings['content_fs']);
        $main_color				= esc_html($settings['main_color']);
        $secondary_color		= esc_html($settings['secondary_color']);
        $font_color				= esc_html($settings['font_color']);
        $a_color				= esc_html($settings['a_color']);
        $over_color				= esc_html($settings['over_color']);
        $margin_right			= '0';
        $margin_bottom			= '0';
		
		// Animations
		$addon_animate			= esc_html($settings['addon_animate']);
		$effect					= esc_html($settings['effect']);
		$delay					= esc_html($settings['delay']);
			
		wp_enqueue_style( 'animations' );
		wp_enqueue_script( 'appear' );			
		wp_enqueue_script( 'animate' );
		wp_enqueue_style( 'elementor-icons' );
		wp_enqueue_style( 'font-awesome' );	
		wp_enqueue_style( 'magnific-popup' );
		wp_enqueue_script( 'magnific-popup' );
		wp_enqueue_style( 'owlcarousel' );
		wp_enqueue_style( 'owltheme' );				
		wp_enqueue_script( 'owlcarousel' );
		wp_enqueue_script( 'fastportfoliogrid-carousel' );
		
		// LOOP QUERY
		$query = ewmp_query( $source,
							$posts_source, 
							$posts_type, 
							$categories,
							$categories_post_type, 
							$order, 
							$orderby, 
							$pagination, 
							$pagination_type,
							$num_posts, 
							$num_posts_page );

		echo '<div class="clearfix"></div>';
		
		$count = 0;
		
		echo '<style type="text/css">';
		
			if($custom_style == 'off') :
				if($skin == 'campidoglio') {$fonts = 'google_fonts'; $gfonts = 'Open Sans'; 	$title_fs = '30';
					$content_fs = '15';	$main_color = 'rgba(41,128,185,0.3)';$secondary_color = 'rgba(255,255,255,1)';
					$font_color = 'rgba(255,255,255,1)'; $a_color = 'rgba(255,255,255,1)';
					$over_color = 'rgba(41,128,185,1)';$margin_right = '0'; $margin_bottom = '0';	
				}
				if($skin == 'quirinale') {$fonts = 'google_fonts'; $gfonts = 'Open Sans'; 	$title_fs = '30';
					$content_fs = '15';	$main_color = 'rgba(142,68,173,0.8)';$secondary_color = 'rgba(255,255,255,1)';
					$font_color = 'rgba(255,255,255,1)'; $a_color = 'rgba(255,255,255,1)';
					$over_color = 'rgba(255,255,255,1)';$margin_right = '0'; $margin_bottom = '0';	
				}	
				if($skin == 'arcodicostantino') {$fonts = 'google_fonts'; $gfonts = 'Open Sans'; 	$title_fs = '30';
					$content_fs = '20';	$main_color = 'rgba(255,255,255,1)';$secondary_color = 'rgba(255,255,255,1)';
					$font_color = 'rgba(243,156,18,1)'; $a_color = 'rgba(243,156,18,1)';
					$over_color = 'rgba(0,0,0,1)';$margin_right = '0'; $margin_bottom = '0';	
				}	
				if($skin == 'santamariamaggiore') {$fonts = 'google_fonts'; $gfonts = 'Open Sans'; 	$title_fs = '32';
					$content_fs = '15';	$main_color = 'rgba(0,0,0,0.8)';$secondary_color = 'rgba(255,255,255,1)';
					$font_color = 'rgba(255,255,255,1)'; $a_color = 'rgba(255,255,255,1)';
					$over_color = 'rgba(143,143,143,1)';$margin_right = '0'; $margin_bottom = '0';	
				}
				if($skin == 'sangiovanni') {$fonts = 'google_fonts'; $gfonts = 'Open Sans'; 	$title_fs = '22';
					$content_fs = '12';	$main_color = 'rgba(22,160,133,1)';$secondary_color = 'rgba(255,255,255,1)';
					$font_color = 'rgba(255,255,255,1)'; $a_color = 'rgba(255,255,255,1)';
					$over_color = 'rgba(0,0,0,1)';$margin_right = '0'; $margin_bottom = '0';	
				}
				if($skin == 'catacombedidomitilla') {$fonts = 'google_fonts'; $gfonts = 'Open Sans'; 	$title_fs = '30';
					$content_fs = '16';	$main_color = 'rgba(41,128,185,1)';$secondary_color = 'rgba(41,128,185,0.5)';
					$font_color = 'rgba(255,255,255,1)'; $a_color = 'rgba(41,128,185,1)';
					$over_color = 'rgba(181,212,233,1)';$margin_right = '0'; $margin_bottom = '0';	
				}
				if($skin == 'villaadriana') {$fonts = 'google_fonts'; $gfonts = 'Open Sans'; 	$title_fs = '32';
					$content_fs = '16';	$main_color = 'rgba(0,0,0,1)';$secondary_color = 'rgba(0,0,0,1)';
					$font_color = 'rgba(0,0,0,1)'; $a_color = 'rgba(255,255,255,1)';
					$over_color = 'rgba(0,0,0,1)';$margin_right = '0'; $margin_bottom = '0';	
				}
				if($skin == 'palatino') {$fonts = 'google_fonts'; $gfonts = 'Open Sans'; 	$title_fs = '30';
					$content_fs = '14';	$main_color = 'rgba(75,75,75,1)';$secondary_color = 'rgba(75,75,75,1)';
					$font_color = 'rgba(75,75,75,1)'; $a_color = 'rgba(75,75,75,1)';
					$over_color = 'rgba(0,0,0,1)';$margin_right = '0'; $margin_bottom = '0';	
				}				
			endif;
			echo ewmp_custom_style($instance,
											'fpg-type-carousel',
											$grid_masonry,
											$columns,
											$settings_type,
											$skin,
											$fonts,
											$gfonts,
											$title_fs,
											$content_fs,
											$main_color,
											$secondary_color,
											$font_color,
											$a_color,
											$over_color,
											$margin_right,
											$margin_bottom);
			
		echo '</style>';

		echo '<div class="fpg-general-container fpg-container-number-'.esc_html($instance).' '.esc_html($skin).'">';
		
		echo '<div 
							data-fpg-carousel-owl-items="'.esc_html($item_show).'" 
							data-fpg-carousel-owl-items-900="'.esc_html($item_show_900).'" 
							data-fpg-carousel-owl-items-600="'.esc_html($item_show_600).'" 
							data-fpg-carousel-owl-loop="'.esc_html($loop).'" 
							data-fpg-carousel-owl-autoplay="'.esc_html($autoplay).'" 
							data-fpg-carousel-owl-smart-speed="'.esc_html($smart_speed).'" 
							data-fpg-carousel-owl-navigation="'.esc_html($navigation).'" 
							data-fpg-carousel-owl-pagination="'.esc_html($c_pagination).'" 
							data-fpg-carousel-owl-margin="'.esc_html($margin).'" 
							data-fpg-carousel-owl-rtl="'.esc_html($rtl).'"	
		class="fpg-container fpg-type-carousel grid-columns-'.esc_html($columns).' fpg-grid fpg-icon  fpg-'.esc_html($instance).' '.esc_html($skin).' '.esc_html($grid_masonry).' '.ewmp_animate_class($addon_animate,$effect,$delay).'>';
		
		$numthumbs = 1;
		// Start Query Loop
		$loop = new \WP_Query($query);		

		
		if($loop) :
			while ( $loop->have_posts() ) : $loop->the_post();
		
				$id_post = get_the_id();
				$link = get_permalink(); 
				$pinterestimage = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );

				echo '<figure class="fpg-grid-item">';
		
			if($skin == 'campidoglio' || $skin == 'quirinale' || $skin == 'arcodicostantino' || $skin == 'santamariamaggiore') {
				echo ewmp_get_thumb($grid_masonry);
				echo '<div class="ac-container">';
				echo '	<h1 class="title">'.get_the_title().'</h1>
								<div class="ac-icon">';
									echo '<a target="_blank" class="icon-facebook fa fa-facebook" href="http://www.facebook.com/sharer.php?u='.get_the_permalink().'&amp;t='.get_the_title().'" title="'.esc_html__('Click to share this post on Facebook','elementorwidgetsmegapack').'"></a>
												<a target="_blank" class="icon-twitter fa fa-twitter" href="http://twitter.com/home?status='.get_the_permalink().'" title="'.esc_html__('Click to share this post on Twitter','elementorwidgetsmegapack').'"></a>
        										<a target="_blank" class="icon-pinterest fa fa-pinterest" href="http://pinterest.com/pin/create/button/?url='.urlencode(get_permalink()).'&media='.esc_url($pinterestimage[0]).'&description='.get_the_title().'" title="'.esc_html__('Click to share this post on Pinterest','elementorwidgetsmegapack').'"></a>';
								echo '</div>
						   </div>';
			}
			if($skin == 'sangiovanni') {
				echo ewmp_get_thumb($grid_masonry);
				echo '<div class="ac-container">';
				echo '	<h1 class="title">'.get_the_title().'</h1>
								<div class="ac-icon">
                           			<div class="line-top"></div>
                            		<div class="text">'.ewmp_get_blogs_excerpt(200,'no','').'</div>
                            		<div class="line-bottom"></div>
									<div class="ac-social-container">';								
									echo '<a target="_blank" class="icon-facebook fa fa-facebook" href="http://www.facebook.com/sharer.php?u='.get_the_permalink().'&amp;t='.get_the_title().'" title="'.esc_html__('Click to share this post on Facebook','elementorwidgetsmegapack').'"></a>
												<a target="_blank" class="icon-twitter fa fa-twitter" href="http://twitter.com/home?status='.get_the_permalink().'" title="'.esc_html__('Click to share this post on Twitter','elementorwidgetsmegapack').'"></a>
        										<a target="_blank" class="icon-pinterest fa fa-pinterest" href="http://pinterest.com/pin/create/button/?url='.urlencode(get_permalink()).'&media='.esc_url($pinterestimage[0]).'&description='.get_the_title().'" title="'.esc_html__('Click to share this post on Pinterest','elementorwidgetsmegapack').'"></a>';
							echo	'</div>
								</div>
						   </div>';
			}	
			if($skin == 'catacombedidomitilla') {
				echo '<div class="container-top">';
				echo ewmp_get_thumb($grid_masonry);
				echo '<div class="hover-img">
                  				<a href="'.esc_url($link).'" class="icon-plus fa fa-plus"></a>
                  			</div></div>';
				echo '<div class="ac-container">';
				echo '	<h1 class="title">'.get_the_title().'</h1>
								<div class="ac-icon">
                            		
									<div class="ac-social-container">';
									echo '<a target="_blank" class="icon-facebook fa fa-facebook" href="http://www.facebook.com/sharer.php?u='.get_the_permalink().'&amp;t='.get_the_title().'" title="'.esc_html__('Click to share this post on Facebook','elementorwidgetsmegapack').'"></a>
												<a target="_blank" class="icon-twitter fa fa-twitter" href="http://twitter.com/home?status='.get_the_permalink().'" title="'.esc_html__('Click to share this post on Twitter','elementorwidgetsmegapack').'"></a>
        										<a target="_blank" class="icon-pinterest fa fa-pinterest" href="http://pinterest.com/pin/create/button/?url='.urlencode(get_permalink()).'&media='.esc_url($pinterestimage[0]).'&description='.get_the_title().'" title="'.esc_html__('Click to share this post on Pinterest','elementorwidgetsmegapack').'"></a>';

							echo	'</div>								
								</div>
								<div class="text">'.ewmp_get_blogs_excerpt(200,'no','').'</div>
						   </div>';
			}	
			if($skin == 'villaadriana') {
				echo ewmp_get_thumb($grid_masonry);
				echo '<div class="ac-container">';
				echo '	<h1 class="title">'.get_the_title().'</h1>
								<div class="ac-icon">                            		
									<div class="ac-social-container">';	
									echo '<a target="_blank" class="icon-facebook fa fa-facebook" href="http://www.facebook.com/sharer.php?u='.get_the_permalink().'&amp;t='.get_the_title().'" title="'.esc_html__('Click to share this post on Facebook','elementorwidgetsmegapack').'"></a>
												<a target="_blank" class="icon-twitter fa fa-twitter" href="http://twitter.com/home?status='.get_the_permalink().'" title="'.esc_html__('Click to share this post on Twitter','elementorwidgetsmegapack').'"></a>
        										<a target="_blank" class="icon-pinterest fa fa-pinterest" href="http://pinterest.com/pin/create/button/?url='.urlencode(get_permalink()).'&media='.esc_url($pinterestimage[0]).'&description='.get_the_title().'" title="'.esc_html__('Click to share this post on Pinterest','elementorwidgetsmegapack').'"></a>';

							echo	'</div>								
								</div>
								<div class="text">'.ewmp_get_blogs_excerpt(200,'no','').'</div>
						   </div>';
			}
			if($skin == 'palatino') {
				echo ewmp_get_thumb($grid_masonry);
				echo '<div class="ac-container">';
				echo '	<h1 class="title">'.get_the_title().'</h1>
								<div class="text">'.ewmp_get_blogs_excerpt(200,'no','').'</div>
								<div class="ac-icon">                            		
									<div class="ac-social-container">';	
									echo '<a target="_blank" class="icon-facebook fa fa-facebook" href="http://www.facebook.com/sharer.php?u='.get_the_permalink().'&amp;t='.get_the_title().'" title="'.esc_html__('Click to share this post on Facebook','elementorwidgetsmegapack').'"></a>
												<a target="_blank" class="icon-twitter fa fa-twitter" href="http://twitter.com/home?status='.get_the_permalink().'" title="'.esc_html__('Click to share this post on Twitter','elementorwidgetsmegapack').'"></a>
        										<a target="_blank" class="icon-pinterest fa fa-pinterest" href="http://pinterest.com/pin/create/button/?url='.urlencode(get_permalink()).'&media='.esc_url($pinterestimage[0]).'&description='.get_the_title().'" title="'.esc_html__('Click to share this post on Pinterest','elementorwidgetsmegapack').'"></a>';
								
							echo	'<a href="'.esc_url($link).'" class="icon-plus fa fa-plus"></a></div>								
								</div>
								
						   </div>';
			}					
						
				echo '</figure>'; // CLOSE FIGURE
		
				$numthumbs++;	
			endwhile;
		endif;	
		
		echo '</div>';		
		wp_reset_query();
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
