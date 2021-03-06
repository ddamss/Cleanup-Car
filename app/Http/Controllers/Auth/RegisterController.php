<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Client;
use App\Cleaner;
use App\Mail\WelcomeUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('guest:client');
        $this->middleware('guest:cleaner');
    }
    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:1', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Client
     * @return \App\Cleaner
     */
    protected function create(array $data)
    {
        if($data['type']==='client')
        {

            $client=new \App\Client([
                'name' => $data['name'],
                'email' =>$data['email'],
                'password' => Hash::make($data['password']),
            ]);

            if($client) {Mail::to($data['email'])->send(new WelcomeUser($data));}

            return $client->save();
            
        }else{
            $cleaner=new \App\Cleaner([
                'name' => $data['name'],
                'email' =>$data['email'],
                'password' => Hash::make($data['password']),
            ]);

            if($cleaner) {Mail::to($data['email'])->send(new WelcomeUser($data));}

            return $cleaner->save();
        }

    }
}
