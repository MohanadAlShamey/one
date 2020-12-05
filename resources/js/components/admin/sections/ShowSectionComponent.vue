<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <span>{{section_name}}</span>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>اسم الفصل</th>
                            <td>{{section.name}}</td>
                        </tr>
                        <tr>
                            <th>عدد الدروس</th>
                            <td>{{section.num_lesson}}</td>
                        </tr>
                    </table>
                    <hr>
                    <h5>الدروس <a :href="`${url}/dashboard/sections/${section.id}/lessons/create`" class="btn btn-sm btn-outline-secondary"><i class="fa fa-plus"></i></a></h5>

                    <draggable
                            v-model="section.lessons"
                            :list="section.lessons"
                            @change="checkMove"
                            :disabled="!enabled"
                            class="list-group"
                            ghost-class="ghost"
                            @start="dragging = true"
                            @end="dragging = false">
                        <div
                                class="list-group-item"
                                v-for="element in section.lessons"
                                :key="element.id">
                            <div class="d-flex justify-content-between">
                                <span>
                                    <a :href="`${url}/dashboard/lessons/${element.id}/show`">{{ element.name }}</a>
                                </span>
<span>
    <span class="d-inline-block mx-3">{{element.num_video}} <i class="fa fa-video text-danger"></i> </span>
<span class="d-inline-block mx-3">{{element.after}} <i class="fa fa-calendar-day text-info"></i></span>
</span>

                                <span>
                                      <a class="btn btn-sm btn-outline-info" :href="`${url}/dashboard/lessons/${element.id}/edit`"><i class="fa fa-edit text-small"></i></a>
                                  <button class="btn btn-sm btn-outline-danger d-inline-block mx-3" @click="deleteLesson(element.id)"><i class="fa fa-trash"></i></button>

                                    <i class="fa fa-list text-muted text-small"></i></span>
                            </div>
                        </div>
                    </draggable>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import draggable from "vuedraggable";
    export default {
        name: "ShowSectionComponent",
        components: {
            draggable
        },
        props:['section_id','section_name'],
        data(){
            return {
                url,
                section:null,
                enabled: true,
                dragging: false,
                form:new Form({
                    lessons:null,
                })
            }
        },
        methods:{
            getSection(){
                axios.get(`${url}/dashboard/sections/${this.section_id}/getShowSection`).then(({data})=>{
                    this.section=data.data;
                    this.form.fill(data.data);
                })
            },
            checkMove(){

                this.form.post(`${url}/dashboard/lessons/sort`).then(()=>{
                    Toast.fire({
                        icon:'success',
                        title:'تم تحديث الترتيب'
                    })

                })
            },
            deleteLesson(id){

                Swal.fire({
                    title: 'هل انت متأكد من حذف الدرس',
                    text: "لن تستطيع التراجع",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'متأكد',
                    cancelButtonText:'إلغاء الأمر'
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.delete(`${url}/dashboard/lessons/${id}/delete`).then(({data})=>{
                            Swal.fire(
                                'تم الحذف',
                                '',
                                'success'
                            );
                            this.section.lessons=data.data;
                        })
                    }
                })




            },
        },
        created(){
            this.getSection()
        }
    }
</script>

<style scoped>

</style>