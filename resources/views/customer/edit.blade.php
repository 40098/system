@extends('layouts.app')

@section('content')

    @if($errors->any())
    @foreach ($errors->all() as $error)
        {{$error}} <br>
    @endforeach
    @endif
    <form name="new" method="POST" action="/customers/{{$customer->id}}">
    @method('PUT')
    @csrf
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Klant bewerken</h5>
            <div class="form-group">
                <label for="name">Naam</label>
                <input type="text" name="name" id="name" class="form-control" value="{{$customer->name}}">
            </div>
            <div class="form-group">
                <label for="mobile_phone">Mobiele telefoon</label>
                <input type="text" name="mobile_phone" id="mobile_phone" class="form-control" value="{{$customer->mobile_phone}}">
            </div>
            <div class="form-group">
                <label for="house_phone">Huis telefoon</label>
                <input type="text" name="house_phone" id="house_phone" class="form-control" value="{{$customer->house_phone}}">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" class="form-control" value="{{$customer->email}}">
            </div>
            <div class="form-group">
                <label for="address">Adres</label>
                <input type="text" name="address" id="address" class="form-control" value="{{$customer->address}}">
            </div>
            <div class="form-group">
                <label for="zip">Postcode</label>
                <input type="text" name="zip" id="zip" class="form-control" value="{{$customer->zip}}">
            </div>
            <div class="form-group">
                <label for="city">Woonplaats</label>
                <input type="text" name="city" id="city" class="form-control" value="{{$customer->city}}">
            </div>
            <div class="form-group float-right">
                <input type="button" onclick="history.back()" class="btn btn-outline-secondary" value="Terug">
                <input type="submit" class="btn btn-outline-primary" value="Opslaan">
            </div>
        </div>
    </div>




        
    </form>
@endsection