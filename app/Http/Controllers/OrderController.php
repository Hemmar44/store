<?php

namespace App\Http\Controllers;

use App\Bought;
use App\Order;
use App\Storehouse;
use Couchbase\Exception;
use Illuminate\Http\Request;
use App\Product;
use Illuminate\Database\Eloquent\Collection;

class OrderController extends Controller
{
    public function make(Request $request)
    {
        try {
            $customer = $request->customer;
            $cart = $request->session()->get('cart');
            $products = Product::whereIn('id', array_keys($cart))->get();
            $order = new Order();

            $order->name = $customer['first_name'];
            $order->surname = $customer['surname'];
            $order->street = $customer['street'];
            $order->city = $customer['city'];
            $order->postal_code = $customer['postal_code'];
            $order->phone = $customer['phone'];
            $order->email = $customer['email'];
            $order->nip = $customer['nip'];
            $order->price_sum_net = $this->getSum('price_net', $cart, $products);
            $order->price_sum_gross = $this->getSum('price_gross', $cart, $products);

            $order->save();
            foreach ($products as $product) {
                $bought = new Bought();
                $bought->order_id = $order->id;
                $bought->product_id = $product['id'];
                $bought->quantity = $cart[$product['id']];
                $bought->save();
            }

            $stock = Storehouse::whereIn('product_id', array_keys($cart))->get();
            foreach ($stock as $storehouse) {
                $storehouse->quantity = $storehouse->quantity - $cart[$storehouse->product_id];
                $storehouse->save();
            }
            return response(['message' => 'Ok']);
        } catch (\Exception $exception) {
            return response(['error' => 'Something went wrong'], 400);
        }
    }

    private function getSum($type, array $cart, Collection $products): float
    {
        $sum = 0;
        foreach ($products as $product) {
            $sum += $cart[$product['id']] * $product[$type];
        }
        return (float) $sum;
    }
}
