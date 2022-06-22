import Axios from "axios"
import Api from '../../../apis/admin/Api'

export const category = {
    namespaced: true,
    state: {
        categories: [],
    },
    getters: {
        categoryList(state){
            return state.categories
        },
        categoryListAll(state){
            return state.categories
        },
        userCategoryAll(state){
            return state.categories
        }
    },
    actions: {
        userCategoryList(context){
            Axios.get('/api/user-all-categories')
                .then(response => {
                    context.commit('categoryListAll', response.data.categories)
                })
        },
        activecategoryListAll(context){
            Axios.get('/api/active-all-categories')
                .then(res => {
                    context.commit('categoryListAll', res.data.categories)
                })
        },
        activeCategories(context){
            Api().get('/admin/active-categories')
                .then(res=>{
                    context.commit('categoryList', res.data.categories)
                })
        },
        categoryList(context){
            Api().get('/admin/category')
                .then(res=>{
                    context.commit('categoryList', res.data.categories)
                })
        },
        deleteCategory(context, payload){
            Api().delete(`/admin/category/${payload}`)
                .then(res=>{
                    context.commit('categoryList', res.data.categories)
                })
        },
        categoryListAll(context){
            Api().get('/admin/all-category')
                .then(res=>{
                    context.commit('categoryList', res.data.categories)
                })
        },

    },
    mutations: {
        categoryList(state, payload){
            return state.categories = payload
        },
        categoryListAll(state, payload){
            return state.categories = payload
        }
    }
}
