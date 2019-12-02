<template>
    <v-app-bar
            app
            clipped-left
            light
    >
        <slot></slot>
        <v-toolbar-title>{{ applicationName }}</v-toolbar-title>
    </v-app-bar>
</template>

<script>
    export default {
        data: () => ({
            drawer: null,
            applicationName: process.env.MIX_APP_NAME,
        }),
    }
</script>

<style scoped>

</style>