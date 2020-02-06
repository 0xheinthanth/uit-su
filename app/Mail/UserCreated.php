<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserCreated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $passwords)
    {
        $this->email = $email;
        $this->passwords = $passwords;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('no-reply@uitsudomain.org')
                ->view('pages.admin.usercreated')
                ->with(['email' => $this->email, 'passwords' => $this->passwords]);
    }
}
