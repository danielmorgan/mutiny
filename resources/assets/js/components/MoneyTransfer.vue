<template>
    <div class="money-transfer">
        <h2>Transfer Money</h2>
        <div class="input-group">
            <div class="input-group-addon">
                <i class="fa fa-credit-card"></i>
            </div>
            <input type="text" class="form-control" id="amount" name="amount" value="{{ amount }}" placeholder="Amount">
        </div>
        <div class="input-group">
            <div class="input-group-addon">
                <i class="fa fa-user"></i>
            </div>
            <input type="text" class="form-control" id="user" name="user" value="{{ targetUser }}" placeholder="User">
            <div class="input-group-btn">
                <button class="btn btn-primary">Transfer</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                amount: null,
                targetUser: null
            }
        }
    }
</script>
