import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

import { category } from './modules/category'
import { product } from './modules/product'

export const store = new Vuex.Store({
    modules: {
        category : category,
        product : product,
    }
  })
