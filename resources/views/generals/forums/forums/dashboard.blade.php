

@extends('layouts.admin')
@section('content')
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<i class="fa fa-align-justify"></i>List of Attachment 

  
  <a href="{{ route('general.attachment.create') }}" class="float-right">
                         
  <button class="btn btn-success  bold ">  Add New  <i class="fas fa-plus-circle fa-fw"></i> </button>
                   </a>
                   </div>
<div class="card-body card card-accent-primary">
 <categories></categories>
</div>
</div>

@endsection