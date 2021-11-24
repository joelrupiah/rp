import Axios from 'axios'

export const user = {
    namespaced: true,
    state: {
        auth: {
            login: false,
            user: {},
        }
    },
    getters: {
        AUTH_USER(state){
            return state.auth.user
        }
    },
    actions: {},
    mutations: {
        LOGIN(state, status){
            state.auth.login = status
            state.auth.user = {}
        },
        AUTH_USER(state, user){
            state.auth.user = user
        }
    }
}