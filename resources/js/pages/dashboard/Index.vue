<template>
    
    <section class="content">
      <h3>Dashboard</h3>
      <div class="row">
        <div class="col-md-3">
          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img v-if="previewPhoto" class="profile-user-img img-responsive img-circle gambar" :src="previewPhoto" style="width: 150px;height: 150px" alt="User profile picture">
              <img v-if="!previewPhoto" class="profile-user-img img-responsive img-circle gambar" :src="'/image/default/blank.jpg'" style="width: 150px;height: 150px" alt="User profile picture">

              <h3 class="profile-username text-center" v-text="form.name"></h3>

              <ul class="list-group list-group-unbordered">
                
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Detail Information</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <strong><i class="fa fa-sticky-note-o margin-r-5"></i> Email</strong>

              <p class="text-muted" v-text="form.email">s</p>

              <hr>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
</template>
<script>
export default {
    data(){
        return {
            test: 'ss',
            previewPhoto: null,
            photo: null,
            form: {},
        }
    },
    watch : {
        '$route':'getProfile',
    },
    mounted() {
        this.getProfile()
    },
    methods: {
        getProfile(){
            
          this.form = JSON.parse(localStorage.getItem('user'))
          var user = JSON.parse(localStorage.getItem('user'))
          if(user.photo){
                this.previewPhoto = '/image/profile/' + user.photo
            }else{
                this.previewPhoto = '/image/default/blank.jpg'
            }
        },
        
    }
}
</script>