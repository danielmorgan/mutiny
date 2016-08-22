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
                const url = '/api/v1/users/' + user.id + '/push-notifications';
                const payload = {
                    push_notifications_enabled: ! this.enabled
                };

                this.$http.post(url, payload)
                    .then(this.confirm)
                    .catch(this.reset);
            },

            confirm: function(response) {
                this.$set('enabled', response.data.push_notifications_enabled);
            },

            reset: function(error) {
                this.$set('enabled', ! this.enabled);
                console.error('Error', error);
            }
        }
    }
</script>
