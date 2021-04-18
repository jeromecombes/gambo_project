<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Student_create extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $edit = false;

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
        return $this->subject("VWPP Database, Nouveaux étudiants enregistrés")
            ->markdown('emails.student.create')
            ->text('emails.student.create_plain');
    }
}
