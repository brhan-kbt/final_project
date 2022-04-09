<?php

namespace App\Http\Controllers;

use App\Models\ServicePayment;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class ServicePaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

      public function __construct()
    {
        $this->middleware('financeadmin');
    }
     
    
    public function index()
    {
        $servicePayments= ServicePayment::all();
        return view('financeAdmin.servicePayment_mgt.index')->with('servicePayments', $servicePayments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('financeAdmin.servicePayment_mgt.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'memberName'=>'required',
            'phone'=>'required',
            'paidDate'=>'required',
            'amount'=>'required',
            'reason'=>'required',
        ]);

        $servicePayment= new ServicePayment();
        $servicePayment->memberName=$request->input('memberName');
        $servicePayment->phone=$request->input('phone');
        $servicePayment->paidDate=$request->input('paidDate');
        $servicePayment->amount=$request->input('amount');
        $servicePayment->reason=$request->input('reason');
        $servicePayment->admin_id=Auth::user()->admin_id;
        $servicePayment->save();
        
        return redirect('financeAdmin/servicePayment');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ServicePayment  $servicePayment
     * @return \Illuminate\Http\Response
     */
    public function show(ServicePayment $servicePayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ServicePayment  $servicePayment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $servicePayment= ServicePayment::find($id);
        return view('financeAdmin.servicePayment_mgt.edit')->with('servicePayment', $servicePayment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ServicePayment  $servicePayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $this->validate($request,[
            'memberName'=>'required',
            'phone'=>'required',
            'paidDate'=>'required',
            'amount'=>'required',
            'reason'=>'required',
        ]);

        $servicePayment=ServicePayment::find($id);
        
        $servicePayment->memberName=$request->input('memberName');
        $servicePayment->phone=$request->input('phone');
        $servicePayment->paidDate=$request->input('paidDate');
        $servicePayment->amount=$request->input('amount');
        $servicePayment->reason=$request->input('reason');
        $servicePayment->save();
        
        return redirect('financeAdmin/servicePayment');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ServicePayment  $servicePayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServicePayment $servicePayment)
    {
        //
    }
}