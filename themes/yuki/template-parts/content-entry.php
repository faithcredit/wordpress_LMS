<?php
/**
 * Template part for displaying posts entry.
 *
 * @package Yuki
 */

use LottaFramework\Facades\CZ;
use LottaFramework\Utils;

$entry_structure = CZ::layers( 'yuki_card_structure' );
$layout          = CZ::get( 'yuki_archive_layout' );

$card_attrs = [
	'id'               => 'post-' . get_the_ID(),
	'class'            => Utils::clsx(
		[ 'card-thumb-motion' => CZ::checked( 'yuki_entry_thumbnail_motion' ) ],
		get_post_class( [ 'yuki-scroll-reveal card overflow-hidden h-full' ] )
	),
	'data-card-layout' => $layout,
];

?>

<div class="card-wrapper w-full">
    <article <?php Utils::print_attribute_string( $card_attrs ); ?>>
		<?php yuki_post_structure( 'entry', $entry_structure, CZ::layers( 'yuki_entry_metas' ), [
			'title_link'   => true,
			'title_tag'    => CZ::get( 'yuki_entry_title_tag' ),
			'excerpt_type' => CZ::get( 'yuki_entry_excerpt_type' ),
			'trans_id'     => 'yuki_entry'
		] ); ?>
    </article>
</div>

