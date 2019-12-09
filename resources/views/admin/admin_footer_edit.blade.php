@extends('layouts.admin')

@section('content')

<div class="row">    
    <div class="col-sm-12 col-xs-12  m-t-20">

        <div class="footer_edit_form">
            <div class="footer_edit_form_nav">
                <ul>
                    <li>                        
                        <a class="btn_termsOfUse btn_normal_nav @if($nav_name == 'privacy') active @endif" href="{{ url('admin/footer_edit',"privacy") }}">Privacy Policy</a>
                    </li>
                    <li>                        
                        <a class="btn_termsOfUse btn_normal_nav @if($nav_name == 'terms') active @endif" href="{{ url('admin/footer_edit',"terms") }}">Terms of use</a>
                    </li>
                    
                    <li>                        
                        <a class="btn_termsOfUse btn_normal_nav @if($nav_name == 'faq') active @endif" href="{{ url('admin/footer_edit',"faq") }}">Faq</a>
                    </li>   
                    <li>
                        <a class="btn_termsOfUse btn_normal_nav @if($nav_name == 'prohibited') active @endif" href="{{ url('admin/footer_edit',"prohibited") }}">Prohibited</a>
                    </li>  
                    <li>
                        <a class="btn_termsOfUse btn_normal_nav @if($nav_name == 'postingtips') active @endif" href="{{ url('admin/footer_edit',"postingtips") }}">Posting Tips</a>
                    </li>   
                    <li>
                        <a class="btn_termsOfUse btn_normal_nav @if($nav_name == 'careers') active @endif" href="{{ url('admin/footer_edit',"careers") }}">Careers</a>
                    </li> 
                    <li>
                        <a class="btn_termsOfUse btn_normal_nav @if($nav_name == 'payment') active @endif" href="{{ url('admin/footer_edit',"payment") }}">Payment Policy</a>
                    </li>                             
                </ul>  
            </div>
            <div class="footer_edit_form_body">
                <div class="termsOfUse common_body">
                    <form action="{{ route('store_footer_content') }}" method="post">
                        @csrf                        
                        <input type="hidden" name="nav_name" value="{{ $nav_name }}">
                        <textarea name="terms" class="terms">
                            @if($nav_name == "terms")
                                {{$temp->footer_terms}}
                            @elseif($nav_name == "privacy")
                                {{$temp->footer_privacy}}
                            @elseif($nav_name == "faq")
                                {{$temp->footer_faq}}
                            @elseif($nav_name == "prohibited")
                                {{$temp->footer_prohibited}}
                            @elseif($nav_name == "postingtips")
                                {{$temp->footer_postingtips}}
                            @elseif($nav_name == "careers")
                                {{$temp->footer_careers}}
                            @elseif($nav_name == "payment")
                                {{$temp->footer_payment}}
                            @endif
                        </textarea>
                        <div class="text-center m-t-20">
                            <button class="btn_common">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>  
</div>
<script>         
    $(".terms").summernote('code');   
</script>
@endsection