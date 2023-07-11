<?php
/**
 * Cart element
 *
 * @package Yuki
 */

use LottaFramework\Customizer\Controls\Icons;
use LottaFramework\Customizer\Controls\Separator;
use LottaFramework\Customizer\Controls\Tabs;
use LottaFramework\Customizer\GenericBuilder\Element;
use LottaFramework\Facades\CZ;
use LottaFramework\Icons\IconsManager;
use LottaFramework\Utils;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Yuki_Cart_Element' ) ) {

	class Yuki_Cart_Element extends Element {

		use Yuki_Icon_Button_Controls;

		/**
		 * {@inheritDoc}
		 */
		public function after_register() {
			add_filter( 'add_to_cart_fragments', array( $this, 'cart_link_fragments' ) );
		}

		/**
		 * Async update cart badge
		 *
		 * @param $fragments
		 *
		 * @return mixed
		 */
		public function cart_link_fragments( $fragments ) {

			ob_start();
			$this->show_badge();
			$html = ob_get_clean();

			$fragments['.yuki-cart-badge-wrapper'] = $html;

			return $fragments;
		}

		/**
		 * {@inheritDoc}
		 */
		public function getControls() {
			return [
				( new Tabs() )
					->setActiveTab( 'icon' )
					->addTab( 'icon', __( 'Icon', 'yuki' ), array_merge( [
						( new Icons( $this->getSlug( 'icon_button_icon' ) ) )
							->setLabel( __( 'Icon', 'yuki' ) )
							->selectiveRefresh( ...$this->selectiveRefresh() )
							->setDefaultValue( [
								'value'   => 'fas fa-basket-shopping',
								'library' => 'fa-solid',
							] )
						,
						( new Separator() ),
					], $this->getIconControls( [
						'selector'              => ".{$this->slug} .yuki-cart-trigger",
						'render-callback'       => $this->selectiveRefresh(),
						'css-selective-refresh' => 'yuki-header-selective-css',
					] ) ) )
					->addTab( 'style', __( 'Style', 'yuki' ), $this->getIconStyleControls( [
						'selector'              => ".{$this->slug} .yuki-cart-trigger",
						'render-callback'       => $this->selectiveRefresh(),
						'css-selective-refresh' => 'yuki-header-selective-css',
					] ) )
			];
		}

		/**
		 * {@inheritDoc}
		 */
		public function enqueue_frontend_scripts() {
			// Add button dynamic css
			add_filter( 'yuki_filter_dynamic_css', function ( $css ) {
				$css[".{$this->slug} .yuki-cart-trigger"] = $this->getIconButtonCss();

				return $css;
			} );
		}

		/**
		 * Validates whether the Woo Cart instance is available in the request
		 *
		 * @return bool
		 */
		protected function is_woo_cart_available() {
			if ( ! YUKI_WOOCOMMERCE_ACTIVE ) {
				return false;
			}

			$woo = WC();

			return $woo instanceof \WooCommerce && $woo->cart instanceof \WC_Cart;
		}

		/**
		 * Show cart count badge
		 */
		public function show_badge() {
			echo '<span class="yuki-cart-badge-wrapper">';

			$cart_count = WC()->cart->cart_contents_count;
			if ( $cart_count > 0 ) {
				echo '<span class="yuki-cart-badge absolute font-sans font-bold leading-none text-red-100 bg-red-600 rounded-full">';
				echo $cart_count;
				echo '</span>';
			}

			echo '</span>';
		}

		/**
		 * {@inheritDoc}
		 */
		public function render( $attrs = [] ) {
			if ( ! $this->is_woo_cart_available() ) {
				return;
			}

			$shape = CZ::get( $this->getSlug( 'icon_button_icon_shape' ) );
			$fill  = CZ::get( $this->getSlug( 'icon_button_shape_fill_type' ) );

			$button_classes = Utils::clsx( [
				'yuki-cart-trigger',
				'yuki-icon-button',
				'yuki-icon-button-' . $shape,
				'yuki-icon-button-' . $fill => $shape !== 'none',
			] );

			$this->add_render_attribute( 'cart', 'class', $button_classes );

			$attrs['class'] = ( $attrs['class'] ?? '' ) . ' yuki-cart-trigger-wrap relative ' . $this->slug;

			foreach ( $attrs as $attr => $value ) {
				$this->add_render_attribute( 'cart-wrap', $attr, $value );
			}

			$this->add_render_attribute( 'cart-wrap', 'data-popup-target', ".{$this->slug} .yuki-cart-popup" );
			$this->add_render_attribute( 'cart-wrap', 'data-popup-on-hover', true );

			$cart_count = WC()->cart->cart_contents_count;
			$cart_link  = esc_url( $cart_count ? wc_get_cart_url() : wc_get_page_permalink( 'shop' ) );

			?>
            <div <?php $this->print_attribute_string( 'cart-wrap' ); ?>>
                <a href="<?php echo esc_url( $cart_link ) ?>" <?php $this->print_attribute_string( 'cart' ); ?>>
					<?php IconsManager::print( CZ::get( $this->getSlug( 'icon_button_icon' ) ) ); ?>
					<?php $this->show_badge(); ?>
					<?php if ( ! is_cart() ): ?>
                        <div class="yuki-cart-popup yuki-popup yuki-heading yuki-heading-style-1 hidden absolute right-0 p-half-gutter border border-base-200 bg-base-color z-[9]">
							<?php the_widget( 'WC_Widget_Cart' ); ?>
                        </div>
					<?php endif; ?>
                </a>
            </div>
			<?php
		}
	}
}
