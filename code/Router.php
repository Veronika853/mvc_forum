<?php

class Router
{
    public function dispatch()
    {
        $requestUri = isset($_SERVER['REQUEST_URI']) ? trim($_SERVER['REQUEST_URI'], '/') : null;

        if (is_null($requestUri)) {
            echo 404;
        } else {
            if (!$requestUri) {
                $requestUri = 'theme/index';
            }
            $request = explode('/', $requestUri);
            if (isset($request[1])) {
                $actionName = $request[1];
            } else{
                $actionName = 'index';
            }
            $controllerName = $request[0];

            for ($i = 2; $i < count($request) - 1; $i += 2){
                $_GET[$request[$i]] = $request[$i+1];
            }

            $controllerName = explode('_', $controllerName);

            $controllerClassName = ['Controller'];

            foreach ($controllerName as $namePart) {
                $controllerClassName[] = ucfirst(strtolower($namePart));
            }

            $controllerClassName = implode('\\', $controllerClassName) . 'Controller';
            $methodName = strtolower($actionName) . 'Action';
            if (class_exists($controllerClassName) && method_exists($controllerClassName, $methodName)) {
                $controllerInstance = new $controllerClassName();
                $controllerInstance->$methodName();
            } else {
                header("HTTP/1.0 404 Not Found");
            }
        }
    }
}