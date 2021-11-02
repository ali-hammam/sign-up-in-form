<?php
namespace Nesc\Router;
require_once (ROOT.'Nesc/Facade/Facade.php');
require_once ('Router.php');
use Nesc\Facade\Facade;

class Route extends Facade {

    protected static $router;

    private function __construct(){
        self::$router = null;
    }

    public static function instance(){
        if(is_null(self::$router)){
            self::$router = new Router();
        }
    }

    public static function setFacadeAccessor(){
        self::instance();
        return self::$router;
    }

}