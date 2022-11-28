<?php

declare(strict_types=1);

namespace App\Model;

use Nette;
use Nette\Security\Passwords;
use Nette\Database\Explorer;

/**
 * Model for managing users
 */
final class UserManager implements Nette\Security\Authenticator {
	use Nette\SmartObject;

	public const PASSWORD_MIN_LENGTH = 7;

	private const
		TABLE_NAME = 'user',
		COLUMN_ID = 'id',
		COLUMN_NAME = 'username',
		COLUMN_PASSWORD_HASH = 'passwd',
		COLUMN_EMAIL = 'mail',
		COLUMN_ROLE = 'role';


	private Explorer $database;

	private Passwords $passwords;


	public function __construct(Explorer $database, Passwords $passwords) {
		$this->database = $database;
		$this->passwords = $passwords;
	}

	/**
	 * Executes user sign in
	 * @throws Nette\Security\AuthenticationException
	 */
	public function authenticate(string $username, string $password): Nette\Security\SimpleIdentity {
		$row = $this->database->table(self::TABLE_NAME)
			->where(self::COLUMN_NAME, $username)
			->fetch();

		if (!$row) {
			throw new Nette\Security\AuthenticationException('Zadané uživatelské jméno neexistuje.', self::IDENTITY_NOT_FOUND);

		} elseif (!$this->passwords->verify($password, $row[self::COLUMN_PASSWORD_HASH])) {
			throw new Nette\Security\AuthenticationException('Zadáno chybné heslo.', self::INVALID_CREDENTIAL);

		} elseif ($this->passwords->needsRehash($row[self::COLUMN_PASSWORD_HASH])) {
			$row->update([
				self::COLUMN_PASSWORD_HASH => $this->passwords->hash($password),
			]);
		}

		$arr = $row->toArray();
		unset($arr[self::COLUMN_PASSWORD_HASH]);
		return new Nette\Security\SimpleIdentity($row[self::COLUMN_ID], $row[self::COLUMN_ROLE], $arr);
	}


	/**
	 * Adds new user
	 * @throws DuplicateNameException
	 */
	public function add(string $username, string $email, string $password): void {
		Nette\Utils\Validators::assert($email, 'email');
		try {
			$this->database->table(self::TABLE_NAME)->insert([
				self::COLUMN_NAME => $username,
				self::COLUMN_PASSWORD_HASH => $this->passwords->hash($password),
				self::COLUMN_EMAIL => $email,
			]);
		} catch (Nette\Database\UniqueConstraintViolationException $e) {
			throw new DuplicateNameException;
		}
	}

	/**
	 * Changes user password
	 * 
	 */
	public function changePassword(int $user_id, string $password): void {
		try {
			$this->database->table(self::TABLE_NAME)
            ->where(self::COLUMN_ID, $user_id)
            ->update([self::COLUMN_PASSWORD_HASH => $this->passwords->hash($password)]);
		} catch (Nette\Database\UniqueConstraintViolationException $e) {

		}
	}
}

class DuplicateNameException extends \Exception {
	// error message setting
    protected $message = 'Uživatel s tímto jménem již existuje.';
}
