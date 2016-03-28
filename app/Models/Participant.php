<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected static $_table;

    public function setTable($table)
    {
        static::$_table = $table;
    }

    public function getTable()
    {
        return static::$_table;
    }
}
