<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushMessage;
use NotificationChannels\WebPush\WebPushChannel;
use App\User;
use App\Rooms\Room;

class UserEnteredRoomNotification extends Notification
{
    use Queueable;

    /**
     * @var \App\User
     */
    public $user;

    /**
     * @var \App\Rooms\Room
     */
    public $room;

    /**
     * Create a new notification instance.
     *
     * @param \App\User $user
     * @param \App\Rooms\Room $room
     */
    public function __construct(User $user, Room $room)
    {
        $this->user = $user;
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
            'title' => "{$this->user} entered the {$this->room}",
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
        $user = User::find($notification->user->id);
        $room = Room::find($notification->room->id);

        return WebPushMessage::create()
            ->id($notification->id)
            ->title("{$user} entered the {$room}")
            ->icon('/img/notification-icon.png');
    }
}
