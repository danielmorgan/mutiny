'use strict';

import './bootstrap'
import Vue from 'vue'
import Notifications from './components/Notifications'
import NotificationsDropdown from './components/NotificationsDropdown.vue'
import WalletBalance from './components/WalletBalance.vue';
import WalletTransfer from './components/WalletTransfer.vue';

const app = new Vue({
    el: 'body',

    data: {
        user: window.USER
    },

    components: {
        Notifications,
        NotificationsDropdown,
        WalletBalance,
        WalletTransfer
    }
});


$('#notifyEveryone').on('click', function(event) {
    $.ajax({
        method: 'POST',
        url: '/spamtest'
    });
});
