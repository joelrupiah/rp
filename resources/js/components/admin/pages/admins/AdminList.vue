<template>
<div id="admin_list">
  <div class="container-xl">
    <div class="page-header d-print-none">
            <div class="row align-items-center mb-3">
              <div class="col d-flex justify-content-between">
                <h2 class="page-title">
                  Admin List
                </h2>
                <el-button type="primary" icon="el-icon-plus" size="mini" 
                 data-bs-toggle="modal" data-bs-target="#admin-modal" @click="createModal">
                  Create Admin
                </el-button>
              </div>
            </div>
          </div>
    <div class="row row-cards mb-3" v-for="admin in admins" :key="admin.id">
              <div class="col-md-6" >
                <div class="card">
                  <div class="card-body">
                    <div class="row g-2 align-items-center">
                      <div class="col-auto">
                        <span class="avatar avatar-lg">
                          <img src="/backend/static/avatars/002m.jpg" alt="">
                        </span>
                      </div>
                      <div class="col">
                        <h4 class="card-title m-0">
                          <a href="#">{{ admin.name }} </a>
                        </h4>
                      </div>
                      <div class="col-auto">
                        <div class="dropdown">
                          <a href="#" class="card-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <!-- Download SVG icon from http://tabler-icons.io/i/dots-vertical -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="1" /><circle cx="12" cy="19" r="1" /><circle cx="12" cy="5" r="1" /></svg>
                          </a>
                          <div class="dropdown-menu dropdown-menu-end">
                            <a href="#" class="dropdown-item" data-bs-toggle="modal" 
                            data-bs-target="#admin-modal" @click.prevent="editModal(admin)">Edit</a>
                            <a href="#" class="dropdown-item" data-bs-toggle="modal" 
                            data-bs-target="#delete-admin" @click.prevent="deleteModal(admin)">Delete</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

                  <div class="col-md-4">
                    <div class="card">
                      <div class="card-body">
                        <div class="card-title">Basic info</div>
                        <div class="mb-2">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 text-muted" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 19a9 9 0 0 1 9 0a9 9 0 0 1 9 0" /><path d="M3 6a9 9 0 0 1 9 0a9 9 0 0 1 9 0" /><line x1="3" y1="6" x2="3" y2="19" /><line x1="12" y1="6" x2="12" y2="19" /><line x1="21" y1="6" x2="21" y2="19" /></svg>
                          <strong>Role:  </strong><span class="text-success">{{ admin.role }}</span>
                        </div>
                        <div class="mb-2">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 text-muted" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="3" y="7" width="18" height="13" rx="2" /><path d="M8 7v-2a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v2" /><line x1="12" y1="12" x2="12" y2="12.01" /><path d="M3 13a20 20 0 0 0 18 0" /></svg>
                          <strong>Email:  </strong>{{ admin.email }}
                        </div>
                        <div class="mb-2">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 text-muted" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="5 12 3 12 12 3 21 12 19 12" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                          <strong>Phone:  </strong>{{ admin.phone }}
                        </div>
                        <div class="mb-2">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 text-muted" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="5 12 3 12 12 3 21 12 19 12" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                          <strong>ID:  </strong>{{ admin.identification }}
                        </div>
                        <div class="mb-2">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 text-muted" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="4" y="5" width="16" height="16" rx="2" /><line x1="16" y1="3" x2="16" y2="7" /><line x1="8" y1="3" x2="8" y2="7" /><line x1="4" y1="11" x2="20" y2="11" /><line x1="11" y1="15" x2="12" y2="15" /><line x1="12" y1="15" x2="12" y2="18" /></svg>
                          <strong>Date Created:  </strong>{{ admin.created_at | time }}
                        </div>
                        <div class="mb-2">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 text-muted" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="4" y="5" width="16" height="16" rx="2" /><line x1="16" y1="3" x2="16" y2="7" /><line x1="8" y1="3" x2="8" y2="7" /><line x1="4" y1="11" x2="20" y2="11" /><line x1="11" y1="15" x2="12" y2="15" /><line x1="12" y1="15" x2="12" y2="18" /></svg>
                          <strong>Permissions:  </strong>
                          <span class="badge badge-success" v-for="permission in admin.adminPermissions" :key="permission.id">
                            {{ permission }}</span>
                        </div>
                      </div>
                    </div>
                  </div>
              
    </div>
  </div>
        <div class="modal modal-blur fade" v-show="isModalVisible" tabindex="-1" 
        id="admin-modal" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" v-show="!editMode">Add a new admin</h5>
                <h5 class="modal-title" v-show="editMode">Update admin</h5>
              </div>
              <div class="modal-body">
                <div class="row mb-3 align-items-end">
                  <div class="col-md-6">
                    <label class="form-label">Title</label>
                    <el-input v-model="form.name" size="mini" autocomplete="off"></el-input>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <el-input v-model="form.email" size="mini" autocomplete="off"></el-input>
                  </div>
                </div>
                <div class="row mb-3 align-items-end">
                  <div class="col-md-6">
                    <label class="form-label">Phone</label>
                    <el-input v-model="form.phone" size="mini" autocomplete="off"></el-input>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Identification</label>
                    <el-input v-model="form.identification" size="mini" autocomplete="off"></el-input>
                  </div>
                </div>
                <div class="row mb-3 align-items-end">
                  <div class="col-md-6">
                    <label class="form-label">Role</label>
                    <el-select v-model="form.role" size="mini">
                      <el-option v-for="role in roles" :key="role.id" :value="role.id"
                      :label="role.name">{{ role.name }}</el-option>
                    </el-select>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Password</label>
                    <el-input v-model="form.password" size="mini" autocomplete="off" show-password></el-input>
                  </div>
                </div>
                <div class="row mb-3 align-items-end">
                  <div class="col-md-12">
                    <label class="form-check" v-for="permission in permissions" :key="permission.name">
                      <input class="form-check-input" type="checkbox" v-model="form.permissions" :value="permission.name">
                      <span class="form-check-label">{{ permission.name }}</span>
                    </label>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <el-button type="danger" icon="el-icon-times" size="mini" data-bs-dismiss="modal" 
                  @click.prevent="clearData()">
                  Close
                </el-button>
                <el-button type="success" icon="el-icon-plus" size="mini" data-bs-dismiss="modal" 
                  :loading="loading" v-show="!editMode" @click.prevent="addAdmin()">
                  Add Admin
                </el-button>
                <el-button type="success" icon="el-icon-plus" size="mini" data-bs-dismiss="modal" 
                  :loading="loading" v-show="editMode" @click.prevent="updateAdmin()">
                  Update Admin
                </el-button>
              </div>
            </div>
          </div>
        </div>
        <div class="modal modal-blur fade" id="delete-admin" tabindex="-1" 
         v-show="isDeleteModalVisible" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-status bg-danger"></div>
              <div class="modal-body text-center py-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 9v2m0 4v.01" /><path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" /></svg>
                <h3>Are you sure?</h3>
                <div class="text-muted">Do you really want to remove <strong>{{ admin.name }}</strong> ? What you've done cannot be undone.</div>
              </div>
              <div class="modal-footer">
                <div class="w-100">
                  <div class="row">
                    <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal"
                     @click.prevent="closeDeleteModal()">
                        Cancel
                      </a></div>
                    <div class="col"><a href="#" class="btn btn-danger w-100" data-bs-dismiss="modal"
                     @click.prevent="deleteAdmin()">
                        Delete Admin
                      </a></div>
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
  name: "AdminList",
  components: {
  },
  data() {
    return {
        loading: false,
        editMode: false,
        admin: {},
        admins: [],
        permissions: [],
        roles: [],
        search: '',
        loading: false,
        editMode: false,
        isModalVisible: false,
        isDeleteModalVisible: false,
        form: {
          id: '',
          name: '',
          email: '',
          phone: '',
          identification: '',
          password: '',
          role: 1,
          permissions: []
        },
    };
  },
  methods: {
    clearForm(){
      this.form.id = ''
      this.form.name = ''
      this.form.email = ''
      this.form.phone = ''
      this.form.identification = ''
      this.form.role = ''
      this.form.permissions = []
    },
    clearData(){
        this.form.id = ''
        this.form.name = ''
        this.form.email = ''
        this.form.phone = ''
        this.form.identification = ''
        this.form.role = ''
        this.form.permissions = []
        this.editMode = false
        this.isModalVisible = false
      },
    createModal(){
        this.editMode = false
        this.form.id = ''
        this.form.name = ''
        this.form.email = ''
        this.form.phone = ''
        this.form.identification = ''
        this.form.role = ''
        this.form.permissions = []
        this.isModalVisible = true
      },
      editModal(admin){
        this.editMode = true
        this.form.id = admin.id
        this.form.name = admin.name
        this.form.email = admin.email
        this.form.phone = admin.phone
        this.form.identification = admin.identification
        this.form.role = admin.role
        this.form.permissions = admin.adminPermissions
        this.isModalVisible = true
      },
      closeDeleteModal(){
        this.admin = ''
        this.isDeleteModalVisible = false
      },
      deleteModal(admin){
        this.editMode = false
        this.admin = admin
        this.isDeleteModalVisible = true
      },
    getAllAdmins(){
        Api().get('/admin/get-all-admins')
            .then(response => {
                this.admins = response.data.admins
                
            })
    },
    getAllRoles(){
        Api().get('/admin/get-all-roles')
            .then(response => {
                this.roles = response.data.roles
                
            })
    },
    getAllPermssions(){
        Api().get('/admin/get-all-permissions')
            .then(response => {
                this.permissions = response.data.permissions
                
            })
    },
    addAdmin(){
      this.loading = true
      Api().post('/admin/create-user', this.form)
        .then(() => {
          this.getAllAdmins()
           this.loading = false
           this.dialogFormVisible = false
        })
        .catch(error => {
          this.loading = false
        })
      
    },
    updateAdmin(){
      this.loading = true
      Api().post(`/admin/edit-admin/${this.form.id}`, this.form)
        .then(() => {
          this.getAllAdmins()
          this.loading = false
          this.dialogFormVisible = false
        })
        .catch(error => {
          this.loading = false
        })
    },
    deleteAdmin(){
      Api().delete('/admin/delete-admin/'+this.admin.id)
        .then(() => {
          this.getAllAdmins()
        })
    }
  },
  created() {
      this.getAllAdmins()
      this.getAllRoles()
      this.getAllPermssions()
  },
  computed: {
    
  },
};
</script>