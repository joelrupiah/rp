import Axios from "axios"
// import Api from '../../../apis/admin/Api'
import UserApi from '../../../apis/user/Api'

export const cart = {
    namespaced: true,
    state: {
        cart: [],
        // cartCount: 0
    },
    getters: {
        cartCountItem(state){
            return state.cart.length
        },
        getCartItem(state){
            return state.cart
        },
        cartTotalPrice(state){
            let total = 0

            state.cart.forEach(item => {
                total += item.product.price * item.quantity
            })

            return total
        },
    },
    actions: {
        addToCart(context, {product, quantity}){
            UserApi().post('/cart/add-to-cart', {product, quantity})
                .then(() => {
                    context.commit('cartItem', {product, quantity})
                })
        },
        getStoredCartItems(context){
            UserApi().get('/cart/cart-items')
                .then(response => {
                    context.commit('getProductsInCart', response.data.carts)
                })
        },
        removeProductInCart(context, product){
            context.commit('deleteProductInCart', product)
            UserApi().delete(`/cart/delete-cart-item/${product.id}`)
        },
        deleteAllCartItems(context){
            UserApi().delete('/cart/delete-all-cart-items')
                .then(() => {
                    context.commit('clearAllCartItems')
                })
        }
    },
    mutations: {
        clearAllCartItems(state){
            state.cart = []
        },
        deleteProductInCart(state, product){
            state.cart = state.cart.filter(item => {
                return item.product !== product
            })
        },
        getProductsInCart(state, payload){
            state.cart = payload
        },
        cartItem(state, {product, quantity}){
            
            let productInCart = state.cart.find(item =>{
                return item.product.id === product.id
            })
            
            if (productInCart) {
                productInCart.quantity++
                return
            }

            state.cart.push({product, quantity})
            // let cartItems = state.cart
            // cartItems.push({product,quantity})
            // state.cartItems = cart
        }
    }
}
