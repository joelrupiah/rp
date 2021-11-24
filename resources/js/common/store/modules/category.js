import Axios from "axios"

export const category = {
    namespaced: true,
    state: {
        categories: [],
    },
    getters: {
        categoryList(state){
            return state.categories
        }
    },
    actions: {
        categoryList(context){
            Axios.get('/api/admin/category')
                .then(res=>{
                    context.commit('categoryList', res.data.categories)
                })
        },
        deleteCategory(context, payload){
            Axios.delete('/api/admin/category/'+payload)
                .then(res=>{
                    context.commit('categoryList', res.data.categories)
                })
        },
        categoryListAll(context){
            Axios.get('/api/admin/all-category')
                .then(res=>{
                    context.commit('categoryList', res.data.categories)
                })
        },

    },
    mutations: {
        categoryList(state, payload){
            return state.categories = payload
        }
    }
}
