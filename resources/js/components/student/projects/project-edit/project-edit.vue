<template>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <span>تعديل المشروع {{project.name}}</span>
                </div>
                <div class="card-body">
                    <form @submit.prevent="saveProject" @keydown="form.onKeydown($event)">
                        <div class="form-group">
                            <label >اسم المشروع</label>
                            <input type="text" v-model="form.name" class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                            <has-error :form="form" field="name"></has-error>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button :disabled="form.busy" type="submit" class="btn btn-primary">حفظ</button>
                            <button type="button" @click="cancel" class="btn btn-secondary">إلغاء الأمر</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

</template>

<script>
    export default {
        props: ['project'],
data(){
            return {
                form:new Form({
                    name:'',
                    id:''
                })
            }
},
        methods:{
            saveProject(){
                this.form.post(`${url}/student/projects/${this.project.id}/update`).then(()=>{
                    Toast.fire({
                        icon:'success',
                        title:'تم تعديل المشروع بنجاح'
                    })
                    this.form.reset();
                    Fire.$emit('reload');
                    Fire.$emit('close');
                }).catch((e)=>{
                    Swal.fire({
                        icon:'warning',
                        text:e.response.data.message,
                    });
                })
            },
            cancel(){
                Fire.$emit('close');
            }
        },
        created(){
            this.form.name=this.project.name;
            this.form.id=this.project.id;
        }
    };
</script>
