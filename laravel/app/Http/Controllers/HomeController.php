<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Order;
use App\OrderDetail;
use App\Payment;
use App\Product;
use App\ProductLine;

class HomeController extends Controller
{
    public function index () {
      $query = Order::user(363)
        ->get()
        ->pluck('status', 'orderNumber');
      dd($query);

      // This code will not run
      return view('welcome');
    }
}
