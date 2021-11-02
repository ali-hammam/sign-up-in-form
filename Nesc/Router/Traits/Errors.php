<?php
namespace Traits;

Trait Errors{

    public function error($status){
        if($status === 404){
            $this->errorFormat($status , 'Not Found');
        }elseif ($status === 403){
            $this->errorFormat($status ,'Forbidden');
        }elseif ($status === 401){
            $this->errorFormat($status ,'Unauthorized');
        }elseif ($status === 400){
            $this->errorFormat($status ,'Bad Request');
        }elseif ($status === 408){
            $this->errorFormat($status ,'Request Timeout');
        }elseif ($status === 501){
            $this->errorFormat($status ,'Not Implemented');
        }elseif ($status === 502){
            $this->errorFormat($status ,'Bad Gateway');
        }elseif ($status === 503){
            $this->errorFormat($status ,'Service Unavailable');
        }
    }

    private function errorFormat($status , $message){
        echo '<p style="text-align: center; margin-top: 350px; font-size: larger">'.$status.'<br>'.$message.'</p>';
    }
}