<?php


namespace Commands\Migrations;
require_once __DIR__ . "/../Command.php";
use Commands\Command;

class Drop implements Command
{

    public $type; // make-drop
    public $mmcType; //model migration controller
    public $selectedName;

    //make model
    public function execute($type = null, $fileName = null){
        $command = explode('-' , $type);
        $this->setType($command[0]);
        $this->setMMC($command[1]);
        $this->setName($fileName);

        if($command[1] == 'model'){
            $this->drop('Model' , $fileName);
        }else if($command[1] == 'migration'){
            $this->drop('migrations' , $fileName);
        }else if($command[1] == 'controller'){
            $this->drop('Controller' , $fileName);
        }
    }

    public function drop($type , $fileName){
        $dir = $type == 'migrations' ? ROOT."/Database/".$type : ROOT."/".$type;
        $a = scandir($dir);
        $found = 0;
        if(isset($a)) {
            array_splice($a, 0, 2);
            for ($i = 0; $i < sizeof($a); $i++) {
                $currentFileName = substr($a[$i], 0, strpos($a[$i], '.'));
                if($currentFileName === $fileName){
                    $path = $this->detectDir($type , $a[$i]);
                    $type !=='Controller' ? $classPath = $path . $fileName : $classPath = $fileName;
                    $migrationObj = new $classPath();
                    $type !== 'migrations' ? :$migrationObj->run('drop');
                    unlink($type == 'migrations' ? ROOT.'Database\\'.$type.'\\'.$a[$i] : ROOT.'\\'.$type.'\\'.$a[$i]);
                    $found = 1;
                }
            }
        }
        if($found === 0){
            echo $fileName.' Not Existed';
        }
    }

    public function detectDir($dir , $file){
        if($dir === 'migrations'){
            require_once ROOT. '/Database/'. $dir . '/' .$file;
            $path = '\Database\\'.$dir.'\\';
        }else{
            require_once  ROOT. '/'. $dir . '/' .$file;
            $path = '\\'.$dir.'\\';
        }
        return $path;
    }

    public function setType($type){
        $this->type = $type;
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

    public function getType(){
        return $this->type;
    }

    public function getMMCType(){
        return $this->mmcType;
    }
}