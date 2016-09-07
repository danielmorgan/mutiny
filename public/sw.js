'use strict';

class WebPush {
    constructor() {
        self.addEventListener('install', function(event) {
            event.waitUntil(self.skipWaiting());
        });
        self.addEventListener('activate', function(event) {
            event.waitUntil(self.clients.claim());
        });
        self.addEventListener('push', this.notificationPushed.bind(this));
        self.addEventListener('notificationclick', this.notificationClicked.bind(this));
        self.addEventListener('notificationclose', this.notificationClosed.bind(this));
    }

    notificationPushed(event) {
        if (! self.Notification) return;
        if (self.Notification.permission !== 'granted') return;

        event.waitUntil(this.sendNotification(event.data.json()));
    }

    sendNotification(data) {
        const actions = data.actions || [];
        const defaultActions = [{ 'title': 'Dismiss', 'action': 'dismiss' }];
        const allActions = actions.concat(defaultActions);

        return self.registration.showNotification(data.title, {
            body: data.body,
            icon: data.icon,
            data: data,
            actions: allActions
        });
    }

    notificationClicked(event) {
        event.notification.close();

        let url = self.location.origin;
        if (event.action === 'view.ship') {
            url = url + '/ship';
        } else if (event.action === 'view.profile') {
            url = url + '/profile';
        } else if (event.action === 'view.wallet') {
            url = url + '/wallet';
        }

        if (event.action !== 'dismiss') {
            event.waitUntil(
                clients.matchAll({type: 'window'}).then(windowClients => {
                    const focusedPage = windowClients.filter(c => c.focused);
                    const samePageUnfocused = windowClients.filter(c => c.url == url);
                    const differentPageUnfocused = windowClients.filter(c => this._isSameDomain(c.url, url));

                    if (focusedPage.length > 0) {
                        focusedPage[0].navigate(url);
                    } else if (samePageUnfocused.length > 0) {
                        samePageUnfocused[0].focus().then(client => client.navigate(url));
                    } else if (differentPageUnfocused.length > 0) {
                        differentPageUnfocused[0].focus().then(client => client.navigate(url));
                    } else {
                        clients.openWindow(url);
                    }
                })
            );
        }

        self.registration.pushManager.getSubscription().then((subscription) => {
            if (subscription) this.dismissNotification(event, subscription);
        });
    }

    notificationClosed(event) {
        console.log('notificationClosed', event);
    }

    dismissNotification({notification}, {endpoint}) {
        if (! notification.data.id) return;

        const data = new FormData;
        data.append('endpoint', endpoint);
        fetch(`/notifications/${notification.data.id}/dismiss`, { method: 'POST', body: data });
    }

    _isSameDomain(urlA, urlB) {
        const domainA = urlA.match(/^https?\:\/\/([^\/?#]+)(?:[\/?#]|$)/i)[1];
        const domainB = urlB.match(/^https?\:\/\/([^\/?#]+)(?:[\/?#]|$)/i)[1];

        return domainA == domainB;
    }
}

new WebPush;
