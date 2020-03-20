<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeUser extends Mailable
{
    use Queueable, SerializesModels;
    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        $subject = 'Welcome new user '.$this->data['name'].' !';
    
        return $this->from('test@cleanupcar.com', 'Cleancup Car')
                    ->markdown('mail.welcome')
                    // // ->cc($address, $name)
                    // // ->bcc($address, $name)
                    // ->replyTo($address, $name)
                    ->subject($subject);
    }
}
