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
class FPG_Grid extends Widget_Base {

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
		return 'fpg-grid';
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
		return esc_html__( 'FPG GRID', 'elementorwidgetsmegapack' );
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
			'skin',
			[
				'label' => esc_html__( 'Skin', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'castelsantangelo',
				'options' => [
					'castelsantangelo' 	=> esc_html__('Castel Sant&#180;Angelo', 'elementorwidgetsmegapack' ),
					'domusaurea' 		=> esc_html__('Domus Aurea', 'elementorwidgetsmegapack' ),
					'foriimperiali' 	=> esc_html__('Fori Imperiali', 'elementorwidgetsmegapack' ),
					'pantheon' 			=> esc_html__('Pantheon', 'elementorwidgetsmegapack' ),
					'circomassimo' 		=> esc_html__('Circo Massimo', 'elementorwidgetsmegapack' ),
					'fontanaditrevi' 	=> esc_html__('Fontana di Trevi', 'elementorwidgetsmegapack' ),
					'termedicaracalla' 	=> esc_html__('Terme di Caracalla', 'elementorwidgetsmegapack' ),
					'piazzacolonna' 	=> esc_html__('Piazza Colonna', 'elementorwidgetsmegapack' )
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
					'3' => '3',
					'4' => '4',
					'5' => '5'
				]
			]
		);

		$this->add_control(
			'grid_masonry',
			[
				'label' => esc_html__( 'Grid/Masonry', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'wpfpg_grid',
				'options' => [
					'wpfpg_grid'  => esc_html__('Grid', 'elementorwidgetsmegapack' ),
					'wpfpg_masonry' => esc_html__('Masonry', 'elementorwidgetsmegapack' )
				]
			]
		);

		$this->add_control(
			'filter',
			[
				'label' => esc_html__( 'Filter', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'off',
				'options' => [
					'on'  => esc_html__('Show', 'elementorwidgetsmegapack' ),
					'off' => esc_html__('Hidden', 'elementorwidgetsmegapack' )
				],
				'condition'	=> [
					'grid_masonry'	=> 'wpfpg_grid'
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

		$this->add_control(
			'margin_right',
			[
				'label' => esc_html__( 'Margin right (px)', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::TEXT,
				'default' => '10px',
				'condition'	=> [
					'custom_style'	=> 'on'
				]
			]
		);	

		$this->add_control(
			'margin_bottom',
			[
				'label' => esc_html__( 'Margin bottom (px)', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::TEXT,
				'default' => '10px',
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
        $columns				= esc_html($settings['columns']);
        $filter					= esc_html($settings['filter']);
        $grid_masonry			= esc_html($settings['grid_masonry']);
		
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
		$pagination				= 'no';
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
        $margin_right			= esc_html($settings['margin_right']);
        $margin_bottom			= esc_html($settings['margin_bottom']);
		
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
		wp_enqueue_script( 'fastportfoliogrid' );
		
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
				if($skin == 'castelsantangelo') {$fonts = 'google_fonts'; $gfonts = 'Open Sans'; 	$title_fs = '25';
					$content_fs = '14';	$main_color = 'rgba(0,0,0,0.4)';$secondary_color = 'rgba(0,0,0,0.6)';
					$font_color = 'rgba(255,255,255,1)'; $a_color = 'rgba(255,255,255,1)';
					$over_color = 'rgba(0,0,0,1)';$margin_right = '0'; $margin_bottom = '0';	
				}
				if($skin == 'domusaurea') {$fonts = 'google_fonts'; $gfonts = 'Open Sans'; 	$title_fs = '25';
					$content_fs = '14';	$main_color = 'rgba(0,56,79,1)';$secondary_color = 'rgba(139,169,182,1)';
					$font_color = 'rgba(139,169,182,1)'; $a_color = 'rgba(0,56,79,1)';
					$over_color = 'rgba(255,255,255,1)';$margin_right = '20px'; $margin_bottom = '20px';	
				}
				if($skin == 'foriimperiali') {$fonts = 'google_fonts'; $gfonts = 'Open Sans'; 	$title_fs = '16';
					$content_fs = '14';	$main_color = 'rgba(22,160,133,1)';$secondary_color = 'rgba(255,255,255,1)';
					$font_color = 'rgba(255,255,255,1)'; $a_color = 'rgba(22,160,133,1)';
					$over_color = 'rgba(5,39,32,1)';$margin_right = '0'; $margin_bottom = '0';	
				}
				if($skin == 'pantheon') {$fonts = 'google_fonts'; $gfonts = 'Open Sans'; 	$title_fs = '22';
					$content_fs = '14';	$main_color = 'rgba(0,0,0,0.4)';$secondary_color = 'rgba(0,0,0,1)';
					$font_color = 'rgba(255,255,255,1)'; $a_color = 'rgba(255,255,255,1)';
					$over_color = 'rgba(153,153,153,1)';$margin_right = '0'; $margin_bottom = '0';	
				}
				if($skin == 'circomassimo') {$fonts = 'google_fonts'; $gfonts = 'Open Sans'; 	$title_fs = '15';
					$content_fs = '14';	$main_color = 'rgba(0,0,0,0.6)';$secondary_color = 'rgba(192,57,43,1)';
					$font_color = 'rgba(255,255,255,1)'; $a_color = 'rgba(255,255,255,1)';
					$over_color = 'rgba(0,0,0,1)';$margin_right = '25px'; $margin_bottom = '25px';	
				}
				if($skin == 'fontanaditrevi') {$fonts = 'google_fonts'; $gfonts = 'Open Sans'; 	$title_fs = '15';
					$content_fs = '14';	$main_color = 'rgba(211,84,0,1)';$secondary_color = 'rgba(230,126,34,1)';
					$font_color = 'rgba(255,255,255,1)'; $a_color = 'rgba(255,255,255,1)';
					$over_color = 'rgba(0,0,0,1)';$margin_right = '10px'; $margin_bottom = '10px';	
				}
				if($skin == 'termedicaracalla') {$fonts = 'google_fonts'; $gfonts = 'Open Sans'; 	$title_fs = '29';
					$content_fs = '15';	$main_color = 'rgba(142,68,173,0.3)';$secondary_color = 'rgba(155,89,182,1)';
					$font_color = 'rgba(255,255,255,1)'; $a_color = 'rgba(255,255,255,1)';
					$over_color = 'rgba(0,0,0,1)';$margin_right = '0'; $margin_bottom = '0';	
				}
				if($skin == 'piazzacolonna') {$fonts = 'google_fonts'; $gfonts = 'Open Sans'; 	$title_fs = '15';
					$content_fs = '15';	$main_color = 'rgba(52,152,219,0.6)';$secondary_color = 'rgba(255,255,255,1)';
					$font_color = 'rgba(255,255,255,1)'; $a_color = 'rgba(255,255,255,1)';
					$over_color = 'rgba(0,0,0,1)';$margin_right = '0'; $margin_bottom = '0';	
				}
			endif;
			echo ewmp_custom_style($instance,
											'fpg-type-grid',
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

		echo '<div class="fpg-general-container fpg-filter-'.esc_html($filter).' fpg-container-number-'.esc_html($instance).' '.esc_html($skin).'">';

		/************** FILTER ***************/
		if($filter == 'on') {
			wp_enqueue_script( 'mixitup' );
			echo ewmp_filter_item($skin,$instance,$source,$categories,'',$categories_post_type,$posts_type);
			echo '<div class="fpg-clear"></div>';
		}
		
		echo '<div class="fpg-container fpg-type-grid grid-columns-'.esc_html($columns).' fpg-grid fpg-icon  fpg-'.esc_html($instance).' '.esc_html($skin).' '.esc_html($grid_masonry).' '.ewmp_animate_class($addon_animate,$effect,$delay).'>';
		
		$numthumbs = 1;
		// Start Query Loop
		$loop = new \WP_Query($query);		

		
		if($loop) :
			while ( $loop->have_posts() ) : $loop->the_post();
		
				$id_post = get_the_id();
				$link = get_permalink(); 
				
				/************** FILTER ***************/
				if($filter == 'on') {
					echo ewmp_filter_item_figure($source,$categories,'',$categories_post_type,$posts_type);
				} else {
					echo '<figure class="fpg-grid-item">';
				}
				/************** #FILTER ***************/
		
				$url_image = ewmp_get_thumbs_link();
				echo ewmp_get_thumb($grid_masonry);
				echo '<div class="fpg-container-grid">';
						if($skin == 'foriimperiali' || $skin == 'pantheon' || $skin == 'circomassimo' || $skin == 'fontanaditrevi' || $skin == 'termedicaracalla' || $skin == 'piazzacolonna') {
							echo '<h1 class="fpg-title">'.get_the_title().'</h1>';
						}
						echo '<span class="fpg-zoom"><a href="'.esc_url($url_image).'" class="icon-search fpg-zoom-image fa fa-search" title="'.get_the_title().'"></a></span>
							<span class="fpg-read-more"><a href="'.esc_url($link).'" class="icon-link fa fa-link"></a></span>
						</div>';
						
				echo '</figure>'; // CLOSE FIGURE
		
				$numthumbs++;	
			endwhile;
		endif;	
		
		echo '</div><div class="clearfix"></div>';		
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
