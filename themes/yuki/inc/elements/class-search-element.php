<?php
/**
 * Search element
 *
 * @package Yuki
 */

use LottaFramework\Customizer\Controls\Background;
use LottaFramework\Customizer\Controls\ColorPicker;
use LottaFramework\Customizer\Controls\Icons;
use LottaFramework\Customizer\Controls\Separator;
use LottaFramework\Customizer\Controls\Tabs;
use LottaFramework\Customizer\Controls\Text;
use LottaFramework\Customizer\GenericBuilder\Element;
use LottaFramework\Facades\Css;
use LottaFramework\Facades\CZ;
use LottaFramework\Icons\IconsManager;
use LottaFramework\Utils;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Yuki_Search_Element' ) ) {

	class Yuki_Search_Element extends Element {

		use Yuki_Icon_Button_Controls;

		/**
		 * {@inheritDoc}
		 */
		public function getControls() {
			return [

				( new Tabs() )
					->setLabel( __( 'Search Icon', 'yuki' ) )
					->showLabel()
					->setActiveTab( 'icon' )
					->addTab( 'icon', __( 'Icon', 'yuki' ), array_merge( [
						( new Icons( $this->getSlug( 'icon_button_icon' ) ) )
							->setLabel( __( 'Icon', 'yuki' ) )
							->selectiveRefresh( ...$this->selectiveRefresh() )
							->setDefaultValue( [
								'value'   => 'fas fa-magnifying-glass',
								'library' => 'fa-solid'
							] )
						,
						( new Separator() ),
					], $this->getIconControls( [
						'render-callback' => $this->selectiveRefresh(),
						'selector'        => ".{$this->slug}"
					] ) ) )
					->addTab( 'style', __( 'Style', 'yuki' ), $this->getIconStyleControls( [
						'selector' => ".{$this->slug}"
					] ) )
				,
				( new Tabs() )
					->setLabel( __( 'Search Modal', 'yuki' ) )
					->showLabel()
					->setActiveTab( 'form' )
					->addTab( 'form', __( 'Form', 'yuki' ), [
						( new Text( $this->getSlug( 'placeholder' ) ) )
							->setLabel( __( 'Placeholder Text', 'yuki' ) )
							->selectiveRefresh( '.yuki-search-modal-form', [ $this, 'render_search_form' ] )
							->setDefaultValue( __( 'Type & Hint Enter', 'yuki' ) )
						,
						( new ColorPicker( $this->getSlug( 'input_color' ) ) )
							->setLabel( __( 'Input Color', 'yuki' ) )
							->bindSelectiveRefresh( 'yuki-header-selective-css' )
							->addColor( 'initial', __( 'Initial', 'yuki' ), 'var(--yuki-accent-color)' )
							->addColor( 'focus', __( 'Focus', 'yuki' ), 'var(--yuki-accent-color)' )
							->addColor( 'placeholder', __( 'Placeholder', 'yuki' ), 'var(--yuki-accent-color)' )
						,
						( new ColorPicker( $this->getSlug( 'input_border_color' ) ) )
							->setLabel( __( 'Input Border Color', 'yuki' ) )
							->bindSelectiveRefresh( 'yuki-header-selective-css' )
							->addColor( 'initial', __( 'Initial', 'yuki' ), 'var(--yuki-base-200)' )
							->addColor( 'focus', __( 'Focus', 'yuki' ), 'var(--yuki-primary-color)' )
						,
					] )
					->addTab( 'modal', __( 'Modal', 'yuki' ), [
						( new ColorPicker( $this->getSlug( 'modal_close_color' ) ) )
							->setLabel( __( 'Close Button Color', 'yuki' ) )
							->bindSelectiveRefresh( 'yuki-header-selective-css' )
							->addColor( 'initial', __( 'Initial', 'yuki' ), 'var(--yuki-accent-active)' )
							->addColor( 'hover', __( 'Hover', 'yuki' ), 'var(--yuki-primary-color)' )
						,
						( new Separator() ),
						( new Background( $this->getSlug( 'modal_background' ) ) )
							->setLabel( __( 'Modal Background', 'yuki' ) )
							->bindSelectiveRefresh( 'yuki-header-selective-css' )
							->setDefaultValue( [
								'type'  => 'color',
								'color' => 'var(--yuki-base-color)',
							] )
						,
					] )
			];
		}

		/**
		 * {@inheritDoc}
		 */
		public function enqueue_frontend_scripts() {
			// Add button dynamic css
			add_filter( 'yuki_filter_dynamic_css', function ( $css ) {
				$css[".{$this->slug}"] = $this->getIconButtonCss();

				$css[".{$this->slug}_modal"] = array_merge(
					Css::background( CZ::get( $this->getSlug( 'modal_background' ) ) ),
					Css::colors( CZ::get( $this->getSlug( 'input_color' ) ), [
						'initial'     => '--yuki-search-input-initial-color',
						'focus'       => '--yuki-search-input-focus-color',
						'placeholder' => '--yuki-search-input-placeholder-color',
					] ),
					Css::colors( CZ::get( $this->getSlug( 'input_border_color' ) ), [
						'initial' => '--yuki-search-input-border-initial-color',
						'focus'   => '--yuki-search-input-border-focus-color',
					] ),
					Css::colors( CZ::get( $this->getSlug( 'modal_close_color' ) ), [
						'initial' => '--yuki-modal-action-initial',
						'hover'   => '--yuki-modal-action-hover',
					] )
				);

				$css[".{$this->slug}_modal .search-input"] = [
					'text-align' => 'center',
				];

				return $css;
			} );

			if ( true !== has_action( 'yuki_action_before', [ $this, 'render_search_modal' ] ) ) {
				add_action( 'yuki_action_before', [ $this, 'render_search_modal' ] );
			}
		}

		/**
		 * Render search form
		 */
		public function render_search_form() {
			get_search_form( [
				'placeholder'    => CZ::get( $this->getSlug( 'placeholder' ) ),
				'disable_submit' => true,
			] );
		}

		/**
		 * Render search modal
		 */
		public function render_search_modal() {
			$css = [
				'yuki-search-modal yuki-modal',
				$this->slug . '_modal',
			];

			?>
            <div id="yuki-search-modal" data-toggle-behaviour="toggle" class="<?php Utils::the_clsx( $css ); ?>">

                <div class="yuki-modal-content">
                    <div class="max-w-screen-md mx-auto mt-60 yuki-search-modal-form form-controls form-underline"
                         data-redirect-focus="#yuki-close-search-modal-button">
						<?php $this->render_search_form(); ?>
                    </div>
                </div>

                <div class="yuki-modal-actions">
                    <button id="yuki-close-search-modal-button"
                            class="yuki-close-modal"
                            data-toggle-target="#yuki-search-modal"
                            data-toggle-hidden-focus=".yuki-search-button"
                            type="button"
                    >
                        <i class="fa fa-times"></i>
                    </button>
                </div>
            </div>
			<?php
		}

		/**
		 * {@inheritDoc}
		 */
		public function render( $attrs = [] ) {
			$shape = CZ::get( $this->getSlug( 'icon_button_icon_shape' ) );
			$fill  = CZ::get( $this->getSlug( 'icon_button_shape_fill_type' ) );

			$attrs['class'] = Utils::clsx( [
				'yuki-search-button',
				'yuki-icon-button',
				'yuki-icon-button-' . $shape,
				'yuki-icon-button-' . $fill => $shape !== 'none',
				$this->slug
			], $attrs['class'] ?? [] );

			foreach ( $attrs as $attr => $value ) {
				$this->add_render_attribute( 'search-button', $attr, $value );
			}

			$this->add_render_attribute( 'search-button', 'data-toggle-target', '#yuki-search-modal' );
			$this->add_render_attribute( 'search-button', ' data-toggle-show-focus', '#yuki-search-modal :focusable' );

			?>
            <button type="button" <?php $this->print_attribute_string( 'search-button' ); ?>>
				<?php IconsManager::print( CZ::get( $this->getSlug( 'icon_button_icon' ) ) ); ?>
            </button>
			<?php
		}
	}
}

