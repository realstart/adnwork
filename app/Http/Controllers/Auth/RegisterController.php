<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Str;
use App\Mail\SendCode;

use Illuminate\Support\Facades\Mail;

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
    protected $redirectTo = '/email/verify';

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
        
        $temp = User::where('email',$data['email'])->first();
        if(!empty($temp))
        {
            if($temp->status == '2')
            {
                session(['error_email' => 'support@adnlist.com']);
            }
        }
        
        return Validator::make($data, [           
            'fname' => ['required', 'max:255'],
            'lname' => ['required', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data1)
    {        
        $lnametemp = str_replace(' ','',$data1['lname']);
        $fnametemp = str_replace(' ','',$data1['fname']);
        $lname = preg_replace('/[0-9]+/', '', $lnametemp);
        $fname = preg_replace('/[0-9]+/', '', $fnametemp);
        
        return User::create([
            'fname' => $fname,
            'lname' => $lname,
            'name' => $fname." ".$lname,
            'email' => $data1['email'],
            'role'  => "0",            
            'receive_b_s'  => "0",            
            'verifytext'   => "",
            'phone_code'   => "",
            'status'       => "1",
            
            'password' => Hash::make($data1['password']),
        ]);
    }
}
