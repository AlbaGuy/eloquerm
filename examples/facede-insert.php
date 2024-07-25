<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/src/config/Database.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php';
use Eloquerm\Database\Facedes\DB;

/**
* Insert a PDF with a Facede interface,
* alternative can use insert() method. 
*/
DB::table('pdf')->insert(['name' => 'firstPDF']);

echo '<b style="color:green"><span style="color:red">PDF</span> record created successfull!</b></br>';
