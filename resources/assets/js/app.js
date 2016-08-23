'use strict';

import './App/bootstrap';
import SW from './App/ServiceWorkerSetup.js';

const sw = new SW('/js/sw.js');

Vue.component('push-notifications-toggle', require('./App/PushNotificationsToggle.vue'));

const app = new Vue({
    el: 'body',
});
