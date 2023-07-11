<?php
/**
 * Custom Customizer Controls.
 *
 * @package Newsup
 */

/**
 * Custom Controls of theme
 *
 * @since 1.0.0
 *
 * @see WP_Customize_Control
 */

class Newsup_Section_Title extends WP_Customize_Control {
    public $type = 'section-title';
    public $label = '';
    public $description = '';

    public function enqueue()
    {

        wp_enqueue_style('newsup-custom-controls-css', trailingslashit(get_template_directory_uri()) . 'inc/ansar/customize/css/customizer.css', array(), '1.0', 'all');
    }

    public function render_content() {
        ?>
        <h3><?php echo esc_html( $this->label ); ?></h3>
        <?php if (!empty($this->description)) { ?>
            <span class="customize-control-description"><?php echo esc_html($this->description); ?></span>
        <?php } ?>
        <?php
    }
}


/**
 * Customize Control for Taxonomy Select.
 *
 * @since 1.0.0
 *
 * @see WP_Customize_Control
 */
class Newsup_Dropdown_Taxonomies_Control extends WP_Customize_Control {

    /**
     * Control type.
     *
     * @access public
     * @var string
     */
    public $type = 'dropdown-taxonomies';

    /**
     * Taxonomy.
     *
     * @access public
     * @var string
     */
    public $taxonomy = '';

    /**
     * Constructor.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Manager $manager Customizer bootstrap instance.
     * @param string               $id      Control ID.
     * @param array                $args    Optional. Arguments to override class property defaults.
     */
    public function __construct( $manager, $id, $args = array() ) {

        $our_taxonomy = 'category';
        if ( isset( $args['taxonomy'] ) ) {
            $taxonomy_exist = taxonomy_exists( $args['taxonomy']  );
            if ( true === $taxonomy_exist ) {
                $our_taxonomy =  $args['taxonomy'];
            }
        }
        $args['taxonomy'] = $our_taxonomy;
        $this->taxonomy =  $our_taxonomy;

        parent::__construct( $manager, $id, $args );
    }

    /**
     * Render content.
     *
     * @since 1.0.0
     */
    public function render_content() {

        $tax_args = array(
            'hierarchical' => 0,
            'taxonomy'     => $this->taxonomy,
        );
        $all_taxonomies = get_categories( $tax_args );

        ?>
        <label>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <?php if ( ! empty( $this->description ) ) : ?>
                <span class="description customize-control-description"><?php echo $this->description; ?></span>
            <?php endif; ?>
            <select <?php $this->link(); ?>>
                <?php
                printf( '<option value="%s" %s>%s</option>', 0, selected( $this->value(), '', false ), __( 'All', 'newsup' )  );
                ?>
                <?php if ( ! empty( $all_taxonomies ) ) :  ?>
                    <?php foreach ( $all_taxonomies as $key => $tax ) :  ?>
                        <?php
                        printf( '<option value="%s" %s>%s</option>', esc_attr( $tax->term_id ), selected( $this->value(), $tax->term_id, false ), esc_html( $tax->name ) );
                        ?>
                    <?php endforeach ?>
                <?php endif ?>
            </select>
        </label>
        <?php
    }
}


/**
 * Customize Control for Radio Image.
 *
 * @since 1.0.0
 *
 * @see WP_Customize_Control
 */
class Newsup_Radio_Image_Control extends WP_Customize_Control {
        
        /**
         * Declare the control type.
         *
         * @access public
         * @var string
         */
        public $type = 'radio-image';
        
        /**
         * Enqueue scripts and styles for the custom control.
         * 
         * Scripts are hooked at {@see 'customize_controls_enqueue_scripts'}.
         * 
         * Note, you can also enqueue stylesheets here as well. Stylesheets are hooked
         * at 'customize_controls_print_styles'.
         *
         * @access public
         */
        public function enqueue() {
            wp_enqueue_script( 'jquery-ui-button' );
        }
        
        /**
         * Render the control to be displayed in the Customizer.
         */
        public function render_content() {
            if ( empty( $this->choices ) ) {
                return;
            }           
            
            $name = '_customize-radio-' . $this->id;
            ?>
            <span class="customize-control-title">
                <?php echo esc_attr( $this->label ); ?>
                <?php if ( ! empty( $this->description ) ) : ?>
                    <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
                <?php endif; ?>
            </span>
            <div id="input_<?php echo $this->id; ?>" class="image">
                <?php foreach ( $this->choices as $value => $label ) : ?>
                    <input class="image-select" type="radio" value="<?php echo esc_attr( $value ); ?>" id="<?php echo $this->id . $value; ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?>>
                        <label for="<?php echo $this->id . $value; ?>">
                            <img src="<?php echo esc_html( $label ); ?>" alt="<?php echo esc_attr( $value ); ?>" title="<?php echo esc_attr( $value ); ?>">
                        </label>
                    </input>
                <?php endforeach; ?>
            </div>
            <script>jQuery(document).ready(function($) { $( '[id="input_<?php echo $this->id; ?>"]' ).buttonset(); });</script>
            <?php
        }
    }