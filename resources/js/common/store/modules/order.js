import Axios from 'axios'
import UserApi from '../../../apis/user/Api'
import Api from '../../../apis/admin/Api'

export const order = {
    namespaced: true,
    state: {
        orders: [],
        order: {}
    },
    getters: {
        getOrders(state){
            return state.orders
        },
        getAllOrders(state){
            return state.orders
        },
        getSpecificUserOrder(state){
            return state.order
        }
    },
    actions: {
        getAuthUserOrders(context){
            UserApi().get('user-order')
                .then(response => {
                    context.commit('getOrders', response.data.orders)
                })
        },
        getAllUserOrders(context){
            Api().get('/admin/all-user-order')
                .then(response => {
                    context.commit('getAllOrders', response.data.orders)
                })
        },
        getSpecificUserOrder(context, payload){
            Api().get(`/admin/get-specific-user-order/${payload}`)
                .then(response => {
                    context.commit('getSpecificUserOrder', response.data.order)
                })
        }
    },
    mutations: {
        getOrders(state, payload){
            return state.orders = payload
        },
        getAllOrders(state, payload){
            return state.orders = payload
        },
        getSpecificUserOrder(state, payload){
            return state.order = payload
        }
    }
}