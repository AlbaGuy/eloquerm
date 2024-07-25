<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/src/config/Database.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php';
use Eloquerm\Model\PDF;

/**
* Get first PDF result with  with where condition. 
* @var Object
*/

$pdf = PDF::query()->where('name', '=', 'firstPDF')->first();
if($pdf->get('id')){
  echo '<b style="color:green">First PDF where name = "firstPDF" (Model)</b><br>'.str_repeat('-', 110)."<br>";
  echo 'ID:'.$pdf->get('id')."<br>
       Name: ".$pdf->get('name')."<br>
       Created at: ".$pdf->get('created_at')."<br>
       Updated at: ".$pdf->get('updated_at')."<br>".str_repeat('-', 110)."<br>";
}
