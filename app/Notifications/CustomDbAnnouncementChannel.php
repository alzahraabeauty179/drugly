<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class CustomDbAnnouncementChannel 
{

  public function send($notifiable, Notification $notification)
  {
    $data = $notification->toDatabase($notifiable);

    return $notifiable->routeNotificationFor('database')->create([
        'id' => $notification->id,

        //customize here
        'is_announcement' => 1, //<-- comes from toDatabase() Method below
        'created_by'=> auth()->user()->id,

        'type' => get_class($notification),
        'data' => $data,
        'read_at' => null,
    ]);
  }

}