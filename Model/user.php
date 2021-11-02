<?php

namespace Model;

use Nesc\DB\Model\Model;

class user extends Model
{
    public $fillable = ['name', 'email', 'password'];

    protected $table = "users";
}
