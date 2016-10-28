<?php

namespace App\Mail;

use App\Model\backend\Employer;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmployerActivation extends Mailable
{
    use Queueable, SerializesModels;

    public $employer;

    /**
     * Create a new message instance.
     *
     * @param Employer $employer
     */
    public function __construct(Employer $employer)
    {
        $this->employer = $employer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.employer.activate');
    }
}
