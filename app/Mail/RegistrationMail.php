<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistrationMail extends Mailable
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
        $this->data  = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $address = 'comply@smithandboltons.com';
        $subject = 'Registration Successful';
        $name = 'KYC Uganda';
        return $this->view('emails.registration')->from($address, $name)
            ->replyTo($address, $name)
            ->subject($subject)
            ->with(['company' => $this->data['company']]);;
    }
}
