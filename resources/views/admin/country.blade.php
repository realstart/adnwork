
@extends('layouts.admin')

@section('script')
<script src="{{ asset('admin/dist/js/country.js') }}"></script>
@endsection
@section('style')
    
@endsection

@section('content')

 
 <div class="content-wrapper">    
    <section class="content-header">
      <h3>Country</h3>      
    </section>
    <section class="content">
      <div class="row">       
        <div class="col-xs-12">
            <div class="box">                
                <div class="box-body">
                    <div class="row">                        
                        <div class="col-md-12">
                        @if(empty($all_country)) 
                            <button class="btn btn-primary btn_register_country btn-sm">
                                Country Register
                            </button>
                        @else
                            <div class="new_category_body m-t-40">
                                <h4><b>Registered Country</b></h4>
                                  
                                <?php $i=0; ?>                                 
                                <table class="table">
                                    @foreach($all_country as $item)
                                        @php $i=$i+1 @endphp
                                        <tr>
                                            <td><span>{{ $i }}</span></td>
                                            <td><span>{{ $item->countryname }}</span></td>
                                            <td><span>+{{ $item->countrycode }}</span></td>
                                            <td><img style="width:30px;" src="{{ $item->countryflag }}" alt=""></td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </div> 
      </div>     
    </section>   
  </div>  
  
@endsection