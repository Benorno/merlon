<?php

namespace App\Http\Controllers;

use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function add(Request $request, $productId)
    {
        $cart = session()->get('cart', []);

        $selectedQuantity = $request->input('quantity'); // Get the selected quantity

        if (array_key_exists($productId, $cart)) {
            $cart[$productId] += $selectedQuantity; // Update the quantity
        } else {
            $cart[$productId] = $selectedQuantity;
        }

        session()->put('cart', $cart);

        // Update the cart item count in the session
        session()->put('cartItemCount', array_sum($cart));

        return back()->with('success', 'Product added to cart.');
    }

    public function updateQuantity(Request $request, $productId)
    {
        $cart = session()->get('cart', []);
        $newQuantity = (int)$request->input('quantity'); // Get the new quantity

        if (array_key_exists($productId, $cart)) {
            $cart[$productId] = $newQuantity; // Update the quantity
            session()->put('cart', $cart);

            // Update the cart item count in the session
            session()->put('cartItemCount', array_sum($cart));
        }

        return back()->with('success', 'Quantity updated.');
    }

    public function remove(Request $request, $productId)
    {
        $cart = session()->get('cart', []);

        if (array_key_exists($productId, $cart)) {
            unset($cart[$productId]); // Remove the item from the cart
            session()->put('cart', $cart);

            // Update the cart item count in the session
            session()->put('cartItemCount', array_sum($cart));
        }

        return back()->with('success', 'Product removed from cart.');
    }





}
