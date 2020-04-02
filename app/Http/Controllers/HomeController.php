<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Meeting;
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
        $data['meeting'] = Meeting::where('user_id', Auth::id())->first();
        return view('home', $data);
    }
}
