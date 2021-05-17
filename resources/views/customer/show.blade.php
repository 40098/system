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
                <form name="del" method="POST" action="/customers/{{$customer->id}}">
                    @method('DELETE')
                    @csrf
                    <input type="submit" class="btn btn-outline-danger" value="Verwijderen">
                </form>
            </div>
        </div>
    </div>
    <br><h4>Klant</h4>
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
        </tr>
    </thead>
    <tbody>
        <br>
        <tr>
            <td>{{$customer->name}}</td>
            <td>{{$customer->mobile_phone}}</td>
            <td>{{$customer->house_phone}}</td>
            <td>{{$customer->email}}</td>
            <td>{{$customer->address}}</td>
            <td>{{$customer->zip}}</td>
            <td>{{$customer->city}}</td>
        </tr>

        </tbody>
    </table>
    <h4>Orders</h4>
    <table class="table">
    <thead>
        <tr>
            <th scope="col">Nummer</th>
            <th scope="col">Probleem</th>
            <th scope="col">Beschrijving</th>
            <th scope="col">Status</th>
            <th scope="col">Aangemaakt</th>
            <th scope="col">Bewerkt</th>
            <th scope="col">Details</th>
        </tr>
    </thead>
    <tbody>

    @foreach($customer->orders as $order)
        <tr>
            <td>{{$order->order_nr}}</td>
            <td>{{$order->problem}}</td>
            <td>{{$order->description}}</td>
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
            <td>{{$order->created_at->format('d-m-Y H:i')}}</td>
            <td>{{$order->updated_at->format('d-m-Y H:i')}}</td>
            <td>
                <a href="/orders/{{$order->id}}/edit"><i class="material-icons">edit</i></a>
                <a href="/orders/{{$order->id}}/done"><i class="material-icons">done_outline</i></a>
                <a href="/orders/{{$order->id}}"><i class="material-icons">build</i></a>
            </td>
        </tr>
    @endforeach
        </tbody>
    </table>
@endsection