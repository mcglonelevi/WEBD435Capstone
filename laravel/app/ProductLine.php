<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductLine extends Model
{
    protected $table = 'productlines';
    protected $primaryKey = 'productLine';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'textDescription',
        'htmlDescription',
        'image',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    function products() {
      return $this->hasMany('App\Product', 'productLine');
    }
}
