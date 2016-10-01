<template>
    <form class="form-horizontal">
        <fieldset>
            <legend>Generator</legend>

            <div class="form-group">
                <label class="col-sm-2">Fuel Stores:</label>
                <div class="col-sm-10">{{ fuel }}kg</div>
            </div>

            <div class="form-group">
                <label class="col-sm-2">Coolant Stores:</label>
                <div class="col-sm-10">{{ coolant }}L</div>
            </div>

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
                <label class="col-sm-2">Energy output:</label>
                <div class="col-sm-10">
                    <div class="progress">
                        <div role="progressbar"
                             aria-valuemin="0"
                             aria-valuemax="1"
                             v-bind:aria-valuenow="energyOutputRate"
                             v-bind:class="['progress-bar', 'progress-bar-warning', { 'progress-bar-striped': energyOutputRate > 0, 'active': energyOutputRate > 0 }]"
                             v-bind:style="{
                                 width: (normalizedEnergyOutputRate * 100) + '%',
                                 animation: 'reverse progress-bar-stripes ' + energyStripeSpeed + 's linear infinite'
                             }"
                        >
                            {{ energyOutputRate }} Mw
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2">Temperature:</label>
                <div class="col-sm-10">
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped active progress-bar-danger"
                             role="progressbar"
                             aria-valuemin="0"
                             aria-valuemax="1"
                             v-bind:aria-valuenow="temp"
                             v-bind:class="['progress-bar', { 'progress-bar-striped': temp > 0, 'active': temp > 0 }]"
                             v-bind:style="{
                                width: (normalizedTemperature * 100) + '%',
                                animation: 'reverse progress-bar-stripes ' + temperatureStripeSpeed + 's linear infinite',
                             }"
                        >
                            {{ temp }}&deg;C
                        </div>
                    </div>
                </div>
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
                <label class="col-sm-2" for="route-to">Energy Stores:</label>
                <div class="col-sm-10">{{ energy }}Mwh</div>
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

    .progress-bar {
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
        min-width: 50px;
        transition: all 12s ease-out !important;
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
                temp: this.temperature,
                fuel: null,
                coolant: null,
                energy: null,
                timeout: null
            };
        },

        computed: {
            normalizedEnergyOutputRate() {
                return this.energyOutputRate / 1000;
            },
            normalizedTemperature() {
                return this.temp / 1000;
            },
            energyStripeSpeed() {
                return 1 / (this.normalizedEnergyOutputRate * 3);
            },
            temperatureStripeSpeed() {
                return 1 / (this.normalizedTemperature * 3);
            }
        },

        ready() {
            this.loadResources();
        },

        methods: {
            loadResources() {
                this.$http.get('/system/resources')
                    .then(({ data }) => {
                        this.fuel = data.fuel;
                        this.coolant = data.coolant;
                        this.energy = data.energy;
                    });

                this.timeout = setTimeout(this.loadResources.bind(this), 10000);
            },

            save() {
                const payload = {
                    fuel_in: this.fuelInputRate,
                    coolant_in: this.coolantInputRate
                };

                this.$http.post('/system/generator/1/inputs', payload)
                    .then(res => {
                        this.energyOutputRate = res.data.energy_out;
                        this.temp = res.data.temperature;

                        clearTimeout(this.timeout);
                    });
            }
        }
    }
</script>
