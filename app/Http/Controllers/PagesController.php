<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\MuseumRecord;

class PagesController extends Controller
{
   
    public function index()
    {
        return view('welcome');
    }

    
    public function about()
    {
                return view('pages.about');

    }

     public function contactus()
    {
                return view('pages.contactus');

    }

     public function museum()
    {
        $posts=MuseumRecord::orderBy('created_at','desc')->get();
        return view('pages.museum')->with('posts',$posts);

    }

     public function event()
    {
         $posts=Event::orderBy('created_at','desc')->get();
        
        return view('pages.events')->with('posts',$posts);
   
    }


    
}