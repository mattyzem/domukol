<?php

namespace App\Routers;

use Nette\Application\Routers\RouteList;
use Nette\Application\Routers\Route;

/**
 * Router factory.
 */
class RouterFactory
{
    /**
     * @return \Nette\Application\IRouter
     */
    public static function createRouter()
    {
        $router = new RouteList;
        $router[] = new Route("", 'Login:login');

        /*$router[] = new Route("users/add/", "Users:add");
        $router[] = new Route("users/show/", "Users:show");
        $router[] = new Route("users/delete/<id [0-9]+>/", "Users:delete");
        $router[] = new Route("users/edit/<id [0-9]+>/", "Users:edit");*/

        $router[] = new Route("<presenter>/<action>/[<id>/]", array(
            'presenter' => 'Login',
            'action' => 'login',
        ));

        return $router;
    }
}
