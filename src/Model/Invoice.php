<?php
namespace Eloquerm\Model;
use PDO;

class Invoice extends Model 
{
    #[Metadata(name: 'merchantId', type: 'int', description: 'Merchant ID')]
    protected $merchant;
    #[Metadata(name: 'number', type: 'int', description: 'Invoice number, lenght(11)')]
    protected $numberInvoice = 999;
    #[Metadata(name: 'amount', type: 'string', description: 'Invoice number')]
    protected $invoiceAmount = 600;
    #[Metadata(name: 'date', type: 'string', description: 'Invoice date')]
    protected $invoiceDate;
    #[Metadata(name: 'description', type: 'string', description: 'Invoice description, lenght(400)')]
    protected $invoiceDescription;
}
