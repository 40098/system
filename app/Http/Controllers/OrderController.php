<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\OrderFormRequest;
use App\Models\Order;
use App\Models\Customer;
use App\Models\User;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::sortable()->paginate(20);
        return view('order.index', ['orders' => $orders]);
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $columns = ['order_nr', 'handed', 'problem', 'description', 'password'];
        $query = Order::query();
        foreach($columns as $column){
            $query->orWhere($column, 'LIKE', '%' . $search . '%');
        }
        $orders = $query->sortable()->paginate(20);
        
        return view('order.index', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::all();
        $users = User::all();
        return view('order.create', ['customers' => $customers], ['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderFormRequest $request)
    {
        $order = new Order();
        if ($request->input('customer') == "none") {
            $customer = new Customer();
            $request->validate(
                [
                    'name' => 'required',
                ]
            );
            $customer->fill($request->all());
            $customer->save();
            $order->customer_id = $customer->id;
        }else{
            $order->customer_id = $request->input('customer'); 
        }
        
        $order->fill($request->all());
        $order->user_id = $request->input('employee');
        $order->order_nr = "00000000";
        $order->save();
        $order->order_nr = strtoupper(substr($order->user->name, 0, 2)) .str_pad($order->id, 8, "0", STR_PAD_LEFT);
        $order->save();

        if ($request->input('printLabel')) {
            $message = [];
            $message[] = $order->order_nr ? "Nummer: {$order->order_nr}\n" : "" ;
            $message[] = $order->customer->name ? "Naam: {$order->customer->name}\n" : "" ;
            $message[] = $order->password ? "Wachtwoord: {$order->password}\n" : "" ;
            $message = implode("", $message);

            $order->printLabel($message);
        }
        
        return redirect('/orders')->with('message', 'De gegevens zijn opgeslagen in de database');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        return view('order.show', ['order' => $order]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::where('id',$id)->first();
        $customers = Customer::all();
        return view('order.edit', ['order' => $order], ['customers' => $customers]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OrderFormRequest $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->fill($request->all());
        $order->customer_id = $request->input('customer');
        $order->save();
        return redirect('/orders')->with('message', 'De gegevens zijn opgeslagen in de database');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();
        return redirect('/orders')->with('message', 'De gegevens zijn verwijderd uit de database');
    }

    public function done($id)
    {
        $order = Order::find($id);
        $order->status = 'done';
        $order->save();
        return back()->withInput()->with('message', 'De gegevens zijn opgeslagen in de database');
    }

    public function printer($id) {
        $order = Order::findOrFail($id);
        return view('order.printer',['order'=>$order]);
    }

    public function printLabel(Request $request, $id) {
        $order = Order::findOrFail($id);
        $message = [];

        $message[] = $request->input('order_nr') ? "Nummer: {$order->order_nr}\n" : "" ;
        $message[] = $request->input('name') ? "Naam: {$order->customer->name}\n" : "" ;
        $message[] = $request->input('mobile_phone') ? "Mobiel telefoon: {$order->customer->mobile_phone}\n" : "" ;
        $message[] = $request->input('house_phone') ? "Huis telefoon: {$order->customer->house_phone}\n" : "" ;
        $message[] = $request->input('email') ? "Email: {$order->email}\n" : "" ;
        $message[] = $request->input('price') ? "Prijs: {$order->price}\n" : "" ;
        $message[] = $request->input('password') ? "Wachtwoord: {$order->password}\n" : "" ;
        $message[] = $request->input('handed') ? "Ingeleverd: {$order->handed}\n" : "" ;
        $message[] = $request->input('problem') ? "Probleem: {$order->problem}\n" : "" ;
        $message[] = $request->input('description') ? "Beschrijving: {$order->description}\n" : "" ;
        $message[] = !empty($request->input('extra')) ? "\n{$request->input('extra')}\n" : "" ;

        $message = implode("", $message);
        $order->printLabel($message);
        return back()->with('message', 'Bon word geprint');
    }

}
