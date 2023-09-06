<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubcategoryController extends Controller
{

    public function index()
    {
        $subcategories = Subcategory::all();
        return view('subcategories.index', compact('subcategories'));
    }

    public function show(Subcategory $subcategory)
    {
        $products = $subcategory->products;
        return view('subcategories.show', compact('subcategory', 'products'));
    }

    public function table(Request $request)
    {
        $searchQuery = $request->input('search_query');

        $query = Subcategory::orderBy('id', 'asc');
        $categories = Category::all(); // Change variable name to $categories

        if ($searchQuery) {
            $query->where(function ($query) use ($searchQuery) {
                $query->where('title', 'like', '%' . $searchQuery . '%');
            });
        }

        $subcategories = $query->get();

        return view('admin.subcategories.table', compact('subcategories', 'categories', 'searchQuery')); // Change variable name to 'categories'
    }



    public function create()
    {
        $categories = Category::all();
        $subcategory = Subcategory::all();
        return view('admin.subcategoryCreate', compact('subcategory', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'subcategory_photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        $subcategoryPhotoPath = null;

        if ($request->hasFile('subcategory_photo')) {
            $originalFileName = $request->file('subcategory_photo')->getClientOriginalName();
            $subcategoryPhotoPath = $request->file('subcategory_photo')->storeAs('subcategory_photo', $originalFileName, 'public');
        }

        // Create and store the category in the database
        Subcategory::create([
            'title' => $request->input('title'),
            'subcategory_photo' => $subcategoryPhotoPath,
            'category_id' => $request->input('category_id'),
        ]);

        return redirect()->route('admin.subcategories.index')->with('success', 'Category created successfully!');
    }


    public function edit($id)
    {
        $categories = Category::all();
        $subcategory = Subcategory::findOrFail($id);
        return view('admin.subcategories.edit', compact('subcategory', 'categories'));
    }

    public function update($id, Subcategory $subcategory, Request $request)
    {
        $subcategory = Subcategory::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'is_hidden' => 'boolean',
            'subcategory_photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($request->hasFile('subcategory_photo')) {
            // Delete old photo if it exists
            if ($subcategory->subcategory_photo) {
                Storage::disk('public')->delete($subcategory->subcategory_photo);
            }

            $originalFileName = $request->file('subcategory_photo')->getClientOriginalName();
            $subcategoryPhotoPath = $request->file('subcategory_photo')->storeAs('subcategory_photo', $originalFileName, 'public');
        } else {
            // No new photo provided, keep the existing one
            $subcategoryPhotoPath = $subcategory->subcategory_photo;
        }

        $subcategory->update([
            'title' => $request->input('title'),
            'is_hidden' => $request->input('is_hidden'),
            'category_id' => $request->input('category_id'),
            'subcategory_photo' => $subcategoryPhotoPath,
        ]);


        return redirect()->route('admin.subcategories.index')->with('success', 'Subcategory updated successfully!');
    }


    public function destroy(Subcategory $subcategory)
    {
        // Update products with the current category's ID to null
        Product::where('subcategory_id', $subcategory->id)->update(['subcategory_id' => null]);

        $subcategory->delete();

        return redirect()->route('admin.subcategories.index')->with('success', 'Subcategory deleted successfully!');
    }

}
