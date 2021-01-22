@extends('layouts.app')

@section('content')

    @if($errors->any())
    @foreach ($errors->all() as $error)
        <span class="text-danger form-text">{{$error}} </span><br>
    @endforeach
    @endif
    <form name="new" method="POST" action="/orders">
    @csrf
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Order Toevoegen</h5>
            <div class="form-group">
               <label for="customer">Klant</label>
                <select name="customer" class="form-control">
                    <option value="" disabled selected>Kies een klant</option>
                    @foreach($customers as $customer)
                        <option value="{{$customer->id}}">{{$customer->first_name}} {{$customer->insertion_name}} {{$customer->last_name}}, {{$customer->company}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="handed">Ingeleverd</label>
                <input type="text" name="handed" id="handed" class="form-control" placeholder="">
            </div>
            <div class="form-group">
                <label for="problem">Probleem</label>
                <input type="text" name="problem" id="problem" class="form-control" placeholder="">
            </div>
            <div class="form-group">
                <label for="description">Beschrijving</label>
                <input type="text" name="description" id="description" class="form-control" placeholder="">
            </div>
            <div class="form-group">
                <label for="password">Wachtwoord</label>
                <input type="text" name="password" id="password" class="form-control" placeholder="">
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="open" default selected>Open</option>
                    <option value="done">klaar</option>
                </select>
            </div>
            <div class="form-group float-right">
                <a href="/orders" role="button" class="btn btn-outline-secondary">Terug</a>
                <input type="submit" class="btn btn-outline-primary" value="Opslaan">
            </div>
        </div>
    </div>




        
    </form>
@endsection