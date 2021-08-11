<template>
<section class="content">
      <form id="form-profile" @submit.prevent="handleSubmit" method="post" enctype="multipart/form-data">
        <div class="row">
          <!-- konten -->
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
          	<div class="box-header">
                  <h3 class="box-title">Setting Information</h3>
                </div>
            <div class="box-body">
              <!-- konten -->
              <div class="form-horizontal">
              	<div class="form-group">
		            <div class="col-md-2">
		                <label for="" class="control-label">Nama</label>
		            </div>
		            <div class="col-md-10">
		                <input type="text" name="name" class="form-control" v-model="form.name" placeholder="Nama Lengkap...." >
		            </div>
		        </div>
            
		        <div class="form-group">
		            <div class="col-md-2">
		                <label for="" class="control-label">Email</label>
		            </div>
		            <div class="col-md-10">
		                <input type="email" name="email" v-model="form.email"  class="form-control" placeholder="Email....">
		            </div>
		        </div>
		        	<button type="submit" class="btn btn-success pull-right"><span class="fa fa-save"></span> Simpan</button>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        </div>
    </form>

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
            let formData = new FormData($('#form-profile')[0])
            formData.append('photo',this.photo)
            axios.post('/api/pengguna/profile/' + this.form.id, formData).then((response) => {
              this.$noty.success(response.data.message, {
                        killer: true,
                        timeout: 6000,
                        layout: 'topRight'
                    })
            }).catch((error) => {
              //
            })
        }
    }
}
</script>