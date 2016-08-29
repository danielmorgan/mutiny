'use strict';

import './bootstrap'
import Vue from 'vue'
import Notifications from './components/Notifications'
import NotificationsDropdown from './components/NotificationsDropdown.vue'
import MoneyTransfer from './components/MoneyTransfer.vue';

new Vue({
    el: 'body',
    components: {Notifications, NotificationsDropdown, MoneyTransfer}
});


$('#notifyEveryone').on('click', function(event) {
    $.ajax({
        method: 'POST',
        url: '/spamtest'
    });
});
