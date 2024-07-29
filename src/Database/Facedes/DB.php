<?php
/**
 * This file is part of the Eloquerm.
 *
 * (©) Ermal Xhaka <ermal1091@gmail.com>
 *
 * This source file is subject to the AGPL-3.0 license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Eloquerm\Database\Facedes;

use PDO;
use PDOStatement;
use PDOException;
use Exception;
use Eloquerm\Database\Query\Builder;

class DB extends PDO
{
    private static $instance = null;

    private function __construct($dsn, $username, $password, $options)
    {
        parent::__construct($dsn, $username, $password, $options);
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->setAttribute(PDO::ATTR_STATEMENT_CLASS, [DBPDOStatement::class, []]);
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self(DB_DSN, DB_USERNAME, DB_PASSWORD, DB_OPTIONS);
        }
        return self::$instance;
    }

     public static function table($table, $className = null)
    {
        $className = $className ?? ucfirst($table);
        $fullClassName = "Eloquerm\\Model\\$className";
        if (!class_exists($fullClassName)) {
            throw new Exception("Classe $fullClassName non trovata.");
        }
        return (new Builder($fullClassName))->table($table);
    }

    public static function select($query, $bindings = [])
    {   
        $connection = DB::getInstance();
        $stmt = $connection->prepare($query);
        $stmt->execute($bindings);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}

class DBPDOStatement extends PDOStatement
{
    protected function __construct() {}

    public function execute(?array $params = null): bool
    {
        try {
            return parent::execute($params);
        } catch (PDOException $e) {
            die('<b style="color:red">Errore durante l\'esecuzione della query:</b> ' . $e->getMessage());
        }
    }
}

