<?php

namespace App\Http\Middleware;

use Closure;
use App\Order;
use Exception;

class OrderStatus
{
    protected $order;

    public function __construct(Order $order)
    {
      $this->order = $order;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->order->status == 'Shipped' || $this->order->status == 'Resolved' || $this->order->status == 'Cancelled') {
            return $next($request);
        }
        else {
            throw new Exception('Cannot edit order that has been resolved, shipped, or cancelled.');
        }
    }
}
