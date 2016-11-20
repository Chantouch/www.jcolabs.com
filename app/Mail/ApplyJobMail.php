<?php

namespace App\Mail;

use App\Models\ApplyJob;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ApplyJobMail extends Mailable
{
    use Queueable, SerializesModels;

    public $apply;

    /**
     * Create a new message instance.
     *
     * @param ApplyJob $applyJob
     */
    public function __construct(ApplyJob $applyJob)
    {
        $this->apply = $applyJob;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.applied.cv');
    }
}
