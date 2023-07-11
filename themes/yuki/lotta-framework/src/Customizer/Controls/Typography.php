<?php

namespace LottaFramework\Customizer\Controls;

use LottaFramework\Customizer\Control;
use LottaFramework\Customizer\Sanitizes;

class Typography extends Control {

	/**
	 * Override default construct to enqueue curren typography by default
	 *
	 * @param string $id
	 */
	public function __construct( string $id ) {
		parent::__construct( $id );

		$this->enqueue();
	}

	/**
	 * Queued fonts
	 *
	 * @var array
	 */
	protected static $queue = [];

	/**
	 * {@inheritDoc}
	 */
	public function getType(): string {
		return 'lotta-typography';
	}

	/**
	 * {@inheritDoc}
	 */
	public function getSanitize() {
		return [ Sanitizes::class, 'typography' ];
	}

	/**
	 * Enqueue current typography
	 *
	 * @return $this
	 */
	public function enqueue() {
		if ( ! in_array( $this->id, self::$queue ) ) {
			self::$queue[] = $this->id;
		}

		return $this;
	}

	/**
	 * Dequeue current typography
	 *
	 * @return $this
	 */
	public function dequeue() {
		$index = array_search( $this->id, self::$queue );
		if ( $index !== false ) {
			array_splice( self::$queue, $index, 1 );
		}

		return $this;
	}

	/**
	 * Get queued typography
	 *
	 * @return array
	 */
	public static function getQueued() {
		return self::$queue;
	}
}