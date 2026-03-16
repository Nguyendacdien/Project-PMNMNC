<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::where('is_delete', 0);

        if ($request->filled('keyword')) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $products = $query->get();
        $categories = Category::where('is_delete', 0)->get();

        return view('product.index', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        $categories = Category::where('is_delete', 0)->get();
        return view('product.create', [
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'nullable|exists:categories,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
            'is_active' => 'required|boolean',
        ]);

        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Thêm sản phẩm thành công!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::where('is_delete', 0)->get();

        return view('product.edit', [
            'product' => $product,
            'categories' => $categories,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'category_id' => 'nullable|exists:categories,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
            'is_active' => 'required|boolean',
        ]);

        $product = Product::findOrFail($id);
        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Cập nhật sản phẩm thành công!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->update(['is_delete' => 1]);

        return redirect()->route('products.index')->with('success', 'Xóa sản phẩm thành công!');
    }
}
