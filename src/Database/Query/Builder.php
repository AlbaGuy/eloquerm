<?php
namespace Eloquerm\Database\Query;

use Eloquerm\Database\DB;

interface BuilderInterface
{
    public function getAll();

    public function getById($id);
}

class Builder implements BuilderInterface
{
    protected $connection;
    protected $modelClass;
    protected $primaryKey;
    protected $table;
    protected $bindings = [];
    protected $where = [];

    public function __construct($modelClass,$primaryKey='id')
    {
        $this->connection = DB::getInstance();
        $this->modelClass = $modelClass;
        $this->primaryKey = $primaryKey;
    }

    public function table($table)
    {
        $this->table = $table;
        return $this;
    }

    public function primary($table)
    {
        $this->table = $table;
        return $this;
    }
    public function where($column, $operator, $value)
    {
        $this->where[] = [$column, $operator, $value];
        return $this;
    }

    public function getAll()
    {
        return $this->get();
    }

    public function getById($id)
    {
        return $this->where($this->primaryKey, '=', $id)->first();
    }

    public function get()
    {
        $sql = "SELECT * FROM {$this->table}" . $this->buildWhere();
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($this->getBindings());
        $results = $stmt->fetchAll($this->connection::FETCH_ASSOC);

        return array_map([$this->modelClass, 'toObject'], $results);
    }

    public function first()
    {
        $sql = "SELECT * FROM {$this->table}" . $this->buildWhere() . " LIMIT 1";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($this->getBindings());
        $result = $stmt->fetch($this->connection::FETCH_ASSOC);

        if ($result) {
            return call_user_func([$this->modelClass, 'toObject'], $result);
        }

        return null;
    }

    public function insert($data)
    {
        $columns = implode(',', array_keys($data));
        $placeholders = implode(',', array_fill(0, count($data), '?'));
        $sql = "INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(array_values($data));
        return $this->connection->lastInsertId();
    }

    public function update($data, $conditions)
    {
        $set = implode(' = ?, ', array_keys($data)) . ' = ?';
        $sql = "UPDATE {$this->table} SET {$set}" . $this->buildWhere($conditions);
        
        $stmt = $this->connection->prepare($sql);
        $params = array_merge(array_values($data), $this->getBindings($conditions));
        $stmt->execute($params);
        return $stmt->rowCount();
    }


    public function delete($conditions=[])
    {
        $sql = "DELETE FROM {$this->table}" . $this->buildWhere($conditions);
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($this->getBindings($conditions));
        return $stmt->rowCount();
    }

    protected function buildWhere($additionalConditions = [])
    {
        $where = '';
        $allConditions = [];

        // add conditions
        if (!empty($this->where)) {
            foreach ($this->where as $condition) {
                $allConditions[] = $condition;
            }
        }

        if (!empty($additionalConditions)) {
            foreach ($additionalConditions as $column => $value) {
                $allConditions[] = [$column, '=', $value];
            }
        }

        if (!empty($allConditions)) {
            $clauses = [];
            foreach ($allConditions as $condition) {
                $clauses[] = "{$condition[0]} {$condition[1]} ?";
            }
            $where = ' WHERE ' . implode(' AND ', $clauses);
        }

        return $where;
    }


    protected function getBindings($additionalConditions = [])
    {
        $bindings = [];
        $allConditions = [];

        if (!empty($this->where)) {
            foreach ($this->where as $condition) {
                $allConditions[] = $condition;
            }
        }

        if (!empty($additionalConditions)) {
            foreach ($additionalConditions as $column => $value) {
                $allConditions[] = [$column, '=', $value];
            }
        }

        foreach ($allConditions as $condition) {
            $bindings[] = $condition[2];
        }

        return $bindings;
    }

    public function query($sql, $bindings = [])
    {
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($bindings);
        return $stmt;
    }

}
