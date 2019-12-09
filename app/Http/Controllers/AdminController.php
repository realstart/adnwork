<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Intervention\Image\ImageManagerStatic as Image;
use Auth;
use App\Models\Post_Category;
use App\Models\Adn;
use App\Models\Post_SubCategory;
use App\Models\Poster;
use App\Models\Country;
use App\Models\PostSkill;
use App\Models\PosterCategory;
use App\Models\Favourate;
use App\Models\Provider;
use App\Models\CProvider;
use App\Models\FoundLost;
use App\Models\Education;
use App\Models\Message;
use App\Models\SiteStatus;
use App\Models\Contact;
use App\Models\LifeStyle;
use App\Models\Benefit;
use App\Models\Profile;
use App\Models\Subprofile;

use App\Mail\FeedbackMail;
use App\Mail\AdminSend;
use App\Mail\ChangePwd;
use App\Mail\SendCode;
use App\Mail\ContactUs;
use App\Mail\UpdateProfile;
use App\Mail\ReplyEmail;

use Illuminate\Support\Facades\Mail;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $info = Contact::find('1');
        session(['email' => $info->email]);
        session(['tel' => $info->tel]);      
        session(['address' => $info->address]);
    }
    
    public function admin_dashboard(Request $request)
    {
        $admin_page = "dashboard";
        if(Auth::user()->role == '3')
        {
            $total_user = User::all();
            $total_poster = Poster::where('user_confirm','1')->get();            
        }
        else if(Auth::user()->role == '2')
        {
            $total_user = User::where('country',Auth::user()->country)->get();
            $total_poster = Poster::where('country',Auth::user()->country)->where('user_confirm','1')->get();            
        }
        $total_visitor = SiteStatus::find(1);
        $all_user = array();
        $all_poster = array();
        $all_visitor = array();
        $key_array =array();
        $temp = array();
        $cur_month = date('m');
        $tempc1 = $tempc2 = $tempc3 = $tempc4 = $tempc5 = $tempc6 = 0;
        $tempp1 = $tempp2 = $tempp3 = $tempp4 = $tempp5 = $tempp6 = 0;
        if($cur_month <= 6)
        {
            
             array_push($key_array,'January', 'February', 'March', 'April', 'May', 'June');
             array_push($all_visitor,$total_visitor->Jan,$total_visitor->Feb,$total_visitor->Mar,$total_visitor->Apr,$total_visitor->May,$total_visitor->Jun);
             foreach($total_user as $item)
             {
                 $reg_month = substr($item->created_at,5,2);
                 
                 switch ($reg_month) {
                    case '01':
                         $tempc1++;
                         break;
                    case '02':
                         $tempc2++;
                         break;
                    case '03':
                         $tempc3++;
                         break;
                    case '04':
                         $tempc4++;
                         break;
                    case '05':
                         $tempc5++;
                         break;
                    case '06':
                         $tempc6++;
                         break;
                 }
                 
             }
             array_push($all_user,$tempc1,$tempc2,$tempc3,$tempc4,$tempc5,$tempc6);
             foreach($total_poster as $item)
             {
                 $reg_month = substr($item->created_at,5,2);
                 
                 switch ($reg_month) {
                    case '01':
                         $tempp1++;
                         break;
                    case '02':
                         $tempp2++;
                         break;
                    case '03':
                         $tempp3++;
                         break;
                    case '04':
                         $tempp4++;
                         break;
                    case '05':
                         $tempp5++;
                         break;
                    case '06':
                         $tempp6++;
                         break;
                 }
             }
             array_push($all_poster,$tempp1,$tempp2,$tempp3,$tempp4,$tempp5,$tempp6);            
            
        }
        else{
            array_push($key_array,'July','August', 'September', 'October', 'November', 'December');
            array_push($all_visitor,$total_visitor->Jul,$total_visitor->Aug,$total_visitor->Sep,$total_visitor->Oct,$total_visitor->Nov,$total_visitor->Dec);
            foreach($total_user as $item)
            {
                $reg_month = substr($item->created_at,5,2);
                
                switch ($reg_month) {
                   case '07':
                        $tempc1++;
                        break;
                   case '08':
                        $tempc2++;
                        break;
                   case '09':
                        $tempc3++;
                        break;
                   case '10':
                        $tempc4++;
                        break;
                   case '11':
                        $tempc5++;
                        break;
                   case '12':
                        $tempc6++;
                        break;
                }
                
            }
            array_push($all_user,$tempc1,$tempc2,$tempc3,$tempc4,$tempc5,$tempc6);
            
            foreach($total_poster as $item)
             {
                 $reg_month = substr($item->created_at,5,2);
                 
                 switch ($reg_month) {
                    case '07':
                         $tempp1++;
                         break;
                    case '08':
                         $tempp2++;
                         break;
                    case '09':
                         $tempp3++;
                         break;
                    case '10':
                         $tempp4++;
                         break;
                    case '11':
                         $tempp5++;
                         break;
                    case '12':
                         $tempp6++;
                         break;
                 }
             } 
             array_push($all_poster,$tempp1,$tempp2,$tempp3,$tempp4,$tempp5,$tempp6);            
           
        }
        return view('admin.dashboard',compact('admin_page','total_user','total_poster','total_visitor','all_user','all_poster','key_array','all_visitor'));
    }

    public function admin_reports(Request $request)
    {
        $admin_page = "reports";
        return view('admin.reports',compact('admin_page'));
    }

    public function admin_subadmin(Request $request)
    {
        $admin_page = "subadmin";
        $all_country = Country::all();
        if(!empty($request->get('fname')))
        {
            
            $validatedData = $request->validate([
                'fname' => ['required', 'string', 'max:255'],
                'lname' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
            User::create([
                'fname'      => $request->get('fname'),
                'lname'      => $request->get('lname'),
                'email'      => $request->get('email'),
                'role'       => '2',
                'phone'      => $request->get('phone'),
                'address'    => $request->get('address'),
                'country'    => $request->get('country'),
                'state'      => $request->get('state'),
                'city'       => $request->get('city'),
                'zip'        => $request->get('zip'),
                'password'   => Hash::make($request->get('password' )),
            ]);
        }
        $all_account = User::where('role','2')->get();
        return view('admin.subadmin',compact('admin_page','all_country','all_account'));
    }
    
    public function admin_accounts(Request $request)
    {        
        $admin_page = "accounts";
        $detail = 'all';
        $con = $request->get("search_condition");
        if(Auth::user()->role == '3')
        {
            if(!empty($request->get("search_condition")))
            {
                $all_account = User::where('role','0')
                                    ->where(function($query) use($con){
                                        return $query->where('fname',$con)->orWhere('lname', $con)->orWhere('city', $con)->orWhere('state', $con);
                                    })->latest()->paginate(10);
            }
            else
            {
                $all_account = User::where('role','0')->latest()->paginate(10);
            }
        }
        else if(Auth::user()->role == '2')
        {
            if(!empty($request->get("search_condition")))
            {                
                $all_account = User::where('role','0')->where('country',Auth::user()->country)
                                    ->where(function($query) use($con){
                                        return $query->where('fname',$con)->orWhere('lname', $con)->orWhere('city', $con)->orWhere('state', $con);
                                    })->latest()->paginate(10);
            }
            else
            {
                $all_account = User::where('country',Auth::user()->country)->where('id','!=',Auth::user()->id)->latest()->paginate(10);
            }
        }
        
        return view('admin.accounts',compact('admin_page','all_account','con','detail'));
    }

    public function admin_accounts_pro(Request $request)
    {        
        $admin_page = "accounts_pro";
        $detail = 'all';
        $con = $request->get("search_condition");
        if(Auth::user()->role == '3')
        {
            if(!empty($request->get("search_condition")))
            {
                $all_account = User::where('role','1')
                                    ->where(function($query) use($con){
                                        return $query->where('name',$con)->orWhere('companyname', $con)->orWhere('city', $con)->orWhere('state', $con);
                                    })->latest()->paginate(10);
            }
            else
            {
                $all_account = User::where('role','1')->latest()->paginate(10);
            }
        }
        else if(Auth::user()->role == '2')
        {
            if(!empty($request->get("search_condition")))
            {                
                $all_account = User::where('role','1')->where('country',Auth::user()->country)
                                    ->where(function($query) use($con){
                                        return $query->where('fname',$con)->orWhere('lname', $con)->orWhere('city', $con)->orWhere('state', $con);
                                    })->latest()->paginate(10);
            }
            else
            {
                $all_account = User::where('country',Auth::user()->country)->where('id','!=',Auth::user()->id)->where('role','1')->latest()->paginate(10);
            }
        }
        
        return view('admin.accounts',compact('admin_page','all_account','con','detail'));
    }
    public function admin_tasks(Request $request,$task_sel)
    {
        
        $admin_page = "tasks";
        $cur_date = date('Y-m-d H:i:s', time());
        $all_task = new Poster();
        $all_task = $all_task->where('user_confirm','1');
        if(Auth::user()->role == '2')
        {
            $all_task = $all_task->where('country',Auth::user()->country);
        }

        if($task_sel == "all")
        {
            $all_task = $all_task->latest()->paginate(20);
        }
        elseif($task_sel == "wait")
        {
            $all_task = $all_task->where('status','0')->latest()->paginate(20);
        }
        elseif($task_sel == "block")
        {
            $all_task = $all_task->where('status','2')->latest()->paginate(20);
        }
        elseif($task_sel == "removed")
        {
            $all_task = $all_task->where('status','3')->latest()->paginate(20);
        }
        elseif($task_sel == "approved")
        {
            $all_task = $all_task->where('status','1')->latest()->paginate(20);
        }
        elseif($task_sel == "unverified")
        {
            $all_taskT = new Poster();
            $all_task = $all_taskT->where('status','9')->latest()->paginate(20);
        }
        
        return view('admin.tasks',compact('admin_page','all_task','task_sel','cur_date'));
    }


    public function admin_tasks_search(Request $request)
    {
        
        $admin_page = "tasks";
        $task_sel = "search";
        $con = $request->get("search_condition");

        $all_task = new Poster();
        if(Auth::user()->role == '2')
        {
            $all_task = $all_task->where('country',Auth::user()->country)->where('user_confirm','1');
        }
        
        $all_task = $all_task->where('title','like',"%$con%")
                            ->where('user_confirm','1')
                            ->orwhere('classifiedbody','like',"%$con%")
                            ->orwhere('estimated_rent','like',"%$con%")
                            ->orwhere('utilities','like',"%$con%")
                            ->orwhere('city','like',"%$con%")
                            ->orwhere('state','like',"%$con%")
                            ->paginate(20);      
        
        return view('admin.tasks',compact('admin_page','all_task','task_sel','con'));
    }

    public function admin_detail(Request $request,$poster_id)
    {
        $cur_poster_temp = PosterCategory::where('poster_id',$poster_id)->first();
        $admin_page = "tasks";
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

            $task_sel = "detail";            
            return view('admin.tasks',compact('cur_poster_temp','cur_date','cur_poster_benefit','cur_poster_provide','cur_poster_skill','cur_poster_complex','cur_poster_education','task_sel','admin_page'));
        }
        else
        {            
            return back();
        } 
    }

    public function admin_transaction(Request $request)
    {
        $admin_page = "transaction";
        return view('admin.transaction',compact('admin_page'));
    }


    public function admin_info(Request $request)
    {
        $admin_page = "info";
        $cur_admin = User::find(Auth::user()->id);
        $info = Contact::find('1');
        return view('admin.admin_info',compact('admin_page','cur_admin','info'));
    }

    public function admin_company_info(Request $request)
    {
        $admin_page = "cinfo";        
        $info = Contact::find('1');
        return view('admin.admin_company',compact('admin_page','info'));
    }
    
    public function admin_ads(Request $request)
    {
        $admin_page = "ads";
        $task_sel = 'list';
        $all_ads = Adn::latest()->paginate(30);
        return view('admin.advertisement',compact('admin_page','all_ads','task_sel'));
    }
    public function add_ads(Request $request)
    {
        $admin_page = "ads";
        $task_sel = 'store';
        $all_ads = Adn::latest()->paginate(30);
        return view('admin.advertisement',compact('admin_page','all_ads','task_sel'));
    }
    public function ads_store(Request $request)
    {        
        $ads_logo = $ads_image = "";
        if(!empty($request->ads_logo))
        {
             $logo_ext = request()->ads_logo->getClientOriginalExtension();        
            if($logo_ext == 'jpg' || $logo_ext == 'png')
            {
                $ads_logo = Str::random(4).time().'.'.$logo_ext;
                request()->ads_logo->move(public_path('upload/img/ads'),$ads_logo);
                $ads_logo_T = "upload/img/ads/".$ads_logo;
                $img_logo = Image::make($ads_logo_T)->resize(450, 300);
                $img_logo->save($ads_logo_T);
            }
            else
            {
                return back()->with("error","Logo is not image type! Please try again.");
            }
        }

        if(!empty($request->ads_image))
        {
            $image_ext = request()->ads_image->getClientOriginalExtension();
            if($image_ext == 'jpg' || $image_ext == 'png')
            {
                $ads_image = Str::random(4).time().'.'.request()->ads_image->getClientOriginalExtension();
                request()->ads_image->move(public_path('upload/img/ads'),$ads_image);
                $ads_image_T = "upload/img/ads/".$ads_image;
                $img_ads = Image::make($ads_image_T)->resize(450, 300);
                $img_ads->save($ads_image_T);
            }
            else
            {
                return back()->with("error","Ads is not image type! Please try again.");
            }
        }
        
        Adn::create([
            'subject'    => $request->get('subject'),
            'tagline'    => $request->get('tagline'),
            'link'       => $request->get('link'),
            'type'       => $request->get('type'),
            'body'       => $request->get('body'),
            'location'   => $request->get('location'),
            'staus'      => "1",
            'exp_date'   => $request->get('exp_date'),
            'user_id'    => Auth::user()->id,
            'logo'   => $ads_logo,
            'image'  => $ads_image,
        ]);
        
       return redirect(route('admin_ads'));
    }
    public function admin_category(Request $request)
    {
        $admin_page = "category";
        $all_category = Post_Category::all();        
        return view('admin.category',compact('all_category','admin_page'));
    }
    
    public function admin_profile(Request $request)
    {
        $admin_page = "profile";
        $all_profile = Profile::all();           
        return view('admin.profile',compact('all_profile','admin_page'));
    }

    public function admin_country(Request $request)
    {
        $admin_page = "country";
        $all_country = Country::all();
        return view('admin.country',compact('admin_page','all_country'));
    }


    public function admin_footer_edit(Request $request,$nav_name)
    {
        $admin_page = "footer_edit";        
       
        $temp = Contact::find('1');
        
        return view('admin.admin_footer_edit',compact('temp','admin_page','nav_name'));
    }
   
    
    public function store_footer_content(Request $request)
    {
        $temp = Contact::find('1');
        $nav_name = $request->get('nav_name');
        $content = $request->get('terms');
        
        if(!empty($temp))
        {           
            if($nav_name == "terms") 
            {
                $temp->date_terms = date("Y-m-d");
                $temp->footer_terms = $content;
            }
            elseif($nav_name == "privacy")
            {
                $temp->date_privacy = date("Y-m-d");
                $temp->footer_privacy = $content; 
            }
            elseif($nav_name == "faq")
            {
                $temp->date_faq = date("Y-m-d");
                $temp->footer_faq = $content; 
            }
            elseif($nav_name == "prohibited")
            {
                $temp->date_prohibited = date("Y-m-d");
                $temp->footer_prohibited = $content;
            }
            elseif($nav_name == "postingtips")
            {
                $temp->date_postingtips = date("Y-m-d");
                $temp->footer_postingtips = $content;
            }
            elseif($nav_name == "careers")
            {
                $temp->date_careers = date("Y-m-d");
                $temp->footer_careers = $content;
            }
            elseif($nav_name == "payment")
            {
                $temp->date_payment = date("Y-m-d");
                $temp->footer_payment = $content;
            }
            $temp->save();
        }
        
        return back();
    }
   
    

    public function categorystore(Request $request)
    {
        if(!empty(request()->category_Image))
        {
            $imgName = time().'.'.request()->category_Image->getClientOriginalExtension();
            request()->category_Image->move(public_path('upload/img/category'),$imgName);
            $imgName = "upload/img/category/".$imgName;
            $img = Image::make($imgName)->resize(51, 41);
            $img->save($imgName);
        }
        else{
            return back()->with("error","Please select category image.");
        }
        
        if(
            Post_Category::create([
                'name' => $request->get('category'),
                'price' => $request->get('category_price'),
                'image' => $imgName,
            ])
        )
        {
            return back()->with("success","Category Successfully Updated!");
        }
        else
        {
            return back()->with("error","Faild! Please try again.");
        }
    }

    public function subcategorystore(Request $request)
    {
        if(empty($request->get('category')))
        {
            return back()->with("error","Please select category.");
        }
        if(
            Post_SubCategory::create([
                'name' => $request->get('subcategory'),
                'parent_id' => $request->get('category'),
            ])
        )
        {
            return back()->with("success","Subcategory Successfully Updated!");
        }
        else
        {
            return back()->with("error","Faild! Please try again.");
        }
    }

    public function subprofilestore(Request $request)
    {
        if(empty($request->get('profile')))
        {
            return back()->with("error","Please select profile.");
        }
        if(
            Subprofile::create([
                'name' => $request->get('subprofile'),
                'parent_id' => $request->get('profile'),
            ])
        )
        {
            return back()->with("success","Subprofile Successfully Updated!");
        }
        else
        {
            return back()->with("error","Faild! Please try again.");
        }
    }
    

    public function submenudelete($id)
    {
        $temp = Post_SubCategory::find($id);
        if(!empty($temp))
        {
            $temp->delete();
        }
        
        $array1 = array();
        $temp1 = PosterCategory::where('subparent_id',$id)->get();
       if(!empty($temp1))
       {
           foreach($temp1 as $item)
            {
                array_push($array1,$item->poster_id);
                $item->delete();
            }
            foreach($array1 as $item)
            {     
                if($item > 1)    
                {
                    $temp_item = Poster::find($item);
                    if(!empty($temp_item))
                    {
                        $temp_item->delete();
                    }                    
                }
                
            }
       }
                
        return back();
    }

    public function subprofiledelete($id)
    {
        $temp = Subprofile::find($id);
        if(!empty($temp))
        {
            $temp->delete();
        }             
                
        return back();
    }
    

    public function ads_delete($id)
    {
        $temp = Adn::find($id);
        if(!empty($temp))
        {
             $temp->delete();
        }
       
        
        return back();
    }
    
    public function menudelete($id)
    {
        die;
        $temp = Post_Category::find($id);
        $temp->delete();
        return back();
    }

    public function countrystore()
    {
        $xml = file_get_contents('https://restcountries.eu/rest/v2/all');
    
        $datas = json_decode($xml);
        foreach($datas as $data)
        {            
            Country::create([
                'countryname'     => $data->name,
                'countrycode'     => $data->callingCodes['0'],
                'countryflag'     => $data->flag,
            ]);                
        }
        echo "success";
    }

    public function update_task_status(Request $request)
    {
        
        $task_id = $request->get('submit_task_id');
        $task_status = $request->get('task_status');
        $internal_note = $request->get('internal_note');
        $sel_poster = Poster::find($task_id);
        $user_id = $sel_poster->user_id;
        $sel_poster->status = $task_status;
        $sel_poster->internal_note = $internal_note;
        $sel_poster->save();

        if($task_status > 0)
        {
            $comment = array();        
            $comment["name"] = User::find($user_id)->name;
            $comment["task_id"] = $task_id;
            $comment["task_status"] = $task_status;
            $comment["adminmail"] = Contact::find(1)->support;
            $toEmail = User::find($user_id)->email;
            Mail::to($toEmail)->send(new AdminSend($comment));
        }        

            
        return back();
    }

    public function update_user_status(Request $request)
    {
        $user_id = $request->get('user_id');
        $user_status = $request->get('user_status');        
        $sel_user = User::find($user_id);
        $sel_user->status = $user_status;        
        $name = $sel_user->name;
        if($sel_user->save())
        {
            if(!empty($user_status))
            {
                $data = array();
                $data["name"] = $name;
                $data["status"] = $user_status;
                $data["adminmail"] = Contact::find(1)->support;
                $toEmail = $sel_user->email;
                
                Mail::to($toEmail)->send(new UpdateProfile($data));
            }         
        }
        if(!empty($request->get('user_side')))
        {
            Auth::logout();
            return redirect('/');
        }
        return back();
    }
    
    public function update_subcategory(Request $request)
    {
        $sub_id = $request->get('subcategory_id');
        $sub_name = $request->get('subcategory');
        $temp = Post_SubCategory::find($sub_id);
        $temp->name = $sub_name;      
        $temp->save();
        return back();
    }

    public function update_subprofile(Request $request)
    {
        $sub_id = $request->get('subprofile_id');
        $sub_name = $request->get('subprofile');
        $temp = Subprofile::find($sub_id);
        $temp->name = $sub_name;      
        $temp->save();
        return back();
    }
    
    public function update_category(Request $request)
    {
        $cat_id = $request->get('category_id');
        $cat_name = $request->get('categoryname');
        $cat_price = $request->get('categoryprice');
        $temp = Post_Category::find($cat_id);
        $temp->name = $cat_name;      
        $temp->price = $cat_price;      
        $temp->save();
        return back();
    }

    public function update_profile(Request $request)
    {
        $pro_id = $request->get('profile_id');
        $pro_name = $request->get('profilename');
        $pro_price = $request->get('profileprice');
        $temp = Profile::find($pro_id);
        $temp->name = $pro_name;      
        $temp->price = $pro_price;      
        $temp->save();
        return back();
    }

    public function update_admin_profile(Request $request)
    {
        $temp = User::find(Auth::user()->id);
        if(!empty(request()->admin_Image))
        {
            $img_type = request()->admin_Image->getClientOriginalExtension();
            
            if($img_type =="jpg" or $img_type =="png")
            {
                $imgName = time().'.'.$img_type;
                request()->admin_Image->move(public_path('upload/admin'),$imgName);
                $imgName = "upload/admin/".$imgName;
                $img = Image::make($imgName)->resize(400, 400);
                $img->save($imgName);
                $temp->image = $imgName;
            }
            else
            {                
                return back()->with("error1","Incorrect Image Type.");
            }
            
        }      
                
        $temp->fname = $request->get('fname');
        $temp->lname = $request->get('lname');
        $temp->email = $request->get('email');
        $temp->save();
        return back()->with("success1","Successfully Updated!");
    }
    
    public function admin_user_detail(Request $request,$user_id)
    {
        $cur_user = User::find($user_id);
        $admin_page = "accounts";
        $detail = 'detail';
        return view('admin.accounts',compact('admin_page','cur_user','detail'));
    }



    public function changeInfo(Request $request)
    {
        $temp = Contact::find('1');
        if(!empty($temp))
        {
            $temp->general = $request->get('contact_email_general');
            $temp->support = $request->get('contact_email_support');
            $temp->scam    = $request->get('contact_email_scam');
            $temp->report  = $request->get('contact_email_report');
            $temp->global  = $request->get('contact_email_global');
            $temp->tel     = $request->get('contact_tel');
            $temp->address = $request->get('contact_address');
            $temp->save();
        }
        else
        {
            Contact::create([
                'general'   => $request->get('contact_email_general'),
                'support'   => $request->get('contact_email_support'),
                'scam'      => $request->get('contact_email_scam'),
                'global'    => $request->get('contact_email_global'),
                'tel'       => $request->get('contact_tel'),
                'address'   => $request->get('contact_address'),
            ]);
        }
        return back();
    }
    
    
    
}
