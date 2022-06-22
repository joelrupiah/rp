<template>
  <div class="page-wrapper">
    <div class="container-xl">
      <!-- Page title -->
      <div class="page-header d-print-none">
        <div class="row align-items-center mb-3">
          <div class="col">
            <h2 class="page-title">Order List</h2>
          </div>
        </div>
      </div>
    </div>
    <div class="page-body">
      <div class="container-xl">
        <div class="row row-cards">
          <div class="col-12">
            <div class="card">
              <div class="table-responsive">
                <table class="table table-vcenter card-table">
                  <thead>
                    <tr>
                      <th>Order ID</th>
                      <th>Porter Name</th>
                      <th>Status</th>
                      <th>Total</th>
                      <th>Order Date</th>
                      <th>Expected Date</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="order in orders" :key="order.id">
                      <td>{{ order.order_id }}</td>
                      <td class="text-muted">
                        <router-link
                          :to="`/api/admin/user-${order.user.id}/orders`"
                        >
                          {{ order.user.name }}
                        </router-link>
                      </td>
                      <td class="text-muted">
                        <span :class="statusColor(order.status)">
                          {{ order.status | capitalize }}
                        </span>
                      </td>
                      <td class="text-muted">
                        {{ order.total }}
                      </td>
                      <td class="text-muted">
                        {{ order.updated_at | time }}
                      </td>
                      <td class="text-muted">
                        {{ order.shipping.expected_date | time }}
                      </td>
                      <td class="text-muted">
                        <router-link
                          :to="`/api/admin/orders/manage-order/${order.order_id}`"
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
                          :to="`/api/admin/orders/order-details/${order.order_id}`"
                          class="ml-1"
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
                        <!-- <div class="col-auto">
                        <div class="dropdown">
                          <a href="#" class="card-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="19" r="1"></circle><circle cx="12" cy="5" r="1"></circle></svg>
                          </a>
                          <div class="dropdown-menu dropdown-menu-end" style="">
                            <a href="#" class="dropdown-item">Import</a>
                            <a href="#" class="dropdown-item">Export</a>
                            <a href="#" class="dropdown-item">Download</a>
                            <a href="#" class="dropdown-item">Another action</a>
                          </div>
                        </div>
                      </div> -->
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  title: "OrderList",
  data() {
    return {};
  },

  methods: {
    getOrders: async function () {
      await this.$store.dispatch("order/getAllUserOrders");
    },
    statusColor(status) {
      let data = {
        pending: "badge badge-info",
        processing: "badge badge-primary",
        delivering: "badge badge-warning",
        complete: "badge badge-success",
        cancelled: "badge badge-danger",
      };
      return data[status];
    },
  },

  computed: {
    orders() {
      return this.$store.getters["order/getAllOrders"];
    },
  },

  mounted() {
    this.getOrders();
  },
};
</script>

