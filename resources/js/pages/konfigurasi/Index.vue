<template>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Konfigurasi</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- konten -->
                <form @submit.prevent="handleSubmit" id="form-konfig" method="post" enctype="multipart/form-data">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <div class="col-md-2">
                                <label for="" class="control-label">Icon</label>
                            </div>
                            <div class="col-md-10">
                                <img :src="previewIcon" width="200" alt=""><br>
                                <label for="icon" class="btn btn-primary">Upload Icon</label>
                                <input type="file" id="icon" class="form-control" style="display:none" name="icon" @change="iconUpload">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-2">
                                <label for="" class="control-label">Nama Dashboard</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" name="nama_dashboard" v-model="form.nama_dashboard" class="form-control" placeholder="Inputkan Nama Dashboard" maxlength="12" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-2">
                                <label for="" class="control-label">Nama Singkatan </label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" name="nama_dashboard_singkatan" v-model="form.nama_dashboard_singkatan" class="form-control" placeholder="Inputkan Nama Singkatan Dashboard" maxlength="3" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-2">
                                <label for="" class="control-label">Nama Portal</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" name="nama_portal" class="form-control" v-model="form.nama_portal" placeholder="Inputkan Nama Portal" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-2">
                                <label for="" class="control-label">Alamat</label>
                            </div>
                            <div class="col-md-10">
                                <textarea class="form-control" name="alamat" v-model="form.alamat"  placeholder="Inputkan Alamat"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-2">
                                <label for="" class="control-label">Metatext</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" class="form-control" v-model="form.metatext"   name="metatext" placeholder="Inputkan Metatext" >
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-2">
                                <label for="" class="control-label">Deskripsi Portal</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="deskripsi" v-model="form.deskripsi"  placeholder="Inputkan Deskripsi Portal" >
                            </div>
                        </div>
                        
                       
                        <div class="form-group">
                            <div class="col-md-2">
                                <label for="" class="control-label">*Email</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" name="email"  class="form-control" v-model="form.email"  placeholder="Inputkan Email" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-2">
                                <label for="" class="control-label">Link Website</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" name="website"  class="form-control" v-model="form.website"  placeholder="Inputkan Link Website/Jika tidak ada, ketik #" >
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-2">
                                <label for="" class="control-label">Instagram</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" name="ig" class="form-control" v-model="form.ig"  placeholder="Inputkan Instagram" >
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-2">
                                <label for="" class="control-label">Facebook</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="fb" v-model="form.fb"  placeholder="Inputkan Facebook" >
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-2">
                                <label for="" class="control-label">Twitter</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="tw" v-model="form.tw"  placeholder="Inputkan Twitter" >
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-2">
                                <label for="" class="control-label">*No. HP</label>
                            </div>
                            <div class="col-md-10">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">+62</span>
                                    <input type="text" class="form-control" v-model="form.nohp"  placeholder="Contact Person 1" name="nohp" aria-describedby="basic-addon1" required="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-5" v-html="form.map">
                            
                        </div>
                        <div class="form-group">
                            <div class="col-md-2">
                                <label for="" class="control-label">Maps</label>
                            </div>
                            <div class="col-md-10">
                                <textarea name="map" class="form-control" v-model="form.map"  rows="6" placeholder="Inputkan Map" ></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group pull-right">
                    <br><br>
                        <button type="submit" class="btn btn-lg btn-success">Simpan</button>
                    </div>
                </form>
                    <div class="clearfix"></div>
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
    data() {
        return {
            icon: null,
            previewIcon : null,
            form : {
                nama_dashboard : '',
                nama_dashboard_singkatan : '',
                nama_portal : '',
                alamat : '',
                metatext : '',
                deskripsi : '',
                email : '',
                website : '',
                ig : '',
                fb : '',
                tw : '',
                nohp : '',
                map : '',
            }
        }
    },
    watch : {
        '$route':'getKonfig',
    },
    mounted() {
        this.getKonfig()
    },
    methods: {
        getKonfig(){
            axios.defaults.headers.common['Content-Type'] = 'application/json'
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('jwt')
            axios.get('/api/konfigurasi/show').then((response) => {
                console.log(response)
                this.form = response.data;
                if(response.data.icon){
                    this.previewIcon = '/image/konfigurasi/' + response.data.icon
                }else{
                    this.previewIcon = null
                }
            })
        },
        handleSubmit() {
            axios.defaults.headers.common['Content-Type'] = 'application/json'
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('jwt')
            let formData = new FormData($('#form-konfig')[0])
            formData.append('icon',this.icon)
            axios.post('/api/konfigurasi/update', formData).then((response) => {
                    this.$noty.success(response.data.message, {
                        killer: true,
                        timeout: 6000,
                        layout: 'topRight'
                    })
            }).catch((error) => {
                //
            })
        },
        iconUpload(e){
           let files = e.target.files[0]
           this.previewIcon = null
           this.previewIcon = URL.createObjectURL(files)
           this.icon = files
       }, 
    }
}
</script>