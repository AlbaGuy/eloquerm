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

use Eloquerm\Database\Query\Builder;
use Eloquerm\Database\Schema\Blueprint;

class Schema
{
    public static function create($table, $callback)
    {
        $blueprint = new Blueprint($table);
        $callback($blueprint);
        $sql = $blueprint->toSql();
        return self::builder($table)->query($sql);
    }

    public static function builder($table, $className = null)
    {
        $className = $className ?? ucfirst($table);
        $fullClassName = "Eloquerm\\Model\\$className";
        return (new Builder($fullClassName))->table($table);
    }
}
