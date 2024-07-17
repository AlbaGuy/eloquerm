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

    public function integer($column=NULL, $length = 11)
    {
        if(isset($column))
            $this->columns[] = "$column INTEGER($length)";
        return $this;
    }

    public function string($column=NULL, $length = 255)
    {
        if(isset($column))
            $this->columns[] = "$column VARCHAR($length)";
        return $this;
    }

    public function unique() {
        if (!empty($this->columns)) {
            $lastIndex = count($this->columns) - 1;
            $this->columns[$lastIndex] .= " UNIQUE";
        }
        return $this;
    }

    public function index($indexes) {
        if(!empty($indexes) && is_array($indexes)){
            foreach ($indexes as $key => $index) {
                $this->columns[] = "INDEX ($index)";
            }
        }
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

