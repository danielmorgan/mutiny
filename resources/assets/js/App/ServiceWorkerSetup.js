'use strict';

export default class ServiceWorkerSetup {
    constructor(swPath) {
        if (! 'serviceWorker' in navigator) {
            console.error('serviceWorker not available.');
            return;
        }

        navigator.serviceWorker.register(swPath)
            .catch(error => console.error(error));
    }

    registerPushNotifications(reg) {
        console.log(reg);
    }

    storePushEndpoint(sub) {
        console.log('storePushEndpoint', sub.endpoint);
    }

    unstorePushEndpoint(sub) {
        console.log('unstorePushEndpoint', sub.endpoint);
    }
}
