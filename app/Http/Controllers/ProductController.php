<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        if ($search) {
            $products = Product::where('name', 'LIKE', "%{$search}%")->get();
        } else {
            $products = Product::all();
        }

        return Inertia::render('Shop', compact('products'));
    }

    public function productDetails($id)
    {
        $product = Product::with('sizes')->findorfail($id);

        return Inertia::render('ProductDetails', compact('product'));
    }

    public function category($id)
    {
        $products = Product::where('category_id', $id)->get();

        return Inertia::render('Shop', compact('products'));
    }
}
