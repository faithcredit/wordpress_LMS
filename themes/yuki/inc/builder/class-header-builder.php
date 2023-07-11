<?php

/**
 * Header builder instance
 *
 * @package Yuki
 */
use  LottaFramework\Customizer\Controls\Builder ;

if ( !defined( 'ABSPATH' ) ) {
    exit;
    // Exit if accessed directly.
}

if ( !class_exists( 'Yuki_Header_Builder' ) ) {
    class Yuki_Header_Builder
    {
        /**
         * @var null
         */
        protected static  $_instance = null ;
        /**
         * @var Builder|null
         */
        protected  $_builder = null ;
        /**
         * Construct builder
         */
        protected function __construct()
        {
            $this->_builder = ( new Builder( 'yuki_header_builder' ) )->setLabel( __( 'Header Elements', 'yuki' ) )->showLabel()->bindSelectiveRefresh( 'yuki-header-selective-css' )->selectiveRefresh( '.yuki-site-header', 'yuki_header_render' )->enableResponsive()->setColumn( Yuki_Header_Column::instance() );
            // Add elements
            $this->_builder->addElement( new Yuki_Logo_Element( 'logo', 'yuki_header_el_logo', __( 'Logo', 'yuki' ) ) )->addElement( new Yuki_Socials_Element( 'socials', 'yuki_header_el_socials', __( 'Socials', 'yuki' ) ) )->addElement( new Yuki_Search_Element( 'search', 'yuki_header_el_search', __( 'Search', 'yuki' ) ) )->addElement( new Yuki_Divider_Element( 'divider-1', 'yuki_header_el_divider_1', __( 'Divider #1', 'yuki' ) ) )->addElement( new Yuki_Divider_Element( 'divider-2', 'yuki_header_el_divider_2', __( 'Divider #2', 'yuki' ) ) )->addElement( new Yuki_Trigger_Element( 'trigger', 'yuki_header_el_trigger', __( 'Trigger', 'yuki' ) ) )->addElement( new Yuki_Theme_Switch_Element( 'theme-switch', 'yuki_header_el_theme_switch', __( 'Theme Switch', 'yuki' ) ) )->addElement( new Yuki_Widgets_Element(
                'widgets',
                'yuki_header_el_widgets',
                __( 'Off Canvas Widgets', 'yuki' ),
                [
                'selective-refresh' => 'yuki-header-selective-css',
            ]
            ) )->addElement( new Yuki_Collapsable_Menu_Element( 'collapsable-menu', 'yuki_header_el_collapsable-menu', __( 'Collapsable Menu', 'yuki' ) ) )->addElement( ( new Yuki_Menu_Element(
                'menu-1',
                'yuki_header_el_menu_1',
                __( 'Menu #1', 'yuki' ),
                [
                'depth'             => 1,
                'top-level-padding' => [
                'top'    => '6px',
                'bottom' => '6px',
                'left'   => '8px',
                'right'  => '8px',
            ],
            ]
            ) )->desktopOnly() )->addElement( ( new Yuki_Menu_Element( 'menu-2', 'yuki_header_el_menu_2', __( 'Menu #2', 'yuki' ) ) )->desktopOnly() )->addElement( new Yuki_Button_Element( 'button-1', 'yuki_header_el_button_1', __( 'Button #1', 'yuki' ) ) );
            // WooCommerce Elements
            if ( YUKI_WOOCOMMERCE_ACTIVE ) {
                $this->_builder->addElement( new Yuki_Cart_Element( 'cart', 'yuki_header_el_cart', __( 'Cart', 'yuki' ) ) );
            }
            // add rows
            $this->_builder->addRow( $this->getModalRow() )->addRow( $this->getTopBarRow() )->addRow( $this->getPrimaryRow() )->addRow( $this->getBottomRow() );
        }
        
        protected function getModalRow()
        {
            $data = apply_filters( 'yuki_modal_row_default_value', [
                'desktop' => [ [
                'elements' => [ 'widgets' ],
                'settings' => [
                'direction' => 'column',
            ],
            ] ],
                'mobile'  => [ [
                'elements' => [ 'collapsable-menu' ],
                'settings' => [
                'direction' => 'column',
            ],
            ] ],
            ] );
            $row = ( new Yuki_Modal_Row( 'modal', __( 'Modal Area', 'yuki' ) ) )->isOffCanvas();
            foreach ( $data['desktop'] as $column ) {
                $row->addDesktopColumn( $column['elements'], $column['settings'] );
            }
            foreach ( $data['mobile'] as $column ) {
                $row->addMobileColumn( $column['elements'], $column['settings'] );
            }
            return $row;
        }
        
        protected function getTopBarRow()
        {
            $data = apply_filters( 'yuki_header_top_row_default_value', [
                'desktop' => [ [
                'elements' => [ 'logo' ],
                'settings' => [
                'width' => '30%',
            ],
            ], [
                'elements' => [ 'menu-1', 'divider-1', 'button-1' ],
                'settings' => [
                'width'           => '70%',
                'justify-content' => 'flex-end',
            ],
            ] ],
                'mobile'  => [ [
                'elements' => [ 'logo' ],
                'settings' => [
                'width' => '50%',
            ],
            ], [
                'elements' => [ 'button-1' ],
                'settings' => [
                'width'           => '50%',
                'justify-content' => 'flex-end',
            ],
            ] ],
            ] );
            $row = new Yuki_Header_Row( 'top_bar', __( 'Top Bar', 'yuki' ), [
                'min_height'    => '90px',
                'z_index'       => 100,
                'border_bottom' => [ 1, 'solid', 'var(--yuki-base-200)' ],
                'background'    => [
                'type'  => 'color',
                'color' => 'var(--yuki-base-color)',
            ],
            ] );
            $row->setMaxColumns( apply_filters( 'yuki_header_top_row_max_columns', 3 ) );
            foreach ( $data['desktop'] as $column ) {
                $row->addDesktopColumn( $column['elements'], $column['settings'] );
            }
            foreach ( $data['mobile'] as $column ) {
                $row->addMobileColumn( $column['elements'], $column['settings'] );
            }
            return $row;
        }
        
        protected function getPrimaryRow()
        {
            $data = apply_filters( 'yuki_header_primary_row_default_value', [
                'desktop' => [ [
                'elements' => [ 'menu-2' ],
                'settings' => [
                'width' => '70%',
            ],
            ], [
                'elements' => [
                'socials',
                'theme-switch',
                'search',
                'trigger'
            ],
                'settings' => [
                'width'           => '30%',
                'justify-content' => 'flex-end',
            ],
            ] ],
                'mobile'  => [ [
                'elements' => [ 'search' ],
                'settings' => [
                'width' => '30%',
            ],
            ], [
                'elements' => [ 'socials' ],
                'settings' => [
                'width'           => '40%',
                'justify-content' => 'center',
            ],
            ], [
                'elements' => [ 'theme-switch', 'trigger' ],
                'settings' => [
                'width'           => '30%',
                'justify-content' => 'flex-end',
            ],
            ] ],
            ] );
            $row = new Yuki_Header_Row( 'primary_navbar', __( 'Primary Navbar', 'yuki' ), [
                'min_height'    => '50px',
                'z_index'       => 99,
                'border_bottom' => [ 1, 'solid', 'var(--yuki-base-200)' ],
            ] );
            $row->setMaxColumns( apply_filters( 'yuki_header_primary_row_max_columns', 3 ) );
            foreach ( $data['desktop'] as $column ) {
                $row->addDesktopColumn( $column['elements'], $column['settings'] );
            }
            foreach ( $data['mobile'] as $column ) {
                $row->addMobileColumn( $column['elements'], $column['settings'] );
            }
            return $row;
        }
        
        protected function getBottomRow()
        {
            $data = apply_filters( 'yuki_header_bottom_row_default_value', [
                'desktop' => [ [
                'elements' => [],
                'settings' => [
                'width' => '100%',
            ],
            ] ],
                'mobile'  => [ [
                'elements' => [],
                'settings' => [
                'width' => '100%',
            ],
            ] ],
            ] );
            $row = new Yuki_Header_Row( 'bottom_row', __( 'Bottom Row', 'yuki' ), [
                'z_index' => 98,
            ] );
            $row->setMaxColumns( apply_filters( 'yuki_header_bottom_row_max_columns', 3 ) );
            foreach ( $data['desktop'] as $column ) {
                $row->addDesktopColumn( $column['elements'], $column['settings'] );
            }
            foreach ( $data['mobile'] as $column ) {
                $row->addMobileColumn( $column['elements'], $column['settings'] );
            }
            return $row;
        }
        
        /**
         * Get header builder
         *
         * @return Yuki_Header_Builder|null
         */
        public static function instance()
        {
            if ( self::$_instance === null ) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }
        
        /**
         * Magic static calls
         *
         * @param $method
         * @param $args
         *
         * @return mixed
         */
        public static function __callStatic( $method, $args )
        {
            $builder = self::instance()->builder();
            if ( method_exists( $builder, $method ) ) {
                return $builder->{$method}( ...$args );
            }
            return null;
        }
        
        /**
         * @return Builder|null
         */
        public function builder()
        {
            return $this->_builder;
        }
    
    }
}