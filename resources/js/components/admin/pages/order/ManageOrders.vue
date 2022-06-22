<template>
<div id="orders">
    <div class="az-content-body pd-lg-l-40 d-flex flex-column">
      <div class="container">
        <div class="az-content-body">
          <div class="az-dashboard-one-title">
            <div>
              <h2 class="az-dashboard-title">Order Number #{{ this.$route.params.order_id }}</h2>
              <!-- <p class="az-dashboard-text">Your web analytics dashboard template.</p> -->
            </div>
            <div class="az-content-header-right">
              <div class="media">
                <div class="media-body">
                  <label>Order Date</label>
                  <h6>Oct 10, 2018</h6>
                </div><!-- media-body -->
              </div><!-- media -->
              <div class="media">
                <div class="media-body">
                  <label>Expected Date</label>
                  <h6>Oct 23, 2018</h6>
                </div><!-- media-body -->
              </div><!-- media -->
              <div class="media">
                <div class="media-body">
                  <label>Event Category</label>
                  <h6>All Categories</h6>
                </div><!-- media-body -->
              </div><!-- media -->
              <a href="" class="btn btn-purple">Export</a>
            </div>
          </div><!-- az-dashboard-one-title -->

          <div class="az-dashboard-nav"> 
            <nav class="nav">
              <a class="nav-link active" data-toggle="tab" href="#">Overview</a>
              <a class="nav-link" data-toggle="tab" href="#">Audiences</a>
              <a class="nav-link" data-toggle="tab" href="#">Demographics</a>
              <a class="nav-link" data-toggle="tab" href="#">More</a>
            </nav>

            <nav class="nav">
              <a class="nav-link" href="#"><i class="far fa-save"></i> Save Report</a>
              <a class="nav-link" href="#"><i class="far fa-file-pdf"></i> Export to PDF</a>
              <a class="nav-link" href="#"><i class="far fa-envelope"></i>Send to Email</a>
              <a class="nav-link" href="#"><i class="fas fa-ellipsis-h"></i></a>
            </nav>
          </div>

          <div class="row row-sm mg-b-20 mg-lg-b-0">
            <div class="col-lg-12 col-xl-12 mg-t-20 mg-lg-t-0">
              <div class="card card-table-one">
                <h6 class="card-title mb5">Order Details</h6>
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th class="text-center">SL</th>
                        <th class="text-center">Product Name</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Price</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="text-center">1</td>
                        <td class="text-center"><strong>Vanilla Cake</strong></td>
                        <td class="text-center">2</td>
                        <td class="text-center">$ 40,000</td>
                      </tr>
                      <tr>
                        <td class="text-center">2</td>
                        <td class="text-center"><strong>Chocolate Cake</strong></td>
                        <td class="text-center">3</td>
                        <td class="text-center">$ 550,000</td>
                      </tr>
                      <tr>
                        <td class="text-center">3</td>
                        <td class="text-center"><strong>Strawberry Cake</strong></td>
                        <td class="text-center">4</td>
                        <td class="text-center">$ 60,000</td>
                      </tr>
                    </tbody>
                  </table>
                </div><!-- table-responsive -->
              </div><!-- card -->
            </div><!-- col-lg -->

          </div><!-- row -->
          <div class="row row-sm mg-b-20 mg-lg-b-0 mt-5">
            <div class="col-lg-6 col-xl-6 mg-t-20 mg-lg-t-0">
              <div class="card card-table-one">
                <h6 class="card-title mb5">User Details</h6>
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th class="text-center">Title</th>
                        <th class="text-center">Data</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="text-center">1</td>
                        <td class="text-center"><strong>Vanilla Cake</strong></td>
                      </tr>
                    </tbody>
                  </table>
                </div><!-- table-responsive -->
              </div><!-- card -->
            </div><!-- col-lg -->

            <div class="col-lg-6 col-xl-6 mg-t-20 mg-lg-t-0">
              <div class="card card-table-one">
                <h6 class="card-title mb5">Shipping Details</h6>
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th class="text-center">Title</th>
                        <th class="text-center">Data</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="text-center">Name</td>
                        <td class="text-center"><strong>Mercy Mwende Muthama</strong></td>
                      </tr>
                      <tr>
                        <td class="text-center">Email</td>
                        <td class="text-center"><strong>mercymwende@gmail.com</strong></td>
                      </tr>
                    </tbody>
                  </table>
                </div><!-- table-responsive -->
              </div><!-- card -->
            </div><!-- col-lg -->

          </div><!-- row -->
        </div><!-- az-content-body -->
      </div>
    </div>
</div>
</template>

<script>
export default {
    name: 'ManageOrders',
    data(){
      return {}
    },
    methods: {
      getSpecificUserOrder(){
        this.$store.dispatch('order/getSpecificUserOrder', this.$route.params.order_id)
      }
    },
    computed: {
      orders(){
        return this.$store.getters['order/getSpecificUserOrder']
      }
    },
    mounted(){
      this.getSpecificUserOrder()
    }
}
</script>