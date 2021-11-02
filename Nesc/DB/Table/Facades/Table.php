<?php
namespace DB\Table\Facades;
require_once (ROOT.'/Nesc/DB/Table/TableBluePrint.php');
require_once (ROOT.'/Nesc/Facade/Facade.php');
use DB\Table\TableBluePrint;
use Nesc\Facade\Facade;

class Table extends Facade{

    // i want to route the functions in TableBluePrint()
    public static function setFacadeAccessor()
    {
        return new TableBluePrint();
    }
}