require('./bootstrap');

import Vue from 'vue'

import router from './admin/router'

Vue.component('admin-master', require('./components/admin/AdminMaster.vue').default);

import {store} from './common/store/store'

import library from './common/library'

import VueOwlCarousel from 'vue-owl-carousel'

import Notifications from 'vue-notification'

//Start VueJS component frameworks

import CKEditor from '@ckeditor/ckeditor5-vue2'
import ElementUI from 'element-ui'
import ViewUI from 'view-design'
import Vuesax from 'vuesax'
import 'boxicons'
import 'boxicons/css/boxicons.min.css'

import 'element-ui/lib/theme-chalk/index.css'
import 'vuesax/dist/vuesax.css'
import 'view-design/dist/styles/iview.css'

Vue.use( CKEditor )
Vue.use(ViewUI)
Vue.use(ElementUI)
Vue.use(Vuesax)
Vue.use(Notifications)

// End VueJs frontend frameworks

Vue.use(VueOwlCarousel)

const admin = new Vue({
    el: '#admin',
    router,
    store,
});
