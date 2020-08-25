<?php
namespace Models;

use Illuminate\Database\Eloquent\Model as Model;

class Pages extends Model
{
    protected $table = 'pages';

    protected $guarded = [];

    public $timestamps = false;
}