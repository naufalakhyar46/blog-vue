<template>
    
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Pengguna</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- konten -->
                <button type="button" class="btn btn-success m-b-sm tmbAdd"><i class="fa fa-plus"></i> Tambah </button>
                <br><br>
                <div class="table-responsive">
                  <table class="display table table-hover data-table" style="width: 100%; cellspacing: 0;">
                    <thead>
                      <tr>
                        <th align="center">No</th>
                        <th style="text-align: center">#</th>
                        <th style="text-align: center">Nama</th>
                        <th style="text-align: center">Email</th>
                        <th style="text-align: center" width="18%">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      
                    </tbody>
                  </table>
                </div>

              <form id="form-tambah" enctype="multipart/form-data">
                    <div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog ">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Tambah Pengguna</h4>
                                </div>
                                <div class="modal-body ">
                                    <div class="form-group">
                                            <label for="" class="control-label">* Full name</label>
                                            <input type="text" id="nama2" name="nama" class="form-control" placeholder="Inputkan Full Name" required>
                                    </div>
                                    <div class="form-group">
                                            <label for="" class="control-label">* Email</label>
                                            <input type="email" id="email2" name="email" class="form-control" placeholder="Inputkan Email" required>
                                    </div>
                                    <div class="form-group">
                                            <label for="" class="control-label">* Password</label>
                                            <input type="password" id="password" name="password" class="form-control" placeholder="Inputkan Password" required>
                                    </div>
                                    <div class="form-group">
                                            <label for="" class="control-label">* Upload Photo</label><br>
                                            <img id="previewImage" :src="previewImage" width="140">
                                            <input type="file" id="photo2"  name="photo" class="form-control" @change="upload">
                                    </div>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-success">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <form id="form-edit" method="POST" enctype="multipart/form-data">
                    <div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog ">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Edit Pengguna</h4>
                                </div>
                                <div class="modal-body ">
                                    <input type="hidden" id="data_id">
                                    <div class="form-group">
                                            <label for="" class="control-label">* Full name</label>
                                            <input type="text" id="name" name="name" class="form-control" placeholder="Inputkan Full Name" required>
                                    </div>
                                    <div class="form-group">
                                            <label for="" class="control-label">* Email</label>
                                            <input type="email" id="email" name="email" class="form-control" placeholder="Inputkan Email" required>
                                    </div>
                                    
                                    <div class="form-group">
                                            <label for="" class="control-label">* Upload Photo</label><br>
                                            <img id="previewImageE" :src="previewImageE" width="140">
                                            <input type="file" id="photo" name="photo" class="form-control" @change="uploadE" >
                                    </div>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-success" id="tmUpdate">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                  <div class="modal fade bs-example-modal-sm" id="modal-hapus" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                        <form id="form-hapus" method="post" enctype="multipart/form-data">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                    <input type="hidden" id="data_id_hapus">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="mySmallModalLabel">Hapus Pengguna</h4>
                                </div>
                                <div class="modal-body">
                                  Apa anda yakin ingin menghapus data <b id="nama_hapus"></b> ini ?
                                </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Ya</button>
                            </div>
                        </div>
                        </div>
                        </form>
                    </div>

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
import NProgress from 'nprogress'
import VueNoty from 'vuejs-noty'

export default {
  data() {
        return {
          previewImage: null,
          previewImageE: null,
          data_id : '',
        }
    },
  created(){
      $(document).on('click', '.tmbEdit', function(e) {
        $('#photo').val('');
        $('#previewImageE').attr('src','');
        $('#modal-edit').modal('show');
        this.data_id = $(this).attr('data-id')
        axios.get('/api/pengguna/show/' + this.data_id).then((response) => {
              NProgress.start()
              NProgress.set(0.5)
              // data
              $('#data_id').val(response.data.id);
              $('#name').val(response.data.name);
              $('#email').val(response.data.email);
              NProgress.done()

          })
      })

      $(document).on('click', '.tmbHapus', function(e) {
        $('#data_id_hapus').val('');
        $('#nama_hapus').text('');
        $('#modal-hapus').modal('show');
        this.data_id = $(this).attr('data-id')
        axios.get('/api/pengguna/show/' + this.data_id).then((response) => {
              NProgress.start()
              NProgress.set(0.5)
              // data
              $('#data_id_hapus').val(response.data.id);
              $('#nama_hapus').text(response.data.name);
              NProgress.done()

          })
      })
   
    $(document).ready(function(){
      $('.tmbAdd').on('click', function(){
          $('#form-tambah')[0].reset();
          $('#previewImage').attr('src','');
          $('#modal-tambah').modal('show');
      })
      $(document).on('click', '[data-toggle="lightbox"]', function(event) {
              event.preventDefault();
              $(this).ekkoLightbox({
              loadingMessage: "Loading…",
              showArrows: true,
            });
        });
      var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/api/pengguna",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className:"text-center", orderable: false, searchable: false},
            {data: 'photo', name: 'photo', className:"text-center"},
            {data: 'name', name: 'name', className:"text-center"},
            {data: 'email', name: 'email', className:"text-center"},
            {data: 'action', name: 'action', className:"text-center", orderable: false, searchable: false},
        ],
      });      
    })
    $(document).on('submit', '#form-tambah', function(e) {
      e.preventDefault();
      var form= new FormData(this)
      var photo = document.querySelector("#photo2").files[0]
      
      axios.post('/api/pengguna/', form).then((response) => {
              NProgress.start()
              NProgress.set(0.5)
                  $('#modal-tambah').modal('hide');
                  $('.data-table').DataTable().draw();
                      $.toast({
                      heading   : "Sukses",
                      text    : response.data.message,
                      showHideTransition : "slide",
                      icon    : "success",
                      hideAfter   : false,
                      position    : "bottom-right",
                      bgColor   : "#2ECC71"
                    })
                  
                  
              NProgress.done()
            }).catch((error) => {
              if(error.response.status == 403){
                    $.each(error.response.data.message, function(index,obj){
                      $.toast({
                              heading   : "Gagal",
                              text    : [obj],
                              showHideTransition : "slide",
                              icon    : "warning",
                              hideAfter   : false,
                              position    : "bottom-right",
                              bgColor   : "#FF4859"
                            })
                    })
                }
            })
      })
     $(document).on('submit', '#form-edit', function(e) {
      e.preventDefault();
      var form= new FormData(this)
      var photo = document.querySelector("#photo").files[0]
      var data_id = $('#data_id').val()
      
      axios.post('/api/pengguna/' + data_id, form).then((response) => {
              NProgress.start()
              NProgress.set(0.5)
                  $('#modal-edit').modal('hide');
                  $('.data-table').DataTable().draw();
                      $.toast({
                      heading   : "Sukses",
                      text    : response.data.message,
                      showHideTransition : "slide",
                      icon    : "success",
                      hideAfter   : false,
                      position    : "bottom-right",
                      bgColor   : "#2ECC71"
                    })
                  
                  
              NProgress.done()
            }).catch((error) => {
              if(error.response.status == 403){
                    $.each(error.response.data.message, function(index,obj){
                      $.toast({
                              heading   : "Gagal",
                              text    : [obj],
                              showHideTransition : "slide",
                              icon    : "warning",
                              hideAfter   : false,
                              position    : "bottom-right",
                              bgColor   : "#FF4859"
                            })
                    })
                }
            })
      })

      $(document).on('submit', '#form-hapus', function(e) {
      e.preventDefault();
      var data_id = $('#data_id_hapus').val()
      axios.defaults.headers.common['Content-Type'] = 'application/json'
      axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('jwt')
      axios.delete('/api/pengguna/' + data_id).then((response) => {
              NProgress.start()
              NProgress.set(0.5)
                  $('#modal-hapus').modal('hide');
                  $('.data-table').DataTable().draw();
                      $.toast({
                      heading   : "Sukses",
                      text    : response.data.message,
                      showHideTransition : "slide",
                      icon    : "success",
                      hideAfter   : false,
                      position    : "bottom-right",
                      bgColor   : "#2ECC71"
                    })
              NProgress.done()
            }).catch((error) => {
                     //
            })
      })
  },
  // watch : {
  //   '$route':'getUser',
  // },
  // mounted() {
  //     this.getUser()   
  //   }, 
  methods : {
       uploadE(e){
           let files = e.target.files[0]
           this.previewImageE = URL.createObjectURL(files)
       }, 
       upload(e){
           let files = e.target.files[0]
           this.previewImage = URL.createObjectURL(files)
       }, 
  }
  
}
</script>