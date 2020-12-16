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
            <h5 class="card-title">Order bewerken</h5>
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
                    <option value="open" @if($order->status== 'open') selected @endif>Open</option>
                    <option value="done" @if($order->status== 'done') selected @endif>Klaar</option>
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