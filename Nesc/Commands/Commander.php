<?php
namespace Commands;
require_once ('classFormat/Maker.php');
require_once ('Migrations/Migrate.php');
require_once ('Migrations/Drop.php');
require_once('Command.php');
use Commands\classFormat\Maker;
use Commands\Migrations\Drop;
use Commands\Migrations\Migrate;
session_start();

class Commander
{
    private $commander;
    private static $instance = null;

    private function __construct(){$this->commander = [];}

    public static function instantiate(){
        if(!isset($_SESSION['commander'])) {
            if (self::$instance === null) {
                self::$instance = new Commander();
            }
            $_SESSION['commander'] = self::$instance;
        }else{
            echo '0';
        }
        return $_SESSION['commander'];
    }

    public function setCommand(Command $command){
        $this->commander[sizeof($this->commander) + 1] = $command;
    }

    public function execute($directoryType , $args = null){
        $this->commandMapper($directoryType);
        $directoryType == 'rollback' ? :$this->commander[sizeof($this->commander)]->execute($directoryType , $args);
    }

    public function commandMapper($command){
        ! strpos($command , '-') ? $commandType = $command : $commandType = explode('-', $command)[0];

        if(strtolower($commandType) === 'make'){
            $this->setCommand(new Maker());
        }else if(strtolower($commandType) === 'migrate'){
            $this->setCommand(new Migrate());
        }else if(strtolower($commandType) === 'drop'){
            $this->setCommand(new Drop());
        }else if(strtolower($commandType) === 'rollback'){
            $this->rollback();
        }
    }

    public function rollback(){
        if(!empty($this->commander)){
            $temp = $this->commander[sizeof($this->commander)];
            unset($this->commander[sizeof($this->commander)]);
            $temp->rollback();
        }
    }

}