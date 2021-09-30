<?php

namespace App\Notifications\Api;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Benwilkins\FCM\FcmMessage;

class ApiNotification extends Notification implements ShouldBroadcast
{
    use Queueable;
    public $data;
    public $via;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data, $via)
    {
        $this->data = $data;
        $this->via = $via;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // return $this->via;
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return $this->data;
    }

    public function toFcm($notifiable)
    {
        $message = new FcmMessage();
        $message->setHeaders([
            'project_id'    =>  "738034444697"   // FCM sender_id
        ])->content([
            'title'=> $this->data['title'],
            'body' => $this->data['body'],
            'sound'=> '', // Optional
            'icon' => '', // Optional
            'click_action' => '' // Optional
        ])->data($this->data); // Optional - Default is 'normal'.
        // ->priority(FcmMessage::PRIORITY_HIGH)

        return $message;
    }
}
