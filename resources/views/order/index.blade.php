@extends('layouts.app')

@section('content')

    @if(Session::has('message'))
        <p class="alert alert-info">{{ Session::get('message') }}</p>
    @endif

    <a href="/orders/create" role="button" class="btn btn-outline-primary">Toevoegen</a>
    <table class="table mt-4">
    <thead>
        <tr>
            <th scope="col">Werknemer</th>
            <th scope="col">Klant</th>
            <th scope="col">Ingeleverd</th>
            <th scope="col">Probleem</th>
            <th scope="col">Beschrijving</th>
            <th scope="col">Wachtwoord</th>
            <th scope="col">Status</th>
            <th scope="col">Details</th>
        </tr>
    </thead>
    <tbody>

    @foreach($orders as $order)
        <tr>
            <td>{{$order->user->name}}</td>
            <td>@if($order->customer){{$order->customer->first_name}} {{$order->customer->insertion_name}} {{$order->customer->last_name}}, {{$order->customer->company}}@endif</td>
            <td>{{$order->handed}}</td>
            <td>{{$order->problem}}</td>
            <td>{{$order->description}}</td>
            <td>{{$order->password}}</td>
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
            <td><a href="/orders/{{$order->id}}" class="d-flex justify-content-center"><i class="material-icons">build</i></a></td>
        </tr>
    @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $orders->links() }}
    </div>
@endsection