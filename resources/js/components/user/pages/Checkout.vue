<template>
<div id="user_checkout">
<div class="page-header text-center" style="background-image: url('/frontend/assets/images/page-header-bg.jpg')">
    <notifications group="foo" :classes="notificationClass" />
				<div class="container">
        			<h1 class="page-title">Checkout<span>Shop</span></h1>
        		</div><!-- End .container -->
        	</div><!-- End .page-header -->
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="page-content">
            	<div class="checkout">
	                <div class="container">
            			<div class="checkout-discount">
            				<form action="#">
        						<input type="text" class="form-control" required id="checkout-discount-input">
            					<label for="checkout-discount-input" class="text-truncate">Have a coupon? <span>Click here to enter your code</span></label>
            				</form>
            			</div><!-- End .checkout-discount -->
            			<form action="#">
		                	<div class="row">
		                		<div class="col-lg-9">
		                			<h2 class="checkout-title">Billing Details</h2><!-- End .checkout-title -->
		                				<div class="row">
		                					<div class="col-sm-6">
		                						<label>First Name *</label>
		                						<input type="text" class="form-control"
												v-model="form.firstName" required>
		                					</div><!-- End .col-sm-6 -->

		                					<div class="col-sm-6">
		                						<label>Last Name *</label>
		                						<input type="text" class="form-control"
												v-model="form.lastName" required>
		                					</div><!-- End .col-sm-6 -->
		                				</div><!-- End .row -->

	            						<label>Company Name (Optional)</label>
	            						<input type="text" class="form-control"
										v-model="form.company">

	            						<label>Country *</label>
	            						<input type="text" class="form-control" 
										v-model="form.country" required>

	            						<label>Expected Date *</label>
										<el-date-picker v-model="form.expected_date"
										type="date" placeholder="Pick a day">

										</el-date-picker>
	            						
	            						<div class="row">
		                					<div class="col-sm-6">
		                						<label>Town / City *</label>
		                						<input type="text" class="form-control"
												v-model="form.city" required>
		                					</div><!-- End .col-sm-6 -->

		                					<div class="col-sm-6">
		                						<label>State / County *</label>
		                						<input type="text" class="form-control"
												v-model="form.county" required>
		                					</div><!-- End .col-sm-6 -->
		                				</div><!-- End .row -->

		                				<div class="row">
		                					<div class="col-sm-6">
		                						<label>Postcode / ZIP *</label>
		                						<input type="text" class="form-control"
												v-model="form.postCode" required>
		                					</div><!-- End .col-sm-6 -->

		                					<div class="col-sm-6">
		                						<label>Phone *</label>
		                						<input type="tel" class="form-control"
												v-model="form.phone" required>
		                					</div><!-- End .col-sm-6 -->
		                				</div><!-- End .row -->

	                					<label>Email address *</label>
	        							<input type="email" class="form-control"
										v-model="form.email" required>

	                					<label>Order notes (optional)</label>
	        							<textarea class="form-control" cols="30" rows="4" v-model="form.description"
										placeholder="Notes about your order, e.g. special notes for delivery"></textarea>
		                		</div><!-- End .col-lg-9 -->
		                		<aside class="col-lg-3">
		                			<div class="summary">
		                				<h3 class="summary-title">Your Order</h3><!-- End .summary-title -->

		                				<table class="table table-summary">
		                					<thead>
		                						<tr>
		                							<th>Product</th>
		                							<th>Total</th>
		                						</tr>
		                					</thead>

		                					<tbody>
		                						<tr v-for="(item, index) in cart" :key="index">
		                							<td><a href="#">{{ item.product.title }}</a></td>
		                							<td>${{ item.product.price }}</td>
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
		                						<tr class="summary-subtotal">
		                							<td>Subtotal:</td>
		                							<td>${{ totalCartPrice }}</td>
		                						</tr><!-- End .summary-subtotal -->
		                						<tr>
		                							<td>Shipping:</td>
		                							<td>Free shipping</td>
		                						</tr>
		                						<tr class="summary-total">
		                							<td>Total:</td>
		                							<td>${{ totalCartPrice }}</td>
		                						</tr><!-- End .summary-total -->
		                					</tbody>
		                				</table><!-- End .table table-summary -->

		                				<div class="accordion-summary" id="accordion-payment">
										    <div class="card">
										        <div class="card-header" id="heading-1">
										            <h2 class="card-title">
														<div class="custom-control custom-checkbox">
															<input type="checkbox" class="custom-control-input" 
															v-model="payment.cash_on_delivery" id="cashpayment">
															<label class="custom-control-label" 
																for="cashpayment">
																Cash On Delivery
															</label>
														</div>
										                <!-- <a role="button" data-toggle="collapse" href="#collapse-1" aria-expanded="true" aria-controls="collapse-1">
										                    Direct bank transfer
										                </a> -->
										            </h2>
										        </div><!-- End .card-header -->
										    </div><!-- End .card -->

										    <div class="card">
										        <div class="card-header" id="heading-2">
										            <h2 class="card-title">
														<div class="custom-control custom-checkbox">
															<input type="checkbox" class="custom-control-input" 
															v-model="payment.mpesa" id="mpesapayment">
															<label class="custom-control-label" 
																for="mpesapayment">
																Mpesa
															</label>
														</div>
										            </h2>
										        </div><!-- End .card-header -->
										    </div><!-- End .card -->

										    <div class="card">
										        <div class="card-header" id="heading-3">
										            <h2 class="card-title">
														<div class="custom-control custom-checkbox">
															<input type="checkbox" class="custom-control-input" 
															v-model="payment.paypal" id="paypalpayment">
															<label class="custom-control-label" 
																for="paypalpayment">
																Paypal
															</label>
														</div>
										            </h2>
										        </div><!-- End .card-header -->
										    </div><!-- End .card -->

										    <div class="card">
										        <div class="card-header" id="heading-4">
										            <h2 class="card-title">
														<div class="custom-control custom-checkbox">
															<input type="checkbox" class="custom-control-input" 
															v-model="payment.card" id="cardpayment">
															<label class="custom-control-label" 
																for="cardpayment">
																Card
															</label>
														</div>
										            </h2>
										        </div><!-- End .card-header -->
										    </div><!-- End .card -->
										</div><!-- End .accordion -->

		                				<button type="submit" @click.prevent="completeOrder()"
										class="btn btn-outline-primary-2 btn-order btn-block">
		                					<span class="btn-text">Place Order</span>
		                					<span class="btn-hover-text">Complete Payment</span>
		                				</button>
		                			</div><!-- End .summary -->
		                		</aside><!-- End .col-lg-3 -->
		                	</div><!-- End .row -->
            			</form>
	                </div><!-- End .container -->
                </div><!-- End .checkout -->
            </div><!-- End .page-content -->
</div>
</template>

<script>
import UserApi from '../../../apis/user/Api'
export default {
    name: 'Checkout',
	data(){
		return {
      		notificationClass: null,
			payment: {
				cash_on_delivery: null,
				mpesa: null,
				paypal: null,
				card: null
			},
			form: {
				firstName: '',	
				lastName: '',	
				email: '',	
				country: '',
				company: '',
				county: '',	
				postCode: '',
				phone: '',	
				description: '',
				expected_date: ''
			}
		}
	},
	methods: {
		completeOrder(){
			UserApi().post('user/checkout', {
				form: this.form,
				payment: this.payment, 
				total:this.totalCartPrice,
				cart:this.cart
			})
			.then(() => {
				this.notificationClass = 'vue-notification success'
                this.$notify({
                    group: 'foo',
                    title: 'Success',
                    text: 'Order request successful. Check your order reference code for easier tracking'
                })
                let self = this
                setTimeout(function(){
                    // self.$router.push({path: '/api/account'})
					// window.location.href = '/api/account'
                }, 3000)
			})
			.catch(() =>{
				
			})
			
		},
		emptyCart(){
			return (this.cart.length < 1)
		}
	},
	computed: {
		cart(){
			return this.$store.getters['cart/getCartItem']
		},
		totalCartPrice(){
            return this.$store.getters['cart/cartTotalPrice']
        }
	}
}
</script>
