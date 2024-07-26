<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/src/config/Database.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php';
use Eloquerm\Model\Invoice;

/**
* INSERT Invoice Class that have metadata attributes,
*/

$id = (new Invoice(['merchantId' =>1,
                    'number' => time(),
                    'date' => date('Y-m-d'),
                    'serie' => 'fs', 
                    'amount' => 300,
                    'description' => 'TEST INVOICE'
                    ]))->setTable('invoice_received')->setPrimaryKey('invoiceId')->save();

echo '<b style="color:green"><span style="color:red">Invoice</span> with id <b>'.$id.'</b> created successfull!</b></br>';