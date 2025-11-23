<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\ProductRequest;
use Inertia\Inertia;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    
        $products = Product::with('category')
                ->orderBy('id', 'asc')
                ->get();
        return Inertia::render('Products/Index', [
            'products' => $products,
            'message' => session('message') ?? null,
        ]);
    }

    public function create()
    {
        return Inertia::render('Products/Create', [
            'categories' => Category::where('category_state', true)->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $request->validate([
        'product_name' => 'required|string|max:255',
        'product_description' => 'nullable|string',
        'product_price' => 'required|numeric|min:0',
        'product_stock' => 'required|integer|min:0',
        'product_status' => 'required|boolean',
        'fk_category_product' => 'required|exists:categories,id',
        ]);

        Product::create($request->all());

        return redirect()
            ->route('products.index')
            ->with('message', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return Inertia::render('Products/Show', [
            'product' => $product->load('category')
        ]);
    }

    /**
 * Show the form for editing the specified resource.
 */
public function edit(Product $product)
{
    return Inertia::render('Products/Edit', [
        'product' => $product,
        'categories' => Category::where('category_state', true)->get()
    ]);
}

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $validated = $request->validate([
        'product_name' => 'required|string|max:255',
        'product_description' => 'nullable|string',
        'product_price' => 'required|numeric|min:0',
        'product_stock' => 'required|integer|min:0',
        'product_status' => 'required|boolean',
        'fk_category_product' => 'required|exists:categories,id',
    ]);

    $product->update($validated);

    return redirect()->route('products.index')
        ->with('message', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('message', 'Product deleted successfully.');
    }
}
