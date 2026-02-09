<?php

namespace App\Http\Controllers;

use App\Http\Middleware;
use App\Http\Middleware\CheckTimeAccess;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;

class ProductController extends Controller implements HasMiddleware
{
    public static function middleware(){
        return [CheckTimeAccess::class];
    }

    public function index(){
        $title = "Product List";
        $product = Product::all();
        return view("admin.product.index", [
            'title' => $title,
            'products' => $product,
        ]);
    }

    public function getDetail(string $id = "123") {
        return view("product.detail", ['id' => $id]);
    }

    public function create() {
        return view("product.add");
    }

    public function store(Request $request) {
        return $request -> all();
    }
}
