@extends('layouts.app')


@section('content')
<div style="margin: 20px 0;">

    <button type="button" class="btn btn-outline-primary btn-rounded waves-effect" style="margin:0 auto;font-size:13px;">
        <a href="{{route('vehicules.create')}}" style="text-decoration: none;color:inherit;">Add car</a>
    </button>

    <button type="button" class="btn btn-outline-primary btn-rounded waves-effect" style="margin:0 auto;font-size:13px;">
        <a href="{{route('vehicules.index')}}" style="text-decoration: none;color:inherit;">My cars</a>
    </button>

    <button type="button" class="btn btn-outline-primary btn-rounded waves-effect" style="margin:0 auto;font-size:13px;">
        <a href="{{route('bookings.index')}}" style="text-decoration: none;color:inherit;">My bookings</a>
    </button>

    <button type="button" class="btn btn-outline-primary btn-rounded waves-effect" style="margin:0 auto;font-size:13px;">
      <a href="{{route('bookings.create')}}" style="text-decoration: none;color:inherit;">New booking</a> 
    </button>

</div>

<div style="margin:auto;">
    <div class="card" style="width: 50rem;margin:auto;">
        <img class="card-img-top" src="{{$val->url}}" alt="Card image cap">
        <div class="card-body">
        <hr>
            <h5 class="card-title">{{$val->name}}</h5>
            <p class="card-text">{{$val->notes}}</p>

            <button type="button" class="btn btn-outline-primary btn-rounded waves-effect" style="display:inline-block;margin-left:30%;font-size:13px;">
                <a href="{{route('vehicules.edit',$val)}}" style="text-decoration: none;color:inherit;">Edit</a>
            </button>

            <form action="{{route('vehicules.destroy',$val)}}}" method="POST" style="display:inline-block;margin-left:30%;font-size:13px;">
                <input class="btn btn-outline-danger btn-rounded waves-effect" type="submit" value="Delete" />
                <input type="hidden" name="_method" value="delete" />
                @csrf
            </form>

        </div>
    </div>
</div>
@endsection('content')