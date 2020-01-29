<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Device;
use App\Product;
use App\Category;

class DevicesController extends Controller
{
    public function navCreate(Request $request)
    {
        $products = Product::all();
        $categories = Category::with('products')->get();
        return view('create_device', ['products' => $products, 'categories' => $categories]);
    }

    public function create(Request $request)
    {
        $params = $request->all();
        dd($params);
    }
}
