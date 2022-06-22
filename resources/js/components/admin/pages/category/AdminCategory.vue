<template>
      <div class="page-wrapper">
        <div class="container-xl">
          <!-- Page title -->
          <div class="page-header d-print-none">
            <div class="row align-items-center mb-3">
              <div class="col">
                <h2 class="page-title">
                  Category List
                </h2>
              </div>
            </div>
            <div class="row align-items-center">
              <div class="col d-flex justify-content-between">
                <el-button type="primary" icon="el-icon-plus" size="mini" 
                 data-bs-toggle="modal" data-bs-target="#category-modal" @click="createModal">
                  Create Category
                </el-button>
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
                          <th>Title</th>
                          <th>Created At</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="(category, index) in categories" :key="category.id">
                          <td >{{ index+1 }}</td>
                          <td class="text-muted" >
                            {{ category.title }}
                          </td>
                          <td class="text-muted" >
                            {{ category.created_at | time }}
                          </td>
                          <td class="text-muted" >
                            <a class="mr-1" data-bs-toggle="modal" data-bs-target="#category-modal"
                             @click.prevent="editModal(category)">
                              <span class="text-green">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" 
                                  stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                  <path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4" />
                                  <line x1="13.5" y1="6.5" x2="17.5" y2="10.5" />
                                </svg>
                              </span>
                            </a>
                            <a class="ml-1" data-bs-toggle="modal" data-bs-target="#delete-category" 
                              @click.prevent="deleteModal(category)">
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
      
        <div class="modal modal-blur fade" v-show="isModalVisible" tabindex="-1" 
        id="category-modal" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" v-show="!editMode">Add a new category</h5>
                <h5 class="modal-title" v-show="editMode">Update category</h5>
              </div>
              <div class="modal-body">
                <div class="row mb-3 align-items-end">
                  <div class="col">
                    <label class="form-label">Title</label>
                    <el-input v-model="form.title" size="mini" autocomplete="off"></el-input>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <el-button type="danger" icon="el-icon-times" size="mini" data-bs-dismiss="modal" 
                  @click.prevent="clearData()">
                  Close
                </el-button>
                <el-button type="success" icon="el-icon-plus" size="mini" data-bs-dismiss="modal" 
                  :loading="loading" v-show="!editMode" @click.prevent="addCategory()">
                  Add Category
                </el-button>
                <el-button type="success" icon="el-icon-plus" size="mini" data-bs-dismiss="modal" 
                  :loading="loading" v-show="editMode" @click.prevent="updateCategory()">
                  Update Category
                </el-button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal modal-blur fade" id="delete-category" tabindex="-1" 
         v-show="isDeleteModalVisible" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-status bg-danger"></div>
              <div class="modal-body text-center py-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 9v2m0 4v.01" /><path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" /></svg>
                <h3>Are you sure?</h3>
                <div class="text-muted">Do you really want to remove <strong>{{ category.title }}</strong> ? What you've done cannot be undone.</div>
              </div>
              <div class="modal-footer">
                <div class="w-100">
                  <div class="row">
                    <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal"
                     @click.prevent="closeDeleteModal()">
                        Cancel
                      </a></div>
                    <div class="col"><a href="#" class="btn btn-danger w-100" data-bs-dismiss="modal"
                     @click.prevent="deleteCategory()">
                        Delete Category
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
import Api from '../../../../apis/admin/Api'
export default {
    title: 'AdminCategory',
    data(){
      return {
        category: {},
        categories: [],
        loading: false,
        editMode: false,
        isModalVisible: false,
        isDeleteModalVisible: false,
        form: {
          id: '',
          title: ''
        }
      }
    },

    methods: {
      clearForm(){
        this.form.id = ''
        this.form.title = ''
      },
      clearData(){
        this.form.title = ''
        this.form.id = ''
        this.editMode = false
        this.isModalVisible = false
      },
      closeDeleteModal(){
        this.category = ''
        this.isDeleteModalVisible = false
      },
      createModal(){
        this.editMode = false
        this.form.title = ''
        this.isModalVisible = true
      },
      editModal(category){
        this.editMode = true
        this.form.id = category.id
        this.form.title = category.title
        this.isModalVisible = true
      },
      deleteModal(category){
        this.editMode = false
        this.category = category
        this.isDeleteModalVisible = true
      },
      deleteCategory(category){
        this.form.title = category.title
      },
      getCategoryList: async function(){
        let response = await Api().get('/admin/category')
        this.categories = response.data.categories
      },
      addCategory: async function(){
        this.loading = true
        await Api().post('/admin/category', this.form)
          .then(() => {
            this.getCategoryList()
            this.loading = false
            this.isModalVisible = false
            this.clearForm()
          })
      },
      updateCategory: async function(){
        this.loading = true
        await Api().post(`/admin/update-category/${this.form.id}`, this.form)
          .then(() => {
            this.getCategoryList()
            this.loading = false
            this.isModalVisible = false
            this.editMode = false
            this.clearForm()
          })
          .catch(error => {
            this.loading = false
          })
      },
      deleteCategory: async function(){
        await this.$store.dispatch('category/deleteCategory', this.category.id)
        this.getCategoryList()
        this.isDeleteModalVisible = false
      }
    },

    computed: {},

    mounted(){
      this.getCategoryList()
    }

}
</script>

