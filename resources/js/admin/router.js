import { Alert } from 'bootstrap'
import { toPairs } from 'lodash'
import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import AdminDashboard from '../components/admin/AdminDashboard'
import AdminCategory from '../components/admin/pages/AdminCategory'
import AdminProduct from '../components/admin/pages/AdminProduct'

const router = new VueRouter({
    mode: 'history',
    linkActiveClass: 'active',
    routes: [
        {path:'/api/admin', component: AdminDashboard, name: 'AdminDashboard'},
        {path:'/api/admin/categories', component: AdminCategory, name: 'AdminCategory'},
        {path:'/api/admin/products', component: AdminProduct, name: 'AdminProduct'},
    ]
})

export default router;
