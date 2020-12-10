<template>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <span>جميع الصفحات</span>
                        <a :href="`${url}/student/pages/homePage/create`"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    <!--  <div class="my-2">
                          <input type="text" v-model="q" class="form-control-sm">
                      </div>-->
                    <div class="table-responsive">
                        <table class="table tablebordered">
                            <tr>
                                <th>اسم الصفحة</th>
                                <th>صاحب الصفحة</th>
                                <th>زيارة</th>
                                <th>تحكم</th>
                            </tr>
                            <tr v-for="page in pages">
                                <td>{{page.name}}</td>
                                <td>{{page.user.name}}</td>
                                <td><a :href="`${url}/homePage/${page.name}`"  target="_blank">زيارة</a></td>
                                <td>
                                    <a :href="`${url}/student/pages/homePage/${page.id}/edit`"  class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                                    <button type="button" @click="deletePages(page.id)" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- <div class="card-footer">
                     <advanced-laravel-vue-paginate alignment="center" useStyle="bootstrap" :showNextPrev="true" nextText="التالي" previousText="السابق" :onEachSide="3" :data="pages" @paginateTo="getAllPAge()"/>
                 </div>-->
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AllHomePage",
        data(){
            return {
                q:'',
                url,
                pages:{},
            }
        },
        methods:{
            getAllPage(page=1){
                axios.get(`${url}/student/pages/homePage/getAllPage`).then(({data})=>{
                    this.pages=data;
                })
            },
            deletePages(id){
                //alert("ddf")
                Swal.fire({
                    title: 'هل حقا تريد حذف الصفحة',
                    text: "لن تستطيع التراجع",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'نعم متأكد',
                    cancelButtonText:'إلغاء الأمر'
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.delete(`${url}/student/pages/${id}/delete`).then(()=>{
                            Swal.fire(
                                'تم الحذف !',
                                'تم حذف الصفحة بنجاح',
                                'success'
                            );
                            this.getAllPage();
                        })
                    }
                })
            },
        },
        watch:{
            q:_.debounce(function(){
                this.getAllPage()
            },800)
        },
        mounted(){
            this.getAllPage();
        }
    }

</script>

<style scoped>

</style>