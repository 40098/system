@extends('layouts.app')

@section('content')

    @if(Session::has('message'))
        <p class="alert alert-info">{{ Session::get('message') }}</p>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-2">
                <form name="del" method="POST" action="/products/{{$product->id}}">
                    @method('DELETE')
                    @csrf
                    <input type="submit" class="btn btn-outline-danger" value="Verwijderen">
                </form>
            </div>
            <div class="col-2">
                <a href="/products/{{$product->id}}/edit" role="button" class="btn btn-outline-primary" >Bewerken</a>
            </div>
        </div>
    </div>
    <br><h4>Product</h4>
    <table class="table">
    <thead>
        <tr>
            <th scope="col">Code</th>
            <th scope="col">Naam</th>
            <th scope="col">Prijs</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{$product->code}}</td>
            <td>{{$product->name}}</td>
            <td>{{$product->price}}</td>
        </tr>

        </tbody>
    </table>
    @if(!$product->orders->isEmpty())
        <h4>Orders</h4>
        <table class="table">
        <thead>
            <tr>
                <th scope="col">Werknemer</th>
                <th scope="col">Klant</th>
                <th scope="col">Ingeleverd</th>
                <th scope="col">Beschrijving</th>
                <th scope="col">Product(en)</th>
                <th scope="col">Status</th>
                <th scope="col">Details</th>
            </tr>
        </thead>
        <tbody>

        @foreach($product->orders as $order)
            <tr>
                <td>{{$order->user->name}}</td>
                <td>
                    @if ($order->customer)
                        {{$order->customer->first_name}} 
                        {{$order->customer->insertion_name}} 
                        {{$order->customer->last_name}}
                        , 
                        {{$order->customer->company}}</td>
                    @endif
                <td>{{$order->handed}}</td>
                <td>{{$order->description}}</td>
                <td>
                    @foreach($order->products as $product)
                    {{$product->name}}
                    @endforeach
                </td>
                <td>
                    @switch ($order->status)
                        @case('open')
                            Open
                            @break
                        @case('done')
                            Klaar
                            @break
                    @endswitch
                </td>
                <td><a href="/orders/{{$order->id}}" class="float-left"><i class="material-icons">build</i></a></td>
            </tr>
        @endforeach
            </tbody>
        </table>
    @endif
@endsection