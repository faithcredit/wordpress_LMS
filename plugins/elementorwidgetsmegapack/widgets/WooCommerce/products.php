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
 * Elementor WooCommerce Products Layout
 *
 * Elementor WooCommerce Products Layout Widget
 *
 * @since 1.0.0
 */
class Woocommerce_Products_Display extends Widget_Base {

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
		return 'woocommerce-products-display';
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
		return esc_html__( 'WooCommerce Products Layout', 'elementorwidgetsmegapack' );
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
		return 'eicon-posts-grid';
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
			'blog_style',
			[
				'label' => esc_html__( 'Style', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => [
					'style1' => esc_html__('Style 1', 'elementorwidgetsmegapack' ),
					'style2' => esc_html__('Style 2', 'elementorwidgetsmegapack' ),
					'style3' => esc_html__('Style 3', 'elementorwidgetsmegapack' ),
					'style4' => esc_html__('Style 4', 'elementorwidgetsmegapack' ),
					'style5' => esc_html__('Style 5', 'elementorwidgetsmegapack' ),
					'style6' => esc_html__('Style 6', 'elementorwidgetsmegapack' ),
				]
			]
		);

		$this->add_control(
			'columns',
			[
				'label' => esc_html__( 'Columns', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => '2',
				'options' => [
					'1' => '1',
					'2' => '2',
					'3' => '3'
				]
			]
		);

		$this->add_control(
			'show_date',
			[
				'label' => esc_html__( 'Show Date', 'fastportfoliogridelelementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => [
					'true'  => esc_html__('Show', 'fastportfoliogridelelementor' ),
					'false' => esc_html__('Hidden', 'fastportfoliogridelelementor' )
				]
			]
		);

		$this->add_control(
			'show_price',
			[
				'label' => esc_html__( 'Show Price', 'fastportfoliogridelelementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => [
					'true'  => esc_html__('Show', 'fastportfoliogridelelementor' ),
					'false' => esc_html__('Hidden', 'fastportfoliogridelelementor' )
				]
			]
		);
		
		$this->add_control(
			'show_button_cart',
			[
				'label' => esc_html__( 'Show Button Cart', 'fastportfoliogridelelementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => [
					'true'  => esc_html__('Show', 'fastportfoliogridelelementor' ),
					'false' => esc_html__('Hidden', 'fastportfoliogridelelementor' )
				]
			]
		);		
		
		$this->add_control(
			'show_category',
			[
				'label' => esc_html__( 'Show Category', 'fastportfoliogridelelementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => [
					'true'  => esc_html__('Show', 'fastportfoliogridelelementor' ),
					'false' => esc_html__('Hidden', 'fastportfoliogridelelementor' )
				]
			]
		);

		$this->add_control(
			'show_author',
			[
				'label' => esc_html__( 'Show Author', 'fastportfoliogridelelementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => [
					'true'  => esc_html__('Show', 'fastportfoliogridelelementor' ),
					'false' => esc_html__('Hidden', 'fastportfoliogridelelementor' )
				]
			]
		);

		$this->add_control(
			'show_excerpt',
			[
				'label' => esc_html__( 'Show Excerpt', 'fastportfoliogridelelementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => [
					'true'  => esc_html__('Show', 'fastportfoliogridelelementor' ),
					'false' => esc_html__('Hidden', 'fastportfoliogridelelementor' )
				]
			]
		);

		$this->add_control(
			'num_excerpt',
			[
				'label' => esc_html__( 'Number of characters of the Excerpt', 'fastportfoliogridelelementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => '200',
				'condition'	=> [
					'show_excerpt'	=> 'true'
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
			'categories_post_type',
			[
				'label' => esc_html__( 'Categories', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => $this->grid_get_all_post_type_categories('product_cat')			
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
			'pagination',
			[
				'label' => esc_html__( 'Pagination', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [
					'no'	=> 'No',
					'yes' 	=> 'Yes',
					'load-more' => 'Yes with Load More'
				]
			]
		);

		$this->add_control(
			'num_posts',
			[
				'label' => esc_html__( 'Number Posts', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::TEXT,
				'default' => '10',
				'condition'	=> [
					'pagination'	=> 'no'
				]
			]
		);

		$this->add_control(
			'pagination_type',
			[
				'label' => esc_html__( 'Pagination Type', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'numeric',
				'options' => [
					'numeric'	=> 'Numeric',
					'normal' 	=> 'Normal'					
				],
				'condition'	=> [
					'pagination'	=> 'yes'
				]				
			]
		);

		$this->add_control(
			'num_posts_page',
			[
				'label' => esc_html__( 'Number Posts For Page', 'elementorwidgetsmegapack' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => '10',
				'condition'	=> [
					'pagination'	=> array('yes','load-more')
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
				'default' => '#333333',
				'condition'	=> [
					'custom_style'	=> 'on'
				]
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => esc_html__( 'Text Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#747474',
				'condition'	=> [
					'custom_style'	=> 'on'
				]
			]
		);
		
		$this->add_control(
			'date_color',
			[
				'label' => esc_html__( 'Date Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#AAAAAA',
				'condition'	=> [
					'custom_style'	=> 'on'
				]
			]
		);

		$this->add_control(
			'price_color',
			[
				'label' => esc_html__( 'Price Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
				'condition'	=> [
					'custom_style'	=> 'on'
				]
			]
		);

		$this->add_control(
			'bg_price_color',
			[
				'label' => esc_html__( 'Background Price Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#000000',
				'condition'	=> [
					'custom_style'	=> 'on'
				]
			]
		);

		$this->add_control(
			'link_color',
			[
				'label' => esc_html__( 'Link Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#c9564c',
				'condition'	=> [
					'custom_style'	=> 'on'
				]
			]
		);

		$this->add_control(
			'link_h_color',
			[
				'label' => esc_html__( 'Link Hover Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#e7685d',
				'condition'	=> [
					'custom_style'	=> 'on'
				]
			]
		);

		$this->add_control(
			'category_color',
			[
				'label' => esc_html__( 'Category Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
				'condition'	=> [
					'custom_style'	=> 'on'
				]
			]
		);

		$this->add_control(
			'bg_category_color',
			[
				'label' => esc_html__( 'Background Category Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#e7685d',
				'condition'	=> [
					'custom_style'	=> 'on'
				]
			]
		);
		
		$this->add_control(
			'button_cart_color',
			[
				'label' => esc_html__( 'Button Cart Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
				'condition'	=> [
					'custom_style'	=> 'on'
				]
			]
		);

		$this->add_control(
			'bg_button_cart_color',
			[
				'label' => esc_html__( 'Background Button Cart Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#e7685d',
				'condition'	=> [
					'custom_style'	=> 'on'
				]
			]
		);		
		
		$this->add_control(
			'post_bg_color',
			[
				'label' => esc_html__( 'Post Background Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#e7685d',
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
	
        $blog_style				= esc_html($settings['blog_style']);
        $columns				= esc_html($settings['columns']);
        $show_date				= esc_html($settings['show_date']);
        $show_price				= esc_html($settings['show_price']);
        $show_button_cart		= esc_html($settings['show_button_cart']);
        $show_category			= esc_html($settings['show_category']);
        $show_author			= esc_html($settings['show_author']);
        $show_excerpt			= esc_html($settings['show_excerpt']);
        $num_excerpt			= esc_html($settings['num_excerpt']);
		
		// Query
		$source					= 'post_type';
		$posts_source			= '';
		$posts_type				= 'product';
		$categories				= '';	
		$categories_post_type	= '';
		if(!empty($settings['categories_post_type'])) {
			$num_cat = count($settings['categories_post_type']);
			$i = 1;
			foreach ( $settings['categories_post_type'] as $element ) {
				$categories_post_type .= $element;
				if($i != $num_cat) {
					$categories_post_type .= ',';
				}
				$i++;
			}		
		}			
		$pagination				= esc_html($settings['pagination']);
		$pagination_type		= esc_html($settings['pagination_type']);
		$num_posts_page			= esc_html($settings['num_posts_page']);
		$num_posts				= esc_html($settings['num_posts']);	
		$orderby				= esc_html($settings['orderby']);
		$order					= esc_html($settings['order']);
					
		// Style
        $custom_style			= esc_html($settings['custom_style']);
        $title_color			= esc_html($settings['title_color']);
        $text_color				= esc_html($settings['text_color']);
        $date_color				= esc_html($settings['date_color']);
        $price_color			= esc_html($settings['price_color']);
        $bg_price_color			= esc_html($settings['bg_price_color']);
        $link_color				= esc_html($settings['link_color']);
        $link_h_color			= esc_html($settings['link_h_color']);
        $category_color			= esc_html($settings['category_color']);
        $bg_category_color		= esc_html($settings['bg_category_color']);
        $bg_button_cart_color	= esc_html($settings['bg_button_cart_color']);
        $button_cart_color		= esc_html($settings['button_cart_color']);
        $post_bg_color			= esc_html($settings['post_bg_color']);
		
		// Animations
		$addon_animate			= esc_html($settings['addon_animate']);
		$effect					= esc_html($settings['effect']);
		$delay					= esc_html($settings['delay']);
		
		wp_enqueue_style( 'fonts-vc' );
		wp_enqueue_style( 'animations' );
		wp_enqueue_style( 'elementor-icons' );
		wp_enqueue_style( 'font-awesome' );
		wp_enqueue_script( 'woocommerceproductsdisplay' );		
		wp_enqueue_style( 'woocommerce-ewmp' );
		
		$container_class = $class_load_more = $class_item_load_more = $css_title = $css_text = $css_link = $css_date = $css_bg_price = $css_price = $css_price_link = $js_class = $data_value = $css_current_pag_num = $css_bg_category_link = $css_post_bg_color = $css_bg_button_cart = '';
		$css_bg_price = 'style="--bg-comment-color-var:#009688;"';
		if($columns == '1') : $columns_class = 'col-xs-12'; $container_class = 'woocommerceproductsdisplay-bp-vc-blogs-1-col'; endif;
		if($columns == '2') : $columns_class = 'col-xs-6'; $container_class = 'woocommerceproductsdisplay-bp-vc-blogs-2-col'; endif;
		if($columns == '3') : $columns_class = 'col-xs-4'; $container_class = 'woocommerceproductsdisplay-bp-vc-blogs-3-col'; endif;		
		if(empty($num_posts)) : $num_posts = 6; endif;		
		
		$post_id = get_the_id(); 
		// PAGINATION		
		if($pagination == 'yes') {
			if ( get_query_var('paged') ) {
				$paged = get_query_var('paged');				
			} elseif ( get_query_var('page') ) {			
				$paged = get_query_var('page');			
			} else {			
				$paged = 1;			
			}
		}
		// #PAGINATION		
		
		// Load More
		if($pagination == 'load-more') : 
			$class_load_more = 'woocommerceproductsdisplay-bp-load-more-'.$blog_style.''; 
			$class_item_load_more = 'woocommerceproductsdisplay-bp-item-load-more-'.$blog_style.'';
		endif;
		// #Load More
		
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
		
		if($custom_style == 'on') :
			$css_title = 'style="color:'.esc_html($title_color).'" onMouseOver="this.style.color = \''.esc_html($link_h_color).'\';" onMouseLeave="this.style.color = \''.esc_html($title_color).'\';"';
			$css_text = 'style="color:'.esc_html($text_color).'"';
			$css_date = 'style="color:'.esc_html($date_color).'"';
			$css_bg_price = 'style="background-color:'.esc_html($bg_price_color).';"';
			$css_price = 'style="color:'.esc_html($price_color).'"';			
			$css_price_link = 'style="color:'.esc_html($price_color).'"';			
			$css_link = 'style="color:'.esc_html($link_color).'" onMouseOver="this.style.color = \''.esc_html($link_h_color).'\';" onMouseLeave="this.style.color = \''.esc_html($link_color).'\';"';			
			$css_current_pag_num = 'style="color:'.esc_html($link_h_color).'"';
			$css_bg_category_link = 'style="color:'.esc_html($category_color).';background:'.esc_html($bg_category_color).'" onMouseOver="this.style.color = \''.esc_html($bg_category_color).'\';this.style.backgroundColor = \''.esc_html($category_color).'\';" onMouseLeave="this.style.color = \''.esc_html($category_color).'\';this.style.backgroundColor = \''.esc_html($bg_category_color).'\';"';
			$css_bg_button_cart = 'style="color:'.esc_html($button_cart_color).';background:'.esc_html($bg_button_cart_color).'" onMouseOver="this.style.color = \''.esc_html($bg_button_cart_color).'\';this.style.backgroundColor = \''.esc_html($button_cart_color).'\';" onMouseLeave="this.style.color = \''.esc_html($button_cart_color).'\';this.style.backgroundColor = \''.esc_html($bg_button_cart_color).'\';"';
			$css_post_bg_color = 'style="background:'.esc_html($post_bg_color).'"';		
		endif;

		echo '<div class="clearfix"></div>';
		
		$count = 0;
		
		echo '<div class="woocommerceproductsdisplay woocommerceproductsdisplay-bp-vc-element-blogs '.esc_html($class_load_more).' woocommerceproductsdisplay-bp-blogs-'.$blog_style.' '.esc_html($container_class).' woocommerceproductsdisplay-bp-vc-element-blogs-'.esc_html($instance).' element-no-padding">';
		
		echo '<div class="woocommerceproductsdisplay-bp-vc-element-blogs-article-container">';
		
		// Start Query Loop
		$loop = new \WP_Query($query);		

		// Load More
		if($pagination == 'load-more') : 
		
			$readtext 		= esc_html__('Read More','elementorwidgetsmegapack');
			$loading 		= esc_html__('Loading products...','elementorwidgetsmegapack');
			$nomoreposts 	= esc_html__('No more products to load.','elementorwidgetsmegapack');		
		
			wp_enqueue_script(
				'woocommerceproductsdisplay-bp-load-blogs',
				EWMP_URL . 'assets/js/woocommerceproductsdisplay-loadmore.js',
				array('jquery'),
				'1.0',
				true
			);		
					
			$max = $loop->max_num_pages;
			$paged = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;
			
			// Add some parameters for the JS.
			wp_localize_script(
				'woocommerceproductsdisplay-bp-load-blogs',
				'fnwp_',
				array(
					'startPage' 	=> $paged,
					'maxPages' 		=> $max,
					'nextLink' 		=> next_posts($max, false),
					'readtext'		=> $readtext,
					'loading'		=> $loading,
					'nomoreposts'	=> $nomoreposts,
					'cssLink'		=> $css_link,
					'style'			=> $blog_style
				)
			);
		endif;
		// #Load More


		
		if($loop) :
			while ( $loop->have_posts() ) : $loop->the_post();
		
				$id_post = get_the_id();
				$link = get_permalink();
				$product = new \WC_Product( $id_post );
				$price = $product->get_regular_price();
				if(empty($price)) {
					$price = $product->get_price();
				}
				$price_sales = $product->get_sale_price();
				$symbol = get_woocommerce_currency_symbol();				
				if($count & 1) : $class_odd = "vc-element-post-even"; else : $class_odd = "vc-element-post-odd"; endif;

				/*************************** STYLE 1 ************************/
				if($blog_style == 'style1') {
					echo '<article class="item-blogs first-element-blogs '.esc_html($columns_class).' '.esc_html($class_item_load_more).' '.esc_html($class_odd).ewmp_animate_class($addon_animate,$effect,$delay).'>';
							
					# Col 1
					if($columns == 1) :
							
						echo '<div class="article-info">';
							echo '<div class="article-info-top">';
								if($show_category == "true") {
									echo '<div class="article-category">'.ewmp_get_category($source,$posts_type,$css_link).'</div>';
								}
								echo '<h3 class="article-title"><a href="'.esc_url($link).'" '.$css_title.'>'.get_the_title().'</a></h3>';									
								echo '<div class="article-info-bottom">';
									if($show_author == "true") {								
										echo '<div class="article-author">'.ewmp_get_author($css_link).'</div>';
									}
									if($show_author == "true" && $show_date == "true") {
										echo '<div class="article-separator">-</div>';
									}
									if($show_date == "true") {	
										echo '<div class="article-date" '.$css_date.'>'.get_the_date().'</div>';
									}
									echo '<div class="clearfix"></div>';	
								echo '</div>';										
							echo '</div>';											
						echo '</div>';
								
						echo '<div class="article-image">';
							echo ewmp_get_blogs_thumb($columns,$id_post);
							echo ewmp_check_post_format();
							if($show_price == "true") {
								if(!empty($price_sales) || $price_sales != '') {
									echo '<span class="item-sale">'.esc_html__('Sale','elementorwidgetsmegapack').'</span>';	
								}						
								echo '<div class="article-price article-price" '.$css_bg_price.'>
									<span class="regular-price';
						
										if(!empty($price_sales) || $price_sales != '') {
											echo ' line-through';	
										}
										
										echo '" '.$css_price.'>'. $price . ' ' . $symbol .'</span>';
										
										if(!empty($price_sales) || $price_sales != '') {
											echo '<span class="sale-price">'. $price_sales . ' ' .$symbol .'</span>';
										}
						
								echo '</div>';
							}
						echo '</div>';
						echo '<div class="article-info">';
							if($show_excerpt == "true") {
								echo '<p class="article-excerpt" '.$css_text.'>' . ewmp_get_blogs_excerpt($num_excerpt,'off',$css_link) . '</p>';	
							}
							if($show_button_cart == "true") {
								echo '<div class="cart-button-container">
									<a class="product_type_simple add_to_cart_button ajax_add_to_cart" data-product_sku="" data-product_id="'.$id_post.'" rel="nofollow" href="?add-to-cart='.$id_post.'" '.$css_bg_button_cart.'>'.esc_html__('Add To Cart','elementorwidgetsmegapack').'</a>
								</div>';
							}
							echo '<div class="clearfix"></div>';	
						echo '</div>';
						
					elseif($columns == 2) :
							
						echo '<div class="article-image">';
							echo ewmp_get_blogs_thumb($columns,$id_post);
							echo ewmp_check_post_format();
							if($show_price == "true") {
								if(!empty($price_sales) || $price_sales != '') {
									echo '<span class="item-sale">'.esc_html__('Sale','elementorwidgetsmegapack').'</span>';	
								}						
								echo '<div class="article-price article-price" '.$css_bg_price.'>
									<span class="regular-price';
						
										if(!empty($price_sales) || $price_sales != '') {
											echo ' line-through';	
										}
										
										echo '" '.$css_price.'>'. $price . ' ' . $symbol .'</span>';
										
										if(!empty($price_sales) || $price_sales != '') {
											echo '<span class="sale-price">'. $price_sales . ' ' .$symbol .'</span>';
										}
						
								echo '</div>';
							}
						echo '</div>';

						echo '<div class="article-info-container"><div class="article-info">';
							echo '<div class="article-info-top">';
								if($show_category == "true") {
									echo '<div class="article-category">'.ewmp_get_category($source,$posts_type,$css_link).'</div>';
								}
								echo '<h3 class="article-title"><a href="'.esc_url($link).'" '.$css_title.'>'.get_the_title().'</a></h3>';									
								echo '<div class="article-info-bottom">';
									if($show_author == "true") {								
										echo '<div class="article-author">'.ewmp_get_author($css_link).'</div>';
									}
									if($show_author == "true" && $show_date == "true") {
										echo '<div class="article-separator">-</div>';
									}
									if($show_date == "true") {	
										echo '<div class="article-date" '.$css_date.'>'.get_the_date().'</div>';
									}
									echo '<div class="clearfix"></div>';	
								echo '</div>';										
							echo '</div>';											
						echo '</div>';

						echo '<div class="article-info">';
							if($show_excerpt == "true") {
								echo '<p class="article-excerpt" '.$css_text.'>' . ewmp_get_blogs_excerpt($num_excerpt,'off',$css_link) . '</p>';	
							}
							if($show_button_cart == "true") {
								echo '<div class="cart-button-container">
									<a class="product_type_simple add_to_cart_button ajax_add_to_cart" data-product_sku="" data-product_id="'.$id_post.'" rel="nofollow" href="?add-to-cart='.$id_post.'" '.$css_bg_button_cart.'>'.esc_html__('Add To Cart','elementorwidgetsmegapack').'</a>
								</div>';
							}								
							echo '<div class="clearfix"></div>';	
						echo '</div></div>';							
							
					else :
							
						echo '<div class="article-image">';
							echo ewmp_get_blogs_thumb($columns,$id_post);
							echo ewmp_check_post_format();
							if($show_price == "true") {
								if(!empty($price_sales) || $price_sales != '') {
									echo '<span class="item-sale">'.esc_html__('Sale','elementorwidgetsmegapack').'</span>';	
								}						
								echo '<div class="article-price article-price" '.$css_bg_price.'>
									<span class="regular-price';
						
										if(!empty($price_sales) || $price_sales != '') {
											echo ' line-through';	
										}
										
										echo '" '.$css_price.'>'. $price . ' ' . $symbol .'</span>';
										
										if(!empty($price_sales) || $price_sales != '') {
											echo '<span class="sale-price">'. $price_sales . ' ' .$symbol .'</span>';
										}
						
								echo '</div>';
							}						
						echo '</div>';

						echo '<div class="article-info">';
							echo '<div class="article-info-top">';
								if($show_category == "true") {
									echo '<div class="article-category">'.ewmp_get_category($source,$posts_type,$css_link).'</div>';
								}
								echo '<h3 class="article-title"><a href="'.esc_url($link).'" '.$css_title.'>'.get_the_title().'</a></h3>';									
								echo '<div class="article-info-bottom">';
									if($show_author == "true") {								
										echo '<div class="article-author">'.ewmp_get_author($css_link).'</div>';
									}
									if($show_author == "true" && $show_date == "true") {
										echo '<div class="article-separator">-</div>';
									}
									if($show_date == "true") {	
										echo '<div class="article-date" '.$css_date.'>'.get_the_date().'</div>';
									}
									if($show_button_cart == "true") {
										echo '<div class="cart-button-container">
											<a class="product_type_simple add_to_cart_button ajax_add_to_cart" data-product_sku="" data-product_id="'.$id_post.'" rel="nofollow" href="?add-to-cart='.$id_post.'" '.$css_bg_button_cart.'>'.esc_html__('Add To Cart','elementorwidgetsmegapack').'</a>
										</div>';
									}	
									echo '<div class="clearfix"></div>';	
								echo '</div>';										
							echo '</div>';											
						echo '</div>';				
							
					endif;
							
					echo '</article>';				
					
					$count_clear = $count + 1;
					if(($count_clear % $columns) == 0) : echo '<div class="clearfix"></div>'; endif;
				} 
				
				
				/*************************** STYLE 2 ************************/
				if($blog_style == 'style2') {
					echo '<article class="item-blogs first-element-blogs '.esc_html($columns_class).' '.esc_html($class_item_load_more).' '.esc_html($class_odd).ewmp_animate_class($addon_animate,$effect,$delay).'>';

								echo '<div class="article-image">';
									echo ewmp_get_blogs_thumb($columns,$id_post);
									echo ewmp_check_post_format();
									if($show_price == "true") {
										if(!empty($price_sales) || $price_sales != '') {
											echo '<span class="item-sale">'.esc_html__('Sale','elementorwidgetsmegapack').'</span>';	
										}						
										echo '<div class="article-price article-price" '.$css_bg_price.'>
											<span class="regular-price';
								
												if(!empty($price_sales) || $price_sales != '') {
													echo ' line-through';	
												}
												
												echo '" '.$css_price.'>'. $price . ' ' . $symbol .'</span>';
												
												if(!empty($price_sales) || $price_sales != '') {
													echo '<span class="sale-price">'. $price_sales . ' ' .$symbol .'</span>';
												}
								
										echo '</div>';
									}										
								echo '</div>';					
						
								echo '<div class="article-info">';
									echo '<div class="article-info-top">';								
										if($show_category == "true") {
											echo '<div class="article-category">'.ewmp_get_category($source,$posts_type,$css_link).'</div>';
										}		
										if($show_category == "true" && ($show_author == "true" || $show_date == "true")) {
											echo '<div class="article-separator">-</div>';
										}
										if($show_author == "true") {								
											echo '<div class="article-author">'.ewmp_get_author($css_link).'</div>';
										}
										if($show_author == "true" && $show_date == "true") {
											echo '<div class="article-separator">-</div>';
										}
										if($show_date == "true") {	
											echo '<div class="article-date" '.$css_date.'>'.get_the_date().'</div>';
										}
										echo '<h3 class="article-title"><a href="'.esc_url($link).'" '.$css_title.'>'.get_the_title().'</a></h3>';
									echo '</div>';
										echo '<div class="article-info-bottom">';
										if($show_excerpt == "true") {
											echo '<p class="article-excerpt" '.$css_text.'>' . ewmp_get_blogs_excerpt($num_excerpt,'off',$css_link) . '</p>';	
										}
										if($show_button_cart == "true") {
											echo '<div class="cart-button-container">
												<a class="product_type_simple add_to_cart_button ajax_add_to_cart" data-product_sku="" data-product_id="'.$id_post.'" rel="nofollow" href="?add-to-cart='.$id_post.'" '.$css_bg_button_cart.'>'.esc_html__('Add To Cart','elementorwidgetsmegapack').'</a>
											</div>';
										}								
										echo '<div class="clearfix"></div>';										
										echo '</div>';
									echo '<div class="footer-posts">';							
										echo ewmp_post_social_share($css_link);
									echo '</div>';
								echo '</div>';
							
					echo '</article>';				
					
					$count_clear = $count + 1;
					if(($count_clear % $columns) == 0) : echo '<div class="clearfix"></div>'; endif;										
				}
				
				
				/*************************** STYLE 3 ************************/
				if($blog_style == 'style3') {
					echo '<article class="item-blogs first-element-blogs '.esc_html($columns_class).' '.esc_html($class_item_load_more).' '.esc_html($class_odd).ewmp_animate_class($addon_animate,$effect,$delay).'>';;

						echo '<div class="article-image col-xs-6">';
							echo ewmp_get_thumb('ewmp-large');
							echo ewmp_check_post_format();
							if($show_price == "true") {
								if(!empty($price_sales) || $price_sales != '') {
									echo '<span class="item-sale">'.esc_html__('Sale','elementorwidgetsmegapack').'</span>';	
								}						
								echo '<div class="article-price article-price" '.$css_bg_price.'>
									<span class="regular-price';
						
										if(!empty($price_sales) || $price_sales != '') {
											echo ' line-through';	
										}
										
										echo '" '.$css_price.'>'. $price . ' ' . $symbol .'</span>';
										
										if(!empty($price_sales) || $price_sales != '') {
											echo '<span class="sale-price">'. $price_sales . ' ' .$symbol .'</span>';
										}
						
								echo '</div>';
							}								
							if($show_category == "true") {
									echo '<div class="article-category">'.ewmp_get_category($source,$posts_type,$css_bg_category_link).'</div>';
							}
						echo '</div>';					
						
						echo '<div class="article-info col-xs-6">';
							echo '<h3 class="article-title"><a href="'.esc_url($link).'" '.$css_title.'>'.get_the_title().'</a></h3>';								
							echo '<div class="article-info-top">';								
								if($show_author == "true") {								
									echo '<div class="article-author">'.ewmp_get_author($css_link).'</div>';
								}
								if($show_author == "true" && $show_date == "true") {
									echo '<div class="article-separator">-</div>';
								}
								if($show_date == "true") {	
									echo '<div class="article-date" '.$css_date.'>'.get_the_date().'</div>';
								}
							echo '</div>';																	
							echo '<div class="article-info-bottom">';
								if($show_excerpt == "true") {
									echo '<p class="article-excerpt" '.$css_text.'>' . ewmp_get_blogs_excerpt($num_excerpt,'off',$css_link) . '</p>';	
								}
								if($show_button_cart == "true") {
									echo '<div class="cart-button-container">
										<a class="product_type_simple add_to_cart_button ajax_add_to_cart" data-product_sku="" data-product_id="'.$id_post.'" rel="nofollow" href="?add-to-cart='.$id_post.'" '.$css_bg_button_cart.'>'.esc_html__('Add To Cart','elementorwidgetsmegapack').'</a>
									</div>';
								}								
								echo '<div class="clearfix"></div>';										
							echo '</div>';
							echo ewmp_post_social_share($css_link);
						echo '</div>';
							
					echo '</article>';				
					
					$count_clear = $count + 1;
					if(($count_clear % $columns) == 0) : echo '<div class="clearfix"></div>'; endif;										
				}

				/*************************** STYLE 4 ************************/
				if($blog_style == 'style4') {
					echo '<article class="item-blogs first-element-blogs '.esc_html($columns_class).' '.esc_html($class_item_load_more).' '.esc_html($class_odd).ewmp_animate_class($addon_animate,$effect,$delay).'>';;

						echo '<div class="article-image">';
							echo ewmp_get_blogs_thumb($columns,$id_post);
							echo ewmp_check_post_format();
							if($show_price == "true") {
								if(!empty($price_sales) || $price_sales != '') {
									echo '<span class="item-sale">'.esc_html__('Sale','elementorwidgetsmegapack').'</span>';	
								}						
								echo '<div class="article-price article-price" '.$css_bg_price.'>
									<span class="regular-price';
						
										if(!empty($price_sales) || $price_sales != '') {
											echo ' line-through';	
										}
										
										echo '" '.$css_price.'>'. $price . ' ' . $symbol .'</span>';
										
										if(!empty($price_sales) || $price_sales != '') {
											echo '<span class="sale-price">'. $price_sales . ' ' .$symbol .'</span>';
										}
						
								echo '</div>';
							}								
						echo '</div>';					
						
						echo '<div class="article-info">';
							echo '<div class="article-info-top" '.$css_post_bg_color.'>';
								if($show_category == "true") {
									echo '<div class="article-category">'.ewmp_get_category($source,$posts_type,$css_bg_category_link).'</div>';
								}								
								echo '<h3 class="article-title"><a href="'.esc_url($link).'" '.$css_title.'>'.get_the_title().'</a></h3>';								
								if($show_author == "true") {								
									echo '<div class="article-author">'.ewmp_get_author($css_link).'</div>';
								}
								if($show_author == "true" && $show_date == "true") {
									echo '<div class="article-separator">-</div>';
								}
								if($show_date == "true") {	
									echo '<div class="article-date" '.$css_date.'>'.get_the_date().'</div>';
								}
								if($show_button_cart == "true") {
									echo '<div class="cart-button-container">
										<a class="product_type_simple add_to_cart_button ajax_add_to_cart" data-product_sku="" data-product_id="'.$id_post.'" rel="nofollow" href="?add-to-cart='.$id_post.'" '.$css_bg_button_cart.'>'.esc_html__('Add To Cart','elementorwidgetsmegapack').'</a>
									</div>';
								}									
							echo '</div>';
						echo '</div>';
							
					echo '</article>';				
					
					$count_clear = $count + 1;
					if(($count_clear % $columns) == 0) : echo '<div class="clearfix"></div>'; endif;										
				}

				/*************************** STYLE 5 ************************/
				if($blog_style == 'style5') {
					echo '<article class="item-blogs first-element-blogs '.esc_html($columns_class).' '.esc_html($class_item_load_more).' '.esc_html($class_odd).ewmp_animate_class($addon_animate,$effect,$delay).'>';;

						echo '<div class="article-image">';
							echo ewmp_get_thumb('ewmp-blog-medium-vertical');
							echo ewmp_check_post_format();
							if($show_price == "true") {
								if(!empty($price_sales) || $price_sales != '') {
									echo '<span class="item-sale">'.esc_html__('Sale','elementorwidgetsmegapack').'</span>';	
								}						
								echo '<div class="article-price article-price" '.$css_bg_price.'>
									<span class="regular-price';
						
										if(!empty($price_sales) || $price_sales != '') {
											echo ' line-through';	
										}
										
										echo '" '.$css_price.'>'. $price . ' ' . $symbol .'</span>';
										
										if(!empty($price_sales) || $price_sales != '') {
											echo '<span class="sale-price">'. $price_sales . ' ' .$symbol .'</span>';
										}
						
								echo '</div>';
							}								
							echo '<div class="article-info">';
								echo '<div class="article-info-top">';								
									if($show_category == "true") {
										echo '<div class="article-category">'.ewmp_get_category($source,$posts_type,$css_link).'</div>';
									}										
									echo '<h3 class="article-title"><a href="'.esc_url($link).'" '.$css_title.'>'.get_the_title().'</a></h3>';														
									if($show_button_cart == "true") {
										echo '<div class="cart-button-container">
											<a class="product_type_simple add_to_cart_button ajax_add_to_cart" data-product_sku="" data-product_id="'.$id_post.'" rel="nofollow" href="?add-to-cart='.$id_post.'" '.$css_bg_button_cart.'>'.esc_html__('Add To Cart','elementorwidgetsmegapack').'</a>
										</div>';
									}								
								echo '</div>';
							echo '</div>';
							echo '<div class="item-blogs-pattern"></div>';
						echo '</div>';
							
					echo '</article>';				
					
					$count_clear = $count + 1;
					if(($count_clear % $columns) == 0) : echo '<div class="clearfix"></div>'; endif;										
				}

				/*************************** STYLE 6 ************************/
				if($blog_style == 'style6') {
					echo '<article class="item-blogs first-element-blogs '.esc_html($columns_class).' '.esc_html($class_item_load_more).' '.esc_html($class_odd).ewmp_animate_class($addon_animate,$effect,$delay).'>';;

						echo '<div class="article-image">';
							echo ewmp_get_blogs_thumb($columns,$id_post);
							echo ewmp_check_post_format();
							if($show_price == "true") {
								if(!empty($price_sales) || $price_sales != '') {
									echo '<span class="item-sale">'.esc_html__('Sale','elementorwidgetsmegapack').'</span>';	
								}						
								echo '<div class="article-price article-price" '.$css_bg_price.'>
									<span class="regular-price';
						
										if(!empty($price_sales) || $price_sales != '') {
											echo ' line-through';	
										}
										
										echo '" '.$css_price.'>'. $price . ' ' . $symbol .'</span>';
										
										if(!empty($price_sales) || $price_sales != '') {
											echo '<span class="sale-price">'. $price_sales . ' ' .$symbol .'</span>';
										}
						
								echo '</div>';
							}								
						echo '</div>';				
						echo '<div class="article-info">';
							echo '<div class="article-info-top">';						
								echo '<h3 class="article-title"><a href="'.esc_url($link).'" '.$css_title.'>'.get_the_title().'</a></h3>';
								if($show_excerpt == "true") {
									echo '<p class="article-excerpt" '.$css_text.'>' . ewmp_get_blogs_excerpt($num_excerpt,'off',$css_link) . '</p>';	
								}
								if($show_button_cart == "true") {
									echo '<div class="cart-button-container">
										<a class="product_type_simple add_to_cart_button ajax_add_to_cart" data-product_sku="" data-product_id="'.$id_post.'" rel="nofollow" href="?add-to-cart='.$id_post.'" '.$css_bg_button_cart.'>'.esc_html__('Add To Cart','elementorwidgetsmegapack').'</a>
									</div>';
								}
								echo '<div class="woocommerceproductsdisplay-clear"></div>';	
							echo '</div>';
							echo '<div class="article-info-bottom">';
								if($show_category == "true") {
									echo '<div class="article-category">'.ewmp_get_category($source,$posts_type,$css_link).'</div>';
								}		
								if($show_category == "true" && ($show_author == "true" || $show_date == "true")) {
									echo '<div class="article-separator">-</div>';
								}
								if($show_author == "true") {								
									echo '<div class="article-author">'.ewmp_get_author($css_link).'</div>';
								}
								if($show_author == "true" && $show_date == "true") {
									echo '<div class="article-separator">-</div>';
								}
								if($show_date == "true") {	
									echo '<div class="article-date" '.$css_date.'>'.get_the_date().'</div>';
								}						
							echo '</div>';
						echo '</div>';
							
					echo '</article>';				
					
					$count_clear = $count + 1;
					if(($count_clear % $columns) == 0) : echo '<div class="clearfix"></div>'; endif;										
				}				
				
			$count++;
			endwhile;
		endif;	
		
		echo '</div><div class="clearfix"></div>';
		
		/**********************************************************************/
		/****************************** PAGINATION ****************************/
		/**********************************************************************/ 
		if($pagination == 'yes') {
				echo '<div class="clearfix"></div><div class="woocommerceproductsdisplay-bp-blogs-display-'.esc_html($instance).' woocommerceproductsdisplay-bp-vc-pagination">';
				if($pagination_type == 'numeric') {
					echo ewmp_posts_numeric_pagination($pages = '', $range = 2,$loop,$paged,$css_current_pag_num,$css_link);
				} else {
					echo '<div class="woocommerceproductsdisplay-bp-pagination-normal">';
						echo get_next_posts_link( '<span '.$css_link.'>Older products</span>', $loop->max_num_pages );
						echo get_previous_posts_link( '<span '.$css_link.'>Newer products</span>' );
					echo '</div>';
				}
				echo '<div class="clearfix"></div></div>';
		}
		/**********************************************************************/
		/***************************** #PAGINATION ****************************/
		/**********************************************************************/ 
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
