<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CustomerFormRequest;
use App\Models\Customer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::paginate(10);
        return view('customer.index', ['customers' => $customers]);
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $columns = ['name', 'mobile_phone', 'house_phone', 'email', 'address', 'zip', 'city'];
        $query = Customer::query();
        foreach($columns as $column){
            $query->orWhere($column, 'LIKE', '%' . $search . '%');
        }
        $customers = $query->paginate(10);
        
        return view('customer.index', ['customers' => $customers]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerFormRequest $request)
    {
        $customer = new Customer();
        $customer->fill($request->all());
        $customer->save();
        return redirect('/customers')->with('message', 'De gegevens zijn opgeslagen in de database');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customer.show', ['customer' => $customer]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = customer::findOrFail($id);
        return view('customer.edit', ['customer' => $customer]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerFormRequest $request, $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->fill($request->all())->save();
        return redirect('/customers')->with('message', 'De gegevens zijn opgeslagen in de database');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        $customer->delete();
        return redirect('/customers')->with('message', 'De gegevens zijn verwijderd uit de database');
    }
}
