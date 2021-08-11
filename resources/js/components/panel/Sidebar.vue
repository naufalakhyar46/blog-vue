<template>
    <header class="main-header">
    <!-- Logo -->
    <router-link :to="{ name: 'Dashboard' }" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">{{ konfig.nama_dashboard_singkatan }}</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">{{ konfig.nama_dashboard }}</span>
    </router-link>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img v-if="isPhoto" :src="'/image/profile/' + user.photo" style="width: 21px; height:21px; " class="img-circle" alt="User Image">
              <img v-if="!isPhoto" :src="'/image/default/blank.jpg'" style="width: 21px; height:21px; " class="img-circle" alt="User Image">
              <span class="hidden-xs">&nbsp; {{ user.name }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img v-if="isPhoto" :src="'/image/profile/' + user.photo" style="width: 80px; height:80px; " class="img-circle" alt="User Image">
                <img v-if="!isPhoto" :src="'/image/default/blank.jpg'" style="width: 80px; height:80px; " class="img-circle" alt="User Image">

                <p>
                  {{ user.name }}
                </p>
              </li>
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <router-link :to="{ name: 'Profile' }" class="btn btn-default btn-flat">Profile</router-link>
                </div>
                <br><br>
                <div class="pull-left">
                  <router-link :to="{ name: 'ChangePass' }" class="btn btn-default btn-flat">Change Password</router-link>
                </div>
                <div class="pull-right">
                  <a href="#" class="btn btn-default btn-flat" data-toggle="modal" data-target="#logout">Logout</a>
                </div>
              </li>
            </ul>
          </li>
          <li>
                  <a @click="home" class="pull-right" role="button" title="Home">
                    <i class="fa fa-globe"></i>
                  </a>
              </li>
              
        </ul>
      </div>
    </nav>
     
  </header>
 
</template>
<script>
export default {
    data(){
        return { 
         user: {},
         konfig: {},
         isLoggedIn: null, 
         isPhoto: null, 
        }
    },
    watch : {
        '$route':'getData',
        '$route':'getKonfig',
    },
    mounted() {
      this.getData() 
      this.getKonfig()
    }, 
    methods : {  
      getData(){
          this.isLoggedIn = localStorage.getItem('jwt') !== null; 
          this.user = JSON.parse(localStorage.getItem('user'))
          this.isPhoto = this.user.photo !== null;
      },
      getKonfig(){
            axios.defaults.headers.common['Content-Type'] = 'application/json'
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('jwt')
            axios.get('/api/konfigurasi/show').then((response) => {
                this.konfig = response.data;
            })
        },
      logout(){
          axios.defaults.headers.common['Content-Type'] = 'application/json'
          axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('jwt')
          axios.get('api/logout').then((response) => {
                  localStorage.removeItem('jwt')
                  localStorage.removeItem('user')
                    this.getData()  
                    this.$router.push('/')
                    this.$noty.success(response.data.message, {
                        killer: true,
                        timeout: 6000,
                        layout: 'topRight'
                    })
            }).catch((error) => {
                // console.log(error)
            })
      },
      home(){
        window.location.href= '/';
      }
    }
  }
</script>