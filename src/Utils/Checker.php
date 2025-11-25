<?php
/**
 * @license GPL-2.0-or-later
 *
 * @file
 */

namespace LearnLearnIn\Extension\BlocklistEmailDomains\Utils;

use function in_array;

class Checker {
	/**
	 * @return bool if email parts are in blocklist, returns true
	 */
	public static function isBlocked( Email $email, Blocklist $blocklist ): bool {
		$domainPartsInEmail = $email->getEmailDomains();
		$blocklistDomains = $blocklist->getBlocklist();
		foreach ( $domainPartsInEmail as $domainPart ) {
			if ( in_array( $domainPart, $blocklistDomains ) ) {
				return true;
			}
		}
		return false;
	}
}
