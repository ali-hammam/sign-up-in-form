<?php
namespace DB\Model\Traits\DatabaseQuery;

trait JoinsType{

    /*
     do the left join query between two tables which takes all the left table columns
     and check if they have a value on the right table or not
    */
    public function leftJoin($relatedModel , $primaryKey , $foreignKey){
        $this->sql = $this->sql.' LEFT JOIN '.$relatedModel.' ON '.$primaryKey .' = '.$foreignKey;
        return $this;
    }

    //do the right join query between two tables
    public function rightJoin($relatedModel , $primaryKey , $foreignKey){
        $this->sql = $this->sql.' RIGHT JOIN '.$relatedModel.' ON '.$primaryKey .' = '.$foreignKey;
        return $this;
    }

    //do the inner join query between two tables which takes only the columns that has value between two tables
    public function innerJoin($relatedModel , $primaryKey , $foreignKey){
        $this->sql = $this->sql.' INNER JOIN '.$relatedModel.' ON '.$primaryKey .' = '.$foreignKey;
        return $this;
    }

    //do the self join query in the same table
    public function selfJoin($relatedModel , $primaryKey , $foreignKey){
        $this->sql = $this->sql.' SELF JOIN '.$relatedModel.' ON '.$primaryKey .' = '.$foreignKey;
        return $this;
    }

    //do the full outer join query between two tables
    public function fullOuterJoin($relatedModel , $primaryKey , $foreignKey){
        $this->sql = $this->sql.' FULL OUTER JOIN '.$relatedModel.' ON '.$primaryKey .' = '.$foreignKey;
        return $this;
    }

    //put it in format TableName.ColumnName
    public function joinsTableFormat($tableName , $columnName){
        return $tableName.'.'.$columnName;
    }

}