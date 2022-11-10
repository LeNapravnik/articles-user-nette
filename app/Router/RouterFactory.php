<?php

declare(strict_types=1);

namespace App\Router;

use Nette;
use Nette\Application\Routers\Route;
use Nette\Application\Routers\RouteList;


final class RouterFactory
{
	use Nette\StaticClass;

	public static function createRouter(): RouteList
	{
		$router = new RouteList;
		$router->addRoute('<presenter>/<action>', 'Article:default');

		$router->addRoute('<action>', [
            'presenter' => 'User',
            'action' => [
                Route::FILTER_STRICT => true,
                Route::FILTER_TABLE => [
                    'prihlasit' => 'login',
                    'odhlasit' => 'logout',
                    'registrace' => 'register',
					'editace' => 'edit'
                ]
            ]
        ]);

        $router->addRoute('<action>[/<url>]', [
            'presenter' => 'Article',
            'action' => [
                Route::FILTER_STRICT => true,
                Route::FILTER_TABLE => [
                    'clanky' => 'default'
                ]
            ]
        ]);
		return $router;
	}
}
