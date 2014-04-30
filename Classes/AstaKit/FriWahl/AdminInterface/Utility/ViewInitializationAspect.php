<?php
namespace AstaKit\FriWahl\AdminInterface\Utility;

/*                                                                                  *
 * This script belongs to the TYPO3 Flow package "AstaKit.FriWahl.AdminInterface".  *
 *                                                                                  *
 *                                                                                  */

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Aop\JoinPointInterface;
use TYPO3\Flow\Mvc\View\ViewInterface;
use TYPO3\Flow\Security\Context;


/**
 * Initialization aspect for views.
 *
 * @author Andreas Wolf <andreas.wolf@usta.de>
 *
 * @Flow\Aspect
 */
class ViewInitializationAspect {

	/**
	 * @var Context
	 * @Flow\Inject
	 */
	protected $securityContext;

	/**
	 * Assigns default variables like the currently logged-in user to the view.
	 *
	 * @param JoinPointInterface $joinPoint
	 * @Flow\After("method(TYPO3\Flow\Mvc\Controller\ActionController->initializeView())")
	 */
	public function assignDefaultVariablesForTemplateView(JoinPointInterface $joinPoint) {
		/** @var $view ViewInterface */
		$view = $joinPoint->getMethodArgument('view');

		$currentUserAccount = $this->securityContext->getAccount();
		$view->assign('currentUser', $currentUserAccount);
	}
}
