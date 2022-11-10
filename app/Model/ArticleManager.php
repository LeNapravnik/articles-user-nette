<?php

declare(strict_types=1);

namespace App\Model;

use Nette\Utils\ArrayHash;
use Nette\Database\Explorer;
use Nette\SmartObject;

/**
 * Model pro správu článků
 * @package App\Model
 */
class ArticleManager {
    use SmartObject;

    /** @var Explorer Služba pro práci s DB */
    private Explorer $database;
    
    /** Konstanty pro práci s databází. */
    const
        TABLE_NAME = 'article',
        COLUMN_ID = 'id',
        COLUMN_LINK = 'link',
        COLUMN_DATE = 'insertion_date';

	/**
	 * @param Explorer $database automaticky injektovaná služba pro práci s DB
	 */
	public function __construct(Explorer $database) {
		$this->database = $database;
    }
    /**
     * Vrátí seznam všech článků v databázi seřazený sestupně od naposledy přidaného.
     * @return Selection seznam článků
     */
    public function getAllArticles() {
       return $this->database->table(self::TABLE_NAME)
      ->order(self::COLUMN_DATE . ' DESC');
    }

    /**
     * Vrátí seznam všech článků v databázi seřazený sestupně od naposledy přidaného.
     * @return Selection seznam článků
     */
    public function getArticlesForLoggedUsers() {
       return $this->database->table(self::TABLE_NAME)
        ->where('visibility', 'all_users')
        ->order(self::COLUMN_DATE . ' DESC');
    }

    /**
     * Vrátí článek z databáze podle jeho linku.
     * @param string $link link článku
     * @return false|ActiveRow první článek, který odpovídá linku nebo false pokud článek s daným linkem neexistuje
     */
    public function getArticle($link) {
        return $this->database->table(self::TABLE_NAME)->where(self::COLUMN_LINK, $link)->fetch();
    }

    /**
     * Uloží článek do systému.
     * Pokud není nastaveno ID vloží nový článek, edituje článek s daným ID.
     * @param array|ArrayHash $article článek
     */
    public function saveArticle(ArrayHash $article) {
        if (empty($article[self::COLUMN_ID])) {
            unset($article[self::COLUMN_ID]);
            $this->database->table(self::TABLE_NAME)->insert($article);
        } else
            $this->database->table(self::TABLE_NAME)->where(self::COLUMN_ID, $article[self::COLUMN_ID])->update($article);
    }

    /**
     * Uloží hodnocení
     * @param int $article_id id článku
     * @param int $user_id id uživatele
     * @param int $rating hodnocení
     */
    public function saveArticleRating(int $article_id, int $user_id, int $rating) {
        $article_data = $this->database->table(self::TABLE_NAME)
            ->where(self::COLUMN_ID, $article_id)
            ->fetch();

        $article_rating = $article_data['rating'];

        if(!$article_rating){
            $article_rating = 0;
        }

        $article_rating += $rating;

        $this->database->table(self::TABLE_NAME)
            ->where(self::COLUMN_ID, $article_id)
            ->update(['rating' => $article_rating]);


        $this->database->table('rating')
            ->insert([
                'article_id' => $article_id,
                'user_id' => $user_id,
                'value' => $rating
            ]);
    }

    /**
     * Uloží hodnocení
     * @param int $article_id id článku
     * @param string $visibility nastavení zobrazení
     */
    public function setVisibility(int $article_id, string $visibility) {
        $this->database->table(self::TABLE_NAME)
            ->where(self::COLUMN_ID, $article_id)
            ->update(['visibility' => $visibility]);
    }

}