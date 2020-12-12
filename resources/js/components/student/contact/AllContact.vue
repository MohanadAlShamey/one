<template>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <span>جميع الرسائل</span>
                    </div>
                </div>
                <div class="card-body">
                    <!--  <div class="my-2">
                          <input type="text" v-model="q" class="form-control-sm">
                      </div>-->
                    <div class="table-responsive">
                        <table class="table tablebordered">
                            <tr>
                                <th>اسم المرسل</th>
                                <th>البريد الإلكتروني</th>
                                <th>الرسالة</th>
                                <th>رد</th>
                            </tr>
                            <tr v-for="contact in contacts.data">
                                <td>{{contact.name}}</td>
                                <td>{{contact.email}}</td>
                                <td>{{contact.msg}}</td>
                                <td><a :href="`mailto:${contact.email}`"  >رد</a></td>
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
        name: "AllContact",
        data(){
            return {
                contacts:{}
            }
        },
        methods:{
            getAllMsg(page=1){
                axios.get(`${url}/student/contact/getAllMsg?page=${page}`).then(res=>{
                    this.contacts=res.data;
                })
            }
        },
        mounted(){
            this.getAllMsg()
        }
    }
</script>

<style scoped>

</style>