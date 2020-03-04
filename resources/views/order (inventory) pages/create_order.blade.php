@extends('layouts.app-inventory')

@section('content')
<div class="container">
    <div class="col-md-12">
        <div class="card-header">
            <h1 class="title">Create an order</h1>
        </div>
        <div class="card shadow">
            <div class="card-body">
                <form method="POST" action="{{ route('create_order') }}" class="was-validated">
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
                        <label class="form" for="title">Title</label>
                        <input type="text" id="title" class="form-control" name="title" value="" autocomplete="" autofocus placeholder="Order title">
                    </div>
                    <div class="form-group">
                        <label class="form" for="description">Description</label>
                        <textarea type="text" id="description" class="form-control" name="description" value="" autocomplete="" placeholder="Enter a discription here" style="max-height: 250px"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form" for="due">Due date</label>
                        <input type="text" id="due" class="form-control mb-3 readonly" readonly name="due" placeholder="Gebruik onderstaande &quot;Date picker&quot;"/>
                    </div>
                    <div class="form-group">
                        <label class="form" for="status">Status</label>
                        <select class="form-control" name="status" id="status" required>
                            @if(@isset($status) && @count($status) > 0)
                                @foreach($status as $Status)
                                    <option value="{{ $Status->id }}"> {{ $Status->name }}</option>
                                @endforeach
                            @else
                                <option value="null">No status available</option>
                            @endif
                        </select>
                    </div>
                    <button type="submit" class="btn btn-hawkeye-add">Add</button>
                </form>
                @foreach($devices as $device)
                    <li class= "category-item" name= '{{$device->id}}' value="{{ $device->id }}">{{ $device->name }}</li>
                @endforeach
            </div>
        </div>
    </div>
</div>
<script>
    $( document ).ready(function() {
        var picker = new Lightpick({
            field: document.getElementById('due'),
            inline: true,
            numberOfMonths: 3,
            numberOfColumns: 3,
        });
        $(".readonly").keydown(function(e){
            e.preventDefault();
        });
    });
</script>

@endsection
