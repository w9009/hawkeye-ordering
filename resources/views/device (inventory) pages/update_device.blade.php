@extends('layouts.app-inventory')

@section('content')
<div class="container-update">
    @if(@isset($device))
        <h2 class="name-device">{{$device->name}}</h2>
        <h3 class="created-by"> Created By: {{$device->users[0]->name}}</h3>
        <div class="products-table update-products">
            <ul>
                @foreach($device->getAttributes() as $key => $value)
                <li>
                    <div class="device-information">
                    <label for="{{ $key }}">Device {{$key}}: </label>
                        @if($key == "image")
                          <img src="data:image/png;base64, {{ $device->image }}" alt="">
                        @else
                            <p id="{{ $key }}"> {{ $value }}</p>
                        @endif
                        <div class="icon-wrapper {{ $key }}">
                        <i class="fas fa-edit"></i>
                        </div>
                    </div>
                    <form class="{{ $key }}-invisible invisible" action="{{ route('update_device', ['id' => $device->id]) }}">

                        @if($key == "image")
                            <input name="{{ $key }}" type="file" placeholder="{{ $key }}">
                        @elseif($key == "amount" || $key == "price")
                            <input name="{{ $key }}" type="number" set=".01" placeholder="{{ $key }}">
                        @elseif($key == "created_at" || $key == "updated_at")
                            <input name="{{ $key }}" type="date" placeholder="{{ $key }}">
                        @elseif($key == "delivery_time")
                            <input name= "{{ $key }}" type="date" placeholder="{{ $key }}">
                        @elseif($key == "description")
                            <textarea name= "{{ $key }}" type="text" placeholder="{{ $key }}"></textarea>
                        @else
                            <input name= "{{$key}}" type="text" placeholder="{{ $key }}">
                        @endif
                        <button>Save</button>
                    </form>
                </li>
                @endforeach
    @else
        <h3>Something went wrong loading the product</h3>
    @endif
</div>
@endsection
