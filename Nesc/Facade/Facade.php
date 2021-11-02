<?php
namespace Nesc\Facade;

abstract class Facade
{
    public static abstract function setFacadeAccessor();

    //route to any static function from the object in setFacadeAccessor()
    public static function __callStatic($method , $args){
        $obj = static::setFacadeAccessor();
        return $obj->$method(...$args);
    }
}