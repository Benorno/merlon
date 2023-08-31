<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Orders;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {

        $searchQuery = $request->input('search_query');

        $query = Product::orderBy('id', 'asc');
        $products = Product::all();

        if ($searchQuery) {
            $query->where(function ($query) use ($searchQuery) {
                $query->where('product_code', 'like', '%' . $searchQuery . '%')
                ->orWhere('name', 'like', '%' . $searchQuery . '%');
            });
        }

        $products = $query->get();

        return view('admin.products.table', compact('products', 'searchQuery'));
    }

    public function productsTable()
    {
        $products = Product::all();

        return view('admin.products.table', compact('products'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all(); // Fetch all categories from the database
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'product_code' => 'nullable',
            'name' => 'nullable',
            'color' => 'nullable',
            'material' => 'nullable',
            'width' => 'nullable|numeric',
            'height' => 'nullable|numeric',
            'description' => 'nullable',
            'price' => 'nullable|numeric',
            'stock_quantity' => 'nullable|integer',
            'category_id' => 'nullable|exists:categories,id',
            'is_hidden' => 'boolean', // Add 'boolean' validation rule
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $product = Product::findOrFail($id); // Fetch the product by its ID

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('product_photos', 'public');
        } else {
            $photoPath = $product->photo; // Preserve the existing photo if not updated
        }

        // Update product details
        $product->update([
            'product_code' => $request->input('product_code'),
            'name' => $request->input('name'),
            'color' => $request->input('color'),
            'material' => $request->input('material'),
            'height' => $request->input('height'),
            'width' => $request->input('width'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'stock_quantity' => $request->input('stock_quantity'),
            'category_id' => $request->input('category_id'),
            'is_hidden' => $request->has('is_hidden') ? true : false,
            'photo' => $photoPath,
        ]);



        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }

    public function viewOrders(Request $request)
    {
        $searchQuery = $request->input('search_query');

        $query = Orders::orderBy('created_at', 'desc');

        if ($searchQuery) {
            $query->where(function ($query) use ($searchQuery) {
                $query->where('order_id', 'like', '%' . $searchQuery . '%')
                    ->orWhere('company_name', 'like', '%' . $searchQuery . '%')
                    ->orWhere('last_name', 'like', '%' . $searchQuery . '%');
            });
        }

        $orders = $query->get();
        $groupedOrders = $orders->groupBy('order_id');

        return view('admin.orders.table', compact('groupedOrders', 'orders', 'searchQuery'));
    }


    public function showOrderDetails($orderGroupId)
    {
        $orders = Orders::with('product')
            ->where('order_id', $orderGroupId)
            ->get();

        $totalOrderCost = $orders->sum(function ($order) {
            return $order->quantity * $order->product->price;
        });

        return view('admin.orders.order-details', compact('orderGroupId', 'orders', 'totalOrderCost'));
    }

}
