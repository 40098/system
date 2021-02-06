@extends('layouts.app')

@section('content')

    @if(Session::has('message'))
        <p class="alert alert-info">{{ Session::get('message') }}</p>
    @endif

    <a href="/customers/create" role="button" class="btn btn-outline-primary">Toevoegen</a><br/>
    <table class="table mt-4">
    <thead>
        <tr>
            <th scope="col">Naam</th>
            <th scope="col">Bedrijf</th>
            <th scope="col">Woonplaats</th>
            <th scope="col">Details</th>
        </tr>
    </thead>
    <tbody>

    @foreach($customers as $customer)
        <tr>
            <td>{{$customer->first_name}} {{$customer->insertion_name}} {{$customer->last_name}}</td>
            <td>{{$customer->company}}</td>
            <td>{{$customer->city}}</td>
            <td><a href="/customers/{{$customer->id}}" class="float-left"><i class="material-icons">build</i></a></td>
        </tr>

    @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $customers->links() }}
    </div>
@endsection