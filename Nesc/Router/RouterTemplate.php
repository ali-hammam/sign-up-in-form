<?php
namespace Nesc\Router;
require_once (ROOT.'/Nesc/Controller/Controller.php');
require_once (ROOT.'/Nesc/Router/Traits/Errors.php');
use Traits\Errors;

abstract class RouterTemplate{
    use Errors;
    protected $urlFound = 0;

    public abstract function runCallback($callback);
    public abstract function requestMethodChecker($uri , $callback , $methodType);

    public function get($uri , $callback){
        $this->requestMethodChecker($uri , $callback , 'get');
    }

    public function post($uri , $callback){
        $this->requestMethodChecker($uri , $callback , 'post');
    }

    public function view($uri , $path){
        $this->viewChecker($uri , $path);
    }

    public function isUrlFound(){
        $this->urlFound === 1 ? : $this->error(404);
    }

    public function __destruct(){
        $this->isUrlFound();
    }
}