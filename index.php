<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/src/config/Database.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php';
use Eloquerm\Database\Facedes\DB;
use Eloquerm\Model\FatturaRicevutaFactory;

echo '<h4>Examples:</h4>';
echo '<h4>MIGRATIONS</h4>';
echo '1) <a href="examples/migrations.php">Schema Builder</a></br>';
echo '<h4>MODEL</h4>';
echo '1) <a href="examples/model-insert.php">INSERT</a></br>';
echo '2) <a href="examples/model-update.php">UPDATE</a></br>';
echo '3) <a href="examples/model-delete.php">DELETE</a></br>';
echo '4) <a href="examples/model-getAll.php">GET_ALL</a></br>';
echo '5) <a href="examples/model-getById.php">GET_BY_ID</a></br>';
echo '6) <a href="examples/model-first.php">FIRST</a></br>';
echo '<h4>FACEDE</h4>';
echo '1) <a href="examples/facede-insert.php">INSERT</a></br>';
echo '2) <a href="examples/facede-update.php">UPDATE</a></br>';
echo '3) <a href="examples/facede-delete.php">DELETE</a></br>';
echo '4) <a href="examples/facede-getAll.php">GET_ALL</a></br>';
echo '5) <a href="examples/facede-getById.php">GET_BY_ID</a></br>';
echo '6) <a href="examples/facede-first.php">FIRST</a></br>';
echo '7) <a href="examples/facede-select.php">SELECT</a></br>';
echo '8) <a href="examples/facede-get.php">GET</a></br>';
