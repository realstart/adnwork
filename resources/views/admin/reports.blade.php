@extends('layouts.admin')

@section('content')

<div class="content-wrapper">   
    <section class="content-header">
      <h3>Reports</h3>
    </section>

    <section class="content">
     
      <div class="row">
       
        <section class="col-lg-6 connectedSortable">                 
              <div class="box box-success text-center">
                <div class="box-header with-border">

                  <h3 class="box-title text-success">Sales By Region</h3>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                  </div>
                </div>
                <div class="box-body">
                  <div id="donut-chart" style="height: 300px;"></div>
                </div>               
              </div>              
          <div class="box box-info col-md-offset-6 text-center" >
            <div class="box-header with-border">
              <h3 class="box-title text-info">Registered User By Region</h3>

              <div class="box-tools pull-right">
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                  </div>
            </div>
            <div class="box-body" >
                <input type="text" class="knob" value="50" data-width="220" data-height="250" data-fgColor="#f56954">
                <div class="knob-label"></div>
            </div>            
          </div> 
        </section>
        <section class="col-lg-6 connectedSortable">
              <div class="box box-warning text-center">
                <div class="box-header">
                  <h3 class="box-title text-warning">Posts By Region</h3>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                  </div>
                </div>
                
                <div class="box-body text-center">
                  <div class="sparkline" data-type="pie" data-offset="90" data-width="250px" data-height="300px">
                    6,4,8
                  </div>
                </div>                
              </div>              
         </section>        
      </div>   
    </section>
  </div>
 
@endsection