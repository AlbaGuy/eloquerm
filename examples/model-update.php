<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/src/config/Database.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php';
use Eloquerm\Model\User;

/**
* Update an User,
* alternative can use update() method.
*/

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

echo '<b style="color:green"><span style="color:red">User</span> record updated successfull!</b></br>';
