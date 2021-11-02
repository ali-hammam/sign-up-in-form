<?php
namespace Controller;
require_once __DIR__.'/Traits/Helpers.php';
use Helpers;

class Controller {
    use Helpers;

    public function run($controllerFile , $methodName){
        $this->loadControllerFile($controllerFile);
        $this->callControllerMethod($controllerFile , $methodName);
    }

}