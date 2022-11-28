<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Forms;
use Nette;
use Nette\Application\UI\Form;
use Nette\Application\AbortException;

/**
 * Presenter for user administration
 */
final class UserPresenter extends BasePresenter {
	/** @persistent */
	public string $backlink = '';

	private Forms\SignInFormFactory $signInFactory;
	private Forms\SignUpFormFactory $signUpFactory;
	private Forms\ChangePasswordFormFactory $changePasswordFactory;


	public function __construct(Forms\SignInFormFactory $signInFactory, Forms\SignUpFormFactory $signUpFactory, Forms\ChangePasswordFormFactory $changePasswordFactory) {
    parent::__construct();
		$this->signInFactory = $signInFactory;
		$this->signUpFactory = $signUpFactory;
		$this->changePasswordFactory = $changePasswordFactory;
	}

  	/**
   	 * Logged user is redirected to article page
   	 * @throws AbortException when redirected
   	*/
  	public function actionLogin() {
    	if ($this->getUser()->isLoggedIn()) $this->redirect('Article:default');
  	}

  	/** Passes logged user name on to user administration template */
  	public function renderDefault() {
    	if ($this->getUser()->isLoggedIn()) {
      		$this->template->username = $this->user->identity->username;
    	}
  	}

	/**
	 * Renders and returns sign in form
	 */
	protected function createComponentSignInForm(): Form {
		return $this->signInFactory->create(function (): void {
			$this->restoreRequest($this->backlink);
    		$this->flashMessage('Byl jste úspěšně přihlášen.');
			$this->redirect('Article:default');
		});
	}

	/**
	 * Renders and returns sign up form
	 */
	protected function createComponentSignUpForm(): Form {
		return $this->signUpFactory->create(function (): void {
      		$this->flashMessage('Byl jste úspěšně zaregistrován.');
			$this->redirect('Article:default');
		});
	}

	/**
	 * For logged user renders and returns form for changing password
	 */
	protected function createComponentEditPasswordForm(): Form {
		if ($this->getUser()->isLoggedIn()) {
			return $this->changePasswordFactory->create(function (): void {
				$this->flashMessage('Heslo bylo změněno.');
		  		$this->redirect('Article:default');
	  		});
		}
	}

  	/**
   	 * Logs user out and redirects to sign in page
     * @throws AbortException when redirected to sign in page
     */
	public function actionLogout(): void {
		$this->getUser()->logout();
    	$this->redirect('login');
	}
}