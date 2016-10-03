<template>
    <div>
        <fieldset class="computer">
            <legend>Local Area</legend>

            <div v-for="location in locations">
                <dl class="dl-horizontal">
                    <dt>ID:</dt>
                    <dd>{{ location.id }}</dd>
                    <dt>Name:</dt>
                    <dd>{{ location.name }}</dd>
                    <dt>Description:</dt>
                    <dd>{{ location.description }}</dd>
                    <dd>
                        <button class="btn btn-info"
                                @click.prevent="go(location)"
                        >
                            Go
                        </button>
                    </dd>
                </dl>
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
