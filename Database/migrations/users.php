<?php

namespace Database\migrations;

use DB\Table\Facades\ColumnPropertyFacade;
use DB\Table\Facades\Table;
use DB\Table\Migrations\migration;

include_once 'config.php';
require_once(ROOT . '/nesc/DB/Table/Migrations/migration.php');
require_once(ROOT . '/nesc/DB/Table/Facades/ColumnPropertyFacade.php');
require_once(ROOT . '/nesc/DB/Table/Facades/Table.php');

class users extends migration
{
    public function up()
    {
        Table::create($this->className, function () {
            $id = ColumnPropertyFacade::SetColumnBase('id')
                ->Number()
                ->primaryKey()
                ->getColumnProperty();

            $name = ColumnPropertyFacade::SetColumnBase('name')
                ->String(100)
                ->NotNUll()
                ->getColumnProperty();

            $email = ColumnPropertyFacade::SetColumnBase('email')
                ->String(100)
                ->NotNUll()
                ->unique()
                ->getColumnProperty();

            $password = ColumnPropertyFacade::SetColumnBase('password')
                ->String(100)
                ->NotNUll()
                ->getColumnProperty();

            return [$id, $name, $email, $password];
        });
    }

    public function down()
    {
        Table::drop($this->className);
    }
}
