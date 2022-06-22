<template>
  <div class="page-wrapper">
    <div class="container-xl">
      <div class="az-content-breadcrumb mb-5">
        <span>Components</span>
        <span>UI Elements</span>
        <span>Buttons</span>
      </div>

      <div class="d-flex justify-content-start">
        <div class="az-content-label mg-b-5">Create Roles</div>
      </div>

      <div class="d-flex justify-content-end">
        <router-link :to="{ name: 'RoleList' }">
          <vs-button square> Role List </vs-button>
        </router-link>
      </div>
    </div>

    <div class="page-body">
      <div class="container-xl">
        <form @submit.prevent="submitRole()">
          <div class="con-form center content-inputs">
            <div class="row mb-3">
              <div class="col-md-6">
                <Input v-model="form.name" placeholder="Input Role Name" />
              </div>
            </div>
          </div>
          <div class="con-form center content-inputs">
            <div class="row mb-5">
              <div class="col-md-6">
                <label
                  class="ckbox"
                  v-for="permission in permissions"
                  :key="permission.name"
                >
                  <input
                    type="checkbox"
                    v-model="form.permissions"
                    :value="permission.name"
                  /><span>{{ permission.name }}</span>
                </label>
              </div>
            </div>
          </div>

          <template footer>
            <div class="footer-dialog d-flex justify-content-center">
              <vs-button ref="button" flat square><b>Create Role</b></vs-button>
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
  name: "CreateRole",
  data() {
    return {
      permissions: [],
      form: {
        name: "",
        permissions: [],
      },
    };
  },
  methods: {
    getAllPermissions() {
      Api()
        .get("/admin/permission")
        .then((response) => {
          this.permissions = response.data.permissions;
        });
    },
    submitRole() {
      Api()
        .post("/admin/role", this.form)
        .then(() => {
          this.form.name = "";
          this.form.permissions = [];
        });
    },
  },
  computed: {},
  mounted() {
    this.getAllPermissions();
  },
};
</script>