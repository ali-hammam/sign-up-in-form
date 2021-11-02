<?php

namespace DB\Table\Migrations;

require_once(ROOT . '/Nesc/DB/DBConnection.php');

use DB\DBConnection;

abstract class migration
{
    private $dbConn; //for database connection
    protected $className; //hold the current class name
    public function __construct()
    {
        $this->dbConn = DBConnection::instance();
        $this->className = $this->getClass();
    }

    // run migration from the command
    public function run($operation)
    {
        $this->dbConn->openDbConnection(ROOT . '/Nesc/env.txt');
        if (strcmp(strtolower($operation), 'create') === 0) {
            $this->up();
        } else if (strcmp(strtolower($operation), 'drop') === 0) {
            $this->down();
        }
        $this->dbConn->closeDbConnection();
    }

    // for creation or alter any table
    public abstract function up();

    //for drop any table or column
    public abstract function down();

    //get the current class name
    public function getClass()
    {
        $path = explode('\\', get_called_class());
        return array_pop($path);
    }
}
