@extends('layouts.app')

@section('content')
  <div class="container">
    <form class="form-inline my-2 my-lg-0">
      <input class="hawkeye-form form-control mr-sm-2 mobile-search" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-hawkeye-add mr-sm-2" type="submit">Search</button>
    </form>
    <div class="col-md-12 ">
      <div class="form-inline mb-3 mt-3">
        <h3 class="mr-sm-2" style="margin-bottom: 0">Status</h3>
        <button class="btn btn-hawkeye-add mr-sm-2" onclick="filterSelection('all')">Show all</button>
        <button class="btn btn-hawkeye btn-done mr-sm-2" onclick="filterSelection('done')">Done</button>
        <button class="btn btn-hawkeye btn-failed mr-sm-2" onclick="filterSelection('failed')">Failed</button>
        <button class="btn btn-hawkeye btn-pending mr-sm-2" onclick="filterSelection('pending')">Pending</button>
        <button class="btn btn-hawkeye btn-production" onclick="filterSelection('production')">Production</button>
      </div>
    </div>
    <div class="col-md-12">
      <h1>All Orders</h1>

      <!-- will be used to show any messages -->
      @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
      @endif

      <table class="table">
        <tr>
          <th class="table__heading">Order title</th>
          <th class="table__heading">Order description</th>
          <th class="table__heading">Order status</th>
          <th class="table__heading">Order due date</th>
          <th class="table__heading">Order Devices</th>
          <th class="table__heading" colspan="2">Acions</th>
        </tr>
        @if(@isset($orders))
          @foreach($orders as $order)
            <tr class="table__row filterDiv" data-toggle="tooltip" data-html="true" data-placement="left" title="@foreach($order->devices as $device){{ $device->name }} : {{ $device->pivot->quantity }}@endforeach">
              <td class="table__content" data-heading="Title">{{ $order->title }}</td>
              <td class="table__content" data-heading="Description">{{ $order->description }}</td>
              <td class="table__content" data-heading="Name">{{ $order->status->name }}</td>
              @if($order->status->id == 1)
                <td class="status done">Done</td>
              @elseif($order->status->id == 2)
                <td class="status failed">Failed</td>
              @elseif($order->status->id == 3)
                <td class="status pending">Pending</td>
              @elseif($order->status->id == 4)
                <td class="status production">Production</td>
              @endif
              <td class="table__content" data-heading="Due Date">{{ $order->due }}</td>
              <td  class="table__content" data-heading="action">
                <a class="" href="{{ route('inspect', ['id' => $order->id]) }}">
                  <span class="custom-icon-content" style="width: 28px!important;">
                    @svg('custom/dashboard')
                  </span>
                </a>
              </td>
            </tr>
          @endforeach
        @endif
      </table>
    </div>
  </div>
@endsection
