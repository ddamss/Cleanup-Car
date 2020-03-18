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

        $subject = 'Welcome new user !';
    
        return $this->from('test@cleanupcar.com', 'Cleancup Car')
                    ->markdown('mail.welcome')
                    // // ->cc($address, $name)
                    // // ->bcc($address, $name)
                    // ->replyTo($address, $name)
                    ->subject($subject);
    }
}
