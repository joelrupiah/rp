<template>
  <div class="az-content-body pd-lg-l-40 d-flex flex-column">
    <notifications group="foo" :classes="notificationClass" />

    <form @submit.prevent="register">
      <div class="con-form center content-inputs">
          <vs-input
          class="mb-5 mt-5"
          border
          success
          type="text"
          icon-after
          v-model="form.name"
          label-placeholder="Full Name"
        >
          <template #icon>
            <i class="bx bx-user"></i>
          </template>
          <template #message-danger v-if="errors.name">
            {{ errors.name }}
          </template>
        </vs-input>
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
            {{ errors.email }}
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
            {{ errors.password }}
          </template>
        </vs-input>
        <vs-input
          class="mb-5 mt-5"
          border
          success
          type="password"
          icon-after
          v-model="form.password_confirmation"
          label-placeholder="Confirm Password"
        >
          <template #icon>
            <i class="bx bx-lock-open-alt"></i>
          </template>
          <template #message-danger v-if="errors.password_confirmation">
            {{ errors.password_confirmation[0] }}
          </template>
        </vs-input>
      </div>

      <template footer>
        <div class="footer-dialog">
          <vs-button block ref="button" flat square><b>User Sign Up</b></vs-button>
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
import User from '../../../../apis/user/User'
export default {
  name: "UserRegister",
  data() {
    return {
      notificationClass: null,
      form: {
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
      },
      errors: []
    };
  },
  methods: {
      register(){
            User.register(this.form)
              .then(() => {
                this.notificationClass = 'vue-notification success'
                    this.$notify({
                      group: 'foo',
                      title: 'Success',
                      text: 'Registration request successful, login to continue'
                    })
                    let self = this
                    setTimeout(function(){
                      self.$router.push({path: '/api/login'})
                    }, 3000)
              })
              .catch(error => {
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

