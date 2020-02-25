<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Device;
use App\Product;
use App\Category;
use App\Status;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class DevicesController extends Controller
{
    public function navCreate(Request $request)
    {
        $products = Product::all();
        $categories = Category::with('products')->get();
        $status = Status::all();
        return view('create_device', ['products' => $products, 'categories' => $categories]);
    }

    public function create(Request $request)
    {
        $products   = Product::all();
        $categories = Category::with('products')->get();
        $param_whitelist = ['name', 'delivery_time', 'description', 'image', '_token'];
        $parts  = [];
        $params = $request->all();

        if (Device::whereName($params['name'])->exists()) {
            return view('create_device', ['products' => $products, 'categories' => $categories, 'error' => 6]);
        }

        try {
          $image  = $request->file('image');
          $name=time().$image->getClientOriginalName();
          $ext = $image->extension();

          $replaceables = ['-', '.', " ", $ext];
          $filePath = str_replace($replaceables, "", 'images/'. $name) . '.' . $ext;

          Storage::disk('s3')->put($filePath, file_get_contents($image));
          $device = new Device();
          $device->image         = $filePath;
          $device->description   = $params['description'];
          $device->name          = $params['name'];
          $device->save();
        } catch (\Exception $exception) {
            dd($exception);
            return view('create_device', ['products' => $products, 'categories' => $categories, 'error' => 1]);
        }

        try {
          foreach ($params as $key => $value) {
            if (! in_array($key, $param_whitelist)) {
              if (substr($key, 0, strpos($key, "-")) == 'amount') {
                 $amount = $value;
              }
              else {
                  $parts[$value] = ['product_amount' => $amount];
              }
            }
          }
          if(count($parts) == 0) {
              $device->delete();
              dd($parts, $params);
              return view('create_device', ['products' => $products, 'categories' => $categories, 'error' => 2]);
          }
        } catch (\Exception $exception) {
          $device->delete();
          dd($parts, $exception, $params);
          return view('create_device', ['products' => $products, 'categories' => $categories, 'error' => 2]);
        }

        $device->users()->attach(Auth::user()->id);
        $device->products()->sync($parts);
        return redirect()->route('home');
    }

    public function navUpdate(Request $request)
    {
        $device = Device::whereId($request->id)->with('users')->first();
        $device->image = base64_encode(Storage::disk('s3')->get($device->image));
        return view('update_device', ['device' => $device]);
    }

    public function update(Request $request)
    {
      $params = $request->all();
      $id = $request->id;

      $device = Device::whereId($id)->first();

      foreach ($params as $key => $value) {
          $device->$key = $value;
          $device->update();
      }

      $device = Device::whereId($device->id)->with('users')->first();
      return view('update_device', ['device' => $device]);
    }
}
