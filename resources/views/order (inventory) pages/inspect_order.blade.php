@extends('layouts.app-inventory')
@section('content')
@if(@isset($order))
<div class="container-home">
    <div class="products-table">
        <h3>Update a order</h3>
        <form id="update-order-form" action="{{ route('assign', ['id' => $order->id]) }}">
            <table class= "information-table">
              <tr>
                <td>Title: {{ $order->title }}</td>
              </tr>
              <tr>
                <td>Description: {{ $order->description }}</td>
              </tr>
              <tr>
                <td>Due date: {{ $order->due }}</td>
              </tr>
              @if(@isset($order->users[0]))
                <tr>
                  <td> assigned user: {{ $order->users[0]->name }}</td>
                </tr>
              @else
              <tr>
                <td> assigned user: none</td>
              </tr>
              @endif

              @foreach($order->devices as $device)
              <tr>
                <td>Device name: {{ $device->name }} : {{$device->pivot->quantity}}x</td>
                <td> parts:
                  <ul>
                    @foreach($device->products as $product)
                      <li>{{ $product->name }}: {{$product->pivot->product_amount}}x</li>
                    @endforeach
                  </ul>
                </td>
              </tr>
              @endforeach
            </table>
            @if(@isset($error))
            <input id="error" type=hidden name="" value="{{ $error }}">
            @endif
            @if(@isset($status))
              <select class="status" name="status_id">
                @foreach($status as $item)
                <option value="{{ $item->id }}">
                  {{ $item->name }}
                </option>
                @endforeach
              </select>
            @endif

            @if(@isset($users))
              <select class="users" name="user_id">
                @foreach($users as $user)
                <option value="{{ $user->id }}">
                  {{ $user->name }}
                </option>
                @endforeach
              </select>
            @endif
            <button>assign</button>
        </form>
    </div>
</div>
@endif
@endsection
