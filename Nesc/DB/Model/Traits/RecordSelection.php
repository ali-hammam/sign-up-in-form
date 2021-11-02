<?php
namespace DB\Model\Traits;

trait RecordSelection
{
    //find a record with id
    public function find($id ,$from = null){
        if($from === null){
            $from = strtolower($this->getClass()).'s';
        }

        $this->select(['*'] , $from)
            ->where('id', '=', $id)
            ->runSelect();
        
        return $this;
    }

    //find record by column
    public function findByColumn($columnName , $value , $columns = ['*'] , $from = null){
        if($from === null){
            $from = strtolower($this->getClass()).'s';
        }

        $this->select($columns , $from)
            ->where($columnName, '=', $value)
            ->runSelect();

        return $this;
    }
}