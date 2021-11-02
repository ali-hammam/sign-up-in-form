<?php

namespace DB;

use DB\Helpers\ReadEnv;
use mysqli;

require_once('Helpers/ReadEnv.php');

class DBConnection
{

    private static $dbConnection = null;
    private static $dbCredentials;
    private  $conn;

    private function __construct()
    {
    }

    /*
        create the singleton instance
    */
    public static function instance()
    {
        if (self::$dbConnection === null) {
            self::$dbConnection = new DBConnection();
        }
        return self::$dbConnection;
    }

    /*
        for opening connection to a database
    */
    public function openDbConnection($envPath)
    {
        self::$dbCredentials = ReadEnv::getDBArray($envPath);
        $this->conn = new mysqli(self::$dbCredentials['server_name'], self::$dbCredentials['username'], self::$dbCredentials['password'], self::$dbCredentials['database_name']);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        return $this->conn;
    }

    /*
        closing database connection
    */
    public  function closeDbConnection()
    {
        $this->conn = null;
    }

    /*
        getting the connection for querying sql data
    */
    public function getConn()
    {
        return $this->conn;
    }
}
