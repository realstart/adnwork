@extends('layouts.admin')

@section('content')

 
 <div class="content-wrapper">
     
      <section class="content-header">
        <h3>Accounts</h3>        
      </section>      
      <section class="content">        
        <div class="row">          
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
               
                    <div class="row m-t-30">
                        <div class="col-xs-9">

                        </div>
                        <div class="col-xs-3">
                        @if($detail == 'all')
                            <form action="{{ route('admin_accounts') }}" method="get" class="sidebar-form">
                            <div class="input-group">
                                <input type="text" name="search_condition" class="form-control" placeholder="Search..." value="@if(!empty($con)) {{ $con }} @endif">
                                <span class="input-group-btn">
                                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                            </form>
                        @elseif($detail == 'detail')
                            <a href="{{ route('admin_accounts') }}" class="normal_col" style="float:right;"><b><i class="fa fa-hand-o-left"></i> Back</b></a>
                        @endif
                        </div>
                    </div>
                
              </div>
              
              
                @if($detail == 'all')
                <div class="box-body table-responsive m-t-30">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>State</th>
                            <th>Zip</th>
                            <th>Registered on</th>
                            <th>Current Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($all_account))
                            @foreach($all_account as $item)
                                <tr>
                                    <td><span><a href="{{ route('admin_user_detail',$item->id) }}" style="display:block;">{{ $item->fname }}</a></span></td>
                                    <td><span>{{ $item->lname }}</span></td>
                                    <td><span>{{ $item->email }}</span></td>
                                    <td><span>{{ $item->phone }}</span></td>
                                    <td><span>{{ $item->address }}</span></td>
                                    <td><span>{{ $item->city }}</span></td>
                                    <td><span>{{ $item->state }}</span></td>
                                    <td><span>{{ $item->zip }}</span></td>
                                    <td><span>{{ substr($item->created_at,0,10) }}</span></td>
                                    <td>
                                        <div class="form-group1" >
                                            <form action="{{ route('update_user_status') }}" class="update_user_status_form">
                                                <input type="hidden" name="user_id" value="{{ $item->id }}">
                                                <select class="form-control user_status" name="user_status" @if($item->role == 3) disabled @endif>                                  
                                                    <option style="color:#00a65a;" value="1" @if($item->status == '1') selected @endif>Active</option>
                                                    <option style="color:#dd4b39;" value="2" @if($item->status == '2') selected @endif>Deactivated</option>
                                                </select>
                                            </form>                                        
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div style="text-align:center;">
                        {{ $all_account->appends(['search_condition' => $con])->links() }}                
                    </div>
                </div>  
                @elseif($detail == 'detail')
                <div class="box-body m-t-10 user_detail_box">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="user_image">
                                <img src="@if(!empty($cur_user->image)) {{ asset($cur_user->image) }} @else {{ asset('assets/images/listing/user.png') }} @endif" alt="">
                            </div>
                        </div>
                        <div class="col-md-9">
                            <p><label for="" class="width-150">Full Name:</label> <span>{{ $cur_user->fname }}</span> <span>{{ $cur_user->lname }}</span></p>
                            <p><label for="" class="width-150">User Email:</label> <span>{{ $cur_user->email }}</span></p>
                            <p><label for="" class="width-150">Email Verify:</label> @if(!empty($cur_user->email_verified_at))<span class="status_color1"><b>Verified</b></span>@else <span class="status_color3"><b>Not verified</b></span> @endif</span></p>
                            <p><label for="" class="width-150">City:</label> <span>{{ $cur_user->city }}</span></p>
                            <p><label for="" class="width-150">State:</label> <span>{{ $cur_user->state }}</span></p>
                            <form action="{{ route('update_user_status') }}" class="update_user_status_form">
                                <label for="" class="width-150">User Status:</label>
                                
                                <input type="hidden" name="user_id" value="{{ $cur_user->id }}">
                                <select class="user_status" name="user_status" style="height:35px;">                                  
                                <option style="color:#00a65a;" value="1" @if($cur_user->status == '1') selected @endif>Active</option>
                                <option style="color:#dd4b39;" value="2" @if($cur_user->status == '2') selected @endif>Deactivated</option>
                                </select>
                            </form>
                            
                        </div>
                    </div>
                </div>
                @endif
                          
              
            </div>
          </div> 
        </div>     

      </section>
    </div>
    
<script>
$('.user_status').change(function(){
  var temp = $(".user_status").val()
  if(temp == "")
  {
    return false;
  }
  $(this).parent().submit();
});
</script>
@endsection