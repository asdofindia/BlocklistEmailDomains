<?php

namespace LearnLearnIn\Extension\BlocklistEmailDomains;

use Maintenance;

$IP = getenv( "MW_INSTALL_PATH" );
if ( $IP === false ) {
	$IP = __DIR__ . "/../../..";
}
require_once "$IP/maintenance/Maintenance.php";

class BlocklistValid extends Maintenance {
	public function __construct() {
		parent::__construct();
		$this->requireExtension( "BlocklistEmailDomains" );
	}

	public function execute() {
		$this->output( "Maintenance script is under construction\n" );
	}
}

$maintClass = BlocklistValid::class;
require_once RUN_MAINTENANCE_IF_MAIN;
