import axios from 'axios';

export function initialize(store, router) {
    router.beforeEach((to, from, next) => {
            const currentUser = store.state.currentUser;

            if (!(to.meta.forVisitors && currentUser)) {
                if (to.matched.some(record => record.meta.roles)) {
                    if (currentUser) {
                        if (!(to.meta.roles.includes(currentUser.role.name))) {
                            return next({path: '/'})
                        }
                    } else {
                        return next({path: '/login'})
                    }
                }
                return next()
            }
            return next({path: '/'})
        }
    );

    axios.interceptors.request.use(function (config) {
        // Do something before request is sent
        let authKey = store.getters.getToken
        config.headers["Authorization"] = `Bearer ${authKey}`;
        return config;
    });


    axios.interceptors.response.use(null, (error => {
        if (error.response.status === 401) {
            {
                store.commit('logout');
                router.push('/login');
            }
        }
    }));

    if (store.getters.currentUser) {
        setAuthorization(store.getters.getToken);
    }
}

export function setAuthorization(token) {
    axios.defaults.headers.common["Authorization"] = `Bearer ${token}`;
}