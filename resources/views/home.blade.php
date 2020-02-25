@extends('layouts.app')

@section('content')
  <div class="order-container">
    <a href="{{ route('nav_create_order') }}">Create order</a>
    @if(@isset($orders))
      <table style="border-collapse: collapse;">
        <tr>
          <th>Order title</th>
          <th>Order description</th>
          <th>Order status</th>
          <th>Order due date</th>
          <th>Order Devices</th>
        </tr>
        @foreach($orders as $order)
          <tr class="spacer"></tr>
          @if($order->status->id == 1)
            <tr class="order-failed">
          @elseif($order->status->id == 2)
            <tr class="order-done">
          @elseif($order->status->id == 3)
            <tr class="order-tr">
          @elseif($order->status->id == 4)
            <tr class="order-production">
          @endif
            <td>{{ $order->title }}</td>
            <td>{{ $order->description }}</td>
            <td>{{ $order->status->name }}</td>
            <td>{{ $order->due }}</td>
            <td>
              <ul>
                @foreach($order->devices as $device)
                <li>{{ $device->name }} : {{ $device->pivot->quantity }}x</li>
                @endforeach
              </ul>
            </td>
            <td><a class="td-a" href="{{ route('inspect', ['id' => $order->id]) }}"><i class="fas fa-edit"></i></a></td>
          </tr>
        @endforeach
      </table>
    @else
      <h3>There are no orders placed.</h3>
    @endif
</div>
@endsection
