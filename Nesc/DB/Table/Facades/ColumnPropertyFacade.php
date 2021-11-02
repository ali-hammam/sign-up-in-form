<?php
namespace DB\Table\Facades;
require_once (ROOT.'/Nesc/DB/Table/ColumnProperty.php');
require_once (ROOT.'/Nesc/Facade/Facade.php');
use DB\Table\ColumnProperty;
use Nesc\Facade\Facade;

class ColumnPropertyFacade extends Facade{

    // i want to route any functions in ColumnProperty()
    public static function setFacadeAccessor(){
        return new ColumnProperty();
    }
}