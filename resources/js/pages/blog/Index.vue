<template>
    
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Blog</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- konten -->
                <!-- <button type="button" class="btn btn-success m-b-sm tmbAdd"><i class="fa fa-plus"></i> Tambah </button> -->
                <router-link :to="{ name: 'BlogCreate' }"  class="btn btn-success m-b-sm "><i class="fa fa-plus"></i> Tambah</router-link>
                <br><br>
                <div class="table-responsive">
                  <table class="display table table-hover data-table-blog" style="width: 100%; cellspacing: 0;">
                    <thead>
                      <tr>
                        <th align="center">No</th>
                        <th style="text-align: center">#</th>
                        <th style="text-align: center">Title</th>
                        <th style="text-align: center">Created By</th>
                        <th style="text-align: center">Created At</th>
                        <th style="text-align: center" width="18%">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      
                    </tbody>
                  </table>
                </div>

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
      $(document).on('click', '.tmbHapus', function(e) {
        $('#data_id_hapus').val('');
        $('#nama_hapus').text('');
        $('#modal-hapus').modal('show');
        this.data_id = $(this).attr('data-id')
        axios.get('/api/blog/show/' + this.data_id).then((response) => {
              NProgress.start()
              NProgress.set(0.5)
              // data
              $('#data_id_hapus').val(response.data.id);
              $('#nama_hapus').text(response.data.title);
              NProgress.done()

          })
      })
      $(document).on('click', '[data-toggle="lightbox"]', function(event) {
              event.preventDefault();
              $(this).ekkoLightbox({
              loadingMessage: "Loading…",
              showArrows: true,
            });
        });
    $(document).ready(function(){
      var table = $('.data-table-blog').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/api/blog",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className:"text-center", orderable: false, searchable: false},
            {data: 'image', name: 'image', className:"text-center"},
            {data: 'title', name: 'title', className:"text-center"},
            {data: 'name', name: 'name', className:"text-center"},
            {data: 'tanggal', name: 'tanggal', className:"text-center"},
            {data: 'action', name: 'action', className:"text-center", orderable: false, searchable: false},
        ],
      });      
      });      

      $(document).on('submit', '#form-hapus', function(e) {
      e.preventDefault();
      var data_id = $('#data_id_hapus').val()
      axios.defaults.headers.common['Content-Type'] = 'application/json'
      axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('jwt')
      axios.delete('/api/blog/' + data_id).then((response) => {
              NProgress.start()
              NProgress.set(0.5)
                  $('#modal-hapus').modal('hide');
                  $('.data-table-blog').DataTable().draw();
                NProgress.done()
                      $.toast({
                      heading   : "Sukses",
                      text    : response.data.message,
                      showHideTransition : "slide",
                      icon    : "success",
                      hideAfter   : false,
                      position    : "bottom-right",
                      bgColor   : "#2ECC71"
                    })
            }).catch((error) => {
                     //
            })
      })
      let dataId;
        $(document).on('click', '.tmbPindah', function(){
            dataId = null;
            dataId = $(this).attr("data-id")
            // console.log(no)
        })
      $(document).on('click', '.tmbPindah', () => {
            // let dataId = $(this).attr('data-id');
            // console.log(no)
            this.testing(dataId);
        });
  },
//   watch : {
//     '$route':'getUser',
//   },z
methods: {
    testing(data){
        this.$router.push({
                name : 'BlogEdit',
                params : { id:data },
            });
    }
},
mounted() {
    // $(document).on('click', '.tmbPindah', () => {
    //     let dataId = $(this).attr('data-id');
    //     this.testing(dataId);
    // });
    // $(document).on('click', '.tmbPindah', function(){
    //     this.testing('oooo');
    // })
},

//   methods:{
//     setClass(value){
//       if (value == 'Y') {
//         console.log(value);
//       } else {
//         console.log('gagal');
//       } 
//     }
//   },
//   mounted: function () {
//     this.setClass("Y")
//   },
//   watch: {
//     value: function (value) {
//       this.setClass(value)
//     },
//   },
  
  
}
</script>