<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        // Urutan tetap: Sportcar, SUV, Sedan; di dalam segmen urut berdasarkan id
        $order = ['sportcar' => 0, 'suv' => 1, 'sedan' => 2];

        $products = Product::orderBy('id')->get()
            ->sortBy(fn ($p) => [$order[$p->segment] ?? 9, $p->id])
            ->values();

        return view('home', compact('products'));
    }

    public function show(Product $product)
    {
        $related = Product::where('id', '!=', $product->id)->orderBy('id')->get();

        return view('products.show', compact('product', 'related'));
    }
}
