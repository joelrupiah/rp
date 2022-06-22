<template>
    <div id="user_master">
        <div class="page-wrapper">
         <user-header v-if="!['UserLogin', 'UserRegister', 'ResetPassword'].includes($route.name)"></user-header>

        <main class="main">
            <router-view></router-view>
        </main>

        <user-footer v-if="!['UserLogin', 'UserRegister', 'ResetPassword'].includes($route.name)"></user-footer>
<!-- End .footer -->
    </div><!-- End .page-wrapper -->
    <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

    <!-- Mobile Menu -->
    <div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

    <mobile-menu></mobile-menu>
    
    </div>
</template>

<script>
import UserHeader from './inc/UserHeader.vue'
import UserFooter from './inc/UserFooter.vue'
import MobileMenu from './inc/MobileMenu.vue'
export default {
    name: 'UserMaster',
    components: {
        UserHeader,
        UserFooter,
        MobileMenu
    }
}
</script>
