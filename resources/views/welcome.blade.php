@extends('layouts.app')

@section('content')

    <!--Created by- https://bootsnipp.com/ishwarkatwe-->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

    @if (Auth::guard('client')->user())

    <div class="nav-side-menu">
        <div class="brand">{{Auth::guard('client')->user()->name}}</div>
        <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
    
            <div class="menu-list">
    
                <ul id="menu-content" class="menu-content collapse out">
                    <li>
                        <a href="{{route('vehicules.index')}}"><i class="fa fa-dashboard fa-lg"></i> My cars</a>
                    </li>

                    <li>
                        <a href="{{route('vehicules.create')}}"><i class="fa fa-dashboard fa-lg"></i> Add a car</a>
                    </li>       

                    <li>
                        <a href="{{route('bookings.create')}}"><i class="fa fa-dashboard fa-lg"></i>Book cleanup</a>
                    </li>       

                    <li>
                        <a href="{{route('bookings.index')}}"><i class="fa fa-dashboard fa-lg"></i>My bookings</a>
                    </li>      


                </ul>
        </div>
    </div>

    @elseif (Auth::guard('cleaner')->user())

    <div class="nav-side-menu">
        <div class="brand">{{Auth::guard('cleaner')->user()->name}}</div>
        <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
    
            <div class="menu-list">
    
                <ul id="menu-content" class="menu-content collapse out">
                    <li>
                        <a href="{{route('bookings.index')}}"><i class="fa fa-dashboard fa-lg"></i>My bookings</a>
                    </li>  

                    <li>
                    <a href="">
                    <i class="fa fa-dashboard fa-lg"></i> TBD
                    </a>
                    </li>            

                </ul>
        </div>
    </div>


        @endif


@endsection('content')