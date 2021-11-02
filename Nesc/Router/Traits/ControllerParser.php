<?php


namespace Traits;


trait ControllerParser{

    public function ControllerFile($value){
        return substr($value , 0 , strpos($value , '@'));
    }

    public function methodName($value){
        return substr($value ,  strpos($value , '@')+1 , strlen($value)-1);
    }

}