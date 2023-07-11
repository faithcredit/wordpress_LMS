<?php

/**
 * Homepage posts element base class
 *
 * @package Yuki
 */
use  LottaFramework\Customizer\PageBuilder\Element ;

if ( !defined( 'ABSPATH' ) ) {
    exit;
    // Exit if accessed directly.
}

if ( !class_exists( 'Yuki_Posts_Base_Element' ) ) {
    abstract class Yuki_Posts_Base_Element extends Element
    {
        use  Yuki_Post_Query ;
        use  Yuki_Post_Structure ;
        use  Yuki_Post_Card ;
        /**
         * @param null $id
         * @param array $data
         */
        public function after_register( $id = null, $data = array() )
        {
        }
        
        /**
         *
         * @param $id
         * @param $settings
         *
         * @return array
         */
        protected function get_post_structure_args( $id, $settings )
        {
            $structure = $this->layers( 'structure', $settings );
            $metas = $this->layers( 'yuki_el_metas', $settings );
            $title_tag = $this->get( 'yuki_el_title_tag', $settings );
            $excerpt_type = $this->get( 'yuki_el_excerpt_type', $settings );
            return array(
                'el',
                $structure,
                $metas,
                [
                'title_link'   => true,
                'title_tag'    => $title_tag,
                'excerpt_type' => $excerpt_type,
                'options'      => $this,
                'settings'     => $settings,
                'trans_id'     => $id,
            ]
            );
        }
    
    }
}