<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Device;
use App\Product;
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

        // get all devices and products for authenticated user
        $devices = Device::whereHas('users', function ($query) use($user) {
            $query->where('id', $user->id);
        })->get();

        $products = Product::whereHas('users', function ($query) use($user) {
            $query->where('id', $user->id);
        })->get();

        return view('home', ['devices' => $devices, 'products' => $products]);
    }
}
