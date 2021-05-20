<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\OpenOrderFormRequest;
use App\Models\Order;
use App\Models\Customer;

class OpenOrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('status', '=', 'open')->sortable()->paginate(20);
        return view('openOrder.index', ['orders' => $orders]);
    }

    public function edit($id)
    {
        $order = Order::where('id',$id)->first();
        return view('openOrder.edit', ['order' => $order]);
    }

    public function update(OpenOrderFormRequest $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->fill($request->all());
        if (!empty($order->customer)) {
            $customer = Customer::findOrFail($order->customer->id);
            $customer->fill($request->all());
            $customer->save();
        }
        $order->save();
        return redirect('/open-orders')->with('message', 'De gegevens zijn opgeslagen in de database');
    }
}
