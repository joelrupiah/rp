require('./bootstrap');

import Vue from 'vue'

Vue.component('user-master', require('./components/user/UserMaster.vue').default);

import router from './user/router'

import {store} from './common/store/store'

import library from './common/library'

import VueOwlCarousel from 'vue-owl-carousel'

import ElementUI from 'element-ui'
import ViewUI from 'view-design'

Vue.use(ViewUI)
Vue.use(ElementUI)

Vue.use(VueOwlCarousel)

const user = new Vue({
    el: '#user',
    router,
    store,
});
