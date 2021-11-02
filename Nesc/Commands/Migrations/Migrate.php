<?php

namespace Commands\Migrations;
error_reporting(E_ERROR | E_PARSE);
require_once __DIR__ . "/../Command.php";
include_once 'config.php';
use Commands\Command;

class migrate implements Command
{
    public $mmcType; //model migration controller

    public function execute($type = null, $fileName = null)
    {
        $this->setMMC('migrate');
        $dir = ROOT."/Database/migrations";
        $a = scandir($dir);
        if(isset($a)) {
            array_splice($a, 0, 2);
            for ($i = 0; $i < sizeof($a); $i++) {
                require_once ROOT. '/Database/migrations/' . $a[$i];
                $migrationName = substr($a[$i], 0, strpos($a[$i], '.'));
                $path = '\Database\migrations\\';
                $classPath = $path . $migrationName;
                $migrationObj = new $classPath();
                $migrationObj->run('create');   
            }
        }
    }

    public function setMMC($mmcType){
        $this->mmcType = $mmcType;
    }

    public function getMMCType(){
        return $this->mmcType;
    }
}