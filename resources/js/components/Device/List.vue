<template>
    <v-container fluid fill-height>
        <v-card
                raised
                shaped
                class="mx-auto col-8"
        >
            <v-card-title>
                Urządzenia
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
                    :items="devices"
                    :search="search"
                    :loading="loading"
            >
                <template v-slot:item.actions="{ item }">
                    <v-btn text icon color="info" :to="{name: 'Device', params: { id: item.id }}"
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
        name: 'DevicesList',
        loading: true,
        data: () => ({
            search: '',
            loading: true,
            devices: [],
            headers: [
                {text: 'Numer seryjny', value: 'Device', sortable: false, align: 'left'},
                {text: 'Nazwa', value: 'Name'},
                {text: 'Lat', value: 'Lat'},
                {text: 'Lon', value: 'Lon'},
                {text: 'Token', value: 'token'},
                {value: 'actions', sortable: false, align: 'right'},
            ],
        }),
        methods: {
            async fetchDevices() {
                this.$http.get(`/api/devices`).then((response) => {
                    this.devices = response.data.data.devices;
                    this.loading = false;
                });
            },
        },
        created() {
            this.fetchDevices();
        },
    }
</script>

<style>
</style>
