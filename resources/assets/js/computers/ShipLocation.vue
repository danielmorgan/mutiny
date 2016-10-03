<template>
    <div>
        <fieldset class="computer">
            <legend>Ship Location</legend>

            <h3>{{ location.name }}</h3>

            <p>{{ location.description }}</p>

            <img class="img-responsive"
                 v-bind:src="location.image"
                 v-bind:alt="location.name">
        </fieldset>
    </div>
</template>


<style lang="sass" scoped>
    h3 {
        margin-top: 0;
    }
</style>


<script>
    export default {
        data() {
            return {
                location: {
                    id: null,
                    name: null,
                    description: null,
                    image: null
                }
            };
        },

        ready() {
            this.$http.get('ship/location')
                .then(res => {
                    this.location.id = res.data.id;
                    this.location.name = res.data.name;
                    this.location.description = res.data.description;
                    this.location.image = res.data.image;
                });
        }
    }
</script>
