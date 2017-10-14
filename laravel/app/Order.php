<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $primaryKey = 'orderNumber';
    protected $table = 'orders';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'orderDate',
        'requiredDate',
        'shippedDate',
        'status',
        'comments',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    function customer() {
      return $this->belongsTo('App\Customer', 'customerNumber');
    }

    function orderDetails() {
      return $this->hasMany('App\OrderDetail', 'orderNumber');
    }

    function getTotal() {
      return $this->orderDetails->reduce(function ($carry, $item) {
          return $carry + ($item->priceEach * $item->quantityOrdered);
      }, 0);
    }

    public function scopeUser($query, $customerId)
    {
        return $query->where('customerNumber', $customerId);
    }
}
