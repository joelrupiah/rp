import Axios from "axios"
import Api from '../../../apis/admin/Api'
import UserApi from '../../../apis/user/Api'

export const product = {
    namespaced: true,
    state: {
        products: [],
        product: {}
    },
    getters: {
        productList(state) {
            return state.products
        },
        singleProduct(state) {
            return state.product
        },
        singleUserProduct(state) {
            return state.product
        },
        categoryProductList(state){
            return state.products
        }
    },
    actions: {
        categoryProductList(context, payload){
            Axios.get(`/api/category-product/${payload}`)
                .then(response => {
                    context.commit('categoryProductList', response.data.products)
                })
        },
        showSingleProduct(context, payload) {
            Axios.get(`/api/single-product/${payload}`)
                .then(response => {
                    context.commit('singleUserProduct', response.data.product)
                })
        },
        showProduct(context, payload) {
            Api().get(`/admin/product/${payload}`)
                .then(response => {
                    context.commit('singleProduct', response.data.product)
                })
        },
        productList(context) {
            Api().get('/admin/product')
                .then(res => {
                    context.commit('productList', res.data.products)
                })
        },
        userProductList(context) {
            Axios.get('/api/products')
                .then(res => {
                    context.commit('productList', res.data.products)
                })
        },
        deleteProduct(context, payload) {
            Api().delete('/admin/product/' + payload)
                .then(res => {
                    context.commit('productList', res.data.products)
                })
        },
        editProduct(context, payload) {
            Api().get(`/admin/product/${payload}/edit`)
                .then(res => {
                    console.log(res)
                    context.commit('singleProduct', res.data.product)
                })
        },

    },
    mutations: {
        productList(state, payload) {
            return state.products = payload
        },
        singleProduct(state, payload) {
            return state.product = payload
        },
        singleUserProduct(state, payload) {
            return state.product = payload
        },
        categoryProductList(state, payload){
            return state.products = payload
        }
    }
}
