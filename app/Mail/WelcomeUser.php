<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeUser extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('mail.welcome');

        // $address = 'ignore@batcave.io';
        // $name = 'Ignore Me';
        $subject = 'Welcome new user !';
    
        return $this->view('mail.welcome')
                    ->from('test@cleanupcar.com', 'Cleancup Car')
                    // // ->cc($address, $name)
                    // // ->bcc($address, $name)
                    // ->replyTo($address, $name)
                    ->subject($subject);

    }
}
