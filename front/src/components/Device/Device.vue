<template>
    <v-container fluid fill-height>
        <v-row>
            <div v-if="!loading" class="col-12">
                <v-card>
                    <v-card-title>
                        Urządzenie: {{ device.Name }}
                        <v-spacer>
                        </v-spacer>
                        <v-btn text icon color="error" @click="removeDevice()"
                               elevation="2">
                            <v-icon>delete</v-icon>
                        </v-btn>
                    </v-card-title>

                    <v-card-text>
                        <v-row dense>
                            <span class="font-weight-bold text--primary mr-1">Numer urządzenia: </span>
                            {{ device.Device }}
                        </v-row>

                        <v-row dense>
                            <span class="font-weight-bold text--primary mr-1">Nazwa: </span>
                            {{ device.Name }}
                        </v-row>

                        <v-row dense>
                            <span class="font-weight-bold text--primary mr-1">Lat: </span>
                            {{ device.Lat }}
                        </v-row>

                        <v-row dense>
                            <span class="font-weight-bold text--primary mr-1">Lon: </span>
                            {{ device.Lon }}
                        </v-row>

                        <v-row dense>
                            <span class="font-weight-bold text--primary mr-1">Token: </span>
                            {{ device.token }}
                        </v-row>
                    </v-card-text>
                </v-card>

                <v-card class="mt-4">
                    <v-card-title>
                        Zakres danych
                        <v-spacer></v-spacer>
                        <v-btn text @click="credentials.start_date = null">
                            Wszystkie pomiary
                        </v-btn>
                    </v-card-title>
                    <v-card-text>
                        <v-menu
                                v-model="menu"
                                :close-on-content-click="false"
                                :nudge-right="40"
                                transition="scale-transition"
                                offset-y
                                min-width="290px"
                        >
                            <template v-slot:activator="{ on }">
                                <v-text-field
                                        v-model="credentials.start_date"
                                        label="Pobierz dane od:"
                                        prepend-icon="event"
                                        readonly
                                        v-on="on"
                                ></v-text-field>
                            </template>
                            <v-date-picker v-model="credentials.start_date" @input="menu2 = false"
                                           :max="new Date().toISOString().substr(0, 10)"></v-date-picker>
                        </v-menu>


                    </v-card-text>
                </v-card>

                <v-card class="mt-4">
                    <v-card-title>
                        PM1
                    </v-card-title>

                    <v-card-text>
                        <div>
                            <apexchart type=area height=350 :options="chartOptions" :series="getPM1"/>
                        </div>
                    </v-card-text>
                </v-card>

                <v-card class="mt-4">
                    <v-card-title>
                        PM2.5
                    </v-card-title>

                    <v-card-text>
                        <div>
                            <apexchart type=area height=350 :options="chartOptions" :series="getPM25"/>
                        </div>
                    </v-card-text>
                </v-card>

                <v-card class="mt-4">
                    <v-card-title>
                        PM10
                    </v-card-title>

                    <v-card-text>
                        <div>
                            <apexchart type=area height=350 :options="chartOptions" :series="getPM10"/>
                        </div>
                    </v-card-text>
                </v-card>

                <v-card class="mt-4">
                    <v-card-title>
                        Temperatura
                    </v-card-title>

                    <v-card-text>
                        <div>
                            <apexchart type=area height=350 :options="chartOptions" :series="getTemperature"/>
                        </div>
                    </v-card-text>
                </v-card>

                <v-card class="mt-4">
                    <v-card-title>
                        Wilgotność
                    </v-card-title>

                    <v-card-text>
                        <div>
                            <apexchart type=area height=350 :options="chartOptions" :series="getHumidity"/>
                        </div>
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
    import VueApexCharts from 'vue-apexcharts';

    export default {
        name: 'Device',
        components: {
            apexchart: VueApexCharts,
        },
        data: () => ({
                loading: true,
                device: [],
                PM1: [],
                PM10: [],
                PM25: [],
                Temperature: [],
                Humidity: [],
                menu: false,
                credentials: {
                    start_date: new Date().toISOString().substr(0, 10),
                },
                chartOptions: {
                    chart: {
                        zoom: {
                            enabled: true,
                            autoScaleYaxis: true
                        },
                        toolbar: {
                            autoSelected: 'zoom'
                        },
                        defaultLocale: 'pl',
                        locales: [{
                            name: 'pl',
                            options: {
                                months: ['Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec', 'Lipiec', 'Spierpień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień'],
                                shortMonths: ['Sty', 'Lut', 'Mar', 'Kwi', 'Maj', 'Cze', 'Lip', 'Sie', 'Wrz', 'Paź', 'Lis', 'Gru'],
                                days: ['Niedziela', 'Poniedziałek', 'Wtorek', 'Środa', 'Czwartek', 'Piątek', 'Sobota'],
                                shortDays: ['Nie', 'Pon', 'Wto', 'Śro', 'Czw', 'Pią', 'Sob'],
                                toolbar: {
                                    download: 'Pobierz SVG',
                                    selection: 'Zaznaczenie',
                                    selectionZoom: 'Przybliżenie zaznaczenia',
                                    zoomIn: 'Przybliżenie',
                                    zoomOut: 'Oddalenie',
                                    pan: 'Przesuwanie',
                                    reset: 'Resetuj przybliżenie',
                                }
                            }
                        }]
                    },
                    xaxis: {
                        type: 'datetime',
                    },

                }
            }
        ),
        methods: {
            async fetchDevice() {
                this.$http.get(`/api/device/${this.$route.params.id}`).then((response) => {
                    this.device = response.data.data.device;
                    this.loading = false;
                    this.fetchMeasurements();
                });
            },
            fetchMeasurements() {
                this.$http.post(`/api/measurements/${this.$route.params.id}`, this.credentials)
                    .then((response) => {
                        this.PM1 = [];
                        this.PM10 = [];
                        this.PM25 = [];
                        this.Temperature = [];
                        this.Humidity = [];

                        response.data.data.measurements.forEach((value) => {
                            this.PM1.push([value.created_at, value.PM1]);
                            this.PM10.push([value.created_at, value.PM10]);
                            this.PM25.push([value.created_at, value.PM25]);
                            this.Temperature.push([value.created_at, value.Temperature]);
                            this.Humidity.push([value.created_at, value.Humidity]);
                        })
                    })
            },
            async removeDevice() {
                this.$http.delete(`/api/device/${this.device.id}`);
                this.$router.push('/devices')
            },
        },
        created() {
            this.fetchDevice();
        },
        computed: {
            getPM1() {
                return [{name: 'PM1', data: this.PM1}]
            },
            getPM25() {
                return [{name: 'PM25', data: this.PM25}]
            },
            getPM10() {
                return [{name: 'PM10', data: this.PM10}]
            },
            getTemperature() {
                return [{name: 'Temperatura', data: this.Temperature}]
            },
            getHumidity() {
                return [{name: 'Humidity', data: this.Humidity}]
            },
        },
        watch: {
            'credentials.start_date': function () {
                this.fetchMeasurements();
            },
        }
    }
</script>

<style>
    .route {
        text-decoration: none;
    }
</style>
