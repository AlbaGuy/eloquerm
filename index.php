<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/src/config/Database.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php';
use Eloquerm\Database\DB;
use Eloquerm\Model\PDF;
use Eloquerm\Model\User;

//create user table
DB::select('CREATE TABLE IF NOT EXISTS users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(255) UNIQUE NOT NULL,
                email VARCHAR(255) UNIQUE NOT NULL,
                password VARCHAR(255) NOT NULL,
                first_name VARCHAR(255),
                last_name VARCHAR(255),
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )');

//create PDF table
DB::select('CREATE TABLE IF NOT EXISTS pdf (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )');


//create or update an user
$user = new User(['first_name' => 'Ermal',
				  'last_name' => 'Xhaka',
				  'username' => 'ermal', 
				  'email' => 'ermal1091@gmail.com', 
				  'password' => 'secret2']);
//ORM INSERT
//$user->insert();
//ORM UPDATE
//$user->set('id',1);
//$user->save();
//OR
//$user->update();

//create or update an user
$pdf = new PDF(['name' => 'firstPDF']);
//FACEDE INSERT
//DB::table('pdf')->insert(['name' => 'secondPDF']);
//ORM INSERT
//$pdf->insert();
//ORM UPDATE
//$pdf->set('id',1);
//$pdf->save();
//OR
//$pdf->update();



//ORM getAll
//$users = User::getAll();
//FACEDE getAll
//$pdf = DB::table('pdf')->getAll();
//ORM getById
//$user = User::getById(1);
//FACEDE getByID
//$pdf = DB::table('pdf')->getById(1);
//ORM DELETE
//$user->set('id',1);
//$user->delete();
//OR
//$user->delete(1);
//FACEDE DELETE CONDITION
//DB::table('pdf')->where('name', '=', 'firstPDF')->delete();
//FACEDE DELETE ALL
//DB::table('pdf')->delete();





$user = DB::table('users','User')->where('email', '=', 'ermal1091@gmail.com')->first();
if($user){
	echo 'User email = ermal1091@gmail.com:<br>
	ID:'.$user->get('id')."<br>
	username: ".$user->get('username')."<br>
	Created at: ".$user->get('created_at')."<br>----------------------------------------------------------<br>";
}
/*

$pdf = PDF::query()->where('created_at', '=', '2024-07-11 19:55:47')->first();
if($pdf){
	echo 'PDF:<br>
	ID:'.$pdf->get('id')."<br>
	Name: ".$pdf->get('name')."<br>
	Created at: ".$pdf->get('created_at')."<br>";
}

$selectResults = DB::select('SELECT * FROM users WHERE email = ?', ['ermal1091@gmail.com']);
//var_dump($selectResults);

// Ottenere un utente per ID
$user = PDF::getById(1);
print_r($user);

// Ottenere tutti gli utenti
$pdfs = PDF::getAll();
foreach ($pdfs as $key => $pdf) {
	echo 'PDF:<br>
	ID:'.$pdf->get('id')."<br>
	Name: ".$pdf->get('name')."<br>
	Created at: ".$pdf->get('created_at')."<br>";
}
*/