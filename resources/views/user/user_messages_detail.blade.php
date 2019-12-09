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
                            <li class="message_li" data-value="read"><a href="{{ route('user_messages','read') }}"><h5>Read Messages <span style="color:#00a655;">({{ $num_read }})</span></h5></a></li>
                            <li class="message_li" data-value="unread"><a href="{{ route('user_messages','unread') }}"><h5>UnRead Messages <span style="color:#00a655;">({{ $num_unread }})</span></h5></a></li>
                            <li class="message_li" data-value="sent"><a href="{{ route('user_messages','sent') }}"><h5>Sent Messages <span style="color:#00a655;">({{ $num_sent }})</span></h5></a></li>
                        </ul>
                        <div style="clear:both;"></div>
                        <div class="table-responsive" style="margin-top:20px;">
                            <div class="message_detail">
                                <p><span class="normal-title fs-20">Message Detail</span></p>
                                <div class="p-l-20">
                                    <button type="button" class="m-r-15 btn_message_reply" @if(empty($all_message->user->email)) disabled @endif style="float:right; border:none;background:transparent;color:#00a655;" data-value="{{ $all_message->sender }}" data-placement="top" title="Reply Message" data-toggle="modal" data-target="#myModal"><i class="fa fa-mail-reply"></i></button>
                                   
                                    <br>
                                    <p><span class="normal-title">From : </span> <span>{{  $all_message->user->name }}</span></p>
                                    <p><span class="normal-title">Date : </span> <span>{{  substr($all_message->created_at,0,10) }}</span></p>
                                
                                    <br>
                                    <p><span class="normal-title">Message </span></p>
                                    <div class="message_content">
                                        <p>{{  $all_message->content }}</p>
                                    </div>
                                    @if(!empty($all_message->attachment))
                                        <p><span class="normal-title">attachment: </span><a href="{{ asset('/upload/attachment/'.$all_message->attachment) }}" style="display:inline-block;" download><span><svg style="height: 13px;" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="paperclip" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-paperclip fa-w-14 fa-3x"><path fill="currentColor" d="M43.246 466.142c-58.43-60.289-57.341-157.511 1.386-217.581L254.392 34c44.316-45.332 116.351-45.336 160.671 0 43.89 44.894 43.943 117.329 0 162.276L232.214 383.128c-29.855 30.537-78.633 30.111-107.982-.998-28.275-29.97-27.368-77.473 1.452-106.953l143.743-146.835c6.182-6.314 16.312-6.422 22.626-.241l22.861 22.379c6.315 6.182 6.422 16.312.241 22.626L171.427 319.927c-4.932 5.045-5.236 13.428-.648 18.292 4.372 4.634 11.245 4.711 15.688.165l182.849-186.851c19.613-20.062 19.613-52.725-.011-72.798-19.189-19.627-49.957-19.637-69.154 0L90.39 293.295c-34.763 35.56-35.299 93.12-1.191 128.313 34.01 35.093 88.985 35.137 123.058.286l172.06-175.999c6.177-6.319 16.307-6.433 22.626-.256l22.877 22.364c6.319 6.177 6.434 16.307.256 22.626l-172.06 175.998c-59.576 60.938-155.943 60.216-214.77-.485z" class=""></path></svg></span>&nbsp;&nbsp;{{ $all_message->attachment }}</a></p>
                                    @endif
                                </div>
                                
                            </div>
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
                                <textarea type="text" class="form-control" name="content" rows="3" placeholder="Enter your message" required></textarea>
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