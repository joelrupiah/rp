<template>
<div id="user_login">
            <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0"
             v-if="!['UserLogin', 'UserRegister'].includes($route.name)">
             <notifications group="registerlogin" :classes="notificationClass" />
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Authentication</li>
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->
            <div class="login-page bg-image pt-8 pb-8 pt-md-12 pb-md-12 pt-lg-17 pb-lg-17" style="background-image: url('/frontend/assets/images/backgrounds/login-bg.jpg')">
            	<div class="container">
            		<div class="form-box">
            			<div class="form-tab">
	            			<ul class="nav nav-pills nav-fill" role="tablist">
							    <li class="nav-item">
							        <a class="nav-link" id="signin-tab-2" data-toggle="tab" href="#signin-2" role="tab" aria-controls="signin-2" aria-selected="false">Login</a>
							    </li>
							    <li class="nav-item">
							        <a class="nav-link active" id="register-tab-2" data-toggle="tab" href="#register-2" role="tab" aria-controls="register-2" aria-selected="true">Register</a>
							    </li>
							</ul>
							<div class="tab-content">

                <!-- LOGIN -->
							    <div class="tab-pane fade" id="signin-2" role="tabpanel" aria-labelledby="signin-tab-2">
							    	<form @submit.prevent="login">
							    		<div class="form-group">
							    			<label for="singin-email-2">Email address *</label>
							    			<input type="text" class="form-control" id="singin-email-2" 
                        v-model="loginform.email" name="singin-email">
							    		</div>
                      <span v-if="loginerrors.email">
                        <p class="text-danger">{{ loginerrors.email[0] }}</p>
                      </span><!-- End .form-group -->

							    		<div class="form-group">
							    			<label for="singin-password-2">Password *</label>
							    			<input type="password" class="form-control" id="singin-password-2" 
                        v-model="loginform.password" name="singin-password">
							    		</div>
                      <span v-if="loginerrors.password">
                        <p class="text-danger">{{ loginerrors.password[0] }}</p>
                      </span><!-- End .form-group -->

							    		<div class="form-footer">
							    			<button type="submit" class="btn btn-outline-primary-2">
			                					<span>LOG IN</span>
			            						<i class="icon-long-arrow-right"></i>
			                				</button>

			                				<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input" id="signin-remember-2">
												<label class="custom-control-label" for="signin-remember-2">Remember Me</label>
											</div><!-- End .custom-checkbox -->

											<router-link :to="{name: 'ResetPassword'}" class="forgot-link">
                        Forgot Your Password?</router-link>
							    		</div><!-- End .form-footer -->
							    	</form>
							    	<div class="form-choice">
								    	<p class="text-center">or sign in with</p>
								    	<div class="row">
								    		<div class="col-sm-6">
								    			<a href="#" class="btn btn-login btn-g">
								    				<i class="icon-google"></i>
								    				Login With Google
								    			</a>
								    		</div><!-- End .col-6 -->
								    		<div class="col-sm-6">
								    			<a href="#" class="btn btn-login btn-f">
								    				<i class="icon-facebook-f"></i>
								    				Login With Facebook
								    			</a>
								    		</div><!-- End .col-6 -->
								    	</div><!-- End .row -->
							    	</div><!-- End .form-choice -->
							    </div><!-- .End .tab-pane -->

                <!-- END LOGIN -->

                <!-- REGISTER -->
							    <div class="tab-pane fade show active" id="register-2" role="tabpanel" aria-labelledby="register-tab-2">
							    	<form @submit.prevent="register">
							    		<div class="form-group">
							    			<label for="register-name-2">Your full name <strong style="color:red">*</strong></label>
							    			<input type="name" class="form-control" id="register-name-2" 
                        v-model="registerform.name" name="register-name">
							    		</div>
                      <span v-if="registererrors.name">
                        <p class="text-danger">{{ registererrors.name[0] }}</p>
                      </span><!-- End .form-group -->

                      <div class="form-group">
							    			<label for="register-email-2">Your email address <strong style="color:red">*</strong></label>
							    			<input type="email" class="form-control" id="register-email-2" 
                        v-model="registerform.email" name="register-email">
							    		</div>
                      <span v-if="registererrors.email">
                        <p class="text-danger">{{ registererrors.email[0] }}</p>
                      </span><!-- End .form-group -->

                      <div class="form-group">
							    			<label for="register-email-2">Your phone number <strong style="color:red">*</strong></label>
							    			<input type="phone" class="form-control" id="register-phone-2" 
                        v-model="registerform.phone" name="register-phone">
							    		</div>
                      <span v-if="registererrors.phone">
                        <p class="text-danger">{{ registererrors.phone[0] }}</p>
                      </span><!-- End .form-group -->

							    		<div class="form-group">
							    			<label for="register-password-2">Password <strong style="color:red">*</strong></label>
							    			<input type="password" class="form-control" id="register-password-2" 
                        v-model="registerform.password" name="register-password">
							    		</div>
                      <span v-if="registererrors.password">
                        <p class="text-danger">{{ registererrors.password[0] }}</p>
                      </span><!-- End .form-group -->

                      <div class="form-group">
							    			<label for="register-password-confirm-2">Confirm Password <strong style="color:red">*</strong></label>
							    			<input type="password" class="form-control" id="register-password-confirm-2" 
                        v-model="registerform.password_confirmation" name="register-password-confirm">
							    		</div>
                      <span v-if="registererrors.password_confirmation">
                        <p class="text-danger">{{ registererrors.password_confirmation[0] }}</p>
                      </span><!-- End .form-group -->

							    		<div class="form-footer">
							    			<button type="submit" class="btn btn-outline-primary-2">
			                					<span>SIGN UP</span>
			            						<i class="icon-long-arrow-right"></i>
			                				</button>

			                				<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input" id="register-policy-2">
												<label class="custom-control-label" for="register-policy-2">I agree to the <a href="#">privacy policy</a> *</label>
											</div><!-- End .custom-checkbox -->
							    		</div><!-- End .form-footer -->
							    	</form>
							    	<div class="form-choice">
								    	<p class="text-center">or sign in with</p>
								    	<div class="row">
								    		<div class="col-sm-6">
								    			<a href="#" class="btn btn-login btn-g">
								    				<i class="icon-google"></i>
								    				Login With Google
								    			</a>
								    		</div><!-- End .col-6 -->
								    		<div class="col-sm-6">
								    			<a href="#" class="btn btn-login  btn-f">
								    				<i class="icon-facebook-f"></i>
								    				Login With Facebook
								    			</a>
								    		</div><!-- End .col-6 -->
								    	</div><!-- End .row -->
							    	</div><!-- End .form-choice -->
							    </div><!-- .End .tab-pane -->

                <!-- END REGISTER -->
							</div><!-- End .tab-content -->
						</div><!-- End .form-tab -->
            		</div><!-- End .form-box -->
            	</div><!-- End .container -->
            </div><!-- End .login-page section-bg -->
</div>
</template>

<script>
import User from '../../../../apis/user/User'

export default {
  name: "UserLogin",
  data() {
    return {
      notificationClass: null,
      loginform: {
        email: "",
        password: "",
      },
      registerform: {
        name: "",
        email: "",
        phone: "",
        password: "",
        password_confirmation: "",
      },
      loginerrors: [],
      registererrors: []
    };
  },
  methods: {
      login(){
        User.login(this.loginform)
          .then(response => {
            this.$store.commit('user/LOGIN', true)
            localStorage.setItem("token", response.data)
                this.notificationClass = 'vue-notification success'
                    this.$notify({
                      group: 'registerlogin',
                      title: 'Success',
                      text: 'Login request successful'
                    })
                    let self = this
                    setTimeout(function(){
                      // self.$router.push({path: '/api'})
                      window.location.href = '/api'
                    }, 3000)
            // this.$router.push({name: 'Home'})
          })
          .catch(error =>{
            if (error.response.status === 422) {
              this.loginerrors = error.response.data.errors
            }
            this.notificationClass = 'vue-notification warn'
                    this.$notify({
                      group: 'registerlogin',
                      title: 'Error',
                      text: 'Login request failed, check your credentials or contact customer support'
                    })
          })
      },
      register(){
            User.register(this.registerform)
              .then(() => {
                this.notificationClass = 'vue-notification success'
                    this.$notify({
                      group: 'registerlogin',
                      title: 'Success',
                      text: 'Registration request successful, login to continue'
                    })
                    let self = this
                    setTimeout(function(){
                      self.$router.push({path: '/api/login'})
                    }, 3000)
              })
              .catch(error => {
                if (error.response.status === 422) {
                  this.registererrors = error.response.data.errors
                }
                this.notificationClass = 'vue-notification warn'
                    this.$notify({
                      group: 'registerlogin',
                      title: 'Error',
                      text: 'Registration request failed, check your credentials and try again'
                    })
              })
        
      }
  },
  created() {},
  computed: {},
};
</script>

