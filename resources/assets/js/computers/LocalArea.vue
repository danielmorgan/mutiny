<template>
    <div>
        <fieldset class="computer">
            <legend>Local Area</legend>

            <div class="table-responsive">
                <table class="table table-bordered table-condensed table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Distance</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr v-for="location in locations">
                            <th scope="row">{{ location.id }}</th>
                            <td>{{ location.name }}</td>
                            <td>500Km</td>
                            <td class="actions text-center">
                                <button class="btn btn-info"
                                        @click.prevent="go(location)"
                                >
                                    Go to
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </fieldset>
    </div>
</template>


<script>
    export default {
        data() {
            return {
                locations: []
            };
        },

        ready() {
            this.$http.get('ship/local-area')
                .then(res => {
                    this.locations = res.data;
                });
        },

        methods: {
            go(location) {
                console.log(location);
            }
        }
    }
</script>
