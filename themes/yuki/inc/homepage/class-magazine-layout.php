<?php

/**
 * Magazine grid layout
 *
 * @package Yuki
 */

if ( !defined( 'ABSPATH' ) ) {
    exit;
    // Exit if accessed directly.
}

if ( !class_exists( 'Yuki_Magazine_Layout' ) ) {
    class Yuki_Magazine_Layout
    {
        public static function all( $style = null )
        {
            $pro = yuki_fs()->can_use_premium_code();
            $layouts = [
                'style1'  => [
                'src'   => yuki_image_url( 'magazine-grid/style-1.png' ),
                'count' => 4,
            ],
                'style2'  => [
                'src'   => yuki_image_url( 'magazine-grid/style-2.png' ),
                'count' => 2,
            ],
                'style3'  => [
                'src'   => yuki_image_url( 'magazine-grid/style-3.png' ),
                'count' => 3,
            ],
                'style4'  => [
                'src'   => yuki_image_url( 'magazine-grid/style-4.png' ),
                'count' => 3,
            ],
                'style5'  => [
                'src'   => yuki_image_url( 'magazine-grid/style-5.png' ),
                'count' => 4,
            ],
                'style6'  => [
                'src'   => yuki_image_url( 'magazine-grid/style-6.png' ),
                'count' => 3,
            ],
                'style7'  => [
                'src'      => yuki_image_url( 'magazine-grid/style-7.png' ),
                'count'    => 3,
                'disabled' => !$pro,
                'mask'     => ( $pro ? null : 'Pro' ),
            ],
                'style8'  => [
                'src'      => yuki_image_url( 'magazine-grid/style-8.png' ),
                'count'    => 4,
                'disabled' => !$pro,
                'mask'     => ( $pro ? null : 'Pro' ),
            ],
                'style9'  => [
                'src'      => yuki_image_url( 'magazine-grid/style-9.png' ),
                'count'    => 3,
                'disabled' => !$pro,
                'mask'     => ( $pro ? null : 'Pro' ),
            ],
                'style10' => [
                'src'      => yuki_image_url( 'magazine-grid/style-10.png' ),
                'count'    => 3,
                'disabled' => !$pro,
                'mask'     => ( $pro ? null : 'Pro' ),
            ],
                'style11' => [
                'src'      => yuki_image_url( 'magazine-grid/style-11.png' ),
                'count'    => 5,
                'disabled' => !$pro,
                'mask'     => ( $pro ? null : 'Pro' ),
            ],
                'style12' => [
                'src'      => yuki_image_url( 'magazine-grid/style-12.png' ),
                'count'    => 5,
                'disabled' => !$pro,
                'mask'     => ( $pro ? null : 'Pro' ),
            ],
                'style13' => [
                'src'      => yuki_image_url( 'magazine-grid/style-13.png' ),
                'count'    => 4,
                'disabled' => !$pro,
                'mask'     => ( $pro ? null : 'Pro' ),
            ],
                'style14' => [
                'src'      => yuki_image_url( 'magazine-grid/style-14.png' ),
                'count'    => 4,
                'disabled' => !$pro,
                'mask'     => ( $pro ? null : 'Pro' ),
            ],
                'style15' => [
                'src'      => yuki_image_url( 'magazine-grid/style-15.png' ),
                'count'    => 5,
                'disabled' => !$pro,
                'mask'     => ( $pro ? null : 'Pro' ),
            ],
                'style16' => [
                'src'      => yuki_image_url( 'magazine-grid/style-16.png' ),
                'count'    => 5,
                'disabled' => !$pro,
                'mask'     => ( $pro ? null : 'Pro' ),
            ],
                'style17' => [
                'src'      => yuki_image_url( 'magazine-grid/style-17.png' ),
                'count'    => 5,
                'disabled' => !$pro,
                'mask'     => ( $pro ? null : 'Pro' ),
            ],
                'style18' => [
                'src'      => yuki_image_url( 'magazine-grid/style-18.png' ),
                'count'    => 5,
                'disabled' => !$pro,
                'mask'     => ( $pro ? null : 'Pro' ),
            ],
            ];
            return ( $style === null ? $layouts : $layouts[$style] ?? [] );
        }
        
        public static function style1( $id, $css )
        {
            $css[".yuki-magazine-grid.{$id}"] = [
                'grid-template-columns' => [
                'desktop' => '1fr 1fr 1fr 1fr',
                'tablet'  => '1fr 1fr',
                'mobile'  => '1fr 1fr',
            ],
                'grid-template-rows'    => [
                'desktop' => '1fr 1fr',
                'tablet'  => '1fr 1fr 1fr',
                'mobile'  => '1fr 1fr 1fr',
            ],
            ];
            $css[".{$id} .yuki-magazine-item:nth-child(1)"] = [
                'grid-column' => [
                'desktop' => '1 / 3',
                'tablet'  => '1 / 3',
                'mobile'  => '1 / 3',
            ],
                'grid-row'    => [
                'desktop' => '1 / 3',
                'tablet'  => '1',
                'mobile'  => '1',
            ],
            ];
            $css[".{$id} .yuki-magazine-item:nth-child(2)"] = [
                'grid-column' => [
                'desktop' => '3 / 5',
                'tablet'  => '1 / 3',
                'mobile'  => '1 / 3',
            ],
                'grid-row'    => [
                'desktop' => 'auto',
                'tablet'  => 'auto',
                'mobile'  => 'auto',
            ],
            ];
            return $css;
        }
        
        public static function style2( $id, $css )
        {
            $css[".yuki-magazine-grid.{$id}"] = [
                'grid-template-columns' => '1fr 1fr',
                'grid-template-rows'    => [
                'desktop' => '1fr',
                'tablet'  => '1fr',
                'mobile'  => '1fr',
            ],
            ];
            return $css;
        }
        
        public static function style3( $id, $css )
        {
            $css[".yuki-magazine-grid.{$id}"] = [
                'grid-template-columns' => [
                'desktop' => '1fr 1fr 1fr 1fr',
                'tablet'  => '1fr 1fr',
                'mobile'  => '1fr 1fr',
            ],
                'grid-template-rows'    => [
                'desktop' => '1fr',
                'tablet'  => '1fr 1fr',
                'mobile'  => '1fr 1fr',
            ],
            ];
            $css[".{$id} .yuki-magazine-item:nth-child(1)"] = [
                'grid-column' => [
                'desktop' => '1 / 2',
                'tablet'  => '1 / 3',
                'mobile'  => '1 / 3',
            ],
                'grid-row'    => [
                'desktop' => 'auto',
                'tablet'  => 'auto',
                'mobile'  => 'auto',
            ],
            ];
            $css[".{$id} .yuki-magazine-item:nth-child(2)"] = [
                'grid-column' => [
                'desktop' => '2 / 4',
                'tablet'  => '1 / 2',
                'mobile'  => '1 / 2',
            ],
                'grid-row'    => [
                'desktop' => 'auto',
                'tablet'  => 'auto',
                'mobile'  => 'auto',
            ],
            ];
            return $css;
        }
        
        public static function style4( $id, $css )
        {
            $css[".yuki-magazine-grid.{$id}"] = [
                'grid-template-columns' => [
                'desktop' => '1fr 1fr 1fr',
                'tablet'  => '1fr 1fr',
                'mobile'  => '1fr 1fr',
            ],
                'grid-template-rows'    => [
                'desktop' => '1fr',
                'tablet'  => '1fr 1fr',
                'mobile'  => '1fr 1fr',
            ],
            ];
            $css[".{$id} .yuki-magazine-item:nth-child(1)"] = [
                'grid-column' => [
                'desktop' => '1 / 2',
                'tablet'  => '1 / 3',
                'mobile'  => '1 / 3',
            ],
                'grid-row'    => [
                'desktop' => 'auto',
                'tablet'  => 'auto',
                'mobile'  => 'auto',
            ],
            ];
            return $css;
        }
        
        public static function style5( $id, $css )
        {
            $css[".yuki-magazine-grid.{$id}"] = [
                'grid-template-columns' => [
                'desktop' => '1fr 1fr 1fr 1fr',
                'tablet'  => '1fr 1fr',
                'mobile'  => '1fr 1fr',
            ],
                'grid-template-rows'    => [
                'desktop' => '1fr',
                'tablet'  => '1fr 1fr',
                'mobile'  => '1fr 1fr',
            ],
            ];
            return $css;
        }
        
        public static function style6( $id, $css )
        {
            $css[".yuki-magazine-grid.{$id}"] = [
                'grid-template-columns' => [
                'desktop' => '1fr 1fr 1fr 1fr',
                'tablet'  => '1fr 1fr',
                'mobile'  => '1fr 1fr',
            ],
                'grid-template-rows'    => [
                'desktop' => '1fr',
                'tablet'  => '1fr 1fr',
                'mobile'  => '1fr 1fr',
            ],
            ];
            $css[".{$id} .yuki-magazine-item:nth-child(1)"] = [
                'grid-column' => [
                'desktop' => '1 / 3',
                'tablet'  => '1 / 3',
                'mobile'  => '1 / 3',
            ],
                'grid-row'    => [
                'desktop' => 'auto',
                'tablet'  => 'auto',
                'mobile'  => 'auto',
            ],
            ];
            return $css;
        }
        
        public static function style7( $id, $css )
        {
            return $css;
        }
        
        public static function style8( $id, $css )
        {
            return $css;
        }
        
        public static function style9( $id, $css )
        {
            return $css;
        }
        
        public static function style10( $id, $css )
        {
            return $css;
        }
        
        public static function style11( $id, $css )
        {
            return $css;
        }
        
        public static function style12( $id, $css )
        {
            return $css;
        }
        
        public static function style13( $id, $css )
        {
            return $css;
        }
        
        public static function style14( $id, $css )
        {
            return $css;
        }
        
        public static function style15( $id, $css )
        {
            return $css;
        }
        
        public static function style16( $id, $css )
        {
            return $css;
        }
        
        public static function style17( $id, $css )
        {
            return $css;
        }
        
        public static function style18( $id, $css )
        {
            return $css;
        }
    
    }
}