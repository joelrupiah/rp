<template>
  <div class="az-content-body pd-lg-l-40 d-flex flex-column">
    <div class="az-content-breadcrumb mb-5">
      <span>Components</span>
      <span>UI Elements</span>
      <span>Buttons</span>
    </div>

    <div class="d-flex justify-content-between">
      <div class="az-content-label mg-b-5">Users Table</div>

      <div class="center">
        <router-link :to="{ name: 'CreateUser' }"
          ><vs-button square> Add User </vs-button></router-link
        >
      </div>
    </div>

    <div class="table-responsive">
      <table class="table table-hover mg-b-0">
        <thead>
          <tr>
            <th>SL</th>
            <th>User Name</th>
            <th>Date Joined</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(user, index) in users.data" :key="user.id">
            <th scope="row">{{ index+1 }}</th>
            <td>
              {{ user.name }}
            </td>
            <td>
              {{ user.created_at | time }}
            </td>
            <td>
              <a class="ml-1">
                <i class="fas fa-pen" style="color: #00ff00"></i>
              </a>
              <a class="ml-1">
                <i class="fas fa-times" style="color: #ff0000"></i>
              </a>
            </td>
          </tr>
        </tbody>
      </table>
      <Paginator v-if="users != null" v-bind:users="users" v-on:get-page="getPage"></Paginator>
    </div>
    <!-- table-responsive -->
  </div>
  <!-- az-content-body -->
</template>

<script>
import Api from "../../../../apis/admin/Api";
import Paginator from '../../utilities/pagination/Paginator.vue'
export default {
  name: "UserList",
  components: {
      Paginator
  },
  data() {
    return {
        users: [],
        params: {
            page: 1
        }
    };
  },
  methods: {
    userList(){
        Api().get('/admin/get-users', {params: this.params})
            .then(response => {
                this.users = response.data.users
            })
    },
    getPage(event){
        this.params.page = event
        this.userList()
    }
  },
  created() {
      this.userList()
  },
  computed: {
    
  },
};
</script>

