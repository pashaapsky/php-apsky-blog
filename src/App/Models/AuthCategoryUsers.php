<?php
namespace Models;

use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\Builder;

class AuthCategoryUsers extends Model
{
    protected $table = 'auth-category_users';

    protected $primaryKey = ['category_id', 'user_id'];
    public $incrementing = false;

    protected $fillable = [
        'category_id',
        'user_id',
    ];

    public $timestamps = false;

    protected function setKeysForSaveQuery(Builder $query)
    {
        $keys = $this->getKeyName();
        if(!is_array($keys)){
            return parent::setKeysForSaveQuery($query);
        }

        foreach($keys as $keyName){
            $query->where($keyName, '=', $this->getKeyForSaveQuery($keyName));
        }

        return $query;
    }

    protected function getKeyForSaveQuery($keyName = null)
    {
        if(is_null($keyName)){
            $keyName = $this->getKeyName();
        }

        if (isset($this->original[$keyName])) {
            return $this->original[$keyName];
        }

        return $this->getAttribute($keyName);
    }
}