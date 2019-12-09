@extends('layouts.admin')

@section('content')

<div class="content-wrapper">      
      <section class="content-header">
        <h3>Third Party Advertisements</h3>        
      </section>
     
      <section class="content">       
        <div class="row">          
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <div class="row">                                         
                    @if($task_sel == 'list')
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
                    @endif
                        
                  <div class="col-md-12">
                        @if($task_sel == 'store')
                            <a href="{{ route('admin_ads') }}" class="normal_col m-t-30" style="display:inline-block;"><b><i class="fa fa-hand-o-left"></i> Back</b></a>                            
                        @elseif($task_sel == 'list')
                            <a href="{{ route('add_ads') }}" class="btn_search m-t-10"><i class="fa fa-user-circle"></i>Add New Advertisement</a>
                        @endif
                   </div>
                </div>
              </div>
                @if($task_sel == 'store')
                    <div class="box-body">
                            @if (session('error'))
                                <div class="alert alert-success alert-dismissible m-t-20" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <strong>Warning!</strong> <span>{{ session('error') }}</span>
                                </div>
                            @endif
                        <form action="{{ route('ads_store') }}" class="m-t-30" method="post" enctype="multipart/form-data">
                            @csrf                           
                                <div class="ads_store_form">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="">Advertisement Subject</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" maxlength="50" name="subject" placeholder="eg.Discount Tire" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="row m-t-30">
                                        <div class="col-md-4">
                                            <label for="">Advertisement Tagline</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" maxlength="50" name="tagline" placeholder="eg.Discount-Tires-20%" autocomplete="off" required>
                                        </div>
                                    </div>                                    
                                    <div class="row m-t-30">
                                        <div class="col-md-4">
                                            <label for="">Advertisement Description</label>
                                        </div>
                                        <div class="col-md-8">
                                            <textarea type="text" class="form-control"  name="body" placeholder="Maximum 500 characters" maxlength="500" rows="7" autocomplete="off" required></textarea>
                                        </div>
                                    </div>
                                    <div class="row m-t-30">
                                        <div class="col-md-4">
                                            <label for="">Advertisement Expire Date</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="date" class="form-control exp_date" name="exp_date" placeholder="" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="row m-t-30">
                                        <div class="col-md-4">
                                            <label for="">Advertiser URL</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control"  maxlength="50" name="link" placeholder="eg.https://www.adnlist.com" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="row m-t-30">
                                        <div class="col-md-4">
                                            <label for="">Advertiser business type</label> 
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="type" maxlength="20" placeholder="eg.Automobile" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="row m-t-30">
                                        <div class="col-md-4">
                                            <label for="">Advertiser Location</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="ads_location" name="location" placeholder="Location" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="row m-t-30">
                                        <div class="col-md-4">
                                            <label for="" class="ads_file">Advertiser Logo(If any)</label>
                                        </div>
                                        <div class="col-md-8">
                                            <label style="color:#a09e9e"><i class="fa fa-upload" aria-hidden="true"></i>Select Files to Upload / Drag and Drop Files</label>
                                            <label class="tg-fileuploadlabel" style="width:72px;" for="tg-photogallery">
                                                <img id="blah" src="{{ asset('assets/images/listing/input_img.jpg') }}" alt="Ads Logo" class="img-responsive">
                                                <input id="tg-photogallery" class="tg-fileinput" type="file" name="ads_logo" accept=".jpg, .jpeg, .png" required>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="row m-t-30">
                                        <div class="col-md-4">
                                            <label for="" class="ads_file">Advertiser Poster (If any)</label>
                                        </div>
                                        <div class="col-md-8">
                                            <label style="color:#a09e9e"><i class="fa fa-upload" aria-hidden="true"></i>Select Files to Upload / Drag and Drop Files</label>
                                            <label class="tg-fileuploadlabel" style="width:72px;" for="tg-photogallery2">
                                                <img id="blah2" src="{{ asset('assets/images/listing/input_img.jpg') }}" alt="Ads Image" class="img-responsive">
                                                <input id="tg-photogallery2" class="tg-fileinput" type="file" name="ads_image" accept=".jpg, .jpeg, .png" required>
                                            </label>     
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <div class="" style="text-align:center;" required>
                                            <button class="btn_search">Register</button>
                                        </div>
                                    </div>   
                                </div>
                                                      
                        </form>
                    </div>
                @elseif($task_sel == 'list')
                    <div class="box-body table-responsive">
                        <table id="ads_table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                            <th>Subject</th>
                            <th>Tagline</th>
                            <th>Type of business</th>
                            <th>Location</th>
                            <th>Date Posted</th>
                            <th>Exp Date</th>
                            <th>Logo</th>
                            <th>Ads Image</th>
                            <th>Link</th>                      
                            <th>Action</th>                      
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($all_ads))
                            @foreach($all_ads as $item)
                                <tr>                         
                                <td><span>{{ $item->subject }}</span></td>
                                <td><span>{{ $item->tagline }}</span></td>
                                <td><span>{{ $item->type }}</span></td>
                                <td><span>{{ $item->location }}</span></td>
                                <td><span>{{ substr($item->created_at,0,10) }}</span></td>
                                <td><span>{{ $item->exp_date }}</span></td>
                                <td> @if(!empty($item->logo))<img class="ads_list_img" src="{{ asset('upload/img/ads/'.$item->logo) }}" alt="Logo">@endif</td>
                                <td> @if(!empty($item->image))<img class="ads_list_img" src="{{ asset('upload/img/ads/'.$item->image) }}" alt="Ads Image">@endif</td>                          
                                <td>
                                        @if(!empty($item->link))
                                            <a href="{{ $item->link }}"><span>{{ $item->link }}</span></a>
                                        @else
                                            <span>Not Provide</span>
                                        @endif
                                </td>                          
                                <td align="center">
                                        <a href="{{ route('ads_delete',$item->id) }}" title="Delete">
                                            <span class="subcategory-right-delete">
                                                <i class="fa fa-trash-o color-red"></i>
                                            </span>
                                        </a>
                                </td>
                                </tr>
                            @endforeach
                            @endif
                        </tbody>
                        </table>
                    </div>              
                    <div style="text-align:center;">
                                
                    </div>
                @endif
            </div>   
          </div> 
        </div>
      </section>
    </div>   

<script>
    $("document").ready(function(){
        function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();
    
            reader.onload = function(e) {
                $('#blah').attr('src', e.target.result);
            }
    
            reader.readAsDataURL(input.files[0]);
            }
        }
    
        $("#tg-photogallery").change(function() {
        readURL(this);
        });

        function readURL2(input) 
        {
            if (input.files && input.files[0]) 
            {
                var reader = new FileReader();

                reader.onload = function(e) 
                {
                    $('#blah2').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#tg-photogallery2").change(function() 
        {
            readURL2(this);
        });
    });
    var now = new Date();
    maxDate = now.toISOString().substring(0,10);
    $(".exp_date").prop('min',maxDate);
</script>
<script>
    var autocomplete;   
    function fillInAddress() { 
        
        var temp = $("#ads_location").val();        
        console.log(temp);
    }
    

    function initMap() {  
       
        autocomplete = new google.maps.places.Autocomplete(document.getElementById('ads_location'), {types: ['(cities)'],componentRestrictions: {country: "us"}}); 
       
        // autocomplete.addListener('place_changed', fillInAddress);
    }
    
</script>

@endsection