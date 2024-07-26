<?php
namespace Eloquerm\Model;
use PDO;
use Eloquerm\Model\InvoiceReceived;

class InvoiceReceivedFactory extends InvoiceFactory {
    public function createInvoice( $args = array()) {
        return new InvoiceReceived($args);
    }
}