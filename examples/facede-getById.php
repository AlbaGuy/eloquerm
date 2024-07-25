<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/src/config/Database.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php';
use Eloquerm\Database\Facedes\DB;

/**
* GetById USER with a Facede interface.
* @var Object
*/

$pdf = DB::table('pdf')->getById(1);

echo '<b style="color:green">GetById PDF (Facede)</b><br>'.str_repeat('-', 110)."<br>";

if($pdf->get('id')){
    echo 'ID:'.$pdf->get('id')."<br>
		  Name: ".$pdf->get('name')."<br>
		  Created at: ".$pdf->get('created_at')."<br>
		  Updated at: ".$pdf->get('updated_at')."<br>".str_repeat('-', 110)."<br>";
}