<template>
    <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img v-if="isPhoto" :src="'/image/profile/' + user.photo" style="width: 32px; height:32px; " class="img-circle" alt="User Image">
          <img v-if="!isPhoto" :src="'/image/default/blank.jpg'" style="width: 32px; height:32px; " class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ user.name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      
      <br>
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li ><router-link :to="{ name: 'Dashboard' }"><i class="fa fa-dashboard"></i> <span>Dashboard</span></router-link></li>
        <li ><router-link  :to="{ name: 'Blog' }"><i class="fa fa-book"></i> <span>Blog</span></router-link></li>
        <li ><router-link  :to="{ name: 'Pengguna' }"><i class="fa fa-user"></i> <span>Pengguna</span></router-link></li>
        <li ><router-link  :to="{ name: 'Konfigurasi' }"><i class="fa fa-gears"></i> <span>Setting</span></router-link></li>
        <!-- <li class="treeview">
          <a href="#">
            <i class="fa fa-gears"></i> <span>Setting</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <li ><a href="#"><i class="fa fa-circle-o"></i> Landing</a></li>
          </ul>
        </li> -->
      </ul>
    </section>
    <!-- /.sidebar -->
    
  </aside>
  
</template>
<script>
export default {
    data(){
        return { 
         user: {},
         isLoggedIn: null, 
         isPhoto: null, 
        }
    },
    watch : {
        '$route':'getData',
    },
    mounted() {
      this.getData()   
    }, 
    methods : {  
      getData(){
          this.isLoggedIn = localStorage.getItem('jwt') !== null; 
          this.user = JSON.parse(localStorage.getItem('user'))
          this.isPhoto = this.user.photo !== null;
          axios.get('/get-session').then((response) => {
              // console.log(response.data.id)
              if(response.data.id == null){
                  axios.defaults.headers.common['Content-Type'] = 'application/json'
                  axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('jwt')
                  axios.get('/logout').then((response) => {
                          localStorage.removeItem('jwt')
                          localStorage.removeItem('user')
                          window.location.href= '/auth/login';
                  })
              }
          }).catch((error) => {
            //
          })
      },
     
    }
  }
</script>