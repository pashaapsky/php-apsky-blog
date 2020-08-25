<?php
namespace Models;

use Illuminate\Database\Eloquent\Model as Model;

class User extends Model
{
    protected $table = 'user';

    protected $guarded = [];

    public $timestamps = false;

    public static function show(){
        return static::all();
    }
}
