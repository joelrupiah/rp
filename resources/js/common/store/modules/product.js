import Axios from "axios"

export const product = {
    namespaced: true,
    state: {
        products: [],
        product: {}
    },
    getters: {
        productList(state){
            return state.products
        },
        singleProduct(state){
            return state.product
        },
    },
    actions: {
        productList(context){
            Axios.get('/api/admin/product')
                .then(res=>{
                    context.commit('productList', res.data.products)
                })
        },
        deleteProduct(context, payload){
            Axios.delete('/api/admin/product/'+payload)
                .then(res=>{
                    context.commit('productList', res.data.products)
                })
        },
        editProduct(context, payload){
            Axios.get(`/api/admin/product/${payload}/edit`)
                .then(res=>{
                    console.log(res)
                    context.commit('singleProduct', res.data.product)
                })
        },

    },
    mutations: {
        productList(state, payload){
            return state.products = payload
        },
        singleProduct(state, payload){
            return state.product = payload
        },
    }
}
