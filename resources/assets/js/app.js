'use strict';

import './bootstrap';
import Vue from 'vue';
import moment from 'moment';
import swm from './sw-manager';
import NotificationsSettings from './components/NotificationsSettings.vue';
import NotificationsDropdown from './components/NotificationsDropdown.vue';
import ActionProgressBar from './components/ActionProgressBar.vue';

swm.registerServiceWorker();

const app = new Vue({
    el: 'body',

    components: {
        NotificationsSettings,
        NotificationsDropdown,
        ActionProgressBar
    }
});
