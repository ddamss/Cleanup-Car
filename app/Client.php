<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Client extends Authenticatable
{
    use Notifiable;

    protected $guard='client';
    protected $fillable=['name','email','password'];
    
    public function vehicules()
    {
        return $this->hasMany('App\Vehicule');
    }

    public function bookings()
    {
        return $this->hasMany('App\Booking');
    }
} 
