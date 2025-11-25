<?php
/**
 * @license GPL-2.0-or-later
 *
 * @file
 */

namespace LearnLearnIn\Extension\BlocklistEmailDomains;

use Exception;
use LearnLearnIn\Extension\BlocklistEmailDomains\Utils\Blocklist;
use LearnLearnIn\Extension\BlocklistEmailDomains\Utils\Checker;
use LearnLearnIn\Extension\BlocklistEmailDomains\Utils\Email;
use MediaWiki\Auth\AbstractPreAuthenticationProvider;
use MediaWiki\MediaWikiServices;
use MediaWiki\Status\Status;

class PreAuth extends AbstractPreAuthenticationProvider {
	/** @inheritDoc */
	public function testForAccountCreation( $user, $creator, array $reqs ) {
		$config = MediaWikiServices::getInstance()->getMainConfig();
		$badDomainsPath = $config->get( "BEDBadDomainsPath" );
		if ( !$badDomainsPath ) {
			throw new Exception( "\$wgBEDBadDomainsPath is empty" );
		}
		$email = new Email( $user->mEmail );
		$blocklist = new Blocklist( $badDomainsPath );

		if ( Checker::isBlocked( $email, $blocklist ) ) {
			return Status::newFatal(
				"You're not allowed to register. Please contact administrator.",
			);
		}
		return Status::newGood();
	}
}
