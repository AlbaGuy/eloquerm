<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/src/config/Database.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php';
use Eloquerm\Database\Facedes\DB;

/**
 * Get first USER result with  with where condition with a Facede interface. 
 * If table name is not same as model Class name, pass Class name as the second parameter 
 * @var Object
 */

$user = DB::table('users','User')->where('email', '=', 'ermal1091@gmail.com')->first();

echo '<b style="color:green">First User where email = "ermal1091@gmail.com" (Facede)</b><br>'.str_repeat('-', 110)."<br>";

if($user->get('id')){	
	echo "ID:".$user->get('id')."<br>
          Email: ".$user->get('email')."<br>
          Username: ".$user->get('username')."<br>
          Password: ".$user->get('password')."<br>
          First name: ".$user->get('first_name')."<br>
          Last name: ".$user->get('last_name')."<br>
          Created at: ".$user->get('created_at')."<br>
          Updated at: ".$user->get('updated_at')."<br>".str_repeat('-', 110)."<br>";
}