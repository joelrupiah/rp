<template>
  <div class="page-wrapper">
    <div class="container-xl">
      <div class="az-content-breadcrumb mb-5">
        <span>Components</span>
        <span>UI Elements</span>
        <span>Buttons</span>
      </div>

      <div class="d-flex justify-content-start">
        <div class="az-content-label mg-b-5">Create Permissions</div>
      </div>

      <div class="d-flex justify-content-end">
        <router-link :to="{ name: 'PermissionList' }">
          <vs-button square> Permission List </vs-button>
        </router-link>
      </div>
    </div>

    <div class="page-body">
      <div class="container-xl">
        <form @submit.prevent="submitPermission()">
          <div class="con-form center content-inputs">
            <div class="row mb-5">
              <div class="col-md-6">
                <Input
                  v-model="form.name"
                  placeholder="Input Permission Name"
                />
                <span v-if="errors.name">
                  <p class="text-danger">{{ errors.name[0] }}</p>
                </span>
              </div>
            </div>
          </div>
          <template footer>
            <div class="footer-dialog d-flex justify-content-center">
              <vs-button ref="button" flat square
                ><b>Create Permission</b></vs-button
              >
            </div>
          </template>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import Api from "../../../../apis/admin/Api";
export default {
  name: "CreatePermission",
  data() {
    return {
      form: {
        name: "",
      },
      errors: [],
    };
  },
  methods: {
    submitPermission() {
      Api()
        .post("/admin/permission", this.form)
        .then(() => {
          this.form.name = "";
        })
        .catch((error) => {
          if (error.response.status === 422) {
            this.errors = error.response.data.errors;
          }
        });
    },
  },
  computed: {},
  mounted() {},
};
</script>