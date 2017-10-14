<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $primaryKey = 'orderNumber';
    protected $table = 'orders';
    public $timestamps = false;

    public static $STATUS_SHIPPED = 'Shipped';
    public static $STATUS_RESOLVED = 'Resolved';
    public static $STATUS_CANCELLED = 'Cancelled';
    public static $STATUS_ONHOLD = 'On Hold';
    public static $STATUS_DISPUTED = 'Disputed';
    public static $STATUS_INPROCESS = 'In Process';

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

    public function getStatuses()
    {
      return [
        self::$STATUS_SHIPPED => self::$STATUS_SHIPPED,
        self::$STATUS_RESOLVED => self::$STATUS_RESOLVED,
        self::$STATUS_ONHOLD => self::$STATUS_ONHOLD,
        self::$STATUS_DISPUTED => self::$STATUS_DISPUTED,
        self::$STATUS_INPROCESS => self::$STATUS_INPROCESS,
        self::$STATUS_CANCELLED => self::$STATUS_CANCELLED
      ];
    }
}
