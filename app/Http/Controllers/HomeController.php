<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $contact=Contact::where('user_id', $user_id)->get();
        $events=Event::where('user_id', $user_id)->get();
        $users=Auth::user()->get();
        return view('home')->with(compact('contact','events','users'));
    }
}
