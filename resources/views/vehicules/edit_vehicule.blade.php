@extends('layouts.app')

@section('content')

<div class="container">
  
<section class="panel panel-default">
  <div class="panel-heading"> 
    <h3 class="panel-title">[{{Auth::guard('client')->user()->name}}] - Add a car to my profile</h3> 
  </div> 

  <div class="panel-body">
    
  <form method="POST" action="{{route('vehicules.update',$val)}}"  class="form-horizontal" role="form">
  <input type="hidden" name="_method" value="PUT">
  @csrf


    <div class="form-group">

      <label for="name" class="col-sm-3 control-label">Car brand</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" name="name" id="name" placeholder="{{$val->name}}" value="{{$val->name}}">
      </div>
    </div> <!-- form-group // -->

    <div class="form-group">
      <label for="about" class="col-sm-3 control-label">Image URL</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" name="url" id="url" placeholder="{{$val->url}}" value="{{$val->url}}">
      </div>
    </div> 
    
    <div class="form-group">
      <label for="about" class="col-sm-3 control-label">Specific notes</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" name="notes" id="notes" placeholder="{{$val->notes}}" value="{{$val->notes}}">
      </div>
    </div> <!-- form-group // -->
        
    <hr>
    <div class="form-group">
      <div class="col-sm-offset-3 col-sm-9">
        <button type="submit" class="btn btn-primary" >Edit the car</button>
      </div>
    </div> <!-- form-group // -->
  </form>
    
  </div><!-- panel-body // -->
</section><!-- panel// -->

  
</div> <!-- container// -->

@endsection('content')