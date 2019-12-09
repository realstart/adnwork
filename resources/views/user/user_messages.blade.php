@extends('layouts.main')


@section('content')
@include('layouts.user_profile_header_normal')
<section id="main" class="clearfix delete-page">
    <div class="container resp_padding_0">
        @include('layouts.user_profile_header')
        
        <div class="close-account">
            <div class="row">
                <div class="col-sm-9">
                    <div class="section" style="padding:20px;">                         
                        <ul class="message_nav">
                            <li class="message_li @if($message_type =='read') selected @endif" data-value="read"><a href="{{ route('user_messages','read') }}"><h5>Read Messages <span style="color:#00a655;">({{ $num_read }})</span></h5></a></li>
                            <li class="message_li @if($message_type =='unread') selected @endif" data-value="unread"><a href="{{ route('user_messages','unread') }}"><h5>UnRead Messages <span style="color:#00a655;">({{ $num_unread }})</span></h5></a></li>
                            <li class="message_li @if($message_type =='sent') selected @endif" data-value="sent"><a href="{{ route('user_messages','sent') }}"><h5>Sent Messages <span style="color:#00a655;">({{ $num_sent }})</span></h5></a></li>
                        </ul>
                        <div style="clear:both;"></div>
                        <div class="table-responsive" style="margin-top:20px;">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible m-t-15" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <span class="text-color-blue">{{ session('success') }}</span>
                                </div>
                            @endif
                            @include('layouts.user_profile_message_list')
                        </div>
                    </div>
                </div>

                <div class="col-sm-3 text-center">
                    @include('layouts.user_profile_recommended')                   
                </div>	
            </div>
        </div>
    </div>
</section>



  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <form action="{{ route('send_email') }}" method="post" enctype="multipart/form-data">  
        @csrf
            <input type="hidden" name="receiver_id" class="receiver_id" value="">
            <div class="modal-content">
                <div class="modal_border_warp">
                    <div class="">                    
                        <h4 class="modal-title text-center" style="color:#0738ca;">Reply By Email</h4>
                    </div>
                    <div class="modal-body">                        
                        <div class="row m-t-20">
                            <div class="col-sm-12">
                                <label for="" class="normal-label" style="color:#0738ca;">Message</label>
                            </div>
                            <div class="col-sm-12">
                                <textarea type="text" class="form-control" name="content" rows="5" required></textarea>
                            </div>
                        </div>
                        <div class="row m-t-20">
                            <div class="col-sm-12">
                                <label for="" class="normal-label" style="color:#0738ca;">Upload files</label>
                            </div>
                            <div class="col-sm-12">
                                <label class="tg-fileuploadlabel p-t-5 p-b-4" style="width:75px;margin:auto;" for="email_attchment">                                                       
                                    <span style="line-height:10px;">
                                        <svg style="width:25px;height:20px;" aria-hidden="true" focusable="false" data-prefix="far" data-icon="upload" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="svg-inline--fa fa-upload fa-w-18 fa-3x"><path fill="currentColor" d="M528 288H384v-32h64c42.6 0 64.2-51.7 33.9-81.9l-160-160c-18.8-18.8-49.1-18.7-67.9 0l-160 160c-30.1 30.1-8.7 81.9 34 81.9h64v32H48c-26.5 0-48 21.5-48 48v128c0 26.5 21.5 48 48 48h480c26.5 0 48-21.5 48-48V336c0-26.5-21.5-48-48-48zm-400-80L288 48l160 160H336v160h-96V208H128zm400 256H48V336h144v32c0 26.5 21.5 48 48 48h96c26.5 0 48-21.5 48-48v-32h144v128zm-40-64c0 13.3-10.7 24-24 24s-24-10.7-24-24 10.7-24 24-24 24 10.7 24 24z" class=""></path></svg>
                                    </span>
                                    <span class="text-color-green" style="line-height:20px;"><b>Max: 2MB</b></span>
                                    <input id="email_attchment" class="tg-fileinput" type="file" name="email_attchment" autocomplete="off" accept=".doc,.docx,.xls,.xlsx,.jpg, .jpeg, .png">
                                </label> 
                                <p class="upload_filename">
                                </p>         
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </div>
            </div>
        </form>
    </div>
  </div>
@endsection