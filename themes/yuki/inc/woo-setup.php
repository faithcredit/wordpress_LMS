<?php
/**
 * Yuki Theme WooCommerce Setup
 *
 * @package Yuki
 */

use LottaFramework\Facades\Css;
use LottaFramework\Facades\CZ;
use LottaFramework\Utils;

if ( ! function_exists( 'yuki_woo_setup' ) ) {
	/**
	 * WooCommerce setup.
	 */
	function yuki_woo_setup() {
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
	}
}
add_action( 'after_setup_theme', 'yuki_woo_setup' );

if ( ! function_exists( 'yuki_remove_woo_css' ) ) {
	/**
	 * Disable original WooCommerce CSS.
	 *
	 * @param array $styles
	 *
	 * @return array
	 */
	function yuki_remove_woo_css( $styles ) {
		$styles['woocommerce-layout']['src']      = false;
		$styles['woocommerce-smallscreen']['src'] = false;
		$styles['woocommerce-general']['src']     = false;

		return $styles;
	}
}
add_filter( 'woocommerce_enqueue_styles', 'yuki_remove_woo_css' );

if ( ! function_exists( 'yuki_enqueue_woo_scripts' ) ) {
	function yuki_enqueue_woo_scripts() {
		$suffix = defined( 'WP_DEBUG' ) && WP_DEBUG ? '' : '.min';

		// Theme admin scripts
		wp_register_style(
			'yuki-woo-style',
			get_template_directory_uri() . '/dist/css/woo' . $suffix . '.css',
			[],
			YUKI_VERSION
		);

		wp_enqueue_style( 'yuki-woo-style' );
	}
}
add_action( 'wp_enqueue_scripts', 'yuki_enqueue_woo_scripts', 30 );


if ( ! function_exists( 'yuki_woo_dynamic_css' ) ) {
	/**
	 * WooCommerce dynamic css
	 *
	 * @param array $css
	 *
	 * @return mixed
	 */
	function yuki_woo_dynamic_css( array $css = [] ) {
		if ( is_store_notice_showing() ) {
			$css['.woocommerce-store-notice, p.demo_store'] = array_merge(
				Css::colors( CZ::get( 'yuki_store_notice_colors' ), [
					'text'            => 'color',
					'dismiss-initial' => '--yuki-link-initial-color',
					'dismiss-hover'   => '--yuki-link-hover-color',
				] ),
				Css::background( CZ::get( 'yuki_store_notice_background' ) )
			);
		}

		if ( yuki_is_woo_shop() ) {
			// product wrapper
			$card_width = [];
			foreach ( CZ::get( 'yuki_store_catalog_columns' ) as $device => $columns ) {
				$card_width[ $device ] = sprintf( "%.2f", substr( sprintf( "%.3f", ( 100 / (int) $columns ) ), 0, - 1 ) ) . '%';
			}
			$css['.yuki-products > .product'] = [
				'width' => $card_width,
			];

			// products list
			$css['.yuki-products'] = [
				'--yuki-initial-color' => 'var(--yuki-primary-active)',
				'--yuki-hover-color'   => 'var(--yuki-primary-color)',
				'--card-gap'           => CZ::get( 'yuki_store_catalog_gap' ),
			];
			// product title
			$css['.yuki-products .woocommerce-loop-product__title'] = [
				'font-size'   => '1rem',
				'font-weight' => 600
			];

			// product wrapper
			$css['.woocommerce .yuki-products li.product .yuki-product-wrapper'] = array_merge(
				$css['.woocommerce .yuki-products li.product .yuki-product-wrapper'] ?? [],
				Css::background( CZ::get( 'yuki_store_card_background' ) ),
				Css::shadow( CZ::get( 'yuki_store_card_shadow' ) ),
				Css::border( CZ::get( 'yuki_store_card_border' ) ),
				Css::dimensions( CZ::get( 'yuki_store_card_radius' ), 'border-radius' ),
				[
					'text-align'               => CZ::get( 'yuki_store_card_content_alignment' ),
					'justify-content'          => CZ::get( 'yuki_store_card_vertical_alignment' ),
					'--card-thumbnail-spacing' => CZ::get( 'yuki_store_card_thumbnail_spacing' ),
					'--card-content-spacing'   => CZ::get( 'yuki_store_card_content_spacing' )
				]
			);

			// pagination
			$css['.woocommerce-pagination'] = array_merge(
				Css::border( CZ::get( 'yuki_pagination_button_border' ), '--yuki-pagination-button-border' ),
				Css::colors( CZ::get( 'yuki_pagination_button_color' ), [
					'initial' => '--yuki-pagination-initial-color',
					'active'  => '--yuki-pagination-active-color',
					'accent'  => '--yuki-pagination-accent-color',
				] ),
				Css::typography( CZ::get( 'yuki_pagination_typography' ) ),
				[
					'--yuki-pagination-button-radius' => CZ::get( 'yuki_pagination_button_radius' ),
					'justify-content'                 => CZ::get( 'yuki_pagination_alignment' )
				]
			);
		}

		return $css;
	}
}
add_filter( 'yuki_filter_dynamic_css', 'yuki_woo_dynamic_css' );

if ( ! function_exists( 'yuki_woo_before_content' ) ) {
	/**
	 * Wrap woocommerce content - start
	 */
	function yuki_woo_before_content() {
		$layout = 'no-sidebar';
		if ( CZ::checked( 'yuki_store_sidebar_section' ) ) {
			$layout = CZ::get( 'yuki_store_sidebar_layout' );
		}

		?>
        <div class="<?php Utils::the_clsx( yuki_container_css( $layout ) ) ?>">
        <div id="content" class="flex-grow max-w-full">
		<?php if ( ! is_shop() ): ?>
            <div class="yuki-article-content yuki-entry-content clearfix mx-auto prose prose-yuki">
		<?php endif; ?>
		<?php
	}
}
add_action( 'woocommerce_before_main_content', 'yuki_woo_before_content', 5 );

if ( ! function_exists( 'yuki_woo_after_content' ) ) {
	/**
	 * Wrap woocommerce content - end
	 */
	function yuki_woo_after_content() {
		$layout = 'no-sidebar';
		if ( CZ::checked( 'yuki_store_sidebar_section' ) ) {
			$layout = CZ::get( 'yuki_store_sidebar_layout' );
		}

		?>
		<?php if ( ! is_shop() ): ?>
            </div>
		<?php endif; ?>
        </div>
		<?php
		/**
		 * Hook - yuki_action_sidebar.
		 */
		do_action( 'yuki_action_sidebar', $layout );
		?>
        </div>
		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'yuki_woo_after_content', 50 );

/**
 * WooCommerce's products loop hooks
 */

if ( ! function_exists( 'yuki_woo_loop_filters_wrapper' ) ) {
	/**
	 * Wrap WooCommerce filters start
	 */
	function yuki_woo_loop_filters_wrapper() {
		?><div class="yuki-products-filters"><?php
	}
}

if ( ! function_exists( 'yuki_woo_loop_filters_wrapper_end' ) ) {
	/**
	 * Wrap WooCommerce filters end
	 */
	function yuki_woo_loop_filters_wrapper_end() {
		?></div><?php
	}
}

if ( ! function_exists( 'yuki_woo_loop_item_wrapper' ) ) {
	/**
	 * Wrap WooCommerce loop product item start
	 */
	function yuki_woo_loop_item_wrapper() {
		$classnames = Utils::clsx( [
			'yuki-product-wrapper' => true,
			'yuki-scroll-reveal'   => CZ::checked( 'yuki_store_card_scroll_reveal' )
		] )

		?><div class="<?php echo esc_attr( $classnames ) ?>"><?php
	}
}

if ( ! function_exists( 'yuki_woo_loop_item_wrapper_end' ) ) {
	/**
	 * Wrap WooCommerce loop product item end
	 */
	function yuki_woo_loop_item_wrapper_end() {
		?></div><?php
	}
}

if ( ! function_exists( 'yuki_woo_loop_product_thumbnail_wrapper' ) ) {
	/**
	 * Wrap WooCommerce loop product thumbnail start
	 */
	function yuki_woo_loop_product_thumbnail_wrapper() {
		?><div class="yuki-product-thumbnail"><?php
	}
}

if ( ! function_exists( 'yuki_woo_loop_product_thumbnail_wrapper_end' ) ) {
	/**
	 * Wrap WooCommerce loop product thumbnail end
	 */
	function yuki_woo_loop_product_thumbnail_wrapper_end() {
		?></div><?php
	}
}

if ( ! function_exists( 'yuki_woo_loop_product_content_wrapper' ) ) {
	/**
	 * Wrap WooCommerce loop product content start
	 */
	function yuki_woo_loop_product_content_wrapper() {
		?><div class="yuki-product-content"><?php
	}
}

if ( ! function_exists( 'yuki_woo_loop_product_content_wrapper_end' ) ) {
	/**
	 * Wrap WooCommerce loop product content end
	 */
	function yuki_woo_loop_product_content_wrapper_end() {
		?></div><?php
	}
}

/**
 * Single product
 */

if ( ! function_exists( 'yuki_woo_product_gallery_wrapper' ) ) {
	function yuki_woo_product_gallery_wrapper() {
		?><div class="yuki-woo-single-gallery"><?php
	}
}

if ( ! function_exists( 'yuki_woo_product_gallery_wrapper_end' ) ) {
	function yuki_woo_product_gallery_wrapper_end() {
		?></div><?php
	}
}

/**
 *  Checkout page hooks
 */

if ( ! function_exists( 'yuki_woo_checkout_wrapper' ) ) {
	function yuki_woo_checkout_wrapper() {
		?><div class="yuki-woo-checkout-wrapper"><?php
	}
}

if ( ! function_exists( 'yuki_woo_checkout_wrapper_end' ) ) {
	function yuki_woo_checkout_wrapper_end() {
		?></div><?php
	}
}

if ( ! function_exists( 'yuki_woo_checkout_left_wrapper' ) ) {
	function yuki_woo_checkout_left_wrapper() {
		?><div class="yuki-woo-checkout-left-columns"><?php
	}
}

if ( ! function_exists( 'yuki_woo_checkout_left_wrapper_end' ) ) {
	function yuki_woo_checkout_left_wrapper_end() {
		?></div><?php
	}
}

if ( ! function_exists( 'yuki_woo_checkout_right_wrapper' ) ) {
	function yuki_woo_checkout_right_wrapper() {
		?><div class="yuki-woo-checkout-right-columns"><?php
	}
}

if ( ! function_exists( 'yuki_woo_checkout_right_wrapper_end' ) ) {
	function yuki_woo_checkout_right_wrapper_end() {
		?></div><?php
	}
}

/**
 *  Products loop hooks
 */

if ( ! function_exists( 'yuki_woo_set_loop_posts_per_page' ) ) {
	/**
	 * Products pre page count
	 *
	 * @return int
	 */
	function yuki_woo_set_loop_posts_per_page() {
		return intval( CZ::get( 'yuki_store_catalog_per_page' ) );
	}
}

if ( ! function_exists( 'yuki_woo_content_header' ) ) {
	/**
	 * Show shop header
	 */
	function yuki_woo_content_header() {
		if ( is_product() ) {
			// Don't show header on single product page
			return;
		}

		yuki_show_archive_header();
	}
}

if ( ! function_exists( 'yuki_woo_modify_loop_add_to_card_args' ) ) {
	/**
	 * Modify add to card button classes
	 *
	 * @param $args
	 *
	 * @return mixed
	 */
	function yuki_woo_modify_loop_add_to_card_args( $args ) {
		$args['class'] = $args['class'] . ' yuki-button';

		return $args;
	}
}

if ( ! function_exists( 'yuki_modify_woo_template_hooks' ) ) {
	/**
	 * Modify woo template hooks
	 */
	function yuki_modify_woo_template_hooks() {
		// Change mobile devices breakpoint.
		add_filter( 'woocommerce_style_smallscreen_breakpoint', function ( $px ) {
			return \LottaFramework\Facades\Css::mobile();
		} );

		// Add custom filter to allow further class modification.
		add_filter( 'woocommerce_product_loop_start', function ( $html ) {
			return preg_replace( '/(class=".*?)"/', '$1 ' . implode( ' ', apply_filters( 'yuki_woo_loop_classes', array( 'yuki-products' ) ) ) . '"', $html );
		} );

		// Remove breadcrumbs for WooCommerce page.
		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
		// Remove Default WooCommerce Sidebar
		remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

		// Change main content (primary) wrapper.
		remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
		remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
		add_action( 'woocommerce_before_main_content', 'yuki_woo_content_header', 0 );
		add_action( 'woocommerce_before_main_content', 'yuki_woo_before_content', 5 );
		add_action( 'woocommerce_after_main_content', 'yuki_woo_after_content', 50 );

		// Remove title from its original position.
		add_filter( 'woocommerce_show_page_title', '__return_false' );
		// Remove archive description from its original position.
		remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );

		// Remove the original link wrapper.
		remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

		// Add wrapper to products grid filters.
		add_action( 'woocommerce_before_shop_loop', 'yuki_woo_loop_filters_wrapper', 11 );
		add_action( 'woocommerce_before_shop_loop', 'yuki_woo_loop_filters_wrapper_end', 999 );

		// Add wrapper to products grid item.
		add_action( 'woocommerce_before_shop_loop_item', 'yuki_woo_loop_item_wrapper', 1 );
		add_action( 'woocommerce_after_shop_loop_item', 'yuki_woo_loop_item_wrapper_end', 999 );

		// Add product thumbnail wrapper.
		add_action( 'woocommerce_before_shop_loop_item_title', 'yuki_woo_loop_product_thumbnail_wrapper', 1 );
		add_action( 'woocommerce_before_shop_loop_item_title', 'yuki_woo_loop_product_thumbnail_wrapper_end', 999 );
		// Add a link wrapper to the product thumbnail.
		add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 9 );
		add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 19 );

		// Change the order of the on sale button.
		remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
		add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 2 );

		// Add a link wrapper to the product title.
		add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 1 );
		add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 999 );

		// Add product content wrapper
		add_action( 'woocommerce_shop_loop_item_title', 'yuki_woo_loop_product_content_wrapper', 0 );
		add_action( 'woocommerce_after_shop_loop_item', 'yuki_woo_loop_product_content_wrapper_end', 999 );

		add_filter( 'woocommerce_loop_add_to_cart_args', 'yuki_woo_modify_loop_add_to_card_args' );

		// Products loop
		add_filter( 'loop_shop_per_page', 'yuki_woo_set_loop_posts_per_page' );

		/**
		 * Single product page
		 */
		// Add wrapper to products grid filters.
		add_action( 'woocommerce_before_single_product_summary', 'yuki_woo_product_gallery_wrapper', 19 );
		add_action( 'woocommerce_before_single_product_summary', 'yuki_woo_product_gallery_wrapper_end', 29 );
	}
}
add_action( 'init', 'yuki_modify_woo_template_hooks' );

if ( ! function_exists( 'yuki_modify_template_hooks_after_init' ) ) {
	/**
	 * Modify filters for WooCommerce template rendering
	 */
	function yuki_modify_template_hooks_after_init() {
		/**
		 * Checkout page hooks
		 */
		if ( is_checkout() ) {
			add_action( 'woocommerce_checkout_before_customer_details', 'yuki_woo_checkout_wrapper', 1 );

			add_action( 'woocommerce_checkout_before_customer_details', 'yuki_woo_checkout_left_wrapper', 1 );
			add_action( 'woocommerce_checkout_after_customer_details', 'yuki_woo_checkout_left_wrapper_end', 999 );

			add_action( 'woocommerce_checkout_before_order_review_heading', 'yuki_woo_checkout_right_wrapper', 1 );
			add_action( 'woocommerce_checkout_after_order_review', 'yuki_woo_checkout_right_wrapper_end', 999 );

			add_action( 'woocommerce_checkout_after_order_review', 'yuki_woo_checkout_wrapper_end', 999 );
		}
	}
}
add_action( 'wp', 'yuki_modify_template_hooks_after_init' );
