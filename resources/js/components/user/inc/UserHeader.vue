<template>
<header class="header header-2 header-intro-clearance">
            <div class="header-top">
                <div class="container">
                    <div class="header-left">
                        <p>Special collection already available.</p><a href="#">&nbsp;Read more ...</a>
                    </div><!-- End .header-left -->

                    <div class="header-right">

                        <ul class="top-menu">
                            <li>
                                <a href="#">Links</a>
                                <ul>
                                    <li>
                                        <div class="header-dropdown">
                                            <a href="#">USD</a>
                                            <div class="header-menu">
                                                <ul>
                                                    <li><a href="#">Eur</a></li>
                                                    <li><a href="#">Usd</a></li>
                                                </ul>
                                            </div><!-- End .header-menu -->
                                        </div>
                                    </li>
                                    <li>
                                        <div class="header-dropdown">
                                            <a href="#">English</a>
                                            <div class="header-menu">
                                                <ul>
                                                    <li><a href="#">English</a></li>
                                                    <li><a href="#">French</a></li>
                                                    <li><a href="#">Spanish</a></li>
                                                </ul>
                                            </div><!-- End .header-menu -->
                                        </div>
                                    </li>
                                    <li>
                                        <router-link :to="{name: 'UserLogin'}">Sign in / Sign up</router-link>
                                    </li>
                                </ul>
                            </li>
                        </ul><!-- End .top-menu -->
                    </div><!-- End .header-right -->

                </div><!-- End .container -->
            </div><!-- End .header-top -->

            <div class="header-middle">
                <div class="container">
                    <div class="header-left">
                        <button class="mobile-menu-toggler">
                            <span class="sr-only">Toggle mobile menu</span>
                            <i class="icon-bars"></i>
                        </button>
                        
                        <a href="/api" class="logo">
                            <img src="/frontend/assets/images/demos/demo-2/logo.png" alt="Molla Logo" width="105" height="25">
                        </a>
                    </div><!-- End .header-left -->

                    <div class="header-center">
                        <div class="header-search header-search-extended header-search-visible header-search-no-radius d-none d-lg-block">
                            <a href="#" class="search-toggle" role="button"><i class="icon-search"></i></a>
                            <form action="#" method="get">
                                <div class="header-search-wrapper search-wrapper-wide">
                                    <label for="q" class="sr-only">Search</label>
                                    <input type="search" class="form-control" name="q" id="q" placeholder="Search product ..." required>
                                    <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
                                </div><!-- End .header-search-wrapper -->
                            </form>
                        </div><!-- End .header-search -->
                    </div>

                    <div class="header-right">
                        <div class="account">
                            <router-link :to="{name: 'MyAccount'}" title="My account">
                                <div class="icon">
                                    <i class="icon-user"></i>
                                </div>
                                <p>Account</p>
                            </router-link>
                        </div><!-- End .compare-dropdown -->

                        <div class="wishlist">
                            <router-link :to="{name: 'WishList'}" title="Wishlist">
                                <div class="icon">
                                    <i class="icon-heart-o"></i>
                                    <span class="wishlist-count badge">{{ wishlistCount }}</span>
                                </div>
                                <p>Wishlist</p>
                            </router-link>
                        </div><!-- End .compare-dropdown -->

                        <div class="dropdown cart-dropdown">
                            <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                <div class="icon">
                                    <i class="icon-shopping-cart"></i>
                                    <span class="cart-count">{{ cartCount }}</span>
                                </div>
                                <p>Cart</p>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="dropdown-cart-products">
                                    <div class="product" v-for="(item, i) in cart" :key="i">
                                        <div class="product-cart-details">
                                            <h4 class="product-title">
                                                <a href="product.html">{{item.product.title}}</a>
                                            </h4>

                                            <span class="cart-product-info">
                                                <span class="cart-product-qty">{{item.quantity}}</span>
                                                x ${{item.product.price}}
                                            </span>
                                        </div><!-- End .product-cart-details -->

                                        <figure class="product-image-container">
                                            <a href="product.html" class="product-image">
                                                <img src="/frontend/assets/images/products/cart/product-1.jpg" alt="product">
                                            </a>
                                        </figure>
                                        <a href="#" class="btn-remove" title="Remove Product" @click.prevent="removeProductInCart(item.product)">
                                            <i class="icon-close"></i>
                                        </a>
                                    </div><!-- End .product -->
                                </div><!-- End .cart-product -->

                                <div class="dropdown-cart-products" v-if="emptyCart()">
                                    <h6 class="text-center text-danger">Cart is empty</h6>
                                </div><!-- End .cart-product -->

                                <div class="dropdown-cart-total">
                                    <span>Total</span>

                                    <span class="cart-total-price">${{totalCartPrice}}</span>
                                </div><!-- End .dropdown-cart-total -->

                                <div class="dropdown-cart-action">
                                    <router-link :to="{name: 'Cart'}" class="btn btn-primary">
                                        View Cart
                                    </router-link>
                                    <router-link :to="{name: 'Checkout'}" class="btn btn-outline-primary-2">
                                        <span>Checkout</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </router-link>
                                </div><!-- End .dropdown-cart-total -->
                            </div><!-- End .dropdown-menu -->
                        </div><!-- End .cart-dropdown -->
                    </div><!-- End .header-right -->
                </div><!-- End .container -->
            </div><!-- End .header-middle -->

            <div class="header-bottom sticky-header">
                <div class="container">
                    <div class="header-left">
                        <div class="dropdown category-dropdown">
                            <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static" title="Browse Categories">
                                Browse Categories
                            </a>

                            <div class="dropdown-menu">
                                <nav class="side-nav">
                                    <ul class="menu-vertical sf-arrows" v-for="(category, index) in categories" :key="index">
                                        <li>
                                            <router-link :to="`/api/category/${category.slug}`">{{ category.title }}</router-link>
                                        </li>
                                    </ul><!-- End .menu-vertical -->
                                </nav><!-- End .side-nav -->
                            </div><!-- End .dropdown-menu -->
                        </div><!-- End .category-dropdown -->
                    </div><!-- End .header-left -->

                    <div class="header-center">
                        <nav class="main-nav">
                            <ul class="menu sf-arrows">
                                <li class="megamenu-container">
                                    <a href="/api">
                                        Home
                                    </a>
                                </li>
                                <li>
                                    <a href="/api/shop">Shop</a>
                                </li>
                                <li>
                                    <a href="/api/about">About Us</a>
                                </li>
                                <li>
                                    <a href="/api/contact">Contact</a>
                                </li>
                            </ul><!-- End .menu -->
                        </nav><!-- End .main-nav -->
                    </div><!-- End .header-center -->

                    <div class="header-right">
                        <i class="la la-lightbulb-o"></i><p>Clearance<span class="highlight">&nbsp;Up to 30% Off</span></p>
                    </div>
                </div><!-- End .container -->
            </div><!-- End .header-bottom -->
        </header><!-- End .header -->
</template>

<script>
import User from '../../../apis/user/User'
export default {
    name: 'Header',
    data(){
      return {
        // user: {}
      }
    },
    methods: {
        activecategoryListAll(){
            this.$store.dispatch('category/activecategoryListAll')
        },
        getStoredCartItems(){
            this.$store.dispatch('cart/getStoredCartItems')
        },
      logout(){
        User.logout()
          .then(() => {
            localStorage.removeItem("token")
            this.$store.commit('user/LOGIN', false)
                this.notificationClass = 'vue-notification success'
                    this.$notify({
                      group: 'foo',
                      title: 'Success',
                      text: 'Logout request successful'
                    })
                    let self = this
                    setTimeout(function(){
                      self.$router.push({path: '/api/login'})
                    }, 3000)
          })
      },

      authUser(){
        User.auth().then(response => {
          this.$store.commit('user/AUTH_USER', response.data)
          // this.user = response.data
          // console.log(response.data)
        })
      },
      removeProductInCart(product){
          this.$store.dispatch('cart/removeProductInCart', product)
      },
      emptyCart(){
           return (this.cart.length < 1)
      },
    },
    computed: {
      user(){
        return this.$store.getters['user/AUTH_USER']
      },
      categories(){
          return this.$store.getters['category/categoryListAll']
      },
      cartCount(){
          return this.$store.getters['cart/cartCountItem']
      },
      wishlistCount(){
          return this.$store.getters['wishlist/wishlistCount']
      },
      cart(){
			return this.$store.getters['cart/getCartItem']
		},
      totalCartPrice(){
            return this.$store.getters['cart/cartTotalPrice']
        }
    },
    mounted(){
      this.authUser()
      this.activecategoryListAll()
      this.$store.dispatch('cart/getStoredCartItems')
    },
    watch: {
      
    }
}
</script>
