<?php

namespace App\Http\Controllers;

use App\Product;
use App\Cart;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('products.list', ['products' => Product::paginate(4)]);
    }

    public function show(Product $product)
    {
        return view('products.show', ['product' => $product, 'cart' => session('cart')]);
    }
}
