<template>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">

                <div class="card-header">
                    <span>إضافة فصل جديد</span>
                </div>
                <div class="card-body">
                    <form @submit.prevent="save" @keydown="form.onKeydown($event)">
                    <div class="form-group">
                        <label >اسم الفصل</label>
                        <input type="text" v-model="form.name" class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                        <has-error :form="form" field="name"></has-error>
                    </div>



                        <button :disabled="form.busy" type="submit" class="btn btn-primary">حفظ</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AddSectionComponent",

        data(){
            return{
                roles:null,
                form:new Form({
                    name:'',
                })
            }
        },
         methods:{
             save(){
                this.form.post(`${url}/dashboard/sections/store`).then(()=>{
                    Toast.fire({
                        icon:'success',
                        title:'تم إضافة الفصل بنجاح',
                    })
                    setTimeout(()=>{
                        window.location.href=`${url}/dashboard/sections`;
                    },500);
                   this.form.reset()
                })
             }
         },
        created(){

        }
    }
</script>

<style scoped>

</style>