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
 * Elementor WooCommerce Products Tab
 *
 * Elementor widget for WooCommerce Products Tab
 *
 * @since 1.0.0
 */
class WooCommerce_Products_Tab extends Widget_Base {

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
		return 'woocommerce-products-tab';
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
		return esc_html__( 'WooCommerce Products Tab', 'elementorwidgetsmegapack' );
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
		return 'eicon-table';
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
			'vcmp_wootab_image',
			[
				'label' => esc_html__( 'Show Image', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'image_show',
				'options' => [
					'image_show' 	=> 'Show',
					'image_hidden'  => 'Hidden'
				]
			]
		);

		$this->add_control(
			'vcmp_wootab_name',
			[
				'label' => esc_html__( 'Show Title', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'name_show',
				'options' => [
					'name_show' 	=> 'Show',
					'name_hidden'  => 'Hidden'
				]
			]
		);

		$this->add_control(
			'vcmp_wootab_stars',
			[
				'label' => esc_html__( 'Show Stars', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'stars_show',
				'options' => [
					'stars_show' 	=> 'Show',
					'stars_hidden'  => 'Hidden'
				]
			]
		);

		$this->add_control(
			'vcmp_wootab_stock',
			[
				'label' => esc_html__( 'Show Stock', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'stock_show',
				'options' => [
					'stock_show' 	=> 'Show',
					'stock_hidden'  => 'Hidden'
				]
			]
		);

		$this->add_control(
			'vcmp_wootab_price',
			[
				'label' => esc_html__( 'Show Price', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'price_show',
				'options' => [
					'price_show' 	=> 'Show',
					'price_hidden'  => 'Hidden'
				]
			]
		);

		$this->add_control(
			'vcmp_wootab_cart',
			[
				'label' => esc_html__( 'Show Cart', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'cart_show',
				'options' => [
					'cart_show'    => 'Show',
					'cart_hidden'  => 'Hidden'
				]
			]
		);

		$this->add_control(
			'vcmp_wootab_plus',
			[
				'label' => esc_html__( 'Show Plus', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'plus_show',
				'options' => [
					'plus_show' 	=> 'Show',
					'plus_hidden'  	=> 'Hidden'
				]
			]
		);

		$this->end_controls_section();

  		$this->start_controls_section(
  			'section_query',
  			[
  				'label' => esc_html__( 'QUERY', 'elementorwidgetsmegapack' )
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
				'label' => esc_html__( 'Pagination', 'woocommerceproductsdisplayelementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [
					'no'	=> 'No',
					'yes' 	=> 'Yes'
				]
			]
		);

		$this->add_control(
			'num_posts',
			[
				'label' => esc_html__( 'Number Posts', 'woocommerceproductsdisplayelementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => '10',
				'condition'	=> [
					'pagination'	=> 'no'
				]
			]
		);

		$this->add_control(
			'num_posts_page',
			[
				'label' => esc_html__( 'Number Posts For Page', 'woocommerceproductsdisplayelementor' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => '10',
				'condition'	=> [
					'pagination'	=> array('yes')
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
					'fade-in'		=> 'Fade In',
					'fade-in-up' 	=> 'fade in up',					
					'fade-in-down' 	=> 'fade in down',					
					'fade-in-left' 	=> 'fade in Left',					
					'fade-in-right' => 'fade in Right',					
					'fade-out'		=> 'Fade In',
					'fade-out-up' 	=> 'Fade Out up',					
					'fade-out-down' => 'Fade Out down',					
					'fade-out-left' => 'Fade Out Left',					
					'fade-out-right' => 'Fade Out Right',
					'bounce-in'			=> 'Bounce In',
					'bounce-in-up' 		=> 'Bounce in up',					
					'bounce-in-down' 	=> 'Bounce in down',					
					'bounce-in-left' 	=> 'Bounce in Left',					
					'bounce-in-right' 	=> 'Bounce in Right',					
					'bounce-out'		=> 'Bounce In',
					'bounce-out-up' 	=> 'Bounce Out up',					
					'bounce-out-down' 	=> 'Bounce Out down',					
					'bounce-out-left' 	=> 'Bounce Out Left',					
					'bounce-out-right' 	=> 'Bounce Out Right',	
					'zoom-in'			=> 'Zoom In',
					'zoom-in-up' 		=> 'Zoom in up',					
					'zoom-in-down' 		=> 'Zoom in down',					
					'zoom-in-left' 		=> 'Zoom in Left',					
					'zoom-in-right' 	=> 'Zoom in Right',					
					'zoom-out'			=> 'Zoom In',
					'zoom-out-up' 		=> 'Zoom Out up',					
					'zoom-out-down' 	=> 'Zoom Out down',					
					'zoom-out-left' 	=> 'Zoom Out Left',					
					'zoom-out-right' 	=> 'Zoom Out Right',
					'flash' 			=> 'Flash',
					'strobe'			=> 'Strobe',
					'shake-x'			=> 'Shake X',
					'shake-y'			=> 'Shake Y',
					'bounce' 			=> 'Bounce',
					'tada'				=> 'Tada',
					'rubber-band'		=> 'Rubber Band',
					'swing' 			=> 'Swing',
					'spin'				=> 'Spin',
					'spin-reverse'		=> 'Spin Reverse',
					'slingshot'			=> 'Slingshot',
					'slingshot-reverse'	=> 'Slingshot Reverse',
					'wobble'			=> 'Wobble',
					'pulse' 			=> 'Pulse',
					'pulsate'			=> 'Pulsate' ,
					'heartbeat'			=> 'Heartbeat',
					'panic' 			=> 'Panic'					
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
			'vcmp_wootab_fs',
			[
				'label' => esc_html__( 'Font Size (px)', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => '10'
			]
		);		
		
		$this->add_control(
			'vcmp_wootab_background_color',
			[
				'label' => esc_html__( 'Background Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FCFCFC'
			]
		);

		$this->add_control(
			'vcmp_wootab_secondary_color',
			[
				'label' => esc_html__( 'Secondary Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#F0F0F0'
			]
		);

		$this->add_control(
			'vcmp_wootab_border_color',
			[
				'label' => esc_html__( 'Border Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#EEEEEE'
			]
		);

		$this->add_control(
			'vcmp_wootab_font_color',
			[
				'label' => esc_html__( 'Font Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#717171'
			]
		);

		$this->add_control(
			'vcmp_wootab_a_color',
			[
				'label' => esc_html__( 'Link Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#515151'
			]
		);

		$this->add_control(
			'vcmp_wootab_over_color',
			[
				'label' => esc_html__( 'Over Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#7D7D7D'
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

		$vcmp_wootab_image 					= esc_html($settings['vcmp_wootab_image']);
		$vcmp_wootab_name 					= esc_html($settings['vcmp_wootab_name']);
		$vcmp_wootab_stars 					= esc_html($settings['vcmp_wootab_stars']);
		$vcmp_wootab_stock 					= esc_html($settings['vcmp_wootab_stock']);
		$vcmp_wootab_price 					= esc_html($settings['vcmp_wootab_price']);
		$vcmp_wootab_cart 					= esc_html($settings['vcmp_wootab_cart']);
		$vcmp_wootab_plus 					= esc_html($settings['vcmp_wootab_plus']);
		$vcmp_wootab_filter					= 'off';
		
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
		$pagination_type		= 'numeric';
		$num_posts_page			= esc_html($settings['num_posts_page']);
		$num_posts				= esc_html($settings['num_posts']);	
		$orderby				= esc_html($settings['orderby']);
		$order					= esc_html($settings['order']);
		
		// Style
		$vcmp_wootab_fs							= esc_html($settings['vcmp_wootab_fs']);
		$vcmp_wootab_background_color			= esc_html($settings['vcmp_wootab_background_color']);
		$vcmp_wootab_secondary_color			= esc_html($settings['vcmp_wootab_secondary_color']);
		$vcmp_wootab_border_color				= esc_html($settings['vcmp_wootab_border_color']);
		$vcmp_wootab_font_color					= esc_html($settings['vcmp_wootab_font_color']);
		$vcmp_wootab_a_color					= esc_html($settings['vcmp_wootab_a_color']);
		$vcmp_wootab_over_color					= esc_html($settings['vcmp_wootab_over_color']);

		// Animate
		$addon_animate 					= esc_html($settings['addon_animate']);
		$effect 						= esc_html($settings['effect']);
		$delay 							= esc_html($settings['delay']);

		wp_enqueue_style( 'woocommerce-ewmp' );
		wp_enqueue_script('woocommerceproductstab');
		wp_enqueue_style( 'fonts-vc' );
		wp_enqueue_style( 'elementor-icons' );
		wp_enqueue_style( 'font-awesome' );
			
		$output = '';

			echo '<style type="text/css">';		
			
				echo '.vcmp-wootab-'.esc_html($instance).' {
					color:'.$vcmp_wootab_font_color.';					 
				 }
				 .vcmp-wootab-'.esc_html($instance).' {
					font-size: '.$vcmp_wootab_fs.'!important;
				 }
				 .vcmp-wootab-'.esc_html($instance).' a {
					color:'.$vcmp_wootab_a_color.';
				 }
				 .vcmp-wootab-'.esc_html($instance).' a:hover {
					color:'.$vcmp_wootab_over_color.';
				 }					 				 			
				.vcmp-wootab.vcmp-controls-'.esc_html($instance).' ul li {
					background:'.$vcmp_wootab_secondary_color.';
					color:'.$vcmp_wootab_a_color.';	
				}				
				.vcmp-wootab.vcmp-controls-'.esc_html($instance).' ul li:hover, 
				.vcmp-wootab.vcmp-controls-'.esc_html($instance).' ul li.active {
					color:'.$vcmp_wootab_over_color.';
				}				
				.vcmp-wootab-'.esc_html($instance).'.vcmp-pagination .fnwp-numeric-pagination .current,
				.vcmp-wootab-'.esc_html($instance).'.vcmp-pagination .fnwp-numeric-pagination a {
					background:'.$vcmp_wootab_secondary_color.';
					color:'.$vcmp_wootab_a_color.';
				}
				.vcmp-wootab-'.esc_html($instance).'.vcmp-pagination .fnwp-numeric-pagination a:hover,
				.vcmp-wootab-'.esc_html($instance).'.vcmp-pagination .fnwp-numeric-pagination .current {	
					color:'.$vcmp_wootab_over_color.';
				}						
				.vcmp-wootab-'.esc_html($instance).' .vcmp-header-container {
					background:'.$vcmp_wootab_background_color.';
					border-color:'.$vcmp_wootab_border_color.';
				}
				.vcmp-wootab-'.esc_html($instance).' .add_to_cart_button,
				.vcmp-wootab-'.esc_html($instance).' .plus_show,
				.vcmp-wootab-'.esc_html($instance).' .wc-forward,
				.vcmp-wootab-'.esc_html($instance).' .vcmp-item-sale {
					background:'.$vcmp_wootab_secondary_color.';
				}';
						
			echo '</style>';

			echo '<div class="vcmp-wootab vcmp-'.esc_html($instance).' vcmp-wootab-'.esc_html($instance).'';
				if($vcmp_wootab_filter == 'true') {
					echo ' vcmp-filter ';	
				}				
			echo ewmp_animate_class($addon_animate,$effect,$delay).'>';
			
			echo '<div class="vcmp-item vcmp-woo-title-table">';
			echo '<div class="vcmp-container-thumbs"><div class="vcmp-header-container">';
			
			if($vcmp_wootab_image == 'image_show') {
				echo '<div class="vcmp-woo-image">'.esc_html__('Image Product','elementorwidgetsmegapack').'</div>';
			}
			
			if($vcmp_wootab_name == 'name_show') {
				echo '<div class="vcmp-woo-name">'.esc_html__('Name','elementorwidgetsmegapack').'</div>';
			}
			
			if($vcmp_wootab_stars == 'stars_show') {
				echo '<div class="vcmp-woo-stars">'.esc_html__('Stars','elementorwidgetsmegapack').'</div>';
			}
			
			if($vcmp_wootab_stock == 'stock_show') {
				echo '<div class="vcmp-woo-stock">'.esc_html__('Stock','elementorwidgetsmegapack').'</div>';
			}
			
			if($vcmp_wootab_price == 'price_show') {
				echo '<div class="vcmp-woo-price">'.esc_html__('Price','elementorwidgetsmegapack').'</div>';
			}
			
			if($vcmp_wootab_cart == 'cart_show' && $vcmp_wootab_plus == 'plus_show') {
				echo '<div class="vcmp-woo-link">'.esc_html__('More Info','elementorwidgetsmegapack').'</div>';
			}
						
			echo '<div class="vcmp-clear"></div></div></div></div>';

						
					
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
				
				$i = -1;
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
							
		$loop = new \WP_Query($query);		

		if($loop) :
			while ( $loop->have_posts() ) : $loop->the_post();
			
					$link = get_permalink();
					$id_post = get_the_id();
					$product = new \WC_Product( $id_post );
					$price = $product->get_regular_price();
					if(empty($price)) {
						$price = $product->get_price();
					}
					$price_sales = $product->get_sale_price();
					$symbol = get_woocommerce_currency_symbol();					
					
					
					$id = get_the_id();
					$_post = get_post( $id );

					$image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id($_post->ID), 'wpfpg_grid' );

				if($vcmp_wootab_filter == 'true') {
					
					echo vcmp_filter_item_div('wp_custom_posts_type',$vcmp_query_categories,'product');
					
				} else {
				
					echo '<div class="vcmp-item">';
				
				}
				
				echo '<div class="vcmp-container-thumbs"><div class="vcmp-header-container">';
				
				// IMAGE PRODUCT
				if($vcmp_wootab_image == 'image_show') {
					echo '<div class="vcmp-woo-image">';
						if(!empty($price_sales) || $price_sales != '') {
							echo '<span class="vcmp-item-sale">'.esc_html__('Sale','elementorwidgetsmegapack').'</span>';	
						}				
					echo ewmp_get_thumb('wpfpg_grid');
					echo '</div>';
				}
				
				if($vcmp_wootab_name == 'name_show') {
					// WOO NAME
					echo '<div class="vcmp-woo-name">';
					echo '<a href='.$link.'>'.get_the_title().'</a>';
					echo wc_get_product_category_list( get_the_id(), ', ', '<span>',  '</span>' );
					echo '</div>';
				}
				
				if($vcmp_wootab_stars == 'stars_show') {
					// WOO STARS
					echo '<div class="vcmp-woo-stars woocommerce">';
					$average = $product->get_average_rating();
	
					echo '<div class="star-rating"><span style="width:'.( ( $average / 5 ) * 100 ) . '%"><strong itemprop="ratingValue" class="rating">'.$average.'</strong> '.esc_html__( 'out of 5', 'woocommerce' ).'</span></div>';
	
					echo '</div>';
				}
				
				if($vcmp_wootab_stock == 'stock_show') {
					// WOO STOCK
					echo '<div class="vcmp-woo-stock">';
					// Availability
					$availability = $product->get_availability();
					if ($availability['availability']) :
						echo apply_filters( 'woocommerce_stock_html', '<p class="stock ' . esc_attr( $availability['class'] ) . '">' . esc_html( $availability['availability'] ) . '</p>', $availability['availability'] );
					else:
						echo esc_html__('No in stock','elementorwidgetsmegapack');
					endif;
					echo '</div>';
				}
				
				if($vcmp_wootab_price == 'price_show') {
					// WOO PRICE
					echo '<div class="vcmp-woo-price">';
						echo '<span class="vcmp-price"><span class="vcmp-regular-price';
						
						if(!empty($price_sales) || $price_sales != '') {
							echo' vcmp-line-through';	
						}
						
						echo '">'. $price . $symbol .'</span>';
						
						if(!empty($price_sales) || $price_sales != '') {
							echo '<span class="vcmp-sale-price">'. $price_sales . $symbol .'</span>';
						}
						echo '</span>';									
					echo '</div>';
				}
				
				// WOO ADD TO CART - READ MORE
				echo '<div class="vcmp-woo-link">';
					if($vcmp_wootab_cart == 'cart_show') {			
						echo '<a class="product_type_simple add_to_cart_button ajax_add_to_cart" data-product_sku="" data-product_id="'.$id_post.'" rel="nofollow" href="?add-to-cart='.$id_post.'">'.esc_html__('Add to Cart','elementorwidgetsmegapack').'</a>';
					}
					if($vcmp_wootab_plus == 'plus_show') {			
						echo'<a href="'.$link.'" class="plus_show">'.esc_html__('Read More','elementorwidgetsmegapack').'</a>';
					}								
				echo '</div>';
								
				echo '<div class="vcmp-clear"></div></div>';										
				echo '</div>';											
				echo '</div>'; // #VCMP-ITEM

			endwhile;
		endif;				 
		echo '</div><div class="clearfix"></div>';
		
		/**********************************************************************/
		/****************************** PAGINATION ****************************/
		/**********************************************************************/ 
		if($pagination == 'yes') {
				echo '<div class="clearfix"></div><div id="vcmp-wootab-pagination-'.esc_html($instance).'" class="vcmp-wootab-'.esc_html(esc_html($instance)).' vcmp-pagination">';
				
				echo ewmp_posts_numeric_pagination($pages = '', $range = 2,$loop,$paged,'','');
			
				echo '<div class="clearfix"></div></div>';
		}
		/**********************************************************************/
		/***************************** #PAGINATION ****************************/
		/**********************************************************************/ 
		wp_reset_query();
		//echo '</div>';
				
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
