<?php

/**
 * Copyright element
 *
 * @package Yuki
 */
use  LottaFramework\Customizer\Controls\ColorPicker ;
use  LottaFramework\Customizer\Controls\Editor ;
use  LottaFramework\Customizer\Controls\Tabs ;
use  LottaFramework\Customizer\Controls\Typography ;
use  LottaFramework\Customizer\GenericBuilder\Element ;
use  LottaFramework\Facades\AsyncCss ;
use  LottaFramework\Facades\Css ;
use  LottaFramework\Facades\CZ ;
use  LottaFramework\Utils ;

if ( !defined( 'ABSPATH' ) ) {
    exit;
    // Exit if accessed directly.
}

if ( !class_exists( 'Yuki_Copyright_Element' ) ) {
    class Yuki_Copyright_Element extends Element
    {
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
            return [ ( new Tabs() )->setActiveTab( 'content' )->addTab( 'content', __( 'Content', 'yuki' ), $this->getContentControls() )->addTab( 'style', __( 'Style', 'yuki' ), [ ( new Typography( $this->getSlug( 'typography' ) ) )->setLabel( __( 'Typography', 'yuki' ) )->asyncCss( ".{$this->slug}", AsyncCss::typography() )->setDefaultValue( [
                'family'     => 'inherit',
                'fontSize'   => '0.85rem',
                'variant'    => '400',
                'lineHeight' => '1.5em',
            ] ), ( new ColorPicker( $this->getSlug( 'color' ) ) )->setLabel( __( 'Color', 'yuki' ) )->enableAlpha()->asyncColors( ".{$this->slug}", array(
                'text'    => 'color',
                'initial' => '--yuki-link-initial-color',
                'hover'   => '--yuki-link-hover-color',
            ) )->addColor( 'text', __( 'Text Initial', 'yuki' ), 'var(--yuki-accent-active)' )->addColor( 'initial', __( 'Initial', 'yuki' ), 'var(--yuki-primary-color)' )->addColor( 'hover', __( 'Hover', 'yuki' ), 'var(--yuki-primary-active)' ) ] ) ];
        }
        
        protected function getContentControls()
        {
            return [ yuki_upsell_info_control( __( 'Upgrade to our %sPro Version%s to change the copyright text', 'yuki' ) ) ];
        }
        
        /**
         * {@inheritDoc}
         */
        public function enqueue_frontend_scripts()
        {
            // Add button dynamic css
            add_filter( 'yuki_filter_dynamic_css', function ( $css ) {
                $css[".{$this->slug}"] = array_merge( Css::typography( CZ::get( $this->getSlug( 'typography' ) ) ), Css::colors( CZ::get( $this->getSlug( 'color' ) ), [
                    'text'    => 'color',
                    'initial' => '--yuki-link-initial-color',
                    'hover'   => '--yuki-link-hover-color',
                ] ) );
                return $css;
            } );
        }
        
        /**
         * {@inheritDoc}
         */
        public function render( $attrs = array() )
        {
            $attrs['class'] = Utils::clsx( [ 'yuki-copyright', 'yuki-raw-html', $this->slug ], $attrs['class'] ?? [] );
            foreach ( $attrs as $attr => $value ) {
                $this->add_render_attribute( 'copyright', $attr, $value );
            }
            $theme = wp_get_theme();
            $theme_info = sprintf( '<a href="%s" target="_blank">%s</a>', esc_url( $theme->get( 'ThemeURI' ) ), $theme->get( 'Name' ) . ' ' . esc_html( __( 'Theme', 'yuki' ) ) );
            $theme_version = 'v' . $theme->get( 'Version' );
            $author_info = sprintf( '<a href="%s" target="_blank">%s</a>', esc_url( $theme->get( 'AuthorURI' ) ), $theme->get( 'Author' ) );
            $text = 'Copyright &copy; {current_year}  -  {about_theme} By {about_author}';
            $text = str_replace( '{current_year}', date( 'Y' ), $text );
            $text = str_replace( '{site_title}', get_bloginfo( 'name' ), $text );
            $text = str_replace( '{about_theme}', $theme_info, $text );
            $text = str_replace( '{theme_version}', $theme_version, $text );
            $text = str_replace( '{about_author}', $author_info, $text );
            ?>
            <div <?php 
            $this->print_attribute_string( 'copyright' );
            ?>>
				<?php 
            echo  wp_kses_post( $text ) ;
            ?>
            </div>
			<?php 
        }
    
    }
}