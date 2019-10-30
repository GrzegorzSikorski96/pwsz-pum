<template>
    <v-container fluid fill-height>
        <v-row>
            <v-card
                    class='col-8 mx-auto'
                    raised
                    shaped
            >
                <v-card-text>
                    <p class='display-1 text--primary'>Zaloguj</p>

                    <v-form v-model='valid' @keyup.native.enter='authenticate()'>
                        <v-text-field
                                v-model='credentials.email'
                                :rules='rules.credentials.email'
                                type='email'
                                label='Email'
                                required
                        ></v-text-field>
                        <v-text-field
                                v-model='credentials.password'
                                :rules='[rules.credentials.password.required, rules.credentials.password.min, ]'
                                type='password'
                                label='Hasło'
                                required
                        ></v-text-field>
                    </v-form>

                </v-card-text>
                <v-card-actions>
                    <v-btn
                            text
                            class='mx-auto font-weight-bold'
                            @click='authenticate'
                            :disabled='!valid'
                    >
                        Zaloguj
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-row>
    </v-container>
</template>

<script>
    import {login} from '../helpers/auth';

    export default {
        name: 'Login',
        methods: {
            authenticate() {
                this.$store.dispatch('login');

                login(this.$data.credentials)
                    .then((res) => {
                        this.$store.commit('loginSuccess', res);
                        this.$router.push({path: '/'});
                    })
                    .catch((error) => {
                        this.$store.commit('loginFailed', {error});
                    });
            },
        },
        data: () => ({
            valid: false,
            credentials: {
                email: '',
                password: '',
            },
            rules: {
                credentials: {
                    email: [
                        v => !!v || 'Adres email jest wymagany.',
                        v => /.+@.+/.test(v) || 'Wprowawdź prawidłowy adres E-mail',
                    ],
                    password: {
                        required: v => !!v || 'Hasło jest wymagane.',
                        min: v => v.length >= 6 || 'Minimum 6 znaków.'
                    }
                }
            }
        }),
    }
</script>

<style>

</style>
