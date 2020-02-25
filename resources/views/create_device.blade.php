@extends('layouts.app')

@section('content')
<div class="container-home">
    <div class="products-table">
        <h3>Create a device</h3>
        <form id="create-device-form" method="post" action="{{ route('create_device') }}" enctype="multipart/form-data">
            @csrf
            <div class="input-wrapper">
                <label for="name">name: </label>
                <input id="name" name="name" type="text">
            </div>

            @if(@isset($error))
            <input id="error" type=hidden name="" value="{{ $error }}">
            @endif

            <div class="input-wrapper">
                <label for="description">description: </label>
                <textarea id="description" class="description-input" name="description" type="text"></textarea>
            </div>

            <div class="input-wrapper">
                <label for="image">image: </label>
                <input id="image" name="image" type="file">
            </div>
            <ul id="part-list">
            </ul>
            <button>create</button>
        </form>
    </div>
    @if(@isset($categories))
        <div class="devices-table">
            @foreach($categories as $category)
                <div class="category-wrapper" id="{{ $category->id }}">
                    <p>{{$category->name}}:</p>
                    <ul>
                        @foreach($category->products as $product)
                        <li class= "category-item" name= '{{$category->id}}' value="{{ $product->id }}">{{ $product->name }}</li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
