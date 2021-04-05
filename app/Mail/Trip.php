<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Trip extends Mailable
{
    use Queueable, SerializesModels;

    public $trip;
    public $edit = false;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($trip)
    {
        $this->trip = $trip;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = "Formulaire de voyage ";
        $subject.= $this->trip->lastname . ' ' . $this->trip->firstname;

        return $this->subject($subject)
            ->markdown('emails.trip')
            ->text('emails.trip_plain');
    }
}
