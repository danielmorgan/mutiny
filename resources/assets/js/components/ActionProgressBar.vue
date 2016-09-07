<template>
    <div>
        <div v-if="action && timeLeft > 0" class="well">
            <p>{{ action.description }} (Time remaining: <strong>{{ humanizedTimeLeft }}</strong>)</p>

            <div class="progress">
                <div class="progress-bar progress-bar-striped active"
                    v-bind:style="{ width: percent + '%' }"
                >
                    <span class="sr-only">{{ percent }}% Complete</span>
                </div>
            </div>
        </div>
    </div>
</template>


<style>
    .progress {
        margin: 0;
    }
</style>


<script>
    import moment from 'moment';

    export default{
        props: ['action'],

        data() {
            return {
                timeLeft: this.action.duration,
                currentTimestamp: moment.utc().valueOf(),
                targetTimestamp: moment.utc(this.action.delay.date).valueOf()
            };
        },

        computed: {
            humanizedTimeLeft() {
                return moment.duration(this.timeLeft, 's').humanize();
            },
            percent() {
                return 100 + (-this.timeLeft / this.action.duration) * 100;
            }
        },

        ready() {
            this.update();
        },

        methods: {
            update() {
                this.currentTimestamp = moment.utc().valueOf();
                this.timeLeft = (this.targetTimestamp - this.currentTimestamp) / 1000;

                if (this.timeLeft < 0) {
                    this.complete();
                    return;
                };

                requestAnimationFrame(this.update);
            },

            complete() {
                if (this.action.completedUrl) {
                    window.location = this.action.completedUrl;
                }
            }
        }
    }
</script>
