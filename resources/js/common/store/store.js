import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

import { user } from './modules/user'
import { category } from './modules/category'
import { product } from './modules/product'

export const store = new Vuex.Store({
    modules: {
        user : user,
        category : category,
        product : product,
    }
  })
