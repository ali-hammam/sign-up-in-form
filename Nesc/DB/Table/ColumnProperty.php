<?php

namespace DB\Table;
use DB\Table\Traits\ColumnName;
use DB\Table\Traits\TableConstraint as TableConstraint;
use DB\Table\Traits\TableDataTypes as TableDataTypes;

include __DIR__ . '\Traits\TableConstraint.php';
include __DIR__ . '\Traits\TableDataTypes.php';
include __DIR__ . '\Traits\ColumnName.php';


class ColumnProperty
{
    use TableConstraint , TableDataTypes, ColumnName;
    private $columnProperty = ' ';

    /*
        it gets called after finishing the column property
    */
    public function getColumnProperty(){
        return $this->columnProperty;
    }

    /*
       it executed if you call a function that doesn't exist in the traits
    */
    public function __call($method,$arguments) {

        return 'method didn\'t exist';
    }

}
