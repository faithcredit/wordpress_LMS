<?php

/**
 * Global customizer section
 *
 * @package Yuki
 */
use  LottaFramework\Customizer\Controls\BoxShadow ;
use  LottaFramework\Customizer\Controls\Collapse ;
use  LottaFramework\Customizer\Controls\ColorPicker ;
use  LottaFramework\Customizer\Controls\Icons ;
use  LottaFramework\Customizer\Controls\Number ;
use  LottaFramework\Customizer\Controls\Placeholder ;
use  LottaFramework\Customizer\Controls\Radio ;
use  LottaFramework\Customizer\Controls\Repeater ;
use  LottaFramework\Customizer\Controls\Section ;
use  LottaFramework\Customizer\Controls\Select ;
use  LottaFramework\Customizer\Controls\Separator ;
use  LottaFramework\Customizer\Controls\Slider ;
use  LottaFramework\Customizer\Controls\Spacing ;
use  LottaFramework\Customizer\Controls\Tabs ;
use  LottaFramework\Customizer\Controls\Text ;
use  LottaFramework\Customizer\Controls\Toggle ;
use  LottaFramework\Customizer\Section as CustomizerSection ;
use  LottaFramework\Facades\CZ ;

if ( !defined( 'ABSPATH' ) ) {
    exit;
    // Exit if accessed directly.
}

if ( !class_exists( 'Yuki_Global_Section' ) ) {
    class Yuki_Global_Section extends CustomizerSection
    {
        use  Yuki_Widgets_Controls ;
        public function getSlug( $key = '' )
        {
            return 'yuki_global_sidebar' . (( $key === '' ? '' : '_' . $key ));
        }
        
        /**
         * {@inheritDoc}
         */
        public function getControls()
        {
            return [
                ( new Section( 'yuki_global_layout_section' ) )->setLabel( __( 'Layout', 'yuki' ) )->setControls( $this->getLayoutControls() ),
                ( new Section( 'yuki_global_sidebar_section' ) )->setLabel( __( 'Sidebar', 'yuki' ) )->setControls( $this->getWidgetsControls( [
                'selective-refresh'  => 'yuki-global-selective-css',
                'async-selector'     => '.yuki-sidebar',
                'customize-location' => 'sidebar-widgets-primary-sidebar',
            ] ) ),
                ( new Section( 'yuki_global_socials' ) )->setLabel( __( 'Social Networks', 'yuki' ) )->setControls( $this->getSocilasControls() ),
                ( new Section( 'yuki_global_scroll_reveal' ) )->setLabel( __( 'Scroll Reveal', 'yuki' ) )->enableSwitch()->setControls( $this->getScrollReevealControls() ),
                ( new Section( 'yuki_global_scroll_to_top' ) )->setLabel( __( 'Scroll To Top', 'yuki' ) )->enableSwitch()->setControls( $this->getScrollToTopControls() ),
                ( new Section( 'yuki_global_preloader' ) )->setLabel( __( 'Preloader', 'yuki' ) )->enableSwitch()->setControls( $this->getPreloaderControls() )
            ];
        }
        
        protected function getLayoutControls()
        {
            return [ ( new Collapse() )->setLabel( __( 'Content Area Spacing', 'yuki' ) )->openByDefault()->setControls( [
                ( new Slider( 'yuki_homepage_content_spacing' ) )->setLabel( __( 'Homepage', 'yuki' ) )->enableResponsive()->bindSelectiveRefresh( 'yuki-global-selective-css' )->setDefaultUnit( 'px' )->setDefaultValue( '0px' ),
                ( new Slider( 'yuki_archive_content_spacing' ) )->setLabel( __( 'Archive', 'yuki' ) )->enableResponsive()->bindSelectiveRefresh( 'yuki-global-selective-css' )->setDefaultUnit( 'px' )->setDefaultValue( '24px' ),
                ( new Slider( 'yuki_single_post_content_spacing' ) )->setLabel( __( 'Single Post', 'yuki' ) )->enableResponsive()->bindSelectiveRefresh( 'yuki-global-selective-css' )->setDefaultUnit( 'px' )->setDefaultValue( '24px' ),
                ( new Slider( 'yuki_pages_content_spacing' ) )->setLabel( __( 'Pages', 'yuki' ) )->enableResponsive()->bindSelectiveRefresh( 'yuki-global-selective-css' )->setDefaultUnit( 'px' )->setDefaultValue( '24px' ),
                ( new Slider( 'yuki_store_content_spacing' ) )->setLabel( __( 'Store', 'yuki' ) )->enableResponsive()->bindSelectiveRefresh( 'yuki-global-selective-css' )->setDefaultUnit( 'px' )->setDefaultValue( '24px' )
            ] ) ];
        }
        
        public function getSocilasControls()
        {
            $repeater = ( new Repeater( 'yuki_social_networks' ) )->setLabel( __( 'Social Networks', 'yuki' ) )->setTitleField( "<%= settings.label %>" )->setDefaultValue( [ [
                'visible'  => true,
                'settings' => [
                'color' => [
                'official' => '#557dbc',
            ],
                'label' => 'Facebook',
                'url'   => '#',
                'share' => 'https://www.facebook.com/sharer/sharer.php?u={url}',
                'icon'  => [
                'value'   => 'fab fa-facebook',
                'library' => 'fa-brands',
            ],
            ],
            ], [
                'visible'  => true,
                'settings' => [
                'color' => [
                'official' => '#7acdee',
            ],
                'label' => 'Twitter',
                'url'   => '#',
                'share' => 'https://twitter.com/share?url={url}&text={text}',
                'icon'  => [
                'value'   => 'fab fa-twitter',
                'library' => 'fa-brands',
            ],
            ],
            ], [
                'visible'  => true,
                'settings' => [
                'color' => [
                'official' => '#ed1376',
            ],
                'label' => 'Instagram',
                'url'   => '#',
                'icon'  => [
                'value'   => 'fab fa-instagram',
                'library' => 'fa-brands',
            ],
            ],
            ] ] )->setControls( [
                ( new Text( 'label' ) )->setLabel( __( 'Label', 'yuki' ) )->displayInline()->setDefaultValue( 'WordPress' ),
                ( new Text( 'url' ) )->setLabel( __( 'URL', 'yuki' ) )->displayInline()->setDefaultValue( '' ),
                ( new Text( 'share' ) )->setLabel( __( 'Share Link', 'yuki' ) )->displayInline()->setDescription( sprintf(
                // translators: placeholder here means the actual URL.
                __( 'Social media sharing link formats, you can use {url} instead of the url of the current post and {text} instead of the title of the current post. %s Learn more %s', 'yuki' ),
                '<a href="https://www.wpmoose.com/docs/yuki-theme-docs/general/social-networks/" target="_blank">',
                '</a>'
            ) )->setDefaultValue( '' ),
                new Separator(),
                ( new ColorPicker( 'color' ) )->setLabel( __( 'Official Color', 'yuki' ) )->addColor( 'official', __( 'Official', 'yuki' ), 'var(--yuki-primary-active)' )->setSwatches( [
                '#557dbc' => 'Facebook',
                '#3d87fb' => 'Facebook Group',
                '#1887FC' => 'Facebook Messenger',
                '#7187d4' => 'Discord',
                '#40dfa3' => 'Tripadvisor',
                '#f84a7a' => 'Foursquare',
                '#ca252a' => 'Yelp',
                '#7acdee' => 'Twitter',
                '#ed1376' => 'Instagram',
                '#ea575a' => 'Pinterest',
                '#d77ea6' => 'Dribbble',
                '#00e59b' => 'Deviantart',
                '#1b64f6' => 'Behance',
                '#000000' => 'Unsplash',
                '#1c86c6' => 'Linkedin',
                '#bc2131' => 'Parler',
                '#368ad2' => 'Mastodon',
                '#292929' => 'Medium',
                '#4e1850' => 'Slack',
                '#000001' => 'Codepen',
                '#fc471e' => 'Reddit',
                '#9150fb' => 'Twitch',
                '#000002' => 'Tiktok',
                '#f9d821' => 'Snapchat',
                '#2ab859' => 'Spotify',
                '#fd561f' => 'Soundcloud',
                '#933ac3' => 'Apple Podcast',
                '#e65c4b' => 'Patreon',
                '#4a396f' => 'Alignable',
                '#5382b6' => 'Vk',
                '#e96651' => 'Youtube',
                '#233253' => 'Dtube',
                '#8ecfde' => 'Vimeo',
                '#f09124' => 'Rss',
                '#5bba67' => 'Whatsapp',
                '#7f509e' => 'Viber',
                '#229cce' => 'Telegram',
                '#20be60' => 'Line',
                '#0a5c5d' => 'Xing',
                '#e41c34' => 'Weibo',
                '#314255' => 'Tumblr',
                '#487fc8' => 'Qq',
                '#2dc121' => 'Wechat',
                '#2dc122' => 'Strava',
                '#0f64d1' => 'Flickr',
                '#244371' => 'Phone',
                '#392c44' => 'Email',
                '#24292e' => 'Github',
                '#f8713f' => 'Gitlab',
                '#1caae7' => 'Skype',
                '#1074a8' => 'Wordpress',
                '#fd6721' => 'Hacker News',
                '#eb7e2f' => 'Ok',
                '#c40812' => 'Flipboard',
            ] ),
                ( new Icons( 'icon' ) )->setLabel( __( 'Icon', 'yuki' ) )->setLibraries( [ 'fa-brands' ] )->setDefaultValue( [
                'value'   => 'fab fa-wordpress',
                'library' => 'fa-brands',
            ] )
            ] );
            if ( yuki_fs()->is_not_paying() ) {
                $repeater->setLimit( 4, yuki_upsell_info( __( 'Add more social networks in %sPro Version%s', 'yuki' ) ) );
            }
            return [ $repeater ];
        }
        
        protected function getScrollReevealControls()
        {
            $controls = [
                ( new Toggle( 'yuki_customize_preview_scroll_reveal' ) )->setLabel( __( 'Enable On Customize Preview', 'yuki' ) )->openByDefault(),
                new Separator(),
                ( new Number( 'yuki_scroll_reveal_delay' ) )->setLabel( __( 'Delay', 'yuki' ) )->setMin( 0 )->setMax( 500 )->setDefaultValue( 200 ),
                ( new Number( 'yuki_scroll_reveal_duration' ) )->setLabel( __( 'Duration', 'yuki' ) )->setMin( 100 )->setMax( 1000 )->setDefaultValue( 600 )
            ];
            $controls = array_merge( $controls, [
                ( new Placeholder( 'yuki_scroll_reveal_interval' ) )->setDefaultValue( 200 ),
                ( new Placeholder( 'yuki_scroll_reveal_opacity' ) )->setDefaultValue( 0 ),
                ( new Placeholder( 'yuki_scroll_reveal_scale' ) )->setDefaultValue( 1 ),
                ( new Placeholder( 'yuki_scroll_reveal_origin' ) )->setDefaultValue( 'bottom' ),
                ( new Placeholder( 'yuki_scroll_reveal_distance' ) )->setDefaultValue( '200px' ),
                yuki_upsell_info_control( __( 'More scroll reveal options in %sPro Version%s', 'yuki' ) )->showBackground()
            ] );
            return $controls;
        }
        
        protected function getScrollToTopControls()
        {
            return [ ( new Tabs() )->setActiveTab( 'content' )->addTab( 'content', __( 'Content', 'yuki' ), [
                ( new Icons( 'yuki_to_top_icon' ) )->setLabel( __( 'Icon', 'yuki' ) )->selectiveRefresh( '.yuki-to-top', 'yuki_add_to_top', [
                'container_inclusive' => true,
            ] )->setDefaultValue( [
                'value'   => 'fas fa-angle-up',
                'library' => 'fa-solid',
            ] ),
                new Separator(),
                ( new Slider( 'yuki_to_top_icon_size' ) )->setLabel( __( 'Icon Size', 'yuki' ) )->bindSelectiveRefresh( 'yuki-global-selective-css' )->enableResponsive()->setMin( 10 )->setMax( 50 )->setDefaultUnit( 'px' )->setDefaultValue( '14px' ),
                new Separator(),
                ( new Slider( 'yuki_to_top_bottom_offset' ) )->setLabel( __( 'Bottom Offset', 'yuki' ) )->bindSelectiveRefresh( 'yuki-global-selective-css' )->enableResponsive()->setMin( 5 )->setMax( 300 )->setDefaultUnit( 'px' )->setDefaultValue( '48px' ),
                ( new Slider( 'yuki_to_top_side_offset' ) )->setLabel( __( 'Side Offset', 'yuki' ) )->bindSelectiveRefresh( 'yuki-global-selective-css' )->enableResponsive()->setMin( 5 )->setMax( 300 )->setDefaultUnit( 'px' )->setDefaultValue( '48px' ),
                new Separator(),
                ( new Radio( 'yuki_to_top_position' ) )->setLabel( __( 'Position', 'yuki' ) )->selectiveRefresh( '.yuki-to-top', 'yuki_add_to_top', [
                'container_inclusive' => true,
            ] )->setDefaultValue( 'right' )->setChoices( [
                'left'  => __( 'Left', 'yuki' ),
                'right' => __( 'Right', 'yuki' ),
            ] )
            ] )->addTab( 'style', __( 'Style', 'yuki' ), $this->getScrollToTopStyleControls() ) ];
        }
        
        /**
         * @return array
         */
        protected function getScrollToTopStyleControls()
        {
            return [
                ( new Placeholder( 'yuki_to_top_icon_color' ) )->addColor( 'initial', 'var(--yuki-base-color)' )->addColor( 'hover', 'var(--yuki-base-color)' ),
                ( new Placeholder( 'yuki_to_top_background' ) )->addColor( 'initial', 'var(--yuki-accent-active)' )->addColor( 'hover', 'var(--yuki-primary-color)' ),
                ( new Placeholder( 'yuki_to_top_padding' ) )->setDefaultValue( [
                'top'    => '16px',
                'bottom' => '16px',
                'left'   => '16px',
                'right'  => '16px',
                'linked' => true,
            ] ),
                ( new Placeholder( 'yuki_to_top_radius' ) )->setDefaultValue( [
                'top'    => '3px',
                'bottom' => '3px',
                'left'   => '3px',
                'right'  => '3px',
                'linked' => true,
            ] ),
                ( new Placeholder( 'yuki_to_top_shadow' ) )->setDefaultShadow(
                'rgba(44, 62, 80, 0.15)',
                '0px',
                '10px',
                '20px',
                '0px',
                true
            ),
                yuki_upsell_info_control( __( 'Fully customize to top button in %sPro Version%s', 'yuki' ) )
            ];
        }
        
        /**
         * Preloader
         *
         * @return array
         */
        protected function getPreloaderControls()
        {
            return [ ( new Select( 'yuki_preloader_preset' ) )->setLabel( __( 'Preloader Preset', 'yuki' ) )->setDefaultValue( 'preset-1' )->bindSelectiveRefresh( 'yuki-preloader-selective-css' )->selectiveRefresh( '.yuki-preloader-wrap', function () {
                echo  wp_kses_post( yuki_get_preloader( CZ::get( 'yuki_preloader_preset' ) )['html'] ) ;
            } )->setChoices( [
                'preset-1'  => __( 'Preset 1', 'yuki' ),
                'preset-2'  => __( 'Preset 2', 'yuki' ),
                'preset-3'  => __( 'Preset 3', 'yuki' ),
                'preset-4'  => __( 'Preset 4', 'yuki' ),
                'preset-5'  => __( 'Preset 5', 'yuki' ),
                'preset-6'  => __( 'Preset 6', 'yuki' ),
                'preset-7'  => __( 'Preset 7', 'yuki' ),
                'preset-8'  => __( 'Preset 8', 'yuki' ),
                'preset-9'  => __( 'Preset 9', 'yuki' ),
                'preset-10' => __( 'Preset 10', 'yuki' ),
            ] ), new Separator(), ( new ColorPicker( 'yuki_preloader_colors' ) )->setLabel( __( 'Colors', 'yuki' ) )->asyncColors( '.yuki-preloader-wrap', [
                'background' => '--yuki-preloader-background',
                'accent'     => '--yuki-preloader-accent',
                'primary'    => '--yuki-preloader-primary',
            ] )->addColor( 'background', __( 'Background', 'yuki' ), 'var(--yuki-accent-active)' )->addColor( 'accent', __( 'Accent', 'yuki' ), 'var(--yuki-base-color)' )->addColor( 'primary', __( 'Primary', 'yuki' ), 'var(--yuki-primary-color)' ) ];
        }
    
    }
}