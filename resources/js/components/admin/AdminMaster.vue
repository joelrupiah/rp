<template>
    <div id="admin_master">
        <admin-header v-if="!['AdminLogin', 'AdminRegister'].includes($route.name)"></admin-header>

    <div class="az-content pd-y-20 pd-lg-y-30 pd-xl-y-40">
      <div class="container">
          <admin-sidebar v-if="!['AdminLogin', 'AdminRegister'].includes($route.name)"></admin-sidebar>
            <router-view></router-view>
      </div><!-- container -->
    </div><!-- az-content -->
    <admin-footer v-if="!['AdminLogin', 'AdminRegister'].includes($route.name)"></admin-footer>
    </div>
</template>

<script>
import AdminHeader from './inc/AdminHeader.vue'
import AdminSidebar from './inc/AdminSidebar.vue'
import AdminFooter from './inc/AdminFooter.vue'
export default {
    name: 'AdminMaster',
    components: {
        AdminHeader,
        AdminSidebar,
        AdminFooter
    },
    mounted(){
        this.$store.commit('user/LOGIN', !!localStorage.getItem('token'))
    }
}
</script>
