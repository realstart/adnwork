<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Intervention\Image\ImageManagerStatic as Image;
use Auth;
use Hash;
use DB;
use App\Models\Post_Category;
use App\Models\Post_SubCategory;
use App\Models\Poster;
use App\Models\Country;
use App\Models\PostSkill;
use App\Models\PosterCategory;
use App\Models\Favourate;
use App\Models\Provider;
use App\Models\LifeStyle;
use App\Models\CProvider;
use App\Models\FoundLost;
use App\Models\Education;
use App\Models\Contact;
use App\Models\Message;
use App\Models\State;
use App\Models\Benefit;


use App\Mail\FeedbackMail;
use App\Mail\ChangePwd;
use App\Mail\SendCode;
use App\Mail\ContactUs;
use App\Mail\UpdateProfile;
use App\Mail\ReplyEmail;
use App\Mail\Communication;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $info = Contact::find('1');
        session(['email' => $info->general]);
        session(['tel' => $info->tel]);      
        session(['address' => $info->address]);
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

    public function create_post(Request $request)
    {
        $all_category = Post_Category::all();      
        return view('user.create_post',compact('all_category'));
    }
    public function postfreead(Request $request,$category_id)
    { 
        $all_category = Post_Category::all();
        $cur_category = Post_Category::find($category_id);
        $all_subcategory = Post_SubCategory::where('parent_id',$category_id)->orderBy('name','asc')->get();
        
        return view('user.create_post',compact('all_category','all_subcategory','category_id','cur_category'));
    }
    
    public function user_advertisement(Request $request)
    {
        
        $cur_date = date('Y-m-d H:i:s', time());

        $page_name = "ads";
        $user_ads_num = Poster::where('user_id',Auth::user()->id)->count();
        $user_pendding_num = Poster::where('user_id',Auth::user()->id)->where('status','0')->where('user_confirm','1')->count();
        $user_draft_num = Poster::where('user_id',Auth::user()->id)->where('user_confirm','0')->count();
       
        $user_ads = Poster::where('user_id',Auth::user()->id)->latest()->paginate(10);
        
        return view('user.user_advertisement',compact('page_name','cur_date','user_ads','user_draft_num','user_ads_num','user_pendding_num'));
    }

    public function user_profile(Request $request)
    {
        $page_name = "profile";
        $all_country = Country::all();
        $user_ads_num = Poster::where('user_id',Auth::user()->id)->count();
        $user_pendding_num = Poster::where('user_id',Auth::user()->id)->where('status','0')->where('user_confirm','1')->count();
        $user_draft_num = Poster::where('user_id',Auth::user()->id)->where('user_confirm','0')->count();
      
        
        return view('user.user_profile',compact('page_name','all_country','user_draft_num','user_ads_num','user_pendding_num'));
    }
    public function user_change_password(Request $request)
    {
        $page_name = "pwd";
        $all_country = Country::all();
        $user_ads_num = Poster::where('user_id',Auth::user()->id)->count();
        $user_pendding_num = Poster::where('user_id',Auth::user()->id)->where('status','0')->where('user_confirm','1')->count();
        
        $user_draft_num = Poster::where('user_id',Auth::user()->id)->where('user_confirm','0')->count();
       
       
        return view('user.user_change_password',compact('page_name','all_country','user_draft_num','user_ads_num','user_pendding_num'));
    }
           
    

    public function user_pending_approval_ads(Request $request)
    {
        
        $cur_date = date('Y-m-d H:i:s', time());

        $page_name = "pen";
        $user_ads_num = Poster::where('user_id',Auth::user()->id)->count();
        $user_pendding_num = Poster::where('user_id',Auth::user()->id)->where('status','0')->where('user_confirm','1')->count();
        $user_draft_num = Poster::where('user_id',Auth::user()->id)->where('user_confirm','0')->count();
      
        $user_ads = Poster::where('user_id',Auth::user()->id)->where('status','0')->where('user_confirm','1')->latest()->paginate(10);
       
        return view('user.user_pending_approval_ads',compact('page_name','cur_date','user_ads','user_draft_num','user_ads_num','user_pendding_num'));
    }
    

    public function user_draft_ads(Request $request)
    {
        
        $cur_date = date('Y-m-d H:i:s', time());

        $page_name = "draft";
        $user_ads_num = Poster::where('user_id',Auth::user()->id)->count();
        $user_pendding_num = Poster::where('user_id',Auth::user()->id)->where('status','0')->where('user_confirm','1')->count();
        $user_draft_num = Poster::where('user_id',Auth::user()->id)->where('user_confirm','0')->count();
       
        $user_ads = Poster::where('user_id',Auth::user()->id)->where('user_confirm','0')->latest()->paginate(10);
        
        return view('user.user_draft_ads',compact('page_name','cur_date','user_ads','user_draft_num','user_ads_num','user_pendding_num'));
    }

    public function user_messages(Request $request,$message_type)
    {
        $page_name = "notification";
        $type = 0;
        $user_ads_num = Poster::where('user_id',Auth::user()->id)->count();
        $user_pendding_num = Poster::where('user_id',Auth::user()->id)->where('status','0')->where('user_confirm','1')->count();
        $user_draft_num = Poster::where('user_id',Auth::user()->id)->where('user_confirm','0')->count();
       
       
        if($message_type == 'read')
        {
            $type = 1;
        }
        $num_read = Message::where('receiver',Auth::user()->id)->where('status',1)->where('del_r',0)->count();
        $num_unread = Message::where('receiver',Auth::user()->id)->where('status',0)->where('del_r',0)->count();
        $num_sent = Message::where('sender',Auth::user()->id)->where('del_s',0)->count();

        if($message_type == 'sent')
        {
            $all_message = Message::where('sender',Auth::user()->id)->where('del_s',0)->latest()->paginate('20');
        }
        else
        {
            $all_message = Message::where('receiver',Auth::user()->id)->where('status',$type)->where('del_r',0)->latest()->paginate('20');
        }
        
       
        return view('user.user_messages',compact('page_name','user_draft_num','user_ads_num','all_message','message_type','num_read','num_unread','num_sent','user_pendding_num'));
    }

    public function user_messages_detail(Request $request,$message_id)
    {
        $page_name = "tra";
        $type = 0;
        $user_ads_num = Poster::where('user_id',Auth::user()->id)->count();
        $user_pendding_num = Poster::where('user_id',Auth::user()->id)->where('status','0')->count();
        $user_draft_num = Poster::where('user_id',Auth::user()->id)->where('user_confirm','0')->count();
       
        
        $all_message = Message::find($message_id);
        if($all_message->status == 0)
        {
            $all_message->status = '1';
            $all_message->save();
        }
        $num_read = Message::where('receiver',Auth::user()->id)->where('status',1)->where('del_r',0)->count();
        $num_unread = Message::where('receiver',Auth::user()->id)->where('status',0)->where('del_r',0)->count();
        $num_sent = Message::where('sender',Auth::user()->id)->where('del_s',0)->count();
        return view('user.user_messages_detail',compact('page_name','user_draft_num','user_ads_num','all_message','num_read','num_unread','num_sent','user_pendding_num'));
    }

    public function user_messages_delete_r(Request $request,$message_id)
    {          
        $all_message = Message::find($message_id);
        if($all_message->del_s == "1")
        {
            $all_message->delete();
        }
        else
        {
            $all_message->del_r = "1";
            $all_message->save();
        }
       
        return back();
    }
    public function user_messages_delete_s(Request $request,$message_id)
    {          
        $all_message = Message::find($message_id);
        if($all_message->del_r == "1")
        {
            $all_message->delete();
        }
        else
        {
            $all_message->del_s = "1";
            $all_message->save();
        }
        
        return back();
    }

    public function classified_details(Request $request)
    {
        $category_id = $request->get('categoryID');
        if(empty($category_id))
        {
            return redirect(route('create_post'));
        }
        $cur_category = Post_Category::find($category_id);
        $selected_sub_catID = array();
        foreach($request->get('subcategoryselect') as $item)
        {
            array_push($selected_sub_catID,$item);
        }       
        $selected_sub_cat = Post_SubCategory::whereIn('id',$selected_sub_catID)->get();
        $unselected_sub_cat = Post_SubCategory::where('parent_id',$category_id)->whereNotIn('id',$selected_sub_catID)->get();        
        $all_country = Country::all();       
        return view('user.classified_details',compact('cur_category','all_country','selected_sub_cat','unselected_sub_cat'));
    }
    

    public function user_profile_update(Request $request)
    {
        
        $data = array();
        $temp_info = "";
        if(!empty(request()->user_Image))
        {
            $img_type = request()->user_Image->getClientOriginalExtension();            
            if($img_type =="jpg" or $img_type =="png")
            {
                $imgName = time().'.'.$img_type;
                request()->user_Image->move(public_path('upload/user'),$imgName);
                $imgName = "upload/user/".$imgName;
                $img = Image::make($imgName)->resize(150, 150);
                $img->save($imgName);
                $data["p_image"] = "picture";
                $temp_info = $temp_info." picture ";
            }
            else
            {                
                return back()->with("error1","Incorrect Image Type.");
            }
        }
        
        $temp_user = User::find(Auth::user()->id);
        if(!empty(request()->user_Image))
        {
            $temp_user->image = $imgName;
        }
         
        $temp_user->email = $request->get('email');

        if($temp_user->fname != $request->get('fname'))
        {
            $temp_user->fname = $request->get('fname');
            $data["fname"] = "first name";
            $temp_info = $temp_info." first name ";
            $data["fnameC"] = $request->get('fname');
        }
        else
        {
            $data["fnameC"] = Auth::user()->fname;
        }
        if($temp_user->lname != $request->get('lname'))
        {
            $temp_user->lname = $request->get('lname');
            $data["lname"] = "last name";
            $temp_info = $temp_info." last name ";  
            $data["lnameC"] = $request->get('lname');         
        }
        else
        {
            $data["lnameC"] = Auth::user()->lname;
        }        
                
        if($temp_user->phone != $request->get('phone'))
        {
            $temp_user->phone = $request->get('phone');
            $data["p_phone"] = "phone_number";
            $temp_info = $temp_info." phone_number ";
        }
        if($temp_user->city != $request->get('city'))
        {
            $temp_user->city = $request->get('city');
            $temp_user->country = $request->get('country');           
            $temp_user->state = $request->get('state');
            $data["p_location"] = "location";
            $temp_info = $temp_info." location ";
        }
        if($temp_user->address != $request->get('address'))
        {
            $temp_user->address = $request->get('address');
            $data["p_address"] = "address";
            $temp_info = $temp_info." address ";
        }
        if($temp_user->zip != $request->get('zip'))
        {
            $temp_user->zip = $request->get('zip');
            $data["p_zip"] = "zip";
            $temp_info = $temp_info." zip ";
        }
        if($temp_user->type != $request->get('type'))
        {
            $temp_user->type = $request->get('type');
            $data["p_type"] = "type";
            $temp_info = $temp_info." type ";
        }
        if($temp_user->phone_code != $request->get('phonecode'))
        {
            $temp_user->phone_code = $request->get('phonecode');
            $data["p_phonecode"] = "phonecode";
            $temp_info = $temp_info." phonecode ";
        }            
               
        $temp_user->receive_b_s = $request->get('receive_b_s');
        
        if($temp_info != "")
        {
            if($temp_user->save())
            {
                
                $temp_info_text = "Your profile ".$temp_info." updated successfully!";                
                
                $data["adminmail"] = Contact::find(1)->support;
                $toEmail = Auth::user()->email;
                
                Mail::to($toEmail)->send(new UpdateProfile($data));
                return back()->with("success",$temp_info_text);
            }
            else
            {
                return back()->with("error","Update faild! Please try again.");
            }
        }
        else
        {
            return back()->with("error","There is no change.");
        }
            
    }

    public function poster_store(Request $request)
    {                     
        $sub_parent_id = array();
       
        $conditionM = array();

        $parent_id         = $request->get('categoryID');
        $sub_parent_id     = $request->get('subcategoryselect');
        $imgNames = "";
        
       
        if(!empty($request->get('image_name')))
        {            
            $imgNames = json_encode($request->get('image_name'));            
        }


        if(!empty($request->get('conditionM')))
        {
            $tempM = $request->get('conditionM');
        
            for($i=0;$i<count($tempM);$i++)
            {
                array_push($conditionM,$tempM[$i]);
            }
        }        

        $findcomma = ",";
        $citystring = $request->get('service_city');
        $pos = strpos($citystring,$findcomma);
        if($pos === false)
        {
            $city = $citystring;            
        }
        else
        {
            $city = substr($citystring,0,$pos);
        }
        $total_price = 0;
        $unit_price = (float) Post_Category::find($parent_id)->price;
        

        for($i=0;$i<count($sub_parent_id);$i++)
        {            
            $total_price += $unit_price;
        }
        
        $total_price = round($total_price, 2);
        
        if(!empty($request->get('title')))
        {            
            if(Auth::user()->email_verified_at)
            {
                $user_verify = "0";
            }
            else
            {
                $user_verify = "9";
            }
            if(empty($request->get('in_service_county')))
            {
                $county = $this->getCounty($request->get('in_service_state'),$request->get('in_service_city')); 
            }
            else
            {
                $county = $request->get('in_service_county');
            }
            $cur_poster = Poster::create([
                'user_id'           => Auth::user()->id,
                'category_id'       => $parent_id,
                'title'             => $request->get('title'),                          
                'classifiedbody'    => $request->get('classifiedbody'),
                'estimated_rent'    => $request->get('estimated_rent'),
                'utilities'         => $request->get('utilities'),
                'address'           => $request->get('service_address'),
                'in_city'           => $request->get('in_service_city'),
                'in_county'         => $county,
                'in_state'          => $request->get('in_service_state'),
                'in_zip'            => $request->get('in_service_zip'),
                'in_country'        => $request->get('in_service_country'),
                'city'              => $city,
                'state'             => $request->get('service_state'),
                'zip'               => $request->get('service_zip'),
                'country'           => $request->get('service_country'),
                'contact_email'     => $request->get('contact_email'),
                'contact_phone'     => $request->get('contact_phone'),
                'contact_url'       => $request->get('contact_url'),
                'preferred_email'   => $request->get('preferred_email'),
                'preferred_phone'   => $request->get('preferred_phone'),
                'preferred_url'     => $request->get('preferred_url'),
                'dont_reply'        => $request->get('dont_reply'),
                'post_image1'       => $imgNames,
                'post_image2'       => "",
                'post_image3'       => "",
                'user_verify'       => "",
                'status'            => $user_verify,
                'lat'               => $request->get('latitude'),
                'lng'               => $request->get('longitude'),
                'provider_name'     => $request->get('provider_name'),
                'sale_year'         => $request->get('year'),
                'sale_color'        => $request->get('color'),
                'sale_make'         => $request->get('sale_make'),
                'sale_model'        => $request->get('sale_model'),
                'sale_detail'       => $request->get('sale_detail'),                
                'listedby'          => $request->get('listedby'),
                'e_date'            => $request->get('e_date'),
                's_date'            => $request->get('s_date'),
                'events_attending'  => $request->get('events_attending'),
                'events_tickets'    => $request->get('events_tickets'),
                'usedstatus'        => $request->get('condition'),
                'condition'         => $request->get('required'),
                'conditionM'        => json_encode($conditionM),
                'job_industry'      => $request->get('job_industry'),                
                'job_level'         => $request->get('job_level'),
                'user_confirm'      => "0",            
                'open_position'     => $request->get('open_position'),
                'min_exp'           => $request->get('min_exp'),
                'max_exp'           => $request->get('max_exp'),
                'work_auth_any'     => $request->get('work_auth_any'),
                'work_auth_citizen' => $request->get('work_auth_citizen'),
                'work_auth_green'   => $request->get('work_auth_green'),
                'work_auth_ead'     => $request->get('work_auth_ead'),
                'work_auth_h1b'     => $request->get('work_auth_h1b'),                
                'work_auth_h4'      => $request->get('work_auth_h4'),
                'work_auth_l1'      => $request->get('work_auth_l1'),
                'work_auth_l2'      => $request->get('work_auth_l2'),
                'work_auth_opt'     => $request->get('work_auth_opt'),
                'work_auth_m1'      => $request->get('work_auth_m1'),
                'work_auth_j1'      => $request->get('work_auth_j1'),
                'work_auth_other'   => $request->get('work_auth_other'), 
                'contact_phone_code'=> $request->get('contact_phone_code'), 
                'total_price'       => $total_price,
            ]);
            
            $cur_posterID = $cur_poster->id;
           
            for($i=0;$i<count($sub_parent_id);$i++)
            {
                PosterCategory::create([
                    'poster_id'     => $cur_posterID,
                    'parent_id'     => $parent_id,
                    'subparent_id'  => $sub_parent_id[$i],
                    'user_id'       => Auth::user()->id,
                ]);
               
            }
            $cur_poster_temp = PosterCategory::where('user_id',Auth::user()->id)->latest()->first();
            
            if(!empty($request->get('skill_name')))
            {
                $skill_name = $request->get('skill_name');
                $skill_exp  = $request->get('skill_exp');
                $skill_level= $request->get('skill_level');
                
                for($i=0;$i<count($request->get('skill_name'));$i++)
                {
                    PostSkill::create([
                        'user_id'     => Auth::user()->id,
                        'poster_id'   => $cur_posterID,
                        'skill_name'  => $skill_name[$i],
                        'skill_exp'   => $skill_exp[$i],
                        'skill_level' => $skill_level[$i],
                    ]);
                }
            }
            
            
            if(!empty($request->get('benefit_checked')))
            {
                $benefit_checked   = $request->get('benefit_checked');
                $benefit_name    = $request->get('benefit_name');
                $benefit_default = $request->get('benefit_default');
                
                for($i=0;$i<count($request->get('benefit_name'));$i++)
                {
                    Benefit::create([
                        'user_id'        => Auth::user()->id,
                        'poster_id'      => $cur_posterID,
                        'checked'  => $benefit_checked[$i],
                        'name'     => $benefit_name[$i],
                        'default'  => $benefit_default[$i],
                    ]);
                }
            }

            if(!empty($request->get('item_sel')))
            {
                $item_sel = $request->get('item_sel');
                $item_name  = $request->get('item_name');
                $item_value= $request->get('item_value');
                $item_date= $request->get('item_date');
                $item_location= $request->get('item_location');
                
                for($i=0;$i<count($request->get('item_sel'));$i++)
                {
                    FoundLost::create([
                        'user_id'        => Auth::user()->id,
                        'poster_id'      => $cur_posterID,
                        'item_sel'       => $item_sel[$i],
                        'item_name'      => $item_name[$i],
                        'item_value'     => $item_value[$i],
                        'item_date'      => $item_date[$i],
                        'item_location'  => $item_location[$i],
                    ]);
                }
            }

            if(!empty($request->get('degree')))
            {
                $degree = $request->get('degree');
                $area  = $request->get('area');
                $years = $request->get('years');
                
                for($i=0;$i<count($request->get('degree'));$i++)
                {
                    Education::create([
                        'user_id'     => Auth::user()->id,
                        'poster_id'   => $cur_posterID,
                        'degree'       => $degree[$i],
                        'area'        => $area[$i],
                        'years'       => $years[$i],
                    ]);
                }
            }
            if(!empty($request->get('provider_item')))
            {
                $provider_item = $request->get('provider_item');
                               
                for($i=0;$i<count($provider_item);$i++)
                {
                    Provider::create([
                        'user_id'     => Auth::user()->id,
                        'poster_id'   => $cur_posterID,
                        'parent_id'   => $parent_id,
                        'name'        => $provider_item[$i],
                    ]);
                }
            }

            if(!empty($request->get('life_item')))
            {
                $life_item = $request->get('life_item');
                               
                for($i=0;$i<count($life_item);$i++)
                {
                    LifeStyle::create([
                        'user_id'     => Auth::user()->id,
                        'poster_id'   => $cur_posterID,
                        'parent_id'   => $parent_id,
                        'name'        => $life_item[$i],
                    ]);
                } 
            }
                        
            if(!empty($request->get('complex_item')))
            {
                $complex_item = $request->get('complex_item');
                               
                for($i=0;$i<count($complex_item);$i++)
                {
                    CProvider::create([
                        'user_id'     => Auth::user()->id,
                        'poster_id'   => $cur_posterID,
                        'parent_id'   => $parent_id,
                        'name'        => $complex_item[$i],
                    ]);
                }
            }
            
                       
            if(Poster::find($cur_posterID)->total_price > 0) 
            {
                            
                $cur_poster = Poster::find($cur_posterID);        
                $cur_poster_sub = PosterCategory::where('poster_id',$cur_posterID)->get();
                return view('user.view_invoice',compact('cur_poster','cur_poster_sub'));                
                    
            }
            else
            {
                if(Auth::user()->email_verified_at)
                {
                    $request->session()->put('poster_id','');
                    $temp = Poster::find($cur_posterID);
                    $temp->user_confirm = "1";
                    $temp->save();

                    $feedback = array();
                    $feedback["name"] = Auth::user()->name;      
                    $toEmail = Auth::user()->email;
                    Mail::to($toEmail)->send(new FeedbackMail($feedback));
                        
                    $feedback["postID"] = $cur_posterID;
                    $feedback["location"] = $temp->in_city.",".$temp->in_state.",".$temp->in_country;
                    $feedback["category"] = Post_Category::find($temp->category_id)->name;
                    $feedback["subcategory"] = PosterCategory::where('poster_id',$cur_posterID)->get();
                    $toEmail = Contact::find('1')->global;            
                    Mail::to($toEmail)->send(new FeedbackMail($feedback));
                }
                else
                {
                    $post_id = \Illuminate\Support\Facades\Crypt::encryptString($cur_posterID);
                    $data = array();
                    $data["subject"] = $cur_poster->title; 
                    $data['subcategory'] = PosterCategory::where('poster_id',$cur_posterID)->get();
                    $data["category"] = Post_Category::find($cur_poster->category_id)->name;
                    $data["location"] = $cur_poster->address.", ".$cur_poster->in_city.", ".$cur_poster->in_state.", ".$cur_poster->in_country;
                    $data["code"] = $post_id;
                    $sendmail = Auth::user()->email;
                    Mail::to($sendmail)->send(new SendCode($data));
                }

                return redirect(route('final_page'));
            }
        }
        else
        {
            return redirect(route('create_post'));
        }
       
    }

    public function poster_update(Request $request)
    {
        $conditionM = array();
        
        $imgNames = "";
        
        if(!empty($request->get('image_name')))
        {            
            $imgNames = json_encode($request->get('image_name'));            
        }

        $cur_poster_id = $request->get('cur_poster_id');
        $cur_poster = Poster::find($cur_poster_id);
        $temp_skills = PostSkill::where('poster_id',$cur_poster_id)->get();
        foreach($temp_skills as $item)
        {
            $item->delete();
        }
        $temp_benefit = Benefit::where('poster_id',$cur_poster_id)->get();
        foreach($temp_benefit as $item)
        {
            $item->delete();
        }

        $temp_provider = Provider::where('poster_id',$cur_poster_id)->get();
        if(!empty($temp_provider))
        {
            foreach ($temp_provider as $item) {
                $item->delete();
            }
        }
           
        $temp_life = LifeStyle::where('poster_id',$cur_poster_id)->get();
        if(!empty($temp_life))
        {
            foreach ($temp_life as $item) {
                $item->delete();
            }
        }

        $temp_cprovider = CProvider::where('poster_id',$cur_poster_id)->get();
        if(!empty($temp_provider))
        {
            foreach ($temp_cprovider as $item) {
                $item->delete();
            }
        }
        $temp_foundlost = FoundLost::where('poster_id',$cur_poster_id)->get();
        if(!empty($temp_foundlost))
        {
            foreach ($temp_foundlost as $item) {
                $item->delete();
            }
        }
        
        if(!empty($request->get('conditionM')))
        {
            $tempM = $request->get('conditionM');
                       
            for($i=0;$i<count($tempM);$i++)
            {
                array_push($conditionM,$tempM[$i]);
            }
        }
        

        $cur_poster->user_id           =  Auth::user()->id;
        $cur_poster->title             =  $request->get('title');
        $cur_poster->classifiedbody    =  $request->get('classifiedbody');
        $cur_poster->estimated_rent    =  $request->get('estimated_rent');
        $cur_poster->utilities         =  $request->get('utilities');
        $cur_poster->address           =  $request->get('service_address');
        $cur_poster->city              =  $request->get('service_city');
        $cur_poster->state             =  $request->get('service_state');
        $cur_poster->zip               =  $request->get('service_zip');
        $cur_poster->country           =  $request->get('service_country');
        $cur_poster->in_city           =  $request->get('in_service_city');
        $cur_poster->in_state          =  $request->get('in_service_state');
        $cur_poster->in_zip            =  $request->get('in_service_zip');
        $cur_poster->in_country        =  $request->get('in_service_country');
        $cur_poster->contact_email     =  $request->get('contact_email');
        $cur_poster->contact_phone     =  $request->get('contact_phone');
        $cur_poster->contact_url       =  $request->get('contact_url');
        $cur_poster->preferred_email   =  $request->get('preferred_email');
        $cur_poster->preferred_phone   =  $request->get('preferred_phone');
        $cur_poster->preferred_url     =  $request->get('preferred_url');
        $cur_poster->dont_reply        =  $request->get('dont_reply'); 
        $cur_poster->usedstatus        =  $request->get('condition');
        $cur_poster->conditionM        =  json_encode($conditionM);

        $cur_poster->provider_name     =  $request->get('provider_name');
        $cur_poster->sale_year         =  $request->get('year');
        $cur_poster->sale_color        =  $request->get('color');
        $cur_poster->sale_make        =  $request->get('sale_make');
        $cur_poster->sale_model        =  $request->get('sale_model');
        $cur_poster->sale_detail        =  $request->get('sale_detail');
        $cur_poster->listedby          =  $request->get('listedby');
        $cur_poster->e_date            =  $request->get('e_date');
        $cur_poster->s_date            =  $request->get('s_date');
        $cur_poster->events_attending  =  $request->get('events_attending');
        $cur_poster->events_tickets    =  $request->get('events_tickets');
        $cur_poster->job_industry      =  $request->get('job_industry');
        $cur_poster->job_level         =  $request->get('job_level');

        $cur_poster->open_position         =  $request->get('open_position');
        $cur_poster->min_exp         =  $request->get('min_exp');
        $cur_poster->max_exp         =  $request->get('max_exp');
        $cur_poster->work_auth_any    =  $request->get('work_auth_any');
        $cur_poster->work_auth_citizen  =  $request->get('work_auth_citizen');
        $cur_poster->work_auth_green    =  $request->get('work_auth_green');
        $cur_poster->work_auth_ead      =  $request->get('work_auth_ead');
        $cur_poster->work_auth_h1b      =  $request->get('work_auth_h1b');
        $cur_poster->work_auth_h4       =  $request->get('work_auth_h4');
        $cur_poster->work_auth_l1       =  $request->get('work_auth_l1');
        $cur_poster->work_auth_l2       =  $request->get('work_auth_l2');
        $cur_poster->work_auth_opt      =  $request->get('work_auth_opt');
        $cur_poster->work_auth_m1       =  $request->get('work_auth_m1');
        $cur_poster->work_auth_j1       =  $request->get('work_auth_j1');
        $cur_poster->work_auth_other    =  $request->get('work_auth_other');
        $cur_poster->contact_phone_code =  $request->get('contact_phone_code');
        $cur_poster->post_image1        =  $imgNames;

        if(!empty($request->get('latitude')))
        {
            $cur_poster->lat                =  $request->get('latitude');
            $cur_poster->lng                =  $request->get('longitude');
        } 
           
        $cur_poster->save();

        $parent_id         = $request->get('cur_category_id');

            if(!empty($request->get('benefit_checked')))
            {
                $benefit_checked   = $request->get('benefit_checked');
                $benefit_name    = $request->get('benefit_name');
                $benefit_default = $request->get('benefit_default');
                
                for($i=0;$i<count($request->get('benefit_name'));$i++)
                {
                    Benefit::create([
                        'user_id'        => Auth::user()->id,
                        'poster_id'      => $cur_poster_id,
                        'checked'  => $benefit_checked[$i],
                        'name'     => $benefit_name[$i],
                        'default'  => $benefit_default[$i],
                    ]);
                }
            }
            
            if(!empty($request->get('skill_name')))
            {

                $skill_name = $request->get('skill_name');
                $skill_exp  = $request->get('skill_exp');
                $skill_level= $request->get('skill_level');
                
                for($i=0;$i<count($request->get('skill_name'));$i++)
                {
                    PostSkill::create([
                        'user_id'     => Auth::user()->id,
                        'poster_id'   => $cur_poster_id,
                        'skill_name'  => $skill_name[$i],
                        'skill_exp'   => $skill_exp[$i],
                        'skill_level' => $skill_level[$i],
                    ]);
                }
            }
            if(!empty($request->get('item_sel')))
            {
                $item_sel = $request->get('item_sel');
                $item_name  = $request->get('item_name');
                $item_value= $request->get('item_value');
                $item_date= $request->get('item_date');
                $item_location= $request->get('item_location');
                
                for($i=0;$i<count($request->get('item_sel'));$i++)
                {
                    FoundLost::create([
                        'user_id'        => Auth::user()->id,
                        'poster_id'      => $cur_poster_id,
                        'item_sel'       => $item_sel[$i],
                        'item_name'      => $item_name[$i],
                        'item_value'     => $item_value[$i],
                        'item_date'      => $item_date[$i],
                        'item_location'  => $item_location[$i],
                    ]);
                }
            }

            if(!empty($request->get('degree')))
            {
                $degree = $request->get('degree');
                $area  = $request->get('area');
                $years = $request->get('years');
                
                for($i=0;$i<count($request->get('degree'));$i++)
                {
                    Education::create([
                        'user_id'     => Auth::user()->id,
                        'poster_id'   => $cur_poster_id,
                        'degree'       => $degree[$i],
                        'area'        => $area[$i],
                        'years'       => $years[$i],
                    ]);
                }
            }
            if(!empty($request->get('provider_item')))
            {
                
                $provider_item = $request->get('provider_item');
                               
                for($i=0;$i<count($provider_item);$i++)
                {
                    Provider::create([
                        'user_id'     => Auth::user()->id,
                        'poster_id'   => $cur_poster_id,
                        'parent_id'   => $parent_id,
                        'name'        => $provider_item[$i],
                    ]);
                }
            }

            if(!empty($request->get('life_item')))
            {
                $life_item = $request->get('life_item');
                               
                for($i=0;$i<count($life_item);$i++)
                {
                    LifeStyle::create([
                        'user_id'     => Auth::user()->id,
                        'poster_id'   => $cur_poster_id,
                        'parent_id'   => $parent_id,
                        'name'        => $life_item[$i],
                    ]);
                }
            }

            if(!empty($request->get('complex_item')))
            {
                $complex_item = $request->get('complex_item');
                               
                for($i=0;$i<count($complex_item);$i++)
                {
                    CProvider::create([
                        'user_id'     => Auth::user()->id,
                        'poster_id'   => $cur_poster_id,
                        'parent_id'   => $parent_id,
                        'name'        => $complex_item[$i],
                    ]);
                }
            }
            $data = array();
            $data["name"] = Auth::user()->name;
            $data["adminmail"] = Contact::find(1)->support;
            $data["status"] = "postup"; 
            $toEmail = Auth::user()->email;
            Mail::to($toEmail)->send(new UpdateProfile($data));         
            return redirect(route('user_pending_approval_ads'));       
       
    }
    public function poster_updateback(Request $request)
    {   
        $conditionM = array();        

        $imgNames = "";
        
        if(!empty($request->get('image_name')))
        {            
            $imgNames = json_encode($request->get('image_name'));            
        }
        
        $cur_poster_id = $request->get('cur_poster_id');
        $cur_poster = Poster::find($cur_poster_id);
        $temp_skills = PostSkill::where('poster_id',$cur_poster_id)->get();
        foreach($temp_skills as $item)
        {
            $item->delete();
        }
        $temp_education = Education::where('poster_id',$cur_poster_id)->get();
        foreach($temp_education as $item)
        {
            $item->delete();
        }
        $temp_benefit = Benefit::where('poster_id',$cur_poster_id)->get();
        foreach($temp_benefit as $item)
        {
            $item->delete();
        }

        $temp_provider = Provider::where('poster_id',$cur_poster_id)->get();
        if(!empty($temp_provider))
        {
            foreach ($temp_provider as $item) {
                $item->delete();
            }
        }
            
        $temp_life = LifeStyle::where('poster_id',$cur_poster_id)->get();
        if(!empty($temp_life))
        {
            foreach ($temp_life as $item) {
                $item->delete();
            }
        }

        $temp_cprovider = CProvider::where('poster_id',$cur_poster_id)->get();
        if(!empty($temp_provider))
        {
            foreach ($temp_cprovider as $item) {
                $item->delete();
            }
        }
        $temp_foundlost = FoundLost::where('poster_id',$cur_poster_id)->get();
        if(!empty($temp_foundlost))
        {
            foreach ($temp_foundlost as $item) {
                $item->delete();
            }
        }

        if(!empty($request->get('conditionM')))
        {
            $tempM = $request->get('conditionM');
                       
            for($i=0;$i<count($tempM);$i++)
            {
                array_push($conditionM,$tempM[$i]);
            }
        }
        
        $total_price = 0;
        $unit_price = (float) Post_Category::find($request->get('cur_category_id'))->price;
                
        for($i=0;$i<count($request->get('sub_parent_id'));$i++)
        {            
            $total_price += $unit_price;
        }
        $total_price = round($total_price, 2);
        
       

        $cur_poster->user_id           =  Auth::user()->id;
        $cur_poster->title             =  $request->get('title');
        $cur_poster->classifiedbody    =  $request->get('classifiedbody');
        $cur_poster->estimated_rent    =  $request->get('estimated_rent');
        $cur_poster->utilities         =  $request->get('utilities');
        $cur_poster->address           =  $request->get('service_address');
        $cur_poster->city              =  $request->get('service_city');
        $cur_poster->state             =  $request->get('service_state');
        $cur_poster->zip               =  $request->get('service_zip');
        $cur_poster->country           =  $request->get('service_country');
        $cur_poster->in_city           =  $request->get('in_service_city');
        $cur_poster->in_state          =  $request->get('in_service_state');
        $cur_poster->in_zip            =  $request->get('in_service_zip');
        $cur_poster->in_country        =  $request->get('in_service_country');
        $cur_poster->contact_email     =  $request->get('contact_email');
        $cur_poster->contact_phone     =  $request->get('contact_phone');
        $cur_poster->contact_url       =  $request->get('contact_url');
        $cur_poster->preferred_email   =  $request->get('preferred_email');
        $cur_poster->preferred_phone   =  $request->get('preferred_phone');
        $cur_poster->preferred_url     =  $request->get('preferred_url');
        $cur_poster->dont_reply        =  $request->get('dont_reply'); 
        $cur_poster->usedstatus        =  $request->get('condition');
        $cur_poster->conditionM        =  json_encode($conditionM);

        $cur_poster->provider_name     =  $request->get('provider_name');
        $cur_poster->sale_year         =  $request->get('year');
        $cur_poster->sale_color        =  $request->get('color');
        $cur_poster->sale_make        =  $request->get('sale_make');
        $cur_poster->sale_model        =  $request->get('sale_model');
        $cur_poster->sale_detail        =  $request->get('sale_detail');
        $cur_poster->listedby          =  $request->get('listedby');
        $cur_poster->e_date            =  $request->get('e_date');
        $cur_poster->s_date            =  $request->get('s_date');
        $cur_poster->events_attending  =  $request->get('events_attending');
        $cur_poster->events_tickets    =  $request->get('events_tickets');
        $cur_poster->job_industry      =  $request->get('job_industry');
        $cur_poster->job_level         =  $request->get('job_level');

        $cur_poster->open_position         =  $request->get('open_position');
        $cur_poster->min_exp         =  $request->get('min_exp');
        $cur_poster->max_exp         =  $request->get('max_exp');
        $cur_poster->work_auth_any    =  $request->get('work_auth_any');
        $cur_poster->work_auth_citizen  =  $request->get('work_auth_citizen');
        $cur_poster->work_auth_green    =  $request->get('work_auth_green');
        $cur_poster->work_auth_ead      =  $request->get('work_auth_ead');
        $cur_poster->work_auth_h1b      =  $request->get('work_auth_h1b');
        $cur_poster->work_auth_h4       =  $request->get('work_auth_h4');
        $cur_poster->work_auth_l1       =  $request->get('work_auth_l1');
        $cur_poster->work_auth_l2       =  $request->get('work_auth_l2');
        $cur_poster->work_auth_opt      =  $request->get('work_auth_opt');
        $cur_poster->work_auth_m1       =  $request->get('work_auth_m1');
        $cur_poster->work_auth_j1       =  $request->get('work_auth_j1');
        $cur_poster->work_auth_other    =  $request->get('work_auth_other');
        $cur_poster->contact_phone_code =  $request->get('contact_phone_code');
        $cur_poster->total_price        =  $total_price;
        $cur_poster->post_image1        =  $imgNames;

        if(!empty($request->get('latitude')))
        {
            $cur_poster->lat                =  $request->get('latitude');
            $cur_poster->lng                =  $request->get('longitude');        
        }        
        
        $cur_poster->save();

            $temp_sub = PosterCategory::where('poster_id',$cur_poster_id)->get();
            foreach($temp_sub as $item)
            {
                $item->delete();
            }
            $sub_parent_id = array();
            $parent_id         = $request->get('cur_category_id');
            $sub_parent_id     = $request->get('sub_parent_id');    
            
           
           
            for($i=0;$i<count($sub_parent_id);$i++)
            {
                PosterCategory::create([
                    'poster_id'     => $cur_poster_id,
                    'parent_id'     => $parent_id,
                    'subparent_id'  => $sub_parent_id[$i],
                    'user_id'       => Auth::user()->id,
                ]);
               
            }

            if(!empty($request->get('benefit_checked')))
            {
                $benefit_checked   = $request->get('benefit_checked');
                $benefit_name    = $request->get('benefit_name');
                $benefit_default = $request->get('benefit_default');
                
                for($i=0;$i<count($request->get('benefit_name'));$i++)
                {
                    Benefit::create([
                        'user_id'        => Auth::user()->id,
                        'poster_id'      => $cur_poster_id,
                        'checked'  => $benefit_checked[$i],
                        'name'     => $benefit_name[$i],
                        'default'  => $benefit_default[$i],
                    ]);
                }
            }
            
            if(!empty($request->get('skill_name')))
            {

                $skill_name = $request->get('skill_name');
                $skill_exp  = $request->get('skill_exp');
                $skill_level= $request->get('skill_level');
                
                for($i=0;$i<count($request->get('skill_name'));$i++)
                {
                    PostSkill::create([
                        'user_id'     => Auth::user()->id,
                        'poster_id'   => $cur_poster_id,
                        'skill_name'  => $skill_name[$i],
                        'skill_exp'   => $skill_exp[$i],
                        'skill_level' => $skill_level[$i],
                    ]);
                }
            }
            if(!empty($request->get('item_sel')))
            {
                $item_sel = $request->get('item_sel');
                $item_name  = $request->get('item_name');
                $item_value= $request->get('item_value');
                $item_date= $request->get('item_date');
                $item_location= $request->get('item_location');
                
                for($i=0;$i<count($request->get('item_sel'));$i++)
                {
                    FoundLost::create([
                        'user_id'        => Auth::user()->id,
                        'poster_id'      => $cur_poster_id,
                        'item_sel'       => $item_sel[$i],
                        'item_name'      => $item_name[$i],
                        'item_value'     => $item_value[$i],
                        'item_date'      => $item_date[$i],
                        'item_location'  => $item_location[$i],
                    ]);
                }
            }

            if(!empty($request->get('degree')))
            {
                $degree = $request->get('degree');
                $area  = $request->get('area');
                $years = $request->get('years');
                
                for($i=0;$i<count($request->get('degree'));$i++)
                {
                    Education::create([
                        'user_id'     => Auth::user()->id,
                        'poster_id'   => $cur_poster_id,
                        'degree'       => $degree[$i],
                        'area'        => $area[$i],
                        'years'       => $years[$i],
                    ]);
                }
            }
            if(!empty($request->get('provider_item')))
            {
                $provider_item = $request->get('provider_item');
                               
                for($i=0;$i<count($provider_item);$i++)
                {
                    Provider::create([
                        'user_id'     => Auth::user()->id,
                        'poster_id'   => $cur_poster_id,
                        'parent_id'   => $parent_id,
                        'name'        => $provider_item[$i],
                    ]);
                }
            }

            if(!empty($request->get('life_item')))
            {
                $life_item = $request->get('life_item');
                               
                for($i=0;$i<count($life_item);$i++)
                {
                    LifeStyle::create([
                        'user_id'     => Auth::user()->id,
                        'poster_id'   => $cur_poster_id,
                        'parent_id'   => $parent_id,
                        'name'        => $life_item[$i],
                    ]);
                }
            }

            if(!empty($request->get('complex_item')))
            {
                $complex_item = $request->get('complex_item');
                               
                for($i=0;$i<count($complex_item);$i++)
                {
                    CProvider::create([
                        'user_id'     => Auth::user()->id,
                        'poster_id'   => $cur_poster_id,
                        'parent_id'   => $parent_id,
                        'name'        => $complex_item[$i],
                    ]);
                }
            }
           
            return redirect(route('post_preview',$cur_poster_id));      
       
    }
    public function post_preview(Request $request,$poster_id)
    {
        $cur_date = date('Y-m-d H:i:s', time());
        $cur_poster_temp = PosterCategory::where('poster_id',$poster_id)->first();       
        if(!empty($cur_poster_temp))
        {
            $cur_poster_provide     = Provider::where('poster_id',$poster_id)->get();
            $cur_poster_life        = LifeStyle::where('poster_id',$poster_id)->get();
            $cur_poster_skill       = PostSkill::where('poster_id',$poster_id)->get();
            $cur_poster_complex     = CProvider::where('poster_id',$poster_id)->get(); 
            $cur_poster_education   = Education::where('poster_id',$poster_id)->get(); 
            $cur_poster_foundlost   = FoundLost::where('poster_id',$poster_id)->get(); 
            $cur_poster_benefit     = Benefit::where('poster_id',$poster_id)->where('checked','1')->get();
            return view('user.post_preview',compact('cur_poster_benefit','cur_date','cur_poster_temp','cur_poster_life','cur_poster_provide','cur_poster_skill','cur_poster_complex','cur_poster_education','cur_poster_foundlost'));
        }
        else{
            return back()->with("error","Sorry, This post has been deleted.");
        }
        
    }

    public function post_final(Request $request)
    {
        
        $post_id = \Illuminate\Support\Facades\Crypt::decrypt($request->post_id);
        if(Poster::find($post_id)->total_price > 0) 
        {
                        
            $cur_poster = Poster::find($post_id);        
            $cur_poster_sub = PosterCategory::where('poster_id',$post_id)->get();
            return view('user.view_invoice',compact('cur_poster','cur_poster_sub'));                
                 
        }
        else{
            $request->session()->put('poster_id','');
            $temp = Poster::find($post_id);
            $temp->user_confirm = "1";
            $temp->save();

            $feedback = array();
            $feedback["name"] = Auth::user()->name;      
            $toEmail = Auth::user()->email;
            Mail::to($toEmail)->send(new FeedbackMail($feedback));
                  
            $feedback["postID"] = $post_id;
            $feedback["location"] = $temp->in_city.",".$temp->in_state.",".$temp->in_country;
            $feedback["category"] = Post_Category::find($temp->category_id)->name;
            $feedback["subcategory"] = PosterCategory::where('poster_id',$post_id)->get();
            $toEmail = Contact::find('1')->global;            
            Mail::to($toEmail)->send(new FeedbackMail($feedback));

            return redirect(route('final_page'));
        }
        
    }

    public function view_invoice(Request $request,$post_id)
    {
        
        $cur_poster = Poster::find($post_id);
        
        $cur_poster_sub = PosterCategory::where('poster_id',$post_id)->get();
        return view('user.view_invoice',compact('cur_poster','cur_poster_sub'));
    }

    public function deleteads(Request $request,$ads_id)
    {
        Poster::find($ads_id)->delete();        
        PosterCategory::where('poster_id',$ads_id)->delete();
        CProvider::where('poster_id',$ads_id)->delete();
        Education::where('poster_id',$ads_id)->delete();
        FoundLost::where('poster_id',$ads_id)->delete();
        PostSkill::where('poster_id',$ads_id)->delete();
        Provider::where('poster_id',$ads_id)->delete();
        Benefit::where('poster_id',$ads_id)->delete();

        $data = array();
        $data["name"] = Auth::user()->name;
        $data["adminmail"] = Contact::find(1)->support;
        $data["status"] = "del"; 
        $toEmail = Auth::user()->email;
        Mail::to($toEmail)->send(new UpdateProfile($data));
        return back();
    }

    public function deletefavourate(Request $request,$ads_id)
    {
        $sel_ads = Favourate::where('ads_id',$ads_id)->where('user_id',Auth::user()->id)->first(); 
        
        $sel_ads->delete();
       
        return back();
    }

    public function editads(Request $request,$ads_id)
    {
        $cur_parent_id = PosterCategory::where('poster_id',$ads_id)->first();
        if(!empty($cur_parent_id)){
            $cur_category = Post_Category::find($cur_parent_id->parent_id);
            $cur_poster = Poster::find($ads_id);
            $cur_skills = PostSkill::where('poster_id',$ads_id)->get();
            $selected_sub_catID = array();
            $all_subcategory_temp = PosterCategory::where('poster_id',$ads_id)->get();
            $cur_poster_provide     = Provider::where('poster_id',$ads_id)->get();
            $cur_poster_life        = LifeStyle::where('poster_id',$ads_id)->get();
            $cur_poster_skill       = PostSkill::where('poster_id',$ads_id)->get();
            $cur_poster_complex     = CProvider::where('poster_id',$ads_id)->get(); 
            $cur_poster_education   = Education::where('poster_id',$ads_id)->get(); 
            $cur_poster_foundlost   = FoundLost::where('poster_id',$ads_id)->get(); 
            $cur_poster_benefit     = Benefit::where('poster_id',$ads_id)->get();
    
            foreach($all_subcategory_temp as $item)
            {
                array_push($selected_sub_catID,$item->subparent_id);
            }       
            $selected_sub_cat = Post_SubCategory::whereIn('id',$selected_sub_catID)->get();
            $unselected_sub_cat = Post_SubCategory::where('parent_id',$cur_parent_id->parent_id)->whereNotIn('id',$selected_sub_catID)->get();  
                 
            $all_country = Country::all();     
            
            return view('user.post_edit',compact('cur_category','all_country','cur_poster_benefit','cur_poster_life','selected_sub_cat','unselected_sub_cat','cur_poster','cur_skills','cur_poster_provide','cur_poster_skill','cur_poster_complex','cur_poster_education','cur_poster_foundlost'));
        }
        else
        {
            return back()->with("error","Sorry, This post has not subcategory.");
        }
    }

    public function editadsback(Request $request,$ads_id)
    {
        $cur_parent_id = PosterCategory::where('poster_id',$ads_id)->first();
        
        $cur_category = Post_Category::find($cur_parent_id->parent_id);
        $cur_poster = Poster::find($ads_id);
        
        $cur_skills = PostSkill::where('poster_id',$ads_id)->get();
        $selected_sub_catID = array();
        $all_subcategory_temp = PosterCategory::where('poster_id',$ads_id)->get();
        $cur_poster_provide     = Provider::where('poster_id',$ads_id)->get();
        $cur_poster_life        = LifeStyle::where('poster_id',$ads_id)->get();
        $cur_poster_skill       = PostSkill::where('poster_id',$ads_id)->get();
        $cur_poster_complex     = CProvider::where('poster_id',$ads_id)->get(); 
        $cur_poster_education   = Education::where('poster_id',$ads_id)->get(); 
        $cur_poster_foundlost   = FoundLost::where('poster_id',$ads_id)->get(); 
        $cur_poster_benefit     = Benefit::where('poster_id',$ads_id)->get();
        
        foreach($all_subcategory_temp as $item)
        {
            array_push($selected_sub_catID,$item->subparent_id);
        }       
        $selected_sub_cat = Post_SubCategory::whereIn('id',$selected_sub_catID)->get();
        $unselected_sub_cat = Post_SubCategory::where('parent_id',$cur_parent_id->parent_id)->whereNotIn('id',$selected_sub_catID)->get();  
          
        $all_country = Country::all();      
        return view('user.post_edit_back',compact('cur_category','all_country','cur_poster_life','cur_poster_benefit','selected_sub_cat','unselected_sub_cat','cur_poster','cur_skills','cur_poster_provide','cur_poster_skill','cur_poster_complex','cur_poster_education','cur_poster_foundlost'));
    }

    public function emailverify(Request $request)
    {
        return view('emailverify');
    }
    public function emailtextverify(Request $request)
    {
        $temp = $request->get('user_verify_text');
        $verifytext = Auth::user()->verifytext;
        
        if($temp == $verifytext)
        {
            $cur_user = User::find(Auth::user()->id);
            $cur_user->email_verified_at = date('Y-m-d H:i:s');
            
            if($cur_user->save())
            {
                $data["name"] = Auth::user()->name;
                $data["adminmail"] = Contact::find(1)->support;
                $data['status'] = "verify";
                $toEmail = Auth::user()->email;
                Mail::to($toEmail)->send(new UpdateProfile($data));

                return redirect(route('welcome'));           
            }
            else
            {
                return back()->with("error","There was some issue,Please try again or confirm your email.");
            }
        }
        return back()->with("error","Code you entered did not match.Please enter latest code received!");
    }

    public function emailverifytwo(Request $request)
    {
        $temp = $request->get('code');
        
        $verifytext = Auth::user()->verifytext;
        
        if($temp == $verifytext)
        {
            $cur_user = User::find(Auth::user()->id);
            $cur_user->email_verified_at = date('Y-m-d H:i:s');
            
            if($cur_user->save())
            {
                $data["name"] = Auth::user()->name;
                $data["adminmail"] = Contact::find(1)->support;
                $data['status'] = "verify";
                $toEmail = Auth::user()->email;
                Mail::to($toEmail)->send(new UpdateProfile($data));
                return response()->json([
                    'status' => 'ok'
                ]);
            }
            else
            {
                return response()->json([
                    'status' => 'err'
                ]);
            }
        }
        return response()->json([
            'status' => 'err'
        ]);
    }
    


    public function requestanother(Request $request)
    {
        $name = mt_rand(1000,9999);
        $data = array();
        $data["name"] = Auth::user()->name;
        $data["code"] = $name;
        $sendmail = Auth::user()->email;
        
        Mail::to($sendmail)->send(new SendCode($data));

        $cur_user = User::find(Auth::user()->id);
        
        $cur_user->verifytext = $name;
        $cur_user->save();
        return back()->with("success","The verification code was successfully sent !");
    }

    public function changepassword(Request $request)
    {
        $user =User::find($request->user()->id);
        if(!(Hash::check($request->get('currentpassword'),$user->password)))
        {
            return back()->with("error","Your current password does not matches.Please try again.");
        }
        
        $validatedData = $request->validate([
            'currentpassword' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);        

        $user->password = Hash::make($request->get('password'));
        $user->save();
        $data = array();
        $data["name"] = Auth::user()->name;
        $data["adminmail"] = Contact::find(1)->support;
        $toEmail = Auth::user()->email;
        Mail::to($toEmail)->send(new ChangePwd($data));
        return back()->with("success","Password changed successfully!");
    }

       
    public function get_state(Request $request)
    {
        $country = $request->get('country');
        $states = State::where('country_abb',$country)->get();
        
        echo json_encode($states);
    }

    
    public function send_contact(Request $request,$post_id)
    {      
        $temp = Message::where('post_id',$post_id)->where('sender',Auth::user()->id)->first();  
        if(empty($temp))
        {
            $receiver_id = Poster::find($post_id)->user_id;
            Message::create([
                'title'       =>Auth::user()->fname." ".Auth::user()->lname." requested your contact information",
                'content'     =>Auth::user()->fname." ".Auth::user()->lname." requested your contact information",
                'sender'      =>Auth::user()->id,
                'receiver'    =>$receiver_id,
                'status'      =>'0',
                'attachment'  =>'matri',
                'post_id'     =>$post_id,
                'accept_status' =>"0",
                'del_r'       =>"0",
                'del_s'       =>"0",
            ]);

            $data = array(); 
            $data["lname"] = User::find($receiver_id)->fname;
            $sendmail = User::find($receiver_id)->email;
                    
            $data["title"] = "Dear!";
            $data["content"] = "requested your contact information.";
            $data["from"] = Auth::user()->email;
            $data["nameS"] = Auth::user()->name;
           
            $data["status"] = "re_contact"; 
            
            Mail::to($sendmail)->send(new ReplyEmail($data));

            return back()->with("success","Contact request has been sent to the user successfully!");
        }
        else
        {
            return back()->with("success","Contact request has already sent before! Please wait for user response.");
        }
       
    }
    public function send_accept(Request $request,$msg_id)
    {        
        
        $data = array(); 
        $receiver_id = Message::find($msg_id)->sender;
        $data["lname"] = User::find($receiver_id)->fname;
        $sendmail = User::find($receiver_id)->email;
       
        $data["title"] = "Dear!";
        $data["content"] = "I agree your request.Check my profile below using link.";
        $data["from"] = Auth::user()->email;
        $data["nameS"] = Auth::user()->name;        
        $data["status"] = "send_accept"; 
        $data["post_id"] = Message::find($msg_id)->post_id;
        
        Mail::to($sendmail)->send(new ReplyEmail($data));
        Message::create([
            'title'       =>Auth::user()->fname." ".Auth::user()->lname." accepted your request. Check their profile",
            'content'     =>Auth::user()->fname." ".Auth::user()->lname." accepted your request. Check their profile",
            'sender'      =>Auth::user()->id,
            'receiver'    =>$receiver_id,
            'status'      =>'0',
            'attachment'  =>'matri_reply',
            'post_id'     =>Message::find($msg_id)->post_id,
            'del_r'       =>"0",
            'del_s'       =>"0",
        ]);
        $temp = Message::find($msg_id);
        $temp->accept_status = "1";
        $temp->save();

        return back()->with("success","Contact request has been sent to the user successfully!");
    }
    public function report_scam(Request $request,$post_id)
    {
        if($post_id > 0)
        {
            $report_post = Poster::find($post_id);
        }
        else
        {
            $report_post = "";
        }
        
        
        return view('report_scam',compact('report_post'));
    }

    public function final_page()
    {
        return view('user.post_final');
    }



    public function prev_poster($cur_posterID)
    {
        
    }

    public function next_poster($cur_posterID)
    {

    }
}
