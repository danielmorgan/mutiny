<template>
    <div>
        <div class="progress" v-if="action && timeLeft > 0">
            <p>Action will be completed in {{ humanizedTimeLeft }}</p>
            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
                <span class="sr-only">45% Complete</span>
            </div>
        </div>
    </div>
</template>


<script>
    import moment from 'moment';

    export default{
        props: ['action'],

        data() {
            return {
                timeLeft: 1,
                currentTimestamp: moment.utc().valueOf(),
                targetTimestamp: moment.utc(this.action.delay.date).valueOf()
            };
        },

        computed: {
            humanizedTimeLeft() {
                return moment.duration(this.timeLeft, 'ms').humanize();
            }
        },

        ready() {
            this.update();
        },

        methods: {
            update() {
                setTimeout(() => {
                    this.currentTimestamp = moment.utc().valueOf();
                    this.timeLeft = this.targetTimestamp - this.currentTimestamp;
                    this.update();
                }, 1000);
            }
        }
    }
</script>
