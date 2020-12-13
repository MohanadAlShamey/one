<template>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <span>جميع الطلبات</span>
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
                                <th>الهاتف</th>
                                <th>العنوان</th>
                                <th>ملاحظات</th>
                                <th>تاريخ الطلب</th>
                            </tr>
                            <tr v-for="order in orders.data">
                                <td>{{order.name}}</td>
                                <td>{{order.email}}</td>
                                <td>{{order.phone}}</td>
                                <td>{{order.address}}</td>
                                <td>{{order.note}}</td>
                                <td>{{order.created_at}}</td>

                            </tr>
                        </table>
                    </div>
                </div>
                 <div class="card-footer">
                     <advanced-laravel-vue-paginate alignment="center" useStyle="bootstrap" :showNextPrev="true" nextText="التالي" previousText="السابق" :onEachSide="3" :data="orders" @paginateTo="getAllMsg()"/>
                 </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AllOrder",
        data(){
            return {
                orders:{}
            }
        },
        methods:{
            getAllMsg(page=1){
                axios.get(`${url}/student/orders/getAllOrder?page=${page}`).then(res=>{
                    this.orders=res.data;
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