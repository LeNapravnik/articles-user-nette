<?php

declare(strict_types=1);

namespace App\Model;

use Nette\Utils\ArrayHash;
use Nette\Database\Explorer;
use Nette\SmartObject;

/**
 * model for managing Articles
 * @package App\Model
 */
class ArticleManager {
    use SmartObject;

    /** @var Explorer service for work with database */
    private Explorer $database;
    
    /** Constants for work with database */
    const
        TABLE_NAME = 'article',
        COLUMN_ID = 'id',
        COLUMN_LINK = 'link',
        COLUMN_DATE = 'insertion_date';

	/**
	 * @param Explorer $database injected service for work with database
	 */
	public function __construct(Explorer $database) {
		$this->database = $database;
    }
    /**
     * Returns list of all articles in database ordered descending by date of adding
     * @return Selection article list
     */
    public function getAllArticles() {
       return $this->database->table(self::TABLE_NAME)
      ->order(self::COLUMN_DATE . ' DESC');
    }

    /**
     * Returns list of articles visible for all users
     * @return Selection article list
     */
    public function getArticlesForAllUsers() {
       return $this->database->table(self::TABLE_NAME)
        ->where('visibility', 'all_users')
        ->order(self::COLUMN_DATE . ' DESC');
    }

    /**
     * Returns article with given link
     * @param string $link article link
     * @return false|ActiveRow first article with given link, false if there is no article with given link
     */
    public function getArticle($link) {
        return $this->database->table(self::TABLE_NAME)->where(self::COLUMN_LINK, $link)->fetch();
    }

    /**
     * Saves article
     * If there is no article with ID, inserts new article, else changes article with given ID.
     * @param array|ArrayHash $article article data
     */
    public function saveArticle(ArrayHash $article) {
        if (empty($article[self::COLUMN_ID])) {
            unset($article[self::COLUMN_ID]);
            $this->database->table(self::TABLE_NAME)->insert($article);
        } else
            $this->database->table(self::TABLE_NAME)->where(self::COLUMN_ID, $article[self::COLUMN_ID])->update($article);
    }

    /**
     * Saves rating
     * @param int $article_id article id
     * @param int $user_id id user id
     * @param int $rating rating value
     */
    public function saveArticleRating(int $article_id, int $user_id, int $rating) {
        $article_data = $this->database->table(self::TABLE_NAME)
            ->where(self::COLUMN_ID, $article_id)
            ->fetch();

        $article_rating = $article_data['rating'];

        if(!$article_rating){
            $article_rating = 0;
        }

        $user_rating = $this->database->table('rating')
            ->where('article_id', $article_id)
            ->where('user_id', $user_id)
            ->fetch();

        if(!$user_rating){
            $this->database->table('rating')
                ->insert([
                    'article_id' => $article_id,
                    'user_id' => $user_id,
                    'value' => $rating
                ]);
        
            $article_rating += $rating;

            $this->database->table(self::TABLE_NAME)
                ->where(self::COLUMN_ID, $article_id)
                ->update(['rating' => $article_rating]);
            return true;
        }
        else{
            return false;
        }  
    }

    /**
     * Sets article visibility
     * @param int $article_id article id
     * @param string $visibility visibility value
     */
    public function setVisibility(int $article_id, string $visibility) {
        $this->database->table(self::TABLE_NAME)
            ->where(self::COLUMN_ID, $article_id)
            ->update(['visibility' => $visibility]);
    }

}