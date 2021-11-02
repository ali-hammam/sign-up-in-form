<?php
namespace DB\Helpers;
class ReadEnv
{
    private static $res;
    /*
        for reading DB initialization from .env
    */
    public static function readDbFromEnv($wFile, $d = "="){
        $arr = @file($wFile);
        self::$res = [];
        if ( is_array($arr) == true )
        {
            foreach ($arr as $line)
            {
                $line = trim($line);
                if ( ($line !="") && (substr($line,0,1) != "#") )
                {
                    list($key,$val) = explode($d,$line,2);
                    $key = trim($key);
                    $val = trim($val);
                    self::$res[$key] = $val;
                }
            }
        }
        return self::$res;
    }

    /*
        get the database credential array from env.txt
    */
    public static function getDBArray($wFile){
        $env = self::readDbFromEnv($wFile);
        $res=[];
        $arr = ['server_name' , 'username' , 'password' ,'database_name'];
        foreach ($env as $key=>$value){
            if(in_array($key , $arr)){
                $res[$key] = $value;
            }
        }
        return $res;
    }
}