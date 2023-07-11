<?php

/**
 * Archive customizer section
 *
 * @package Yuki
 */
use  LottaFramework\Customizer\Controls\Background ;
use  LottaFramework\Customizer\Controls\Border ;
use  LottaFramework\Customizer\Controls\ColorPicker ;
use  LottaFramework\Customizer\Controls\Condition ;
use  LottaFramework\Customizer\Controls\Icons ;
use  LottaFramework\Customizer\Controls\ImageRadio ;
use  LottaFramework\Customizer\Controls\Placeholder ;
use  LottaFramework\Customizer\Controls\Radio ;
use  LottaFramework\Customizer\Controls\Section ;
use  LottaFramework\Customizer\Controls\Select ;
use  LottaFramework\Customizer\Controls\Separator ;
use  LottaFramework\Customizer\Controls\Slider ;
use  LottaFramework\Customizer\Controls\Spacing ;
use  LottaFramework\Customizer\Controls\Tabs ;
use  LottaFramework\Customizer\Controls\Text ;
use  LottaFramework\Customizer\Controls\Toggle ;
use  LottaFramework\Customizer\Controls\Typography ;
use  LottaFramework\Customizer\Section as CustomizeSection ;
use  LottaFramework\Facades\AsyncCss ;

if ( !defined( 'ABSPATH' ) ) {
    exit;
    // Exit if accessed directly.
}

if ( !class_exists( 'Yuki_Archive_Section' ) ) {
    class Yuki_Archive_Section extends CustomizeSection
    {
        use  Yuki_Post_Card ;
        use  Yuki_Post_Structure ;
        /**
         * {@inheritDoc}
         */
        public function getControls()
        {
            return [
                ( new Section( 'yuki_archive_layout_section' ) )->setLabel( __( 'Archive Layout', 'yuki' ) )->setControls( $this->getArchiveLayoutControls() ),
                ( new Section( 'yuki_archive_header' ) )->setLabel( __( 'Archive Header', 'yuki' ) )->setControls( $this->getArchiveHeaderControls() ),
                ( new Section( 'yuki_archive_card_section' ) )->setLabel( __( 'Entry Card', 'yuki' ) )->setControls( $this->getCardControls() ),
                ( new Section( 'yuki_archive_sidebar_section' ) )->setLabel( __( 'Sidebar', 'yuki' ) )->enableSwitch()->setControls( [ ( new ImageRadio( 'yuki_archive_sidebar_layout' ) )->setLabel( __( 'Sidebar Layout', 'yuki' ) )->setDefaultValue( 'right-sidebar' )->setChoices( [
                'left-sidebar'  => [
                'title' => __( 'Left Sidebar', 'yuki' ),
                'src'   => yuki_image_url( 'archive-left-sidebar.png' ),
            ],
                'right-sidebar' => [
                'title' => __( 'Right Sidebar', 'yuki' ),
                'src'   => yuki_image_url( 'archive-right-sidebar.png' ),
            ],
            ] ) ] ),
                ( new Section( 'yuki_archive_pagination_section' ) )->setLabel( __( 'Pagination', 'yuki' ) )->enableSwitch()->setControls( $this->getPaginationControls() )
            ];
        }
        
        /**
         * @return array
         */
        protected function getArchiveLayoutControls()
        {
            return [ ( new ImageRadio( 'yuki_archive_layout' ) )->setLabel( __( 'Layout', 'yuki' ) )->setDefaultValue( 'archive-masonry' )->setColumns( 2 )->setChoices( [
                'archive-masonry' => [
                'src'   => yuki_image_url( 'archive-masonry.png' ),
                'title' => __( 'Masonry', 'yuki' ),
            ],
                'archive-grid'    => [
                'src'   => yuki_image_url( 'archive-grid.png' ),
                'title' => __( 'Grid', 'yuki' ),
            ],
                'archive-left'    => [
                'src'   => yuki_image_url( 'archive-left.png' ),
                'title' => __( 'Align Left', 'yuki' ),
            ],
                'archive-right'   => [
                'src'   => yuki_image_url( 'archive-right.png' ),
                'title' => __( 'Align Left', 'yuki' ),
            ],
            ] ), ( new Condition( 'yuki_archive_layout_condition' ) )->setCondition( [
                'yuki_archive_layout' => 'archive-grid|archive-masonry',
            ] )->setControls( $this->getArchiveColumnsControls() )->setReverseControls( [ ( new Slider( 'yuki_archive_image_width' ) )->setLabel( __( 'Thumbnail Width', 'yuki' ) )->asyncCss( '.card-list', [
                '--card-thumbnail-width' => 'value',
            ] )->setDefaultUnit( '%' )->setMin( 0 )->setMax( 100 )->enableResponsive()->setDefaultValue( [
                'desktop' => '45%',
                'tablet'  => '45%',
                'mobile'  => '100%',
            ] ) ] ), ( new Slider( 'yuki_card_gap' ) )->setLabel( __( 'Card Gap', 'yuki' ) )->asyncCss( '.card-list', [
                '--card-gap' => 'value',
            ] )->enableResponsive()->setDefaultUnit( 'px' )->setDefaultValue( '24px' ) ];
        }
        
        protected function getArchiveColumnsControls()
        {
            return [ ( new Placeholder( 'yuki_archive_columns' ) )->setDefaultValue( [
                'desktop' => 3,
                'tablet'  => 2,
                'mobile'  => 1,
            ] ), yuki_upsell_info_control( __( 'Customize card columns in %sPro Version%s', 'yuki' ) )->showBackground() ];
        }
        
        /**
         * @return array
         */
        protected function getArchiveHeaderControls()
        {
            return [ ( new Tabs() )->setActiveTab( 'content' )->addTab( 'content', __( 'Content', 'yuki' ), $this->getArchiveHeaderContentControls() )->addTab( 'style', __( 'Style', 'yuki' ), $this->getArchiveHeaderStyleControls() ) ];
        }
        
        protected function getArchiveHeaderContentControls()
        {
            $controls = [ ( new Toggle( 'yuki_disable_blogs_archive_header' ) )->setLabel( __( 'Disable Header On Blogs Home', 'yuki' ) )->selectiveRefresh( '.yuki-archive-header', 'yuki_show_archive_header', [
                'container_inclusive' => true,
            ] )->openByDefault() ];
            if ( YUKI_WOOCOMMERCE_ACTIVE ) {
                $controls[] = ( new Toggle( 'yuki_disable_shop_archive_header' ) )->setLabel( __( 'Disable Header On Shop', 'yuki' ) )->selectiveRefresh( '.yuki-archive-header', 'yuki_show_archive_header', [
                    'container_inclusive' => true,
                ] )->closeByDefault();
            }
            $controls[] = yuki_upsell_info_control( __( 'More archive header options in %sPro Version%s', 'yuki' ) )->showBackground();
            return apply_filters( 'yuki_archive_header_content_controls', $controls );
        }
        
        protected function getArchiveHeaderStyleControls()
        {
            $controls = [
                ( new Radio( 'yuki_archive_header_alignment' ) )->setLabel( __( 'Alignment', 'yuki' ) )->bindSelectiveRefresh( 'yuki-global-selective-css' )->buttonsGroupView()->setDefaultValue( 'left' )->setChoices( [
                'left'   => __( 'Left', 'yuki' ),
                'center' => __( 'Center', 'yuki' ),
                'right'  => __( 'Right', 'yuki' ),
            ] ),
                new Separator(),
                ( new Spacing( 'yuki_archive_header_padding' ) )->setLabel( __( 'Padding', 'yuki' ) )->bindSelectiveRefresh( 'yuki-global-selective-css' )->setSpacing( [
                'top'    => '24px',
                'bottom' => '24px',
                'left'   => '24px',
                'right'  => '24px',
                'linked' => true,
            ] ),
                new Separator()
            ];
            $controls = array_merge( $controls, [
                ( new Placeholder( 'yuki_archive_title_color' ) )->addColor( 'initial', 'var(--yuki-accent-active)' ),
                ( new Placeholder( 'yuki_archive_title_typography' ) )->setDefaultValue( [
                'family'        => 'inherit',
                'fontSize'      => [
                'desktop' => '1.5rem',
                'tablet'  => '1.25rem',
                'mobile'  => '1rem',
            ],
                'variant'       => '600',
                'lineHeight'    => '2',
                'textTransform' => 'capitalize',
            ] ),
                ( new Placeholder( 'yuki_archive_description_color' ) )->addColor( 'initial', 'var(--yuki-accent-color)' ),
                ( new Placeholder( 'yuki_archive_description_typography' ) )->setDefaultValue( [
                'family'     => 'inherit',
                'fontSize'   => [
                'desktop' => '0.875rem',
                'tablet'  => '0.875rem',
                'mobile'  => '0.75em',
            ],
                'variant'    => '400',
                'lineHeight' => '1.5',
            ] ),
                yuki_upsell_info_control( __( 'More archive header options in %sPro Version%s', 'yuki' ) )->showBackground()
            ] );
            return $controls;
        }
        
        /**
         * @return array
         */
        protected function getCardControls()
        {
            return [ ( new Tabs() )->setActiveTab( 'content' )->addTab( 'content', __( 'Content', 'yuki' ), array_merge( [ $this->getPostElementsLayer( 'yuki_card_structure', 'entry', [
                'selector'      => '.card',
                'selective-css' => 'yuki-global-selective-css',
                'value'         => [
                [
                'id'      => 'thumbnail',
                'visible' => true,
            ],
                [
                'id'      => 'categories',
                'visible' => true,
            ],
                [
                'id'      => 'title',
                'visible' => true,
            ],
                [
                'id'      => 'excerpt',
                'visible' => true,
            ],
                [
                'id'      => 'divider',
                'visible' => true,
            ],
                [
                'id'      => 'metas',
                'visible' => true,
            ]
            ],
                'title'         => [],
                'cats'          => [],
                'tags'          => [],
                'metas'         => [],
            ] ), new Separator() ], $this->getCardContentControls( 'yuki_', [
                'selector' => '.card',
            ] ) ) )->addTab( 'style', __( 'Style', 'yuki' ), $this->getCardStyleControls( 'yuki_', [
                'selector' => '.card',
            ] ) ) ];
        }
        
        /**
         * @return array
         */
        protected function getPaginationControls()
        {
            return [ ( new Tabs() )->setActiveTab( 'content' )->addTab( 'content', __( 'Content', 'yuki' ), $this->getPaginationContentControls() )->addTab( 'style', __( 'Style', 'yuki' ), $this->getPaginationStyleControls() ) ];
        }
        
        /**
         * @return array
         */
        protected function getPaginationContentControls()
        {
            $pagination_type = [
                'numbered'        => __( 'Numbered', 'yuki' ),
                'prev-next'       => __( 'Prev & Next', 'yuki' ),
                'load-more'       => __( 'Load More', 'yuki' ),
                'infinite-scroll' => __( 'Infinite Scroll', 'yuki' ),
            ];
            
            if ( yuki_fs()->is_not_paying() ) {
                $pagination_type['load-more'] = $pagination_type['load-more'] . ' (Pro Only)';
                $pagination_type['infinite-scroll'] = $pagination_type['infinite-scroll'] . ' (Pro Only)';
            }
            
            $controls = [ ( new Select( 'yuki_pagination_type' ) )->setLabel( __( 'Pagination Type', 'yuki' ) )->setDefaultValue( 'numbered' )->setChoices( $pagination_type ), ( new Condition() )->setCondition( [
                'yuki_pagination_type' => 'numbered',
            ] )->setControls( [ ( new Toggle( 'yuki_pagination_prev_next_button' ) )->setLabel( __( 'Previous & Next Buttons', 'yuki' ) )->openByDefault() ] ), ( new Condition() )->setCondition( [
                'yuki_pagination_type' => 'numbered|prev-next',
            ] )->setControls( [
                new Separator(),
                ( new Radio( 'yuki_pagination_prev_next_type' ) )->setLabel( __( 'Previous & Next Type', 'yuki' ) )->setDefaultValue( 'icon' )->buttonsGroupView()->setChoices( [
                'text' => __( 'Text', 'yuki' ),
                'icon' => __( 'Icon', 'yuki' ),
            ] ),
                ( new Condition() )->setCondition( [
                'yuki_pagination_prev_next_type' => 'icon',
            ] )->setControls( [ ( new Icons( 'yuki_pagination_prev_icon' ) )->setLabel( __( 'Previous Icon', 'yuki' ) )->setDefaultValue( [
                'value'   => 'fas fa-angle-left',
                'library' => 'fa-solid',
            ] ), ( new Icons( 'yuki_pagination_next_icon' ) )->setLabel( __( 'Next Icon', 'yuki' ) )->setDefaultValue( [
                'value'   => 'fas fa-angle-right',
                'library' => 'fa-solid',
            ] ) ] ),
                ( new Condition() )->setCondition( [
                'yuki_pagination_prev_next_type' => 'text',
            ] )->setControls( [ ( new Text( 'yuki_pagination_prev_text' ) )->setLabel( __( 'Previous Text', 'yuki' ) )->displayInline()->setDefaultValue( __( 'Prev', 'yuki' ) ), ( new Text( 'yuki_pagination_next_text' ) )->setLabel( __( 'Next Text', 'yuki' ) )->displayInline()->setDefaultValue( __( 'Next', 'yuki' ) ) ] ),
                new Separator(),
                ( new Toggle( 'yuki_pagination_disabled_button' ) )->setLabel( __( 'Show Disabled Buttons', 'yuki' ) )->openByDefault()
            ] ) ];
            if ( yuki_fs()->is_not_paying() ) {
                $controls[] = ( new Condition() )->setCondition( [
                    'yuki_pagination_type' => 'load-more|infinite-scroll',
                ] )->setControls( [ new Separator(), yuki_upsell_info_control( __( 'Load More & Infinite Scroll is available in our %sPro Version%s', 'yuki' ) ) ] );
            }
            $controls[] = new Separator();
            $controls[] = ( new ImageRadio( 'yuki_pagination_alignment' ) )->setLabel( __( 'Alignment', 'yuki' ) )->bindSelectiveRefresh( 'yuki-global-selective-css' )->inlineChoices()->setDefaultValue( 'flex-start' )->setChoices( [
                'flex-start' => [
                'src' => yuki_image( 'text-left' ),
            ],
                'center'     => [
                'src' => yuki_image( 'text-center' ),
            ],
                'flex-end'   => [
                'src' => yuki_image( 'text-right' ),
            ],
            ] );
            return $controls;
        }
        
        protected function getPaginationStyleControls()
        {
            $controls = [ ( new Typography( 'yuki_pagination_typography' ) )->setLabel( __( 'Typography', 'yuki' ) )->bindSelectiveRefresh( 'yuki-global-selective-css' )->setDefaultValue( [
                'family'     => 'inherit',
                'fontSize'   => '0.875rem',
                'variant'    => '400',
                'lineHeight' => '1',
            ] ), new Separator(), ( new Condition() )->setCondition( [
                'yuki_pagination_type' => 'numbered|prev-next',
            ] )->setControls( [ ( new ColorPicker( 'yuki_pagination_button_color' ) )->setLabel( __( 'Text Color', 'yuki' ) )->bindSelectiveRefresh( 'yuki-global-selective-css' )->addColor( 'initial', __( 'Text Initial', 'yuki' ), 'var(--yuki-accent-active)' )->addColor( 'active', __( 'Text Active', 'yuki' ), 'var(--yuki-base-color)' )->addColor( 'accent', __( 'Accent', 'yuki' ), 'var(--yuki-primary-color)' ), ( new Border( 'yuki_pagination_button_border' ) )->setLabel( __( 'Border', 'yuki' ) )->bindSelectiveRefresh( 'yuki-global-selective-css' )->displayInline()->setDefaultBorder( 1, 'solid', 'var(--yuki-base-200)' ) ] ) ];
            $controls[] = ( new Condition() )->setCondition( [
                'yuki_pagination_type' => 'numbered|prev-next|load-more',
            ] )->setControls( [ new Separator(), ( new Slider( 'yuki_pagination_button_radius' ) )->setLabel( __( 'Radius', 'yuki' ) )->enableResponsive()->bindSelectiveRefresh( 'yuki-global-selective-css' )->setDefaultUnit( 'px' )->setDefaultValue( '4px' )->setMin( 0 )->setMax( 100 ) ] );
            return $controls;
        }
    
    }
}