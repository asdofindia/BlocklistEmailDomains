<?php
/**
 * @license GPL-2.0-or-later
 *
 * @file
 */

namespace LearnLearnIn\Extension\BlocklistEmailDomains\Utils;

class Blocklist {
	protected string $path;

	public function __construct( string $path ) {
		$this->path = $path;
	}

	/**
	 * @return array contents of the blocklist
	 */
	public function getBlocklist(): array {
		return file( $this->path, FILE_IGNORE_NEW_LINES );
	}
}
