<?php

namespace App\Http\Controllers;

use App\Models\Promise;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class PromiseController extends Controller
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
        $promises= Promise::all();
        return view('financeAdmin.promise_mgt.index')->with('promises', $promises);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('financeAdmin.promise_mgt.create');
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
            'promisedAmount'=>'required',
            'paidAmount'=>'required',
            'balance'=>'required',
            'promisedDate'=>'required',
            'reason'=>'required',
        ]);


        $promise = new Promise();
        $promise->memberName=$request->input('memberName');
        $promise->promisedAmount=$request->input('promisedAmount');
        $promise->paidAmount=$request->input('paidAmount');
        $promise->balance=$request->input('balance');
        $promise->promisedDate=$request->input('promisedDate');
        $promise->reason=$request->input('reason');
        $promise->admin_id=Auth::user()->admin_id;
        $promise->save();
        
        return redirect('financeAdmin/promise');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Promise  $promise
     * @return \Illuminate\Http\Response
     */
    public function show(Promise $promise)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Promise  $promise
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $promise=Promise::find($id);
        return view('financeAdmin.promise_mgt.edit')->with('promise',$promise);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Promise  $promise
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $this->validate($request,[
            'memberName'=>'required',
            'promisedAmount'=>'required',
            'paidAmount'=>'required',
            // 'balance'=>'required',
            'promisedDate'=>'required',
            'reason'=>'required',
        ]);

        

        $promise = Promise::find($id);

        $promise->memberName=$request->input('memberName');
        $promise->promisedAmount=$request->input('promisedAmount');
        $promise->paidAmount=$request->input('paidAmount');
        $promise->balance=$promise->promisedAmount-$promise->paidAmount;
        // $promise->balance=$request->input('balance');
        $promise->promisedDate=$request->input('promisedDate');
        $promise->reason=$request->input('reason');
        $promise->save();
        
        return redirect('financeAdmin/promise');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Promise  $promise
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promise $promise)
    {
        //
    }
}