<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use NotificationChannels\WebPush\WebPushMessage;
use NotificationChannels\WebPush\WebPushChannel;
use App\Rooms\Room;

class FinishedMovingToRoomNotification extends Notification
{
    use Queueable;

    /**
     * @var \App\Rooms\Room
     */
    public $room;

    /**
     * Create a new notification instance.
     *
     * @param \App\Rooms\Room $room
     */
    public function __construct(Room $room)
    {
        $this->room = $room;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast', WebPushChannel::class];
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
            'title' => "You arrive in the {$this->room}",
            'action_url' => url('/'),
            'created' => Carbon::now()->toIso8601String(),
        ];
    }

    /**
     * Get the web push representation of the notification.
     *
     * @param  mixed  $notifiable
     * @param  mixed  $notification
     * @return \NotificationChannels\WebPush\WebPushMessage
     */
    public function toWebPush($notifiable, $notification)
    {
        $room = Room::find($notification->room->id);

        return WebPushMessage::create()
            ->id($notification->id)
            ->title("You arrive in the {$room}")
            ->icon('/img/notification-icon.png')
            ->action("Access {$room->type} Computers", 'view_app');
    }
}
