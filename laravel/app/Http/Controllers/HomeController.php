<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Mail;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $products = Product::inRandomOrder()->limit(6)->get();
        if (App::environment() == 'production') {
            $products = Product::where('productLine', 'Computer Parts')->inRandomOrder()->limit(6)->get();
        }
        return view('home', compact('products'));
    }

    public function contactUs()
    {
      return view('contactus');
    }

    public function handleContact(Request $request)
    {
      $input = $request->input();
      Mail::send('emails.message', compact('input'), function ($m) use ($input) {
          $m->from($input['email'], 'User');
          $m->to('lugnutzcp@gmail.com', 'Lugnutz Computer Parts')->subject('Contacted by a customer!');
      });
      \Session::flash('status', 'We have received your message.');
      return redirect()->action('HomeController@index');
    }
}
