<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Customer;
use App\Models\User;

class OpenOrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('status', '=', 'open')->orderBy('updated_at')->sortable()->paginate(10);
        return view('order.indexOpen', ['orders' => $orders]);
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->fill($request->all());
        $order->save();
        return redirect('/open-orders')->with('message', 'De gegevens zijn opgeslagen in de database');
    }
}
