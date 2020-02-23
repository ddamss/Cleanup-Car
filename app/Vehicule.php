<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
{
    protected $fillable=['name','notes','url','client_id'];
    
    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function bookings()
    {
        return $this->hasMany('App\Booking');
    }
}
