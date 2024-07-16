<?php
namespace Eloquerm\Database\Schema;

class Blueprint
{
    protected $table;
    protected $columns = [];
    protected $primaryKey;

    public function __construct($table)
    {
        $this->table = $table;
    }

    public function id()
    {
        $this->primaryKey = 'id INT AUTO_INCREMENT PRIMARY KEY';
        return $this;
    }

    public function integer($column, $length = 11)
    {
        $this->columns[] = "$column INTEGER($length)";
        return $this;
    }

    public function string($column, $length = 255)
    {
        $this->columns[] = "$column VARCHAR($length)";
        return $this;
    }

    public function timestamps()
    {
        $this->columns[] = "created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP";
        $this->columns[] = "updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP";
        return $this;
    }

    public function toSql()
    {
        $columnsSql = implode(", ", $this->columns);
        if ($this->primaryKey) {
            $columnsSql = $this->primaryKey . ', ' . $columnsSql;
        }
        return "CREATE TABLE IF NOT EXISTS {$this->table} ($columnsSql)";
    }
}

