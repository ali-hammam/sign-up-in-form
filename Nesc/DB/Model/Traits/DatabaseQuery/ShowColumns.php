<?php
namespace DB\Model\Traits\DatabaseQuery;

trait ShowColumns
{
    //it shows column Name and properties like INT or Varchar
    public function show($tableName){
        $this->sql =  $this->sql.'SHOW COLUMNS FROM '.$tableName;
        return $this;
    }
}