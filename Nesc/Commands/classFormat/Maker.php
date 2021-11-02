<?php
namespace Commands\classFormat;
error_reporting(E_ALL ^ E_WARNING);
require_once ('makeCommands.php');
include 'config.php';
require_once (ROOT.'/Nesc/Commands/Migrations/Drop.php');
require_once __DIR__."/../Command.php";

use Commands\Migrations\Drop;
use makeCommands;

class Maker implements \Commands\Command
{
    use makeCommands;
    public $mmcType; //model migration controller
    public $selectedName;

    public function execute($type =null , $fileName = null){
        $command = explode('-' , $type);
        $this->setMMC($command[1]);
        $this->setName($fileName);

        if($command[0] == 'make'){
            if($command[1] == 'model'){
                $this->makeModel($fileName);
            }else if($command[1] == 'migration'){
                $this->makeMigration($fileName);
            }else if($command[1] == 'controller'){
                $this->makeController($fileName);
            }else if($command[1] == 'migrate'){
                $this->makeMigrate($fileName);
            }
        }
    }

    public function rollback(){
        $drop = new Drop();
        echo 'das';
        $drop->execute('drop-'.$this->getMMCType() , $this->getSelectedName());
    }

    public function setMMC($mmcType){
        $this->mmcType = $mmcType;
    }

    public function setName($selectedName){
        $this->selectedName = $selectedName;
    }

    public function getSelectedName(){
        return $this->selectedName;
    }

    public function getMMCType(){
        return $this->mmcType;
    }
}