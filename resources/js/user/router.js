import { Alert } from 'bootstrap'
import { toPairs } from 'lodash'
import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Home from '../components/user/Home'
import Shop from '../components/user/pages/Shop'
import Cart from '../components/user/pages/Cart'
import Checkout from '../components/user/pages/Checkout'

const router = new VueRouter({
    mode: 'history',
    linkActiveClass: 'active',
    routes: [
        {path:'/api', component: Home, name: 'Home'},
        {path:'/api/shop', component: Shop, name: 'Shop'},
        {path:'/api/cart', component: Cart, name: 'Cart'},
        {path:'/api/checkout', component: Checkout, name: 'Checkout'},
    ]
})

export default router;
