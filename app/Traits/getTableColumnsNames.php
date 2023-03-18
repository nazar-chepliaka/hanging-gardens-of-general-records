<?php

namespace App\Traits;

use DB;

trait getTableColumnsNames
{
    public static function getTableColumnsNames()
    {
        $table_name = (new static)->getTable();        
        $table_desc = DB::select('DESCRIBE '.$table_name);

        return array_map(function($value){
            return $value->Field;
        }, $table_desc);
    }
}
