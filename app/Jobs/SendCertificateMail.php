<?php

namespace App\Jobs;

use App\Mail\CertificateMail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


class SendCertificateMail implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $course;
    protected $certificatePath;

    public function __construct($user, $course, $certificatePath = null)
    {
        $this->user = $user;
        $this->course = $course;
        $this->certificatePath = $certificatePath;
    }

    public function handle(): void
    {
        //Mail::to("markdoe1226@yopmail.com")->send(new CertificateMail($this->user, $this->course, $this->certificatePath));
        Mail::to($this->user->email)->send(new CertificateMail($this->user, $this->course, $this->certificatePath));
        
    }
}
