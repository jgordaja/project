<?php

namespace It20Academy\App\Core;

class App
{
    public function run()
    {
        //dump(__METHOD__);
        $request = new Request();

        if (! $request->validateCommand()) {
            dump('Invalid data');

            return false;
        }

        $controllerName = $request->getController();
        $method = $request->getMethod();

        $controller = new $controllerName; // It20Academy\App\Controllers\PostsController
        $controller->$method();
    }
}