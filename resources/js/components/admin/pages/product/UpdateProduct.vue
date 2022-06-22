<template>
  <div class="page-wrapper">
    <div class="container-xl">
    <div class="az-content-breadcrumb mb-5">
      <span>Components</span>
      <span>UI Elements</span>
      <span>Buttons</span>
    </div>

    <div class="d-flex justify-content-start">
      {{ this.$route.params.id }}
      <div class="az-content-label mg-b-5">Update Products</div>
    </div>

    <div class="d-flex justify-content-end">
      <router-link :to="{ name: 'ProductList' }">
        <vs-button square> Product List </vs-button>
      </router-link>
    </div>
    </div>

    <div class="page-body">
      <div class="container-xl">
    <form @submit.prevent="updateProduct()" enctype="multipart/form-data">
      <div class="con-form center content-inputs">
        <div class="row mb-5">
          <div class="col-md-6">
            <Input v-model="form.title" placeholder="Input Product Name" />
          </div>
          <div class="col-md-6">
            <Select
              v-model="form.category_id"
              filterable
              multiple
              placeholder="Select Category"
            >
              <Option
                v-for="category in categories"
                :label="category.title"
                :value="category.id"
                :key="category.title"
                ></Option
              >
            </Select>
          </div>
        </div>
        <div class="row mb-5">
          <div class="col-md-6">
            <InputNumber
              class="w-100"
              v-model="form.price"
              placeholder="Input Product Price"
            ></InputNumber>
          </div>
          <div class="col-md-6">
            <InputNumber
              class="w-100"
              v-model="form.discount"
              placeholder="Input Product Discount"
            ></InputNumber>
          </div>
        </div>
        <div class="row mb-5">
          <div class="col-md-6">
            <Input
              v-model="form.smallDescription"
              maxlength="255"
              show-word-limit
              type="textarea"
              placeholder="Input Small Description"
            />
          </div>
          <div class="col-md-6">
            <Input
              v-model="form.description"
              maxlength="255"
              show-word-limit
              type="textarea"
              placeholder="Input Description"
            />
          </div>
        </div>
        <div class="row mb-5">
          <div class="col-md-4">
            <vs-input
              class="mb-2"
              border
              success
              type="file"
              @change="loadImageOne($event)"
            >
            </vs-input>
            <span
              ><img
                :src="fileLinkOne(form.imageOne)"
                alt=""
                style="width: 40px; height: 40px"
            /></span>
          </div>
          <div class="col-md-4">
            <vs-input
              class="mb-2"
              border
              success
              type="file"
              @change="loadImageTwo($event)"
            >
            </vs-input>
            <span
              ><img
                :src="fileLinkTwo(form.imageTwo)"
                alt=""
                style="width: 40px; height: 40px"
            /></span>
          </div>
          <div class="col-md-4">
            <vs-input
              class="mb-2"
              border
              success
              type="file"
              @change="loadImageThree($event)"
            >
            </vs-input>
            <span
              ><img
                :src="fileLinkThree(form.imageThree)"
                alt=""
                style="width: 40px; height: 40px"
            /></span>
          </div>
        </div>
      </div>
      <template footer>
        <div class="footer-dialog d-flex justify-content-center">
          <vs-button ref="button" flat square><b>Update Product</b></vs-button>
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
  name: "UpdateProduct",
  data() {
    return {
      form: {
        id: "",
        title: "",
        category_id: [],
        code: "",
        price: null,
        discount: null,
        smallDescription: "",
        description: "",
        imageOne: "",
        imageTwo: "",
        imageThree: "",
      },
      errors: {},
    };
  },
  methods: {
        fileLinkOne(name){
            if (name != null && name.length < 256) {
                return '/uploads/products/' + name
            }else {
                return this.form.imageOne
            }
                
        },
        fileLinkTwo(name){
            if (name != null && name.length < 256) {
                return '/uploads/products/' + name
            }else {
                return this.form.imageTwo
            }
                
        },
        fileLinkThree(name){
            if (name != null && name.length < 256) {
                return '/uploads/products/' + name
            }else {
                return this.form.imageThree
            }
                
        },
    loadImageOne(e) {
      // console.log(e.target.files[0]);
      let file = e.target.files[0];
      let reader = new FileReader();
      reader.onload = (e) => {
        this.form.imageOne = e.target.result;
      };
      reader.readAsDataURL(file);
    },
    loadImageTwo(e) {
      // console.log(e.target.files[0]);
      let file = e.target.files[0];
      let reader = new FileReader();
      reader.onload = (e) => {
        this.form.imageTwo = e.target.result;
      };
      reader.readAsDataURL(file);
    },
    loadImageThree(e) {
      // console.log(e.target.files[0]);
      let file = e.target.files[0];
      let reader = new FileReader();
      reader.onload = (e) => {
        this.form.imageThree = e.target.result;
      };
      reader.readAsDataURL(file);
    },
    getProduct() {
      this.$store.dispatch("product/showProduct", this.$route.params.id);
    },
    updateProduct() {
      Api()
        .post("/admin/edit-product/"+this.$route.params.id, this.form)
        .then((response) => {
          console.log(response.data);
          Toast.fire({
            icon: "success",
            title: "Product update response success",
          });
        })
        .catch((error) => {
          if (error.response.status === 422) {
            this.errors = error.response.data.errors;
          }
        });
    },
    activeCategories() {
      this.$store.dispatch("category/activeCategories");
    },
  },
  computed: {
    categories() {
      return this.$store.getters["category/categoryList"];
    },
    product() {
      return this.$store.getters["product/singleProduct"];
    },
  },
  mounted() {
    this.activeCategories();
    this.getProduct();
  },
  watch: {
    product(){
      // const self = this
      this.form.title  = this.product.title
      this.form.imageOne  = this.product.imageOne
      this.form.imageTwo  = this.product.imageTwo
      this.form.imageThree  = this.product.imageThree
      for (let cat of this.product.categories ) {
        this.form.category_id.push(cat.id)
      }
      // this.form.category_id  = this.product.categories
      this.form.code  = this.product.code
      this.form.price  = this.product.price
      this.form.discount  = this.product.discount
      this.form.description  = this.product.description
      this.form.smallDescription  = this.product.smallDescription
    }
  }
};
</script>