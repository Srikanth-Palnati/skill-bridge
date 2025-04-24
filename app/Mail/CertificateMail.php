<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CertificateMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $course;
    public $path;

    public function __construct($user, $course, $path = null)
    {
        $this->user = $user;
        $this->course = $course;
        $this->path = $path;
    }

    public function build()
    {
        $mail = $this->subject('Your Course Certificate from SkillBridge')
                     ->markdown('emails.certificate')
                     ->with([
                         'user' => $this->user,
                         'course' => $this->course,
                     ]);

        if ($this->path && file_exists($this->path)) {
            $mail->attach($this->path);
        }

        return $mail;
    }
}
