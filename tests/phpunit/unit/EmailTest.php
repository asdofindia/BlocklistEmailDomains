<?php

namespace LearnLearnIn\Extension\BlocklistEmailDomains\Tests;

use LearnLearnIn\Extension\BlocklistEmailDomains\Utils\Email;
use PHPUnit\Framework\TestCase;

/**
 * @covers namespace LearnLearnIn\Extension\BlocklistEmailDomains\Utils\Email
 */
class EmailTest extends TestCase {
	public function testSimpleEmail() {
		$emailInput = "test@example.com";
		$emailObj = new Email( $emailInput );
		$this->assertSame( [ "example.com", "com" ], $emailObj->getEmailDomains() );
	}

	public function testSubDomain() {
		$emailInput = "test@sub.example.com";
		$emailObj = new Email( $emailInput );
		$this->assertSame( [ "sub.example.com", "example.com", "com" ], $emailObj->getEmailDomains() );
	}
}
