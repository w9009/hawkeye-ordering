<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Device;
use App\Category;
use App\Order;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        // get all devices and products for authenticated use
        $orders = Order::with('devices', 'status')->get();

        return view('home', ['orders' => $orders]);
    }

    public function partsDevices()
    {
      $categories = Category::with('products')->get();
      $devices  = Device::all();

      return view('parts_devices', ['devices' => $devices, 'categories' => $categories]);
    }
}
