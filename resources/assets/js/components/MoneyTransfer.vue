<template>
    <div class="money-transfer">
        <h3>Transfer Money</h3>
        <form action="javascript:;">
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-credit-card"></i>
                </div>
                <input type="number" class="form-control" id="amount" name="amount" v-model="amount" placeholder="Amount">
                <div class="input-group-addon">
                    <i class="fa fa-user"></i>
                </div>
                <input type="text" class="form-control" id="targetUser" name="targetUser" v-model="targetUser" placeholder="User">
                <div class="input-group-btn">
                    <button type="submit" class="btn btn-primary" @click="transfer">Transfer</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                amount: null,
                targetUser: null
            }
        },

        methods: {
            transfer() {
                const payload = {
                    amount: this.amount,
                    targetUser: this.targetUser
                };

                this.$http.post('/transfer', payload)
                    .then(res => console.log('transfer complete', res))
                    .catch(err => console.error('transfer error', err));
            }
        }
    }
</script>
