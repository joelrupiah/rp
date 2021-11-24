<template>
<div class="az-content-body pd-lg-l-40 d-flex flex-column">
        <div class="az-content-breadcrumb mb-5">
            <span>Components</span>
            <span>UI Elements</span>
            <span>Buttons</span>
        </div>
        <div class="card">
            <div class="card-body">
            <div class="az-content-label mb-5" v-if="!form.id">Create Product</div>
            <div class="az-content-label mb-5" v-else>Update Product</div>
            <div class="center">
                <form @submit.prevent="saveUpdateProduct">
                    <div class="con-form center content-inputs">
                        <div class="row mb-5">
                            <div class="col-md-6">
                                <Input v-model="form.title" placeholder="Input Product Name" />
                            </div>
                            <div class="col-md-6">
                                <!-- <Select v-model="form.category_id" filterable multiple placeholder="Select Category">
                                    <Option v-for="(category, index) in categories" :value="category.id" :key="index">{{ category.title }}</Option>
                                </Select> -->
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
                                <!-- <vs-input class="mb-2" border success type="text" icon-after v-model="form.imageOne" label-placeholder="Product Image One">
                                    <template #icon>
                                    <i class='bx bx-category'></i>
                                    </template>
                                </vs-input> -->
                                    <input @change="imageOne" placeholder="Select Image" type="file" />
                                    <img :src="`/uploads/${product.imageOne}`" alt="" width="100px" height="100px" v-if="form.imageOne" />
                            </div>
                            <div class="col-md-4">
                                <!-- <vs-input class="mb-2" border success type="text" icon-after v-model="form.imageTwo" label-placeholder="Product Image Two">
                                    <template #icon>
                                    <i class='bx bx-category'></i>
                                    </template>
                                </vs-input> -->
                                <input @change="imageTwo" placeholder="Select Image" type="file" />
                                <img :src="`/uploads/${product.imageTwo}`" alt="" width="100px" height="100px" v-if="form.imageTwo" />
                            </div>
                            <div class="col-md-4">
                                <!-- <vs-input class="mb-2" border success type="text" icon-after v-model="form.imageThree" label-placeholder="Product Image Three">
                                    <template #icon>
                                    <i class='bx bx-category'></i>
                                    </template>
                                </vs-input> -->
                                <input @change="imageThree" placeholder="Select Image" type="file" />
                                <img :src="`/uploads/${product.imageThree}`" alt="" width="100px" height="100px" v-if="form.imageThree" />
                            </div>
                        </div>
                    </div>
                    <template footer>
                    <div class="footer-dialog d-flex justify-content-center">
                        <vs-button v-if="!form.id" ref="button" flat square><b>Create Product</b></vs-button>
                        <vs-button v-else ref="button" flat square><b>Update Product</b></vs-button>

                    </div>
                    </template>
                </form>
            </div>
            </div>
        </div>
</div>
</template>

<script>
export default {
    name: 'AdminProductAddEdit',
    data(){
        return {
            // editmode: false,
            form: {
                category_id: '',
                title: '',
                price: null,
                discount: null,
                smallDescription: '',
                description: '',
                imageOne: '',
                imageTwo: '',
                imageThree: ''
            }
        }
    },
    methods: {
        imageOne(e){
            // console.log(e.target.files[0])
            this.form.imageOne = e.target.files[0]
        },
        imageTwo(e){
            // console.log(e.target.files[0])
            this.form.imageTwo = e.target.files[0]
        },
        imageThree(e){
            // console.log(e.target.files[0])
            this.form.imageThree = e.target.files[0]
        },
        saveUpdateProduct(){
            let formData = new FormData()
            formData.append('category_id', this.form.category_id)
            formData.append('title', this.form.title)
            formData.append('price', this.form.price)
            formData.append('discount', this.form.discount)
            formData.append('smallDescription', this.form.smallDescription)
            formData.append('description', this.form.description)
            formData.append('imageOne', this.form.imageOne)
            formData.append('imageTwo', this.form.imageTwo)
            formData.append('imageThree', this.form.imageThree)
            if (this.product.id) {
                this.updateProduct(formData)
            }else{
                this.saveProduct(formData)
            }
        },
        categoryList(){
            this.$store.dispatch('category/categoryListAll')
        },
        editProductById(){
            this.$store.dispatch('product/editProduct', this.$route.params.productId)
        },
        saveProduct(formData){
            axios.post('/api/admin/product', formData)
                .then(res=>{
                    this.$message({
                        message: 'Product created successfully',
                        type: 'success'
                    })
                    // this.$router.push({name: 'ProductList'})
                })
                .catch(err=>{
                    this.errors = err.response.data.errors
                })
        },
        updateProduct(formData){
            console.log(formData)
        }
    },
    computed: {
        categories(){
            return this.$store.getters['category/categoryList']
        },
        product(){
            return this.$store.getters['product/singleProduct']
        },
    },
    created(){
        this.categoryList()
        if (this.$route.params.productId) {
            this.editProductById()
        }
    },
    watch: {
        product(){
            this.form = this.product
        }
    }
}
</script>