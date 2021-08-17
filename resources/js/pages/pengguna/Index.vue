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
                <button type="button" @click="modalOpen('tambah')" class="btn btn-success m-b-sm tmbAdd"><i class="fa fa-plus"></i> Tambah </button>
                <br><br>
                <div class="table-responsive">
                  <div class="row mb-4">
                    <div class="form-horizontal">
                        <div class="col-sm-6">
                          <div class="dataTables_length">
                            <div class="col-sm-2">
                                <label>Show</label>
                            </div>
                            <div class="col-sm-3">
                              <select class="form-control input-sm" v-model="tableData.length" @change="getProjects()">
                                <option v-for="(records, index) in perPage" :key="index" :value="records">{{records}}</option>
                              </select>
                            </div>
                          </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="dataTables_filter">
                            <div class="col-sm-2">
                                <label>Search</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="search" class="form-control input-sm" v-model="tableData.search" placeholder="Search Table" @input="getProjects()">
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <datatable :columns="columns" :sortKey="sortKey" :sortOrders="sortOrders" @sort="sortBy">
                      <tbody>
                          <tr v-for="(project, index) in projects" :key="index">
                              <td align="center"> {{ index + 1 }} </td>
                              <td v-if="project.photo">
                                <a :href="'/image/profile/' + project.photo" class="gambar_lt" data-toggle="lightbox" data-gallery="my-gallery" >
                                  <img :src="'/image/profile/' + project.photo" alt="" style="width:290px;height:170px;margin-bottom: 10px">
                                </a>
                                </td>
                              <td v-else>Gambar Kosong</td>
                              <td>{{project.name}} </td>
                              <td>{{project.email}}</td>
                              <td>
                                  <button class="btn btn-warning" @click="modalOpen(project.id)"><i class="fa fa-pencil"></i></button>
                                  <button class="btn btn-danger" @click="hapus(project.id)" title="Hapus"><i class="fa fa-trash"></i></button>
                              </td>
                          </tr>
                      </tbody>
                  </datatable>
                  <paginate :pagination="pagination"
                              @prev="getProjects(pagination.prevPageUrl)"
                              @next="getProjects(pagination.nextPageUrl)">
                  </paginate>
                </div>

              <form id="form-tambah" enctype="multipart/form-data">
                    <div v-if="modalFormOpen" class="modal show" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog ">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="modalTutup"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel" v-text="judul">Tambah Pengguna</h4>
                                </div>
                                <div class="modal-body ">
                                    <div class="form-group">
                                            <label for="" class="control-label">* Full name</label>
                                            <input type="text" id="nama2" v-model="form.name" name="nama" class="form-control" placeholder="Inputkan Full Name" required>
                                    </div>
                                    <div class="form-group">
                                            <label for="" class="control-label">* Email</label>
                                            <input type="email" id="email2" name="email" v-model="form.email" class="form-control" placeholder="Inputkan Email" required>
                                    </div>
                                    <div v-if="judul == 'Tambah Pengguna'" class="form-group">
                                            <label for="" class="control-label">* Password</label>
                                            <input type="password" id="password" name="password" class="form-control" placeholder="Inputkan Password" required>
                                    </div>
                                    <div v-else>
                                    </div>
                                    <div class="form-group">
                                            <label for="" class="control-label">* Upload Photo</label><br>
                                            <img id="previewImage" v-if="previewImage" :src="previewImage" width="140">
                                            <input type="file" id="photo2"  name="photo" class="form-control" @change="upload">
                                    </div>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" @click="modalTutup" data-dismiss="modal">Cancel</button>
                                    <button v-if="judul == 'Tambah Pengguna'" type="submit" @click.prevent="formSimpan('tambah')" class="btn btn-success">Save</button>
                                    <button v-else type="submit" @click.prevent="formSimpan(form.id)" class="btn btn-success">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                  <div v-if="modalHapus" class="modal show bs-example-modal-sm'" id="modal-hapus" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                        <form id="form-hapus" method="post" enctype="multipart/form-data">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                    <input type="hidden" id="data_id_hapus">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="tutupHapus"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="mySmallModalLabel">Hapus Pengguna</h4>
                                </div>
                                <div class="modal-body">
                                  Apa anda yakin ingin menghapus data <b v-text="formHapus.nama"></b> ini ?
                                </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" @click="tutupHapus" data-dismiss="modal">Close</button>
                                <button type="submit" @click.prevent="hapusData(formHapus.id)" class="btn btn-danger">Ya</button>
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
import DataTable from './dataTable/ListTable.vue'
import Pagination from './dataTable/Paginate.vue'

export default {
  components: {
		datatable: DataTable, paginate: Pagination 
	},
  created(){
    this.getProjects()
  },
  data() {
        let sortOrders = {};

        let columns = [
            {label: 'No', name: 'no'},
            {label: 'Photo', name: 'photo'},
            {label: 'Nama', name: 'nama'},
            {label: 'Email', name: 'email'},
            {width: '10%', label: 'Aksi', name: 'aksi'}
        ];

        columns.forEach((column) => {
           sortOrders[column.name] = -1;
        });
        return {
            formHapus : {
                id:'',
                nama:'',
            },
            form : {},
            judul: '',
            modalFormOpen : false,
            modalHapus : false,
            previewImage: null,
            fileImage: null,
            data_id : '',
            projects: [],
            columns: columns,
            sortKey: 'deadline',
            sortOrders: sortOrders,
            perPage: ['10', '20', '30'],
            tableData: {
                draw: 0,
                length: 10,
                search: '',
                column: 0,
                dir: 'desc',
            },
            pagination: {
                lastPage: '',
                currentPage: '',
                total: '',
                links: {},
                lastPageUrl: '',
                nextPageUrl: '',
                prevPageUrl: '',
                from: '',
                to: ''
            },
        }
    },
    methods: {
       upload(e){
           let files = e.target.files[0]
           this.previewImage = URL.createObjectURL(files)
           this.fileImage = files
       }, 
        getProjects(url = '/api/pengguna') {
            this.tableData.draw++;
            axios.get(url, {params: this.tableData})
                .then(response => {
                    let data = response.data;
                    if (this.tableData.draw == data.draw) {
                        this.projects = data.data.data;
                        this.configPagination(data.data);
                        // console.log(data.data.links)
                    }
                })
                .catch(errors => {
                    console.log(errors);
                });
        },
        configPagination(data) {
            this.pagination.lastPage = data.last_page;
            this.pagination.currentPage = data.current_page;
            this.pagination.total = data.total;
            this.pagination.lastPageUrl = data.last_page_url;
            this.pagination.nextPageUrl = data.next_page_url;
            this.pagination.prevPageUrl = data.prev_page_url;
            this.pagination.links = data.links;
            this.pagination.from = data.from;
            this.pagination.to = data.to;
        },
        sortBy(key) {
            this.sortKey = key;
            this.sortOrders[key] = this.sortOrders[key] * -1;
            this.tableData.column = this.getIndex(this.columns, 'name', key);
            this.tableData.dir = this.sortOrders[key] === 1 ? 'asc' : 'desc';
            this.getProjects();
        },
        getIndex(array, key, value) {
            return array.findIndex(i => i[key] == value)
        },
        hapus(id){
          this.modalHapus = true;
          axios.get('/api/pengguna/show/' + id).then((response) => {
              NProgress.start()
              NProgress.set(0.5)
              // data
              this.formHapus.nama = response.data.name;
              this.formHapus.id = response.data.id;
              NProgress.done()
          })
        },
        tutupHapus(){
          this.modalHapus = false;
        },
       hapusData(id){
          axios.defaults.headers.common['Content-Type'] = 'application/json'
          axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('jwt')
          axios.delete('/api/pengguna/' + id).then((response) => {
                  NProgress.start()
                  NProgress.set(0.5)
                  this.modalHapus = false;
                  this.$noty.success(response.data.message, {
                        killer: true,
                        timeout: 6000,
                        layout: 'topRight'
                    })
                  this.getProjects()
                  NProgress.done()
                }).catch((error) => {
                        //
                })
       },
        modalOpen(id){
          this.modalFormOpen = true;
          if(id == 'tambah'){
              this.judul = 'Tambah Pengguna'
              this.form = {}
              this.previewImage = null
              this.fileImage = null
          }else{
              this.judul = 'Edit Pengguna'
              axios.get('/api/pengguna/show/' + id).then((response) => {
              NProgress.start()
              NProgress.set(0.5)
              // data
              this.form = response.data;
              if(response.data.photo){
                this.previewImage = '/image/profile/' + response.data.photo
                this.fileImage = null
              }else{
                this.previewImage = null
                this.fileImage = null

              }
              NProgress.done()
            })
          }
        },
        modalTutup(){
          this.modalFormOpen = false;
        },
        formSimpan(id){
          if(id == 'tambah'){
            var formT= new FormData()
            formT.append('name',this.form.name)
            formT.append('email',this.form.email)
            formT.append('password',this.form.password)
            formT.append('photo',this.fileImage)
            axios.post('/api/pengguna/', formT).then((response) => {
                NProgress.start()
                NProgress.set(0.5)
                this.$noty.success(response.data.message, {
                  killer: true,
                          timeout: 6000,
                          layout: 'topRight'
                      })                
                this.modalFormOpen = false;
                  this.getProjects()
                NProgress.done()
              }).catch((error) => {
                //
              })
          }else{
            var formT= new FormData()
            formT.append('name',this.form.name)
            formT.append('email',this.form.email)
            formT.append('password',this.form.password)
            formT.append('photo',this.fileImage)
            axios.post('/api/pengguna/' + id, formT).then((response) => {
                NProgress.start()
                NProgress.set(0.5)
                this.$noty.success(response.data.message, {
                  killer: true,
                          timeout: 6000,
                          layout: 'topRight'
                      })                
                this.modalFormOpen = false;
                  this.getProjects()
                NProgress.done()
              }).catch((error) => {
                //
              })
          }
        }
    }
  
}
</script>