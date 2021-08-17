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
                <router-link :to="{ name: 'BlogCreate' }"  class="btn btn-success m-b-sm "><i class="fa fa-plus"></i> Tambah</router-link>
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
                              <td v-if="project.image">
                                <a :href="'/image/blog/' + project.image" class="gambar_lt" data-toggle="lightbox" data-gallery="my-gallery" >
                                  <img :src="'/image/blog/' + project.image" alt="" style="width:290px;height:170px;margin-bottom: 10px">
                                </a>
                                </td>
                              <td v-else>Gambar Kosong</td>
                              <td>{{project.title}} </td>
                              <td>{{project.user.name}}</td>
                              <td>{{project.created_at | moment}}</td>
                              <td>
                                  <router-link :to="{ name: 'BlogEdit', params:{id:project.id} }"  class="btn btn-warning "><i class="fa fa-pencil"></i></router-link>
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

                  <div v-if="modalHapus" class="modal show bs-example-modal-sm'" id="modal-hapus" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                        <form id="form-hapus" method="post" enctype="multipart/form-data">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                    <input type="hidden" id="data_id_hapus">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="tutupHapus"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="mySmallModalLabel">Hapus Blog</h4>
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
import Vue from 'vue';
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
            {label: 'Image', name: 'image'},
            {label: 'Title', name: 'title'},
            {label: 'Created By', name: 'created_by'},
            {label: 'Tanggal Post', name: 'created_at'},
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
      moment: function (date) {
      return moment(date);
      },
      date: function (date) {
        return moment(date).format('MMMM Do YYYY, h:mm:ss a');
      },
       upload(e){
           let files = e.target.files[0]
           this.previewImage = URL.createObjectURL(files)
           this.fileImage = files
       }, 
        getProjects(url = '/api/blog') {
            this.tableData.draw++;
            axios.get(url, {params: this.tableData})
                .then(response => {
                    let data = response.data;
                    if (this.tableData.draw == data.draw) {
                        this.projects = data.data.data;
                        this.configPagination(data.data);
                        // console.log(data.data.data)
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
          axios.get('/api/blog/show/' + id).then((response) => {
              NProgress.start()
              NProgress.set(0.5)
              // data
              this.formHapus.nama = response.data.title;
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
          axios.delete('/api/blog/' + id).then((response) => {
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
    },
    filters: {
    moment: function (date) {
        // return moment(date).format('MMMM Do YYYY, h:mm:ss a');
        return moment(date).format('DD-MMMM-YYYY');
        // return moment(date).format('DD/MMMM/YYYY hh:mm');
      }
    }
}
</script>