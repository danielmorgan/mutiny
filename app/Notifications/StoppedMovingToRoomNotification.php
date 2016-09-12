<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushMessage;
use NotificationChannels\WebPush\WebPushChannel;
use App\Rooms\Room;

class StoppedMovingToRoomNotification extends Notification
{
    use Queueable;

    /**
     * @var \App\Rooms\Room
     */
    public $oldTarget;

    /**
     * ChangedTargetRoomNotification constructor.
     *
     * @param \App\Rooms\Room $oldTarget
     */
    public function __construct(Room $oldTarget)
    {
        $this->oldTarget = $oldTarget;
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
            'title' => 'Stopped moving',
            'body' => "You stop before reaching the {$this->oldTarget}, lingering in the corridors.",
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
        $oldTarget = Room::find($notification->oldTarget->id);

        return WebPushMessage::create()
            ->id($notification->id)
            ->title('Stopped moving')
            ->body("You stop before reaching the {$oldTarget}, lingering in the corridors.")
            ->icon('/img/notification-icon.png');
    }
}
