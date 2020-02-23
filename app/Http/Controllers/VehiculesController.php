<?php

namespace App\Http\Controllers;

use App\Vehicule;
use Illuminate\Http\Request;
use MercurySeries\Flashy\Flashy;
use Illuminate\Support\Facades\Auth;

class VehiculesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auth=Auth::user()->id;
        $client=\App\Client::whereId($auth)->first();
        $vehicules=$client->vehicules()->paginate(10);
        $allVehicules=$vehicules->count();
        return view('vehicules.show_vehicules',compact('vehicules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vehicules.add_vehicule');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $vehicule=\App\Vehicule::create([
            'name'=>$request->input('name'),
            'notes'=>$request->input('notes'),
            'url'=>$request->input('url'),
            'client_id'=>Auth::guard('client')->user()->id,
        ]);
        Flashy::message($vehicule->name.' added !', route('vehicules.show',$vehicule->id));
        return redirect()->route('vehicules.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vehicule  $vehicule
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicule $vehicule)
    {
        $auth=Auth::user()->id;
        $val=\App\Vehicule::where('client_id',$auth)
            ->where('id',$vehicule->id)
            ->firstOrFail();
        return view('vehicules.show_vehicule',compact('val'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vehicule  $vehicule
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicule $vehicule)
    {
        $auth=Auth::user()->id;
        $val=\App\Vehicule::where('client_id',$auth)
            ->where('id',$vehicule->id)
            ->firstOrFail();
        return view('vehicules.edit_vehicule',compact('val'));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vehicule  $vehicule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehicule $vehicule)
    {
        $auth=Auth::user()->id;
        $val=\App\Vehicule::where('client_id',$auth)
            ->where('id',$vehicule->id)
            ->firstOrFail();

        $val->update([
            'name'=>$request->input('name'),
            'notes'=>$request->input('notes'),
            'url'=>$request->input('url'),
        ]);

        Flashy::message($val->name.' updated !', route('vehicules.show',$vehicule->id));
        return redirect()->route('vehicules.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vehicule  $vehicule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicule $vehicule)
    {
        $auth=Auth::user()->id;
        $val=\App\Vehicule::where('client_id',$auth)
            ->where('id',$vehicule->id)
            ->firstOrFail();

        $val->delete();
        Flashy::error($vehicule->name.' deleted !');
        return redirect()->route('vehicules.index');
    }
}
