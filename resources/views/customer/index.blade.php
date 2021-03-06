@extends('layouts.app')

@section('content')

    @if(Session::has('message'))
        <p class="alert alert-info">{{ Session::get('message') }}</p>
    @endif

    <div class=" float-left">
        <a href="/customers/create" role="button" class="btn btn-outline-primary">Toevoegen</a>
    </div>
    <div class=" float-right pr-2">
        <form action="/customers/search" method="POST">
            <div class=" form-group row">
                <div class="px-2">
                    @csrf
                    <input type="text" class="form-control" name="search" placeholder="Typ hier...">
                </div>
                <div class="px-2">
                    <input type="submit" class="btn btn-outline-success" value="Zoeken">
                </div>
            </div>
        </form>
    </div>
    <table class="table mt-4">
    <thead>
        <tr>
            <th scope="col">@sortablelink('name', 'Naam')</th>
            <th scope="col">@sortablelink('city', 'Woonplaats')</th>
            <th scope="col">Mobiele telefoon</th>
            <th scope="col">Huis telefoon</th>
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
            <td>{{$customer->mobile_phone}}</td>
            <td>{{$customer->house_phone}}</td>
            <td>{{$customer->created_at->format('d-m-Y H:i')}}</td>
            <td>{{$customer->updated_at->format('d-m-Y H:i')}}</td>
            <td>
                <a href="/customers/{{$customer->id}}/edit" class="float-left"><i class="material-icons">edit</i></a>
                <a href="/customers/{{$customer->id}}" class="float-left"><i class="material-icons">build</i></a>
            </td>
        </tr>

    @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $customers->links() }}
    </div>
@endsection