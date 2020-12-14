<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\OrderFormRequest;
use App\Models\Order;
use App\Models\Product;
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
        $orders = Order::all();
        return view('order.index', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        $customers = Customer::all();
        return view('order.create', ['products' => $products, 'customers' => $customers]);
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
        $order->user_id = Auth::user()->id;
        $order->customer_id = $request->input('customer');
        $order->status = $request->input('status');
        $order->handed = $request->input('handed');
        $order->description = $request->input('description');
        $order->save();

        $products = $request->input('product');
        $quantities = $request->input('quantity');
        $prices = $request->input('price');
        if ($products) {
            $sync_data = [];
            for($i = 0; $i < count($products); $i++){
                $sync_data[$products[$i]] = ['quantity' => $quantities[$i], 'price' => $prices[$i]];
                $order->products()->attach($sync_data);
            }
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
        $order->products()->detach();
        $order->delete();
        return redirect('/orders')->with('message', 'De gegevens zijn verwijderd uit de database');
    }
}
