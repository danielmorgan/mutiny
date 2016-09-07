<template>
    <div>
        <p>Action will be completed in <strong>{{ humanizedTimeLeft }}</strong></p>
        <div class="progress" v-if="action && timeLeft > 0">
            <div class="progress-bar progress-bar-striped active"
                v-bind:style="{ width: percent + '%' }"
            >
                <span class="sr-only">{{ percent }}% Complete</span>
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
                return moment.duration(this.timeLeft, 's').humanize();
            },
            percent() {
                return 100 - (100 / this.timeLeft);
            }
        },

        ready() {
            this.update();
        },

        methods: {
            update() {
                setTimeout(() => {
                    this.currentTimestamp = moment.utc().valueOf();
                    this.timeLeft = (this.targetTimestamp - this.currentTimestamp) / 1000;
                    console.log(this.percent);
                    this.update();
                }, 1000);
            }
        }
    }
</script>
