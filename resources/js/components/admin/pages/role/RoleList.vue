<template>
  <div class="page-wrapper">
    <div class="container-xl">
      <div class="page-header d-print-none">
            <div class="row align-items-center mb-3">
              <div class="col">
                <h2 class="page-title">
                  Roles Table
                </h2>
              </div>
            </div>
            <div class="row align-items-center">
              <div class="col d-flex justify-content-between">
                <router-link :to="{ name: 'CreateRole' }">
                  <el-button type="primary" icon="el-icon-plus" size="mini">
                    Create Role
                  </el-button>
                </router-link>
                <!-- <el-button type="primary" icon="el-icon-plus" size="mini" 
                 data-bs-toggle="modal" data-bs-target="#category-modal" @click="createModal">
                  Create Category
                </el-button> -->
              </div>
            </div>
          </div>
    </div>
    <div class="page-body">
      <div class="container-xl">
        <div class="table-responsive">
          <table class="table table-hover mg-b-0">
            <thead>
              <tr>
                <th>SL</th>
                <th>Name</th>
                <th>Permission</th>
                <th>Date Created</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(role, index) in roles" :key="role.id">
                <th scope="row">{{ index + 1 }}</th>
                <td>
                  {{ role.name }}
                </td>
                <td>
                  <span
                    v-for="permission in role.permissions"
                    :key="permission.id"
                  >
                    <Tag color="success">{{ permission.name }}</Tag>
                  </span>
                </td>
                <td>
                  {{ role.created_at | time }}
                </td>
                <td>
                  <a class="ml-1">
                    <i class="fas fa-pen" style="color: #00ff00"></i>
                  </a>
                  <a class="ml-1">
                    <i class="fas fa-times" style="color: #ff0000"></i>
                  </a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- table-responsive -->
      </div>
    </div>
  </div>
  <!-- az-content-body -->
</template>

<script>
import Api from "../../../../apis/admin/Api";
export default {
  name: "RoleList",
  data() {
    return {
      roles: [],
    };
  },
  methods: {
    getAllRoles() {
      Api()
        .get("/admin/role")
        .then((response) => {
          this.roles = response.data.roles;
        });
    },
  },
  created() {
    this.getAllRoles();
  },
  computed: {},
};
</script>

