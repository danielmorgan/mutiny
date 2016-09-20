<template>
    <form class="form-horizontal">
        <fieldset>
            <legend>Fission Generator</legend>

            <div class="form-group">
                <range :name="'fuelInputRate'"
                              :min="fuel_in_min"
                              :max="fuel_in_max"
                              :step="1"
                              :value.sync="fuelInputRate"
                              @change="save"
                >
                    <label for="fuelInputRate" slot="left">Fuel input:</label>
                    <p slot="right">{{ fuelInputRate }} kg/min</p>
                </range>
            </div>

            <div class="form-group">
                <range :name="'coolantInputRate'"
                              :min="coolant_in_min"
                              :max="coolant_in_max"
                              :step="1"
                              :value.sync="coolantInputRate"
                              @change="save"
                >
                    <label for="coolantInputRate" slot="left">Coolant input:</label>
                    <p slot="right">{{ coolantInputRate }} L/min</p>
                </range>
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
                            {{ energyOutputRate }} MW
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
                             v-bind:aria-valuenow="temp"
                             v-bind:style="{ width: (normalizedTemperature * 100) + '%' }"
                        >
                            {{ temp }}&deg;C
                        </div>
                    </div>
                </div>
            </div>

        </fieldset>
    </form>
</template>


<style lang="sass">
    @import '../../sass/variables';

    fieldset {
        padding: 20px;
        border-radius: 4px;
        border: 2px solid $brand-info;
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
        props: {
            fuel_in: { type: Number, required: true },
            fuel_in_min: { type: Number, required: true },
            fuel_in_max: { type: Number, required: true },
            coolant_in: { type: Number, required: true },
            coolant_in_min: { type: Number, required: true },
            coolant_in_max: { type: Number, required: true },
            energy_out: { type: Number, required: true },
            temperature: { type: Number, required: true }
        },

        components: { range: RangeSlider },

        data() {
            return {
                fuelInputRate: this.fuel_in,
                coolantInputRate: this.coolant_in,
                energyOutputRate: this.energy_out,
                temp: this.temperature
            };
        },

        computed: {
            normalizedEnergyOutputRate() {
                return this.energyOutputRate / 1000;
            },
            normalizedTemperature() {
                return this.temp / 1000;
            }
        },

        ready() {
            this.loop();
        },

        methods: {
            getStatus() {
                this.$http.get('/system/generator/1/outputs')
                    .then(({ data: { energy_out, temperature } }) => {
                        this.energyOutputRate = energy_out;
                        this.temp = temperature;
                    });
            },

            save() {
                this.$http.post('/system/generator/1/inputs', {
                    fuel_in: this.fuelInputRate,
                    coolant_in: this.coolantInputRate
                });
            },

            loop() {
                this.getStatus();
                setTimeout(this.loop.bind(this), 1000);
            }
        }
    }
</script>
