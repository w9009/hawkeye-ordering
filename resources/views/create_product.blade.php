@extends('layouts.app')

@section('content')
<div class="container-home">
    <div class="products-table">
        <h3>Create a product</h3>
        <form action=" {{ route('create_product') }}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="input-wrapper">
                <label for="name">name: </label>
                <input id="name" name="name" type="text">
            </div>

            <div class="input-wrapper">
                <label for="delivery">delivery: </label>
                <input id="delivery" name="delivery_time" type="text">
            </div>

            <div class="input-wrapper">
                <label for="amount">amount: </label>
                <input id="amount" name="amount" type="number">
            </div>

            <div class="input-wrapper">
                <label for="image">image: </label>
                <input id="image" name="image" type="file">
            </div>

            <div class="input-wrapper">
                <label for="store">store: </label>
                <input id="store" name="store" type="text">
            </div>

            <div class="input-wrapper">
                <label for="price">price: </label>
                <input id="price" name="price" type="number" step=".01">
            </div>

            <div class="input-wrapper">
                <label for="category">Category: </label>
                <input class="invisible" id="new-category" name="newCategory" type="text">
                <select name="category" id="category">
                @if(@isset($categories))
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"> {{ $category->name }}</option>
                    @endforeach
                @endif
                </select>
            </div>
            <p id="add-category">Add Category<p>
            <button>create</button>
        </form>
    </div>
</div>
@endsection
