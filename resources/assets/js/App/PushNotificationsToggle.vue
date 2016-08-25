<template>
    <label>
        <input type="checkbox" v-model="push_notifications_enabled" @click="save" />
        Enable Push Notifications
    </label>
</template>

<script>
    export default {
        data: function() {
            return {
                push_notifications_enabled: (user.push_notifications_enabled == 1),
                push_notifications_endpoint: null,
                error_message: null
            }
        },


        ready: function() {
            if (! 'serviceWorker' in navigator) {
                this.$set('error_message', 'Service Worker not supported.');
                return;
            }

            navigator.serviceWorker.register('/sw.js').then(serviceWorkerRegistration => {
                serviceWorkerRegistration.pushManager.subscribe({ userVisibleOnly: true }).then(subscription => {
                    console.log('subscription', subscription);
                    this.$set('push_notifications_endpoint', subscription.endpoint);
                    this.save();
                }).catch(error => this.$set('error_message', error));
            }).catch(error => this.$set('error_message', error));
        },

        methods: {
            save: function() {
                const payload = {
                    push_notifications_enabled: ! this.push_notifications_enabled,
                    push_notifications_endpoint: this.push_notifications_endpoint
                };

                this.$http.post('/api/v1/user/push-notifications', payload)
                    .catch(this.reset);
            },

            reset: function(error) {
                this.$set('push_notifications_enabled', ! this.push_notifications_enabled);
                console.error('Error', error);
            },
        }
    }
</script>
