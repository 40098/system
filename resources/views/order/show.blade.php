@extends('layouts.app')

@section('content')

    @if(Session::has('message'))
        <p class="alert alert-info">{{ Session::get('message') }}</p>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-2">
                <form name="del" method="POST" action="/orders/{{$order->id}}">
                    @method('DELETE')
                    @csrf
                    <input type="submit" class="btn btn-outline-danger" value="Verwijderen">
                </form>
            </div>
            <div class="col-2">
                <a href="/orders/{{$order->id}}/edit" role="button" class="btn btn-outline-primary" >Bewerken</a>
            </div>
        </div>
    </div>
    <br><h4>Order</h4>
    <table class="table">
    <thead>
        <tr>
            <th scope="col">Werknemer</th>
            <th scope="col">Ingeleverd</th>
            <th scope="col">Beschrijving</th>
            <th scope="col">Status</th>
        </tr>
    </thead>
    <tbody>

        <br>
        <tr>
            <td>{{$order->user->name}}</td>
            <td>{{$order->handed}}</td>
            <td>{{$order->description}}</td>
            <td>
                @switch ($order->status)
                    @case(0)
                        Bezig
                        @break
                    @case(1)
                        Klaar
                        @break
                    @case(2)
                        Stilgezet
                        @break
                    @case(3)
                        Vastgelopen
                        @break
                @endswitch
            </td>
        </tr>
        </tbody>
    </table>
    <h4>Producten</h4>
    <table class="table">
    <thead>
        <tr>
            <th scope="col">Code</th>
            <th scope="col">Naam</th>
            <th scope="col">Prijs</th>
            <th scope="col">aantal</th>
        </tr>
    </thead>
    <tbody>

    @foreach($order->products as $product)
        <br>
        <tr>
            <td>{{$product->code}}</td>
            <td>{{$product->name}}</td>
            <td>{{$product->pivot->price}}</td>
            <td>{{$product->pivot->amount}}</td>
        </tr>

    @endforeach
        </tbody>
    </table>
    <h4>Klant</h4>
    <table class="table">
    <thead>
        <tr>
            <th scope="col">Naam</th>
            <th scope="col">Bedrijf</th>
            <th scope="col">Mobiele telefoon</th>
            <th scope="col">Huis telefoon</th>
            <th scope="col">Email</th>
            <th scope="col">Adres</th>
            <th scope="col">Postcode</th>
            <th scope="col">Woonplaats</th>
        </tr>
    </thead>
    <tbody>
        <br>
        <tr>
            <td>{{$order->customer->first_name}} {{$order->customer->insertion_name}} {{$order->customer->last_name}}</td>
            <td>{{$order->customer->company}}</td>
            <td>{{$order->customer->mobile_phone}}</td>
            <td>{{$order->customer->house_phone}}</td>
            <td>{{$order->customer->email}}</td>
            <td>{{$order->customer->address}}</td>
            <td>{{$order->customer->zip}}</td>
            <td>{{$order->customer->city}}</td>
        </tr>

        </tbody>
    </table>
@endsection