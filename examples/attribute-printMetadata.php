<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/src/config/Database.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php';
use Eloquerm\Model\Invoice;

/**
* Print all metadata info of the Invoice Class,
*/
Invoice::printPropertyMetadata();

