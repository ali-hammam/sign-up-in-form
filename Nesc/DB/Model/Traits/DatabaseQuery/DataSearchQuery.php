<?php
namespace DB\Model\Traits\DatabaseQuery;

trait DataSearchQuery
{

    //where statement using IN or BETWEEN keywords or ordinary operators
    public function where($columnName , $operator , $value){
        $this->sql =  $this->sql . ' WHERE ' . $this->checkWhereKey($columnName , $operator , $value);
        return $this;
    }

    //AND keyword
    public function andWhere($columnName , $operator ,$value){
        $this->sql = $this->sql . ' AND ' . $this->checkWhereKey($columnName , $operator , $value);
        return $this;
    }

    //OR keyword
    public function orWhere($columnName , $operator , $value){
        $this->sql = $this->sql . ' OR ' . $this->checkWhereKey($columnName , $operator , $value);
        return $this;
    }

    //check if the keyword that came after where statement is IN or AND or ordinary operator like (=)
    private function checkWhereKey($columnName , $operator , $value){
        if(strtolower($operator) ==='in'){
            $values = implode(',' , $value);
            return  $columnName . ' IN (' . $values . ')';
        }else if(strtolower($operator) === 'between'){
            $values = implode(' AND ' , $value);
            return  $columnName . ' BETWEEN ' . $values;
        }else {
            return $columnName . ' ' . $operator . ' ' . $value;
        }
    }

    //groupBy keyword
    public function groupBy($columnName){
        $this->sql = $this->sql . ' GROUP BY ' .$columnName;
        return $this;
    }

    //sorting the table according to column
    public function orderBy($columnName , $sortType = 'ASC'){
        if(is_array($columnName)){
            $query = implode(',' , $columnName);
            //classFormat the user put his sortType for every column
            $this->sql = $this->sql . ' ORDER BY ' . $query;
        }else {
            $this->sql = $this->sql . ' ORDER BY ' . $columnName . ' ' . $sortType.' ';
        }
        return $this;
    }

    public function limit($num){
        $this->sql = $this->sql .' LIMIT '.$num;
        return $this;
    }
}