<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'price', 'image'
    ];

    protected $table = 'product';

    public function users() {
        return $this->belongsTo('App\User', 'user_id');
    }
}
