<?php
namespace DB\Model\Traits\DatabaseQuery;
trait DataManipulationQuery
{

    protected $table;

    //select data from table
    public function select($selectedColumns , $from = null){
        if($from === null){
            $from = $this->table;
        }
        $columns = implode(',', $selectedColumns);
        $this->sql = 'SELECT '.$columns.' FROM '.$from;
        return $this;
    }

    //insert into table
    /* public function insert($columns){
        if(sizeof($columns) === 0){
            return 'empty array';
        }

        $this->sql = "INSERT INTO ".$this->table." (".implode(',',array_keys($columns)).")".
                " VALUES (".implode(',' , $columns).")";
        return $this;
    } */

    public function insert($keys , $values){
        error_reporting(0);
        $this->sql = "INSERT INTO ".$this->table." (".implode(',',$keys).")".
                " VALUES (".implode(',' , $values).")";
        return $this;
    }

    //update the table
    public function update($columns){
        if(sizeof($columns) === 0){
            return 'empty array';
        }

        $dataAttributes = array_map(function ($value, $key) {
            return $key . '="' . $value . '"';
        }, array_values($columns), array_keys($columns));

        $data = implode(',', $dataAttributes);

        if(empty($this->arr)) {
            $this->sql = 'UPDATE ' . $this->table . ' SET ' . $data;
        }else{
            $id = $this->arr[0]['id'];
            $this->sql = 'UPDATE ' . $this->table . ' SET ' . $data;
            return $this->where('id' , '=' , $id);
        }
        return $this;
    }

    //delete from the table with specific id
    public function delete($id = null){
        if(!empty($this->arr)){
            $id = $this->arr[0]['id'];
        }
        $this->sql = 'DELETE FROM '.$this->table;
        return $this -> where('id' , '=' , $id);
    }

    public function massDelete($id , $primaryKey = 'id'){
        $this->sql = 'DELETE FROM '.$this->table .' WHERE '. $primaryKey . ' IN('.implode(',',$id).')';
        return $this;
        
    }

}