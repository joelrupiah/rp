<template>
    <div id="admin_navbar">
      <div class="navbar-expand-md">
        <div class="collapse navbar-collapse" id="navbar-menu">
          <div class="navbar navbar-light">
            <div class="container-xl">
              <ul class="navbar-nav">
                <li class="nav-item active">
                  <a class="nav-link" href="/api/admin" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="5 12 3 12 12 3 21 12 19 12" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                    </span>
                    <span class="nav-link-title">
                      Home
                    </span>
                  </a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
	                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" 
                      stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="9" cy="7" r="4" />
                      <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 3.13a4 4 0 0 1 0 7.75" />
                      <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                    </svg>
                    </span>
                    <span class="nav-link-title">
                      User Management
                    </span>
                  </a>
                  <div class="dropdown-menu">
                    <div class="dropdown-menu-columns">
                      <div class="dropdown-menu-column">
                        <router-link class="dropdown-item" :to="{name: 'PermissionList'}" >
                          Permissions List
                        </router-link>
                      </div>
                      <div class="dropdown-menu-column">
                        <router-link class="dropdown-item" :to="{name: 'RoleList'}" >
                          Roles List
                        </router-link>
                      </div>
                      <div class="dropdown-menu-column">
                        <router-link class="dropdown-item" :to="{name: 'UserList'}" >
                          User List
                        </router-link>
                      </div>
                      <div class="dropdown-menu-column">
                        <router-link class="dropdown-item" :to="{name: 'AdminList'}" >
                          Admin List
                        </router-link>
                      </div>
                    </div>
                  </div>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
	                  <!-- Download SVG icon from http://tabler-icons.io/i/layout-grid-add -->
	                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" 
                      stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="4" y="4" width="6" height="6" rx="1" />
                      <rect x="14" y="4" width="6" height="6" rx="1" /><rect x="4" y="14" width="6" height="6" rx="1" />
                      <path d="M14 17h6m-3 -3v6" />
                    </svg>
                    </span>
                    <span class="nav-link-title">
                      Product Management
                    </span>
                  </a>
                  <div class="dropdown-menu">
                    <div class="dropdown-menu-columns">
                      <div class="dropdown-menu-column">
                        <router-link class="dropdown-item" :to="{name: 'AdminCategory'}" >
                          Category List
                        </router-link>
                      </div>
                      <div class="dropdown-menu-column">
                        <router-link class="dropdown-item" :to="{name: 'ProductList'}" >
                          Product List
                        </router-link>
                        <router-link class="dropdown-item" :to="{name: 'CreateProduct'}" >
                          Create Product
                        </router-link>
                        <a class="dropdown-item" href="./markdown.html" >
                          Edit Product
                        </a>
                      </div>
                    </div>
                  </div>
                </li>
                <li class="nav-item">
                  <router-link class="nav-link" :to="{name: 'OrderList'}" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                      <!-- Download SVG icon from http://tabler-icons.io/i/file-invoice -->
	                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" 
                      stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" />
                      <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                      <line x1="9" y1="7" x2="10" y2="7" /><line x1="9" y1="13" x2="15" y2="13" />
                      <line x1="13" y1="17" x2="15" y2="17" />
                    </svg>
                    </span>
                    <span class="nav-link-title">
                      Orders
                    </span>
                  </router-link>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
</template>

<script>
export default {
    name: 'AdminNavbar',
    
}
</script>