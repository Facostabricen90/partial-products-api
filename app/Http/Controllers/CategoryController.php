<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Inertia\Inertia;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Categories/Index', [
            'categories' => Category::withCount('products')
                ->orderBy('id', 'asc')
                ->get(),
            'message' => session('message') ?? null,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Categories/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $validated = $request->validate([
        'category_name' => 'required|string|max:255',
        'category_description' => 'required|string|max:255',
        'category_classification' => 'required|string|max:255',
        'category_state' => 'required|boolean',
        ]);

        Category::create($validated);

        return redirect()->route('categories.index')
            ->with('message', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return Inertia::render('Categories/Show', [
            'category' => $category->load('products')
        ]);
    }

    /**
 * Show the form for editing the specified resource.
 */
public function edit(Category $category)
{
    return Inertia::render('Categories/Edit', [
        'category' => $category
    ]);
}

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $validated = $request->validate([
        'category_name' => 'required|string|max:255',
        'category_description' => 'required|string|max:255',
        'category_classification' => 'required|string|max:255',
        'category_state' => 'required|boolean',
    ]);

    $category->update($validated);

    return redirect()->route('categories.index')
        ->with('message', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')
            ->with('message', 'Category deleted successfully.');
    }

    public function getActiveCategories()
    {
        $activeCategories = Category::where('category_state', true)
                                    ->with('products')
                                    ->get();

        return response()->json([
            'success' => true,
            'categories' => $activeCategories
        ], 200);
    }
}
