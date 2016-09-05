'use strict';

class WebPush {
    constructor() {
        self.addEventListener('push', this.notificationPushed.bind(this))
        self.addEventListener('notificationclick', this.notificationClicked.bind(this))
        self.addEventListener('notificationclose', this.notificationClosed.bind(this))
    }

    notificationPushed(event) {
        if (! self.Notification) return;
        if (self.Notification.permission !== 'granted') return;

        console.log('notificationPushed', event);
        event.waitUntil(this.sendNotification(event.data.json()));
    }

    sendNotification(data) {
        console.log(data); return;
        return self.registration.showNotification(data.title, {
            body: data.body,
            icon: data.icon,
            data: data,
            actions: data.actions || []
        });
    }

    notificationClicked(event) {
        console.log('notificationClicked', event);
    }

    notificationClosed(event) {
        console.log('notificationClosed', event);
    }

    notificationDismissed(event) {
        console.log('notificationDismissed', event);
    }
}

new WebPush;
