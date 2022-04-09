<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $messages = Message::get()->where('status','unseen');
         $allMessages=Message::all();
         return view('super-admin.messages.index')->with('messages', $messages)->with('allMessages', $allMessages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'senderName'=>'required',
            'title'=>'required',
            'email'=>'required',
            'message'=>'required',
        ]);


        $message= new Message();
        $message->senderName= $request->input('senderName');
        $message->title= $request->input('title');
        $message->email= $request->input('email');
        $message->message= $request->input('message');
        $message->status= 'unseen';
        $message->admin_id=3;
        $message->save();

        return redirect('/contact')->with('success','Thank You for your feedback!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
     
      $message= Message::find($id);
      $message->status='seen';
      $message->save();
        $messages = Message::get()->where('status','unseen');
      return view('super-admin.messages.show')->with('messages', $messages)->with('message', $message);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }
}