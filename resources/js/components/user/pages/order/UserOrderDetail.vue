<template>
    <div id="order_detail">
        <h1>Order Detail:   {{ this.$route.params.order_id }}</h1>
        <div class="container">
            <div class="mb-5">
                <p class="mb-5"></p>
            </div>
        </div>
    </div>
</template>

<script>
import Api from '../../../../apis/user/Api'
export default {
    name: 'UserOrderDetail',
    data(){
        return {
            order: {}
        }
    },
    methods: {
        getUserOrder(){
            Api().get('/get-user-order-detail'+this.$route.params.order_id)
                .then(response => {
                    this.order = response.data.order
                })
                .catch(() => {})
        }
    },
    created: {},
    computed(){
        this.getUserOrder()
    },
}
</script>