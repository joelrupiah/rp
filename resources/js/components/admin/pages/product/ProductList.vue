<template>
  <div class="page-wrapper">
    <div class="container-xl">
      <div class="az-content-breadcrumb mb-5">
        <span>Components</span>
        <span>UI Elements</span>
        <span>Buttons</span>
      </div>

      <div class="d-flex justify-content-between">
        <div class="az-content-label mg-b-5">Products Table</div>

        <div class="center">
          <router-link :to="{ name: 'CreateProduct' }"
            ><vs-button square> Add Product </vs-button></router-link
          >
        </div>
      </div>
    </div>

    <div class="page-body">
      <div class="container-xl">
        <div class="row row-cards">
          <div class="col-12">
            <div class="card">
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
                      <th scope="row">{{ index + 1 }}</th>
                      <td>{{ product.title }}</td>
                      <td>
                        <Tag
                          color="success"
                          v-for="(cat, i) in product.categories"
                          :key="i"
                        >
                          {{ cat.title }}
                        </Tag>
                      </td>
                      <td>{{ product.created_at | time }}</td>
                      <td>
                        <router-link :to="`/api/admin/products/edit-product/${product.id}`"
                          class="mr-1"
                        >
                          <span class="text-green">
                            <svg
                              xmlns="http://www.w3.org/2000/svg"
                              class="icon"
                              width="24"
                              height="24"
                              viewBox="0 0 24 24"
                              stroke-width="2"
                              stroke="currentColor"
                              fill="none"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                            >
                              <path
                                stroke="none"
                                d="M0 0h24v24H0z"
                                fill="none"
                              />
                              <path
                                d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4"
                              />
                              <line x1="13.5" y1="6.5" x2="17.5" y2="10.5" />
                            </svg>
                          </span>
                        </router-link>
                        <router-link
                          class="ml-1"
                          @click="deleteProduct(product.id)"
                        >
                          <span class="text-red">
                            <svg
                              xmlns="http://www.w3.org/2000/svg"
                              class="icon"
                              width="24"
                              height="24"
                              viewBox="0 0 24 24"
                              stroke-width="2"
                              stroke="currentColor"
                              fill="none"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                            >
                              <path
                                stroke="none"
                                d="M0 0h24v24H0z"
                                fill="none"
                              />
                              <line x1="18" y1="6" x2="6" y2="18" />
                              <line x1="6" y1="6" x2="18" y2="18" />
                            </svg>
                          </span>
                        </router-link>
                      </td>
                    </tr>
                    <tr v-if="emptyProducts()">
                      <td colspan="6">
                        <span>
                          <h6 class="text-center text-danger font-bold">
                            No Data Available
                          </h6>
                        </span>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- table-responsive -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- az-content-body -->
</template>

<script>
import Api from "../../../../apis/admin/Api";
export default {
  name: "ProductList",
  data() {
    return {
      product: {},
    };
  },
  methods: {
    productList() {
      this.$store.dispatch("product/productList");
    },
    emptyProducts() {
      return this.products.length < 1;
    },
    deleteProduct(){
      
    }
  },
  created() {
    this.productList();
  },
  computed: {
    products() {
      return this.$store.getters["product/productList"];
    },
  },
};
</script>

