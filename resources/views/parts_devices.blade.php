@extends('layouts.app-inventory')

@section('content')



  <div class="container">
    <div class="row">
      <div class="col-md-5">
        <h1>Devices</h1>

        <!-- will be used to show any messages -->
        @if (Session::has('message'))
          <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif

        <table class="table">
          <tr>
            <th class="table__heading">Devices</th>
            <th class="table__heading">Acions</th>
          </tr>
          @if(@isset($devices))
            @foreach($devices as $device)
              <tr class="table__row" data-toggle="tooltip" data-html="true" data-placement="left" title="">
                <td class="table__content" data-heading="Device name">{{$device->name}}</td>
                <td class="table__content" data-heading="Action" style="padding: 0">
                  <a class="" href="{{ route('nav_update_device',['id' => $device->id]) }}">
                    <span class="custom-icon-content" style="width: 38px!important;">
                        @svg('custom/eye')
                    </span>
                  </a>
                </td>
              </tr>
            @endforeach
            @endif
        </table>
      </div>
      <div class="col-md-5">
        <h1>Products</h1>

        <table class="table">
          <tr>
            <th class="table__heading">Product name</th>
            <th class="table__heading">Acions</th>
          </tr>
          @if(@isset($categories))
            @foreach($categories as $category)
              <tr class="table__row" data-toggle="tooltip" data-html="true" data-placement="left" title="">
                <td class="table__content" data-heading="Category name">{{ $category->name }}</td>
                <td class="table__content" data-heading="Action" style="padding: 0">
                  <ul>
                    @foreach($category->products as $product)
                      <li>
                        <a href="{{ route('nav_update_product',['id' => $product->id]) }}">{{ $product->name }}</a>
                      </li>
                    @endforeach
                  </ul>
                  <span class="custom-icon-content" style="width: 38px!important;">
                    @svg('custom/eye')
                  </span>
                </td>
              @endforeach
            @endif
          </tr>
        </table>
      </div>
    </div>
  </div>
@endsection
