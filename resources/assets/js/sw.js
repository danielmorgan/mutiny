'use strict';

self.addEventListener('install', event => {
    self.skipWaiting();
    console.log('sw.js::install', event);
});

self.addEventListener('activate', event => {
    console.log('sw.js::activate', event);
});

self.addEventListener('push', event => {
    console.log('sw.js::push', event);

    event.waitUntil(
        self.registration.showNotification('test', {
            body: 'test'
        })
    );
});

self.addEventListener('notificationclick', event => {
    console.log('sw.js::notificationclick', event);

    event.notification.close();

    const url = 'http://localhost:8000';
    event.waitUntil(clients.matchAll({ type: 'window' }))
        .then(windowClients => {
            for (let client of windowClients) {
                if (client.url === url && 'focus' in client) {
                    return client.focus();
                }
            }
            if (clients.openWindow) {
                return clients.openWindow(url);
            }
        });
});
