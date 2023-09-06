<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Orders;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function index()
    {
        $groupedProducts = Subcategory::with('products')
            ->latest()
            ->get()
            ->groupBy('title');

        return view('products.index', compact('groupedProducts'));
    }


    public function show($id)
    {
        $product = Product::find($id);

        $product->increment('views');

        $mostViewedProducts = Product::where('id', '!=', $id) // Exclude the current product
            ->where('is_hidden', false)
            ->where(function ($query) {
                $query->whereNull('subcategory_id') // Include products with no subcategory
                    ->orWhereHas('subcategory', function ($query) {
                        $query->where('is_hidden', false); // Include products with non-hidden subcategories
                    });
            })
            ->orderBy('views', 'desc')
            ->take(4) // Take one fewer product since you're excluding the current product
            ->get();

        if (!$product || $product->is_hidden || ($product->category && $product->category->is_hidden)) {
            return view('no-product');
        }

        return view('products.product', compact('product', 'mostViewedProducts'));
    }

    public function updateViews(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->increment('views'); // Increment the view count by 1
        return redirect()->route('product.show', ['id' => $product->id]);
    }

    public function create()
    {
        $subcategories = Subcategory::all();
        $product = Product::all();
        return view('admin.product', compact('subcategories', 'product'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_code' => 'required',
            'name' => 'required',
            'material' => 'nullable',
            'top_width' => 'nullable|numeric',
            'bottom_width' => 'nullable|numeric',
            'height' => 'nullable|numeric',
            'quantity_carton' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'origin' => 'nullable',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
            'subcategory_id' => 'required|exists:subcategories,id',
            'stockable' => 'boolean',
            'nucleated' => 'boolean',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Handle file upload if a new photo is provided
        if ($request->hasFile('photo')) {
            $originalFileName = $request->file('photo')->getClientOriginalName();
            $photoPath = $request->file('photo')->storeAs('product_photos', $originalFileName, 'public');
        } else {
            $photoPath = null;
        }


        // Create and store the product in the database
        Product::create([
            'product_code' => $request->input('product_code'),
            'name' => $request->input('name'),
            'color' => $request->input('color'),
            'material' => $request->input('material'),
            'height' => $request->input('height'),
            'top_width' => $request->input('top_width'),
            'bottom_width' => $request->input('bottom_width'),
            'weight' => $request->input('weight'),
            'origin' => $request->input('origin'),
            'quantity_carton' => $request->input('quantity_carton'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'stock_quantity' => $request->input('stock_quantity'),
            'subcategory_id' => $request->input('subcategory_id'),
            'stockable' => $request->input('stockable'),
            'nucleated' => $request->input('nucleated'),
            'photo' => $photoPath,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product added successfully!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Find and delete related orders
        Orders::where('product_id', $product->id)->delete();

        // Delete the product from the database
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
    }



    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $subcategories = Subcategory::all();
        return view('admin.products.edit', compact('product', 'subcategories'));
    }

    public function update($id, Request $request)
    {
        // dd($request->all());
        $product = Product::findOrFail($id);

        $request->validate([
            'product_code' => 'required',
            'name' => 'required',
            'material' => 'nullable',
            'top_width' => 'nullable|numeric',
            'bottom_width' => 'nullable|numeric',
            'height' => 'nullable|numeric',
            'quantity_carton' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'origin' => 'nullable',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
            'subcategory_id' => 'required|exists:subcategories,id',
            'is_hidden' => 'boolean',
            'stockable' => 'boolean',
            'nucleated' => 'boolean',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            // Delete old photo if it exists
            if ($product->photo) {
                Storage::disk('public')->delete($product->photo);
            }
            $originalFileName = $request->file('photo')->getClientOriginalName();
            $photoPath = $request->file('photo')->storeAs('product_photos', $originalFileName, 'public');
        } else {
            $photoPath = $product->photo;
        }


        // Update the product in the database
        $product->update([
            'product_code' => $request->input('product_code'),
            'name' => $request->input('name'),
            'color' => $request->input('color'),
            'material' => $request->input('material'),
            'height' => $request->input('height'),
            'top_width' => $request->input('top_width'),
            'bottom_width' => $request->input('bottom_width'),
            'weight' => $request->input('weight'),
            'origin' => $request->input('origin'),
            'quantity_carton' => $request->input('quantity_carton'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'stock_quantity' => $request->input('stock_quantity'),
            'subcategory_id' => $request->input('subcategory_id'),
            'is_hidden' => $request->input('is_hidden'),
            'stockable' => $request->input('stockable'),
            'nucleated' => $request->input('nucleated'),
            'photo' => $photoPath,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }


}
