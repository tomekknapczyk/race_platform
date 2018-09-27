<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AccountVerification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The confirmation_code instance.
     *
     * @var confirmation_code
     */
    public $confirmation_code;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($confirmation_code)
    {
        $this->confirmation_code = $confirmation_code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Weryfikacja konta')
                    ->view('emails.accountVerification');
    }
}
