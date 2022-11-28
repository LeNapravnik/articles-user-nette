<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette,
	App\Model;
use Nette\Application\UI\Form;
use Ublaboo\DataGrid\DataGrid;

/**
 * Presenter for articles
 */
class ArticlePresenter extends BasePresenter {
  
    private $articleManager;
	
	public function __construct(\App\Model\ArticleManager $articleManager) {
    parent::__construct();
		$this->articleManager = $articleManager;
	}

  /** --- DATAGRIDS --- **/
	
	/**
	 * Datagrid for article list
	 * @param type $name name of grid
	 * @return Grid
	 */
	public function createComponentDatagrid($name) {

    if ($this->getUser()->isLoggedIn()) {
      $articles = $this->articleManager->GetAllArticles();
    }
    else{
      $articles = $this->articleManager->getArticlesForAllUsers();
    }

	  $grid = new DataGrid($this, $name);
	  $grid->setPrimaryKey('id');
	  $grid->setDataSource($articles);

	  $grid->setRememberState(true);
	    
    $grid->addColumnText('title', 'Nadpis')
        ->setSortable()
        ->setFilterText();   

    $grid->addColumnDateTime('insertion_date', 'Datum vložení')
        ->setFormat('d.m.Y H:i:s')
        ->setSortable()
        ->setFilterText();

    $grid->addColumnNumber('rating', 'Hodnocení')
        ->setSortable()
        ->setFilterText();

    $grid->addColumnText('description', 'Perex');  
    $grid->addColumnText('content', 'text článku');
      //  ->setTemplateEscaping(FALSE);

    $grid->addAction('all_users', 'Všem')->setRenderer(function($item) {
      // for articles with visibility setted to 'logged_users' shows button for setting visibility to 'all_users'
      if($item->visibility === 'logged_users'){
        $all = \Nette\Utils\Html::el('a')
                                    ->href($this->presenter->link('setVisibility!', [$item->id, 'all_users']))
                                    ->setText('Zobrazit všem')
                                    ->setClass('btn btn-success ajax');
          return $all;
        }
    });
    
    $grid->addAction('logged_users', 'Přihlášeným')->setRenderer(function($item) {
      // for articles with visibility setted to 'all_users' shows button for setting visibility to 'logged_users'
      if($item->visibility === 'all_users'){
        $logged = \Nette\Utils\Html::el('a')
                                    ->href($this->presenter->link('setVisibility!', [$item->id, 'logged_users']))
                                    ->setText('Zobrazit jen přihlášeným')
                                    ->setClass('btn btn-warning ajax');
          
        return $logged;
      }
    });

    // viewing possibilities to rate article for logged user
    if ($this->getUser()->isLoggedIn()) {
      $grid->addAction('like', 'Like')->setRenderer(function($item) {
        $like = \Nette\Utils\Html::el('a')
                                    ->href($this->presenter->link('rate!', [$item->id, 1]))
                                    ->setText('Like')
                                    ->setClass('btn btn-success ajax');
        return $like;
      });
      $grid->addAction('dislike', 'Dislike')->setRenderer(function($item) {
        $dislike = \Nette\Utils\Html::el('a')
                                        ->href($this->presenter->link('rate!', [$item->id, -1]))
                                        ->setText('Dislike')
                                        ->setClass('btn btn-danger ajax');
        return $dislike;
      });
    }  
	  return $grid;
	}

  /**
    * Saves rating
    * @param int $id article id
    * @param int $rating rating value
    */
  public function handleRate($id, $rating) {
    $user_id = $this->getUser()->getId();
    $article_id = (int) $id;
    $rating = (int) $rating;

    $rated = $this->articleManager->saveArticleRating($article_id, $user_id, $rating);

    if($rated){
      $this->flashMessage( "Hodnocení bylo uloženo", "success" );
    }
    else {
      $this->flashMessage( "Článek nelze hodnotit opakovaně", "danger" );
    }
    $this->redrawControl();
  }

  /**
    * Sets article visibility
    * @param int $id article id
    * @param string $visibility visibility value
    */
  public function handleSetVisibility($id, $visibility) {
    $article_id = (int) $id;

    $this->articleManager->setVisibility($article_id, $visibility );

    $this->flashMessage( "Nastavení zobrazení bylo změněno", "success" );
    $this->redirect( "default" );
  }

}
