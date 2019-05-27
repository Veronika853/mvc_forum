<?php

final class App
{
    private static $urlModel = null;
    private static $baseDir = '';
    private static $baseUrl = '';

    private static function setupEnvironment()
    {
        self::$baseDir = dirname(__DIR__);
        self::$baseUrl = 'http://forum-mvc.local/';
        define('DS', DIRECTORY_SEPARATOR);
    }

    private static function setupClassLoader()
    {
        spl_autoload_register(function($className) {
            $className = explode('\\', $className);
            $path = [App::getBaseDir() . DIRECTORY_SEPARATOR . 'code'];
            foreach ($className as $part) {
                $path[] = $part;
            }
            $path = implode(DIRECTORY_SEPARATOR, $path) . '.php';
            if (file_exists($path) == true){
                include_once $path;
            }
        });
    }

    public static function run()
    {
        self::setupEnvironment();
        self::setupClassLoader();
        $router = new Router();
        $router->dispatch();
    }

    public static function getBaseDir()
    {
        return self::$baseDir;
    }

    public static function getBaseUrl()
    {
        return self::$baseUrl;
    }

    public static function getUrlModel(){
        if (is_null(self::$urlModel)) {
            $url = new Model\Url();
        }
        return $url;
    }

}
