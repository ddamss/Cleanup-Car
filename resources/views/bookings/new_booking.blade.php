@extends('layouts.app')


@section('content')
    <button type="button" class="btn btn-outline-primary btn-rounded waves-effect" style="display:inline-block;margin-left:50px;font-size:13px;">
        <a href="{{route('vehicules.create')}}" style="text-decoration: none;color:inherit;">Add car</a>
    </button>
    <button type="button" class="btn btn-outline-primary btn-rounded waves-effect" style="display:inline-block;margin-left:50px;font-size:13px;">
        <a href="{{route('vehicules.index')}}" style="text-decoration: none;color:inherit;">My cars</a>
    </button>


    <div class="page-header" >
        <h1>Step 1 : select a car</h1>      
    </div>

    <form name="form_1" id="form_1" method="POST" action="{{route('bookings.store')}}">
        @csrf
    
    <div style="margin:auto;text-align:center;">

    @foreach($vehicules as $vehicule)

    <div class="card" style="width:30rem;margin:auto;display:inline-block;">
        <div style="height:150px;width:auto;">
            <img class="card-img-top" src="{{$vehicule->url}}" alt="Card image cap" style="max-width:298px;height:auto;">
        </div>
        <div class="card-body" style="display=inline-block;margin-top:10px;">
        <hr>
            <h5 class="card-title">{{$vehicule->name}} - {{$vehicule->id}}</h5>
            <p class="card-text">{{$vehicule->notes}}</p>
        </div>
        <div class="form-check-inline">
            <input type="hidden" name="vehicule_id" value="{{$vehicule->id}}">
            <input type="checkbox" name="vehiculeName[]" value="{{$vehicule->name}}" class="form-check-input filled-in" id="filledInCheckbox">
            <label class="form-check-label" for="filledInCheckbox">Get it</label>
        </div>
    </div>
    <div style="display:inline-block;width:20px;"></div>
    @endforeach
    </div>


    <div class="page-header">
        <h1>Step 2 : select a cleaner HERE</h1>      
    </div>

    <div class="list-group" style="display:block;margin-left:50px;margin-right:50px;">

        @foreach($cleaners as $cleaner)
            <div class="list-group">
                <div class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h4>{{$cleaner->name}} - {{$cleaner->id}}</h4>
                    </div>        
                    <p>Details here...</p>
                    
                        <div class="form-check-inline">
                            <input type="hidden" name="cleaner_id" value="{{$cleaner->id}}">
                            <input type="checkbox" name="cleanerName[]" value="{{$cleaner->name}}" class="form-check-input filled-in" id="filledInCheckbox" required>
                            <label class="form-check-label" for="filledInCheckbox">Get it</label>
                        </div>

              </div></a><br>
            </div>
        @endforeach
    </div>

    <div class="page-header">
        <h1>Step 3 : Car location</h1>      
    </div>

    <div class="form-group">
        <input type="text" class="form-control" id="location" name="location" placeholder="Type address here" required>
        <small id="location" class="form-text text-muted">Enter the location where you car is parked</small>
    </div>

    <div class="page-header">
        <h1>Step 4 : Cleaning timeframe</h1>      
    </div>

    <div class="form-group" style="width:300px;text-align:center;">
        <select class="custom-select" name="bill_amount" required>
           <option value="60">1 hour</option>
           <option value="100">1.5 hour</option>
           <option value="120">2 hours</option>
        </select>
        <small id="location" class="form-text text-muted">Select the number of yours you'd like to have your car cleaned up</small>
    </div>

  <br><br>

    <div class="page-header">
            <h1>Step 5 : Book date/time</h1>      
    </div>


    
    <div class='col-md-6'>
               <div class="form-group">
                  <label class="control-label">Appointment Time</label>
                  <div class='input-group date' id='datetimepicker2'>
                     <input type='text' class="form-control" name="booking_date" required>
                     <span class="input-group-addon">
                     <span class="glyphicon glyphicon-calendar"></span>
                     </span>
                  </div>
               </div>
            </div>




    <br><br>
    <br><br>

    <input type="hidden" name="client_id" value="{{Auth::guard('client')->user()->id}}">

    <input type="submit" value="Submit">

    </form>

@endsection('content')