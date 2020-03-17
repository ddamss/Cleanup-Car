<?php

use App\Mail\WelcomeUser;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the 'web' middleware group. Now create something great!
|
*/
Route::resource('vehicules', 'VehiculesController')->middleware('auth:client');

Auth::routes();

Route::get('/', function(){
    return view('welcome');
})->name('welcome');

Route::resource('bookings', 'BookingController')->only([
    'index','create','store','show','update','destroy'
])->middleware('auth:client,cleaner');


Route::get('/mail', function () {
    // send an email to "batman@batcave.io"
    Mail::to('adam.abdelmoumni@gmail.com')->send(new WelcomeUser);

    return "mail sent !";
});


