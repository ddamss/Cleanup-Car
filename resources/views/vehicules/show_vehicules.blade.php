@extends('layouts.app')


@section('content')

<button type="button" class="btn btn-outline-primary btn-rounded waves-effect" style="display:inline-block;margin-left:50px;font-size:13px;">
    <a href="{{route('vehicules.create')}}" style="text-decoration: none;color:inherit;">Add car</a>
</button>

<button type="button" class="btn btn-outline-primary btn-rounded waves-effect" style="display:inline-block;margin-left:50px;font-size:13px;">
    <a href="{{route('bookings.create')}}" style="text-decoration: none;color:inherit;">New booking</a>
</button>


    <div class="list-group" style="display:block;margin:50px 50px;">

        @foreach($vehicules as $vehicule)
            <div class="list-group">
                <div class="list-group-item list-group-item-action"><a href="{{route('vehicules.show',$vehicule->id)}}" style="text-decoration: none;color:inherit;">
                    <div class="d-flex w-100 justify-content-between">
                        <h4>{{$vehicule->name}}</h4>
                        <b>{{$vehicule->id}}</b>
                    </div>        
                    <p>{{$vehicule->notes}}</p>
              </div></a><br>
            </div>
        @endforeach
        {{$vehicules->links()}}
    </div>




    <div class="list-group" style="display:block;margin:50px 50px;">

    @foreach($vehicules as $vehicule)

        <div class="card" style="width:40%;">
            <div class="row" style="display:inline-block;">
                <div class="col-sm-6">
                    <img class="card-img" src="{{$vehicule->url}}" alt="Card image"/>
                </div>
                <div class="col-sm-6">
                    <div class="card-body-right">
                        <h1 class="card-title">{{$vehicule->name}}</h4>
                        <p class="card-text" style="font-size:17px;">{{$vehicule->notes}}</p>
                        <a href="{{route('vehicules.show',$vehicule->id)}}" class="btn btn-primary">See Profile</a>
                    </div>
                </div>
            </div> 
            
        </div>
        <br>
    @endforeach
    {{$vehicules->links()}}
    </div>



    @if($vehicules->count()%2==1)
        @php($indice=($vehicules->count()-1)/2)
    @else 
        @php($indice=($vehicules->count())/2)
    @endif

    @php ($j=0)
    @php ($k=1)
    @php ($l=0)
    
    @for ($i=0;$vehicules->count()%2==1?$i<= $indice:$i< $indice;$i++)

    <div class="card-deck">

        @php ($j=0)
        @php ($k=1)

        @if($vehicules->count()%2==1 && $i == $indice)
            @php ($k=0)
            @php ($j=0)
        @endif

        @while($j <= $k)

        @php($id=$vehicules[$l]['id'])
        <div class="card" style="max-width:40%;display:inline-block;margin-left: auto;margin-right: auto;">
                <img class="card-img-top" src="{{$vehicules[$l]['url']}}" alt="Card image cap">
                <div class="card-body">
                    <h1 class="card-title" style="text-align:center;">{{$vehicules[$l]['name']}} --  {{$l}}</h4>
                    <p class="card-text" style="font-size:17px;text-align:center;">{{$vehicules[$l]['notes']}} -- ID={{$id}}</p>
                </div>
                <div class="card-footer">
                <a href="{{route('vehicules.show',1)}}" class="btn btn-primary" style="margin-left:40%;">See Profile {{$id}}</a>
                </div>
            </div>
                @php($j++)
                @php($l++)

        @endwhile
    </div>
    <br>

    @endfor


    @endsection('content')