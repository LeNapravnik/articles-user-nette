<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Forms;
use Nette;
use Nette\Application\UI\Form;
use Nette\Application\AbortException;

/**
 * Presenter pro administraci
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
   	 * Pokud je uživatel již přihlášen, přesměruje na články
   	 * @throws AbortException Když dojde k přesměrování.
   	*/
  	public function actionLogin() {
    	if ($this->getUser()->isLoggedIn()) $this->redirect('Article:default');
  	}

  	/** Předá jméno přihlášeného uživatele do šablony administrační stránky. */
  	public function renderDefault() {
    	if ($this->getUser()->isLoggedIn()) {
      		$this->template->username = $this->user->identity->username;
    	}
  	}

	/**
	 * Vytvoří a vrátí přihlašovací formulář
	 */
	protected function createComponentSignInForm(): Form {
		return $this->signInFactory->create(function (): void {
			$this->restoreRequest($this->backlink);
    		$this->flashMessage('Byl jste úspěšně přihlášen.');
			$this->redirect('Article:default');
		});
	}

	/**
	 * Vytvoří a vrátí registrační formulář
	 */
	protected function createComponentSignUpForm(): Form {
		return $this->signUpFactory->create(function (): void {
      		$this->flashMessage('Byl jste úspěšně zaregistrován.');
			$this->redirect('Article:default');
		});
	}

	protected function createComponentEditPasswordForm(): Form {
		if ($this->getUser()->isLoggedIn()) {
			return $this->changePasswordFactory->create(function (): void {
				$this->flashMessage('Heslo bylo změněno.');
		  		$this->redirect('Article:default');
	  		});
		}
	}

  	/**
   	 * Odhlásí uživatele a přesměruje na přihlašovací stránku.
     * @throws AbortException Při přesměrování na přihlašovací stránku.
     */
	public function actionLogout(): void {
		$this->getUser()->logout();
    	$this->redirect('login');
	}
}