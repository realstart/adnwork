<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Route;
use App\Models\SiteStatus;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/';
    public function redirectTo(){
        
        // User role
        $role = Auth::user()->role; 
        
        // Check user role
        if($role >= 2)
        {
            return url('/admin/dashboard');
        }
        else
        {
            return url('/');
        }        
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function authenticated()
    {
        if(Auth::user()->status == '2')
        {
            Auth::logout();
            return back()->with("error","support@adnlist.com");
        }
        $temp = SiteStatus::find(1);
        if($temp != null)
        {
            $visitor = $temp->visitor + 1;
            $temp->visitor = $visitor;
            $cur_month = date('m');
            switch ($cur_month) {
                case '01':
                     $Jan = $temp->Jan + 1;
                     $temp->Jan = $Jan;
                     break;
                case '02':
                    $Feb = $temp->Feb + 1;
                    $temp->Feb = $Feb;
                     break;
                case '03':
                    $Mar = $temp->Mar + 1;
                    $temp->Mar = $Mar;
                     break;
                case '04':
                    $Apr = $temp->Apr + 1;
                    $temp->Apr = $Apr;
                     break;
                case '05':
                    $May = $temp->May + 1;
                    $temp->May = $May;
                     break;
                case '06':
                    $Jun = $temp->Jun + 1;
                    $temp->Jun = $Jun;
                case '07':
                    $Jul = $temp->Jul + 1;
                    $temp->Jul = $Jul;
                    break;
               case '08':
                   $Aug = $temp->Aug + 1;
                   $temp->Aug = $Aug;
                    break;
               case '09':
                   $Sep = $temp->Sep + 1;
                   $temp->Sep = $Sep;
                    break;
               case '10':
                   $Oct = $temp->Oct + 1;
                   $temp->Oct = $Oct;
                    break;
               case '11':
                   $Nov = $temp->Nov + 1;
                   $temp->Nov = $Nov;
                    break;
               case '12':
                   $Dec = $temp->Dec + 1;
                   $temp->Dec = $Dec;
                     break;
             }
            $temp->save();
        }
        else{            
            SiteStatus::create([
                'visitor' => 1,
                'Jan' => 0,
                'Feb' => 0,
                'Mar' => 0,
                'Apr' => 0,
                'May' => 0,
                'Jun' => 0,
                'Jul' => 0,
                'Aug' => 0,
                'Sep' => 0,
                'Oct' => 0,
                'Nov' => 0,
                'Dec' => 0,
            ]);
        }
        
    }
}
