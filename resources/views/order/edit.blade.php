@extends('layouts.app')

@section('content')

    @if($errors->any())
    @foreach ($errors->all() as $error)
        {{$error}} <br>
    @endforeach
    @endif
    <form name="edit" method="POST" action="/orders/{{$order->id}}">
    @method('PUT')
    @csrf
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Order bewerken</h5>
            <div class="form-group">
                <label for="handed">Ingeleverd</label>
                <input type="text" name="handed" id="nahandedme" class="form-control" value="{{$order->handed}}">
            </div>            
            <div class="form-group">
                <label for="password">Wachtwoord</label>
                <input type="text" name="password" id="password" class="form-control" value="{{$order->password}}">
            </div>
            <div class="form-group">
                <label for="problem">Probleem</label>
                <textarea name="problem" id="problem" class="form-control" rows="3" >{{$order->problem}}</textarea>
            </div>
            <div class="form-group">
                <label for="description">Beschrijving</label>
                <textarea name="description" id="description" class="form-control" rows="3" >{{$order->description}}</textarea>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-6">
                        <label for="price">Prijs</label>
                        <input type="number" step="10" name="price" id="price" class="form-control">
                    </div>
                    <div class="col-sm-6">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="open" @if($order->status== 'open') selected @endif>Open</option>
                            <option value="done" @if($order->status== 'done') selected @endif>Klaar</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group float-right">
                <input type="button" onclick="history.back()" class="btn btn-outline-secondary" value="Terug">
                <input type="submit" class="btn btn-outline-primary" value="Opslaan">
            </div>
        </div>
    </div>

        
    </form>
@endsection