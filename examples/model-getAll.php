<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/src/config/Database.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php';
use Eloquerm\Model\User;

/**
* GetAll Users.
* @var Array
*/
$users = User::getAll();
echo '<b style="color:green">Get All USERS (Model)</b><br>'.str_repeat('-', 110)."<br>";
foreach ($users as $key => $user) {
    foreach ($user->get('attributes') as $attribute => $value) {
        echo ucfirst($attribute).": ".$value."<br>";
    }
    echo str_repeat('-', 110)."<br>";
}
