<?php

/**
 * Post structure trait
 *
 * @package Yuki
 */
use  LottaFramework\Customizer\Controls\Border ;
use  LottaFramework\Customizer\Controls\BoxShadow ;
use  LottaFramework\Customizer\Controls\CallToAction ;
use  LottaFramework\Customizer\Controls\ColorPicker ;
use  LottaFramework\Customizer\Controls\Condition ;
use  LottaFramework\Customizer\Controls\Icons ;
use  LottaFramework\Customizer\Controls\ImageRadio ;
use  LottaFramework\Customizer\Controls\Layers ;
use  LottaFramework\Customizer\Controls\Placeholder ;
use  LottaFramework\Customizer\Controls\Radio ;
use  LottaFramework\Customizer\Controls\Select ;
use  LottaFramework\Customizer\Controls\Separator ;
use  LottaFramework\Customizer\Controls\Slider ;
use  LottaFramework\Customizer\Controls\Spacing ;
use  LottaFramework\Customizer\Controls\Text ;
use  LottaFramework\Customizer\Controls\Toggle ;
use  LottaFramework\Customizer\Controls\Typography ;
use  LottaFramework\Facades\AsyncCss ;

if ( !defined( 'ABSPATH' ) ) {
    exit;
    // Exit if accessed directly.
}

if ( !trait_exists( 'Yuki_Post_Structure' ) ) {
    /**
     * Post structure functions
     */
    trait Yuki_Post_Structure
    {
        use  Yuki_Button_Controls ;
        /**
         * @return Layers
         */
        protected function getPostElementsLayer( $id, $layer_id, $defaults = array() )
        {
            $defaults = wp_parse_args( $defaults, [
                'exclude'           => [],
                'selective-css'     => '',
                'selective-refresh' => [ null ],
                'selector'          => '',
                'value'             => [
                [
                'id'      => 'categories',
                'visible' => true,
            ],
                [
                'id'      => 'title',
                'visible' => true,
            ],
                [
                'id'      => 'metas',
                'visible' => true,
            ],
                [
                'id'      => 'thumbnail',
                'visible' => true,
            ],
                [
                'id'      => 'excerpt',
                'visible' => true,
            ],
                [
                'id'      => 'read-more',
                'visible' => true,
            ]
            ],
                'title'             => [],
                'cats'              => [
                'style'        => 'badge',
                'text-initial' => 'var(--yuki-accent-active)',
                'text-hover'   => 'var(--yuki-primary-active)',
                'typography'   => [
                'family'        => 'inherit',
                'fontSize'      => '0.75rem',
                'variant'       => '400',
                'lineHeight'    => '1.5',
                'textTransform' => 'uppercase',
            ],
            ],
                'tags'              => [],
                'metas'             => [],
                'thumbnail'         => [],
                'divider'           => [],
                'excerpt'           => [],
                'read-more'         => [
                'text-initial'   => 'var(--yuki-accent-active)',
                'text-hover'     => 'var(--yuki-base-color)',
                'button-initial' => 'var(--yuki-transparent)',
                'button-hover'   => 'var(--yuki-accent-active)',
                'border-initial' => 'var(--yuki-base-300)',
                'border-hover'   => 'var(--yuki-accent-active)',
            ],
            ] );
            $selective_refresh = $defaults['selective-refresh'];
            $layer = ( new Layers( $id ) )->hideLabel()->setDefaultValue( $defaults['value'] );
            $layer->selectiveRefresh( ...$selective_refresh );
            $exclude = $defaults['exclude'];
            $layer_defaults = [
                'selective-css'     => $defaults['selective-css'],
                'selective-refresh' => $selective_refresh,
                'selector'          => $defaults['selector'],
            ];
            if ( !in_array( 'title', $exclude ) ) {
                $layer->addLayer( 'title', __( 'Title', 'yuki' ), $this->getTitleLayerControls( $layer_id, true, array_merge( $layer_defaults, $defaults['title'] ) ) );
            }
            if ( !in_array( 'categories', $exclude ) ) {
                $layer->addLayer( 'categories', __( 'Categories', 'yuki' ), $this->getTaxonomyControls( $layer_id, '_cats', array_merge( $layer_defaults, $defaults['cats'] ) ) );
            }
            if ( !in_array( 'tags', $exclude ) ) {
                $layer->addLayer( 'tags', __( 'Tags', 'yuki' ), $this->getTaxonomyControls( $layer_id, '_tags', array_merge( $layer_defaults, $defaults['tags'] ) ) );
            }
            if ( !in_array( 'thumbnail', $exclude ) ) {
                $layer->addLayer( 'thumbnail', __( 'Thumbnail', 'yuki' ), $this->getThumbnailControls( $layer_id, array_merge( $layer_defaults, $defaults['thumbnail'] ) ) );
            }
            if ( !in_array( 'excerpt', $exclude ) ) {
                $layer->addLayer( 'excerpt', __( 'Excerpt', 'yuki' ), $this->getExcerptControls( $layer_id, array_merge( $layer_defaults, $defaults['excerpt'] ) ) );
            }
            if ( !in_array( 'read-more', $exclude ) ) {
                $layer->addLayer( 'read-more', __( 'Read More', 'yuki' ), $this->getReadMoreControls( $layer_id, array_merge( $layer_defaults, $defaults['read-more'] ) ) );
            }
            if ( !in_array( 'metas', $exclude ) ) {
                $layer->addLayer( 'metas', __( 'Metas', 'yuki' ), $this->getMetasControls( $layer_id, array_merge( $layer_defaults, $defaults['metas'] ) ) );
            }
            if ( !in_array( 'divider', $exclude ) ) {
                $layer->addLayer( 'divider', __( 'Divider', 'yuki' ), $this->getDividerControls( $layer_id, array_merge( $layer_defaults, $defaults['divider'] ) ) );
            }
            return $layer;
        }
        
        /**
         * @return array
         */
        protected function getTaxonomyControls( $id, $type = '', $defaults = array() )
        {
            $defaults = wp_parse_args( $defaults, [
                'style'              => 'default',
                'text-initial'       => 'var(--yuki-primary-color)',
                'text-hover'         => 'var(--yuki-primary-active)',
                'badge-text-initial' => 'var(--yuki-base-color)',
                'badge-text-hover'   => 'var(--yuki-base-color)',
                'badge-bg-initial'   => 'var(--yuki-accent-active)',
                'badge-bg-hover'     => 'var(--yuki-primary-color)',
                'typography'         => [
                'family'     => 'inherit',
                'fontSize'   => '0.75rem',
                'variant'    => '700',
                'lineHeight' => '1.5',
            ],
            ] );
            $element = ( $type === '_cats' ? 'categories' : 'tags' );
            $selector = ( empty($defaults['selector']) ? '' : $defaults['selector'] . ' .entry-' . $element );
            $controls = [ ( new Select( 'yuki_' . $id . '_tax_style' . $type ) )->setLabel( __( 'Style', 'yuki' ) )->displayInline()->setDefaultValue( $defaults['style'] )->setChoices( [
                'default' => __( 'Default', 'yuki' ),
                'badge'   => __( 'Badge', 'yuki' ),
            ] ), ( new Separator() )->solidStyle() ];
            $controls = array_merge( $controls, [
                yuki_upsell_info_control( __( 'More options in our %sPro Version%s', 'yuki' ) ),
                ( new Placeholder( 'yuki_' . $id . '_tax_typography' . $type ) )->setDefaultValue( $defaults['typography'] ),
                ( new Placeholder( 'yuki_' . $id . '_tax_default_color' . $type ) )->addColor( 'initial', $defaults['text-initial'] )->addColor( 'hover', $defaults['text-hover'] ),
                ( new Placeholder( 'yuki_' . $id . '_tax_badge_text_color' . $type ) )->addColor( 'initial', $defaults['badge-text-initial'] )->addColor( 'hover', $defaults['badge-text-hover'] ),
                ( new Placeholder( 'yuki_' . $id . '_tax_badge_bg_color' . $type ) )->addColor( 'initial', $defaults['badge-bg-initial'] )->addColor( 'hover', $defaults['badge-bg-hover'] )
            ] );
            return $controls;
        }
        
        /**
         * @return array
         */
        protected function getTitleLayerControls( $id, $link = true, $defaults = array() )
        {
            $defaults = wp_parse_args( $defaults, [
                'tag'        => 'h2',
                'typography' => [
                'family'     => 'inherit',
                'fontSize'   => [
                'desktop' => '1.25rem',
                'tablet'  => '1rem',
                'mobile'  => '1rem',
            ],
                'variant'    => '700',
                'lineHeight' => '1.5',
            ],
                'initial'    => 'var(--yuki-accent-active)',
                'hover'      => 'var(--yuki-primary-color)',
            ] );
            $selector = ( empty($defaults['selector']) ? '' : $defaults['selector'] . ' .entry-title' );
            $controls = [ ( new Select( 'yuki_' . $id . '_title_tag' ) )->setLabel( __( 'Tag', 'yuki' ) )->setDefaultValue( $defaults['tag'] )->displayInline()->setChoices( [
                'h1' => __( 'H1', 'yuki' ),
                'h2' => __( 'H2', 'yuki' ),
                'h3' => __( 'H3', 'yuki' ),
                'h4' => __( 'H4', 'yuki' ),
                'h5' => __( 'H5', 'yuki' ),
                'h6' => __( 'H6', 'yuki' ),
            ] ), ( new Separator() )->solidStyle() ];
            $controls = array_merge( $controls, [ yuki_upsell_info_control( __( 'More options in our %sPro Version%s', 'yuki' ) ), ( new Placeholder( 'yuki_' . $id . '_title_typography' ) )->setDefaultValue( $defaults['typography'] ), ( new Placeholder( 'yuki_' . $id . '_title_color' ) )->addColor( 'initial', $defaults['initial'] )->addColor( 'hover', $defaults['hover'] ) ] );
            return $controls;
        }
        
        /**
         * @return array
         */
        protected function getThumbnailControls( $id, $defaults = array() )
        {
            $defaults = wp_parse_args( $defaults, [
                'height'           => '240px',
                'thumbnail-motion' => 'yes',
                'border-radius'    => [
                'top'    => '0px',
                'right'  => '0px',
                'bottom' => '0px',
                'left'   => '0px',
                'linked' => true,
            ],
                'shadow'           => [
                'rgba(54,63,70,0.35)',
                '0px',
                '18px',
                '18px',
                '-15px'
            ],
                'shadow-enable'    => false,
                'fallback'         => 'yes',
            ] );
            $selector = ( empty($defaults['selector']) ? '' : $defaults['selector'] . ' .entry-thumbnail' );
            $controls = [
                ( new Toggle( 'yuki_' . $id . '_thumbnail_motion' ) )->setLabel( __( 'Thumbnail Motion', 'yuki' ) )->setDefaultValue( $defaults['thumbnail-motion'] ),
                ( new Select( 'yuki_' . $id . '_thumbnail_size' ) )->setLabel( __( 'Image Size', 'yuki' ) )->setDefaultValue( 'large' )->selectiveRefresh( ...$defaults['selective-refresh'] )->setChoices( yuki_image_size_options( false ) ),
                new Separator(),
                ( new Slider( 'yuki_' . $id . '_thumbnail_height' ) )->setLabel( __( 'Height', 'yuki' ) )->asyncCss( $selector, [
                'height' => 'value',
            ] )->setUnits( [ [
                'unit' => 'px',
                'min'  => 100,
                'max'  => 1000,
            ], [
                'unit' => '%',
                'min'  => 10,
                'max'  => 100,
            ] ] )->setDefaultValue( $defaults['height'] ),
                ( new Toggle( 'yuki_' . $id . '_thumbnail_use_fallback' ) )->setLabel( __( 'Use Fallback Image', 'yuki' ) )->setDescription( __( 'If the current post does not have a featured image, then this image will be displayed.', 'yuki' ) )->selectiveRefresh( ...$defaults['selective-refresh'] )->setDefaultValue( $defaults['fallback'] ),
                ( new CallToAction() )->setLabel( __( 'Edit Fallback Image', 'yuki' ) )->displayAsButton()->expandCustomize( 'yuki_single_post:yuki_post_featured_image' ),
                new Separator()
            ];
            $controls = array_merge( $controls, [ yuki_upsell_info_control( __( 'More options in our %sPro Version%s', 'yuki' ) ), ( new Placeholder( 'yuki_' . $id . '_thumbnail_shadow' ) )->setDefaultShadow( ...array_merge( $defaults['shadow'], [ $defaults['shadow-enable'] ] ) ), ( new Placeholder( 'yuki_' . $id . '_thumbnail_radius' ) )->setDefaultValue( $defaults['border-radius'] ) ] );
            return $controls;
        }
        
        /**
         * @return array
         */
        protected function getExcerptControls( $id, $defaults )
        {
            $defaults = wp_parse_args( $defaults, [
                'selector'         => '',
                'type'             => 'excerpt',
                'length'           => 18,
                'more'             => '...',
                'color'            => 'var(--yuki-accent-color)',
                'linkInitialColor' => 'var(--yuki-primary-color)',
                'linkHoverColor'   => 'var(--yuki-primary-active)',
                'typography'       => [
                'family'     => 'inherit',
                'fontSize'   => '1rem',
                'variant'    => '400',
                'lineHeight' => '1.5',
            ],
                'moreTypography'   => [
                'family'     => 'inherit',
                'fontSize'   => '1rem',
                'variant'    => '400',
                'lineHeight' => '1.5',
            ],
            ] );
            $selector = ( empty($defaults['selector']) ? '' : $defaults['selector'] . ' .entry-excerpt' );
            $controls = [ ( new Radio( 'yuki_' . $id . '_excerpt_type' ) )->setDefaultValue( $defaults['type'] )->hideLabel()->setChoices( [
                'excerpt' => __( 'Excerpt', 'yuki' ),
                'full'    => __( 'Full Post', 'yuki' ),
            ] ), ( new Condition() )->setCondition( [
                'yuki_' . $id . '_excerpt_type' => 'excerpt',
            ] )->setControls( [
                ( new Slider( 'yuki_' . $id . '_excerpt_length' ) )->setLabel( __( 'Length', 'yuki' ) )->setMin( 10 )->setMax( 300 )->setDefaultUnit( false )->setDefaultValue( $defaults['length'] ),
                new Separator(),
                ( new Text( 'yuki_' . $id . '_excerpt_more_text' ) )->setLabel( __( 'More Text', 'yuki' ) )->setDefaultValue( $defaults['more'] ),
                ( new Toggle( 'yuki_' . $id . '_excerpt_more_link' ) )->setLabel( __( 'Make More Text a Link', 'yuki' ) )->selectiveRefresh( ...$defaults['selective-refresh'] )->openByDefault()
            ] ), new Separator() ];
            $controls = array_merge( $controls, [
                yuki_upsell_info_control( __( 'More options in our %sPro Version%s', 'yuki' ) ),
                ( new Placeholder( 'yuki_' . $id . '_excerpt_typography' ) )->setDefaultValue( $defaults['typography'] ),
                ( new Placeholder( 'yuki_' . $id . '_excerpt_more_typography' ) )->setDefaultValue( $defaults['moreTypography'] ),
                ( new Placeholder( 'yuki_' . $id . '_excerpt_color' ) )->addColor( 'initial', $defaults['color'] )->addColor( 'link-initial', __( 'Link Initial', 'yuki' ), $defaults['linkInitialColor'] )->addColor( 'link-hover', __( 'Link Hover', 'yuki' ), $defaults['linkHoverColor'] )
            ] );
            return $controls;
        }
        
        /**
         * @return array
         */
        protected function getReadMoreControls( $id, $defaults )
        {
            $selector = ( empty($defaults['selector']) ? '' : $defaults['selector'] . ' .entry-read-more' );
            return array_merge( array( ( new Text( 'yuki_' . $id . '_read_more_text' ) )->setLabel( __( 'Text', 'yuki' ) )->setDefaultValue( __( 'Read More', 'yuki' ) ), new Separator() ), $this->getButtonStyleControls( 'yuki_' . $id . '_read_more_', array_merge( $defaults, [
                'selective-refresh' => true,
                'button-selector'   => $selector,
            ] ) ) );
        }
        
        /**
         * @param $id
         * @param array $defaults
         *
         * @return array
         */
        protected function getMetasControls( $id, $defaults = array() )
        {
            $defaults = wp_parse_args( $defaults, [
                'elements'   => [ [
                'id'      => 'byline',
                'visible' => true,
            ], [
                'id'      => 'published',
                'visible' => true,
            ], [
                'id'      => 'comments',
                'visible' => true,
            ] ],
                'typography' => [
                'family'        => 'inherit',
                'fontSize'      => [
                'desktop' => '0.65rem',
                'tablet'  => '0.65rem',
                'mobile'  => '0.65rem',
            ],
                'variant'       => '400',
                'lineHeight'    => '1.5',
                'textTransform' => 'capitalize',
            ],
                'initial'    => 'var(--yuki-accent-color)',
                'hover'      => 'var(--yuki-primary-color)',
                'style'      => 'icon',
                'divider'    => 'divider-3',
            ] );
            $selector = ( empty($defaults['selector']) ? '' : $defaults['selector'] . ' .entry-metas' );
            $controls = [ ( new Layers( 'yuki_' . $id . '_metas' ) )->hideLabel()->setDefaultValue( $defaults['elements'] )->addLayer( 'byline', __( 'Byline', 'yuki' ), [ ( new Icons( 'yuki_' . $id . '_byline_icon' ) )->setLabel( __( 'Icon', 'yuki' ) )->setDefaultValue( [
                'value'   => 'fas fa-feather',
                'library' => 'fa-solid',
            ] ) ] )->addLayer( 'published', __( 'Published Date', 'yuki' ), [ ( new Icons( 'yuki_' . $id . '_published_icon' ) )->setLabel( __( 'Icon', 'yuki' ) )->setDefaultValue( [
                'value'   => 'far fa-calendar',
                'library' => 'fa-regular',
            ] ), new Separator(), ( new Text( 'yuki_' . $id . '_published_format' ) )->setLabel( __( 'Date Format', 'yuki' ) )->setDescription( sprintf(
                // translators: placeholder here means the actual URL.
                __( 'Date format %s instructions %s.', 'yuki' ),
                '<a href="https://wordpress.org/support/article/formatting-date-and-time/#format-string-examples" target="_blank">',
                '</a>'
            ) )->setDefaultValue( 'M j, Y' ) ] )->addLayer( 'comments', __( 'Comments', 'yuki' ), [ ( new Icons( 'yuki_' . $id . '_comments_icon' ) )->setLabel( __( 'Icon', 'yuki' ) )->setDefaultValue( [
                'value'   => 'far fa-comments',
                'library' => 'fa-regular',
            ] ) ] )->addLayer( 'views', __( 'Views', 'yuki' ), [ ( new Icons( 'yuki_' . $id . '_views_icon' ) )->setLabel( __( 'Icon', 'yuki' ) )->setDefaultValue( [
                'value'   => 'far fa-eye',
                'library' => 'fa-regular',
            ] ) ] ), new Separator() ];
            $controls = array_merge( $controls, [
                yuki_upsell_info_control( __( 'More options in our %sPro Version%s', 'yuki' ) ),
                ( new Placeholder( 'yuki_' . $id . '_meta_typography' ) )->setDefaultValue( $defaults['typography'] ),
                ( new Placeholder( 'yuki_' . $id . '_meta_color' ) )->addColor( 'initial', $defaults['initial'] )->addColor( 'hover', $defaults['hover'] ),
                ( new Placeholder( 'yuki_' . $id . '_meta_items_style' ) )->setDefaultValue( $defaults['style'] ),
                ( new Placeholder( 'yuki_' . $id . '_meta_items_divider' ) )->setDefaultValue( $defaults['divider'] )
            ] );
            return $controls;
        }
        
        /**
         * @return array
         */
        protected function getDividerControls( $id, $defaults )
        {
            $selector = ( empty($defaults['selector']) ? '' : $defaults['selector'] . ' .entry-divider' );
            return [ ( new Border( 'yuki_' . $id . '_divider' ) )->setLabel( __( 'Style', 'yuki' ) )->asyncCss( $selector, AsyncCss::border( '--entry-divider' ) )->setDefaultBorder( 1, 'dashed', 'var(--yuki-base-300)' ) ];
        }
    
    }
}