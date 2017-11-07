<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductLine;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::query();

        $categories = ProductLine::all()->pluck('productLine', 'productLine');

        if ($request->input('search')) {
            $products = $products->where('productName', 'like', '%' . $request->input('search') . '%');
        }

        if ($request->input('category', null)) {
            $products = $products->where('productLine', '=', $request->input('category'));
        }

        $products = $products->paginate(10);
        return view('products.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productLines = ProductLine::all()->pluck('productLine', 'productLine')->toArray();
        return view('products.create', compact('productLines'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product($request->all());
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public');
            $product->image_url = 'uploads/' . $path;
        }
        $product->save();

        // Redirect to show the newly created product
        return redirect()->action('ProductsController@show', [$product]);
    }

    /**
     * Display the specified resource.
     *
     * @param  Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Product $product)
    {
        $user = $request->user();
        // Grab 3 random products from same categry (just an idea)
        $relatedProducts = Product::where('productLine', $product->productLine)
                                    ->inRandomOrder()
                                    ->take(4)
                                    ->get();

        return view('products.show', compact('product', 'relatedProducts', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $productLines = ProductLine::all()->pluck('productLine', 'productLine')->toArray();
        return view('products.create', compact('product', 'productLines'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public');
            $product->image_url = 'uploads/' . $path;
        }
        $product->update($request->all());
        return redirect()->action('ProductsController@show', [$product]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->action('ProductsController@index');
    }

    public function addtocart(Request $request, Product $product)
    {
        if (!$request->session()->has('shopping_list')) {
            session([
              'shopping_list' => []
            ]);
        }
        $shoppingList = $request->session()->get('shopping_list');

        foreach ($shoppingList as $key => $p) {
          if ($p['product']->productCode == $product->productCode) {
            unset($shoppingList[$key]);
          }
        }

        array_push($shoppingList, [
          'product' => $product,
          'qty' => $request->input('qty', 1)
        ]);

        foreach ($shoppingList as $key => $p) {
          if ($p['qty'] == 0) {
            unset($shoppingList[$key]);
          }
        }

        $request->session()->put('shopping_list', $shoppingList);

        return redirect()->action('ShoppingCartController@index');
    }

    public function removefromcart(Request $request, Product $product)
    {
        $shoppingList = $request->session()->get('shopping_list', []);
        foreach ($shoppingList as $key => $p) {
          if ($p['product']->productCode == $product->productCode) {
            unset($shoppingList[$key]);
          }
        }

        session([
          'shopping_list' => $shoppingList
        ]);
        return redirect()->action('ShoppingCartController@index');
    }
}
