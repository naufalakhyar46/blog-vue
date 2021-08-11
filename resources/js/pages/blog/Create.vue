<template>
<form @submit.prevent="handleSubmit" id="form-simpan-blog" enctype="multipart/form-data">
<br>
<router-link :to="{ name: 'Blog' }" style="margin-left:20px" class="btn btn-success m-b-sm "><i class="fa fa-arrow-left"></i> Kembali</router-link>
    <br><br>
<div class="col-md-8">
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">Tambah Blog</h3>
		</div>
		<div class="box-body">
			<div class="form-group">
				<label for="">Title</label>
				<input type="text" name="title"  class="form-control"  v-model="form.title" placeholder="Title...." required="">
			</div>
			<div class="form-group">
				<label for="">Deskripsi</label>
				<textarea class="form-control" name="deskripsi" rows="7"  v-model="form.deskripsi"></textarea>
			</div>
		</div>
	</div>
</div>
<div class="col-md-4">
	<div class="box">
		<div class="box-body">
			<div class="form-group">
			<img :src="previewImage" style="width: 100%" class="gambar">
			<br>
			<label for="gambar" class="btn btn-primary"><i class="fa fa-image"></i> Pilih Image</label>
			<input type="file" id="gambar" style="display: none" name="image" accept="image/*" @change="upload">
			</div>
			
			<div class="form-group">
				<button type="submit" class="btn btn-lg btn-success pull-right"><i class="fa fa-save"></i> Simpan</button>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>
</form>
</template>
<script>
export default {
    data() {
        return {
            image: null,
            previewImage: null,
            form: {
                title : '',
                deskripsi : '',
            }
        }
    },
    methods: {
        handleSubmit() {
            axios.defaults.headers.common['Content-Type'] = 'application/json'
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('jwt')
            let formData = new FormData($('#form-simpan-blog')[0])
            formData.append('image',this.image)
            axios.post('/api/blog', formData).then((response) => {
                    this.$noty.success(response.data.message, {
                        killer: true,
                        timeout: 6000,
                        layout: 'topRight'
                    })
                    this.$router.push({ name: 'Blog' });
            }).catch((error) => {
                //
            })
        },
        upload(e){
           let files = e.target.files[0]
           this.previewImage = URL.createObjectURL(files)
           this.image = files
       }, 
    }
}
</script>