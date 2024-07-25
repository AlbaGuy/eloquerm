<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/src/config/Database.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php';
use Eloquerm\Model\User;

/**
* GetByid User.
*/

$user = User::getById(1);

echo '<b style="color:green">Get User By Id (Model)</b><br>'.str_repeat('-', 110)."<br>";

if($user->get('id')){
  echo 'ID:'.$user->get('id')."<br>
        Email: ".$user->get('email')."<br>
        Username: ".$user->get('username')."<br>
        Password: ".$user->get('password')."<br>
        First name: ".$user->get('first_name')."<br>
        Last name: ".$user->get('last_name')."<br>
        Created at: ".$user->get('created_at')."<br>
        Updated at: ".$user->get('updated_at')."<br>".str_repeat('-', 110)."<br>";
}
