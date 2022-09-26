<?php 

namespace Core\Facades;

class Query{

    public static function __callStatic($name, $arguments){
        $query = new \Core\Database\Database; 
        return call_user_func_array([$query, $name], $arguments);
    }
}