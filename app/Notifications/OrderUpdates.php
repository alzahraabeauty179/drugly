<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use Carbon\Carbon;

class OrderUpdates extends Notification
{
    use Queueable;

    private $message;
    private $title;
    private $order_id;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($message, $title, $order_id)
    {
        $this->message     = $message;
        $this->title       = $title;
        $this->order_id    = $order_id;
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
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return json 
     */
    public function toDatabase($notifiable)
    {
        return [
            'title'     => [ 'en'=>$this->title['en'], 'ar'=>$this->title['ar'] ],
            'message'   => [ 'en'=>$this->message['en'], 'ar'=>$this->message['ar'] ],
            'order_id'  => $this->order_id,
            'sendAt'    => Carbon::now()
        ];
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
        return [
            //
        ];
    }
}
