<?php

declare(strict_types=1);

namespace App\Forms;

use App\Model;
use Nette;
use Nette\Application\UI\Form;
use App\Model\UserManager;
use Nette\Security\User;

/**
 * Change password form factory
 */
final class ChangePasswordFormFactory {
	use Nette\SmartObject;

	private FormFactory $factory;
	private User $user;
	private UserManager $userManager;


	public function __construct(FormFactory $factory, User $user, UserManager $userManager) {
		$this->factory = $factory;
		$this->user = $user;
		$this->userManager = $userManager;
	}


	public function create(callable $onSuccess): Form {

		$form = $this->factory->create();
		
		$form->addPassword('password', 'Zadej nové heslo:')
			->setOption('description', sprintf('alespoň %d znaků', $this->userManager::PASSWORD_MIN_LENGTH))
			->addRule($form::MIN_LENGTH, null, $this->userManager::PASSWORD_MIN_LENGTH);
		$form->addSubmit('send', 'Změnit');

		$form->onSuccess[] = function (Form $form, \stdClass $values) use ($onSuccess): void {
			$this->userManager->changePassword($this->user->getId(), $values->password);
			$onSuccess();
		};

		return $form;
	}
}
