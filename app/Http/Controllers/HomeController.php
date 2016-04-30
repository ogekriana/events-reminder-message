<?php

namespace SimpleProject\Http\Controllers;

use SimpleProject\Http\Requests;
use Illuminate\Http\Request;
use Event;
use SimpleProject\Events\SendEmail;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Event::fire(new SendEmail(26));
        return view('dashboard');
    }
}
