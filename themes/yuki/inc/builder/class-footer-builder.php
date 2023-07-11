<?php

/**
 * Footer builder instance
 *
 * @package Yuki
 */
use  LottaFramework\Customizer\Controls\Builder ;

if ( !defined( 'ABSPATH' ) ) {
    exit;
    // Exit if accessed directly.
}

if ( !class_exists( 'Yuki_Footer_Builder' ) ) {
    class Yuki_Footer_Builder
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
            $this->_builder = ( new Builder( 'yuki_footer_builder' ) )->setLabel( __( 'Footer Elements', 'yuki' ) )->showLabel()->bindSelectiveRefresh( 'yuki-footer-selective-css' )->selectiveRefresh( '.yuki-footer-area', 'yuki_footer_render' )->setColumn( Yuki_Footer_Column::instance() );
            // Add elements
            $this->_builder->addElement( new Yuki_Socials_Element(
                'footer-socials',
                'yuki_footer_el_socials',
                __( 'Socials', 'yuki' ),
                [
                'icons-color-type'  => 'custom',
                'icons-shape'       => 'square',
                'icons-color-hover' => 'var(--yuki-base-color)',
            ]
            ) )->addElement( new Yuki_Copyright_Element( 'copyright', 'yuki_footer_el_copyright', __( 'Copyright', 'yuki' ) ) )->addElement( new Yuki_Menu_Element(
                'footer-menu',
                'yuki_footer_el_menu',
                __( 'Footer Menu', 'yuki' ),
                [
                'depth' => 1,
            ]
            ) )->addElement( new Yuki_Widgets_Element(
                'widgets-1',
                'yuki_footer_el_widgets_1',
                __( 'Widgets Area #1', 'yuki' ),
                [
                'selective-refresh' => 'yuki-footer-selective-css',
            ]
            ) )->addElement( new Yuki_Widgets_Element(
                'widgets-2',
                'yuki_footer_el_widgets_2',
                __( 'Widgets Area #2', 'yuki' ),
                [
                'selective-refresh' => 'yuki-footer-selective-css',
            ]
            ) )->addElement( new Yuki_Widgets_Element(
                'widgets-3',
                'yuki_footer_el_widgets_3',
                __( 'Widgets Area #3', 'yuki' ),
                [
                'selective-refresh' => 'yuki-footer-selective-css',
            ]
            ) )->addElement( new Yuki_Widgets_Element(
                'widgets-4',
                'yuki_footer_el_widgets_4',
                __( 'Widgets Area #4', 'yuki' ),
                [
                'selective-refresh' => 'yuki-footer-selective-css',
            ]
            ) );
            // add rows
            $this->_builder->addRow( $this->getTopRow() )->addRow( $this->getMiddleRow() )->addRow( $this->getBottomRow() );
        }
        
        protected function getTopRow()
        {
            $data = apply_filters( 'yuki_footer_top_row_default_value', [
                [
                'elements' => [],
                'settings' => [
                'width' => [
                'desktop' => '25%',
                'tablet'  => '50%',
                'mobile'  => '100%',
            ],
            ],
            ],
                [
                'elements' => [],
                'settings' => [
                'width' => [
                'desktop' => '25%',
                'tablet'  => '50%',
                'mobile'  => '100%',
            ],
            ],
            ],
                [
                'elements' => [],
                'settings' => [
                'width' => [
                'desktop' => '25%',
                'tablet'  => '50%',
                'mobile'  => '100%',
            ],
            ],
            ],
                [
                'elements' => [],
                'settings' => [
                'width' => [
                'desktop' => '25%',
                'tablet'  => '50%',
                'mobile'  => '100%',
            ],
            ],
            ]
            ] );
            $row = new Yuki_Footer_Row( 'top', __( 'Top Row', 'yuki' ), [
                'border_top' => [ 1, 'solid', 'var(--yuki-base-200)' ],
                'z_index'    => 100,
                'background' => [
                'type'  => 'color',
                'color' => 'var(--yuki-base-color)',
            ],
            ] );
            $row->setMaxColumns( apply_filters( 'yuki_footer_top_row_max_columns', 4 ) );
            foreach ( $data as $column ) {
                $row->addColumn( $column['elements'], $column['settings'] );
            }
            return $row;
        }
        
        protected function getMiddleRow()
        {
            $data = apply_filters( 'yuki_footer_middle_row_default_value', [
                [
                'elements' => [ 'widgets-1', 'footer-socials' ],
                'settings' => [
                'width' => [
                'desktop' => '25%',
                'tablet'  => '50%',
                'mobile'  => '100%',
            ],
            ],
            ],
                [
                'elements' => [ 'widgets-2' ],
                'settings' => [
                'width' => [
                'desktop' => '25%',
                'tablet'  => '50%',
                'mobile'  => '100%',
            ],
            ],
            ],
                [
                'elements' => [ 'widgets-3' ],
                'settings' => [
                'width' => [
                'desktop' => '25%',
                'tablet'  => '50%',
                'mobile'  => '100%',
            ],
            ],
            ],
                [
                'elements' => [ 'widgets-4' ],
                'settings' => [
                'width' => [
                'desktop' => '25%',
                'tablet'  => '50%',
                'mobile'  => '100%',
            ],
            ],
            ]
            ] );
            $row = new Yuki_Footer_Row( 'middle', __( 'Middle Row', 'yuki' ), [
                'z_index'    => 99,
                'border_top' => [ 1, 'solid', 'var(--yuki-base-200)' ],
            ] );
            $row->setMaxColumns( apply_filters( 'yuki_footer_middle_row_max_columns', 4 ) );
            foreach ( $data as $column ) {
                $row->addColumn( $column['elements'], $column['settings'] );
            }
            return $row;
        }
        
        protected function getBottomRow()
        {
            $data = apply_filters( 'yuki_footer_bottom_row_default_value', [ [
                'elements' => [ 'footer-menu' ],
                'settings' => [
                'width'           => [
                'desktop' => '60%',
                'tablet'  => '100%',
                'mobile'  => '100%',
            ],
                'direction'       => 'row',
                'align-items'     => 'center',
                'justify-content' => [
                'desktop' => 'flex-start',
                'tablet'  => 'center',
                'mobile'  => 'center',
            ],
            ],
            ], [
                'elements' => [ 'copyright' ],
                'settings' => [
                'width'           => [
                'desktop' => '40%',
                'tablet'  => '100%',
                'mobile'  => '100%',
            ],
                'direction'       => 'row',
                'align-items'     => 'center',
                'justify-content' => [
                'desktop' => 'flex-end',
                'tablet'  => 'center',
                'mobile'  => 'center',
            ],
            ],
            ] ] );
            $row = new Yuki_Footer_Row( 'bottom', __( 'Bottom Row', 'yuki' ), [
                'border_top' => [ 1, 'solid', 'var(--yuki-base-200)' ],
                'z_index'    => 98,
                'vt_align'   => 'center',
            ] );
            $row->setMaxColumns( apply_filters( 'yuki_footer_bottom_row_max_columns', 4 ) );
            foreach ( $data as $column ) {
                $row->addColumn( $column['elements'], $column['settings'] );
            }
            return $row;
        }
        
        /**
         * Get footer builder
         *
         * @return Yuki_Footer_Builder|null
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