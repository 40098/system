@if($errors->any())
@foreach ($errors->all() as $error)
    {{$error}} <br>
@endforeach
@endif
<form name="edit" method="POST" action="{{route('orders.print-label',$order->id)}}">
@method('POST')
@csrf
<h4 class="card-title">Print Label</h4>

<div class="form-check">
    <td><input type="checkbox" id="order_nr" class="form-check-input" name="order_nr" value="1" checked></td>
    <td><label for="order_nr" class=" form-check-label">Nummer : {{$order->order_nr}}</label></td> 
</div>

@empty(!$order->customer)

<div class="form-check">
    <td><input type="checkbox" id="name" class="form-check-input" name="name" value="1" checked></td>
    <td><label for="name" class=" form-check-label">Naam : {{$order->customer->name}}</label></td> 
</div>

<div class="form-check">
    <td><input type="checkbox" id="mobile_phone" class="form-check-input" name="mobile_phone" value="1"></td>
    <td><label for="mobile_phone" class=" form-check-label">Mobiele telefoon : {{$order->customer->mobile_phone}}</label></td> 
</div>

<div class="form-check">
    <td><input type="checkbox" id="house_phone" class="form-check-input" name="house_phone" value="1"></td>
    <td><label for="house_phone" class=" form-check-label">Huis telefoon : {{$order->customer->house_phone}}</label></td> 
</div>

<div class="form-check">
    <td><input type="checkbox" id="email" class="form-check-input" name="email" value="1"></td>
    <td><label for="email" class=" form-check-label">Email : {{$order->customer->email}}</label></td> 
</div>

@endempty

<div class="form-check">
    <td><input type="checkbox" id="price" class="form-check-input" name="price" value="1"></td>
    <td><label for="price" class=" form-check-label">Prijs : {{$order->price}}</label></td> 
</div>

<div class="form-check">
    <td><input type="checkbox" id="password" class="form-check-input" name="password" value="1" checked></td>
    <td><label for="password" class=" form-check-label">Wachtwoord : {{$order->password}}</label></td> 
</div>

<div class="form-check">
    <td><input type="checkbox" id="handed" class="form-check-input" name="handed" value="1"></td>
    <td><label for="handed" class=" form-check-label">Ingeleverd : {{$order->handed}}</label></td> 
</div>

<div class="form-check">
    <td><input type="checkbox" id="problem" class="form-check-input" name="problem" value="1"></td>
    <td><label for="problem" class=" form-check-label">Probleem : {{$order->problem}}</label></td> 
</div>

<div class="form-check">
    <td><input type="checkbox" id="description" class="form-check-input" name="description" value="1"></td>
    <td><label for="description" class=" form-check-label">Beschrijving : {{$order->description}}</label></td> 
</div>

<hr>

<div class="form-group">
    <label for="handed">Extra veld</label>
    <input type="text" name="extra" id="extra" class="form-control" value="">
</div> 

<div class="form-group float-right">
    <input type="button" data-dismiss="modal" class="btn btn-outline-secondary" value="Terug">
    <input type="submit" class="btn btn-outline-primary" value="Print">
</div>    
</form>