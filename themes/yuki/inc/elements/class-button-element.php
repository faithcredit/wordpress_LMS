<?php

/**
 * Button element
 *
 * @package Yuki
 */
use  LottaFramework\Customizer\Controls\Separator ;
use  LottaFramework\Customizer\Controls\Tabs ;
use  LottaFramework\Customizer\Controls\Text ;
use  LottaFramework\Customizer\Controls\Toggle ;
use  LottaFramework\Customizer\GenericBuilder\Element ;
use  LottaFramework\Facades\Css ;
use  LottaFramework\Facades\CZ ;
use  LottaFramework\Utils ;

if ( !defined( 'ABSPATH' ) ) {
    exit;
    // Exit if accessed directly.
}

if ( !class_exists( 'Yuki_Button_Element' ) ) {
    class Yuki_Button_Element extends Element
    {
        use  Yuki_Button_Controls ;
        /**
         * @param null $id
         * @param array $data
         */
        public function after_register( $id = null, $data = array() )
        {
        }
        
        /**
         * {@inheritDoc}
         */
        public function getControls()
        {
            return [ ( new Tabs() )->setActiveTab( 'content' )->addTab( 'content', __( 'Content', 'yuki' ), [
                ( new Text( $this->getSlug( 'label' ) ) )->setLabel( __( 'Button Label', 'yuki' ) )->asyncText( ".{$this->slug}" )->setDefaultValue( __( 'Button', 'yuki' ) ),
                ( new Text( $this->getSlug( 'link' ) ) )->setLabel( __( 'Button Link', 'yuki' ) )->selectiveRefresh( ...$this->selectiveRefresh() )->setDefaultValue( '#' ),
                new Separator(),
                ( new Toggle( $this->getSlug( 'open_new_tab' ) ) )->setLabel( __( 'Open In New Tab', 'yuki' ) )->selectiveRefresh( ...$this->selectiveRefresh() )->closeByDefault(),
                ( new Toggle( $this->getSlug( 'no_follow' ) ) )->setLabel( __( 'No Follow', 'yuki' ) )->selectiveRefresh( ...$this->selectiveRefresh() )->closeByDefault()
            ] )->addTab( 'style', __( 'Style', 'yuki' ), $this->getButtonStyleControls( $this->slug . '_', [
                'selective-refresh' => true,
                'button-selector'   => ".{$this->slug}",
            ] ) ) ];
        }
        
        /**
         * {@inheritDoc}
         */
        public function enqueue_frontend_scripts()
        {
            // Add button dynamic css
            add_filter( 'yuki_filter_dynamic_css', function ( $css ) {
                $css[".{$this->slug}"] = array_merge(
                    [
                    '--yuki-button-height' => CZ::get( $this->getSlug( 'min_height' ) ),
                ],
                    Css::shadow( CZ::get( $this->getSlug( 'shadow' ) ), '--yuki-button-shadow' ),
                    Css::shadow( CZ::get( $this->getSlug( 'shadow_active' ) ), '--yuki-button-shadow-active' ),
                    Css::typography( CZ::get( $this->getSlug( 'typography' ) ) ),
                    Css::dimensions( CZ::get( $this->getSlug( 'padding' ) ), '--yuki-button-padding' ),
                    Css::dimensions( CZ::get( $this->getSlug( 'radius' ) ), '--yuki-button-radius' ),
                    Css::colors( CZ::get( $this->getSlug( 'text_color' ) ), [
                    'initial' => '--yuki-button-text-initial-color',
                    'hover'   => '--yuki-button-text-hover-color',
                ] ),
                    Css::colors( CZ::get( $this->getSlug( 'button_color' ) ), [
                    'initial' => '--yuki-button-initial-color',
                    'hover'   => '--yuki-button-hover-color',
                ] ),
                    Css::border( CZ::get( $this->getSlug( 'border' ) ), '--yuki-button-border' )
                );
                return $css;
            } );
        }
        
        /**
         * {@inheritDoc}
         */
        public function render( $attrs = array() )
        {
            $attrs['class'] = Utils::clsx( [ 'yuki-button', $this->slug ], $attrs['class'] ?? [] );
            $this->add_render_attribute( 'button', 'href', esc_url( CZ::get( $this->getSlug( 'link' ) ) ) );
            if ( CZ::checked( $this->getSlug( 'open_new_tab' ) ) ) {
                $this->add_render_attribute( 'button', 'target', '_blank' );
            }
            if ( CZ::checked( $this->getSlug( 'no_follow' ) ) ) {
                $this->add_render_attribute( 'button', 'rel', 'nofollow' );
            }
            foreach ( $attrs as $attr => $value ) {
                $this->add_render_attribute( 'button', $attr, $value );
            }
            $label = CZ::get( $this->getSlug( 'label' ) );
            ?>
            <a <?php 
            $this->print_attribute_string( 'button' );
            ?>>
				<?php 
            echo  esc_html( $label ) ;
            ?>
            </a>
			<?php 
        }
    
    }
}