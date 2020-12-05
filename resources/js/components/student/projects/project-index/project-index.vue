<template>
    <div class="container">
        <div class="row justify-content-center">
            <student-projects-create-component v-if="add"></student-projects-create-component>
            <student-projects-edit-component v-else :project="project"></student-projects-edit-component>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <span>جميع المشاريع</span>

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table teble-bordered">
                                <tr>
                                    <th>اسم المشروع</th>
                                    <th>التحكم</th>
                                </tr>

                                <tr v-for="project in projects.data">
                                    <td>{{project.name}}</td>
<td>
    <button class="btn btn-sm btn-outline-info" @click="editProject(project)"><i class="fa fa-edit"></i></button>
    <button class="btn btn-sm btn-outline-danger" @click="deleteProject(project)"><i class="fa fa-trash"></i></button>
</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <pagination :data="projects" align="center" :limit="1" size="small" @pagination-change-page="getAllProject"></pagination>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        props: {
        },
        data(){
            return {
                projects:{},
                url,
                add:true,
                project:null,
            }
        },
        methods:{
            getAllProject(page=1){
                axios.get(`${url}/student/projects/getAllProject?page=${page}`).then(res=>{
                    this.projects=res.data;
                    console.log(res.data)
                })
            },
            editProject(project){
              this.project=project;
              this.add=false;
            },
            deleteProject(pro){
                Swal.fire({
                    title: 'هل انت متأكد من حذف المشروع',
                    text: "لن تستطيع التراجع",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'متأكد',
                    cancelButtonText:'إلغاء الأمر'
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.delete(`${url}/student/projects/${pro.id}/delete`).then(()=>{
                            Swal.fire(
                                'تم الحذف',
                                '',
                                'success'
                            );
                            this.getAllProject();
                        })
                    }
                })

            }
        },
        mounted(){
            this.getAllProject();
            Fire.$on('reload',()=>{
                this.getAllProject();
            })
            Fire.$on('close',()=>{
                this.add=true;
            })
        }
    };
</script>
