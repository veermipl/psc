<?php
namespace App\Mail\user;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public $user , $password, $role;
  

    public function __construct($user,  $password, $role)
    {
        $this->user = $user;
        $this->password = $password;
        $this->role = $role;


    }
    public function build()
    {
     
        return $this->view('mail.auth.welcome_mail')
                    ->subject('Your Password Has Been Updated')
                    ->with([
                        'user' => $this->user,
                        'password' => $this->password,
                        'role' =>  $this->role
                    ]);
    }
}
