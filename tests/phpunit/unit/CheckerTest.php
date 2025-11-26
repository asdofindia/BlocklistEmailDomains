<?php

namespace LearnLearnIn\Extension\BlocklistEmailDomains\Tests;

use LearnLearnIn\Extension\BlocklistEmailDomains\Utils\Blocklist;
use LearnLearnIn\Extension\BlocklistEmailDomains\Utils\Checker;
use LearnLearnIn\Extension\BlocklistEmailDomains\Utils\Email;
use PHPUnit\Framework\TestCase;

/**
 * @covers namespace LearnLearnIn\Extension\BlocklistEmailDomains\Utils\Checker
 */
class CheckerTest extends TestCase {
	public function testBlocksBlockedAndAllowsOthers() {
		$blocked = new Email( "test@example.com" );
		$allowed = new Email( "test@example.org" );
		$temp = tmpfile();
		fwrite( $temp, "example.com\nexample.net" );
		$path = stream_get_meta_data( $temp )['uri'];
		$blocklist = new Blocklist( $path );
		$this->assertTrue( Checker::isBlocked( $blocked, $blocklist ) );
		$this->assertFalse( Checker::isBlocked( $allowed, $blocklist ) );
	}
}
