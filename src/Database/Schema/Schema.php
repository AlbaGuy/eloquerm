<?php
namespace Eloquerm\Database\Schema;
use Eloquerm\Database\Query\Builder;
use Eloquerm\Database\DB;

class Schema
{
    public static function create($table, $callback)
    {
        $blueprint = new Blueprint($table);
        $callback($blueprint);
        $sql = $blueprint->toSql();
        self::builder($table)->query($sql);
    }

    public static function builder($table, $className = null)
    {
        $className = $className ?? ucfirst($table);
        $fullClassName = "Eloquerm\\Model\\$className";
        return (new Builder($fullClassName))->table($table);
    }
}
