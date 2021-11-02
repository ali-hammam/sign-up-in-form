<?php
namespace DB\Table\Traits;
trait TableConstraint
{
    public function primaryKey(){
        $this->columnProperty = $this->columnProperty.' UNSIGNED AUTO_INCREMENT PRIMARY KEY';
        return $this;
    }

    public function NotNUll(){
        $this->columnProperty = $this->columnProperty.' NOT NULL';
        return $this;
    }

    public function unique(){
        $this->columnProperty = $this->columnProperty.' UNIQUE';
        return $this;
    }

    public function foreignKey($columnName , $targetTable = null , $targetId = 'id'){
        if($targetTable === null) {
            $targetTable = substr($columnName, 0, strpos($columnName, 'Id'));
        }
        $this->columnProperty = 'FOREIGN KEY ('.$columnName.') REFERENCES '.$targetTable.'('.$targetId.')';
        return $this;
    }

    public function unsigned(){
        $this->columnProperty = $this->columnProperty.' UNSIGNED';
        return $this;
    }
}