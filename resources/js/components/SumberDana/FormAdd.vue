<template>
    <form style="color:black">
        <div class="form-group">
            <label>Sumber Dana</label>
            <input type="text" v-model="form.id" class="form-control" style="display:none"> 
            <input v-model="form.sumber_dana" type="text" class="form-control" :class="{'is-invalid' : errors.sumber_dana}">
             <div class="invalid-feedback">
                  {{errors.sumber_dana ? errors.sumber_dana[0] : '' }}
             </div>
        </div>
        <div class="form-group">
            <label>Upload Icon</label>
             <input type="file" class="form-control-file form-control" @change='uploadPhoto' :class="{'is-invalid' : errors.file}">
              <div class="invalid-feedback">
                  {{errors.file ? errors.file[0] : '' }}
             </div>
        </div>
</form>
</template>
<script>
export default {
    data(){
        return {
            form:{
                sumber_dana:'',
                icon:'',
                id:0
            },
            initialForm:{
                sumber_dana:'',
                icon:'',
                id:0
            },
            errors:[]
        }
    },
    props:{
        danaID:{
            required:true
        }
    },
    watch:{
        danaID(newid){
           if(newid==0){
               Object.assign(this.form,this.initialForm);
           }
           this.getById(newid);
        }
    },
    methods:{
          simpan(){
            this.errors = [];
            let formData = new FormData();
            formData.append('file', this.form.icon);
            formData.append('sumber_dana', this.form.sumber_dana);
            formData.append('id', this.form.id);
            var config = {
            headers: { 
                'Content-Type': 'multipart/form-data' },
            };
            axios.post('/add-sumber-dana', formData, config)
            .then(response=>{
               if(response.data.success){
                   Swal.fire('Informasi', response.data.msg ,'success');
               }
            })
            .catch(error =>{
                if (error.response.status == 422){
                this.errors = error.response.data.errors;
                console.log(this.errors);
                }
            });
        },
         uploadPhoto(e){
              let file = e.target.files[0];
              this.form.icon = file;
        },
        getById(id){
            axios.get(`/get-dana-byid/${id}`).then(response=>{
                if(response.data.success){
                    this.form.sumber_dana = response.data.data.nama;
                }
            }).catch()
        }

    }
}
</script>