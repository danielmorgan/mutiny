<template>
    <form class="form-horizontal">
        <fieldset>
            <legend>Fission Generator</legend>

            <div class="form-group">
                <range-slider :name="'fuelInputRate'"
                              :min="0"
                              :max="1"
                              :step="0.01"
                              :value.sync="fuelInputRate"
                >
                    <label for="fuelInputRate" slot="left">Fuel input:</label>
                    <p slot="right">{{ fuelInputRate }} kg/min</p>
                </range-slider>
            </div>

            <div class="form-group">
                <range-slider :name="'coolantInputRate'"
                              :min="0"
                              :max="1"
                              :step="0.01"
                              :value.sync="coolantInputRate"
                >
                    <label for="coolantInputRate" slot="left">Coolant input:</label>
                    <p slot="right">{{ coolantInputRate }} L/min</p>
                </range-slider>
            </div>

            <div class="form-group">
                <label class="col-sm-2" for="route-to">Route to:</label>
                <div class="col-sm-10">
                    <select class="form-control" id="route-to" name="route-to">
                        <option value="ship">Ship Batteries</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2">Energy output:</label>
                <div class="col-sm-10">
                    <div class="progress">
                        <div class="progress-bar progress-bar-warning"
                             role="progressbar"
                             aria-valuemin="0"
                             aria-valuemax="1"
                             v-bind:aria-valuenow="energyOutputRate"
                             v-bind:style="{ width: (normalizedEnergyOutputRate * 100) + '%' }"
                        >
                            {{ energyOutputRate.toFixed(2) }} MW
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2">Temperature:</label>
                <div class="col-sm-10">
                    <div class="progress">
                        <div class="progress-bar progress-bar-danger"
                             role="progressbar"
                             aria-valuemin="0"
                             aria-valuemax="1"
                             v-bind:aria-valuenow="temperature"
                             v-bind:style="{ width: (normalizedTemperature * 100) + '%' }"
                        >
                            {{ temperature.toFixed(1) }}&deg;C
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-12 text-center">
                    <button type="submit" class="btn btn-large btn-primary"
                        @click.prevent="save"
                    >
                        Save
                    </button>
                </div>
            </div>

        </fieldset>

    </form>
</template>


<style lang="sass">
    fieldset {
        padding: 20px;
        border-radius: 4px;
        border: 1px solid #ddd;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);

        legend {
            width: auto;
            margin: 0;
            border: none;
            font-weight: bold;
            padding: 0 10px;
        }
    }
</style>


<script>
    import RangeSlider from '../components/RangeSlider.vue';

    export default {
        components: { RangeSlider },

        data() {
            return {
                fuelInputRate: 0,
                coolantInputRate: 0,
                temperature: 120
            };
        },

        computed: {
            energyOutputRate() {
                return this.fuelInputRate * 42;
            },
            normalizedEnergyOutputRate() {
                return this.fuelInputRate;
            },
            normalizedTemperature() {
                return (1 / 500) * this.temperature;
            }
        },

        methods: {
            save() {
                console.log(this.energyOutputRate);
            }
        }
    }
</script>
