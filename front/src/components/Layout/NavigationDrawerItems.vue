<template>
    <v-list dense shaped>
        <span v-for="category in links" :key="category.name">
            <span v-for="link in category.links" :key="link.route">
                <v-list-item v-if="checkPermitted(link, category)" ripple link :to="{name: link.route}" class="route"
                             exact>
                    <v-list-item-action>
                        <font-awesome-icon :icon="link.icon" size="lg"/>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>
                            {{link.label}}
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </span>
        </span>
    </v-list>
</template>

<script>
    export default {
        data: () => ({
            drawer: null,
            logged: true,
            links: [
                {
                    name: 'Główne', links: [
                        {route: 'HomePage', label: 'Strona głowna', icon: 'home', available: true},
                    ]
                },
                {
                    name: 'Urządzenia', links: [
                        {route: 'Devices', label: 'Lista urządzeń', icon: 'tablet-alt'},
                        {route: 'Create', label: 'Dodaj urządzenie', icon: 'plus-square'},
                    ]
                },
                {
                    name: 'Użytkownicy', links: [
                        {route: 'Users', label: 'Lista użytkowników', icon: 'users'},
                    ]
                },
            ]
        }),
        methods: {
            checkPermitted(routeName) {
                if (this.$router.resolve({name: routeName.route}).route.meta.roles) {
                    if (this.$store.state.currentUser) {
                        return this.$router.resolve({name: routeName.route}).route.meta.roles.includes(this.$store.state.currentUser.role.name);
                    }
                    return false;
                }
                return true;
            },
        },
    }
</script>

<style scoped>

</style>