<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class RequestNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($sender,$req)
    {
        $this->sender=$sender;
        $this->request=$req;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
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
                    ->line('This email is for activate your acount by click this link.')
                    ->action('Activate account', url('/activateAccount'))
                    ->line('after activate wait until the Ict director approve you to login!')
                    ->line('Thank you for using our MOST IT Suppoort!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'firstName'=>$this->sender->firstName,
            'middleName'=>$this->sender->middleName,
            'senderId'=>$this->sender->id,
            'requestTitle'=>$this->request->title,
            'requestMessage'=>$this->request->message,
            'requestId'=>$this->request->id,
            'sendTime'=>$this->request->sendTime,
        ];
    }
}
