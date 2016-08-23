<template>
    <label>
        <input type="checkbox" v-model="push_notifications_enabled" @click="toggle" />
        Enable Push Notifications
    </label>
</template>

<script>
    export default {
        data: function() {
            return {
                swReg: null,
                push_notifications_enabled: (user.push_notifications_enabled == 1),
                push_notifications_endpoint: null
            }
        },


        ready: function() {
            if (! 'serviceWorker' in navigator) {
                console.error('Service Worker not supported');
                return;
            }

            navigator.serviceWorker.register('/sw.js')
                .then(reg => this.swReg = reg);
        },

        methods: {
            toggle: function() {
                if (! this.push_notifications_enabled) {
                    this.subscribe();
                } else {
                    this.unsubscribe();
                }
            },

            subscribe: function() {
                const $vm = this;
                navigator.serviceWorker.getRegistration('/').then(function(serviceWorkerRegistration) {
                    serviceWorkerRegistration.pushManager.subscribe({ userVisibleOnly: true })
                        .then(function(subscription) {
                            $vm.set('push_notifications_endpoint', subscription.endpoint);
                        })
                        .catch(function(error) {
                            console.error(error);
                        });
                });
            },

            unsubscribe: function() {
                console.log('::unsubscribe');
            },

            saveToServer: function() {
                const payload = {
                    push_notifications_enabled: ! this.push_notifications_enabled,
                    push_notifications_endpoint: this.push_notifications_endpoint
                };

                this.$http.post('/api/v1/user/push-notifications', payload)
                    .then(this.alert)
                    .catch(this.rest);
            },

            confirm: function(response) {
                alert('everything worked');
                console.log(response);
            },

            reset: function(error) {
                this.$set('push_notifications_enabled', ! this.push_notifications_enabled);
                console.error('Error', error);
            },

            setSubscription: function(response) {
                const url = '/api/v1/user/push-notifications-endpoint';
//                this.$http.post(url, { push_endpoint: subscription.endpoint });

                if (response.data.push_notifications_enabled) {
                    this.swReg.pushManager.subscribe({ userVisibleOnly: true })
                        .then(function(subscription) {
                        });
                } else {
                    this.swReg.pushManager.getSubscription()
                        .then(function(subscription) {
                            subscription.unsubscribe();
                            this.$http.post(url, { push_endpoint: null });
                        });
                }
            }
        }
    }
</script>
