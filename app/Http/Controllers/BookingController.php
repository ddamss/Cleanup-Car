<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Mail\BookingStatus;
use Illuminate\Http\Request;
use MercurySeries\Flashy\Flashy;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auth=Auth::user()->id;
        $clientsID='clients.id';
        $cleanersID='cleaners.id';
        $client=\App\Client::whereId($auth)->first();
        $cleaner=\App\Cleaner::whereId($auth)->first();

        $bookings=DB::table('bookings')
            ->join('clients','clients.id','=','bookings.client_id')
            ->join('cleaners','cleaners.id','=','bookings.cleaner_id')
            ->join('vehicules','vehicules.id','=','bookings.vehicule_id')
            ->where(Auth::guard('client')->user()?$clientsID:$cleanersID,
                Auth::guard('client')->user()?$client->id:$cleaner->id)
            // ->where('bookings.booking_status','!=','cancelled')
            ->select('bookings.*','cleaners.name as cleanerName','clients.name as clientName','vehicules.name as vehiculeName','vehicules.notes as vehiculeNotes','vehicules.url')
            ->orderBy('id', 'asc')
            ->get();

            return view('bookings.show_bookings',compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $auth=Auth::user()->id;
        $client=\App\Client::whereId($auth)->first();
        $vehicules=$client->vehicules()->get();
        $cleaners=\App\Cleaner::all();

        return view('bookings.new_booking',compact('vehicules','cleaners'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $auth=Auth::user()->id;
        $client=\App\Client::whereId($auth)->first();
        $cleaner=\App\Cleaner::whereName($request->input('cleanerName'))->first();

        $vehicule_id=\App\Vehicule::whereName($request->input('vehiculeName'))->get('id');
        $cleaner_id=$cleaner->get('id');
        $booking_status='pending';

        $booking=\App\Booking::create([
            'cleaner_id'=>$cleaner_id[0]['id'],
            'client_id'=>$request->input('client_id'),
            'vehicule_id'=>$vehicule_id[0]['id'],
            'location'=>$request->input('location'),
            'bill_amount'=>$request->input('bill_amount'),
            'booking_date'=>$request->input('booking_date'),
            'booking_status'=>$booking_status,
        ]);
        Flashy::message('booking number {'.$booking->id.'} logged !');
        if($booking){
            $subject = 'New booking here ! number ['.$booking->id.']';
            Mail::to($client->email)->send(new BookingStatus($subject)); 
            Mail::to($cleaner->email)->send(new BookingStatus($subject)); 
        }
        return redirect()->route('bookings.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        \App\Booking::whereId($booking->id)->update([
            'booking_status'=>$request->input('booking_status')
        ]);
        $client_id=\App\Booking::whereClient_id($booking->client_id)->first()->client_id;

        $client=DB::table('bookings')
        ->join('clients','clients.id','=','bookings.client_id')
        ->where('bookings.client_id','=',$client_id)
        ->select('clients.*')
        ->first();
        
        if($request->input('booking_status')=='confirmed')
        {
            $subject = 'Booking number ['.$booking->id.'] confirmed !';
            Flashy::message($subject);
            Mail::to($client->email)->send(new BookingStatus($subject)); 

        }else{
            $subject = 'Booking number ['.$booking->id.'] cancelled !';
            Flashy::error($subject);
            Mail::to($client->email)->send(new BookingStatus($subject)); 
        }

        return redirect()->route('bookings.index');       
        
    }
    
}
