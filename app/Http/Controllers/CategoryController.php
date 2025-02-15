<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Show all categories
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Paginate categories with optional search
        $categories = Category::when($search, function ($query, $search) {
            return $query->where('category_name', 'like', "%{$search}%");
        })
            ->paginate(10);  // Adjust number of items per page as needed

        return view('admin.categories.index', compact('categories'));
    }

    // Show the create category form
    public function create()
    {
        return view('admin.categories.create');
    }

    // Store a new category
    public function store(Request $request)
{
    $request->validate([
        'category_name' => 'required|string|max:255',
        'icon' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        'status' => 'required|boolean',
    ]);

    $categoryData = $request->only(['category_name', 'status']);

    // Handle image upload
    if ($request->hasFile('icon')) {
        $categoryData['icon'] = $request->file('icon')->store('category_icons', 'public');
    }

    Category::create($categoryData);

    return redirect()->route('categories.index')->with('success', 'Category created successfully.');
}


    // Show the edit category form
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    // Update an existing category
    public function update(Request $request, $id)
{
    $request->validate([
        'category_name' => 'required|string|max:255',
        'icon' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        'status' => 'required|boolean',
    ]);

    $category = Category::findOrFail($id);

    $categoryData = $request->only(['category_name', 'status']);

    // Handle image upload (if new image is uploaded)
    if ($request->hasFile('icon')) {
        // Delete the old icon image if exists
        if ($category->icon && file_exists(public_path('storage/' . $category->icon))) {
            unlink(public_path('storage/' . $category->icon));
        }

        // Store the new image
        $categoryData['icon'] = $request->file('icon')->store('category_icons', 'public');
    }

    $category->update($categoryData);

    return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
}


    // Delete a category
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
