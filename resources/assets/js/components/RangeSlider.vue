<template>
    <div class="v-range-slider">
        <div class="col-xs-12 col-sm-2">
            <slot name="left"></slot>
        </div>
        <div class="col-xs-12 col-sm-8">
            <input type="range" v-model="value" :min="min" :max="max" :step="step" :name="name" :id="name">
        </div>
        <div class="col-xs-12 col-sm-2">
            <slot name="right"></slot>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            min: {
                type: Number,
            },
            max: {
                type: Number,
            },
            step: {
                type: Number,
            },
            name: {
                type: String,
            },
            value: {
                type: Number,
            }
        }
    }
</script>

<style lang="sass">
    @import '../../sass/variables.scss';

    .v-range-slider {
        display: flex;
        align-items: center;
    }
    .v-range-slider input[type=range] {
        -webkit-appearance: none;
        flex: 1;
        display: block;
        overflow: hidden;
        box-sizing: border-box;
        outline: none;
        -webkit-tap-highlight-color: transparent;
    }
    .v-range-slider input::-webkit-slider-runnable-track {
        position: relative;
        margin: 5px 0;
        height: 25px;
        background: #f5f5f5;
        box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
        border-radius: 3px;
    }
    .v-range-slider input::-webkit-slider-thumb {
        -webkit-appearance: none;
        position: relative;
        left: 0;
        bottom: -15px;
        z-index: 999;
        cursor: pointer;
        width: 0;
        height: 0;
        border-left: 5px solid transparent;
        border-right: 5px solid transparent;
        border-bottom: 13px solid $brand-success;
    }
    .v-range-slider input::-webkit-slider-thumb:before {
        position: absolute;
        display: inline-block;
        content: '';
        top: 12px;
        left: -2001px;
        width: 2000px;
        height: 2px;
        background: magenta;
    }
</style>
