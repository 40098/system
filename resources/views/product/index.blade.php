@extends('layouts.app')

@section('content')

    @if(Session::has('message'))
        <p class="alert alert-info">{{ Session::get('message') }}</p>
    @endif

    <a href="/products/create" role="button" class="btn btn-outline-primary">Toevoegen</a><br/>
    <table class="table">
    <thead>
        <tr>
            <th scope="col">Code</th>
            <th scope="col">Naam</th>
            <th scope="col">Prijs</th>
            <th scope="col">Details</th>
        </tr>
    </thead>
    <tbody>

    @foreach($products as $product)
        <br>
        <tr>
            <td>{{$product->code}}</td>
            <td>{{$product->name}}</td>
            <td>{{$product->price}}</td>
            <td><a href="/products/{{$product->id}}" class="d-flex justify-content-center"><i class="material-icons">build</i></a></td>
        </tr>

    @endforeach
        </tbody>
    </table>
@endsection