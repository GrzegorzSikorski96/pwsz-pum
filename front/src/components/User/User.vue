<template>
    <v-container fluid fill-height>
        <v-row>
            <div v-if="!loading" class="col-12">
                <v-card>
                    <v-card-title>
                        Użytkownik: {{ user.name }} {{ user.surname}}
                    </v-card-title>

                    <v-card-text>
                        <v-row dense v-if="user.name">
                            <span class="font-weight-bold text--primary mr-1">Imię: </span>
                            {{ user.name }}
                        </v-row>

                        <v-row dense v-if="user.surname">
                            <span class="font-weight-bold text--primary mr-1">Nazwisko: </span>
                            {{ user.surname }}
                        </v-row>

                        <v-row dense v-if="user.email">
                            <span class="font-weight-bold text--primary mr-1">Email: </span>
                            {{ user.email }}
                        </v-row>

                        <v-row dense v-if="user.index">
                            <span class="font-weight-bold text--primary mr-1">Indeks: </span>
                            {{ user.index }}
                        </v-row>
                    </v-card-text>
                </v-card>

                <v-card class="mt-4">
                    <v-card-title>
                        Rola użytkownika
                    </v-card-title>

                    <v-card-text>
                        <v-select
                                :items="roles"
                                v-model="role"
                                label="Rola użytkownika"
                                item-text="name"
                                return-object
                        ></v-select>
                    </v-card-text>
                </v-card>

                <v-card class="mt-4">
                    <v-card-title>
                        Zmiana hasła
                    </v-card-title>

                    <v-card-text>
                        <v-text-field
                                label="Nowe hasło"
                                type="password"
                                v-model="credentials.password"
                        ></v-text-field>
                        <v-btn text @click="changePassword" class="mx-auto">
                            Zmień hasło
                        </v-btn>
                    </v-card-text>
                </v-card>
            </div>

            <v-progress-circular v-else
                                 class="mx-auto"
                                 :size="80"
                                 indeterminate
                                 color="primary"
            ></v-progress-circular>
        </v-row>
    </v-container>
</template>

<script>
    export default {
        name: 'User',
        data: () => ({
                loading: true,
                user: [],
                roles: [],
                role: [],
                credentials: {
                    password: '',
                },
            }
        ),
        methods: {
            async fetchUser() {
                this.$http.get(`/api/user/${this.$route.params.id}`).then((response) => {
                    this.user = response.data.data.user;
                    this.role = this.user.role
                    this.loading = false;
                });
            },
            async fetchRoles() {
                this.$http.get(`/api/roles`).then((response) => {
                    this.roles = response.data.data.roles;
                    this.loading = false;
                });
            },
            async changeRole() {
                this.$http.post(`/api/user/${this.user.id}/role/${this.role.id}`).then(() => {
                });
            },
            async changePassword() {
                this.$http.post(`/api/user/${this.user.id}/password`, this.credentials).then(() => {
                });
            },
        },
        created() {
            this.fetchUser();
            this.fetchRoles();
        },
        watch: {
            'role': function () {
                this.changeRole();
            },
        }
    }
</script>

<style>
</style>
