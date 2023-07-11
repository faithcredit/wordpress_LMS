<?php

/**
 * Logo element
 *
 * @package Yuki
 */
use  LottaFramework\Customizer\Controls\CallToAction ;
use  LottaFramework\Customizer\Controls\ColorPicker ;
use  LottaFramework\Customizer\Controls\ImageUploader ;
use  LottaFramework\Customizer\Controls\Placeholder ;
use  LottaFramework\Customizer\Controls\Radio ;
use  LottaFramework\Customizer\Controls\Separator ;
use  LottaFramework\Customizer\Controls\Slider ;
use  LottaFramework\Customizer\Controls\Tabs ;
use  LottaFramework\Customizer\Controls\Toggle ;
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

if ( !class_exists( 'Yuki_Logo_Element' ) ) {
    class Yuki_Logo_Element extends Element
    {
        /**
         * {@inheritDoc}
         */
        public function getControls()
        {
            return [ ( new Tabs() )->setActiveTab( 'content' )->addTab( 'content', __( 'Content', 'yuki' ), [
                ( new ImageUploader( $this->getSlug( 'logo' ) ) )->setLabel( __( 'Logo', 'yuki' ) )->selectiveRefresh( ...$this->selectiveRefresh() )->setDefaultValue( $this->getDefaultSetting( 'logo', '' ) ),
                ( new ImageUploader( $this->getSlug( 'dark_logo' ) ) )->setLabel( __( 'Logo For Dark Mode', 'yuki' ) )->setDescription( __( 'Leave as empty if you want to inherit the default value.', 'yuki' ) )->selectiveRefresh( ...$this->selectiveRefresh() )->setDefaultValue( $this->getDefaultSetting( 'dark_logo', '' ) ),
                ( new Separator() )->dashedStyle(),
                ( new Radio( $this->getSlug( 'position' ) ) )->setLabel( __( 'Logo Position', 'yuki' ) )->buttonsGroupView()->selectiveRefresh( ...$this->selectiveRefresh() )->setDefaultValue( $this->getDefaultSetting( 'position', 'left' ) )->setChoices( [
                'left'  => __( 'Left', 'yuki' ),
                'right' => __( 'Right', 'yuki' ),
                'top'   => __( 'Top', 'yuki' ),
            ] ),
                ( new Slider( $this->getSlug( 'height' ) ) )->setLabel( __( 'Logo Height', 'yuki' ) )->asyncCss( ".{$this->slug}", [
                '--logo-max-height' => 'value',
            ] )->setMin( 0 )->setMax( 300 )->setDefaultUnit( 'px' )->setDefaultValue( $this->getDefaultSetting( 'height', '40px' ) ),
                ( new Slider( $this->getSlug( 'spacing' ) ) )->setLabel( __( 'Logo Spacing', 'yuki' ) )->asyncCss( ".{$this->slug}", [
                '--logo-spacing' => 'value',
            ] )->setMin( 0 )->setMax( 300 )->setDefaultUnit( 'px' )->setDefaultValue( $this->getDefaultSetting( 'spacing', '12px' ) ),
                ( new Separator() )->dashedStyle(),
                ( new Toggle( $this->getSlug( 'enable_site_title' ) ) )->setLabel( __( 'Site Title', 'yuki' ) )->selectiveRefresh( ...$this->selectiveRefresh() )->setDefaultValue( $this->getDefaultSetting( 'enable-site-title', 'yes' ) ),
                ( new Toggle( $this->getSlug( 'enable_site_tagline' ) ) )->setLabel( __( 'Site Tagline', 'yuki' ) )->selectiveRefresh( ...$this->selectiveRefresh() )->setDefaultValue( $this->getDefaultSetting( 'enable-site-tagline', 'no' ) ),
                ( new CallToAction() )->setLabel( __( 'Click here to change the site title and tagline.', 'yuki' ) )->expandCustomize( 'title_tagline' ),
                ( new Separator() )->dashedStyle(),
                ( new Radio( $this->getSlug( 'content_alignment' ) ) )->setLabel( __( 'Content Alignment', 'yuki' ) )->asyncCss( ".{$this->slug}", [
                'text-align' => 'value',
            ] )->buttonsGroupView()->setDefaultValue( $this->getDefaultSetting( 'content-alignment', 'left' ) )->setChoices( [
                'left'   => __( 'Left', 'yuki' ),
                'center' => __( 'Center', 'yuki' ),
                'right'  => __( 'Right', 'yuki' ),
            ] )
            ] )->addTab( 'style', __( 'Style', 'yuki' ), $this->getStyleControls() ) ];
        }
        
        protected function getStyleControls()
        {
            return [
                ( new Placeholder( $this->getSlug( 'site_title_typography' ) ) )->setDefaultValue( $this->getDefaultSetting( 'site-title-typography', [
                'family'        => 'inherit',
                'fontSize'      => '28px',
                'variant'       => '500',
                'lineHeight'    => '1',
                'textTransform' => 'uppercase',
            ] ) ),
                ( new Placeholder( $this->getSlug( 'site_title_color' ) ) )->addColor( 'initial', $this->getDefaultSetting( 'title-initial', 'var(--yuki-accent-active)' ) )->addColor( 'hover', $this->getDefaultSetting( 'title-hover', 'var(--yuki-primary-color)' ) ),
                ( new Placeholder( $this->getSlug( 'site_tagline_typography' ) ) )->setDefaultValue( $this->getDefaultSetting( 'site-tagline-typography', [
                'family'     => 'inherit',
                'fontSize'   => '14px',
                'variant'    => '500',
                'lineHeight' => '1.5',
            ] ) ),
                ( new Placeholder( $this->getSlug( 'site_tagline_color' ) ) )->addColor( 'initial', $this->getDefaultSetting( 'tagline-initial', 'var(--yuki-accent-color)' ) ),
                yuki_upsell_info_control( __( 'Fully customize your logo in our %sPro Version%s', 'yuki' ) )
            ];
        }
        
        /**
         * {@inheritDoc}
         */
        public function enqueue_frontend_scripts()
        {
            add_filter( 'yuki_filter_dynamic_css', function ( $css ) {
                $css[".{$this->slug}"] = [
                    '--logo-max-height' => CZ::get( $this->getSlug( 'height' ) ),
                    '--logo-spacing'    => CZ::get( $this->getSlug( 'spacing' ) ),
                    'text-align'        => CZ::get( $this->getSlug( 'content_alignment' ) ),
                ];
                if ( CZ::checked( $this->getSlug( 'enable_site_title' ) ) ) {
                    $css[".{$this->slug} .site-title"] = array_merge( Css::typography( CZ::get( $this->getSlug( 'site_title_typography' ) ) ), Css::colors( CZ::get( $this->getSlug( 'site_title_color' ) ), [
                        'initial' => '--text-color',
                        'hover'   => '--hover-color',
                    ] ) );
                }
                if ( CZ::checked( $this->getSlug( 'enable_site_tagline' ) ) ) {
                    $css[".{$this->slug} .site-tagline"] = array_merge( Css::typography( CZ::get( $this->getSlug( 'site_tagline_typography' ) ) ), Css::colors( CZ::get( $this->getSlug( 'site_tagline_color' ) ), [
                        'initial' => 'color',
                    ] ) );
                }
                return $css;
            } );
        }
        
        /**
         * {@inheritDoc}
         */
        public function render( $attrs = array() )
        {
            foreach ( $attrs as $attr => $value ) {
                $this->add_render_attribute( 'wrapper', $attr, $value );
            }
            $this->add_render_attribute( 'wrapper', 'class', 'yuki-site-branding ' . $this->slug );
            $this->add_render_attribute( 'wrapper', 'data-logo', CZ::get( $this->getSlug( 'position' ) ) );
            $logo_attr = yuki_image_attr( CZ::get( $this->getSlug( 'logo' ) ) );
            $dark_logo_attr = yuki_image_attr( CZ::get( $this->getSlug( 'dark_logo' ) ) );
            $title = ( CZ::checked( $this->getSlug( 'enable_site_title' ) ) ? get_bloginfo( 'name' ) : '' );
            $tagline = ( CZ::checked( $this->getSlug( 'enable_site_tagline' ) ) ? get_bloginfo( 'description' ) : '' );
            ?>
            <div <?php 
            $this->print_attribute_string( 'wrapper' );
            ?>>
				<?php 
            
            if ( !empty($logo_attr) ) {
                ?>
                    <a class="site-logo <?php 
                echo  ( empty($dark_logo_attr) ? '' : 'site-logo-light' ) ;
                ?>"
                       href="<?php 
                echo  esc_url( home_url() ) ;
                ?>">
                        <img <?php 
                Utils::print_attribute_string( $logo_attr );
                ?> />
                    </a>
				<?php 
            }
            
            ?>
				<?php 
            
            if ( !empty($dark_logo_attr) ) {
                ?>
                    <a class="site-logo site-logo-dark" href="<?php 
                echo  esc_url( home_url() ) ;
                ?>">
                        <img <?php 
                Utils::print_attribute_string( $dark_logo_attr );
                ?> />
                    </a>
				<?php 
            }
            
            ?>
                <div class="site-identity">
					<?php 
            
            if ( $title !== '' ) {
                ?>
                        <span class="site-title">
                        <a href="<?php 
                echo  esc_url( home_url() ) ;
                ?>"><?php 
                echo  esc_html( $title ) ;
                ?></a>
                    </span>
					<?php 
            }
            
            ?>
					<?php 
            
            if ( $tagline !== '' ) {
                ?>
                        <span class="site-tagline">
                        <?php 
                echo  esc_html( $tagline ) ;
                ?>
                    </span>
					<?php 
            }
            
            ?>
                </div>
            </div>
			<?php 
        }
    
    }
}