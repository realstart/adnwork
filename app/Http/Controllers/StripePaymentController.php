<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use Stripe;
use App\User;
use App\Models\Poster;
use App\Models\Post_Category;
use App\Models\PosterCategory;
use App\Models\Contact;

use App\Mail\FeedbackMail;
use App\Mail\Receipts;

use Illuminate\Support\Facades\Mail;
use Exception;

class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe(Request $request)
    {
        $post_id = $request->get('post_id');
        $cur_poster = Poster::find($post_id);

        return view('stripe',compact('cur_poster'));
    }
  
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        $post_id = $request->get('post_id');
        $cur_poster = Poster::find($post_id);
        $price = $cur_poster->total_price;
        $category_id = $cur_poster->category_id;             
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET')); 
        
        try {
            $temp = Stripe\Charge::create ([
                "amount" => 100 * $price,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Payment from adnlist.com." 
            ]);
        }
        catch(Exception $e) {           
            return back()->with("error",$e->getMessage()); 
        }
        
        if($temp->status == "succeeded")
        {            
            $cur_poster->paid_status  = "Paid";
            $cur_poster->user_confirm = "1";
            $cur_poster->paid_address = $request->get('paid_address');
            $cur_poster->paid_city    = $request->get('paid_city');
            $cur_poster->paid_state   = $request->get('paid_state');
            $cur_poster->paid_zip     = $request->get('paid_zip');

            $cur_poster->save();

            Session::flash('success', 'Payment successful!');          
            
            $feedback = array();
            $feedback["lname"] = Auth::user()->lname;      
            $feedback["paid_status"] = Poster::find($post_id)->paid_status;      
            $feedback["price"] = Poster::find($post_id)->total_price;      
            $toEmail = Auth::user()->email;
            Mail::to($toEmail)->send(new FeedbackMail($feedback));

            $receipts = array();
            $receipts['lname'] = Auth::user()->lname;
            $receipts['price'] = Poster::find($post_id)->total_price;
            $receipts['category'] = Post_Category::find($category_id)->name;
            $receipts['category_price'] = Post_Category::find($category_id)->price;
            $receipts['subcategory'] = PosterCategory::where('poster_id',$post_id)->get();
            $receipts['mail'] = Contact::find('1')->report;
            
            Mail::to($toEmail)->send(new Receipts($receipts));

            
            return redirect(route('final_page'));
        }
        else
        {
            return back();
        }        
    }
}
