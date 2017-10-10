<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'orderdetails';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'quantityOrdered',
        'priceEach',
        'orderLineNumber',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    function product() {
      return $this->belongsTo('App\Product', 'productCode');
    }

    function order() {
      return $this->belongsTo('App\Order', 'orderNumber');
    }

}
