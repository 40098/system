<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\OrderFormRequest;
use App\Models\Order;
use App\Models\Customer;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('id', 'DESC')->paginate(10);
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
        return view('order.create', ['customers' => $customers]);
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
            $customer = new customer();
            $customer->fill($request->all());
            $customer->save();
            $order->customer_id = $customer->id;
        }else{
            $order->customer_id = $request->input('customer'); 
        }
        
        $order->fill($request->all());
        $order->user_id = Auth::user()->id;
        $order->order_nr = "00000000";
        $order->save();
        $order->order_nr = strtoupper(substr($order->user->name, 0, 2)) .str_pad($order->id, 8, "0", STR_PAD_LEFT);
        $order->save();
        
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
        return view('order.edit', ['order' => $order]);
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
        $order->fill($request->all())->save();
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
        return redirect('/orders')->with('message', 'De gegevens zijn opgeslagen in de database');
    }
}
