@extends('layouts.app')
@section('content')
<div class="container-margin-20">
  <div class="container-parts">
    <a class="links" href="{{ route('nav_create_device') }}">create devices</a>
    <div class="parts-devices-table">
      @if(@isset($devices))
      <h3>Devices</h3>
      <table class="information-table">
        @foreach($devices as $device)
        <tr>
          <td> <a href="{{ route('nav_update_device',['id' => $device->id]) }}">{{$device->name}}</a></td>
        </tr>
        @endforeach
      </table>
      @endif
    </div>

    <a class="links" href="{{ route('nav_create_product') }}">create product</a>
    <div class="parts-products">
      <h3>Products</h3>
      @if(@isset($categories))
        <table class="information-table">
          @foreach($categories as $category)
          <tr>
            <td> {{ $category->name }}</td>
            <td>
              <ul>
                @foreach($category->products as $product)
                <li>
                  <a href="{{ route('nav_update_product',['id' => $product->id]) }}">{{ $product->name }}</a>
                </li>
                @endforeach
              </ul>
            </td>
          </tr>
          @endforeach
        </table>
      @endif
    </div>
</div>
@endsection
