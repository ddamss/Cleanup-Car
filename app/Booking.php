<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable=['cleaner_id','client_id','vehicule_id','location','booking_date','booking_status','bill_amount'];

    public function cleaner()
    {
        return $this->belongsTo('App\Cleaner');
    }

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function vehicule()
    {
        return $this->belongsTo('App\Vehicule');
    }
}
