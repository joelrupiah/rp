<template>
    <div id="admin_master">
        <admin-header></admin-header>

    <div class="az-content pd-y-20 pd-lg-y-30 pd-xl-y-40">
      <div class="container">
          <admin-sidebar></admin-sidebar>
            <router-view></router-view>
      </div><!-- container -->
    </div><!-- az-content -->
    <admin-footer></admin-footer>
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
    }
}
</script>
