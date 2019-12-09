@extends('layouts.admin')

@section('content')

<div class="row">    
    <div class="col-sm-8 col-xs-12  m-t-20">
        <form action="{{ route('changeInfo') }}" method="post">
            @csrf
            <div class="panel panel-default chartJs">
                <div class="panel-heading">
                    <div class="card-title">
                        <div class="title text-center">Contact Info</div>
                    </div>
                </div>
                <div class="panel-body">                    
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="">General Info Email</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" name="contact_email_general" autocomplete="off" value="@if(!empty($info)) {{ $info->general }} @endif" required>
                        </div>
                    </div>
                    <div class="row m-t-20">
                        <div class="col-sm-4">
                            <label for="">Support Email</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" name="contact_email_support" autocomplete="off" value="@if(!empty($info)) {{ $info->support }} @endif" required>
                        </div>
                    </div>
                    <div class="row m-t-20">
                        <div class="col-sm-4">
                            <label for="">Scam Email</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" name="contact_email_scam" autocomplete="off" value="@if(!empty($info)) {{ $info->scam }} @endif" required>
                        </div>
                    </div>
                    <div class="row m-t-20">
                        <div class="col-sm-4">
                            <label for="">Report Email</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" name="contact_email_report" autocomplete="off" value="@if(!empty($info)) {{ $info->report }} @endif" required>
                        </div>
                    </div>
                    <div class="row m-t-20">
                        <div class="col-sm-4">
                            <label for="">Global AdminEmail</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" name="contact_email_global" autocomplete="off" value="@if(!empty($info)) {{ $info->global }} @endif" required>
                        </div>
                    </div>                    
                    <div class="row  m-t-20">
                        <div class="col-sm-4">
                            <label for="">Tel</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="tel" class="form-control" name="contact_tel" autocomplete="off" value="@if(!empty($info)) {{ $info->tel }} @endif" required>                            
                        </div>
                    </div>
                    <div class="row  m-t-20">
                        <div class="col-sm-4">
                            <label for="">Address</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text"  name="contact_address" class="form-control" autocomplete="off" value="@if(!empty($info)) {{ $info->address }} @endif" required>
                        </div>
                    </div>
                    <div class="row m-t-20">
                        <div class="col-sm-12 text-center">
                            <button class="btn btn-success"><b>Change Info</b></button>
                        </div>                        
                    </div>
                </div>
            </div>
        </form>
    </div>  
</div>
@endsection