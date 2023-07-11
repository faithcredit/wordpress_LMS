<?php
/**
 * Socials element
 *
 * @package Yuki
 */

use LottaFramework\Customizer\GenericBuilder\Element;
use LottaFramework\Facades\Css;
use LottaFramework\Facades\CZ;
use LottaFramework\Icons\IconsManager;
use LottaFramework\Utils;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Yuki_Socials_Element' ) ) {

	class Yuki_Socials_Element extends Element {

		use Yuki_Socials_Controls;

		/**
		 * @param string $id
		 *
		 * @return string
		 */
		protected function getSocialControlId( $id ) {
			return $this->getSlug( $id );
		}

		/**
		 * {@inheritDoc}
		 */
		public function getControls() {
			return $this->getSocialControls( wp_parse_args( $this->defaults, [
				'render-callback'   => $this->selectiveRefresh(),
				'selector'          => ".$this->slug",
				'icons-color-type'  => 'official',
				'icons-box-padding' => [
					'top'    => '0px',
					'bottom' => '0px',
					'left'   => '12px',
					'right'  => '12px',
					'linked' => true,
				],
				'icons-box-spacing' => [
					'top'    => '0px',
					'bottom' => '0px',
					'left'   => '0px',
					'right'  => '0px',
					'linked' => true,
				],
			] ) );
		}

		/**
		 * {@inheritDoc}
		 */
		public function enqueue_frontend_scripts() {
			// Add button dynamic css
			add_filter( 'yuki_filter_dynamic_css', function ( $css ) {
				$css[".$this->slug"] = array_merge(
					[
						'--yuki-social-icons-size'    => CZ::get( $this->getSlug( 'icons_size' ) ),
						'--yuki-social-icons-spacing' => CZ::get( $this->getSlug( 'icons_spacing' ) )
					],
					Css::dimensions( CZ::get( $this->getSlug( 'padding' ) ), 'padding' ),
					Css::dimensions( CZ::get( $this->getSlug( 'margin' ) ), 'margin' )
				);

				$css[".$this->slug .yuki-social-link"] = array_merge(
					Css::colors( CZ::get( $this->getSlug( 'icons_color' ) ), [
						'initial' => '--yuki-social-icon-initial-color',
						'hover'   => '--yuki-social-icon-hover-color',
					] ),
					Css::colors( CZ::get( $this->getSlug( 'icons_bg_color' ) ), [
						'initial' => '--yuki-social-bg-initial-color',
						'hover'   => '--yuki-social-bg-hover-color',
					] ),
					Css::colors( CZ::get( $this->getSlug( 'icons_border_color' ) ), [
						'initial' => '--yuki-social-border-initial-color',
						'hover'   => '--yuki-social-border-hover-color',
					] )
				);

				return $css;
			} );
		}


		/**
		 * {@inheritDoc}
		 */
		public function render( $attrs = [] ) {
			$color = CZ::get( $this->getSlug( 'icons_color_type' ) );
			$shape = CZ::get( $this->getSlug( 'icons_shape' ) );
			$fill  = CZ::get( $this->getSlug( 'shape_fill_type' ) );

			$attrs['class'] = Utils::clsx( [
				$this->slug
			], $attrs['class'] ?? [] );

			foreach ( $attrs as $attr => $value ) {
				$this->add_render_attribute( 'socials', $attr, $value );
			}

			$this->add_render_attribute( 'social-link', 'class', 'yuki-social-link' );

			if ( CZ::checked( $this->getSlug( 'open_new_tab' ) ) ) {
				$this->add_render_attribute( 'social-link', 'target', '_blank' );
			}

			if ( CZ::checked( $this->getSlug( 'no_follow' ) ) ) {
				$this->add_render_attribute( 'social-link', 'rel', 'nofollow' );
			}

			$socials = CZ::repeater( 'yuki_social_networks' );

			?>
            <div <?php $this->print_attribute_string( 'socials' ); ?>>
                <div class="<?php Utils::the_clsx( [
					'yuki-socials',
					'yuki-socials-' . $color,
					'yuki-socials-' . $shape,
					'yuki-socials-' . $fill => $shape !== 'none',
				] ); ?>">
					<?php foreach ( $socials as $social ) { ?>
						<?php if ( ! isset( $social['url'] ) || empty( $social['url'] ) ) {
							continue;
						} ?>
                        <a <?php $this->print_attribute_string( 'social-link' ); ?>
                                style="--yuki-official-color: <?php echo esc_attr( $social['color']['official'] ?? 'var(--yuki-primary-active)' ) ?>;"
                                href="<?php echo esc_url( $social['url'] ) ?>">
                                <span class="yuki-social-icon">
                                    <?php IconsManager::print( $social['icon'] ); ?>
                                </span>
                        </a>
					<?php } ?>
                </div>
            </div>
			<?php
		}
	}
}

