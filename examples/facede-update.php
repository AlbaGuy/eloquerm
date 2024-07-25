<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/src/config/Database.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php';
use Eloquerm\Database\Facedes\DB;

/**
* Update a PDF with a Facede interface, 
*/
DB::table('pdf')->update(['name' => 'updatedFirstPDF'],['id'=>1]);

echo '<b style="color:green"><span style="color:red">PDF</span> record updated successfull!</b></br>';
