import Vue from 'vue';
import VueRouter from 'vue-router';

import Users from './components/Users/UserIndex';
import EditUser from './components/Users/UserEdit';

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    linkExactActiveClass: 'active',
    routes: [
        {
            path: '/users',
            name: 'IndexUser',
            component: Users
        },
        {
            path: '/users/edit',
            name: 'EditUser',
            component: EditUser
        },
    ]
});

export default router;
