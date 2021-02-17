@extends('layouts.app')

@section('content')

    @if(Session::has('message'))
        <p class="alert alert-info">{{ Session::get('message') }}</p>
    @endif

    <a href="/customers/create" role="button" class="btn btn-outline-primary">Toevoegen</a><br/>
    <table class="table mt-4">
    <thead>
        <tr>
            <th scope="col">@sortablelink('name', 'Naam')</th>
            <th scope="col">@sortablelink('city', 'Woonplaats')</th>
            <th scope="col">Telefoonnummer</th>
            <th scope="col">@sortablelink('created_at', 'Aangemaakt')</th>
            <th scope="col">@sortablelink('updated at', 'Bewerkt')</th>
            <th scope="col">Details</th>
        </tr>
    </thead>
    <tbody>

    @foreach($customers as $customer)
        <tr>
            <td>{{$customer->name}}</td>
            <td>{{$customer->city}}</td>
            <td>{{$customer->mobile_phone}} {{$customer->house_phone}}</td>
            <td>{{$customer->created_at->format('d-m-Y')}}</td>
            <td>{{$customer->updated_at->format('d-m-Y')}}</td>
            <td><a href="/customers/{{$customer->id}}" class="float-left"><i class="material-icons">build</i></a></td>
        </tr>

    @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $customers->links() }}
    </div>
@endsection