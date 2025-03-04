<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index()
    {

        $products = Product::all();

        return Inertia::render('Shop', compact('products'));
    }

    public function productDetails($id)
    {
        $product = Product::with('sizes')->findorfail($id);

        return Inertia::render('ProductDetails', compact('product'));
    }
}
