<?php

/**
 * Menu element
 *
 * @package Yuki
 */
use  LottaFramework\Customizer\Controls\Border ;
use  LottaFramework\Customizer\Controls\BoxShadow ;
use  LottaFramework\Customizer\Controls\CallToAction ;
use  LottaFramework\Customizer\Controls\ColorPicker ;
use  LottaFramework\Customizer\Controls\Condition ;
use  LottaFramework\Customizer\Controls\Icons ;
use  LottaFramework\Customizer\Controls\Placeholder ;
use  LottaFramework\Customizer\Controls\Radio ;
use  LottaFramework\Customizer\Controls\Section ;
use  LottaFramework\Customizer\Controls\Separator ;
use  LottaFramework\Customizer\Controls\Slider ;
use  LottaFramework\Customizer\Controls\Spacing ;
use  LottaFramework\Customizer\Controls\Tabs ;
use  LottaFramework\Customizer\Controls\Toggle ;
use  LottaFramework\Customizer\Controls\Typography ;
use  LottaFramework\Customizer\GenericBuilder\Element ;
use  LottaFramework\Facades\AsyncCss ;
use  LottaFramework\Facades\Css ;
use  LottaFramework\Facades\CZ ;
use  LottaFramework\Icons\IconsManager ;
use  LottaFramework\Utils ;

if ( !defined( 'ABSPATH' ) ) {
    exit;
    // Exit if accessed directly.
}

if ( !class_exists( 'Yuki_Menu_Element' ) ) {
    class Yuki_Menu_Element extends Element
    {
        /**
         * After element register
         */
        public function after_register()
        {
            // Register nav menu
            add_action( 'after_setup_theme', function () {
                register_nav_menu( $this->slug, $this->getLabel() );
            } );
        }
        
        /**
         * @return array
         */
        protected function getTopLevelGeneralControls()
        {
            return [
                ( new Slider( $this->getSlug( 'top_level_height' ) ) )->setLabel( __( 'Items Height', 'yuki' ) )->asyncCss( ".{$this->slug}", [
                '--menu-items-height' => 'value',
            ] )->setDefaultValue( $this->getDefaultSetting( 'top-level-height', '50%' ) )->setDefaultUnit( '%' )->setMin( 5 )->setMax( 100 ),
                new Separator(),
                ( new Spacing( $this->getSlug( 'top_level_margin' ) ) )->setLabel( __( 'Items Margin', 'yuki' ) )->setDisabled( [ 'top', 'bottom' ] )->asyncCss( ".{$this->slug}", AsyncCss::dimensions( '--menu-items-margin' ) )->setDefaultValue( $this->getDefaultSetting( 'top-level-margin', [
                'top'    => '0px',
                'bottom' => '0px',
                'left'   => '0px',
                'right'  => '0px',
                'linked' => true,
            ] ) ),
                ( new Spacing( $this->getSlug( 'top_level_padding' ) ) )->setLabel( __( 'Items Padding', 'yuki' ) )->asyncCss( ".{$this->slug}", AsyncCss::dimensions( '--menu-items-padding' ) )->setDefaultValue( $this->getDefaultSetting( 'top-level-padding', [
                'top'    => '4px',
                'bottom' => '4px',
                'left'   => '8px',
                'right'  => '8px',
                'linked' => false,
            ] ) ),
                new Separator(),
                ( new Spacing( $this->getSlug( 'top_level_radius' ) ) )->setLabel( __( 'Items Border Radius', 'yuki' ) )->asyncCss( ".{$this->slug}", AsyncCss::dimensions( '--menu-items-radius' ) )->setDefaultValue( $this->getDefaultSetting( 'top-level-radius', [
                'top'    => '0',
                'bottom' => '0',
                'left'   => '0',
                'right'  => '0',
                'linked' => true,
            ] ) )
            ];
        }
        
        /**
         * @return array
         */
        protected function getTopLevelStyleControls()
        {
            $controls = [ ( new Typography( $this->getSlug( 'top_level_typography' ) ) )->setLabel( __( 'Typography', 'yuki' ) )->asyncCss( ".{$this->slug} > li", AsyncCss::typography() )->setDefaultValue( $this->getDefaultSetting( 'top-level-typography', [
                'family'        => 'inherit',
                'fontSize'      => '0.8rem',
                'variant'       => '500',
                'lineHeight'    => '1',
                'textTransform' => 'capitalize',
            ] ) ) ];
            $controls = array_merge( $controls, [ ( new Placeholder( $this->getSlug( 'top_level_text_color' ) ) )->addColor( 'initial', $this->getDefaultSetting( 'top-level-text-initial', 'var(--yuki-accent-color)' ) )->addColor( 'hover', $this->getDefaultSetting( 'top-level-text-hover', 'var(--yuki-primary-color)' ) )->addColor( 'active', $this->getDefaultSetting( 'top-level-text-active', 'var(--yuki-primary-color)' ) ), ( new Placeholder( $this->getSlug( 'top_level_background_color' ) ) )->addColor( 'initial', $this->getDefaultSetting( 'top-level-background-initial', 'var(--yuki-transparent)' ) )->addColor( 'hover', $this->getDefaultSetting( 'top-level-background-hover', 'var(--yuki-transparent)' ) )->addColor( 'active', $this->getDefaultSetting( 'top-level-background-active', 'var(--yuki-transparent)' ) ), yuki_upsell_info_control( __( 'Fully customize your top level menu items in our %sPro Version%s', 'yuki' ) ) ] );
            return $controls;
        }
        
        /**
         * @return array
         */
        protected function getDropdownGeneralControls()
        {
            return [
                ( new Slider( $this->getSlug( 'dropdown_width' ) ) )->setLabel( __( 'Min Width', 'yuki' ) )->asyncCss( ".{$this->slug}", [
                '--dropdown-width' => 'value',
            ] )->setDefaultValue( $this->getDefaultSetting( 'dropdown-width', '200px' ) )->setMin( 100 )->setMax( 300 ),
                ( new Radio( $this->getSlug( 'dropdown_direction' ) ) )->setLabel( __( 'Direction', 'yuki' ) )->selectiveRefresh( ...$this->selectiveRefresh() )->buttonsGroupView()->setDefaultValue( $this->getDefaultSetting( 'dropdown-direction', 'right' ) )->setChoices( [
                'left'  => __( 'Left', 'yuki' ),
                'right' => __( 'Right', 'yuki' ),
            ] ),
                new Separator(),
                ( new Spacing( $this->getSlug( 'dropdown_item_padding' ) ) )->setLabel( __( 'Items Padding', 'yuki' ) )->asyncCss( ".{$this->slug}", AsyncCss::dimensions( '--dropdown-item-padding' ) )->setDefaultValue( $this->getDefaultSetting( 'dropdown-item-padding', [
                'top'    => '12px',
                'bottom' => '12px',
                'left'   => '12px',
                'right'  => '12px',
                'linked' => true,
            ] ) ),
                ( new Spacing( $this->getSlug( 'dropdown_radius' ) ) )->setLabel( __( 'Dropdown Border Radius', 'yuki' ) )->asyncCss( ".{$this->slug}", AsyncCss::dimensions( '--dropdown-radius' ) )->setDefaultValue( $this->getDefaultSetting( 'dropdown-radius', [
                'top'    => '3px',
                'bottom' => '3px',
                'left'   => '3px',
                'right'  => '3px',
                'linked' => true,
            ] ) )
            ];
        }
        
        /**
         * @return array
         */
        protected function getDropdownStyleControls()
        {
            $controls = [ ( new Typography( $this->getSlug( 'dropdown_typography' ) ) )->setLabel( __( 'Typography', 'yuki' ) )->asyncCss( ".{$this->slug} > li ul", AsyncCss::typography() )->setDefaultValue( $this->getDefaultSetting( 'dropdown-typography', [
                'family'     => 'inherit',
                'fontSize'   => '0.75rem',
                'variant'    => '500',
                'lineHeight' => '1',
            ] ) ) ];
            $controls = array_merge( $controls, [
                ( new Placeholder( $this->getSlug( 'dropdown_text_color' ) ) )->addColor( 'initial', $this->getDefaultSetting( 'dropdown-text-initial', 'var(--yuki-accent-color)' ) )->addColor( 'hover', $this->getDefaultSetting( 'dropdown-text-hover', 'var(--yuki-primary-color)' ) )->addColor( 'active', $this->getDefaultSetting( 'dropdown-text-active', 'var(--yuki-primary-color)' ) ),
                ( new Placeholder( $this->getSlug( 'dropdown_background_color' ) ) )->addColor( 'initial', $this->getDefaultSetting( 'dropdown-background-initial', 'var(--yuki-base-color)' ) )->addColor( 'active', $this->getDefaultSetting( 'dropdown-background-active', 'var(--yuki-base-color)' ) ),
                ( new Placeholder( $this->getSlug( 'dropdown_divider' ) ) )->setDefaultBorder( ...$this->getDefaultSetting( 'dropdown-divider', [ 1, 'none', 'var(--yuki-base-200)' ] ) ),
                ( new Placeholder( $this->getSlug( 'dropdown_shadow' ) ) )->setDefaultShadow( ...$this->getDefaultSetting( 'dropdown-shadow', [
                'rgba(44, 62, 80, 0.2)',
                '0px',
                '0px',
                '15px',
                '0px',
                true
            ] ) ),
                yuki_upsell_info_control( __( 'Fully customize your dropdown style in our %sPro Version%s', 'yuki' ) )
            ] );
            return $controls;
        }
        
        /**
         * Get all controls
         *
         * @return array
         */
        public function getControls() : array
        {
            $controls = [ ( new CallToAction( $this->getSlug( 'edit_locations' ) ) )->setLabel( __( 'Edit Menu Locations', 'yuki' ) )->expandCustomize( 'menu_locations' ), new Separator(), ( new Slider( $this->getSlug( 'depth' ) ) )->setLabel( __( 'Menu Depth', 'yuki' ) )->setDescription( __( '"0" meas no limit.', 'yuki' ) )->selectiveRefresh( ...$this->selectiveRefresh() )->displayInline()->setMin( 0 )->setMax( 10 )->setDefaultUnit( false )->setDefaultValue( $this->getDefaultSetting( 'depth', 0 ) ) ];
            $controls = array_merge( $controls, [ ( new Condition() )->setCondition( [
                $this->getSlug( 'depth' ) => '!1',
            ] )->setControls( [ new Separator(), ( new Toggle( $this->getSlug( 'arrow' ) ) )->setLabel( __( 'Sub Menu Toggle Icon', 'yuki' ) )->selectiveRefresh( ...$this->selectiveRefresh() )->setDefaultValue( $this->getDefaultSetting( 'arrow', 'yes' ) ), ( new Condition() )->setCondition( [
                $this->getSlug( 'arrow' ) => 'yes',
            ] )->setControls( [ ( new Icons( $this->getSlug( 'arrow-icon' ) ) )->setLabel( __( 'Toggle Icon', 'yuki' ) )->selectiveRefresh( ...$this->selectiveRefresh() )->setDefaultValue( [
                'value'   => 'fas fa-angle-down',
                'library' => 'fa-solid',
            ] ) ] ) ] ) ] );
            $controls = array_merge( $controls, [ ( new Section() )->setLabel( __( 'Top Level Options', 'yuki' ) )->keepMarginBelow()->setControls( [ ( new Tabs() )->setActiveTab( 'general' )->addTab( 'general', __( 'General', 'yuki' ), $this->getTopLevelGeneralControls() )->addTab( 'style', __( 'Style', 'yuki' ), $this->getTopLevelStyleControls() ) ] ), ( new Condition() )->setCondition( [
                $this->getSlug( 'depth' ) => '!1',
            ] )->setControls( [ ( new Section() )->keepMarginBelow()->setLabel( __( 'Dropdown Options', 'yuki' ) )->setControls( [ ( new Tabs() )->setActiveTab( 'general' )->addTab( 'general', __( 'General', 'yuki' ), $this->getDropdownGeneralControls() )->addTab( 'style', __( 'Style', 'yuki' ), $this->getDropdownStyleControls() ) ] ) ] ) ] );
            return $controls;
        }
        
        /**
         * {@inheritDoc}
         */
        public function enqueue_frontend_scripts()
        {
            add_filter( 'yuki_filter_dynamic_css', function ( $css ) {
                // top level typography
                $css[".{$this->slug} > li"] = Css::typography( CZ::get( $this->getSlug( 'top_level_typography' ) ) );
                // dropdown typography
                $css[".{$this->slug} > li ul"] = Css::typography( CZ::get( $this->getSlug( 'dropdown_typography' ) ) );
                $css[".{$this->slug}"] = array_merge(
                    [
                        '--menu-items-height' => CZ::get( $this->getSlug( 'top_level_height' ) ),
                        '--dropdown-width'    => CZ::get( $this->getSlug( 'dropdown_width' ) ),
                    ],
                    Css::colors( CZ::get( $this->getSlug( 'top_level_text_color' ) ), [
                        'initial' => '--menu-text-initial-color',
                        'hover'   => '--menu-text-hover-color',
                        'active'  => '--menu-text-active-color',
                    ] ),
                    Css::colors( CZ::get( $this->getSlug( 'top_level_background_color' ) ), [
                        'initial' => '--menu-background-initial-color',
                        'hover'   => '--menu-background-hover-color',
                        'active'  => '--menu-background-active-color',
                    ] ),
                    Css::dimensions( CZ::get( $this->getSlug( 'top_level_margin' ) ), '--menu-items-margin' ),
                    Css::dimensions( CZ::get( $this->getSlug( 'top_level_padding' ) ), '--menu-items-padding' ),
                    Css::dimensions( CZ::get( $this->getSlug( 'top_level_radius' ) ), '--menu-items-radius' ),
                    // dropdown css
                    Css::colors( CZ::get( $this->getSlug( 'dropdown_text_color' ) ), [
                        'initial' => '--dropdown-text-initial-color',
                        'hover'   => '--dropdown-text-hover-color',
                        'active'  => '--dropdown-text-active-color',
                    ] ),
                    Css::colors( CZ::get( $this->getSlug( 'dropdown_background_color' ) ), [
                        'initial' => '--dropdown-background-initial-color',
                        'active'  => '--dropdown-background-active-color',
                    ] ),
                    Css::dimensions( CZ::get( $this->getSlug( 'dropdown_item_padding' ) ), '--dropdown-item-padding' ),
                    Css::dimensions( CZ::get( $this->getSlug( 'dropdown_radius' ) ), '--dropdown-radius' ),
                    Css::shadow( CZ::get( $this->getSlug( 'dropdown_shadow' ) ), '--dropdown-box-shadow' ),
                    Css::border( CZ::get( $this->getSlug( 'dropdown_divider' ) ), '--dropdown-divider' )
                );
                return $css;
            } );
        }
        
        /**
         * Seletive refresh args
         *
         * @return array
         */
        protected function selectiveRefresh()
        {
            return [ ".{$this->getSlug( 'wrap' )}", [ $this, 'build' ], [
                'container_inclusive' => true,
            ] ];
        }
        
        /**
         * {@inheritDoc}
         */
        public function render( $attrs = array() )
        {
            $attrs['class'] = Utils::clsx( 'yuki-menu-wrap h-full', $this->getSlug( 'wrap' ), $attrs['class'] ?? [] );
            foreach ( $attrs as $attr => $value ) {
                $this->add_render_attribute( $this->slug, $attr, $value );
            }
            $depth = absint( CZ::get( $this->getSlug( 'depth' ) ) );
            $hasArrow = $depth !== 1 && CZ::checked( $this->getSlug( 'arrow' ) );
            echo  '<div ' . $this->render_attribute_string( $this->slug ) . '>' ;
            wp_nav_menu( [
                'theme_location' => $this->slug,
                'container'      => false,
                'depth'          => $depth,
                'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                'link_after'     => '<span class="yuki-menu-icon">' . wp_kses_post( IconsManager::render( CZ::get( $this->getSlug( 'arrow-icon' ) ) ) ) . '</span>',
                'menu_class'     => Utils::clsx(
                'sf-menu clearfix yuki-menu',
                $this->slug,
                [
                'yuki-menu-has-arrow' => $hasArrow,
                'sf-dropdown-left'    => CZ::get( $this->getSlug( 'dropdown_direction' ) ) === 'left',
            ],
                $menu_attrs['class'] ?? []
            ),
                'fallback_cb'    => function ( $args ) {
                // for customize menu style, the default one not work.
                wp_page_menu( array_merge( $args, [
                    'container' => 'ul',
                ] ) );
            },
            ] );
            echo  '</div>' ;
        }
    
    }
}