<?php
/**
 * Get recent user accounts from the database
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * http://www.gnu.org/copyleft/gpl.html
 *
 * @file
 */

namespace LearnLearnIn\Extension\BlocklistEmailDomains\Maintenance;

use MediaWiki\Maintenance\Maintenance;
use Wikimedia\Rdbms\SelectQueryBuilder;

// @codeCoverageIgnoreStart
$IP = getenv( 'MW_INSTALL_PATH' );
if ( $IP === false ) {
	$IP = __DIR__ . '/../../..';
}
require_once "$IP/maintenance/Maintenance.php";
// @codeCoverageIgnoreEnd

/**
 * Maintenance script that lists recent accounts from the database
 *
 * @ingroup Maintenance
 */
class GetRecentAccounts extends Maintenance {
	public function __construct() {
			parent::__construct();
			$this->addOption( 'output', 'Output format (json)' );
	}

	public function execute() {
			$recentUsers = [];
			$dbr = $this->getReplicaDB();
			$res = $dbr->newSelectQueryBuilder()
					->select( [ 'user_name', 'user_real_name', 'user_email', 'user_email_authenticated' ] )
					->from( 'user' )
					->orderBy( 'user_registration', SelectQueryBuilder::SORT_DESC )
					->limit( 10 )
					->caller( __METHOD__ )->fetchResultSet();
		$outputFormat = $this->hasOption( 'output' ) ? $this->getOption( 'output' ) : "plain";
		foreach ( $res as $row ) {
				$recentUsers[] = $row;
		}
		if ( $outputFormat === "json" ) {
			$this->output( json_encode( $recentUsers ) );
		} else {
			foreach ( $recentUsers as $user ) {
				$res = "{$user->user_name} <{$user->user_email}>";
				if ( $user->user_email_authenticated ) {
					$res .= "(authenticated at {$user->user_email_authenticated})";
				}
				if ( $user->user_real_name ) {
					$res .= "(name: {$user->user_real_name})";
				}
				$this->output( "{$res}\n" );
			}

		}
	}

}

// @codeCoverageIgnoreStart
$maintClass = GetRecentAccounts::class;
require_once RUN_MAINTENANCE_IF_MAIN;
// @codeCoverageIgnoreEnd
