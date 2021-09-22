import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import Login from '../views/Auth/Login.vue'
import store from './../store';
Vue.use(VueRouter)

const routes = [{
        path: '/login',
        name: 'Login',
        component: Login,
        meta: {
            template: 'blank',
            requiresVisitor: false
        },
    },
    {
        path: '/',
        name: 'Home',
        component: Home,
        meta: {

            requiresAuth: true
        }
    },
    {
        path: '/about',
        name: 'About',
        // route level code-splitting
        // this generates a separate chunk (about.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () => import( /* webpackChunkName: "about" */ '../views/About.vue'),
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/users',
        name: 'Users',
        // route level code-splitting
        // this generates a separate chunk (about.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () => import( /* webpackChunkName: "about" */ '../views/User.vue'),
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/risks',
        name: 'Risks',
        // route level code-splitting
        // this generates a separate chunk (about.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () => import( /* webpackChunkName: "about" */ '../views/Risks.vue'),
        meta: {
            requiresAuth: true
        }
    },

]

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes
})

router.beforeEach(async (to, from, next) => {

    if (to.matched.some(record => record.meta.requiresAuth) && !store.state.session.session) {
        return next({
            name: 'Login'
        })
    }

    if (to.matched.some(record => !record.meta.requiresAuth) && store.state.session.session) {
        return next({
            name: 'Home'
        })
    }

    next()
})


export default router
