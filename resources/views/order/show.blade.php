@extends('layouts.app')

@section('content')

    @if(Session::has('message'))
        <p class="alert alert-info">{{ Session::get('message') }}</p>
    @endif
    <div class="container">
        <div class="row">
            <div class="pr-2">
                <input type="button" onclick="history.back()" class="btn btn-outline-secondary" value="Terug">
            </div>
            <div class="px-2">
                <a href="/orders/{{$order->id}}/edit" class="btn btn-outline-warning">Bewerken</a>
            </div>
            <div class="px-2">
                <form name="del" method="POST" action="/orders/{{$order->id}}">
                    @method('DELETE')
                    @csrf
                    <input type="submit" class="btn btn-outline-danger" value="Verwijderen">
                </form>
            </div>
        </div>
    </div>
    <br><h4>Order</h4>
    <table class="table">
        <tr>
            <th scope="row" width="15%">Nummer</th>
            <td>{{$order->order_nr}}</td>
        </tr>
        <tr>
            <th scope="row">Werknemer</th>
            <td>{{$order->user->name}}</td>
        </tr>
        <tr>
            <th scope="row">Ingeleverd</th>
            <td>{{$order->handed}}</td>
        </tr>
        <tr>
            <th scope="row">Probleem</th>
            <td>{{$order->problem}}</td>
        </tr>
        <tr>
            <th scope="row">Beschrijving</th>
            <td>{{$order->description}}</td>
        </tr>
        <tr>
            <th scope="row">Prijs</th>
            <td>{{$order->price}}</td>
        </tr>
        <tr>
            <th scope="row">Wachtwoord</th>
            <td>{{$order->password}}</td>
        </tr>
        <tr>
            <th scope="row">Aangemaakt</th>
            <td>{{$order->created_at->format('d-m-Y H:i')}}</td>
        </tr>
        <tr>
            <th scope="row">Bewerkt</th>
            <td>{{$order->updated_at->format('d-m-Y H:i')}}</td>
        </tr>
        <tr>
            <th scope="row">Status</th>
            <td>
                @switch ($order->status)
                    @case("open")
                        Open
                    @break
                    @case("done")
                        Klaar
                    @break
                @endswitch
            </td>
        </tr>         
    </table>
    @if($order->customer)
        <h4>Klant</h4>
        <table class="table">
        <thead>
            <tr>
                <th scope="col">Naam</th>
                <th scope="col">Mobiele telefoon</th>
                <th scope="col">Huis telefoon</th>
                <th scope="col">Email</th>
                <th scope="col">Adres</th>
                <th scope="col">Postcode</th>
                <th scope="col">Woonplaats</th>
                <th scope="col">Details</th>
            </tr>
        </thead>
        <tbody>
            <br>
            <tr>
                <td class="text-truncate">{{$order->customer->name}}</td>
                <td>{{$order->customer->mobile_phone}}</td>
                <td>{{$order->customer->house_phone}}</td>
                <td class="text-truncate"><a href="mailto:{{$order->customer->email}}">{{$order->customer->email}}</a></td>
                <td class="text-truncate">{{$order->customer->address}}</td>
                <td class="text-truncate">{{$order->customer->zip}}</td>
                <td class="text-truncate">{{$order->customer->city}}</td>
                <td>
                    <a href="/customers/{{$order->customer->id}}/edit" class="float-left"><i class="material-icons">edit</i></a>
                    <a href="/customers/{{$order->customer->id}}" class="float-left"><i class="material-icons">build</i></a>
                </td>
            </tr>

            </tbody>
        </table>
    @endif
@endsection