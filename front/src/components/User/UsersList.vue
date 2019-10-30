<template>
    <v-container fluid fill-height>
        <v-card
                raised
                shaped
                class="mx-auto col-8"
        >
            <v-card-title>
                Użytkownicy
                <v-spacer></v-spacer>
                <v-text-field
                        v-model="search"
                        append-icon="search"
                        label="Szukaj"
                        single-line
                        hide-details
                ></v-text-field>
            </v-card-title>
            <v-data-table
                    :headers="headers"
                    :items="users"
                    :search="search"
                    :loading="loading"
            >
                <template v-slot:item.actions="{ item }">
                    <v-btn text icon color="info" :to="{name: 'User', params: { id: item.id }}"
                           elevation="2">
                        <v-icon>keyboard_arrow_right</v-icon>
                    </v-btn>
                </template>
            </v-data-table>
        </v-card>
    </v-container>
</template>

<script>
    export default {
        name: 'UsersList',
        loading: true,
        data: () => ({
            search: '',
            loading: true,
            users: [],
            headers: [
                {text: 'Imię', value: 'name', align: 'left'},
                {text: 'Nazwisko', value: 'surname'},
                {text: 'Email', value: 'email'},
                {text: 'Indeks', value: 'index'},
                {value: 'actions', sortable: false, align: 'right'},
            ],
        }),
        methods: {
            async fetchUsers() {
                this.$http.get(`/api/users`).then((response) => {
                    this.users = response.data.data.users;
                    this.loading = false;
                });
            },
        },
        created() {
            this.fetchUsers();
        },
    }
</script>

<style>
</style>
