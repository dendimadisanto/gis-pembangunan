<template>
    <div class="content">
        <div class="toolbar" style="margin:2rem">
            <div class="action" style="text-align: right;">
                <button v-on:click="add" type="button" class="btn btn-secondary">Tambah</button>
                <button @click="ubah" type="button" class="btn btn-secondary">Ubah</button>
                <button type="button" class="btn btn-secondary">Hapus</button>
            </div>
        </div>
        <div class="table">
            <ag-grid-vue style="width: 100%;height: 400px;"
            class="ag-theme-alpine"
            :columnDefs="columnDefs"
            :rowData="rowData"
            @grid-ready="onGridReady"
            rowSelection="single"
            >
         </ag-grid-vue>
        </div>
        <div class="pagination">
            <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
                </li>
            </ul>
            </nav>
        </div>
         <div class="modal" tabindex="-1" role="dialog" aria-modal="true" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Sumber Dana</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form-dana ref='form' :danaID="idEdit"></form-dana>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" @click="store">Simpan</button>
            </div>
            </div>
        </div>
        </div>
    </div>
   
     
</template>
<script>
import { AgGridVue } from 'ag-grid-vue';
import Form from './FormAdd';
export default {
    data() {
        return {
            columnDefs: null,
            rowData: null,
            bus: new Vue(),
            gridApi: null,
            columnApi: null,
            idEdit:0
        }
    },
    components: {
        AgGridVue,
        'form-dana':Form
    },
    mounted() {
       
    },
    beforeMount() {
        this.columnDefs = [
            {headerName: 'id', field: 'id', hide:true},
            {headerName: 'Sumber Dana', field: 'nama',resizable: true},
            {headerName: 'Icon', field: 'icon',resizable: true},
        ];

       this.loadData();
    },
    methods:{
        onGridReady(params) {
                console.log(params);
                this.gridApi = params.api;
                this.columnApi = params.columnApi;
            },
        add(){
            this.idEdit = 0;
            $('#myModal').modal('show');
        },
         store(){
           this.$refs.form.simpan();
        },
        loadData(){
             axios.get('/get-sumber-dana').then(response=>{
                 if(response.data.success){
                     this.rowData = response.data.data;
                 }
             }).catch(error=>{
                Swal.fire('Informasi', 'Ada Kesalahan Server' ,'error');
             })
        },
        ubah(){
            const selected = this.gridApi.getSelectedRows();
            this.idEdit = selected[0].id;
            $('#myModal').modal('show');
        }
    }
}
</script>