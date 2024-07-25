<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/src/config/Database.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php';
use Eloquerm\Database\Facedes\DB;

/**
* Delete a PDF with a Facede interface. 
*/
DB::table('pdf')->delete(['id'=>1]);
//FACEDE DELETE CONDITION
DB::table('pdf')->where('name', '=', 'firstPDF')->delete();
//FACEDE DELETE ALL
DB::table('pdf')->delete();

echo '<b style="color:green"><span style="color:red">PDF</span> record deleted successfull!</b></br>';
