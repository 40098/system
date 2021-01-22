@extends('layouts.app')

@section('content')

    @if($errors->any())
    @foreach ($errors->all() as $error)
        {{$error}} <br>
    @endforeach
    @endif
    <form name="new" method="POST" action="/customers">
    @csrf
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Klant Toevoegen</h5>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-4">
                        <label for="first_name">Voornaam</label>
                        <input type="text" name="first_name" id="first_name" class="form-control">
                    </div>
                    <div class="col-sm-4">
                        <label for="insertion_name">Tussenvoegsel</label>
                        <input type="text" name="insertion_name" id="insertion_name" class="form-control">
                    </div>
                    <div class="col-sm-4">
                        <label for="last_name">Achternaam</label>
                        <input type="text" name="last_name" id="last_name" class="form-control">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="company">Bedrijf</label>
                <input type="text" name="company" id="company" class="form-control">
            </div>
            <div class="form-group">
                <label for="mobile_phone">Mobiele telefoon</label>
                <input type="text" name="mobile_phone" id="mobile_phone" class="form-control">
            </div>
            <div class="form-group">
                <label for="house_phone">Huis telefoon</label>
                <input type="text" name="house_phone" id="house_phone" class="form-control">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" class="form-control">
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-4">
                        <label for="address">Adres</label>
                        <input type="text" name="address" id="address" class="form-control">
                    </div>
                    <div class="col-sm-4">
                        <label for="zip">Postcode</label>
                        <input type="text" name="zip" id="zip" class="form-control">
                    </div>
                    <div class="col-sm-4">
                        <label for="city">Woonplaats</label>
                        <input type="text" name="city" id="city" class="form-control">
                    </div>
                </div>
            </div>
            <div class="form-group float-right">
                <a href="/customers" role="button" class="btn btn-outline-secondary">Terug</a>
                <input type="submit" class="btn btn-outline-primary" value="Opslaan">
            </div>
        </div>
    </div>   
    </form>
@endsection