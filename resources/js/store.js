import Vue from "vue"
import Vuex from "vuex"
import {getLocalUser} from './helpers/auth';

Vue.use(Vuex);

const user = getLocalUser();

export default new Vuex.Store({
    state: {
        currentUser: user,
        loading: false,
        auth_error: null,
    },
    getters: {
        isLoading(state) {
            return state.loading;
        },
        currentUser(state) {
            return state.currentUser;
        },
        authError(state) {
            return state.auth_error;
        },
        getToken(state) {
            if (state.currentUser) {
                return state.currentUser.token
            }
        }
    },
    mutations: {
        login(state) {
            state.loading = true;
            state.auth_error = null;
        },
        loginSuccess(state, payload) {
            state.auth_error = null;
            state.isLoggedIn = true;
            state.loading = false;
            state.currentUser = Object.assign({}, payload.data.user, {token: payload.data.token});

            localStorage.setItem("user", JSON.stringify(state.currentUser));
            Vue.toasted.show('Zalogowano', {
                type: 'success'
            });
        },
        loginFailed(state, payload) {
            state.loading = false;
            state.auth_error = payload.error;

            Vue.toasted.show('Błąd podczas logowania', {
                type: 'error'
            });
        },
        logout(state) {
            localStorage.removeItem("user");
            state.isLoggedIn = false;
            state.currentUser = null;

            Vue.toasted.show('Wylogowano', {
                type: 'success'
            });
        },
    },
    actions: {
        login(context) {
            context.commit("login");
        },
    }
})