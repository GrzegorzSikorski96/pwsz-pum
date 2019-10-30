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
        <span>Grzegorz <span class="font-weight-bold">Sikorski</span> &copy; 2019</span>
    </v-footer>
</template>

<script>
    export default {
        data: () => ({
            links: [
                {
                    url: 'https://www.linkedin.com/in/grzegorz-sikorski-5614ba161/',
                    icon: 'linkedin-in',
                    color: 'blue',
                },
                {
                    url: 'https://gitlab.com/grzegorz.sikorski.96',
                    icon: 'gitlab',
                    color: 'orange',
                },
            ],
        }),
    }
</script>

<style scoped>

</style>