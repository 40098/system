@extends('layouts.app')

@section('content')
    @if(Session::has('message'))
        <p class="alert alert-info">{{ Session::get('message') }}</p>
    @endif
    <div class=" float-left">
        <a href="/orders/create" role="button" class="btn btn-outline-primary">Toevoegen</a>
    </div>
    <div class=" float-right pr-2">
        <form action="/orders/search" method="POST">
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

    <table class="table table-responsive-sm table-striped table-mt-4" id="table">
    <thead>
        <tr>
            <th scope="col">@sortablelink('order_nr', 'Nummer')</th>
            <th scope="col">@sortablelink('customer.name', 'Klant')</th>
            <th scope="col">@sortablelink('description', 'Beschrijving')</th>
            <th class="d-md-none" scope="col">@sortablelink('created_at', 'Aangemaakt')</th>
            <th class="d-md-none" scope="col">@sortablelink('updated at', 'Bewerkt')</th>
            <th scope="col">Details</th>
        </tr>
    </thead>
    <tbody>

    @foreach($orders as $order)
        <tr data-toggle="collapse" data-target="#demo{{$order->id}}" data-parent="#table" class="accordion-toggle">
            <td>{{$order->order_nr}}</td>
            <td class="text-truncate">@if($order->customer){{$order->customer->name}}@endif</td>
            <td class="text-truncate" width>{{$order->description}}</td>
            <td class="d-md-none">{{$order->created_at->format('d-m-Y')}}</td>
            <td class="d-md-none">{{$order->updated_at->format('d-m-Y')}}</td>
            <td>
                <a href="{{route('open-orders.edit',$order->id)}}" class="open-modal" data-toggle="modal" data-target="#largeModal" data-attr="{{route('open-orders.edit',$order->id)}}"><i class="material-icons">edit</i></a>
                <a href="/orders/{{$order->id}}/done"><i class="material-icons">done_outline</i></a>
                <a href="/orders/{{$order->id}}"><i class="material-icons">build</i></a>
                <a href="/orders/{{$order->id}}/printer" class="open-modal" data-toggle="modal" data-target="#largeModal" data-attr="/orders/{{$order->id}}/printer"><i class="material-icons">print</i></a>
            </td>
        </tr>
        <tr>
        </tr>
        <tr>
            <td colspan="6" class="hiddenRow">
                <div data-parent="#table" class="accordian-body collapse" id="demo{{$order->id}}">
                    <div class="card-group">
                        <div class="card">
                            <div class="card-body">
                                @empty(!$order->password)
                                    <b>Wachtwoord:</b>
                                    <span>{{$order->password}}</span>
                                @endempty
                                @empty(!$order->price)
                                    <br><b>Prijs:</b>
                                    <span> {{$order->price}}</span>
                                @endempty
                                @empty(!$order->user->name)
                                    <br><b>Werknemer:</b>
                                    <span>{{$order->user->name}}</span>
                                @endempty
                                @empty(!$order->handed)
                                    <br><b>Ingeleverd:</b>
                                    <span>{{$order->handed}}</span>
                                @endempty
                                @empty(!$order->problem)
                                    <br><b>Probleem:</b>
                                    <span>{{$order->problem}}</span>
                                @endempty
                                @empty(!$order->description)
                                    <br><b>Beschrijving:</b>
                                    <span>{{$order->description}}</span>
                                @endempty
                            </div>
                        </div>
                        @empty(!$order->customer)
                        <div class="card">
                            <div class="card-body">
                                @empty(!$order->customer->name)
                                    <b>Naam:</b>
                                    <span>{{$order->customer->name}}</span>
                                @endempty
                                @empty(!$order->customer->city)
                                    <br><b>Woonplaats:</b>
                                    <span>{{$order->customer->city}}</span>
                                @endempty
                                @empty(!$order->customer->address)
                                    <br><b>Adres:</b>
                                    <span>{{$order->customer->address}}</span>
                                @endempty
                                @empty(!$order->customer->zip)
                                    <br><b>Postcode:</b>
                                    <span>{{$order->customer->zip}}</span>
                                @endempty
                                @empty(!$order->customer->email)
                                    <br><b>Email:</b>
                                    <span>{{$order->customer->email}}</span>
                                @endempty
                                @empty(!$order->customer->house_phone)
                                    <br><b>Vaste telefoon:</b>
                                    <span>{{$order->customer->house_phone}}</span>
                                @endempty
                                @empty(!$order->customer->mobile_phone)
                                    <br><b>Mobiele telefoon:</b>
                                    <span>{{$order->customer->mobile_phone}}</span>
                                @endempty
                            </div>
                        </div>
                        @endempty
                    </div>
                </div> 
            </td>
        </tr>
    @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $orders->links() }}
    </div>
@endsection