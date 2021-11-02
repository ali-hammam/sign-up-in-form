<?php
namespace DB\Table\Traits;
trait TableDataTypes
{
    public function String($maxCharLen = 100){
        $this->columnProperty = $this->columnProperty.' VARCHAR('.$maxCharLen.')';
        return $this;
    }

    public function SmallNumber(){
        $this->columnProperty = $this->columnProperty.' TINYINT';
        return $this;
    }

    public function Number(){
        $this->columnProperty = $this->columnProperty.' INT';
        return $this;
    }

    public function BigNumber(){
        $this->columnProperty = $this->columnProperty.' BIGINT';
        return $this;
    }

    public function Boolean(){
        $this->columnProperty = $this->columnProperty.' BOOLEAN ';
        return $this;
    }

    public function Double($size = 25 , $d = 2){
        $this->columnProperty = $this->columnProperty.' DOUBLE('.$size.', '.$d.')';
        return $this;
    }

    public function Float(){
        $this->columnProperty = $this->columnProperty.' FLOAT ';
        return $this;
    }

    public function Json(){
        $this->columnProperty = $this->columnProperty.' JSON ';
        return $this;
    }

}