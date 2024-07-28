<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/src/config/Database.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php';
use Eloquerm\Model\InvoiceReceivedFactory;

/**
* INSERT InvoiceReceived Abstract Factory Class that have metadata attributes,
*/

$invoiceReceivedFactory = new InvoiceReceivedFactory();
$invoice = $invoiceReceivedFactory->createInvoice(['merchant' =>1,
                                                   'numberInvoice' => time(),
                                                   'invoiceDate' => date('Y-m-d'),
                                                   'invoiceAmount' => 200,
                                                   'invoiceDescription' => 'TEST INVOICE RECEIVED',
                                                   'serie' => "fds",
                                                   'urlInvoice' => 'https://immobiliarecesenanord.com',
                                                   'invoiceType' => 1
                                                  ]);
$id = $invoice->save();

echo '<b style="color:green"><span style="color:red">'.$invoice->getType().'</span> with id <b>'.$id.'</b> created successfull!</b></br>';


