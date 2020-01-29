<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Category;

class ProductsController extends Controller
{
    public function navCreate(Request $request)
    {
       $categories = Category::all();
       return view('create_product', ['categories' => $categories]);
    }

    public function navUpdate(Request $request)
    {
        $product = Product::whereId($request->id)->first();
        return view('update_product', ['product' => $product]);
    }

    public function update(Request $request)
    {
        $params = $request->all();
        $id = $request->id;

        $product = Product::whereId($id)->first();

        foreach ($params as $key => $value) {
            $product->$key = $value;
            $product->save();
        }
        return view('update_product', ['product' => $product]);
    }

    public function create(Request $request)
    {
        $user = Auth::user();
        $params = $request->all();
        if ($request->newCategory === null) {
            $category = Category::whereId($params['category'])->first();
        } else {
            $category = Category::create([
                'name' => $params['newCategory'],
            ]);
        }

        $product = Product::firstOrCreate([
            'name' => $params['name'],
            'delivery_time' => $params['delivery_time'],
            'category_id' => $category->id,
            'image' => $params['image'],
            'amount' => $params['amount'],
            'store' => $params['store'],
            'price' => $params['price'],
        ]);
        $product->users()->attach($user->id);

        return redirect()->route('home');
    }
}
