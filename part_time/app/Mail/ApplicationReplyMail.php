<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApplicationReplyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $status;
    public $reason;
    public $userName;

    public function __construct($status, $reason = null, $userName = null)
    {
        $this->status = $status;
        $this->reason = $reason;
        $this->userName = $userName;
    }

    public function build()
    {
        return $this->subject('Application Status Update')
                    ->view('company.email.application_reply')
                    ->with([
                        'status' => $this->status,
                        'reason' => $this->reason,
                        'userName' => $this->userName,
                    ]);
    }
}
