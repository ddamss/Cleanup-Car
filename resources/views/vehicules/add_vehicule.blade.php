@extends('layouts.app')

@section('content')

<div class="container">
  
<section class="panel panel-default">
  <div class="panel-heading"> 
    <h3 class="panel-title">[{{Auth::guard('client')->user()->name}}] - Add a car to my profile</h3> 
  </div> 

  <div class="panel-body">
    
  <form method="POST" action="{{route('vehicules.store')}}"  class="form-horizontal" role="form">
  @csrf


    <div class="form-group">

      <label for="name" class="col-sm-3 control-label">Car brand</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" name="name" id="name" placeholder="Car brand">
      </div>
    </div> <!-- form-group // -->

    <div class="form-group">
      <label for="about" class="col-sm-3 control-label">Image URL</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" name="url" id="url" placeholder="Image URL">
      </div>
    </div> 
    
    <div class="form-group">
      <label for="about" class="col-sm-3 control-label">Specific notes</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" name="notes" id="notes" placeholder="Notes">
      </div>
    </div> <!-- form-group // -->
        
    <hr>
    <div class="form-group">
      <div class="col-sm-offset-3 col-sm-9">
        <button type="submit" class="btn btn-primary" >Add the car</button>
      </div>
    </div> <!-- form-group // -->
  </form>
    
  </div><!-- panel-body // -->
</section><!-- panel// -->

  
</div> <!-- container// -->

@endsection('content')