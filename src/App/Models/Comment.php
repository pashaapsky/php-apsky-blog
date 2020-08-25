<?php
namespace Models;

use Illuminate\Database\Eloquent\Model as Model;

class Comment extends Model
{
    protected $table = 'comment';

    protected $guarded = [];

    public $timestamps = false;
}