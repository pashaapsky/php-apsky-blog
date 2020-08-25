<?php
namespace Models;

use Illuminate\Database\Eloquent\Model as Model;

class AuthCategory extends Model
{
    protected $table = 'auth-category';

    protected $fillable = [
        'name',
    ];

    public $timestamps = false;
}