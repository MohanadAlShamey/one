<template>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <span>إضافة مشروع جديد</span>
                </div>
                <div class="card-body">
                    <form @submit.prevent="saveProject" @keydown="form.onKeydown($event)">
                        <div class="form-group">
                            <label >اسم المشروع</label>
                            <input type="text" v-model="form.name" class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                            <has-error :form="form" field="name"></has-error>
                        </div>
                        <button :disabled="form.busy" type="submit" class="btn btn-primary">حفظ</button>
                    </form>
                </div>
            </div>
        </div>

</template>

<script>
    export default {
       data(){
           return {
               form:new Form({
                   name:'',

               }),
           }
       },
        methods:{
           saveProject(){
               this.form.post(`${url}/student/projects/store`).then(()=>{
                   Toast.fire({
                       icon:'success',
                       title:'تم إضافة المشروع بنجاح'
                   })
                   this.form.reset();
                   Fire.$emit('reload');
               }).catch((e)=>{
                   Swal.fire({
                       icon:'warning',
                       text:e.response.data.message,
                   });
               })
           }
        }
    };
</script>
