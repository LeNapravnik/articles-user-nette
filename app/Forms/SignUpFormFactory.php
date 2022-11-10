<?php

declare(strict_types=1);

namespace App\Forms;

use App\Model;
use Nette;
use Nette\Application\UI\Form;
use App\Model\UserManager;

/**
 * Továrna na registrační formulář.
 */
final class SignUpFormFactory {
	use Nette\SmartObject;

	private FormFactory $factory;

	private UserManager $userManager;


	public function __construct(FormFactory $factory, UserManager $userManager) {
		$this->factory = $factory;
		$this->userManager = $userManager;
	}


	public function create(callable $onSuccess): Form {
		$form = $this->factory->create();
		$form->addText('username', 'Tvé uživatelské jméno:')
			->setRequired('Zadej své uživatelské jméno.');

		$form->addEmail('email', 'Tvůj e-mail:')
			->setRequired('Zadej svůj e-mail.');

		$form->addPassword('password', 'Zadej své heslo password:')
			->setOption('description', sprintf('alespoň %d znaků', $this->userManager::PASSWORD_MIN_LENGTH))
			->setRequired('Vytvoření hesla je povinné.')
			->addRule($form::MIN_LENGTH, null, $this->userManager::PASSWORD_MIN_LENGTH);

		$form->addSubmit('send', 'Registrovat se');

		$form->onSuccess[] = function (Form $form, \stdClass $values) use ($onSuccess): void {
			try {
				$this->userManager->add($values->username, $values->email, $values->password);
			} catch (Model\DuplicateNameException $e) {
				$form['username']->addError('Uživatelské jméno je již používáno.');
				return;
			}
			$onSuccess();
		};

		return $form;
	}
}
