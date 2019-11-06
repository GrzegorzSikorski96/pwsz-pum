import Vue from 'vue';
import './plugins/fontawesome';
import App from './App.vue';
import router from './router';
import vuetify from './plugins/vuetify';
import axios from "axios";
import VueAxios from 'vue-axios';
import Vuex from 'vuex';
import store from './store';
import {initialize} from "./helpers/general";
import Toasted from 'vue-toasted';

Vue.use(Vuex);

Vue.use(Toasted, {
    theme: "bubble",
    position: "top-center",
    duration: 5000
});

Vue.config.productionTip = false;
Vue.use(VueAxios, axios);

// axios.defaults.baseURL = "https://backend.pwsz-pum.sikorski.dev/";
axios.defaults.baseURL = "http://pwsz-pum.test/";

initialize(store, router);

new Vue({
    vuetify,
    router,
    store,
    render: h => h(App)
}).$mount('#app')
