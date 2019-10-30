<template>
    <v-container fluid fill-height>
        <v-row>
            <v-card
                    class="col-8 mx-auto"
                    raised
                    shaped
            >
                <v-card-text>
                    <p class="display-1 text--primary">Tworzenie urządzenia</p>
                    <v-form v-model="valid">
                        <v-text-field
                                v-model="credentials.id"
                                label="Identyfikator Looko2 urządzenia"
                                required
                        ></v-text-field>

                        <v-text-field
                                v-model="credentials.token"
                                label="Token urządzenia"
                                required
                        ></v-text-field>
                    </v-form>
                </v-card-text>
                <v-card-actions>
                    <v-btn
                            text
                            class="mx-auto font-weight-bold"
                            @click="createDevice"
                            :disabled="!valid"
                    >
                        Dodaj urządzenie
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-row>
    </v-container>
</template>

<script>
    export default {
        name: 'CreateDevice',
        data: () => ({
            valid: false,
            credentials: {
                id: '',
                token: '',
            },
        }),
        methods: {
            async createDevice() {
                this.$http.post(`/api/fetch/device/${this.credentials.id}/${this.credentials.token}`, this.credentials)
                    .then(() => {
                        this.$toasted.show('Utworzono urządzenie', {
                            type: 'success'
                        });
                    })
            }
        },
    }
</script>

<style>

</style>
