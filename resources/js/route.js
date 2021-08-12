import Vue from 'vue';

import VueRouter from 'vue-router';
Vue.use(VueRouter);

import Dashboard from './pages/dashboard/Index.vue';
import Blog from './pages/blog/Index.vue';
import BlogCreate from './pages/blog/Create.vue';
import BlogEdit from './pages/blog/Edit.vue';
import Login from './pages/auth/Login.vue';
import Register from './pages/auth/Register.vue';
import Pengguna from './pages/pengguna/Index.vue';
import Profile from './pages/pengguna/Profile.vue';
import ChangePass from './pages/pengguna/ChangePass.vue';
import Konfigurasi from './pages/konfigurasi/Index.vue';
import NotFound from './pages/not-found/Index.vue';

import NProgress from 'nprogress'

const routes = [
    {
        name: 'Login',
        path: '/auth/login',
        component: Login,
        meta: { guest: true ,title:'Login'},
    },
    {
        name: 'Register',
        path: '/auth/register',
        component: Register,
        meta: { guest: true ,title:'Register'},
    },
    {
        name: 'Dashboard',
        path: '/panel/dashboard',
        component: Dashboard,
        meta: { requiresAuth: true , title:'Dashboard'},
        // mounted(){
        //     document.title = "Dashboard"
        // }
    },
    {
        name: 'Blog',
        path: '/panel/blog',
        component: Blog,
        meta: { requiresAuth: true , title:'Blog' }
    },
    {
        name: 'BlogCreate',
        path: '/panel/blog/create',
        component: BlogCreate,
        meta: { requiresAuth: true , title:'Create Blog' }
    },
    {
        name: 'BlogEdit',
        path: '/panel/blog/edit/:id',
        component: BlogEdit,
        meta: { requiresAuth: true , title:'Edit Blog' },
        props: true,
    },
    {
        name: 'Pengguna',
        path: '/panel/pengguna',
        component: Pengguna,
        meta: { requiresAuth: true , title:'Pengguna' }
    },
    {
        name: 'Profile',
        path: '/panel/profile',
        component: Profile,
        meta: { requiresAuth: true , title:'Profile' }
    },
    {
        name: 'ChangePass',
        path: '/panel/change-pass',
        component: ChangePass,
        meta: { requiresAuth: true , title:'Change Password' }
    },
    {
        name: 'Konfigurasi',
        path: '/panel/konfigurasi',
        component: Konfigurasi,
        meta: { requiresAuth: true , title:'Setting' }
    },
    {
        path: '*',
        component: NotFound,
        // meta: { guest: true , title:'Not Found' }
    },
]

const router = new VueRouter({
    linkActiveClass: 'active',
    mode: 'history',
    routes
})

router.beforeEach((to, from, next) => {
    NProgress.start()
    NProgress.set(0.5)
    document.title = 'Blog Vue | ' + to.meta.title
    const token = localStorage.getItem('jwt') == null;  
    if (to.matched.some(record => record.meta.guest)) {
        if (!token) window.location.href= '/panel/dashboard';
        else next()
    } 
    if (to.matched.some(record => record.meta.requiresAuth)) { 
        if (token) {
        // next({
        //     path: '/auth/login',
        //     query: { redirect: to.fullPath }
        // })
            window.location.href= '/auth/login';
        } else {
        next()
        } 
    }else{
        next()  
        }
  })
router.afterEach(() => {
setTimeout(() => NProgress.done(), 20)
})

export default router;