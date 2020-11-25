@extends('layouts.app')

@section('content')

    @if(Session::has('message'))
        <p class="alert alert-info">{{ Session::get('message') }}</p>
    @endif

    <a href="/customers/create" role="button" class="btn btn-outline-primary">Toevoegen</a><br/>
    <table class="table">
    <thead>
        <tr>
            <th scope="col">Naam</th>
            <th scope="col">Bedrijf</th>
            <th scope="col">city</th>
            <th scope="col">Details</th>
        </tr>
    </thead>
    <tbody>

    @foreach($customers as $customer)
        <br>
        <tr>
            <td>{{$customer->first_name}} {{$customer->insertion_name}} {{$customer->last_name}}</td>
            <td>{{$customer->company}}</td>
            <td>{{$customer->city}}</td>
            <td><a href="/customers/{{$customer->id}}" class="d-flex justify-content-center"><i class="material-icons">build</i></a></td>
        </tr>

    @endforeach
        </tbody>
    </table>
@endsection