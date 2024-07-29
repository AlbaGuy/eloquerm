<?php
namespace Eloquerm\Model;

class PDF extends Model
{
    protected static $table = 'pdf';
    protected static $primaryKey = 'id';
    protected $fillable = ['id','name','created_at','updated_at'];
    protected $guarded = ['userIdFK'];
}
