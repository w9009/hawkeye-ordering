@extends('layouts.app')

@section('content')
<div class="container-home">
    <div class="devices-table">
        <h3>Devices Overview</h3>
        @if(@count($devices) > 0)
            <div class="all-devices">
                @foreach($devices as $device)
                    <p>{{ $device->name }}</p>
                @endforeach
            </div>
        @else
            <p>no devices found</p>
            <a href="{{ route('nav_create_device') }}">create device</a>
        @endif
    </div>

    <div class="products-table">
        <h3>Products Overview</h3>
        @if(@count($products) > 0)
            <div class="all-products">
                <ul>
                @foreach($products as $product)
                    <li>
                        <a href="{{ route('nav_update_product',['id' => $product->id]) }}">{{ $product->name }}</a>
                    </li>
                @endforeach
                </ul>
                <a href="{{ route('nav_create_product') }}">create product</a>
            </div>
        @else
            <p>no products found</p>
            <a href="{{ route('nav_create_product') }}">create product</a>
        @endif
    </div>

</div>
@endsection
