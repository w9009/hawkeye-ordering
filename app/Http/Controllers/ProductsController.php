<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Category;
use Illuminate\Support\Facades\Storage;
use App\Order;

class ProductsController extends Controller
{
    public function navCreate(Request $request)
    {
       $categories = Category::all();
       return view('product pages/create_product', ['categories' => $categories]);
    }

    public function navUpdate(Request $request)
    {
        $product = Product::whereId($request->id)->first();
        $image = base64_encode(Storage::disk('s3')->get($product->image));
        return view('product pages/update_product', ['product' => $product, 'image' => $image]);
    }

    public function update(Request $request)
    {
        $params = $request->all();
        $id = $request->id;

        $product = Product::whereId($id)->first();

        foreach ($params as $key => $value) {
            $product->$key = $value;
            $product->update();
        }

        $image = Storage::disk('s3')->url($product->image);
        return view('product pages/update_product', ['product' => $product, 'image' => $image]);
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
        $image  = $request->file('image');
        $name=time().$image->getClientOriginalName();
        $ext = $image->extension();
        $replaceables = ['-', '.', " ", $ext];
        $filePath = str_replace($replaceables, "", 'images/'. $name) . '.' . $ext;
        Storage::disk('s3')->put($filePath, file_get_contents($image));

        $product = Product::firstOrCreate([
            'name' => $params['name'],
            'delivery_time' => $params['delivery_time'],
            'category_id' => $category->id,
            'image' => $filePath,
            'amount' => $params['amount'],
            'store' => $params['store'],
            'price' => $params['price'],
        ]);
        $product->users()->attach($user->id);

        return redirect()->route('home');
    }
}
