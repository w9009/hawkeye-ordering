@extends('layouts.app-inventory')

@section('content')

    <div class="container">
        <div class="col-md-12">
            <div class="card-header">
                <h1 class="name">Create an product</h1>
            </div>
            <div class="card shadow">
                <div class="card-body">
                    <form method="POST" action="{{ route('create_product') }}" class="was-validated">
                        @csrf
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="form-group">
                            <label class="form" for="name">Name</label>
                            <input type="text" id="name" class="form-control" name="name" value="" autocomplete="name" autofocus placeholder="Device name">
                        </div>
                        <div class="form-group">
                            <label class="form" for="description">Description</label>
                            <textarea type="text" id="description" class="form-control" name="description" value="" autocomplete="" autofocus placeholder="Device description"></textarea>
                        </div>
                        <div id="image">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupFileAddon01">Image</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="validatedCustomFile" accept="image/*" name="image">
                                        <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-hawkeye-add">Add</button>
                    </form>
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
            </div>
        </div>
    </div>
@endsection
