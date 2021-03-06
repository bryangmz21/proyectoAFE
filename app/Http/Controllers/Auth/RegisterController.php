<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Municipality;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
            'lastname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'dui'=>['required', 'string', 'regex:/^\d{9}$/'],
            'address'=> ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:8'],
            'municipality' => ['required', 'int']
        ],[
            'dui' => 'El DUI debe contener 9 digitos sin guiones',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'last_name' => $data['lastname'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role_id' => 2
        ]);
        $user->assignRole('Client');
        $client = Client::create([
            'client_name' => $data['username']." ".$data['lastname'],
             'dui' => $data['dui'],
             'email' => $data['email'],
             'address' => $data['address'],
             'phone' => $data['phone'],
             'municipality_id' => $data['municipality'],
             'user_id' => $user->id
         ]);
        return $user;
    }

    public function showRegistrationForm()
    {
        $municipality=Municipality::all();
        return view('auth.register',compact('municipality'));
    }
}
