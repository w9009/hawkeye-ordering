@extends('layouts.app')
@section('content')
<div class="container-home">
    <div class="products-table">
        <h3>Create a order</h3>
        <form id="create-order-form" action="{{ route('create_order') }}" method="post">
            @csrf
            <div class="input-wrapper">
                <label for="title">title: </label>
                <input id="title" name="title" type="text">
            </div>

            @if(@isset($error))
            <input id="error" type=hidden name="" value="{{ $error }}">
            @endif

            <div class="input-wrapper">
                <label for="description">description: </label>
                <textarea id="description" class="description-input" name="description" type="text"></textarea>
            </div>

            <div class="input-wrapper">
                <label for="due">due date: </label>
                <input id="due" name="due" type="date">
            </div>

            <div class="input-wrapper">
                <label for="Status">Status: </label>
                <input class="invisible" id="new-Status" name="newStatus" type="text">
                <select name="Status" id="Status">
                @if(@isset($status) && @count($status) > 0)
                      @foreach($status as $Status)
                          <option value="{{ $Status->id }}"> {{ $Status->name }}</option>
                      @endforeach
                @else
                  <option value="null">No status available</option>
                @endif
                </select>
            </div>
            <!-- <p id="add-Status">Add Status<p> -->
            <ul id="part-list">
            </ul>
            <button>create</button>
        </form>
    </div>
    <div class="devices-table">
        <ul>
            @foreach($devices as $device)
            <li class= "category-item" name= '{{$device->id}}' value="{{ $device->id }}">{{ $device->name }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
