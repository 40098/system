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
            <th scope="col">Nummer</th>
            <th scope="col">Werknemer</th>
            <th scope="col">Ingeleverd</th>
            <th scope="col">Probleem</th>
            <th scope="col">Beschrijving</th>
            <th scope="col">Wachtwoord</th>
            <th scope="col">Aangemaakt</th>
            <th scope="col">Bewerkt</th>
            <th scope="col">Status</th>
        </tr>
    </thead>
    <tbody>

        <br>
        <tr>
            <td>{{$order->order_nr}}</td>
            <td>{{$order->user->name}}</td>
            <td>{{$order->handed}}</td>
            <td>{{$order->problem}}</td>
            <td>{{$order->description}}</td>
            <td>{{$order->password}}</td>
            <td>{{$order->created_at->format('d-m-Y H:i')}}</td>
            <td>{{$order->updated_at->format('d-m-Y H:i')}}</td>
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
        </tbody>
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
                <td>{{$order->customer->name}}</td>
                <td>{{$order->customer->mobile_phone}}</td>
                <td>{{$order->customer->house_phone}}</td>
                <td>{{$order->customer->email}}</td>
                <td>{{$order->customer->address}}</td>
                <td>{{$order->customer->zip}}</td>
                <td>{{$order->customer->city}}</td>
                <td><a href="/customers/{{$order->customer->id}}" class="float-left"><i class="material-icons">build</i></a></td>
            </tr>

            </tbody>
        </table>
    @endif
@endsection