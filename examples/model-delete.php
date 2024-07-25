<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/src/config/Database.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php';
use Eloquerm\Model\User;

/**
* Delete an User
*/
User::getById(1)->delete();
//OR
(new User())->delete(1);
//OR
(new User(['id'=>1]))->delete();
//OR
(new User())->set('id',1)->delete();
echo '<b style="color:green"><span style="color:red">User</span> record deleted successfull!</b></br>';
