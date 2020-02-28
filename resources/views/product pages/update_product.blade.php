@extends('layouts.app')

@section('content')
<div class="container-update">
    @if(@isset($product))
        <div class="products-table update-products">
            <ul>
                @foreach($product->getAttributes() as $key => $value)
                <li>
                    <div class="product-information">
                    <label for="{{ $key }}">Product {{$key}}: </label>
                        @if($key == "image")
                            @if($value == null)
                                <p id="{{ $key }}"> No image</p>
                            @else
                                <img src="{{ $image }}" alt="">
                            @endif
                        @else
                            <p id="{{ $key }}"> {{ $value }}</p>
                        @endif
                        <div class="icon-wrapper {{ $key }}">
                        <i class="fas fa-edit"></i>
                        </div>
                    </div>
                    <form class="{{ $key }}-invisible invisible" action="{{ route('update_product', ['id' => $product->id]) }}">

                        @if($key == "image")
                            <input name="{{ $key }}" type="file" placeholder="{{ $key }}">
                        @elseif($key == "amount" || $key == "price")
                            <input name="{{ $key }}" type="number" set=".01" placeholder="{{ $key }}">
                        @elseif($key == "created_at" || $key == "updated_at")
                            <input name="{{ $key }}" type="datetime-local" placeholder="{{ $key }}">
                        @elseif($key == "delivery_time")
                            <input name= "{{ $key }}" type="date" placeholder="{{ $key }}">
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
