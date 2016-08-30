'use strict';

import './bootstrap'
import Vue from 'vue'
import Notifications from './components/Notifications'
import NotificationsDropdown from './components/NotificationsDropdown.vue'

const app = new Vue({
    el: 'body',

    components: {
        Notifications,
        NotificationsDropdown
    }
});


$('#notifyEveryone').on('click', function(event) {
    if (! confirm('Are you sure? This is really annoying.')) return;

    $.ajax({
        method: 'POST',
        url: '/spamtest'
    });
});
