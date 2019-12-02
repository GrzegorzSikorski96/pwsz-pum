import Vue from 'vue';
import Vuetify from 'vuetify/lib';
import 'vuetify/dist/vuetify.min.css';
import 'material-design-icons-iconfont/dist/material-design-icons.css'
import pl from 'vuetify/src/locale/pl.ts'

Vue.use(Vuetify);

export default new Vuetify({
    icons: {
        iconfont: 'md',
    },
    lang: {
        locales: {pl},
        current: 'pl',
    },
});
