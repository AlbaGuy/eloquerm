<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/src/config/Database.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php';
use Eloquerm\Model\User;

/**
* Insert an User,
* alternative can use insert() method. 
*/
$user = (new User(['first_name' => 'Ermal',
                  'last_name' => 'Xhaka',
                  'username' => 'ermal', 
                  'email' => 'ermal1091@gmail.com', 
                  'password' => 'secret']))->save();

echo '<b style="color:green"><span style="color:red">User</span> record created successfull!</b></br>';
