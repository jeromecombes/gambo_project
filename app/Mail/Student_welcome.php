<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Student_welcome extends Mailable
{
    use Queueable, SerializesModels;

    public $student;
    public $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($student, $password)
    {
        $this->student = $student;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('VWPP Registration Details')
            ->markdown('emails.student.welcome')
            ->text('emails.student.welcome_plain');
    }
}
