<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post_Category;
use App\Models\Post_SubCategory;
use App\Models\Poster;
use App\Models\Country;
use App\Models\Message;
use App\Models\Provider;
use App\Models\PostSkill;
use App\Models\PosterCategory;
use App\Models\CProvider;
use App\Models\Education;
use App\Models\Adn;
use App\Models\Contact;
use App\Models\LifeStyle;
use App\Models\Benefit;
use App\Models\FoundLost;
use App\Models\Profile;
use App\Models\Subprofile;

use Auth;
use Hash;
use App\User;
use DB;
use App\Mail\FeedbackMail;
use App\Mail\ChangePwd;
use App\Mail\SendCode;
use App\Mail\ContactUs;
use App\Mail\UpdateProfile;
use App\Mail\ReplyEmail;


use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {        
        $info = Contact::find('1');
        session(['email' => $info->general]);
        session(['tel' => $info->tel]);      
        session(['address' => $info->address]);        
    }

    public function login(Request $request) {
        $email = $request->get('email');
        $pwd = $request->get('password');

        if(User::where('email', $email)->exists()) 
        {
            $user = User::where('email', $email)->first();
            if($user->status == "2")
            {
                return response()->json([
                    'status' => 'deactive'
                ]);
            }

            if(Hash::check($pwd, $user->password)) {
                Auth::login($user);

                return response()->json([
                    'status' => 'true'
                ]);
            }
            else {
                return response()->json([
                    'status' => 'pwd_err'
                ]);
            }
        }
        else {
            return response()->json([
                'status' => 'email_err'
            ]);
        }
    }
    
    public function register(Request $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');
        $current_page = $request->get('current_page');
        $fname = $request->get('fname');
        $lname = $request->get('lname');
        if(User::where('email', $email)->exists()) 
        {
            return response()->json([
                    'status' => 'email_err'
                ]);           
        }
        else 
        {            
            $user = User::create([
                'fname' => $fname,
                'lname' => $fname." ".$lname,
                'name' => $lname,
                'email' => $email,
                'role'  => "0",                
                'receive_b_s'  => "0",                
                'verifytext'   => "",
                'phone_code'   => "",
                'status'       => "1",                
                'password'     => Hash::make($password),
            ]);
            Auth::login($user);
            if($current_page != "createpost")
            {                
                $data = array();
                $data["name"] = "";
                $data["adminmail"] = Contact::find(1)->support;
                $data["status"] = "sendlink"; 
                $data["link"] = \Illuminate\Support\Facades\Crypt::encryptString($user->id);
                $toEmail = Auth::user()->email;
                Mail::to($toEmail)->send(new UpdateProfile($data));  
                return response()->json([
                    'status' => 'verify'
                ]);     
            }
            return response()->json([
                'status' => 'true'
            ]);
        }       
    }

    public function getCounty($state,$city)
    {
        $county = "";
        if(strlen($state) > 2)
        {
            if(DB::table('cities')->where('city',$city)->where('state_name',$state)->first())
            {
                $county = DB::table('cities')->where('city',$city)->where('state_name',$state)->first()->county_name;
            }                
        }
        else
        {
            if(DB::table('cities')->where('city',$city)->where('state_id',$state)->first())
            {
                $county = DB::table('cities')->where('city',$city)->where('state_id',$state)->first()->county_name;                
            } 
            
        }
        return $county;
    }
    public function getshortstate($state)
    {
        $shortstate = "";
        
        if(DB::table('cities')->where('state_name',$state)->first())
        {
            $shortstate = DB::table('cities')->where('state_name',$state)->first()->state_id;
        }                
       
        return $shortstate;
    }

    public function register_profile(Request $request)
    {
        if(Auth::check())
        {
            return redirect(url('/'));
        }
        return view('auth.registerprofile');
    }

    public function store_profile(Request $request)
    {        
        $email = $request->get('email');
        $name = $request->get('name');        
        if(User::where('email', $email)->exists()) 
        {
            return back()->with("error","This email already registered.");   
        }
        else 
        {            
            $user = User::create([
                'fname' => "",
                'lname' => "",
                'email' => $email,
                'role'  => "1",
                'name'   => $request->get('name'),
                'receive_b_s'  => "0",
                'companyname'  => $request->get('companyname'),
                'verifytext'   => "",
                'phone_code'   => "",
                'status'       => "1",                
                'password'     => "",
                'type'         => $request->get('userrole'),
                'phone'        => $request->get('phonenumber'),
            ]);
           
            $data = array();
            $data["name"] = $name;
            $data["adminmail"] = Contact::find(1)->support;
            $data["status"] = "sendlink"; 
            $data["link"] = \Illuminate\Support\Facades\Crypt::encryptString($user->id);
            $toEmail = $email;
            Mail::to($toEmail)->send(new UpdateProfile($data)); 
            return back()->with("success","Sent verification link.");
        }   
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() 
    {
        return view('welcome');
    }

    public function create_post(Request $request)
    {
        $all_category = Post_Category::all();      
        return view('user.create_post',compact('all_category'));
    }

    public function welcome(Request $request)
    {        
        

        $ip = $_SERVER['REMOTE_ADDR'];
        
        $cur_date = date('Y-m-d H:i:s', time());
           
            $all_category_temp = Post_Category::all();
            
            $temp = array();    
            $all_category = array();
            $city = "";
            $country = "";
            $state = "";
            $county = "";
           
            
            $locationtemp = $request->location;
            
    
            $user_ip = getenv('REMOTE_ADDR');
            
            $details = json_decode(file_get_contents("http://ipinfo.io/{$user_ip}"));        
            
            if($user_ip == "127.0.0.1")
            { 
                $state = "CA";
                $city = "Los Angeles";
                $lat = "34.0522";
                $lng = "-118.2437";
                $zipcode = "90009";
                if(empty(session('locationtemp')))
                {
                    session(['locationtemp' => "San Diego".","."CA".","."US"]);  
                }
                $county = $this->getCounty($state,$city);                       
               
                if(empty(session('county'))) 
                {
                    session(['county' => $county]);
                    session(['city' => $city]);
                    session(['state' => $state]);      
                    session(['country' => "US"]);
                }
                $userlocation = array("city"=>$city,"state"=>$state,"county"=>$county,"zipcode"=>$zipcode,"lat"=>$lat,"lng"=>$lng,"country"=>"US");
            }            
            elseif($details->country == "US" || $details->country == "USA")
            { 
                if(strlen($details->region)>2)
                {
                    $state = $this->getshortstate($details->region);
                }
                else
                {
                    $state = $details->region;                         
                }                

                $city = $details->city;                
                $country = $details->country; 

                if(empty(session('locationtemp')))
                {
                    session(['locationtemp' => $locationtemp = $details->city.",".$state.",".$details->country]);  
                }   
                
                $county = $this->getCounty($state,$city);   
                if(empty(session('county'))) 
                {
                    session(['state' => $state]); 
                    session(['city' => $details->city]);                
                    session(['country' => $details->country]);            
                    session(['county' => $county]);
                }
                $temploc = $details->loc;
                $findcomma = ",";
                $pos = strpos($temploc,$findcomma);
                
                $lat = trim(substr($temploc,0,$pos)," ");
                $lng = str_replace($lat.",", "", $temploc);
                
                $userlocation = array("city"=>$city,"state"=>$state,"county"=>$county,"zipcode"=>$details->postal,"lat"=>$lat,"lng"=>$lng,"country"=>$country);
                
            }
           
            if(session('country') !="US")
            {
                return view('coming_soon');
            }
    
           
            foreach($all_category_temp as $item)
            {
                array_push($temp,$item->id);
                array_push($temp,$item->name);
                array_push($temp,$item->image);
                array_push($temp,Poster::where('category_id',$item->id)->where('status','1')
                ->where(function($query) use($city){
                    return $query->where('in_city',$city)->orWhere('in_county', $city);
                })->count());
                array_push($temp,$item->slug);
                
                array_push($all_category,$temp);
                $temp = array();
            }              
            
            $all_users = User::where('role','0')->where('status','1')->count();
            $all_posts = Poster::where('status','1')->count();
            $all_sub = Post_SubCategory::count();
            $cur_date = date('Y-m-d H:i:s', time());
            
            $cur_ads = Adn::where('location','like','%'.$city.'%')->whereDate('exp_date','>',$cur_date)->orderby('updated_at')->get();        
            $info = Contact::find('1');  
            $all_profile = Profile::all();
            
            return view('welcome',compact('all_category','locationtemp','cur_date','city','all_profile','country','county','state','info'));
                
    }
// -----------------------------------------------Category_view---------------------------------------------//
    
    public function category_view (Request $request,$category_id,$sub_cat_id)
    {        
        
        $cur_date = date('Y-m-d H:i:s', time());

        $fromhome = $request->get('homepage');
        $city = $request->get('search_city');
        $state = $request->get('search_state');
        $county = $request->get('search_county');
       
        if(empty($city))
        {
            $city = session('city');            
        }
        if(empty($state))
        {
            $state = session('state');           
        }
        if(empty($county))
        {
            $county = session('county');            
        }

        if($category_id == "all")
        {    
            $cur_sel_category = $request->get('sub_category'); 
            $sel_city = $request->get('sel_city');
            
            if($fromhome != "")           
            {
                $sel_city = "all";
            }
            if(!empty($city))
            {
                $sel_city = $city;
            }
                        
            session(['city' => $city]);
            if($county !="")
            {
                session(['county' => $county]);
            }
            if($state !="")
            {
                session(['state' => $state]);
            }
            if($county == "")
            {
                $all_cities = DB::table('cities')->where('county_name',session('county'))->where('state_id',session('state'))->orderBy('city','asc')->get();
            }
            else
            {
                $all_cities = DB::table('cities')->where('county_name',$county)->where('state_id',$state)->orderBy('city','asc')->get();
            }

            $all_category = Post_Category::all();
                           
            $search = $request->get('search');
           
            if(!empty($request->get('orderby')))
            {
                $orderby = $request->get('orderby');
            }
            else
            {
                $orderby = "1";
            }
            
            $all_poster = new Poster();
            if(!empty($cur_sel_category) && $cur_sel_category != "all")
            {
                $all_poster = $all_poster->where('category_id',$cur_sel_category)->latest();
            }
            if($orderby == '1')
            {
                $all_poster = $all_poster->where('status','1')->latest();
            }
            elseif($orderby == '2')
            {
                $all_poster = $all_poster->where('status','1')->oldest();
            }
            else
            {
                $all_poster = $all_poster->where('status','1')->latest();
            }
            
            if($county != "")
            {                                
                $all_poster = $all_poster->where('in_state',$state)->where('in_county',$county);            
                
            }
            
            if($sel_city != "all" && $sel_city != null)                
            {
                $all_poster = $all_poster->where('in_city',$sel_city);                   
            }                
            
            if(!empty($search))
            {
                $pieces = explode(" ", $search);
                $length = count($pieces);
                if($length == 1)
                {
                    $all_poster = $all_poster->where('title','like','%'.$search.'%');
                }
                else if($length == 2)
                {
                    $all_poster = $all_poster->where('title','like','%'.$pieces[0].'%')->orwhere('title','like','%'.$pieces[1].'%');
                }
                else if($length == 3)
                {
                    $all_poster = $all_poster->where('title','like','%'.$pieces[0].'%')->orwhere('title','like','%'.$pieces[1].'%')->orwhere('title','like','%'.$pieces[2].'%');
                }
                else
                {
                    $all_poster = $all_poster->where('title','like','%'.$pieces[0].'%')->orwhere('title','like','%'.$pieces[1].'%')->orwhere('title','like','%'.$pieces[2].'%')->orwhere('title','like','%'.$pieces[3].'%');
                }
            }
            $all_poster = $all_poster->paginate(30);           
            $cur_category = "all";
            $cur_subcategory = $sub_category = "";            
            return view('user.category_view',compact('all_category','cur_sel_category','cur_date','cur_category','cur_subcategory','all_poster','city','county','state','search','sub_category','orderby','category_id','all_cities','sel_city'));
        }
        else
        {        
            
            $cur_category = Post_Category::find($category_id); 
            $sel_city = $request->get('sel_city');

            if($fromhome != "")           
            {
                $sel_city = "all";
            }
            if(!empty($city))
            {
                $sel_city = $city;
            }
                        
            session(['city' => $city]);

            if($county !="")
            {
                session(['county' => $county]);
            }
            if($state !="")
            {
                session(['state' => $state]);
            }

            session(['city' => $city]);
            if($county !="")
            {
                session(['county' => $county]);
            }
            if($state !="")
            {
                session(['state' => $state]);
            }
            $all_cities = DB::table('cities')->where('county_name',session('county'))->where('state_id',session('state'))->orderBy('city','asc')->get();

           
            $all_category = Post_Category::all();

            $search = $request->get('search');
            
            if(!empty($request->get('sub_category')))
            {
                $sub_category = $request->get('sub_category');
            }
            else
            {
                $sub_category = $sub_cat_id;
            }
            
            
            session(['sub_cat' => $sub_category]);

            $sub_cat_array = array();
            if($request->get('orderby'))
            {
                $orderby = $request->get('orderby');
            }
            else
            {
                $orderby = "1";
            }
                       
                             

            $all_poster = new Poster();
            if($orderby == '1')
            {
                $all_poster = $all_poster->where('category_id',$category_id)->where('status','1')->latest();
            }
            elseif($orderby == '2')
            {
                $all_poster = $all_poster->where('category_id',$category_id)->where('status','1')->oldest();
            }
            else
            {
                $all_poster = $all_poster->where('category_id',$category_id)->where('status','1')->latest();
            }
            
            if(!empty($sub_category) && ($sub_category != "all"))
            {
                $sub_cat_array = PosterCategory::where('subparent_id',$sub_category)->pluck('poster_id')->toArray();
                $all_poster = $all_poster->whereIn('id',$sub_cat_array);
            }
            if($county != "")
            {                                
                $all_poster = $all_poster->where('in_state',$state)->where('in_county',$county);            
                
            }
            
            if($sel_city != "all" && $sel_city != null)                
            {
                $all_poster = $all_poster->where('in_city',$sel_city);                   
            }                
            
            if(!empty($search))
            {                
                $pieces = explode(" ", $search);
                $length = count($pieces);
                if($length == 1)
                {
                    $all_poster = $all_poster->where('title','like','%'.$search.'%');
                }
                else if($length == 2)
                {
                    $all_poster = $all_poster->where('title','like','%'.$pieces[0].'%')->orwhere('title','like','%'.$pieces[1].'%');
                }
                else if($length == 3)
                {
                    $all_poster = $all_poster->where('title','like','%'.$pieces[0].'%')->orwhere('title','like','%'.$pieces[1].'%')->orwhere('title','like','%'.$pieces[2].'%');
                }
                else
                {
                    $all_poster = $all_poster->where('title','like','%'.$pieces[0].'%')->orwhere('title','like','%'.$pieces[1].'%')->orwhere('title','like','%'.$pieces[2].'%')->orwhere('title','like','%'.$pieces[3].'%');
                }                         
            }

            

            $all_poster = $all_poster->paginate(15);
            
                
            
            $cur_subcategory_temp = Post_SubCategory::where('parent_id',$category_id)->orderBy('name','asc')->get(); 
            $cur_subcategory = array();
            $j=0;
            foreach($cur_subcategory_temp as $item)
            {
                $i=0;
                $cur_subcategory[$j]["sub_categoryID"] = $item->id;
                $cur_subcategory[$j]["sub_categoryName"] = $item->name;
                
                $temp_sub = PosterCategory::where('subparent_id',$item->id)->get();
                if(!empty($temp_sub))
                {
                    foreach($temp_sub as $sub)
                    {
                        if(!empty($sub->getposter))
                        {
                            if(($sub->getposter->status == '1') && (($sub->getposter->in_city == $city) || ($sub->getposter->in_county == $county)))
                            {
                                $i++;
                            }
                        }                    
                    }
                }
                
                $cur_subcategory[$j]["sub_categoryPoster"] = $i;
                $j++;
            }
            

            return view('user.category_view',compact('all_category','cur_date','cur_category','cur_subcategory','all_poster','city','state','county','search','sub_category','orderby','category_id','all_cities','sel_city'));
        }  
    }
// -----------------------------------------------Professinal_view------------------------------------------//
    public function professional_view (Request $request,$professional_id,$sub_id)
    {
        $search = $request->get('search');           
        if(!empty($request->get('orderby')))
        {
            $orderby = $request->get('orderby');
        }
        else
        {
            $orderby = "1";
        }

        $all_profile = Profile::all();
        
        if($professional_id == "all")
        {
            $cur_profile = "";
            $cur_subprofile = "";
            return view('user.professional_view',compact('all_profile','search','orderby','cur_profile','cur_subprofile'));
        }
        else
        {
            $cur_profile = Profile::find($professional_id);
            $cur_subprofile = Subprofile::where('parent_id',$professional_id)->get();
            return view('user.professional_view',compact('all_profile','search','orderby','cur_profile','cur_subprofile'));
        }
    }

    public function professional_view_detail(Request $request,$item_id)
    {
        
        return view('user.professional_detail');
    }

    public function professional_property(Request $request,$item_id)
    {
        
        return view('user.professional_property');
    }
// ---------------------------------------------------------------------------------------------------------//
    public function poster_detail(Request $request, $poster_id,$sub_cat_id)
    {        
        
        $cur_poster_temp = PosterCategory::where('poster_id',$poster_id)->first();
        
        if(empty($cur_poster_temp))
        {
            return back();
        }
        $cur_date = date('Y-m-d H:i:s', time());
       
        $prev = Poster::where('id', '<', $poster_id)->where('status','1')->where('in_city',$cur_poster_temp->getposter->in_city)->max('id');
        $next = Poster::where('id', '>', $poster_id)->where('status','1')->where('in_city',$cur_poster_temp->getposter->in_city)->min('id');
        
        if($prev < 1)
        {
            $prev  = "end";
        }
        if(empty($next))
        {
            $next = "end";
        }
        
        if(!empty($cur_poster_temp))
        {
            $cur_poster_p = $cur_poster_temp->parent_id;            
            
            $cur_poster_provide     = Provider::where('poster_id',$poster_id)->get();
            $cur_poster_skill       = PostSkill::where('poster_id',$poster_id)->get();
            $cur_poster_complex     = CProvider::where('poster_id',$poster_id)->get(); 
            $cur_poster_education   = Education::where('poster_id',$poster_id)->get();           
            $cur_poster_life        = LifeStyle::where('poster_id',$poster_id)->get();             
            $cur_poster_foundlost   = FoundLost::where('poster_id',$poster_id)->get(); 
            $cur_poster_benefit     = Benefit::where('poster_id',$poster_id)->where('checked','1')->get();
            
            if($sub_cat_id !="all")
            {
                if(Post_SubCategory::where('id',$sub_cat_id)->count())
                {
                    $sub_cat_name = Post_SubCategory::find($sub_cat_id)->name;                    
                }
                else
                {
                    return back();
                }
            }
            else
            {
                $sub_cat_name = $sub_cat_id;                
            }
            $show = "0";
            if (Auth::check())
            {
                $temp = Message::where('post_id',$poster_id)->where('receiver',Auth::user()->id)->where('attachment','matri_reply')->first();
                if(!empty($temp))
                {
                    $show = "1";                    
                }
                
            }
            return view('user.post_detail',compact('cur_poster_temp','show','cur_date','sub_cat_id','sub_cat_name','cur_poster_provide','cur_poster_skill','cur_poster_complex','cur_poster_education','cur_poster_foundlost','cur_poster_life','cur_poster_benefit','prev','next'));
        }
        else
        {                    
            return redirect('/');
        } 
    }

    public function post_publish(Request $request, $post_id)
    {
        $poster_id = \Illuminate\Support\Facades\Crypt::decryptString($post_id);
        $post_check = Poster::find($poster_id)->user_verify;
        $user_check = User::find(Poster::find($poster_id)->user_id)->email_verified_at;
        
        $sub_cat_id = "all";
        $cur_poster_temp = PosterCategory::where('poster_id',$poster_id)->first();
        
        if(empty($cur_poster_temp))
        {
            return redirect('/');
        }
        if(isset($post_check) && isset($user_check))
        {
            return redirect('/');
        }

        $cur_date = date('Y-m-d H:i:s', time());
        
        if(!empty($cur_poster_temp))
        {
            $cur_poster_p = $cur_poster_temp->parent_id;
            $cur_poster_provide     = Provider::where('poster_id',$poster_id)->get();
            $cur_poster_skill       = PostSkill::where('poster_id',$poster_id)->get();
            $cur_poster_complex     = CProvider::where('poster_id',$poster_id)->get(); 
            $cur_poster_education   = Education::where('poster_id',$poster_id)->get();           
            $cur_poster_life        = LifeStyle::where('poster_id',$poster_id)->get();             
            $cur_poster_foundlost   = FoundLost::where('poster_id',$poster_id)->get(); 
            $cur_poster_benefit     = Benefit::where('poster_id',$poster_id)->where('checked','1')->get();
            
            if($sub_cat_id !="all")
            {
                if(Post_SubCategory::where('id',$sub_cat_id)->count())
                {
                    $sub_cat_name = Post_SubCategory::find($sub_cat_id)->name;                    
                }
                else
                {
                    return back();
                }
            }
            else
            {
                $sub_cat_name = $sub_cat_id;                
            }
            $show = "0";
            if (Auth::check())
            {
                $temp = Message::where('post_id',$poster_id)->where('receiver',Auth::user()->id)->where('attachment','matri_reply')->first();
                if(!empty($temp))
                {
                    $show = "1";                    
                }
                
            }
            return view('user.post_publish',compact('cur_poster_temp','show','cur_date','sub_cat_id','sub_cat_name','cur_poster_provide','cur_poster_skill','cur_poster_complex','cur_poster_education','cur_poster_foundlost','cur_poster_life','cur_poster_benefit'));
        }
        else
        {                    
            return redirect('/');
        } 
    }

    public function user_create(Request $request,$post_id)
    {
        $poster_id = \Illuminate\Support\Facades\Crypt::decryptString($post_id);
        $post_check = Poster::find($poster_id);
        $user_check = User::find(Poster::find($poster_id)->user_id);
        $email = $user_check->email;
        $cur_poster_temp = PosterCategory::where('poster_id',$poster_id)->first();
        
        if(empty($cur_poster_temp))
        {
            return redirect('/');
        }
        else if(($post_check->status < 9) && isset($user_check->email_verified_at))
        {
            $email = "alreadypost";            
            return view('user.user_register',compact('email'));
        }
        else
        {
            $post_check->status = "0";
            $post_check->user_confirm = "1";
            $post_check->save();
            $user_check->email_verified_at = date('Y-m-d H:i:s');
            $user_check->save();

            $feedback = array();
            $feedback["name"] = "";      
            $toEmail = $email;
            Mail::to($toEmail)->send(new FeedbackMail($feedback));

            return view('user.user_register',compact('email'));
        }
        
    }
    public function user_verify(Request $request,$user_id)
    {
        $user_id = \Illuminate\Support\Facades\Crypt::decryptString($user_id);       
        $user_check = User::find($user_id);
        $password = "";    
                
        if(isset($user_check->email_verified_at))
        {
            $email = "already";  
            $role = $user_check->role;                      
            if(!empty($user_check->password))
            {
                $password = "set";
            }
            return view('user.user_register',compact('email','role','password','user_id'));
        }
        else
        {          
            if(!empty($user_check->password))
            {
                $password = "set";
            }  
            $role = $user_check->role; 
            $user_check->email_verified_at = date('Y-m-d H:i:s');
            $user_check->save();
            $email = "verified";            
            return view('user.user_register',compact('email','role','password','user_id'));
        }
        
    }
    

    public function privacy_policies(Request $request)
    {
        return view('privacypolicies');
    }

    public function aboutus(Request $request)
    {
        return view('aboutus');
    }

    

    public function faq(Request $request)
    {
        return view('faq');
    }

    

    public function avoid_scam(Request $request)
    {
        return view('avoid_scam');
    }

    public function posting_tips(Request $request)
    {
        $footer_data = Contact::find('1');
        return view('posting_tips',compact('footer_data'));
    }

    

    public function terms_use(Request $request)
    {       
        $footer_data = Contact::find('1');       
       
        return view('terms_use',compact('footer_data'));
    }

    public function privacy_policy(Request $request)
    {
        $footer_data = Contact::find('1');
        return view('privacy_policy',compact('footer_data'));
    }

    public function prohibited(Request $request)
    {
        $footer_data = Contact::find('1'); 
        return view('prohibited',compact('footer_data'));
    }

    public function testimonials(Request $request)
    {
        return view('testimonials');
    }
    public function payment_policy(Request $request)
    {
        $footer_data = Contact::find('1'); 
        return view('payment_policy',compact('footer_data'));        
    }

    public function faqs(Request $request)
    {
        $footer_data = Contact::find('1'); 
        return view('faq',compact('footer_data'));
    }

    public function careers(Request $request)
    {
        $footer_data = Contact::find('1'); 
        return view('careers',compact('footer_data'));
    }   
    
    public function guidelines(Request $request)
    {
        return view('guidelines');
    } 
    public function help_feedback(Request $request)
    {
        return view('help_feedback');
    } 
    
    public function contactus(Request $request)
    {
        $info = Contact::find('1');
        return view('contactus',compact('info'));
    }

    public function cookies(Request $request)
    {        
        return view('cookies');
    }
    
    public function send_admin(Request $request)
    {        
        Message::create([
            'title'       => $request->get('subject'),
            'content'     => $request->get('message'),
            'name'        => $request->get('name'),
            'email'       => $request->get('email'),
            'receiver'    => '0',
            'status'      => '0',
            'del_r'       => "0",
            'del_s'       => "0",
        ]);
        $data["title"] = $request->get('subject');
        $data["content"] = $request->get('message');
        $data["from"]    = $request->get('email');
        $data["name"]    = $request->get('name');       
        $data["email"]   = $request->get('email');

        $sendmail = Contact::find('1')->contact;
        Mail::to($sendmail)->send(new ContactUs($data));
        return back()->with("success","Your mail was successfully sent.");
    }
    public function report_scame(Request $request)
    {
        $data["title"] = Poster::find($request->get('post_id'))->title;
        $data["content"] = $request->get('message');
        $data["post_id"]    = $request->get('post_id');
        $data["name"]    = "";       
        $data["email"]   = "";

        $sendmail = Contact::find('1')->report;        
        
        Mail::to($sendmail)->send(new ContactUs($data));
        return back()->with("success","Your report has been successfully sent! We will further review this post.");
    }
    
    public function postimgupload(Request $request)
    {
        $imageName = Str::random(5);
        $imageName = $imageName.time().'.'.$request->file('postimg')->getClientOriginalExtension();

        $request->file('postimg')->move(public_path('upload/img/poster/lg'),$imageName);        
        $imgNameTemp = "upload/img/poster/lg/".$imageName;
        $img = Image::make($imgNameTemp)->resize(630, 420);
        $img->save($imgNameTemp);
        
        return response()->json($imageName);
    }

    public function getcategoryinfo(Request $request)
    {
        $all_subcategory = Post_SubCategory::orderBy('name','asc')->get();
           
        return response()->json($all_subcategory);
    }
    
    public function getcities(Request $request)
    {        
        $county = $request->get('county');
        $state = $request->get('state');
        $all_cities = DB::table('cities')->where('county_name',$county)->where('state_id',$state)->orderBy('city','asc')->get();
        return response()->json($all_cities);
    }

    public function checkauth(Request $request)
    {
        if (Auth::check()){
            return response()->json("on");
        }
        else
        {
            return response()->json("off");
        }
    }

    public function publish_verify(Request $request)
    {
        $post_id = $request->get('post_id');        
        $user_id = Poster::find($post_id)->user_id;
        $cur_user = User::find($user_id);
        if(!empty($cur_user->email_verified_at) && Poster::find($post_id)->status != "9")
        {
            return response()->json([
                'status' => 'no'
            ]);
        }
        else
        {      
            $cur_user->email_verified_at = date('Y-m-d H:i:s');
            $cur_user->save();
            $all_posts = Poster::where('user_id',$user_id)->get();
            foreach($all_posts as $item)
            {
                $item->status = "0";
                $item->user_confirm = "1";
                $item->save();
            }            

            $feedback = array();
            $feedback["name"] = "";      
            $toEmail = $cur_user->email;
            Mail::to($toEmail)->send(new FeedbackMail($feedback));

            return response()->json([
                'status' => "ok"
            ]);
        }
        
    }

    public function createpassword(Request $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');
        $user = User::where('email',$email)->first();
        if($user)
        {
            $user->password = Hash::make($password);
            $user->save();
            Auth::login($user);
            return response()->json([
                'status' => 'success'
            ]);
        }
        else
        {
            return response()->json([
                'status' => 'faild'
            ]);
        }
        

    }
    public function setpassword(Request $request)
    {
        $password = $request->get('password');
        $user = User::find($request->get('user_id'));
        if(!empty($user->password))
        {
            return redirect(url('/'));
        }
        $user->password = Hash::make($password);
        $user->save();
        Auth::login($user);
        return redirect(url('/'));
    }


    public function final_page()
    {
        return view('user.post_final');
    }
    public function send_email(Request $request)
    {
        $lableName = "";
        $fileName = "";
        if(!empty(request()->email_attchment))
        {
            $strtemp = Str::random(5);
            $lableName = request()->email_attchment->getClientOriginalName();
            $file_type = request()->email_attchment->getClientOriginalExtension();
            $fileName = $strtemp.time().'.'.$file_type;
            request()->email_attchment->move(public_path('upload/attachment'),$fileName);                      
        }
        
        $data = array();
        
        if(!empty($request->get('poster_id')))
        {
            $poster_id = $request->get('poster_id');
            $receiver_id = Poster::find($poster_id)->user->id;
            $data["name"] = Poster::find($poster_id)->user->name;
            $sendmail = Poster::find($poster_id)->contact_email;
        }
        elseif(!empty($request->get('receiver_id')))
        {
            $receiver_id = $request->get('receiver_id');
            $data["name"] = User::find($receiver_id)->name;
            $sendmail = User::find($receiver_id)->email;
        }
        if(!empty($request->get('title')))
        {
            $title = $request->get('title');
        }
        else
        {
            $title = "";
        }
        $name = $request->get('name');        
        if(Auth::check())
        {
            $email = Auth::user()->email;
        }
        else{
             $email = $request->get('replymail');
        }
       
        if(User::where('email', $email)->exists()) 
        {
            $reply_user = User::where('email',$email)->first();         
        }
        else 
        {            
            if($email != "")
            {
                $reply_user = User::create([
                    'fname' => "",
                    'lname' => "",
                    'name' => $name,                
                    'email' => $email,
                    'role'  => "0",                
                    'receive_b_s'  => "0",                
                    'verifytext'   => "",
                    'phone_code'   => "",
                    'status'       => "1",                
                    'password'     => "",
                ]);
            }
            else
            {
                return back()->with("success","Please input your email!");
            }
            
        }
        $content = $request->get('content');
        if(Auth::check())
        {
            Message::create([
                'title'       =>$title,
                'content'     =>$content,
                'sender'      =>Auth::user()->id,
                'receiver'    =>$receiver_id,
                'status'      =>"0",
                'attachment'  =>$fileName,
                'filename'    =>$lableName,
                'del_r'       =>"0",
                'del_s'       =>"0",
            ]);
                    
            
            $data["title"] = $title;
            $data["content"] = $content;
            $data["from"] = $email;
            $data["name"] = Auth::user()->name;
            $data["status"] = "communication";
            $data["fileName"] = $fileName;
            
            Mail::to($sendmail)->send(new ReplyEmail($data));
            return back()->with("success","Your message sent successfully!");
        }
        else
        {
            Message::create([
                'title'       =>$title,
                'content'     =>$content,
                'sender'      =>$reply_user->id,
                'receiver'    =>$receiver_id,
                'status'      =>"0",
                'attachment'  =>$fileName,
                'filename'    =>$lableName,
                'del_r'       =>"0",
                'del_s'       =>"0",
            ]);
                    
            
            $data["title"] = $title;
            $data["content"] = $content;
            $data["from"] = $email;
            $data["name"] = $name;
            $data["status"] = "communication";
            $data["fileName"] = $fileName;
            
            Mail::to($sendmail)->send(new ReplyEmail($data));
            
            return back()->with("success","Your message sent successfully!");
        }
       
    }

    public function getphonenumber(Request $request)
    {
        $post_id = $request->get('post_id');
        $phone_number = Poster::find($post_id)->contact_phone;
        return response()->json([
            'result' => $phone_number
        ]);
    }
}
