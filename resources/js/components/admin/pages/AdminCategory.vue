<template>
    <div class="az-content-body pd-lg-l-40 d-flex flex-column">
          <div class="az-content-breadcrumb mb-5">
            <span>Components</span>
            <span>UI Elements</span>
            <span>Buttons</span>
          </div>

    <div class="d-flex justify-content-between">
        <div class="az-content-label mg-b-5">Categories Table</div>

        <div class="center">
      <vs-button square @click="newModal">
        Add Category
      </vs-button>
      <vs-dialog square prevent-close v-model="active">
        <template #header>
          <h4 v-show="!editmode" class="mb-2">
            Create Category <b>RoyalPorter</b>
          </h4>
          <h4 v-show="editmode" class="mb-2">
            Update Category <b>RoyalPorter</b>
          </h4>
        </template>

<form @submit.prevent="editmode ? updateCategory() : submitCategory()">
        <div class="con-form center content-inputs">

      <vs-input class="mb-2" border success type="text" icon-after v-model="form.title" label-placeholder="Category Name">
        <template #icon>
          <i class='bx bx-category'></i>
        </template>
      </vs-input>
        </div>

        <template footer>
          <div class="footer-dialog">
            <vs-button v-show="!editmode" block ref="button" flat square><b>Create Category</b></vs-button>
            <vs-button v-show="editmode" block ref="button" flat square><b>Update Category</b></vs-button>
            <!-- <vs-button block @click="submitCategory">
              Create Category
            </vs-button> -->

          </div>
        </template>
</form>
      </vs-dialog>
    </div>

    </div>

    <div class="table-responsive">
            <table class="table table-hover mg-b-0">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Product Name</th>
                  <th>Date Created</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(category, index) in categories" :key="category.id">
                  <th scope="row">{{index+1}}</th>
                  <td>{{category.title}}</td>
                  <td>{{category.created_at}}</td>
                  <td>
                        <a class="mr-1" @click.prevent="editModal(category)">
                            <i class="fas fa-pen" style="color:#00ff00"></i>
                        </a>
                        <a class="ml-1" @click.prevent="deleteCategory(category.id)">
                            <i class="fas fa-times" style="color:#ff0000"></i>
                        </a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div><!-- table-responsive -->

        </div><!-- az-content-body -->
</template>

<script>
export default {
    name: 'AdminCategory',
      data(){
          return{
              form:{
                  id: '',
                  title: ''
              },
              editmode: false,
              active: false
          }
      },
      methods: {
        editModal(category){
            this.editmode = true
            this.form = category
            this.active = true
        },
        newModal(){
            this.editmode = false
            this.form.title = ''
            this.active = true
        },
        openLoadingButton() {
        //   console.log(this.$refs.button)
          const loading = this.$vs.loading({
            target: this.$refs.button,
            scale: '0.6',
            background: 'success',
            opacity: 1,
            color: '#fff'
          })
        //   setTimeout(() => {
        //     loading.close()
        //   }, 3000)
        },
          submitCategory(){
              axios.post('/api/admin/category', this.form)
                .then(res=>{
                    this.openLoadingButton()
                    this.active = false
                    this.categoryList()
                    this.$message({
                    showClose: true,
                    message: 'Category created succeffully.',
                    type: 'success'
                  });
                    this.form.title = ''
                })
                .catch(err=>{

                })
          },
        updateCategory(){
            axios.put('/api/admin/category/'+this.form.id, this.form)
                .then(res=>{
                    this.openLoadingButton()
                    this.active = false
                    this.categoryList()
                    this.$message({
                    showClose: true,
                    message: 'Category updated succeffully.',
                    type: 'success'
                  });
                    this.form.title = ''
                })
                .catch(err=>{

                })
        },
        deleteCategory(id){
            this.$store.dispatch('category/deleteCategory', id)
            this.$message({
                showClose: true,
                message: 'Category deleted succeffully.',
                type: 'success'
            });
            this.categoryList()
        },
          categoryList(){
              this.$store.dispatch('category/categoryList')
          },
      },
      created(){
          this.categoryList()
      },
      computed: {
          categories(){
              return this.$store.getters['category/categoryList']
          }
      }
}
</script>

