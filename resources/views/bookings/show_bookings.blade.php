@extends('layouts.app')

@section('content')

<div style="margin: 20px 0;">

    @foreach($bookings as $booking)

    <div class="card mb-3" style="max-width: 540px;margin:0 auto;">
        <div class="row no-gutters">
            <div class="col-md-4">
            <img src="{{$booking->url}}" class="card-img" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">{{$booking->bill_amount}} AED [{{Auth::guard('client')->user()?$booking->cleanerName:$booking->clientName}}]</h5>
                    <p class="card-text">{{$booking->vehiculeName}} - {{$booking->location}}</p>
                    <p class="card-text"><u>Booking date</u> : {{\Carbon\Carbon::parse($booking->booking_date)->format('Y-m-d H:i:s')}} </p>
                    <p class="card-text"><small class="text-muted">{{$booking->vehiculeNotes}}</small></p>
                </div>
            </div>
        </div>

        @if(Auth::guard('client')->user())
            @if($booking->booking_status=='confirmed')
                    <div style="background-color:#5ed1af;text-align:center;">{{$booking->booking_status}}</div>
                @elseif($booking->booking_status=='cancelled')
                    <div style="background-color:#b7bdbb;text-align:center;">{{$booking->booking_status}}</div>
                @else
                    <div style="background-color:#5093eb;text-align:center;">{{$booking->booking_status}}</div>
            @endif

        @else
        <!-- Button trigger modal -->
            @if($booking->booking_status=='confirmed')
                <div style="background-color:#5ed1af;text-align:center;">{{$booking->booking_status}}</div>
            @elseif($booking->booking_status=='cancelled')
                <div style="background-color:#b7bdbb;text-align:center;">{{$booking->booking_status}}</div>
            @else
        <button type="button" class="btn btn-primary" data-toggle="modal"  data-id="{{ $booking->id }}" data-url="{{route('bookings.update',$booking->id)}}" data-target="#booking-confirmation-modal">
            Confirm booking status
            </button>

            <!-- Modal -->
            <div class="modal fade" id="booking-confirmation-modal" tabindex="-1" role="dialog" aria-labelledby="booking-confirmation-modalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle" >Booking confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Please confirm if you want to take care of that booking by clicking on one of the below option
                </div>
                <div class="modal-footer">
                    <form action="{{route('bookings.update',$booking->id)}}" method="post">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="booking_status" value="confirmed">
                        <button type="submit" class="btn btn-primary">Accept</button>
                    </form>

                    <form action="{{route('bookings.update',$booking->id)}}" method="post">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="booking_status" value="cancelled">
                        <button type="submit" class="btn btn-danger">Refuse</button>
                    </form>

                </div>
                </div>
            </div>
            </div>
            @endif

        @endif


    </div>
    @endforeach

</div>

@endsection('content')