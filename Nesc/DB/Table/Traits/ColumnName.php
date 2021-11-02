<?php


namespace DB\Table\Traits;


trait ColumnName
{
    /*
      to put the column name
    */
    public function SetColumnBase ($columnName)
    {
        $this->columnProperty = $this->columnProperty . $columnName;
        return $this;
    }
}