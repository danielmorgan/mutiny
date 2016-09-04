<notifications inline-template>
    <button type="btn" class="btn btn-primary"
        @click="togglePush"
        :disabled="pushButtonDisabled || loading"
        :class="{'btn-primary': !isPushEnabled, 'btn-danger': isPushEnabled}">
        @{{ isPushEnabled ? 'Disable' : 'Enable' }} Push Notifications
    </button>

    <button type="btn" class="btn btn-success btn-send" :disabled="loading" @click="sendNotification">
        Send Test Notification
    </button>
</notifications>
