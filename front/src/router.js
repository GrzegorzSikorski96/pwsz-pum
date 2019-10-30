import Vue from "vue"
import Router from "vue-router"
import HelloWorld from "./components/HelloWorld";
import Login from "./components/Login";
import List from "./components/Device/List";
import Device from "./components/Device/Device";
import Create from "./components/Device/Create";
import UsersList from "./components/User/UsersList";
import User from "./components/User/User";

Vue.use(Router);

export default new Router({
    mode: "history",

    routes: [
        {
            path: '/',
            name: 'HomePage',
            component: HelloWorld,
        },
        {
            path: '/login',
            name: 'Login',
            component: Login,
        },
        {
            path: '/devices',
            name: 'Devices',
            component: List,
            meta: {
                roles: ['administrator', 'user']
            }
        },
        {
            path: '/device/:id',
            name: 'Device',
            component: Device,
            props: true,
            meta: {
                roles: ['administrator', 'user']
            }
        },
        {
            path: '/device/create',
            name: 'Create',
            component: Create,
            meta: {
                roles: ['administrator']
            }
        },
        {
            path: '/users',
            name: 'Users',
            component: UsersList,
            meta: {
                roles: ['administrator']
            }
        },
        {
            path: '/user/:id',
            name: 'User',
            component: User,
            props: true,
            meta: {
                roles: ['administrator', 'user']
            }
        },
    ]
})