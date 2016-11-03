<?php

namespace App\Mail;

use App\Model\frontend\Candidate;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CandidateActivation extends Mailable
{
    use Queueable, SerializesModels;

    public $candidate;

    /**
     * Create a new message instance.
     *
     * @param Candidate $candidate
     */
    public function __construct(Candidate $candidate)
    {
        $this->candidate = $candidate;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.candidate.activate');
    }
}
