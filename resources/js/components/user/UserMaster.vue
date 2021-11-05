<template>
    <div class="body-wrapper">
        <user-header></user-header>
        <router-view></router-view>
            <user-footer></user-footer>
            <product-details></product-details>
        </div>
</template>

<script>
import UserHeader from './inc/UserHeader.vue'
import UserFooter from './inc/UserFooter.vue'
import ProductDetails from './inc/ProductDetails.vue'
export default {
    name: 'UserMaster',
    components: {
        UserHeader,
        UserFooter,
        ProductDetails
    }
}
</script>
