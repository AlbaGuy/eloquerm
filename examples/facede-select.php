<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/src/config/Database.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php';
use Eloquerm\Database\Facedes\DB;

/**
* Custom select query with a Facede interface.
*  @var Array
*/
$users = DB::select('SELECT * FROM users WHERE email = ?', ['ermal1091@gmail.com']);
foreach ($users as $key => $user) {
  echo 'ID:'.$user['id']."<br>
        Email: ".$user['email']."<br>
        Username: ".$user['username']."<br>
        Password: ".$user['password']."<br>
        First name: ".$user['first_name']."<br>
        Last name: ".$user['last_name']."<br>
        Created at: ".$user['created_at']."<br>
        Updated at: ".$user['updated_at']."<br>".str_repeat('-', 110)."<br>";
}