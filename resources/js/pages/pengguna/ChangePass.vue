<template>
<section class="content">
        <div class="row">
              <form @submit.prevent="handleSubmit" method="post" enctype="multipart/form-data">
<div class="col-md-3">
          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img v-if="previewPhoto" class="profile-user-img img-responsive img-circle gambar" :src="previewPhoto" style="width: 150px;height: 150px" alt="User profile picture">
              <img v-if="!previewPhoto" class="profile-user-img img-responsive img-circle gambar" :src="'/image/default/blank.jpg'" style="width: 150px;height: 150px" alt="User profile picture">

              <h3 class="profile-username text-center" v-text="form.name"></h3>

              <ul class="list-group list-group-unbordered">
                
              </ul>
              <label for="image" class="btn btn-primary btn-block"><span class="fa fa-image"></span> Change Image</label>
              <input type="file" id="image" name="image" accept="image/*" style="display: none" @change="upload">
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
        <div class="col-md-9">
          <div class="box">
          	
            <div class="box-body">
              <!-- konten -->
              <div class="form-horizontal">
              	
              	<div class="form-group">
		            <div class="col-md-3">
		                <label for="" class="control-label">*Password Lama</label>
		            </div>
		            <div class="col-md-9">
		                <input type="password" name="password_lama" v-model="data.password_lama" class="form-control" placeholder="Password Lama" required="">
		            </div>
		        </div>
		        <div class="form-group">
		            <div class="col-md-3">
		                <label for="" class="control-label">*Password Baru</label>
		            </div>
		            <div class="col-md-9">
		                <input type="password" name="password_baru" v-model="data.password_baru" class="form-control" placeholder="Password Baru" required="">
		            </div>
		        </div>
		        <div class="form-group">
		            <div class="col-md-3">
		                <label for="" class="control-label">*Ulangi Password Baru</label>
		            </div>
		            <div class="col-md-9">
		                <input type="password" name="konfirmasi_password" v-model="data.konfirmasi_password" class="form-control" placeholder="Ulangi Password Baru" required="">
		            </div>
		        </div>
		        	<button type="submit" class="btn btn-success pull-right"><span class="fa fa-save"></span> Simpan</button>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
    </form>
        </div>
        <!-- /.row -->
      </section>
</template>
<script>
export default {
    data(){
        return {
            previewPhoto: null,
            photo: null,
            form: {},
            data:{
                password_lama: null,
                password_baru: null,
                konfirmasi_password: null,
            }
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
        upload(e){
           let files = e.target.files[0]
           this.previewPhoto = null
           this.previewPhoto = URL.createObjectURL(files)
           this.photo = files
        },
        handleSubmit(){
            axios.post('/api/pengguna/change-pass/' + this.form.id, this.data).then((response) => {
                if(response.data.status){
                    this.$noty.success(response.data.message, {
                        killer: true,
                        timeout: 6000,
                        layout: 'topRight'
                    })
                }else{
                    this.$noty.error(response.data.message, {
                        killer: true,
                        timeout: 6000,
                        layout: 'topRight'
                    })
                }
                this.data = {
                    password_lama: null,
                    password_baru: null,
                    konfirmasi_password: null,
                }
              
            }).catch((error) => {
              //
            })
        }
    }
}
</script>