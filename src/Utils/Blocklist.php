<?php
/**
 * @license GPL-2.0-or-later
 *
 * @file
 */

namespace LearnLearnIn\Extension\BlocklistEmailDomains\Utils;

class Blocklist {
	protected string $path;
	protected array $blocklist;

	public function __construct( string $path ) {
		$this->path = $path;
		$this->blocklist = explode("\n", file_get_contents( $path ));
	}

	/**
	 * @return array contents of the blocklist
	 */
	public function getBlocklist(): array {
		return $this->blocklist;
	}
}
