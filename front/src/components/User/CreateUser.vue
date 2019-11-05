<template>
    <v-container fluid fill-height>
        <v-row>
            <v-card
                    class="col-8 mx-auto"
                    raised
                    shaped
            >
                <v-card-text>
                    <p class="display-1 text--primary">Dodawanie użytkownika</p>
                    <v-form>
                        <v-text-field
                                v-model="credentials.name"
                                label="Imię"
                                required
                        ></v-text-field>

                        <v-text-field
                                v-model="credentials.surname"
                                label="Nazwisko"
                                required
                        ></v-text-field>

                        <v-text-field
                                v-model="credentials.email"
                                label="Email"
                                required
                        ></v-text-field>

                        <v-text-field
                                v-model="credentials.index"
                                label="Index"
                                required
                        ></v-text-field>

                        <v-text-field
                                v-model="credentials.password"
                                label="Hasło"
                                required
                        ></v-text-field>

                        <v-select
                                :items="roles"
                                v-model="credentials.role_id"
                                label="Rola użytkownika"
                                item-text="name"
                                item-value="id"
                        ></v-select>
                    </v-form>
                </v-card-text>
                <v-card-actions>
                    <v-btn
                            text
                            class="mx-auto font-weight-bold"
                            @click="createUser"
                    >
                        Dodaj użytkownika
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-row>
    </v-container>
</template>

<script>
    export default {
        name: 'CreateUser',
        data: () => ({
            credentials: {
                name: '',
                surname: '',
                email: '',
                password: '',
                index: '',
                role_id: '',
            },
            roles: [],
        }),
        methods: {
            async createUser() {
                this.$http.post(`/api/user`, this.credentials)
                    .then(() => {
                        this.$toasted.show('Utworzono użytkownika', {
                            type: 'success'
                        });
                    })
            },
            async fetchRoles() {
                this.$http.get(`/api/roles`).then((response) => {
                    this.roles = response.data.data.roles;
                    this.loading = false;
                });
            },
        },
        created() {
            this.fetchRoles()
        }
    }
</script>

<style>

</style>
