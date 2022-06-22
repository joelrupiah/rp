import Axios from 'axios'

import UserApi from '../../../apis/user/Api'

export const wishlist = {
    namespaced: true,
    state: {
        wishlist: [],
    },
    getters: {
        wishlistCount(state){
            return state.wishlist.length
        },
        wishlistProducts(state){
            return state.wishlist
        }
    },
    actions: {
        saveWishList(context, payload){
            UserApi().post('save-wishlist', payload)
                .then(() => {
                    context.commit('wishlistProducts', payload)
                })
        },
        getWishlistProducts(context){
            UserApi().get('get-wishlist-products')
                .then(response => {
                    context.commit('wishlistProducts', response.data.wishlists)
                })
        }
    },
    mutations: {
        wishlistProducts(state, payload){
            state.wishlist = payload
        }
    }
}