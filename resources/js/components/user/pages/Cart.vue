<template>
<div id="user_cart">
<div class="page-header text-center" style="background-image: url('/frontend/assets/images/page-header-bg.jpg')">
        		<div class="container">
        			<h1 class="page-title">Shopping Cart<span>Shop</span></h1>
        		</div><!-- End .container -->
        	</div><!-- End .page-header -->
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="page-content">
            	<div class="cart">
	                <div class="container">
	                	<div class="row">
	                		<div class="col-lg-9">
	                			<table class="table table-cart table-mobile">
									<thead>
										<tr>
											<th>SL</th>
											<th>Product</th>
											<th>Price</th>
											<th>Quantity</th>
											<th>Total</th>
											<th></th>
										</tr>
									</thead>

									<tbody v-for="(item, index) in cart" :key="item.id">
										<tr>
											<td class="price-col">{{ index+1 }}</td>
											<td class="product-col">
												<div class="product">
													<figure class="product-media">
														<a href="#">
															<img src="/frontend/assets/images/products/table/product-1.jpg" alt="Product image">
														</a>
													</figure>

													<h3 class="product-title">
														<a href="#">{{ item.product.title }}</a>
													</h3><!-- End .product-title -->
												</div><!-- End .product -->
											</td>
											<td class="price-col">${{item.product.price}}</td>
											<td class="quantity-col">
                                                <div class="cart-product-quantity">
                                                    <input type="number" class="form-control" :value="item.quantity" min="1" max="10"
													 step="1" data-decimals="0" required>
                                                </div><!-- End .cart-product-quantity -->
                                            </td>
											<td class="total-col">${{ item.product.price * item.quantity }}</td>
											<td class="remove-col">
												<button class="btn-remove"><i class="icon-close" @click.prevent="removeProductInCart(item.product)"></i>
												</button>
											</td>
										</tr>
										<tr v-if="emptyCart()">
											<td colspan="6">
												<p class="text-center text-danger">
													Cart is empty please 
													<a href="/api/shop" class="text-primary">shop</a> 
													to continue
												</p>
											</td>
										</tr>
									</tbody>
								</table><!-- End .table table-wishlist -->

	                			<div class="cart-bottom">
			            			<div class="cart-discount">
			            				<form action="#">
			            					<div class="input-group">
				        						<input type="text" class="form-control" required placeholder="coupon code">
				        						<div class="input-group-append">
													<button class="btn btn-outline-primary-2" type="submit"><i class="icon-long-arrow-right"></i></button>
												</div><!-- .End .input-group-append -->
			        						</div><!-- End .input-group -->
			            				</form>
			            			</div><!-- End .cart-discount -->

			            			<a href="#" class="btn btn-outline-dark-2" @click.prevent="updateCart()">
										<span>UPDATE CART</span><i class="icon-refresh"></i>
									</a>
			            			<a href="#" class="btn btn-outline-dark-2" @click.prevent="clearCartItems()">
										<span>CLEAR CART</span><i class="icon-close"></i>
									</a>
		            			</div><!-- End .cart-bottom -->
	                		</div><!-- End .col-lg-9 -->
	                		<aside class="col-lg-3">
	                			<div class="summary summary-cart">
	                				<h3 class="summary-title">Cart Total</h3><!-- End .summary-title -->

	                				<table class="table table-summary">
	                					<tbody>
	                						<tr class="summary-subtotal">
	                							<td>Subtotal:</td>
	                							<td>${{ totalCartPrice }}</td>
	                						</tr><!-- End .summary-subtotal -->
	                						<tr class="summary-shipping">
	                							<td>Shipping:</td>
	                							<td>&nbsp;</td>
	                						</tr>

	                						<tr class="summary-shipping-row">
	                							<td>
													<div class="custom-control custom-radio">
														<input type="radio" id="free-shipping" checked name="shipping" class="custom-control-input">
														<label class="custom-control-label" for="free-shipping">Free Shipping</label>
													</div><!-- End .custom-control -->
	                							</td>
	                							<td>$0.00</td>
	                						</tr><!-- End .summary-shipping-row -->

	                						<tr class="summary-total">
	                							<td>Total:</td>
	                							<td>${{totalCartPrice}}</td>
	                						</tr><!-- End .summary-total -->
	                					</tbody>
	                				</table><!-- End .table table-summary -->

	                				<router-link :to="{name: 'Checkout'}"
										class="btn btn-outline-primary-2 btn-order btn-block">PROCEED TO CHECKOUT
									</router-link>
	                			</div><!-- End .summary -->

		            			<router-link :to="{name: 'Shop'}" class="btn btn-outline-dark-2 btn-block mb-3">
									<span>CONTINUE SHOPPING</span><i class="icon-refresh"></i>
								</router-link>
	                		</aside><!-- End .col-lg-3 -->
	                	</div><!-- End .row -->
	                </div><!-- End .container -->
                </div><!-- End .cart -->
            </div><!-- End .page-content -->
</div>
</template>

<script>
import UserApi from '../../../apis/user/Api'
export default {
    name: 'Cart',
	data(){
		return {
			
		}
	},
	methods: {
		emptyCart(){
			return (this.cart.length < 1)
		},
		updateCart(){
			UserApi().post('cart/update-cart')
		},
		removeProductInCart(product){
          this.$store.dispatch('cart/removeProductInCart', product)
		},
		clearCartItems(){
			this.$store.dispatch('cart/deleteAllCartItems')
		}
	},
	computed: {
		cart(){
				return this.$store.getters['cart/getCartItem']
			},
		totalCartPrice(){
				return this.$store.getters['cart/cartTotalPrice']
			}
	},
}
</script>
