<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {return view('welcome');}); 
Route::get('/comingsoon', function () {return view('coming_soon');}); 
Route::get('/adminlogin', function () {
    return view('admin.adminlogin');
});
// Auth::routes();
Auth::routes(['verify' => true]);

Route::post('/login/inside', 'HomeController@login')->name('login.custom');
Route::post('/register/inside', 'HomeController@register')->name('register.custom');
Route::post('/store_profile', 'HomeController@store_profile')->name('store_profile');



Route::get('/home', 'HomeController@welcome')->name('home');
Route::any('/', 'HomeController@welcome')->name('welcome');
Route::any('/register_profile', 'HomeController@register_profile')->name('register_profile')->middleware('checkcountry');
Route::post('/setpassword', 'HomeController@setpassword')->name('setpassword')->middleware('checkcountry');


Route::any('/category_view/{category_id}/{sub_cat_id}', 'HomeController@category_view')->name('category_view')->middleware('checkcountry');
Route::any('/professional_view/{professional_id}/{sub_id}', 'HomeController@professional_view')->name('professional_view')->middleware('checkcountry');
Route::any('/professional_detail/{item_id}', 'HomeController@professional_view_detail')->name('professional_view_detail')->middleware('checkcountry');
Route::any('/professional_property/{item_id}', 'HomeController@professional_property')->name('professional_property')->middleware('checkcountry');

Route::any('/category_view/detail/{poster_id}/{sub_cat_id}', 'HomeController@poster_detail')->name('poster_detail')->middleware('checkcountry');
Route::any('/category_view/details/{poster_id}/{sub_cat_id}', 'HomeController@poster_detail')->name('poster_detail')->middleware('auth');
Route::get('/terms_use', 'HomeController@terms_use')->name('terms_use')->middleware('checkcountry');
Route::get('/privacy_policies', 'HomeController@privacy_policies')->name('privacy_policies')->middleware('checkcountry');
Route::get('/aboutus', 'HomeController@aboutus')->name('aboutus')->middleware('checkcountry');
Route::get('/cookies', 'HomeController@cookies')->name('cookies')->middleware('checkcountry');
Route::get('/post_publish/{post_id}','HomeController@post_publish')->name('post_publish');
Route::get('/user_create/{post_id}','HomeController@user_create')->name('user_create');
Route::get('/user_verify/{user_id}','HomeController@user_verify')->name('user_verify');


Route::get('/faq', 'HomeController@faq')->name('faq')->middleware('checkcountry');
Route::any('/avoid_scam', 'HomeController@avoid_scam')->name('avoid_scam')->middleware('checkcountry');
Route::any('/posting_tips', 'HomeController@posting_tips')->name('posting_tips')->middleware('checkcountry');
Route::any('/report_scame', 'HomeController@report_scame')->name('report_scame')->middleware('checkcountry');
Route::any('/privacy_policy', 'HomeController@privacy_policy')->name('privacy_policy')->middleware('checkcountry');
Route::any('/payment_policy', 'HomeController@payment_policy')->name('payment_policy')->middleware('checkcountry');
Route::any('/terms_use', 'HomeController@terms_use')->name('terms_use')->middleware('checkcountry');
Route::any('/prohibited', 'HomeController@prohibited')->name('prohibited')->middleware('checkcountry');
Route::any('/help_feedback', 'HomeController@help_feedback')->name('help_feedback')->middleware('checkcountry');
Route::any('/testimonials', 'HomeController@testimonials')->name('testimonials')->middleware('checkcountry');
Route::any('/faqs', 'HomeController@faqs')->name('faqs')->middleware('checkcountry');
Route::any('/careers', 'HomeController@careers')->name('careers');
Route::any('/guidelines', 'HomeController@guidelines')->name('guidelines')->middleware('checkcountry','auth');
Route::get('/contactus', 'HomeController@contactus')->name('contactus');
Route::post('/send_admin','HomeController@send_admin')->name('send_admin');
Route::any('/final_page','HomeController@final_page')->name('final_page');


// ---------------------------------------User_Controller------------------------------------------------------//
Route::any('/create_post', 'HomeController@create_post')->name('create_post');
Route::get('/postfreead/{category_id}', 'UserController@postfreead')->name('postfreead')->middleware('checkuserstatus','verified');

Route::any('/send_email', 'HomeController@send_email')->name('send_email');
Route::get('/user_advertisement', 'UserController@user_advertisement')->name('user_advertisement')->middleware('checkuserstatus');
Route::get('/user_profile', 'UserController@user_profile')->name('user_profile')->middleware('checkuserstatus');
Route::get('/user_change_password', 'UserController@user_change_password')->name('user_change_password')->middleware('checkuserstatus');

Route::get('/user_pending_approval_ads', 'UserController@user_pending_approval_ads')->name('user_pending_approval_ads')->middleware('checkuserstatus');
Route::get('/user_draft_ads', 'UserController@user_draft_ads')->name('user_draft_ads')->middleware('checkuserstatus');

Route::get('/user_dashboard', 'UserController@user_dashboard')->name('user_dashboard')->middleware('checkuserstatus');


Route::get('/user_messages/{message_type}', 'UserController@user_messages')->name('user_messages')->middleware('checkuserstatus');
Route::get('/user_messages_detail/{message_id}', 'UserController@user_messages_detail')->name('user_messages_detail')->middleware('checkuserstatus');
Route::get('/user_messages_delete_r/{message_id}', 'UserController@user_messages_delete_r')->name('user_messages_delete_r')->middleware('checkuserstatus');
Route::get('/user_messages_delete_s/{message_id}', 'UserController@user_messages_delete_s')->name('user_messages_delete_s')->middleware('checkuserstatus');


Route::get('/post_preview/{poster_id}', 'UserController@post_preview')->name('post_preview')->middleware('checkuserstatus');
Route::get('/post_final/{post_id}', 'UserController@post_final')->name('post_final')->middleware('checkuserstatus');

Route::post('/user_profile_update', 'UserController@user_profile_update')->name('user_profile_update')->middleware('checkuserstatus');
Route::any('/classified_details', 'UserController@classified_details')->name('classified_details')->middleware('checkuserstatus');

Route::any('/poster_store', 'UserController@poster_store')->name('poster_store')->middleware('checkuserstatus');
Route::any('/poster_update', 'UserController@poster_update')->name('poster_update')->middleware('checkuserstatus');
Route::any('/poster_updateback', 'UserController@poster_updateback')->name('poster_updateback')->middleware('checkuserstatus');

Route::any('/deleteads/{ads_id}', 'UserController@deleteads')->name('deleteads')->middleware('checkuserstatus');
Route::any('/deletefavourate/{ads_id}', 'UserController@deletefavourate')->name('deletefavourate')->middleware('checkuserstatus');

Route::any('/editads/{ads_id}', 'UserController@editads')->name('editads')->middleware('checkuserstatus');
Route::any('/editadsback/{ads_id}', 'UserController@editadsback')->name('editadsback')->middleware('checkuserstatus');
Route::any('/favourate/{ads_id}', 'UserController@favourate')->name('favourate')->middleware('checkuserstatus');

Route::get('/emailverify','UserController@emailverify')->name('emailverify');
Route::post('/emailtextverify','UserController@emailtextverify')->name('emailtextverify');
Route::get('/emailverifytwo','UserController@emailverifytwo')->name('emailverifytwo');


Route::get('/requestanother','UserController@requestanother')->name('requestanother');
Route::post('/changePassword','UserController@changePassword')->name('changePassword');

Route::get('/send_contact/{receiver_id}','UserController@send_contact')->name('send_contact')->middleware('checkuserstatus','verified');
Route::get('/send_accept/{receiver_id}','UserController@send_accept')->name('send_accept')->middleware('checkuserstatus','verified');

Route::get('/report_scam/{post_id}','UserController@report_scam')->name('report_scam')->middleware('checkuserstatus','verified');
Route::any('/view_invoice/{post_id}','Usercontroller@view_invoice')->name('view_invoice')->middleware('checkuserstatus','verified');

Route::get('/prev_poster/{post_id}','Usercontroller@prev_poster')->name('prev_poster');
Route::get('/next_poster/{post_id}','Usercontroller@next_poster')->name('next_poster');

// ajax---------------------------------------------------------------------------------------------------------//

Route::get('/get_state','UserController@get_state');
Route::post('/postimgupload','HomeController@postimgupload');
Route::get('/getcategoryinfo','HomeController@getcategoryinfo');
Route::get('/getcities','HomeController@getcities');
Route::get('/checkauth','HomeController@checkauth');
Route::post('/publish_verify','HomeController@publish_verify');
Route::post('/createpassword','HomeController@createpassword');
Route::post('/getphonenumber','HomeController@getphonenumber');



// ---------------------------------------Admin_Controller------------------------------------------------------//
Route::get('/admin/dashboard', 'AdminController@admin_dashboard')->name('admin_dashboard')->middleware('checkuserstatus','checklogin');
Route::get('/admin/reports', 'AdminController@admin_reports')->name('admin_reports')->middleware('checkuserstatus','checklogin');
Route::any('/admin/accounts', 'AdminController@admin_accounts')->name('admin_accounts')->middleware('checkuserstatus','checklogin');
Route::any('/admin/accounts_professional', 'AdminController@admin_accounts_pro')->name('admin_accounts_pro')->middleware('checkuserstatus','checklogin');

Route::get('/admin/tasks/{task_sel}', 'AdminController@admin_tasks')->name('admin_tasks')->middleware('checkuserstatus','checklogin');
Route::get('/admin/tasks_search', 'AdminController@admin_tasks_search')->name('admin_tasks_search')->middleware('checkuserstatus','checklogin');
Route::get('/admin/detail/{post_id}', 'AdminController@admin_detail')->name('admin_detail')->middleware('checkuserstatus','checklogin');
Route::get('/admin/admin_ads', 'AdminController@admin_ads')->name('admin_ads')->middleware('checkuserstatus','checklogin');

Route::get('/admin/transaction', 'AdminController@admin_transaction')->name('admin_transaction')->middleware('checkuserstatus','checklogin');
Route::get('/admin/category', 'AdminController@admin_category')->name('admin_category')->middleware('checkuserstatus','checklogin');
Route::get('/admin/profile', 'AdminController@admin_profile')->name('admin_profile')->middleware('checkuserstatus','checklogin');

Route::get('/admin/country', 'AdminController@admin_country')->name('admin_country')->middleware('checkuserstatus','checklogin');
Route::any('/admin/subadmin', 'AdminController@admin_subadmin')->name('admin_subadmin')->middleware('checkuserstatus','checklogin');
Route::any('/admin/admin_info', 'AdminController@admin_info')->name('admin_info')->middleware('checkuserstatus','checklogin');
Route::any('/admin/admin_user_detail/{user_id}', 'AdminController@admin_user_detail')->name('admin_user_detail')->middleware('checkuserstatus','checklogin');
Route::any('/admin/ads_store', 'AdminController@ads_store')->name('ads_store')->middleware('checkuserstatus','checklogin');
Route::any('/admin/add_ads', 'AdminController@add_ads')->name('add_ads')->middleware('checkuserstatus','checklogin');
Route::any('/admin/admin_company_info', 'AdminController@admin_company_info')->name('admin_company_info')->middleware('checkuserstatus','checklogin');
Route::any('/admin/footer_edit/{nav_name}', 'AdminController@admin_footer_edit')->name('admin_footer_edit')->middleware('checkuserstatus','checklogin');

Route::any('/admin/store_footer_content', 'AdminController@store_footer_content')->name('store_footer_content')->middleware('checkuserstatus','checklogin');


Route::get('/countrystore', 'AdminController@countrystore');

Route::post('/categorystore', 'AdminController@categorystore')->name('categorystore');
Route::post('/add_subadmin', 'AdminController@add_subadmin')->name('add_subadmin');
Route::post('/subcategorystore', 'AdminController@subcategorystore')->name('subcategorystore');
Route::post('/subprofilestore', 'AdminController@subprofilestore')->name('subprofilestore');


Route::any('/submenudelete/{id}','AdminController@submenudelete')->name('submenudelete');
Route::any('/subprofiledelete/{id}','AdminController@subprofiledelete')->name('subprofiledelete');

Route::any('/menudelete/{id}','AdminController@menudelete')->name('menudelete');
Route::any('/ads_delete/{id}','AdminController@ads_delete')->name('ads_delete');

Route::get('/update_task_status','AdminController@update_task_status')->name('update_task_status');
Route::get('/update_user_status','AdminController@update_user_status')->name('update_user_status');
Route::get('/update_subcategory','AdminController@update_subcategory')->name('update_subcategory');
Route::get('/update_subprofile','AdminController@update_subprofile')->name('update_subprofile');

Route::get('/update_category','AdminController@update_category')->name('update_category');
Route::get('/update_profile','AdminController@update_profile')->name('update_profile');
Route::post('/update_admin_profile','AdminController@update_admin_profile')->name('update_admin_profile');
Route::post('/changeInfo','AdminController@changeInfo')->name('changeInfo');


// -------------------------Stripe-------------------------------

Route::post('/payment', 'StripePaymentController@stripe')->name('get_stripe_form');
Route::post('/stripe', 'StripePaymentController@stripePost')->name('stripe.post');


// --------------------------Site_Map-----------------------------
Route::get('/sitemap.xml', 'SitemapController@index');









