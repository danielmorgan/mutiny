<template>
    <div class="balance">
        <i class="fa fa-credit-card"></i> <strong>Balance:</strong> <span class="balance">{{ balance }}</span>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                balance: this.$root.user.balance
            }
        }
    }
</script>
