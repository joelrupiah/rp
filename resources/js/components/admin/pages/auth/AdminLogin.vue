<template>
  <div class="az-content-body pd-lg-l-40 d-flex flex-column">
    <notifications group="foo" :classes="notificationClass" />

    <form @submit.prevent="login">
      <div class="con-form center content-inputs">
        <vs-input
          class="mb-5 mt-5"
          border
          success
          type="text"
          icon-after
          v-model="form.email"
          label-placeholder="Email Address"
        >
          <template #icon>
            <i class="bx bx-mail-send"></i>
          </template>
          <template #message-danger v-if="errors.email">
            {{ errors.email[0] }}
          </template>
        </vs-input>
        <vs-input
          class="mb-5 mt-5"
          border
          success
          type="password"
          icon-after
          v-model="form.password"
          label-placeholder="Password"
        >
          <template #icon>
            <i class="bx bx-lock-open-alt"></i>
          </template>
          <template #message-danger v-if="errors.password">
            {{ errors.password[0] }}
          </template>
        </vs-input>
      </div>

      <template footer>
        <div class="footer-dialog">
          <vs-button block ref="button" flat square><b>Admin Sign In</b></vs-button>
          <!-- <vs-button block @click="submitCategory">
              Create Category
            </vs-button> -->
        </div>
      </template>
    </form>
  </div>
  <!-- az-content-body -->
</template>

<script>
import Admin from '../../../../apis/admin/User'

export default {
  name: "AdminLogin",
  data() {
    return {
      notificationClass: null,
      form: {
        email: "",
        password: "",
      },
      errors: []
    };
  },
  methods: {
      login(){
        Admin.login(this.form)
          .then(response => {
            this.$store.commit('admin/LOGIN', true)
            localStorage.setItem("token", response.data)
                this.notificationClass = 'vue-notification success'
                    this.$notify({
                      group: 'foo',
                      title: 'Success',
                      text: 'Login request successful'
                    })
                    let self = this
                    setTimeout(function(){
                      // self.$router.push({path: '/api/admin'})
                      window.location.href = '/api/admin'
                    }, 3000)
            // this.$router.push({name: 'AdminDashboard'})
          })
          .catch(error =>{
            if (error.response.status === 422) {
              this.errors = error.response.data.errors
            }
          })
      }
  },
  created() {},
  computed: {},
};
</script>

