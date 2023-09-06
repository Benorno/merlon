<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function show(Category $category)
    {
        $products = $category->products;
        return view('categories.show', compact('category', 'products'));
    }

    public function table(Request $request)
    {
        // $categories = Category::all(); // Fetch all categories

        $searchQuery = $request->input('search_query');

        $query = Category::orderBy('id', 'asc');

        if ($searchQuery) {
            $query->where(function ($query) use ($searchQuery) {
                $query->where('title', 'like', '%' . $searchQuery . '%');
            });
        }

        $categories = $query->get();

        return view('admin.categories.table', compact('categories', 'searchQuery'));
    }


    public function create()
    {
        return view('admin.categoryCreate');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_title' => 'required|string',
            'category_photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $categoryPhotoPath = null;

        if ($request->hasFile('category_photo')) {
            $originalFileName = $request->file('category_photo')->getClientOriginalName();
            $categoryPhotoPath = $request->file('category_photo')->storeAs('category_photo', $originalFileName, 'public');
        }

        // Create and store the category in the database
        Category::create([
            'title' => $request->input('category_title'),
            'category_photo' => $categoryPhotoPath,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully!');
    }


    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Category $category, Request $request)
    {
        $request->validate([
            'title' => 'required',
            'is_hidden' => 'boolean',
            'category_photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('category_photo')) {
            // Delete old photo if it exists
            if ($category->category_photo) {
                Storage::disk('public')->delete($category->category_photo);
            }

            $originalFileName = $request->file('category_photo')->getClientOriginalName();
            $categoryPhotoPath = $request->file('category_photo')->storeAs('category_photo', $originalFileName, 'public');
        } else {
            // No new photo provided, keep the existing one
            $categoryPhotoPath = $category->category_photo;
        }

        $category->update([
            'title' => $request->input('title'),
            'is_hidden' => $request->input('is_hidden'),
            'category_photo' => $categoryPhotoPath,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully!');
    }


    public function destroy(Category $category)
    {
        // Update products with the current category's ID to null
        Product::where('category_id', $category->id)->update(['category_id' => null]);

        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully!');
    }

}
