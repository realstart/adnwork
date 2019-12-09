

@section('style')
<link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet">
@endsection
@section('script')
    <script src="{{ asset('assets/js/custom.js') }}"></script>
@endsection
<div class="ad-profile section">	
    <div class="user-profile">
       
        <div class="user">
            <h2 class="m-t-10"><span class="fs-18">Welcome</span> <span class="text-color-blue fs-20">@if(!empty(Auth::user()->fname)){{ Auth::user()->fname }} @endif @if(!empty(Auth::user()->lname)){{ Auth::user()->lname }} @endif @if(!empty(Auth::user()->name)){{ Auth::user()->name }} @endif</span></h2>            
        </div>
        <div style="float:right;" class="m-t-5">
            <form action="{{ route('update_user_status') }}" id="deactivate_form" class="update_user_status_form">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <input type="hidden" name="user_status" value="2">
                <input type="hidden" name="user_side" value="true">
                <button type="button" class="btn btn-cancel delete_button_user">Deactivate</button>                        
            </form>     
        </div>
    </div>
            
    <ul class="user-menu">
        <li class="@if($page_name == 'profile') active @endif"><a href="{{ route('user_profile') }}">Profile</a></li>
        <li class="@if($page_name == 'pwd') active @endif"><a href="{{ route('user_change_password') }}">Change Password</a></li>
        @if(Auth::user()->role == "0")
            <li class="@if($page_name == 'notification') active @endif"><a href="{{ route('user_messages','read') }}">Notifications</a></li>
            <li class="@if($page_name == 'ads') active @endif"><a href="{{ route('user_advertisement') }}">My ads <span>(@if(!empty($user_ads_num)){{ $user_ads_num }} @else 0 @endif)</span></a></li>
            <li class="@if($page_name == 'pen') active @endif"><a href="{{ route('user_pending_approval_ads') }}">Pending approval <span>(@if(!empty($user_pendding_num)){{ $user_pendding_num }} @else 0 @endif)</span></a></li>
            <li class="@if($page_name == 'draft') active @endif"><a href="{{ route('user_draft_ads') }}">Draft Posts<span>(@if(!empty($user_draft_num)){{ $user_draft_num }} @else 0 @endif)</span></a></li>
        @elseif(Auth::user()->role == "1")
            <li class="@if($page_name == '') active @endif"><a href="{{ route('user_messages','read') }}">Messages</a></li>
            <li class="@if($page_name == '') active @endif"><a href="{{ route('user_advertisement') }}">My Listings<span>(@if(!empty($user_ads_num)){{ $user_ads_num }} @else 0 @endif)</span></a></li>
            <li class="@if($page_name == '') active @endif"><a href="{{ route('user_pending_approval_ads') }}">Sold<span>(@if(!empty($user_pendding_num)){{ $user_pendding_num }} @else 0 @endif)</span></a></li>
            <li class="@if($page_name == '') active @endif"><a href="{{ route('user_draft_ads') }}">Selling<span>(@if(!empty($user_draft_num)){{ $user_draft_num }} @else 0 @endif)</span></a></li>
            <li class="@if($page_name == '') active @endif"><a href="{{ route('user_draft_ads') }}">Waiting for approval<span>(@if(!empty($user_draft_num)){{ $user_draft_num }} @else 0 @endif)</span></a></li>
        @endif
    </ul>
</div>
<script>
    $(function() {
        $(".delete_button_user").click(function(){
            if (confirm("Click OK to continue.If you click OK,then your account will be deactived!."))
            {
                $('form#deactivate_form').submit();
            }
        });
    });
</script>