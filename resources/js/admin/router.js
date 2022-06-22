import { Alert } from 'bootstrap'
import { toPairs } from 'lodash'
import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import AdminDashboard from '../components/admin/AdminDashboard'

import RoleList from '../components/admin/pages/role/RoleList'
import CreateRole from '../components/admin/pages/role/CreateRole'
import EditRole from '../components/admin/pages/role/EditRole'

import PermissionList from '../components/admin/pages/permission/PermissionList'
import CreatePermission from '../components/admin/pages/permission/CreatePermission'
import EditPermission from '../components/admin/pages/permission/EditPermission'

import AdminList from '../components/admin/pages/admins/AdminList'

import UserList from '../components/admin/pages/users/UserList'
import CreateUser from '../components/admin/pages/users/CreateUser'
import EditUser from '../components/admin/pages/users/EditUser'

import AdminCategory from '../components/admin/pages/category/AdminCategory'

// Product Routes
import ProductList from '../components/admin/pages/product/ProductList'
import CreateProduct from '../components/admin/pages/product/CreateProduct'
import UpdateProduct from '../components/admin/pages/product/UpdateProduct'

// Order Routes
import OrderList from '../components/admin/pages/order/OrderList'
import ManageOrders from '../components/admin/pages/order/ManageOrders'
import OrderDetails from '../components/admin/pages/order/OrderDetails'

import AdminLogin from '../components/admin/pages/auth/AdminLogin'
import AdminRegister from '../components/admin/pages/auth/AdminRegister'

const router = new VueRouter({
    mode: 'history',
    linkActiveClass: 'active',
    routes: [
        { path: '/api/admin', component: AdminDashboard, name: 'AdminDashboard', meta: { requiresAuth: true } },

        { path: '/api/admin/roles', component: RoleList, name: 'RoleList', meta: { requiresAuth: true } },
        { path: '/api/admin/add-role', component: CreateRole, name: 'CreateRole', meta: { requiresAuth: true } },
        { path: '/api/admin/edit-role', component: EditRole, name: 'EditRole', meta: { requiresAuth: true } },
        
        { path: '/api/admin/permissions', component: PermissionList, name: 'PermissionList', meta: { requiresAuth: true } },
        { path: '/api/admin/add-permission', component: CreatePermission, name: 'CreatePermission', meta: { requiresAuth: true } },
        { path: '/api/admin/edit-permission', component: EditPermission, name: 'EditPermission', meta: { requiresAuth: true } },
        
        { path: '/api/admin/admins', component: AdminList, name: 'AdminList', meta: { requiresAuth: true } },

        { path: '/api/admin/users', component: UserList, name: 'UserList', meta: { requiresAuth: true } },
        { path: '/api/admin/create-user', component: CreateUser, name: 'CreateUser', meta: { requiresAuth: true } },
        { path: '/api/admin/edit-user', component: EditUser, name: 'EditUser', meta: { requiresAuth: true } },
        
        { path: '/api/admin/categories', component: AdminCategory, name: 'AdminCategory', meta: { requiresAuth: true } },

        { path: '/api/admin/products', component: ProductList, name: 'ProductList', meta: { requiresAuth: true } },
        { path: '/api/admin/products/add-product', component: CreateProduct, name: 'CreateProduct', meta: { requiresAuth: true } },
        { path: '/api/admin/products/edit-product/:id', component: UpdateProduct, name: 'UpdateProduct', meta: { requiresAuth: true } },
        

        { path: '/api/admin/orders', component: OrderList, name: 'OrderList', meta: { requiresAuth: true } },
        { path: '/api/admin/orders/manage-order/:order_id', component: ManageOrders, name: 'ManageOrders', meta: { requiresAuth: true } },
        { path: '/api/admin/orders/order-details/:order_id', component: OrderDetails, name: 'OrderDetails', meta: { requiresAuth: true } },
        
        { path: '/api/admin/admin-login', component: AdminLogin, name: 'AdminLogin', meta: { requiresVisitor: true } },
        { path: '/api/admin/admin-register', component: AdminRegister, name: 'AdminRegister', meta: { requiresVisitor: true } },

    ]
})

export default router;
