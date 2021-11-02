<?php
namespace Nesc\DB\Model;
include __DIR__ . '\Traits\DatabaseQuery\SelectedData.php';
include __DIR__ . '\Traits\DatabaseRelationHelpers.php';
include __DIR__ . '\Traits\GeneralHelpers.php';
use DB\DBConnection;
use DB\Model\Traits\GeneralHelpers;
use DB\Model\Traits\DatabaseRelationHelpers;
use DB\Model\Traits\DatabaseQuery\SelectedData;
require_once (ROOT.'/Nesc/DB/DBConnection.php');

class ModelTemplate
{
    use SelectedData , GeneralHelpers , DatabaseRelationHelpers;
    protected $dbConn;
    protected $queryResult = [];

    public function __construct(){
        $this->dbConn = DBConnection::instance();
    }

    //to run any table operation except select
    public function run($successMessage = ''){
        $db = $this->dbConn->openDbConnection(ROOT.'/Nesc/env.txt');
        if ($db->query($this->sql) === TRUE) {
            echo $successMessage;
        } else {
            echo "Error: " . $this->sql . "<br>" . $db->error;
        }
        $this->dbConn->closeDbConnection();
        $this->sql = '';
    }

    // put the values of each row in $arr
    public function runSelect(){
        $this->queryResult = [];
        $i = 0;
        $db = $this->dbConn->openDbConnection(ROOT.'/Nesc/env.txt');
        $result = $db->query($this->sql);
        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $this->queryResult[$i] = $row;
                $i++;
            }
        }
        $this->dbConn->closeDbConnection();
        $this->sql = '';
        return  $this;
    }

    //get all the table rows or get a specific row
    public function get($columnNo = null){
        $columnNo === null ? $temp = $this->queryResult : $temp = $this->queryResult[$columnNo-1];
        $this->queryResult = [];
        return $temp;
    }

    //get the first row of the table
    public function first(){
        $temp =  $this->queryResult[0];
        $this->queryResult = [];
        return $temp;
    }

    //get the last row of the table
    public function last(){
        $temp = $this->queryResult[sizeof($this->queryResult) - 1];
        $this->queryResult = [];
        return $temp;
    }

}