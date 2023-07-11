<?php

/**
 * Advanced css controls trait
 *
 * @package Yuki
 */
use  LottaFramework\Customizer\Controls\Text ;

if ( !defined( 'ABSPATH' ) ) {
    exit;
    // Exit if accessed directly.
}

if ( !trait_exists( 'Yuki_Advanced_CSS_Controls' ) ) {
    trait Yuki_Advanced_CSS_Controls
    {
        protected function getAdvancedCssControls( $prefix = '' )
        {
            $adv_controls = [ yuki_upsell_info_control( __( 'More advanced features like custom CSS ID and CSS Classes available in our %sPro Version%s', 'yuki' ) ) ];
            return $adv_controls;
        }
    
    }
}