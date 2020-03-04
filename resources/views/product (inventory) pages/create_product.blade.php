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
                            <input type="text" id="name" class="form-control" name="name" value="" autocomplete="name" autofocus placeholder="Product name">
                        </div>
                        <div class="form-group">
                            <label class="form" for="delivery">Delivery</label>
                            <input type="text" id="delivery" class="form-control" name="delivery" value="" autocomplete="" autofocus placeholder="Product delivery">
                        </div>
                        <div class="form-group">
                            <label class="form" for="amount">Amount</label>
                            <input type="text" id="amount" class="form-control" name="amount" value="" autocomplete="" autofocus placeholder="Product amount">
                        </div>
                        <div class="form-group">
                            <label class="form" for="store">Store</label>
                            <input type="text" id="store" class="form-control" name="store" value="" autocomplete="" autofocus placeholder="Product store">
                        </div>
                        <div class="form-group">
                            <label class="form" for="price">Price</label>
                            <input type="text" id="price" class="form-control" name="price" value="" autocomplete="" autofocus placeholder="Product price">
                        </div>
                        <div class="form-group">
                            <label class="form" for="category">Category</label>
                            <input type="text" id="category" class="form-control" name="category" value="" autocomplete="" autofocus placeholder="Product category">
                        </div>
                        <div class="form-group">
                            <label for="category">Category: </label>
                            <select class="form-control" name="category" id="category">
                                @if(@isset($categories))
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"> {{ $category->name }}</option>
                                    @endforeach
                                @endif
                            </select>
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
                </div>
            </div>
        </div>
    </div>
@endsection
