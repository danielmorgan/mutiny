'use strict';

import './bootstrap';
import Vue from 'vue';
import NotificationsSettings from './components/NotificationsSettings.vue';
import NotificationsDropdown from './components/NotificationsDropdown.vue';

const app = new Vue({
    el: 'body',

    components: {
        NotificationsSettings,
        NotificationsDropdown
    }
});
