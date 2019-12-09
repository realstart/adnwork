@extends('layouts.admin')

@section('content')
 
 <div class="content-wrapper">      
      <section class="content-header">
        <h3>Sub Admin</h3>        
      </section>
     
      <section class="content">       
        <div class="row">          
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <div class="row">
                  <div class="col-xs-12 col-md-9">                        
                  </div>
                  <div class="col-xs-12 col-md-3">
                    <form action="" method="get" class="sidebar-form">
                      <div class="input-group">
                        <input type="text" name="search_condition" class="form-control" placeholder="Search..." value="">
                        <span class="input-group-btn">
                              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                              </button>
                        </span>
                      </div>
                    </form>
                  </div>
                  <div class="col-md-12">
                    <button class="add_newaccount_btn btn_search m-t-10"><i class="fa fa-user-circle"></i> New Account</button>
                    <div class="add_newaccount">
                        <form action="{{ route('admin_subadmin') }}" method="post">
                        @csrf
                            <div class="row m-t-20">
                                <div class="col-md-1">
                                    <label for="">First Name</label>
                                    <input type="text" class="form-control" name="fname" placeholder="First Name" autocomplete="off" required>
                                </div>
                                <div class="col-md-1">
                                    <label for="">Last Name</label>
                                    <input type="text" class="form-control" name="lname" placeholder="Last Name" autocomplete="off" required>
                                </div>
                                <div class="col-md-2">
                                    <label for="">Email</label>
                                    <input type="text" class="form-control" name="email" placeholder="Email" autocomplete="off" required>
                                </div>
                                <div class="col-md-2">
                                    <label for="">Phone</label>
                                    <input type="text" class="form-control" name="phone" placeholder="Phone" autocomplete="off" required>
                                </div>
                                <div class="col-md-1">
                                    <label for="">Country</label>                                   
                                    <select type="text" class="form-control" id="service_country" name="service_country"  required>
                                        @if(!empty($all_country))
                                            @foreach($all_country as $item)
                                                <option value="{{ $item->countrycode }}">{{ $item->countryname }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label for="">Address</label>
                                    <input type="text" class="form-control" name="address" placeholder="Address" autocomplete="off" required>
                                </div>
                                <div class="col-md-1">
                                    <label for="">City</label>
                                    <input type="text" class="form-control" name="city" placeholder="City" autocomplete="off" required>
                                </div>
                                <div class="col-md-1">
                                    <label for="">State</label>
                                    <input type="text" class="form-control" name="state" placeholder="State" autocomplete="off" required>
                                </div>
                                <div class="col-md-1">
                                    <label for="">Zip</label>
                                    <input type="number" class="form-control" name="zip" placeholder="Zip" autocomplete="off" required>
                                </div>
                              </div>

                              <div class="row m-t-20">
                                <div class="col-md-2">                                    
                                    <input type="password" class="form-control" name="password" placeholder="Password" autocomplete="new-password" required>
                                </div>
                                <div class="col-md-2">                                    
                                    <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" autocomplete="new-password" required>
                                </div>
                                <div class="col-md-6" style="text-align:center;" required>
                                    <button class="btn btn-primary">Register</button>
                                </div>
                              </div>
                                
                            
                        </form>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="box-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Country</th>
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
                          <td><span>{{ $item->fname }}</span></td>
                          <td><span>{{ $item->lname }}</span></td>
                          <td><span>{{ $item->email }}</span></td>
                          <td><span>{{ $item->phone }}</span></td>
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
              </div>              
              <div style="text-align:center;">
                        
              </div>
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
  $('.update_user_status_form').submit();
});
</script>
@endsection