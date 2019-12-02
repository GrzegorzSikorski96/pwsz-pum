<template>
    <v-footer app inset>
        <v-spacer></v-spacer>
        <v-btn
                v-for="link in links"
                :key="link.url"
                :href="link.url"
                icon :class="link.color + '--text'">

            <font-awesome-icon :icon="['fab', link.icon]"/>
        </v-btn>

        <v-spacer></v-spacer>
        &copy; 2019
    </v-footer>
</template>

<script>
    export default {
        data: () => ({
            links: [
            ],
        }),
    }
</script>

<style scoped>

</style>