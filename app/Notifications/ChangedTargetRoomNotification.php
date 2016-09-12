<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushMessage;
use NotificationChannels\WebPush\WebPushChannel;
use App\Rooms\Room;

class ChangedTargetRoomNotification extends Notification
{
    use Queueable;

    /**
     * @var \App\Rooms\Room
     */
    public $newTarget;

    /**
     * @var \App\Rooms\Room
     */
    public $oldTarget;

    /**
     * ChangedTargetRoomNotification constructor.
     *
     * @param \App\Rooms\Room $newTarget
     * @param \App\Rooms\Room $oldTarget
     */
    public function __construct(Room $newTarget, Room $oldTarget)
    {
        $this->newTarget = $newTarget;
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
            'title' => 'Changing direction',
            'body' => "You turn around, away from the {$this->oldTarget} and head towards the {$this->newTarget}.",
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
        $newTarget = Room::find($notification->newTarget->id);

        return WebPushMessage::create()
            ->id($notification->id)
            ->title('Changing direction')
            ->body("You turn away from the {$oldTarget} and head towards the {$newTarget}.")
            ->icon('/img/notification-icon.png');
    }
}
