@extends('layouts.app')

@section('content')

    @if(Session::has('message'))
        <p class="alert alert-info">{{ Session::get('message') }}</p>
    @endif
    <div class="container">
        <div class="row">
            <div class="pr-2">
                <a href="/orders" role="button" class="btn btn-outline-secondary">Terug</a>
            </div>
            <div class="px-2">
                <form name="del" method="POST" action="/orders/{{$order->id}}">
                    @method('DELETE')
                    @csrf
                    <input type="submit" class="btn btn-outline-danger" value="Verwijderen">
                </form>
            </div>
            <div class="px-2">
                <a href="/orders/{{$order->id}}/edit" role="button" class="btn btn-outline-primary" >Bewerken</a>
            </div>
        </div>
    </div>
    <h4 class="mt-3">Order</h4>
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
    @if($order->calls)
        <h4>Gebeld</h4>
        <table class="table">
        <thead>
            <tr>
                <th scope="col">Status</th>
                <th scope="col">Bericht</th>
                <th scope="col">Aangemaakt</th>
                <th scope="col">Bewerkt</th>
            </tr>
        </thead>
        <tbody>
        @foreach($order->calls as $call)
        <tr>
            <td>
                @switch ($call->status)
                @case("spoken")
                Gesproken
                @break
                @case("voicemail")
                Voicemail ingesproken
                @break
                @case("ignored")
                Niet opgenomen
                @break
                @endswitch
            </td>
            <td>{{$call->message}}</td>
            <td>{{$order->created_at->format('d-m-Y H:i')}}</td>
            <td>{{$order->updated_at->format('d-m-Y H:i')}}</td>
        </tr>
    @endforeach
        </tbody>
    </table>
    @endif
    @endsection