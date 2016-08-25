<template>
    <label>
        <input type="checkbox" v-model="push_enabled" @click="save" />
        Enable Push Notifications
    </label>
</template>

<script>
    export default {
        data: function() {
            return {
                push_enabled: (user.push_enabled == 1),
                push_endpoint: null,
                push_key_auth: null,
                push_key_p256dh: null
            }
        },

        ready: function() {
            if (! 'serviceWorker' in navigator) {
                console.error('Service Worker not supported.');
                return;
            }

            navigator.serviceWorker.register('/sw.js').then(serviceWorkerRegistration => {
                serviceWorkerRegistration.pushManager.subscribe({ userVisibleOnly: true }).then(pushSubscription => {
                    const sub = JSON.parse(JSON.stringify(pushSubscription));
                    console.log('subscription', sub);

                    this.$set('push_endpoint', sub.endpoint);
                    this.$set('push_key_auth', sub.keys.auth);
                    this.$set('push_key_p256dh', sub.keys.p256dh);

                    this.save();
                }).catch(error => console.error(error));
            }).catch(error => console.error(error));
        },

        methods: {
            save: function() {
                const payload = {
                    push_enabled: ! this.push_enabled,
                    push_endpoint: this.push_endpoint,
                    push_key_auth: this.push_key_auth,
                    push_key_p256dh: this.push_key_p256dh
                };

                this.$http.post('/api/v1/user/push-notifications', payload)
                    .catch(this.reset);
            },

            reset: function(error) {
                this.$set('push_enabled', ! this.push_enabled);
                console.error(error);
            },
        }
    }
</script>
