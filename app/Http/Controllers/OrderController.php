<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Device;
use App\Status;
use App\Order;
use App\Product;
use App\User;

class OrderController extends Controller
{
  public function inspect(Request $request)
  {
    $order  = Order::whereId($request->id)->with('devices.products', 'users')->first();
    $users  = User::all();
    $status = Status::all();
    return view('order pages/inspect_order', ['order' => $order, 'users' =>$users, 'status' => $status]);
  }

  public function assign(Request $request)
  {
    $id     = $request->id;
    $users  = User::all();
    $status = Status::all();
    $params = $request->all();
    $order  = Order::whereId($id)->first();
    
    $order->users()->detach();
    $order->users()->attach($params['user_id']);
    $order->status_id = $params['status_id'];
    $order->update();

    return view('order pages/inspect_order', ['order' => $order, 'users' =>$users, 'status' => $status]);
  }

  public function navCreate()
  {
    $devices = Device::all();
    $status  = Status::all();
    return view('order pages/create_order', ['devices' => $devices, 'status' => $status]);
  }

  public function create(Request $request) {

    $param_whitelist = ['title', 'due', 'description', 'Status', 'newStatus'];
    $status          = Status::all();
    $devices         = Device::all();
    $params          = $request->all();
    $parts           = [];

    if (Order::whereTitle($params['title'])->exists()) {
        return view('order pages/create_order', ['devices' => $devices, 'status' => $status, 'error' => 6]);
    }

    try {
      if ($request->newStatus === null) {
          $status_request = Status::whereId($params['Status'])->first();
      } else {
          $status_request = Status::create([
              'name' => $params['newStatus'],
          ]);
      }
    } catch (\ErrorException $exception) {
      return view('order pages/create_order', ['devices' => $devices, 'status' => $status, 'error' => 3]);
    }

    try {
      $order = new Order();
      $order->title       = $params['title'];
      $order->description = $params['description'];
      $order->due         = $params['due'];
      $order->status_id   = $status_request->id;
      $order->save();
    } catch (\Exception $exception) {
        dd($exception, $status_request);
        return view('order pages/create_order', ['devices' => $devices, 'status' => $status, 'error' => 1]);
    }

    try {
      foreach ($params as $key => $value) {
        if (! in_array($key, $param_whitelist)) {
          if (substr($key, 0, strpos($key, "-")) == 'amount') {

             $amount = $value;
          }
          else {
              $parts[$value] = ['quantity' => $amount];
          }
        }
      }
    } catch (\Exception $exception) {
        dd($exception, $params);
        return view('order pages/create_order', ['devices' => $devices, 'status' => $status, 'error' => 2]);
    }

    try {
      foreach ($parts as $key => $value) {
        $device = Device::whereId($key)->with('products')->first();
        foreach ($device->products as $product) {

          $quantity = \DB::table('device_product')
          ->select('product_amount')
          ->where([
            'product_id' => $product->id,
            'device_id'  => $device->id,
            ])->first()->product_amount;

          $product->amount = $product->amount - $quantity;
          if($product->amount < 0) {
            $order->status_id = Status::whereId(1)->first()->id;
            $order->save();
          }
          $product->save();
        }
      }
    } catch(\Exception $exception) {
      dd($exception);
    }

    $order->devices()->sync($parts);
    return redirect()->route('home');
  }
}
