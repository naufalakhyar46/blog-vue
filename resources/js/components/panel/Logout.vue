<template>
    <div class="modal fade bs-example-modal-sm" id="logout" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <form id="form-logout" method="post" enctype="multipart/form-data">
      <div class="modal-dialog modal-sm">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="mySmallModalLabel">Logout! </h4>
              </div>
              <div class="modal-body">
                  Silahkan pilih tombol Ya jika anda yakin ingin logout! 
              </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
              <button type="submit" class="btn btn-danger" role="button">Ya</button>
              <!-- <a href="#" @click="logout" class="btn btn-danger" role="button">Ya</a> -->
          </div>
      </div>
      </div>
      </form>
    </div>
</template>
<script>
export default {
    created(){
        $(document).on('submit', '#form-logout', function(e) {
            e.preventDefault();
            axios.defaults.headers.common['Content-Type'] = 'application/json'
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('jwt')
            axios.get('/logout').then((response) => {
                    localStorage.removeItem('jwt')
                    localStorage.removeItem('user')
                    window.location.href= '/login';
            }).catch((error) => {
                // console.log(error)
            })
        })
    },
    // methods : {  
    //   logout(){
    //       axios.defaults.headers.common['Content-Type'] = 'application/json'
    //       axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('jwt')
    //       axios.get('api/logout').then((response) => {
    //               localStorage.removeItem('jwt')
    //               localStorage.removeItem('user')
    //                 this.getData()  
    //                 $('#logout').modal('hide')
    //                 window.location.href= '/login';
    //         }).catch((error) => {
    //             // console.log(error)
    //         })
    //   }
    // }
  }
</script>