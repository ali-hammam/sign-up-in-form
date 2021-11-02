<?php

namespace DB\Table;
use DB\DBConnection;
include_once 'config.php';
require_once (ROOT.'/nesc/DB/DBConnection.php');


class TableBluePrint
{
    private $dbConn;

    //create an instance which allow me to open and close connection
    public function __construct(){
       $this->dbConn = DBConnection::instance();
    }

    //Create new Table
    public function create($tableName , $callback){
        $arr = $callback();
        $query = 'CREATE TABLE '.$tableName." (";
        $query = $query.implode(',' , $arr);
        $query = $query.')';
        $this->TableValidation($query , 'Table Created Successfully');
    }

    //drop table
    public function drop($tableName){
        $query = 'DROP TABLE '.$tableName.';';
        $this->TableValidation($query , 'Table Dropped Successfully');
    }

    //add Column to a specific table
    public function addColumn($tableName , $column){
        $query = 'ALTER TABLE '. $tableName;
        $query = $query.' ADD ' .$column;
        $this->TableValidation($query , 'Column Added Successfully');
    }

    //drop column from a specific table
    public function dropColumn($tableName , $columnName){
        $query = 'ALTER TABLE '. $tableName;
        $query = $query.' DROP COLUMN '.$columnName;
        $this->TableValidation($query , 'Column Dropped Successfully');
    }

    //modify column type from a specific table
    public function modifyColumn($tableName , $column){
        $query = 'ALTER TABLE '. $tableName;
        $query = $query.' MODIFY COLUMN '.$column;
        $this->TableValidation($query ,'Column Modified Successfully');
    }

    //to validate the creation or drop of table or column
    private function TableValidation($query , $success){
        if ($this->dbConn->getConn()->query($query) === TRUE) {
            echo "<br>".$success;
        } else {
            echo "\n".$this->dbConn->getConn()->error;
        }
    }
}