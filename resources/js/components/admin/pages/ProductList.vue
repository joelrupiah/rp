<template>
    <div class="az-content-body pd-lg-l-40 d-flex flex-column">
          <div class="az-content-breadcrumb mb-5">
            <span>Components</span>
            <span>UI Elements</span>
            <span>Buttons</span>
          </div>

    <div class="d-flex justify-content-between">
        <div class="az-content-label mg-b-5">Products Table</div>

        <div class="center">
      <!-- <vs-button square @click="newModal">
        Add Product
      </vs-button> -->
      <router-link :to="{name: 'AdminProductAddEdit'}"><vs-button square>
        Add Product
      </vs-button></router-link>
      <!-- <vs-dialog square overflow-hidden auto-width prevent-close v-model="active">
        <template #header>
          <h4 v-show="!editmode" class="mb-2">
            Create Product <b>RoyalPorter</b>
          </h4>
          <h4 v-show="editmode" class="mb-2">
            Update Product <b>RoyalPorter</b>
          </h4>
        </template>

<form @submit.prevent="editmode ? updateProduct() : submitProduct()">
        <div class="con-form center content-inputs">
            <div class="row mb-5">
                <div class="col-md-6">
                    <Input v-model="form.title" placeholder="Input Product Name" />
                </div>
                <div class="col-md-6">
                    <Select v-model="form.category_id" filterable multiple placeholder="Select Category">
                        <Option v-for="(category, index) in categories" :value="category.id" :key="index">{{ category.title }}</Option>
                    </Select>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-6">
                    <InputNumber class="w-100" v-model="form.price" placeholder="Input Product Price"></InputNumber>
                </div>
                <div class="col-md-6">
                    <InputNumber class="w-100" v-model="form.discount" placeholder="Input Product Discount"></InputNumber>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-6">
                    <Input v-model="form.smallDescription" maxlength="255" show-word-limit type="textarea"
                    placeholder="Input Small Description" />
                </div>
                <div class="col-md-6">
                    <Input v-model="form.description" maxlength="255" show-word-limit type="textarea"
                    placeholder="Input Description" />
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-4">
                    <vs-input class="mb-2" border success type="text" icon-after v-model="form.imageOne" label-placeholder="Product Image One">
                        <template #icon>
                        <i class='bx bx-category'></i>
                        </template>
                    </vs-input>
                </div>
                <div class="col-md-4">
                    <vs-input class="mb-2" border success type="text" icon-after v-model="form.imageTwo" label-placeholder="Product Image Two">
                        <template #icon>
                        <i class='bx bx-category'></i>
                        </template>
                    </vs-input>
                </div>
                <div class="col-md-4">
                    <vs-input class="mb-2" border success type="text" icon-after v-model="form.imageThree" label-placeholder="Product Image Three">
                        <template #icon>
                        <i class='bx bx-category'></i>
                        </template>
                    </vs-input>
                </div>
            </div>
        </div>
        <template footer>
          <div class="footer-dialog d-flex justify-content-center">
            <vs-button v-show="!editmode" ref="button" flat square><b>Create Product</b></vs-button>
            <vs-button v-show="editmode" ref="button" flat square><b>Update Product</b></vs-button>

          </div>
        </template>
</form>
      </vs-dialog> -->
    </div>

    </div>


          <div class="table-responsive">
            <table class="table table-hover mg-b-0">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Product Name</th>
                  <th>Categories</th>
                  <th>Date Created</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(product, index) in products" :key="product.id">
                  <th scope="row">{{index+1}}</th>
                  <td>{{product.title}}</td>
                  <td>
                    <Tag color="success" v-for="(cat, i) in product.categories" :key="i">
                        {{cat.title}}
                    </Tag>
                  </td>
                  <td>{{product.created_at}}</td>
                  <td>
                        <!-- <a class="mr-1" @click.prevent="editModal(product)">
                            <i class="fas fa-pen" style="color:#00ff00"></i>
                        </a> -->
                        <router-link :to="{name: 'editProduct', params: { productId: product.id }}" class="mr-1">
                            <i class="fas fa-pen" style="color:#00ff00"></i>
                        </router-link>
                        <a class="ml-1" @click="deleteProduct(product.id)">
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
    name: 'ProductList',
      data(){
          return{
            product: {},
              // form:{
              //     id: '',
              //     title: '',
              //     category_id: null,
              //     code: '',
              //     price: null,
              //     discount: null,
              //     smallDescription: '',
              //     description: '',
              //     imageOne: '',
              //     imageTwo: '',
              //     imageThree: ''
              // },
              // editmode: false,
              // active: false,
          }
      },
      methods: {
        // clearForm(){
        //     this.form.title = '',
        //     this.form.category_id = null,
        //     this.form.code = '',
        //     this.form.price = null,
        //     this.form.discount = null,
        //     this.form.smallDescription = '',
        //     this.form.description = '',
        //     this.form.imageOne = '',
        //     this.form.imageTwo = '',
        //     this.form.imageThree = ''
        // },
        // editModal(product){
        //     this.editmode = true
        //     this.form = product
        //     console.log(product)
        //     this.active = true
        // },
        // newModal(){
        //     this.editmode = false
        //     this.active = true
        // },
        // openLoadingButton() {
        // //   console.log(this.$refs.button)
        //   const loading = this.$vs.loading({
        //     target: this.$refs.button,
        //     scale: '0.6',
        //     background: 'success',
        //     opacity: 1,
        //     color: '#fff'
        //   })
        // //   setTimeout(() => {
        // //     loading.close()
        // //   }, 3000)
        // },
        //   submitProduct(){
        //     //   console.log(this.form)
        //       axios.post('/api/admin/product', this.form)
        //         .then(res=>{
        //             this.openLoadingButton()
        //             this.active = false
        //             this.productList()
        //             this.$message({
        //             showClose: true,
        //             message: 'Product created succeffully.',
        //             type: 'success'
        //           });
        //             this.clearForm()
        //         })
        //         .catch(err=>{

        //         })
        //   },
        // updateProduct(){
        //     axios.put('/api/admin/product/'+this.form.id, this.form)
        //         .then(res=>{
        //             this.openLoadingButton()
        //             this.active = false
        //             this.productList()
        //             this.$message({
        //             showClose: true,
        //             message: 'Product updated succeffully.',
        //             type: 'success'
        //           });
        //             this.clearForm()
        //         })
        //         .catch(err=>{

        //         })
        // },
        // deleteProduct(id){
        //     this.$store.dispatch('product/deleteProduct', id)
        //     this.productList()
        //     this.$message({
        //         showClose: true,
        //         message: 'Product deleted succeffully.',
        //         type: 'success'
        //     });
        // },
          productList(){
              this.$store.dispatch('product/productList')
          },
          // categoryList(){
          //     this.$store.dispatch('category/categoryList')
          // },

      },
      created(){
          this.productList()
          // this.categoryList()
          // this.clearForm()
      },
      computed: {
          products(){
              return this.$store.getters['product/productList']
          },
          // categories(){
          //     return this.$store.getters['category/categoryList']
          // }
      }
}
</script>

