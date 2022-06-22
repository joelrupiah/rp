<template>
<div class="page-wrapper">
        <div class="container-xl">
          <!-- Page title -->
          <div class="page-header d-print-none">
            <div class="row align-items-center mb-3">
              <div class="col">
                <h2 class="page-title">
                  Permissions Table
                </h2>
              </div>
            </div>
            <div class="row align-items-center">
              <div class="col d-flex justify-content-between">
                <router-link :to="{ name: 'CreatePermission' }">
                  <el-button type="primary" icon="el-icon-plus" size="mini">
                    Create Permission
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
            <div class="row row-cards">
              <div class="col-12">
                <div class="card">
                  <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                      <thead>
                        <tr>
                          <th>SL</th>
                          <th>Name</th>
                          <th>Created At</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="(permission, index) in permissions" :key="permission.id">
                          <td >{{ index+1 }}</td>
                          <td class="text-muted" >
                            {{ permission.name }}
                          </td>
                          <td class="text-muted" >
                            {{ permission.created_at | time }}
                          </td>
                          <td class="text-muted" >
                            <a class="mr-1">
                              <span class="text-green">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" 
                                  stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                  <path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4" />
                                  <line x1="13.5" y1="6.5" x2="17.5" y2="10.5" />
                                </svg>
                              </span>
                            </a>
                            <a class="ml-1">
                              <span class="text-red">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" 
                                  stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                  <path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="18" y1="6" x2="6" y2="18" />
                                  <line x1="6" y1="6" x2="18" y2="18" />
                                </svg>
                              </span>
                            </a>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
</template>

<script>
import Api from "../../../../apis/admin/Api";
export default {
  name: "PermissionList",
  data() {
    return {
        permissions: []
    };
  },
  methods: {
    getAllPermissions(){
        Api().get('/admin/permission')
            .then(response => {
                this.permissions = response.data.permissions
                
            })
    }
  },
  created() {
      this.getAllPermissions()
  },
  computed: {
    
  },
};
</script>

