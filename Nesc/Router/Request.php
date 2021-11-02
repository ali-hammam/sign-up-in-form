<?php
namespace Nesc\Router;

class Request {

    private static $instance = null;
    private static $dataHolder = [];
    private function __construct(){
        self::$dataHolder = null;
    }

    public static function instantiate(){
        return self::$instance !== null ? self::$instance  :  self::$instance = new Request();
    }

    public static function setData($value){
        empty(self::$dataHolder) ? : self::$dataHolder = [];
        self::$dataHolder = $value;
    }

    public static function getData(){
        return self::$dataHolder;
    }

    public static function get($value){
        return self::$dataHolder[$value];
    }

}