<?php

class Route
{
    /**
     * @return void
     */
    static function start()
    {
        $defaultController = 'LinkController';
        $defaultModel = 'Link';
        $path = 'app';

        if (self::checkGetParameter()) {
            $path = 'api/v1';
        }

        $routes = explode('/', $_SERVER['REQUEST_URI']);

        if (!empty($routes[1]) && file_exists($path . '/controllers/' . ucfirst($routes[1]) . 'Controller.php')) {
            include 'common/models/' . ucfirst($routes[1]) . '.php';
            $controllerName = ucfirst($routes[1]) . 'Controller';
            include $path . '/controllers/' . $controllerName . '.php';
            $controller = new $controllerName;
            if (!empty($routes[2])) {
                $actionName = 'action' . ucfirst($routes[2]);
                $controller->$actionName();
            } else {
                $controller->actionIndex();
            }
        } else {
            include 'common/models/' . $defaultModel . '.php';
            include $path . '/controllers/' . $defaultController . '.php';
            $controller = new $defaultController;
            $controller->actionIndex();
        }
    }

    /**
     * @return bool
     */
    private static function checkGetParameter()
    {
        if (!empty($_GET) && isset($_GET['url'])) {
            return true;
        }

        return false;
    }
}
