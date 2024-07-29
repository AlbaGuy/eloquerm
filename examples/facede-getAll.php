<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/src/config/Database.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php';
use Eloquerm\Database\Facedes\DB;

/**
* GetAll PDF with a Facede interface. 
* @var Array
*/
$pdfs = DB::table('pdf')->getAll();

echo '<b style="color:green">Get All PDF (Facede)</b><br>'.str_repeat('-', 110)."<br>";
foreach ($pdfs as $key => $pdf) {
    foreach ($pdf->get('attributes') as $attribute => $value) {
        echo ucfirst($attribute).": ".$value."<br>";
    }
    echo str_repeat('-', 110)."<br>";
}
