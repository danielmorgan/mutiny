'use strict';

module.exports = {
    /**
     * Register the service worker.
     */
    registerServiceWorker() {
        if (! 'serviceWorker' in navigator) {
            console.log('Service workers aren\'t supported in this browser.');
            return;
        }

        navigator.serviceWorker.register('/sw.js')
            .then(() => this._check());
    },

    /**
     * Check for feature support.
     */
    _check() {
        if (! 'showNotification' in ServiceWorkerRegistration.prototype) {
            console.log('Notifications aren\'t supported.');
            return;
        }

        if (Notification.permission === 'denied') {
            console.log('The user has blocked notifications.');
            return;
        }

        if (! 'PushManager' in window) {
            console.log('Push messaging isn\'t supported.');
            return;
        }

        navigator.serviceWorker.ready.then(registration => {
            registration.pushManager.getSubscription()
                .then(subscription => {
                    if (! window.USER) return;
                    if (subscription) return;
                    if (localStorage.getItem('notification-prompt-seen')) return;
                    if (window.location.pathname == '/settings') return;

                    if (confirm('Mutiny uses Push Notifications to let you know when something happens aboard the ship. Would you like to enable Push Notifications now?')) {
                        window.location = '/settings';
                    }

                    localStorage.setItem('notification-prompt-seen', true);
                })
                .catch(err => console.log('Error during getSubscription()', err));

        });
    }
}
