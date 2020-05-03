<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $productId = $request->product_id;
        try {
            auth()->guest()
                ? $this->proceedWithGuest($request, $productId)
                : $this->proceedWithUser($productId);
        } catch (\Exception $exception) {
            return response(['error' => 'Something went wrong'], 400);
        }

        return response(['message' => 'Ok']);
    }

    public function show(Request $request)
    {
        $cart = session('cart');

        return view('cart.show', ['products' => $this->prepareProducts($cart)]);
    }

    public function remove(Product $product)
    {
        try {
        $cart = request()->session()->get('cart');

        unset($cart[$product['id']]);

        request()->session()->put('cart', $cart);
        request()->session()->save();

        return response(['products' => $this->prepareProducts($cart)]);

        $this->prepareProducts($cart);
        } catch (\Exception $exception) {
            return response(['error' => 'Something went wrong'], 400);
        }
    }

    private function proceedWithGuest(Request $request, $productId)
    {
        $cart = $request->session()->get('cart', function () {return [];});

        $quantity = $cart[$productId] ?? 0;
        $quantity += 1;
        $cart[$productId] = $quantity;

        $request->session()->put('cart', $cart);

        $request->session()->save();
    }

    private function proceedWithUser($productId)
    {

    }

    private function getPriceSum(Product $product, array $cart)
    {
        return $cart[$product['id']] * $product['price_gross'];
    }

    private function prepareProducts($cart)
    {
        $products = Product::whereIn('id', array_keys($cart))->get();

        $viewProducts = [];

        foreach ($products as $key => $product) {
            $viewProducts[$key]['id'] = $product['id'];
            $viewProducts[$key]['name'] = $product['name'];
            $viewProducts[$key]['quantity'] = $cart[$product['id']];
            $viewProducts[$key]['price'] = $this->getPriceSum($product, $cart);
        }

        return $viewProducts;
    }
}
