<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\ApplicationHead;

class ApplicationStatusUpdated extends Mailable
{
    use Queueable, SerializesModels;

    /** @var ApplicationHead */
    public $application;

    /** @var \Illuminate\Database\Eloquent\Model|null */
    public $details;

    /** @var \Illuminate\Support\Carbon|null */
    public $date;

    /** @var string */
    public $status;

    /** @var string|null */
    public $status_reason;

    /**
     * Create a new message instance.
     */
    public function __construct(ApplicationHead $application)
    {
        $this->application = $application;
        $this->details = $application->details;
        $this->date = $application->created_at;
        $this->status = $application->status;
        $this->status_reason = $application->status_reason;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Update on your application status')
                    ->view('emails.application_status');
    }
}
