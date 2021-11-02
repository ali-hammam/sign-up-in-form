<?php
namespace DB\Model\Traits;

trait GeneralHelpers
{
    //get original columns name
    public function getAllColumnsWithoutEdit($tableName){
        $arr = $this->show($tableName)
                    ->runSelect()
                    ->get();
        return array_map(function ($value) use ($tableName){
            return $value['Field'];
        } , array_values($arr));
    }

    //get all columns without alias like persons_firstName
    public function getAllColumns($tableName){
        $arr = $this->show($tableName)
                    ->runSelect()
                    ->get();

        return array_map(function ($value) use ($tableName){
            return $tableName.'_'.$value['Field']; //$this->joinsTableFormat($tableName , $value['Field']);
        } , array_values($arr));
    }

    //show all column names from a table
    public function getAllColumnsNameAsAlias($tableName){
        $arr = $this->show($tableName)
                    ->runSelect()
                    ->get();

        return array_map(function ($value) use ($tableName){
            return $this->joinsTableFormat($tableName , $value['Field']).' as '. $tableName . '_' .$value['Field'].' ';
        } , array_values($arr));
    }

    //merge all columns from two tables in joins
    public function mergeMultipleTableColumns(...$tableNames){
        $table = [];
        foreach($tableNames as $tableName){
            $table = array_merge($table , $this->getAllColumnsNameAsAlias($tableName));
        }
        return $table;
    }

    //put default foreign key convention $tableId
    public function putDefaultForeignKey($foreignKey = null){
        if($foreignKey === null){
            $foreignKey = $this->table.'Id';
        }
        return $foreignKey;
    }

    //get the pivot table Name ex table1_table2
    public function pivotTableName($className , $modelName){
        return strtolower($className). '_' . strtolower($modelName);
    }

    //get the tableName from migrations dir
    public function migrationTableName(){
        return strtolower($this->getClass()).'s';
    }

}