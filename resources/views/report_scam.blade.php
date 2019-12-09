@extends('layouts.main')

@section('content')
<section class="m-t-60">
    <div class="row">
        <div class="col-md-12 text-center">
            <h2 class="home_title">Report Scam/Issue</h2>
        </div>
    </div>
</section>
<section id="main" class="clearfix contact-us">
    <div class="container">
        <div class="contactus m-t-20">            

            <div class="corporate-info">
                <div class="row">
                    
                    <div class="col-sm-12 m-b-30">
                        <p class="">If you found any scam post or advertisement on AdnList,immedialty contact us with complete details. Our dedicated support team works 24/7 to solve the issue and protect the users from being scammend.</p>
                    </div>
                    
                    <div class="col-sm-6 m-t-30">
                        <label for="">Branch Office(United States)</label>
                        <p>3400 Cottage way,Ste G2 #1148</p>
                        <p>Sacramento,CA 95825.</p>
                        <br>
                        <br>
                        <label for="">For Immediate Scam Report:</label>
                        <p>Send us email at <a href="mailto:report@adnlist.com">report@adnlist.com</a></p>  
                    </div>
                    <div class="col-sm-6 m-t-20">
                        @if(session('success'))                    
                            <div class="alert alert-success alert-dismissible m-t-20" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <p style="line-height:15px;">{{ session('success') }}</p>
                            </div>
                        @endif
                        <form id="contact-form" class="contact-form" name="contact-form" method="post" action="{{ route('report_scame') }}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control normal_border" maxlength="50" name="name" required="required" value="{{ Auth::User()->fname }} {{ Auth::User()->lname }}" readonly placeholder="Your name">
                                    </div> 
                                </div> 
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="email" class="form-control normal_border" maxlength="50" name="email" required="required" readonly placeholder="Your mail" value="{{ Auth::User()->email }}">
                                    </div> 
                                </div> 
                                <div class="col-sm-12">
                                    <div class="form-group" style="position:relative;">
                                        <span for="" style="position:absolute;top:10px;"><b>Post ID:</b></span>
                                        <input type="text" style="width:80%;margin-left:20%;" class="form-control normal_border" maxlength="10" name="post_id" readonly required="required" value="@if(!empty($report_post)){{ $report_post->id }}@endif" placeholder="Scam/fake post id">
                                    </div> 
                                </div> 
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control normal_border"  maxlength="100" name="subject" required="required" value="@if(!empty($report_post)){{ $report_post->title }}@endif" placeholder="Scam/fake post subject">
                                    </div> 
                                </div> 
                                
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <textarea name="message" id="message" required="required" class="form-control normal_border" rows="5" placeholder="Message"></textarea>
                                    </div>             
                                </div>     
                            </div>
                            <div>
                                <p>Please do not send us any unsolicited offers or services.</p>
                            </div>
                            <div class="form-group text-center m-t-20">
                                <button type="submit" class="btn btn-green">Submit Your Message</button>
                            </div>
                        </form>                      
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection