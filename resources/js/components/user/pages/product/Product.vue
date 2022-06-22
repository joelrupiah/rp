<template>
<div id="user_shop">
    
<nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
    <notifications group="foo" :classes="notificationClass" class="mt-1"/>
                <div class="container d-flex align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Products</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Centered</li>
                        {{ this.$route.params.slug }}
                    </ol>

                </div><!-- End .container -->
</nav><!-- End .breadcrumb-nav -->
            <div class="page-content">
                <div class="container">
                    <div class="product-details-top mb-2">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="product-gallery product-gallery-vertical">
                                    <div class="row">
                                        <figure class="product-main-image">
                                            <img id="product-zoom" :src="fileLink(product.imageOne)" 
                                            ata-zoom-image="/frontend/assets/images/products/single/centered/1-big.jpg" 
                                            alt="product image">
                                            <!-- STYLE THE IMAGE TO width=458px AND height=458px -->

                                            <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                                                <i class="icon-arrows"></i>
                                            </a>
                                        </figure><!-- End .product-main-image -->

                                        <div id="product-zoom-gallery" class="product-image-gallery">
                                            <a class="product-gallery-item active" href="#" data-image="/frontend/assets/images/products/single/centered/1.jpg" data-zoom-image="/frontend/assets/images/products/single/centered/1-big.jpg">
                                                <img src="/frontend/assets/images/products/single/centered/1-small.jpg" alt="product side">
                                            </a>

                                            <a class="product-gallery-item" href="#" data-image="/frontend/assets/images/products/single/centered/2.jpg" data-zoom-image="/frontend/assets/images/products/single/centered/2-big.jpg">
                                                <img src="/frontend/assets/images/products/single/centered/2-small.jpg" alt="product cross">
                                            </a>

                                            <a class="product-gallery-item" href="#" data-image="/frontend/assets/images/products/single/centered/3.jpg" data-zoom-image="/frontend/assets/images/products/single/centered/3-big.jpg">
                                                <img src="/frontend/assets/images/products/single/centered/3-small.jpg" alt="product with model">
                                            </a>

                                            <a class="product-gallery-item" href="#" data-image="/frontend/assets/images/products/single/centered/4.jpg" data-zoom-image="/frontend/assets/images/products/single/centered/4-big.jpg">
                                                <img src="/frontend/assets/images/products/single/centered/4-small.jpg" alt="product back">
                                            </a>
                                        </div><!-- End .product-image-gallery -->
                                    </div><!-- End .row -->
                                </div><!-- End .product-gallery -->
                            </div><!-- End .col-md-6 -->

                            <div class="col-md-6">
                                <div class="product-details product-details-centered">
                                    <h1 class="product-title">{{product.title}}</h1><!-- End .product-title -->

                                    <div class="ratings-container">
                                        <div class="ratings">
                                            <div class="ratings-val" style="width: 80%;"></div><!-- End .ratings-val -->
                                        </div><!-- End .ratings -->
                                        <a class="ratings-text" href="#product-review-link" id="review-link">( 2 Reviews )</a>
                                    </div><!-- End .rating-container -->

                                    <div class="product-price">
                                        $ {{ product.price }}
                                    </div><!-- End .product-price -->

                                    <div class="product-content">
                                        <p>{{product.smallDescription}}</p>
                                    </div><!-- End .product-content -->

                                    <div class="product-details-action">
                                        <div class="details-action-col">
                                            <a href="#" class="btn-product btn-cart" @click.prevent="addToCart(product)">
                                                <span>add to cart</span>
                                            </a>
                                        </div><!-- End .details-action-col -->

                                        <div class="details-action-wrapper">
                                            <a href="#" class="btn-product btn-wishlist" 
                                                @click.prevent="addToWishlist(product)" title="Wishlist">
                                                <span>Add to Wishlist</span>
                                            </a>
                                            <a href="#" class="btn-product btn-compare" 
                                               @click.prevent="addToCompare()" title="Compare">
                                                <span>Add to Compare</span>
                                            </a>
                                        </div><!-- End .details-action-wrapper -->
                                    </div><!-- End .product-details-action -->

                                    <div class="product-details-footer">
                                        <div class="product-cat">
                                            <span>Categories:</span>
                                            <a v-for="(category,  index) in product.categories" :key="index">
                                                {{ category.title }} ,
                                            </a>
                                        </div><!-- End .product-cat -->

                                        <div class="social-icons social-icons-sm">
                                            <span class="social-label">Share:</span>
                                            <a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                                            <a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                                            <a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                                            <a href="#" class="social-icon" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                                        </div>
                                    </div><!-- End .product-details-footer -->
                                </div><!-- End .product-details -->
                            </div><!-- End .col-md-6 -->
                        </div><!-- End .row -->
                    </div><!-- End .product-details-top -->

                    <!-- PRODUCT COMPLLETE DETAILS -->

                    <h2 class="title text-center mb-4">You May Also Like</h2><!-- End .title text-center -->
                    
                </div><!-- End .container -->
            </div><!-- End .page-content -->
</div>
</template>

<script>
import Api from '../../../../apis/user/Api'
export default {
    name: 'Product',
    data(){
        return {
      		notificationClass: null,
            wishlist: {
                product_id: null
            }
        }
    },
    methods: {
        
        fileLink(name){
            return '/uploads/products/' + name
        },
        getProduct(){
            this.$store.dispatch('product/showSingleProduct', this.$route.params.slug)
        },
        addToCart(product){
            // alert(product.title + 'Added to cart')
			this.$store.dispatch('cart/addToCart', {
				product, 
				quantity: 1
			})
            this.$message({
				message: 'Product added to cart',
				type: 'success'
			})
        },
        addToWishlist(product){
			this.$store.dispatch('wishlist/saveWishList', product)
            this.$message({
				message: 'Product added to wishlist',
				type: 'success'
			})
        },
        addToCompare(){
            this.notificationClass = 'vue-notification warning'
            this.$notify({
                    group: 'foo',
                    text: 'Compare functionality coming soon'
                })
                // let self = this
                setTimeout(function(){
                    // self.$router.push({path: '/api/account'})
					// window.location.href = '/api/account'
                }, 3000)
        }
        
    },
    computed: {
        product(){
            return this.$store.getters['product/singleUserProduct']
        }
    },
    mounted(){
        this.getProduct()
    }
}
</script>
