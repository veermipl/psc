<?php
namespace App\Mail\user;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
  

    public function __construct($user)
    {
        $this->user = $user;

    }

    public function build()
    {
     
        return $this->view('mail.auth.welcome_mail')
                    ->subject('Your Password Has Been Updated')
                    ->with([
                        'user' => $this->user,
                    ]);
    }
}
