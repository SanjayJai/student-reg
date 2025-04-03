<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InterviewScheduleMail extends Mailable
{
    use Queueable, SerializesModels;

    public $candidate;

    public function __construct($candidate)
    {
        $this->candidate = $candidate;
    }

    public function build()
    {
        return $this->subject('Interview Scheduled')
            ->view('emails.interview-schedule')
            ->with([
                'name' => $this->candidate->full_name,
                'date' => $this->candidate->technical_date_time,
                'interviewer' => $this->candidate->technical_interviewer,
            ]);
    }
}
