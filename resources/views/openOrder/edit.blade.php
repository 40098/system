@if($errors->any())
@foreach ($errors->all() as $error)
    {{$error}} <br>
@endforeach
@endif
<form name="edit" method="POST" action="{{route('open-orders.update',$order->id)}}">
@method('PUT')
@csrf
<h4 class="card-title">Bewerken</h4>

@empty(!$order->customer)

<div class="form-group">
    <label for="name">Naam</label>
    <input type="text" name="name" id="name" class="form-control" value="{{$order->customer->name}}">
</div>
<div class="form-group">
    <div class="row">
        <div class="col-sm-4">
            <label for="mobile_phone">Mobiele telefoon</label>
            <input type="text" name="mobile_phone" id="mobile_phone" class="form-control" value="{{$order->customer->mobile_phone}}">
        </div>
        <div class="col-sm-4">
            <label for="house_phone">Huis telefoon</label>
            <input type="text" name="house_phone" id="house_phone" class="form-control" value="{{$order->customer->house_phone}}">
        </div>
        <div class="col-sm-4">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" class="form-control" value="{{$order->customer->email}}">
        </div>
    </div>
</div>
<div class="form-group">
    <div class="row">
        <div class="col-sm-4">
            <label for="city">Woonplaats</label>
            <input type="text" name="city" id="city" class="form-control" value="{{$order->customer->city}}">
        </div>
        <div class="col-sm-4">
            <label for="address">Adres</label>
            <input type="text" name="address" id="address" class="form-control" value="{{$order->customer->address}}">
        </div>
        <div class="col-sm-4">
            <label for="zip">Postcode</label>
            <input type="text" name="zip" id="zip" class="form-control" value="{{$order->customer->zip}}">
        </div>
    </div>
</div>

@endempty

<div class="form-group">
    <div class="row">
        <div class="col-sm-6">
            <label for="price">Prijs</label>
            <input type="number" name="price" id="price" class="form-control" value="{{$order->price}}">
        </div>
        <div class="col-sm-6">
            <label for="password">Wachtwoord</label>
            <input type="text" name="password" id="password" class="form-control" value="{{$order->password}}">
        </div>
    </div>
</div>
<div class="form-group">
    <label for="handed">Ingeleverd</label>
    <input type="text" name="handed" id="handed" class="form-control" value="{{$order->handed}}">
</div>            
<div class="form-group">
    <label for="problem">Probleem</label>
    <textarea name="problem" id="problem" class="form-control" rows="3" >{{$order->problem}}</textarea>
</div>
<div class="form-group">
    <label for="description">Beschrijving</label>
    <textarea name="description" id="description" class="form-control" rows="3" >{{$order->description}}</textarea>
</div>
<div class="form-group float-right">
    <input type="button" data-dismiss="modal" class="btn btn-outline-secondary" value="Terug">
    <input type="submit" class="btn btn-outline-primary" value="Opslaan">
</div>    
</form>