import { Alert } from 'bootstrap'
import { toPairs } from 'lodash'
import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import AdminDashboard from '../components/admin/AdminDashboard'
import AdminCategory from '../components/admin/pages/AdminCategory'
import ProductList from '../components/admin/pages/ProductList'
import AdminProductAddEdit from '../components/admin/pages/AdminProductAddEdit'
import AdminLogin from '../components/admin/pages/AdminLogin'
import AdminRegister from '../components/admin/pages/AdminRegister'

const router = new VueRouter({
    mode: 'history',
    linkActiveClass: 'active',
    routes: [
        {path:'/api/admin', component: AdminDashboard, name: 'AdminDashboard'},
        {path:'/api/admin/categories', component: AdminCategory, name: 'AdminCategory'},
        {path:'/api/admin/products', component: ProductList, name: 'ProductList'},
        {path:'/api/admin/products/add-product', component: AdminProductAddEdit, name: 'AdminProductAddEdit'},
        {path:'/api/admin/products/edit-product/:productId', component: AdminProductAddEdit, name: 'editProduct'},
        {path:'/api/admin/admin-login', component: AdminLogin, name: 'AdminLogin'},
        {path:'/api/admin/admin-register', component: AdminRegister, name: 'AdminRegister'},
        
    ]
})

export default router;
