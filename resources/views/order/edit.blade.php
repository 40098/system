@extends('layouts.app')

@section('content')

    @if($errors->any())
    @foreach ($errors->all() as $error)
        {{$error}} <br>
    @endforeach
    @endif
    <form name="new" method="POST" action="/orders/{{$order->id}}">
    @method('PUT')
    @csrf
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Order Toevoegen</h5>
            <div class="form-group">
                <label for="name">Naam</label>
                <input type="text" name="name" id="name" class="form-control" value="{{$order->name}}">
            </div>
            <div class="form-group">
                <label for="handed">Ingeleverd</label>
                <input type="text" name="handed" id="nahandedme" class="form-control" value="{{$order->handed}}">
            </div>
            <div class="form-group">
                <label for="description">Beschrijving</label>
                <input type="text" name="description" id="description" class="form-control" value="{{$order->description}}">
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="0" @if($order->status===0) selected @endif>Bezig</option>
                    <option value="1" @if($order->status===1) selected @endif>Klaar</option>
                    <option value="2" @if($order->status===2) selected @endif>Stilgezet</option>
                    <option value="3" @if($order->status===3) selected @endif>Vastgelopen</option>
                </select>
            </div>
            <div class="form-group float-right">
                <a href="/orders" role="button" class="btn btn-outline-secondary">Terug</a>
                <input type="submit" class="btn btn-outline-primary" value="Toevoegen">
            </div>
        </div>
    </div>

        
    </form>
@endsection