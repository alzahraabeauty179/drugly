<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use Carbon\Carbon;

class Announcement extends Notification
{
    use Queueable;

    private $message;
    private $title;
    private $notifiersNo;
    private $notifiers;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($message, $title, $notifiersNo, $notifiers)
    {
        $this->message     = $message;
        $this->title       = $title;
        $this->notifiersNo = $notifiersNo;
        $this->notifiers   = $notifiers;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [CustomDbAnnouncementChannel::class]; //<-- important custom Channel defined here
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
            'title' => [ 'en'=>$this->title['en'], 'ar'=>$this->title['ar'] ],
            'message' => [ 'en'=>$this->message['en'], 'ar'=>$this->message['ar'] ],
            'notifiersNo'=>$this->notifiersNo,
            'notifiers'  =>$this->notifiers,
            'sendAt'  => Carbon::now()
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
