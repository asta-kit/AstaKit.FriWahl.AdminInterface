<?php
namespace AstaKit\FriWahl\AdminInterface\Command;

/*                                                                                  *
 * This script belongs to the TYPO3 Flow package "AstaKit.FriWahl.AdminInterface".  *
 *                                                                                  *
 *                                                                                  */

use AstaKit\FriWahl\Core\Domain\Model\BallotBox;
use AstaKit\FriWahl\Core\Domain\Model\Election;
use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Cli\CommandController;


/**
 * Command controller for managing ballot boxes.
 *
 * @author Andreas Wolf <andreas.wolf@usta.de>
 */
class BallotBoxCommandController extends CommandController {

	/**
	 * @var \TYPO3\Flow\Persistence\PersistenceManagerInterface
	 * @Flow\Inject
	 */
	protected $persistenceManager;

	/**
	 * @param Election $election
	 * @param string $identifier
	 * @param string $name
	 * @param string $sshPublicKey
	 */
	public function createCommand(Election $election, $identifier, $name, $sshPublicKey = '') {
		if ($election->hasBallotBox($identifier)) {
			$this->outputLine('Ballot box ' . $identifier . ' already exists in election ' . $election->getName());
			return;
		}

		$ballotBox = new BallotBox($identifier, $name, $election);
		if ($sshPublicKey != '') {
			$ballotBox->setSshPublicKey($sshPublicKey);
		}

		$this->persistenceManager->add($ballotBox);
	}

	public function listCommand(Election $election) {
		// TODO implement
	}

}
