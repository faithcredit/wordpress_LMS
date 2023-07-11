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
 * Elementor Timeline
 *
 * Elementor widget for team vision
 *
 * @since 1.0.0
 */
class Timeline extends Widget_Base {

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
		return 'timeline';
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
		return esc_html__( 'Timeline', 'elementorwidgetsmegapack' );
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
		return 'eicon-time-line';
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
			'style',
			[
				'label' => esc_html__( 'Style', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => [
					'style1' => esc_html__('Style 1', 'elementorwidgetsmegapack' ),
					'style2' => esc_html__('Style 2', 'elementorwidgetsmegapack' )
				]
			]
		);

		$this->add_control(
			'show_image',
			[
				'label' => esc_html__( 'Show Image', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => [
					'true'  => esc_html__('Show', 'elementorwidgetsmegapack' ),
					'false' => esc_html__('Hidden', 'elementorwidgetsmegapack' )
				]
			]
		);

		$this->add_control(
			'show_category',
			[
				'label' => esc_html__( 'Show Category', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => [
					'true'  => esc_html__('Show', 'elementorwidgetsmegapack' ),
					'false' => esc_html__('Hidden', 'elementorwidgetsmegapack' )
				]
			]
		);

		$this->add_control(
			'show_author',
			[
				'label' => esc_html__( 'Show Author', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => [
					'true'  => esc_html__('Show', 'elementorwidgetsmegapack' ),
					'false' => esc_html__('Hidden', 'elementorwidgetsmegapack' )
				]
			]
		);

		$this->add_control(
			'show_excerpt',
			[
				'label' => esc_html__( 'Show Excerpt', 'elementorwidgetsmegapack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => [
					'true'  => esc_html__('Show', 'elementorwidgetsmegapack' ),
					'false' => esc_html__('Hidden', 'elementorwidgetsmegapack' )
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
			'text_color',
			[
				'label' => esc_html__( 'Text Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#333333',
				'condition'	=> [
					'custom_style'	=> 'on'
				]
			]
		);

		$this->add_control(
			'h_color',
			[
				'label' => esc_html__( 'Hover Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#e7685d',
				'condition'	=> [
					'custom_style'	=> 'on'
				]
			]
		);

		$this->add_control(
			'line_color',
			[
				'label' => esc_html__( 'Line Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#000000',
				'condition'	=> [
					'custom_style'	=> 'on'
				]
			]
		);

		$this->add_control(
			'is_color',
			[
				'label' => esc_html__( 'Icon Separator Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
				'condition'	=> [
					'custom_style'	=> 'on'
				]
			]
		);

		$this->add_control(
			'bg_color',
			[
				'label' => esc_html__( 'Background Color', 'elementorwidgetsmegapack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#6ec1e4',
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
		
        $style					= esc_html($settings['style']);
        $show_image				= esc_html($settings['show_image']);
        $show_category			= esc_html($settings['show_category']);
        $show_author			= esc_html($settings['show_author']);
        $show_excerpt			= esc_html($settings['show_excerpt']);
		
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
        $title_color			= esc_html($settings['title_color']);
        $date_color				= esc_html($settings['date_color']);
        $text_color				= esc_html($settings['text_color']);
        $h_color				= esc_html($settings['h_color']);
        $line_color				= esc_html($settings['line_color']);
        $bg_color				= esc_html($settings['bg_color']);
        $is_color				= esc_html($settings['is_color']);
		
		// Animations
		$addon_animate			= esc_html($settings['addon_animate']);
		$effect					= esc_html($settings['effect']);
		$delay					= esc_html($settings['delay']);
		
		wp_enqueue_style( 'timeline' );
		wp_enqueue_script( 'timeline' );
		wp_enqueue_style( 'animations' );
		wp_enqueue_script( 'appear' );			
		wp_enqueue_script( 'animate' );
		wp_enqueue_style( 'elementor-icons' );
		wp_enqueue_style( 'font-awesome' );
		
		$css_bg_line = 'style="--bg-timeline-color-var:rgba(0,0,0,0.3);"';
		$js_class = $data_value = $css_title = $css_date = $css_text = $css_bg = $no_margin = '';
		if($custom_style == 'on') :

			$css_bg_line = 'style="--bg-timeline-color-var:'.esc_html($line_color).';"';
			$css_title = 'style="color:'.esc_html($title_color).'" onMouseOver="this.style.color = \''.esc_html($h_color).'\';" onMouseLeave="this.style.color = \''.esc_html($title_color).'\';"';
			$css_date = 'style="color:'.esc_html($date_color).'"';
			$css_text = 'style="color:'.esc_html($text_color).'"';
			$css_bg = 'style="background:'.esc_html($bg_color).';color:'.esc_html($is_color).'"';

		endif;

		if($show_image == 'false' && $show_category == 'false' && $show_author == 'false' && $show_excerpt == 'false') {
			$no_margin = 'timeline-no-margin';
		}
		
		echo '<div class="timeline-timeline timeline-timeline-'.esc_html($instance).' '.esc_html($no_margin).' timeline-'.esc_html($style).' '.esc_html($js_class).'" '.$css_bg_line.' '.$data_value.'>';
		
			echo '<section class="timeline-container">';
		
					// LOOP QUERY
					$loop = ewmp_query( $source,
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
			
					
					// Start Query Loop
					$loop = new \WP_Query($loop);	
			
					if($loop) :
						while ( $loop->have_posts() ) : $loop->the_post();
					
							$id_post = get_the_id();
							$link = get_permalink(); 
							
							echo '<div class="timeline-timeline-block '.ewmp_animate_class($addon_animate,$effect,$delay).'>';
							
								echo '<div class="timeline-timeline-img">';
									echo '<div class="timeline-timeline-img">';
										echo '<div class="timeline_format_icon timeline timeline-icon">';
											echo '<span class="fa fa-th-large" '.$css_bg.'>';
											echo '</span>';
										echo '</div>';
									echo '</div>';
								echo '</div>';
								
								echo '<div class="timeline-timeline-content" '.$css_bg.'>';
									echo '<h2><a href="'.get_permalink().'" '.$css_title.'>'.get_the_title().'</a></h2>';
									if($show_image == 'true') {
										echo '<div class="timeline-timeline-image">';
											echo ewmp_get_thumb('ewmp-header');										
										echo '</div>';
									}
									echo '<div class="timeline-timeline-text" '.$css_text.'>';
										echo '<div class="info">';
											if($show_author == 'true') {
												echo '<i class="fa fa-user" '.$css_text.'></i>'.ewmp_get_author($css_title);
											}
											if($show_category == 'true') {
												echo '<i class="fa fa-tags" '.$css_text.'></i>'.ewmp_get_category($source,$posts_type,$css_title,$limit = 1);
											}
										echo '</div>';
										if($show_excerpt == 'true') {
											echo ewmp_get_news_excerpt(200,'on',$css_title);
										}
									echo '</div>';	
									echo '<span class="timeline-date" '.$css_date.'>';
										echo get_the_date();
									echo '</span>';
								echo '</div>';
								
								
								
							echo '</div>';
							
						endwhile;
					endif;	
			echo '</section>';
		echo '<div class="timeline-clear"></div>';
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
