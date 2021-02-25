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
                    <input type="submit" class="btn btn-outline-secondary" value="Zoeken">
                </div>
            </div>
        </form>
    </div>
    <table class="table mt-4">
    <thead>
        <tr>
            <th scope="col">@sortablelink('order_nr', 'Nummer')</th>
            <th scope="col">@sortablelink('customer.name', 'Klant')</th>
            <th scope="col">@sortablelink('problem', 'Probleem')</th>
            <th scope="col">@sortablelink('description', 'Beschrijving')</th>
            <th scope="col">@sortablelink('status', 'Status')</th>
            <th scope="col">@sortablelink('created_at', 'Aangemaakt')</th>
            <th scope="col">@sortablelink('updated at', 'Bewerkt')</th>
            <th scope="col">Details</th>
        </tr>
    </thead>
    <tbody>

    @forelse($orders as $order)
        <tr>
            <td>{{$order->order_nr}}</td>
            <td>@if($order->customer){{$order->customer->name}}@endif</td>
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
                <a href="/orders/{{$order->id}}/done"><i class="material-icons">done_outline</i></a>
                <a href="/orders/{{$order->id}}"><i class="material-icons">build</i></a>
            </td>
        </tr>
    @empty
        </tbody>
        </table>
        <span class="d-flex justify-content-center">Er zijn geen gegevens gevonden!</span>
    @endforelse
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $orders->links() }}
    </div>
@endsection