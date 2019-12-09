
@extends('layouts.admin')

@section('script')
    
@endsection
@section('style')
    
@endsection

@section('content')

 <div class="content-wrapper">
   
    <section class="content-header">
      <h3>Profiles</h3>      
    </section>

   
    <section class="content normal_border">     
      
      <div class="row">        
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">                       
                </div>                
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="new_category_body m-t-40 m-b-40">
                                <form action="{{ route('subprofilestore') }}" method="post">
                                @csrf
                                    <h4><b>Sub Profile</b></h4>
                                    <div class="row m-t-20">
                                        <div class="col-sm-5">
                                            <label for="">Select Profile</label>
                                        </div>
                                        <div class="col-sm-7">
                                            <select type="text" class="form-control" name="profile">
                                                <option value=""></option>
                                                @if(!empty($all_profile))
                                                    @foreach($all_profile as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                @endif
                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row m-t-20">
                                        <div class="col-sm-5">
                                            <label for="">Sub Profile Name</label>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="subprofile" required>
                                        </div>
                                    </div>                                    
                                    <div class="row">
                                        <div class="col-sm-12 m-t-25" style="text-align:center;">
                                            <button type="submit" class="btn btn-primary btn-sm">
                                                Register
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            
                        </div>
                        <div class="col-md-8">
                            <div class="new_category_body m-t-40 width-400" style="margin:auto;">
                                <h4><b>All Profiles and SubProfiles</b></h4>
                                @if(!empty($all_profile))                                    
                                    <ul id="my-accordion" class="accordionjs resp-mt-87">
                                        @foreach($all_profile as $item)
                                            <li class="schedule_item visit1acc_section1 ">
                                                <div class="visitschedule_item_back">                                                    
                                                    <a href="javascript:;">
                                                        <img style="width:30px;margin-right:20px;" src="{{ asset($item->image) }}" alt=""> <span>{{ $item->name }} (<b>${{ $item->price }}</b>)</span>
                                                        <span class="pull-right-container">
                                                            
                                                        </span>
                                                    </a>                              
                                                </div>
                                                <div>
                                                    @if(!empty($item->subprofile))
                                                        <ul class="treeview-menu" style="display: block;">
                                                            <li><button class="btn_edit_category" data-toggle="modal" data-target="#modal-category" data-price="{{ $item->price }}" data-value="{{ $item->name }}" data-id="{{ $item->id }}"><i class="fa fa-edit" style="color:#00a622;"></i></button></li>
                                                            @foreach($item->subprofile as $subitem)
                                                                <li><span><i class="fa fa-circle-o m-r-10"></i>{{ $subitem->name }}</span> 
                                                                    
                                                                    <a href="{{ route('subprofiledelete',$subitem->id) }}" style="float:right;" >
                                                                        <span class="subcategory-right-delete">
                                                                            <i class="fa fa-trash-o color-red"></i>
                                                                        </span>
                                                                    </a>
                                                                    <button class="btn-edit" data-toggle="modal" data-target="#modal-default" data-value="{{ $subitem->name }}" data-id="{{ $subitem->id }}"><i class="fa fa-edit" style="color:#00a622;"></i></button>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </div>
                                            </li>
                                        @endforeach     
                                    </ul>
                                @endif
                            </div>                                
                        </div>
                    </div>
                </div>
            </div>
        </div> 
      </div>    

    </section>
  </div>
  <div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <form action="{{ route('update_subprofile') }}" method="get">
        <input type="hidden" name="subprofile_id" class="subcategory_id" value="">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title">Edit SubProfile Name</h3>
            </div>
            <div class="modal-body">                
            <div class="box-body">
                <div class="form-group">
                <label><b>Sub Profile Name</b></label>
                    <input type="text" class="form-control subcategory" name="subprofile" required>
                </div>
            </div>
            <div class="box-body">
                <div class="form-group" style="text-align:center;">
                    <button class="btn btn-success">Submit</button>
                </div>
            </div>
            </div>
        </div>
        </form>
        
    </div>
</div>     


    <div class="modal fade" id="modal-category">
        <div class="modal-dialog">
          <form action="{{ route('update_profile') }}" method="get">
            <input type="hidden" name="profile_id" class="category_id" value="">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Edit Profile</h3>
              </div>
              <div class="modal-body">                
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-md-4"><b>Profile Name</b></label>
                        <div class="col-md-8">
                            <input class="categoryname form-control" type="text" value="" name="profilename" required>
                        </div>                        
                    </div>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-md-4 m-t-20"><b>Profile Price</b></label>
                        <div class="col-md-8">
                            <input class="m-t-20 categoryprice form-control" type="text" name="profileprice" required>
                        </div>                        
                    </div>
                </div>
                <div class="box-body">
                    <div class="form-group" style="text-align:center;">
                      <button class="btn btn-success m-t-20">Submit</button>
                    </div>
                </div>
              </div>
            </div>
          </form>            
        </div>
    </div>  

  <script>
    jQuery(document).ready(function($){
        $("#my-accordion").accordionjs({               
            closeAble   : true,
            closeOther  : true,                
            slideSpeed  : 500,               
            activeIndex : false,                
            openSection: function( section ){},                
            beforeOpenSection: function( section ){},
        });
        $(".schedule_item").click(function(){
            if($(this).hasClass("accordion_sel"))
            {
                $(this).removeClass("accordion_sel");
            }
            else
            {
                $(".schedule_item").removeClass("accordion_sel");
                $(this).addClass("accordion_sel");
            }
            if($(this).find(".icon_status").hasClass("fa-angle-down"))
            {
                $(".icon_status").removeClass("fa-angle-up");
                $(".icon_status").addClass("fa-angle-down");
                $(this).find(".icon_status").removeClass("fa-angle-down");
                $(this).find(".icon_status").addClass("fa-angle-up");
            }
            else{
                $(this).find(".icon_status").removeClass("fa-angle-up");
                $(this).find(".icon_status").addClass("fa-angle-down");
            }
            
        });
        $(".btn-edit").click(function(){
            var subcategory = $(this).data("value");
            var subcategory_id = $(this).data("id");
            $(".subcategory").val(subcategory);
            $(".subcategory_id").val(subcategory_id);            
        });

        $(".btn_edit_category").click(function(){            
            var categoryname = $(this).data("value");
            var category_id = $(this).data("id");
            var categoryprice = $(this).data("price");
            $(".categoryname").val(categoryname);
            $(".categoryprice").val(categoryprice);
            $(".category_id").val(category_id);
        });
    });
</script>
@endsection