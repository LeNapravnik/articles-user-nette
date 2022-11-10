<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette,
	App\Model;
use Nette\Application\UI\Form;
//use App\Grids\Grid;
use Ublaboo\DataGrid\DataGrid;

/**
 * Presenter pro články
 */
class ArticlePresenter extends BasePresenter {
  
    private $articleManager;
	
	public function __construct(\App\Model\ArticleManager $articleManager) {
    parent::__construct();
		$this->articleManager = $articleManager;
	}

  /** --- DATAGRIDS --- **/
	
	/**
	 * Datagrid seznam článků
	 * @param type $name
	 * @return Grid
	 */
	public function createComponentDatagrid($name) {

    if ($this->getUser()->isLoggedIn()) {
      $articles = $this->articleManager->GetAllArticles();
    }
    else{
      $articles = $this->articleManager->getArticlesForLoggedUsers();
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

    $grid->addAction('all_users', 'Všem')->setRenderer(function($item) {
      // u článků s nastavenou viditelností 'logged_users' zobrazí tlačítko pro nastavení viditelnosti 'all_users'
      if($item->visibility === 'logged_users'){
        $all = \Nette\Utils\Html::el('a')
                                    ->href($this->presenter->link('setVisibility!', [$item->id, 'all_users']))
                                    ->setText('Zobrazit všem')
                                    ->setClass('btn btn-success ajax');
          return $all;
        }
    });
    // u článků s nastavenou viditelností 'all_users' zobrazí tlačítko pro nastavení viditelnosti 'logged_users'
    $grid->addAction('logged_users', 'Přihlášeným')->setRenderer(function($item) {
      if($item->visibility === 'all_users'){
        $logged = \Nette\Utils\Html::el('a')
                                    ->href($this->presenter->link('setVisibility!', [$item->id, 'logged_users']))
                                    ->setText('Zobrazit jen přihlášeným')
                                    ->setClass('btn btn-warning ajax');
          
        return $logged;
      }
    });

    // přihlášeným uživatelům zobrazí možnost hodnotit článek
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
     * uloží hodnocení k článku
  */
  public function handleRate($id, $rating) {
    $user_id = $this->getUser()->getId();
    $article_id = (int) $id;
    $rating = (int) $rating;

    $this->articleManager->saveArticleRating($article_id, $user_id, $rating);

    $this->flashMessage( "Hodnocení bylo uloženo", "success" );
    $this->redirect( "default" );
  }

  /**
     * uloží nastavení viditelnosti článku
  */
  public function handleSetVisibility($id, $visibility) {
    $article_id = (int) $id;

    $this->articleManager->setVisibility($article_id, $visibility );

    $this->flashMessage( "Nastavení zobrazení bylo změněno", "success" );
    $this->redirect( "default" );
  }

}
