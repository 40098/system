@extends('layouts.app')

@section('content')

    <script>
        $(document).ready(function(){
            $('.createCustomer').hide();

            $("#createCustomer").click(function(){
                $('#searchSelect option').val("none");
                $('.chooseCustomer').hide();
                $('.createCustomer').show();
                $('#name').prop('required',true);
            });
            $("#chooseCustomer").click(function(){
                $('#searchSelect option').val("");
                $('.createCustomer').hide();
                $('.chooseCustomer').show();
                $('#name').removeAttr('required');
            });
            $('#searchSelect').selectize({
                sortField: 'text'
            });
        });
    </script>
    

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
            <div class="form-group chooseCustomer">
                <label for="customer">Klant</label>
                <div class="row">
                    <div class="col-10">
                        <select name="customer" class="form-control" id="searchSelect">
                            <option value="" id="customer" selected>Kies een klant</option>
                            @foreach($customers as $customer)
                                <option value="{{$customer->id}}">{{$customer->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-2">
                        <input type="button" id="createCustomer" class="btn btn-outline-primary float-right" value="Klant toevoegen">
                    </div>
                </div>
            </div>
            <div class="card createCustomer mb-4">
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Naam</label>
                        <div class="row">
                            <div class="col-10">
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                            <div class="col-2">
                                <input type="button" id="chooseCustomer" class="btn btn-outline-primary float-right" value="Klant kiezen">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="mobile_phone">Mobiele telefoon</label>
                                <input type="tel" name="mobile_phone" id="mobile_phone" class="form-control">
                            </div>
                            <div class="col-sm-6">
                                <label for="house_phone">Huis telefoon</label>
                                <input type="tel" name="house_phone" id="house_phone" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="city">Woonplaats</label>
                                <input type="text" name="city" id="city" class="form-control">
                            </div>
                            <div class="col-sm-4">
                                <label for="address">Adres</label>
                                <input type="text" name="address" id="address" class="form-control">
                            </div>
                            <div class="col-sm-4">
                                <label for="zip">Postcode</label>
                                <input type="text" name="zip" id="zip" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="employee">Werknemer</label>
                <select name="employee" class="form-control">
                    @foreach($users as $user)
                        <option value="{{$user->id}}" @if($user->id == Auth::user()->id ) selected @endif>{{$user->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="handed">Ingeleverd</label>
                <input type="text" name="handed" id="handed" class="form-control" placeholder="">
            </div>
            <div class="form-group">
                <label for="password">Wachtwoord</label>
                <input type="text" name="password" id="password" class="form-control" placeholder="">
            </div>
            <div class="form-group">
                <label for="problem">Probleem</label>
                <textarea name="problem" id="problem" class="form-control" rows="3" ></textarea>
            </div>
            <div class="form-group">
                <label for="description">Beschrijving</label>
                <textarea name="description" id="description" class="form-control" rows="3" ></textarea>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-6">
                        <label for="price">Prijs</label>
                        <input type="number" name="price" id="price" class="form-control">
                    </div>
                    <div class="col-sm-6">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                        <option value="open" default selected>Open</option>
                        <option value="done">klaar</option>
                    </div>
                </select>
                </div>
            </div>
            <br>
            <div class="form-check form-control-lg float-left">
                <td><input type="checkbox" id="printLabel" class="form-check-input" name="printLabel" value="1" checked></td>
                <td><label for="printLabel" class=" form-check-label">Print bon?</label></td> 
            </div>
            <div class="form-group float-right">
                <input type="button" onclick="history.back()" class="btn btn-outline-secondary" value="Terug">
                <input type="submit" class="btn btn-outline-primary" value="Opslaan">
            </div>
        </div>
    </div>




        
    </form>
@endsection