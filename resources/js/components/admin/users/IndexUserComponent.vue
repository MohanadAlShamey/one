<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <span>المستخدمين</span>
                        <a :href="`${url}/dashboard/users/create`" class="btn btn-sm btn-outline-secondary"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <div class="my-2"><input type="text" @keyup="getResults" placeholder="بحث" v-model="q" class="form-control-sm"></div>
                    <table class="table table-bordered">
                        <tr>
                            <th>الاسم</th>
                            <th>اسم المستخدم</th>
                            <th>البريد الإلكتروني</th>
                            <th>الشركة</th>
                            <th>الصلاحية</th>
                            <th>تاريخ التسجيل</th>
                            <th>حالة الحساب</th>
                            <th>تعديل</th>
                        </tr>
                        <tr v-for="user in users.data">
                            <td><a :href="`${url}/dashboard/examples/${user.id}/get`">{{user.name}} </a>
                                <a :href="`${url}/dashboard/logs/${user.id}`" class="btn btn-sm btn-outline-success"> <i class="fa fa-user-cog"></i></a>
                            </td>
                            <td>{{user.username}}</td>
                            <td>{{user.email}}</td>
                            <td>{{user.company}}</td>
                            <td><kbd class="mx-1" v-for=" role in user.roles">{{role.display_name}}</kbd></td>
                            <td>{{user.created_at}}</td>
                            <td><span :class="user.status==1?'text-success':'text-danger'">{{user.status|getStatus}}</span></td>
                            <td>
                                <a :href="`${url}/dashboard/users/${user.id}/edit`" class="btn btn-sm btn-outline-info btn-block "><i class="fa fa-edit"></i></a>

                                <button class="btn btn-sm  btn-block btn-outline-danger" @click="deleteUser(user.id)"><i class="fa fa-trash"></i></button>
                                <button class="btn btn-sm  btn-block " :class="user.status==1?'btn-outline-warning':'btn-outline-success'" @click="ChangeStatus(user.id,user.status)" v-html="user.status==1?`<i class='fa fa-lock'></i>`:`<i class='fa fa-unlock'></i>`"></button>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="card-footer">
                    <pagination :data="users" align="center" :limit="1" size="small" @pagination-change-page="getResults"></pagination>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "IndexUserComponent",
        data(){
            return {
                users:{},
                url,
                q:'',
            }
        },
        methods:{
            deleteUser(id){

                Swal.fire({
                    title: 'هل انت متأكد من حذف المستخدم',
                    text: "لن تستطيع التراجع",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'متأكد',
                    cancelButtonText:'إلغاء الأمر'
                }).then((result) => {
                    if (result.isConfirmed) {
                       axios.delete(`${url}/dashboard/users/${id}/delete`).then(()=>{
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
            ChangeStatus(id,status){
                Swal.fire({
                    title: status==1?'هل انت متأكد من إيقاف حساب المستخدم':'هل أنت متأكد من إعادة تفعيل الحساب ؟',
                    // text: "لن تستطيع التراجع",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'متأكد',
                    cancelButtonText:'إلغاء الأمر'
                }).then((result) => {
                    if(result.isConfirmed){
                        axios.post(`${url}/dashboard/users/${id}/deactive`).then(()=>{
                            Swal.fire(
                                status==1?'تم إيقاف الحساب':'تم إعادة تفعيل الحساب',
                                '',
                                'success'
                            );
                            this.getResults();
                        })
                    }

                })




            },

            getResults(page=1){
                axios.get(`${url}/dashboard/users/index?q=${this.q}&page=${page}`).then(res=>{
                    this.users=res.data;
                })
            },

        },
        mounted(){
            this.getResults()
        }
    }
</script>

<style scoped>

</style>