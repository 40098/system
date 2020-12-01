@extends('layouts.app')

@section('content')

    @if($errors->any())
    @foreach ($errors->all() as $error)
        {{$error}} <br>
    @endforeach
    @endif
    <script>
    // add product rows
    $(document).ready(function() {
        var wrapper         = $(".container1");
        var add_button      = $(".add_form_field");
    
        var x = 1;
        $(add_button).click(function(e){
            e.preventDefault();
                x++;
                $(wrapper).append('<div class="row"><div class="col-sm-12"><hr></div><div class="col-sm-5"><select name="products[]" class="form-control"><option value="" disabled selected>Kies een product</option>@foreach($products as $product)<option value="{{$product->id}}">{{$product->code}}, {{$product->name}}</option>@endforeach</select></div><div class="col-sm-3"><input type="number" name="amount[]" id="amount" class="form-control" placeholder="aantal"></div><div class="col-sm-3"><input type="number" name="price[]" id="price" class="form-control" placeholder="Prijs per stuk"></div><a href="#" class="delete btn btn-outline-danger">Delete</a>  </div>'); //add input box
        });
    
        $(wrapper).on("click",".delete", function(e){
            e.preventDefault(); $(this).parent('div').remove(); x--;
        })
    });
    </script>
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
                <label for="description">Beschrijving</label>
                <input type="text" name="description" id="description" class="form-control" placeholder="">
            </div>
            <div class="form-group">
                <label for="products">Producten</label>
                <div class="container1">
                    <div class="row">
                        <div class="col-sm-5">
                            <select name="products[]" class="form-control">
                                <option value="" disabled selected>Kies een product</option>
                                @foreach($products as $product)
                                    <option value="{{$product->id}}">{{$product->code}}, {{$product->name}}, {{$product->price}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <input type="number" name="amount[]" id="amount" class="form-control" placeholder="aantal">
                        </div>
                        <div class="col-sm-3">
                            <input type="number" name="price[]" id="price" class="form-control" placeholder="Prijs per stuk">
                        </div>
                        <div class="col-sm-1">
                            <button type="button" class="add_form_field btn btn-outline-primary">Add</button>
                        </div>  
                    </div> 
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
                <input type="submit" class="btn btn-outline-primary" value="Toevoegen">
            </div>
        </div>
    </div>




        
    </form>
@endsection