<?php
/**
 * @license GPL-2.0-or-later
 *
 * @file
 */

namespace LearnLearnIn\Extension\BlocklistEmailDomains\Utils;

class Email {
	protected string $email;

	public function __construct( string $email ) {
		$this->email = $email;
	}

	public function getEmailDomains(): array {
		$result = [];
		$parts = explode( "@", $this->email );
		$domain = strtolower( $parts[1] ); // blocklist is matched case-sensitive
		$result[] = $domain;
		$dotPosition = strpos( $result[0], "." );
		while ( $dotPosition ) {
			$result[] = substr( $result[array_key_last( $result )], $dotPosition + 1 );
			$dotPosition = strpos( $result[array_key_last( $result )], "." );
		}
		return $result;
	}
}
