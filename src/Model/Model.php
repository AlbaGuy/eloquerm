<?php
namespace Eloquerm\Model;

use Eloquerm\Database\Query\Builder;
use PDOException;

abstract class Model
{
    protected static $table;
    protected static $primaryKey = 'id';
    protected $attributes = [];

    public function __construct($attributes = [])
    {
        $this->attributes = $attributes;
    }

    public function get($name)
    {
        return $this->attributes[$name] ?? null;
    }

    public function set($name, $value)
    {
        $this->attributes[$name] = $value;
    }

    public static function getAll()
    {
        return (new Builder(static::class,static::$primaryKey))->table(static::$table)->getAll();
    }

    public static function getById($id)
    {
        return (new Builder(static::class,static::$primaryKey))->table(static::$table)->getById($id);
    }

    public function save()
    {
        if (isset($this->attributes[static::$primaryKey])) {
            return $this->update();
        } else {
            return $this->insert();
        }
      
    }

    public function insert()
    {
        $query = (new Builder(static::class,static::$primaryKey))->table(static::$table);
        $this->attributes[static::$primaryKey] = $query->insert($this->attributes);
        return $this->attributes[static::$primaryKey];
    }

    public function update()
    {
        $query = (new Builder(static::class,static::$primaryKey))->table(static::$table);
        return $query->update($this->attributes, [static::$primaryKey => $this->attributes[static::$primaryKey]]);
    }

    public function delete($id=NULL)
    {   
        $id = $id!= null?$id:$this->attributes[static::$primaryKey];
        $query = (new Builder(static::class,static::$primaryKey))->table(static::$table);
        return $query->delete([static::$primaryKey => $id]);
    }

    public static function query()
    {
        return (new Builder(static::class,static::$primaryKey))->table(static::$table);
    }

    public static function toObject(array $data)
    {
        return new static($data);
    }
}
