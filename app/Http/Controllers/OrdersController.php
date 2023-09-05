<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class OrdersController extends Controller
{
    public function index($id)
    {
        $product = Product::find($id);
        return view('orders.index', compact('orders', 'product', 'productId'));
    }

    public function create()
    {
        // You can retrieve necessary data (e.g., products) for the order creation form
        return view('orders.create');
    }

    public function store(Request $request)
    {
        // Validate and store order data similar to the requestQuote method
    }

    public function show($id)
    {

        $product = Product::find($id);
        $productId = $product->id; // Get the product's id

        dd($product, $productId);

        return view('orders.index', compact('product', 'productId'));
    }

    public function updateStatus(Request $request, $orderId)
    {
        // Validate the incoming request data
        $request->validate([
            'status' => 'required|in:unfulfilled,estimate sent,fulfilled,voided',
        ]);

        // Retrieve the order record based on $orderId
        $orders = Orders::where('order_id', $orderId)->get();

        // Update the status field with the new status value
        $status = $request->input('status');
        foreach ($orders as $order) {
            $order->status = $status;
            $order->save();
        }
        // dd($order);
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Status updated successfully');
    }



    public function edit($id)
    {
        $order = Orders::findOrFail($id);
        // You can retrieve necessary data (e.g., products) for the order edit form
        return view('orders.edit', compact('order'));
    }

    public function update(Request $request, $id)
    {
        // Validate and update order data similar to the store method
    }

    public function destroy($id)
    {
        $order = Orders::findOrFail($id);
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Order deleted successfully!');
    }


    public function requestQuote(Request $request, $productId)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'company_name' => 'nullable',
            'address' => 'required',
            'vat' => 'nullable',
            'zip' => 'required',
            'phone' => 'required',
            'client_email' => 'required|email',
            'comment' => 'nullable',
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $guestId = $request->session()->getId(); // Get the session ID

        // Create a new order record with the associated guest ID
        Orders::create([
            'product_id' => $productId,
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'company_name' => $request->input('company_name'),
            'address' => $request->input('address'),
            'vat' => $request->input('vat'),
            'zip' => $request->input('zip'),
            'phone' => $request->input('phone'),
            'client_email' => $request->input('client_email'),
            'comment' => $request->input('comment'),
            'quantity' => $request->input('quantity'),
            'guest_id' => $guestId,
        ]);

        return back()->with('success', 'Quote requested successfully!');
    }

    public function placeOrder(Request $request)
    {
        // Retrieve cart items from the session
        $cartItems = session()->get('cart', []);
        $guestId = $request->session()->getId();

        // Find the last order number
        $lastOrder = Orders::latest('created_at')->first();
        $orderNumber = $lastOrder ? intval(substr($lastOrder->order_id, 2)) + 1 : 1;

        // Generate the order ID with "ML" prefix and order number
        $orderId = 'ML' . str_pad($orderNumber, 4, '0', STR_PAD_LEFT);

        // Iterate over the cart items
        foreach ($cartItems as $productId => $quantity) {
            // Find the product based on the product ID
            $product = Product::find($productId);

            if ($product) {
                // Create an order record for each product in the cart
                Orders::create([
                    'order_id' => $orderId, // Use the generated order ID
                    'product_id' => $productId,
                    'first_name' => $request->input('first_name'),
                    'last_name' => $request->input('last_name'),
                    'company_name' => $request->input('company_name'),
                    'address' => $request->input('address'),
                    'vat' => $request->input('vat'),
                    'zip' => $request->input('zip'),
                    'phone' => $request->input('phone'),
                    'client_email' => $request->input('client_email'),
                    'comment' => $request->input('comment'),
                    'quantity' => $quantity,
                    'guest_id' => $guestId,
                ]);

                // Update the product's stock_quantity (if needed)
                // $product->decrement('stock_quantity', $quantity);
            }
        }

        // Clear the cart after processing
        session()->forget('cart');
        session()->forget('cartItemCount');
        // Regenerate the session ID
        Session::regenerate();

        return redirect()->route('thank-you')->with('success', 'Order placed successfully!');
    }



}
