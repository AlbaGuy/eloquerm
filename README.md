
<p align="center"><a href="https://github.com/AlbaGuy/eloquerm" target="_blank">
    <img src="https://raw.githubusercontent.com/AlbaGuy/eloquerm/main/src/Assets/Images/eloquerm.png" alt="Eloquerm Logo" width="312" height="100">
</a></p>

<div style="text-align:center"><b>PHP ORM(Object Relational mapping)</b><br> Access to DB stored data with Model or Facade.</div>

## Installation

To install Eloquerm, you can clone the repository from GitHub and install dependencies using Composer: 
```BASH
git clone https://github.com/AlbaGuy/eloquerm
cd eloquerm
composer install
```
## Examples
On the **examples** folder you will find several examples, in the default index.php page can you access to it.

>***MIGRATIONS***
> 1) [Schema Builder](#migrations)
> 
> ***MODEL***
> 1) [INSERT](#model_INSERT)
> 2) [UPDATE](#model_UPDATE)
> 3) [DELETE](#model_DELETE)
> 4) [GET_ALL](#model_GET_ALL)
> 5) [GET_BY_ID](#model_GET_BY_ID)
> 6) [FIRST](#model_FIRST)
> 
> ***FACEDE***
> 1) [INSERT](#facede_INSERT)
> 2) [UPDATE](#facede_UPDATE)
> 3) [DELETE](#facede_DELETE)
> 4) [GET_ALL](#facede_GET_ALL)
> 5) [GET_BY_ID](#facede_GET_BY_ID)
> 6) [FIRST](#facede_FIRST)
> 7) [SELECT](#facede_SELECT)
> 8) [GET](#facede_GET)
> 
> ***ATTRIBUTE***
> 1) [PRINT metadata Attribute Class](#attribute-printMetadata)
> 2) [INSERT Invoice with metadata Attribute](#attribute-invoiceMetadataInsert)
> 3) [INSERT Abstract factory Invoice Received with metadata Attribute](#attribute-invoiceReceivedMetadataInsert)

## **Migrations**
**Using The Schema Builder**
```PHP
/**
* Migration a users table
*/
Schema::create('users', function (Blueprint $table) {
    $table->id();
    $table->string('username')->unique();
    $table->string('email')->unique();
    $table->string('password');
    $table->string('first_name');
    $table->string('last_name');
    $table->timestamps();
});
```
## **Using Model**
<a id="model_FIRST"></a>
**first()**
```PHP
$user = User::where('email', '=', 'ermal1091@gmail.com')->first();
```
<a id="model_GET_BY_ID"></a>
**getById()**
```PHP
$user = User::getById(1);
```
<a id="model_GET_ALL"></a>
**getAll()**
```PHP
$users = User::getAll();
```
<a id="model_INSERT"></a>
**insert()**
```PHP
$user = (new User(['first_name' => 'Ermal',
                  'last_name' => 'Xhaka',
                  'username' => 'ermal', 
                  'email' => 'ermal1091@gmail.com', 
                  'password' => 'secret']))->save();
```
<a id="model_UPDATE"></a>
**update()**
```PHP
$user = (new User(['first_name' => 'Ermal',
                   'last_name' => 'Xhaka',
                   'username' => 'ermal', 
                   'email' => 'ermal1091@gmail.com', 
                   'password' => 'secret2']))->set('id',1)->save();
//OR
$user = (new User(['id'=>1,
                   'first_name' => 'Ermal',
                   'last_name' => 'Xhaka',
                   'username' => 'ermal', 
                   'email' => 'ermal1091@gmail.com', 
                   'password' => 'secret3']))->save();
```
<a id="model_DELETE"></a>
**delete()**
```PHP
User::getById(1)->delete();
//OR
(new User())->delete(1);
//OR
(new User(['id'=>1]))->delete();
//OR
(new User())->set('id',1)->delete();
```

## **Using Facede (Interface)**
<a id="facede_FIRST"></a>
**first()**
```PHP
/**
 * Get first USER result with  with where condition with a Facede interface. 
 * If table name is not same as model Class name, pass Class name as the second parameter 
 * @var Object
 */
$user = DB::table('users','User')->where('email', '=', 'ermal1091@gmail.com')->first();
```
<a id="facede_GET_BY_ID"></a>
**getById()**
```PHP
$pdf = DB::table('pdf')->getById(1);
```
<a id="facede_GET_ALL"></a>
**getAll()**
```PHP
$pdfs = DB::table('pdf')->getAll();
```
<a id="facede_GET"></a>
**get()**
```PHP
/**
 * Get all PDF result with  with where condition with a Facede interface. 
 * @var Array
 */

$pdfs = DB::table('pdf')->where('name', '=', 'firstPDF')->get();
```
<a id="facede_SELECT"></a>
**select()**
```PHP
/**
* Custom select query with a Facede interface.
*  @var Array
*/
$users = DB::select('SELECT * FROM users WHERE email = ?', ['ermal1091@gmail.com']);
```
<a id="facede_INSERT"></a>
**insert()**
```PHP
DB::table('pdf')->insert(['name' => 'firstPDF']);
```
<a id="facede_UPDATE"></a>
**update()**
```PHP
DB::table('pdf')->update(['name' => 'updatedFirstPDF'],['id'=>1]);
```
<a id="facede_DELETE"></a>
**delete()**
```PHP
/**
* Delete a PDF with a Facede interface. 
*/
DB::table('pdf')->delete(['id'=>1]);
//FACEDE DELETE CONDITION
DB::table('pdf')->where('name', '=', 'firstPDF')->delete();
//FACEDE DELETE ALL
DB::table('pdf')->delete();
```





## Usage Instructions
If table name is not same as model Class name, pass Class name as the second parameter.
```PHP
DB::table('users','User')
```
The fillable property specifies which attributes should be mass-assignable.
```PHP
protected $fillable = ['id','name','created_at','updated_at'];
```
The inverse of fillable is guarded, and serves as a "black-list" instead of a "white-list".
```PHP
protected $guarded = ['password'];
```
## Attribute
Attributes are small meta-data elements added for PHP classes, functions, closures, class properties, class methods, constants, and even on anonymous classes.
PHP DocBlock comments are probably the most familiar example.

If your project manager had the brilliant idea of ​​naming the db columns with very long names and have declared attributes in you PHP Class that not are same as column.

I have the solution:

 You can specify it with Attribute "name" metadata as in the example:
```PHP
#[Metadata(name: 'number', type: 'int', description: 'Invoice number, lenght(11)')]
    protected $numberInvoice = 999;
```
<a id="attribute-printMetadata"></a>

**PRINT metadata Attribute Class**
```PHP
Invoice::printPropertyMetadata();
```

<a id="attribute-invoiceMetadataInsert"></a>
**INSERT Invoice with metadata Attribute**
```PHP
$id = (new Invoice(['merchantId' =>1,
                   'number' => time(),
                   'date' => date('Y-m-d'),
                   'serie' => 'fs', 
                   'amount' => 300,
                   'description' => 'TEST INVOICE'
                    ]))->setTable('invoice_received')->setPrimaryKey('invoiceId')->save();
```

<a id="attribute-invoiceReceivedMetadataInsert"></a>
**INSERT Abstract factory Invoice Received with metadata Attribute**
```PHP
$id = $invoiceReceivedFactory->createInvoice(['merchant' =>1,
                                              'numberInvoice' => time(),
                                              'invoiceDate' => date('Y-m-d'),
                                              'invoiceAmount' => 200,
                                              'invoiceDescription' => 'TEST INVOICE RECEIVED',
                                              'serie' => "fds",
                                              'urlInvoice' => 'https://immobiliarecesenanord.com',
                                              'invoiceType' => 1
                                              ]);->save();
```

# Contributing to Eloquerm

## Thank You for Your Interest!

We sincerely appreciate your interest in contributing to Eloquerm. Whether you're fixing bugs, suggesting new features, or improving the documentation, your contributions are highly valued and essential to the success of this project.

## How to Contribute

1. **Fork the Repository**

   Start by forking the repository to your own GitHub account. This will create a copy of the project that you can freely modify.

2. **Clone Your Fork**

   Clone your forked repository to your local machine to begin making changes:

   ```bash
   git clone https://github.com/AlbaGuy/eloquerm
   ```
## Issues and Feedback
If you encounter any issues or have suggestions for improvements, please open an [issue](https://github.com/AlbaGuy/eloquerm/issues) on GitHub. We welcome feedback and are always looking for ways to improve the project.

Thank you again for contributing to Eloquerm! Your efforts make a significant difference.

Happy coding!

Ermal Xhaka

ermal1091@gmail.com
## License

This project is licensed under the terms of the GNU Affero General Public License v3.0 (AGPL-3.0).

For non-commercial use, you may use the software under the terms of the AGPL-3.0. For commercial use, please contact ermal1091@gmail.com to obtain a commercial license.

### Commercial License

For commercial use of this software, you must obtain a commercial license. Please contact ermal1091@gmail.com to inquire about commercial licensing terms.

