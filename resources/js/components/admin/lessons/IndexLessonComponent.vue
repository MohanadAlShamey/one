<template>
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <draggable
                            v-model="form.lessons"
                            :list="form.lessons"
                            @change="checkMove"
                            :disabled="!enabled"
                            class="list-group"
                            ghost-class="ghost"
                            @start="dragging = true"
                            @end="dragging = false">
                        <div
                                class="list-group-item"
                                v-for="element in form.lessons"
                                :key="element.id">
                            <div class="d-flex justify-content-between">
                                <span>{{ element.name }}</span>
                                <span><i class="fa fa-list text-muted text-small"></i></span>
                            </div>
                        </div>
                    </draggable>
                </div>
                <div class="card-footer">
                    <span class="small text-muted">قم بالترتيب عن طريق السحب والإفلات</span>
                </div>
            </div>

        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <span>الدروس</span>
                        <a :href="`${url}/dashboard/lessons/create`" class="btn btn-sm btn-outline-secondary"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <div class="my-2"><input type="text" @keyup="getResults" placeholder="بحث" v-model="q" class="form-control-sm"></div>
                    <table class="table table-bordered">
                        <tr>
                            <th>اسم الدرس</th>
                            <th>عدد الفيديوهات</th>
                            <th>عدد التمارين</th>
                            <th>التحكم</th>
                        </tr>
                        <tr v-for="lesson in lessons.data">
                            <td>{{lesson.name}}</td>
                            <td>{{lesson.num_video}}</td>
                            <td>{{lesson.num_example}}</td>
                            <td>
                                <a :href="`${url}/dashboard/lessons/${lesson.id}/edit`" class="btn btn-sm btn-outline-info"><i class="fa fa-edit"></i></a>
                                <button class="btn btn-sm btn-outline-danger" @click="deleteLesson(lesson.id)"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="card-footer">
                    <pagination :data="lessons" align="center" :limit="1" size="small" @pagination-change-page="getResults"></pagination>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

     import draggable from "vuedraggable";
    export default {
        name: "IndexLessonComponent",
          components: {
            draggable
          },
        data(){
            return {
                lessons:{},
               // allsection:null,
                enabled: true,
                dragging: false,
                url,
                q:'',
                form:new Form({
                    lessons:null
                })
            }
        },
        methods:{
            checkMove(){
this.form.post(`${url}/dashboard/lessons/sort`).then(()=>{
    Toast.fire({
        icon:'success',
        title:'تم تحديث الترتيب'
    })
    this.getResults();
})
            },
            deleteLesson(id){

                Swal.fire({
                    title: 'هل انت متأكد من حذف الفصل',
                    text: "لن تستطيع التراجع",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'متأكد',
                    cancelButtonText:'إلغاء الأمر'
                }).then((result) => {
                    if (result.isConfirmed) {
                       axios.delete(`${url}/dashboard/lessons/${id}/delete`).then(()=>{
                           Swal.fire(
                               'تم الحذف',
                               '',
                               'success'
                           );
                           this.getResults();
                       })
                    }
                })




            },

            getResults(page=1){
                axios.get(`${url}/dashboard/lessons/index?q=${this.q}&page=${page}`).then(data=>{
                    //console.log(data.data)
                    this.lessons=data.data;
                    //this.allsection=data.allSection;
                })
            },

            getAllLesson(){
                axios.get(`${url}/dashboard/lessons/getAll`).then(({data})=>{
                    //console.log(data.data)
                    this.form.fill(data);
                    //this.allsection=data.allSection;
                })
            }

        },
        created(){
            this.getAllLesson();
        },
        mounted(){
            this.getResults()
        }
    }
</script>

<style scoped>

</style>