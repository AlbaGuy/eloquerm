<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/src/config/Database.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php';
use Eloquerm\Database\Facedes\DB;

/**
 * Get all PDF result with  with where condition with a Facede interface. 
 * @var Array
 */

$pdfs = DB::table('pdf')->where('name', '=', 'firstPDF')->get();

echo '<b style="color:green">Get All PDF where name = "firstPDF" (Facede)</b><br>'.str_repeat('-', 110)."<br>";

foreach ($pdfs as $key => $pdf) {
    echo 'ID:'.$pdf->get('id')."<br>
          Name: ".$pdf->get('name')."<br>
          Created at: ".$pdf->get('created_at')."<br>
          Updated at: ".$pdf->get('updated_at')."<br>".str_repeat('-', 110)."<br>";
}