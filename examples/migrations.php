<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/src/config/Database.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php';
use Eloquerm\Database\Facedes\Schema;
use Eloquerm\Database\Schema\Blueprint;

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

echo '<b style="color:green">Table <span style="color:red">users</span> created successfull!</b></br>';

/**
* Migration a pdf table
*/
Schema::create('pdf', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->integer('userIdFK',19);
    $table->timestamps();
    $table->index(['name','userIdFK']);
});

echo '<b style="color:green">Table <span style="color:red">pdf</span> created successfull!</b></br>';
