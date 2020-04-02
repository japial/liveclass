<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Meeting;

class MeetingController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validator($request->all())->validate();
        $data = $request->all();
        $this->create($data);
        return redirect()->route('home')->with('success', 'Successfully Meeting Created');
    }
    
    /**
   * Get a validator for an incoming registration request.
   *
   * @param  array  $data
   * @return \Illuminate\Contracts\Validation\Validator
   */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'max:255']
        ]);
    }
    
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Round
     */
    protected function create(array $data)
    {
        $user = Auth::user();
        $emailString = explode("@",$user->email);
        $link = $emailString[0].'-'.time();
        return Meeting::create([
            'name' => $data['name'],
            'user_id' => $user->id,
            'link' => $link,
            'password' => $data['password']
        ]);
    }
}
