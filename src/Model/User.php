<?php
namespace Eloquerm\Model;

class User extends Model
{
    protected static $table = 'users';
    protected static $primaryKey = 'id';
    protected $guarded = ['password'];
}
