'use strict';

import './App/bootstrap';
import PushNotificationsToggle from './App/PushNotificationsToggle.vue';

Vue.component('push-notifications-toggle', PushNotificationsToggle);

const app = new Vue({
    el: 'body'
});
