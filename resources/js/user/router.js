import { Alert } from 'bootstrap'
import { toPairs } from 'lodash'
import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Home from '../components/user/Home'
import Shop from '../components/user/pages/shop/Shop'
import Category from '../components/user/pages/category/Category'
import Product from '../components/user/pages/product/Product'
import Cart from '../components/user/pages/Cart'
import WishList from '../components/user/pages/WishList'
import Checkout from '../components/user/pages/Checkout'

import About from '../components/user/pages/system/About'
import Contact from '../components/user/pages/system/Contact'
import Faq from '../components/user/pages/system/Faq'
import Terms from '../components/user/pages/system/Terms'
import Privacy from '../components/user/pages/system/Privacy'


import ResetPassword from '../components/user/pages/auth/ResetPassword'
import UserLogin from '../components/user/pages/auth/UserLogin'
import UserRegister from '../components/user/pages/auth/UserRegister'
import MyAccount from '../components/user/pages/account/MyAccount'
import UserOrderDetail from '../components/user/pages/order/UserOrderDetail'

const router = new VueRouter({
    mode: 'history',
    linkActiveClass: 'active',
    routes: [
        {path:'/api', component: Home, name: 'Home'},
        {path:'/api/shop', component: Shop, name: 'Shop'},
        {path:'/api/category/:slug', component: Category, name: 'Category'},
        {path:'/api/product/:slug', component: Product, name: 'Product'},
        {path:'/api/cart', component: Cart, name: 'Cart', meta: { requiresAuth: true }},
        {path:'/api/wishlist', component: WishList, name: 'WishList', meta: { requiresAuth: true }},
        {path:'/api/checkout', component: Checkout, name: 'Checkout', meta: { requiresAuth: true }},
        {path:'/api/order-detail/:order_id', component: UserOrderDetail, name: 'UserOrderDetail', meta: { requiresAuth: true }},

        {path:'/api/about', component: About, name: 'About'},
        {path:'/api/contact', component: Contact, name: 'Contact'},
        {path:'/api/faq', component: Faq, name: 'Faq'},
        {path:'/api/terms&conditions', component: Terms, name: 'Terms'},
        {path:'/api/privacy&settings', component: Privacy, name: 'Privacy'},


        {path:'/api/reset-password', component: ResetPassword, name: 'ResetPassword', meta: { requiresVisitor: true }},
        {path:'/api/login', component: UserLogin, name: 'UserLogin', meta: { requiresVisitor: true }},
        {path:'/api/register', component: UserRegister, name: 'UserRegister', meta: { requiresVisitor: true }},
        {path:'/api/account', component: MyAccount, name: 'MyAccount', meta: { requiresAuth: true }},
    ]
})

export default router;
