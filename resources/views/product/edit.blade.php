@extends('layouts.app')

@section('content')

    @if($errors->any())
    @foreach ($errors->all() as $error)
        {{$error}} <br>
    @endforeach
    @endif
    <form name="new" method="POST" action="/products/{{$product->id}}">
    @method('PUT')
    @csrf
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Product Toevoegen</h5>
            <div class="form-group">
                <label for="code">Code</label>
                <input type="number" name="code" id="code" class="form-control" value="{{$product->code}}" required>
            </div>
            <div class="form-group">
                <label for="name">Naam</label>
                <input type="text" name="name" id="name" class="form-control" value="{{$product->name}}" required>
            </div>
            <div class="form-group">
                <label for="price">Prijs</label>
                <input type="number" name="price" id="price" class="form-control" value="{{$product->price}}" step="any">
            </div>
            <div class="form-group float-right">
                <a href="/products" role="button" class="btn btn-outline-secondary">Terug</a>
                <input type="submit" class="btn btn-outline-primary" value="Opslaan">
            </div>
        </div>
    </div>




        
    </form>
@endsection