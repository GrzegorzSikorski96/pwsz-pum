<template>

    <v-container fluid fill-height>
        <v-card
                class="mx-auto mt-3"
                color="#F9F9F9"
                max-width="400"
                v-for="device in devices" :key="device.id"
        >
            <v-list-item two-line>
                <v-list-item-content>
                    <v-list-item-title class="headline">PWSZ im. Witelona w Legnicy</v-list-item-title>
                    <v-list-item-subtitle>Ostatni pomiar: {{device.measurements[0].created_at}}</v-list-item-subtitle>
                </v-list-item-content>
            </v-list-item>

            <v-card-text>
                <v-row dense class="title">
                    <span class="font-weight-bold text--primary mr-1">Temperatura: </span>
                    {{device.measurements[0].Temperature}}&deg;C
                </v-row>

                <v-row dense class="title">
                    <span class="font-weight-bold text--primary mr-1">PM1:  </span>
                    <span :class="getColor(device.measurements[0].PM10, 'PM1')">{{device.measurements[0].PM1}}ug/m3</span>
                </v-row>

                <v-row dense class="title">
                    <span class="font-weight-bold text--primary mr-1">PM2.5:  </span>
                    <span :class="getColor(device.measurements[0].PM10, 'PM25')">{{device.measurements[0].PM25}}ug/m3</span>
                </v-row>

                <v-row dense class="title">
                    <span class="font-weight-bold text--primary mr-1">PM10:  </span>
                    <span :class="getColor(device.measurements[0].PM10, 'PM10')">{{device.measurements[0].PM10}}ug/m3</span>
                </v-row>

                <v-row dense class="title">
                    <span class="font-weight-bold text--primary mr-1">Wilgotność:  </span>
                    {{device.measurements[0].Humidity}}%
                </v-row>
            </v-card-text>

            <v-divider></v-divider>

            <v-card-actions>
                <v-card
                        class="mx-auto mt-3"
                        color="#F9F9F9"
                        max-width="400"
                >
                    <img src="../assets/skala-zapylenia.png"/>
                </v-card>
            </v-card-actions>
        </v-card>

    </v-container>
</template>

<script>
    export default {
        data: () => ({
            devices: [],
            colors: [
                {PM1: 1, PM25: 12, PM10: 20, color: 'blue--text text--accent-3'},
                {PM1: 3, PM25: 36, PM10: 60, color: 'light-green--text text--darken-1'},
                {PM1: 5, PM25: 60, PM10: 100, color: 'lime--text text--lighten-2'},
                {PM1: 7, PM25: 84, PM10: 140, color: 'amber--text text--darken-2'},
                {PM1: 10, PM25: 120, PM10: 200, color: 'red--text text--lighten-1'},
                {PM1: 9999, PM25: 9999, PM10: 9999, color: 'red--text'},
            ]
        }),
        methods: {
            async fetch() {
                this.$http.get(`/api/last`).then((response) => {
                    this.devices = response.data.data.devices;
                    this.loading = false;
                });
            },
            getColor(value, param) {
                switch (param) {
                    case 'PM1': {
                        for (let color of this.colors) {
                            if (value < color.PM1) {
                                return color.color;
                            }
                        }
                        break;
                    }
                    case 'PM25': {
                        for (let color of this.colors) {
                            if (value < color.PM25) {
                                return color.color;
                            }
                        }
                        break;
                    }
                    case 'PM10': {
                        for (let color of this.colors) {
                            if (value < color.PM10) {
                                return color.color;
                            }
                        }
                        break;
                    }
                }
            }
        },
        created() {
            this.fetch();
        },

    }
</script>

<style>
</style>
