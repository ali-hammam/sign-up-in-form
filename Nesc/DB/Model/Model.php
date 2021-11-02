<?php
namespace Nesc\DB\Model;
require_once ('ModelTemplate.php');

class Model extends ModelTemplate
{

    protected $table = '';

    //return the array came from oneToManyJson()
    public function with($relatedModel , $foreignKey = null , $primaryKey = 'id'){
        $foreignKey = $this->putDefaultForeignKey($foreignKey);
        $this->queryResult= $this->join($relatedModel, $foreignKey, $primaryKey)->runSelect()->get();
        $this->queryResult =$this->oneToManyJson($relatedModel , $this->queryResult);
        $this->queryResult = array_values($this->queryResult);
        return $this->get();
    }

    //create a left join to a specific related model
    public function join($relatedModel , $foreignKey = null , $primaryKey = 'id'){
        $foreignKey = $this->putDefaultForeignKey($foreignKey);
        $columns = $this->mergeMultipleTableColumns($this->table , $relatedModel);
        $this->sql = $this->sql . $this->select($columns)
                ->LeftJoin($relatedModel , $this->joinsTableFormat($this->table,$primaryKey) , $this->joinsTableFormat($relatedModel,$foreignKey))
                ->orderBy($this->table.'_id')
                ->getQuery();

        return $this;
    }

    //create oneToOne relation
    public function hasOne($relatedModel , $foreignKey = null , $primaryKey = 'id'){
        $foreignKey = $this->putDefaultForeignKey($foreignKey);
        $temp = $this->queryResult;
        $columns = $this->getAllColumnsWithoutEdit($relatedModel);
        unset($columns[array_search($foreignKey , $columns)]);
        $obj = $this->findByColumn($foreignKey , $temp[0]['id'] , $columns , $relatedModel)
                    ->limit(1)
                    ->get();

        if(empty($obj)){
            return $temp[0];
        }

        $obj = $obj[0];
        $temp[0][$relatedModel] = $obj;
        return $temp[0];
    }

    //create oneToMany relation
    public function hasMany($relatedModel , $foreignKey = null , $primaryKey = 'id'){
        $foreignKey = $this->putDefaultForeignKey($foreignKey);
        $temp = $this->queryResult;
        $columns = $this->getAllColumnsWithoutEdit($relatedModel);
        unset($columns[array_search($foreignKey , $columns)]);
        $obj = $this->findByColumn($foreignKey , $temp[0]['id'] , $columns , $relatedModel)
                    ->get();

        if(empty($obj)){
            return $temp[0];
        }
        $temp[0][$relatedModel] = $obj;
        return $temp[0];
    }

    //reversed oneToOne or oneToMany relation
    public function belongsTo($primaryModel , $foreignKey = null , $primaryKey = 'id'){
        $foreignKey = $primaryModel.'Id';
        $temp = $this->queryResult;
        $columns = $this->getAllColumnsWithoutEdit($primaryModel);
        $obj = $this->findByColumn($primaryKey , $temp[0][$foreignKey] , $columns , $primaryModel)
                    ->limit(1) -> get();

        if(empty($obj)){
            return $temp;
        }
        $obj = $obj[0];
        $temp[0][$primaryModel] = $obj;
        unset($temp[0][$foreignKey]);
        return $temp[0];
    }

    //selected model dealing with pivot table in many to many
    public function hasManyThrough($relatedModel , $foreignKey = null , $primaryKey = 'id'){
        $tableName = $this->migrationTableName();
        $pivot = $this->pivotTableName($tableName , $relatedModel);
        if($foreignKey === null){
            $foreignKey = substr($pivot , 0 , strpos($pivot , '_')).'Id';
        }
        return $this->getRelatedRecordsFromId($relatedModel , $foreignKey , $pivot , $primaryKey);
    }

    //related model dealing with pivot table in many to many
    public function belongsToMany($primaryModel , $foreignKey = null , $primaryKey = 'id'){
        $tableName = $this->migrationTableName();
        $pivot = $this->pivotTableName($primaryModel , $tableName);
        if($foreignKey === null){
            $foreignKey = $tableName.'Id';
        }

        return $this->getRelatedRecordsFromId($primaryModel , $foreignKey , $pivot , $primaryKey);
    }
    
}