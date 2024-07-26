<?php
namespace Eloquerm\Model;
use PDO;
use Eloquerm\Model\Invoice;


class InvoiceReceived extends Invoice
{
    protected static $table = 'invoice_received';
    protected static $primaryKey = 'idInvoiceReceived';
    #[Metadata(name: 'type', type: 'string', description: ' type of the document lenght(11)')]
    protected $invoiceType;
    #[Metadata(name: 'url', type: 'string', description: 'Url of the document')]
    protected $urlInvoice;
    protected $iva;

    public static function getType() {
        return "InvoiceReceived";
    }
}
