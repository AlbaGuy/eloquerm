<?php
namespace Eloquerm\Model;
use PDO;

abstract class InvoiceFactory {
    abstract public function createInvoice( $args = array());
}