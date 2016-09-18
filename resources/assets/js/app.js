'use strict';

import './bootstrap';
import Vue from 'vue';
import swm from './sw-manager';
import NotificationsSettings from './components/NotificationsSettings.vue';
import NotificationsDropdown from './components/NotificationsDropdown.vue';
import ActionProgressBar from './components/ActionProgressBar.vue';
import Generator from './computers/Generator.vue';

swm.registerServiceWorker();

const app = new Vue({
    el: 'body',

    components: {
        NotificationsSettings,
        NotificationsDropdown,
        ActionProgressBar,
        Generator
    }
});
