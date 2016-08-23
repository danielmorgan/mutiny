<template>
    <label>
        <input type="checkbox" v-on:click="save" v-model="enabled" />
        Enable Push Notifications
    </label>
</template>

<script>
    export default {
        data: function() {
            return {
                enabled: (user.push_notifications_enabled == 1)
            };
        },

        methods: {
            save: function() {
                const url = '/api/v1/user/push-notifications';
                const payload = {
                    push_notifications_enabled: ! this.enabled
                };

                this.$http.post(url, payload)
                    .catch(this.reset);
            },

            reset: function(error) {
                this.$set('enabled', ! this.enabled);
                console.error('Error', error);
            }
        }
    }
</script>
