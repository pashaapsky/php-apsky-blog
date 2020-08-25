<?php
namespace Models;

use Illuminate\Database\Eloquent\Model as Model;

class Subscribe extends Model
{
    protected $table = 'subscribes';

    protected $guarded = [];

    public $timestamps = false;
}
