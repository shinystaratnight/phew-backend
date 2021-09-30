<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPassword extends Notification implements ShouldQueue
{
    use Queueable;
    public $token;

       /**
        * Create a notification instance.
        *
        * @param  string  $token
        * @return void
        */
       public function __construct($token)
       {
           $this->token = $token;
       }

       /**
        * Get the notification's channels.
        *
        * @param  mixed  $notifiable
        * @return array|string
        */
       public function via($notifiable)
       {
           return ['mail'];
       }

       /**
        * Get the notification message.
        *
        * @param  mixed  $notifiable
        * @return \Illuminate\Notifications\MessageBuilder
        */
       public function toMail($notifiable)
       {
         $email=$notifiable->email;
         $token=$this->token;
         return (new MailMessage)
                  ->subject('استعادة كلمة المرور')
                  ->from(settings('email'),settings('project_name_ar'))
                  ->view('auth.email.reset',compact('token','email'));

       }
}
