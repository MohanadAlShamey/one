<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <span>حجوزات منصة زووم</span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th>اسم المتدرب</th>
                                <!--<th>الحالة</th>-->
                                <th>موعد الحجز التاريخ</th>
                                <th>موعد الحجز الساعة</th>

                            </tr>
                            <tr v-for="session in sessions.data">
                                <td>{{session.user_name}}</td>
                               <!-- <td>{{session.type}}</td>-->
                                <td>{{session.time==''|| session.time==ىعمم?'لم يتم التحديد':session.time}}</td>
                                <td>{{session.carbon==''?'لم يتم التحديد':session.carbon}}</td>
                                <!--<td>
                                    <button v-if="session.time==''||session.time==null"
                                            class="btn btn-sm btn-outline-info"
                                            @click="showModal(session.id,session.user_name)"><i
                                            class="fa fa-calendar"></i></button>
                                </td>-->
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <pagination :data="sessions" align="center" :limit="1" size="small"
                            @pagination-change-page="getAllData"></pagination>

            </div>
        </div>


        <!-- Modal -->
       <!-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">موعد جلسة المتدرب {{name}}</h5>

                    </div>
                    <div class="modal-body">
                        <div class="form-group row justify-content-center">
                            <div class="col-md-8">
                                <label>حدد موعد الجلسة</label>
                                <datetime value-zone="UTC+3" input-class="form-control" type="datetime"
                                          v-model="form.date"></datetime>
                            </div>


                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="d-flex justify-content-between w-100">
                            <button type="button" class="btn btn-secondary d-inline-block" data-dismiss="modal">إغلاق
                            </button>
                            <button type="button" @click="storeSession" class="btn btn-primary d-inline-block">حفظ
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    --></div>
</template>

<script>
    export default {
        name: "ResiveSessionComponent",
        data() {
            return {
                form: new Form({
                    id: '',
                    date: '',

                }),
                sessions: {},

                name: '',
            }
        },
        methods: {
            getAllData(page = 1) {
                axios.get(`${url}/dashboard/sessions/getAll?page=${page}`).then(res => {
                    this.sessions = res.data;
                })
            },
            showModal(id, name) {
                this.name = name;
                this.form.id = id;
                $('.modal').modal('show');
            },

            storeSession() {
                this.form.post(`${url}/dashboard/sessions/store`).then(({}) => {
                    Toast.fire({
                        icon: 'success',
                        title: 'تم تثبيت الحجز بنجاح'
                    });
                    this.getAllData();
                    this.form.reset();
                })
            }
        },
        mounted() {
            this.getAllData();
        }
    }
</script>

<style scoped>

</style>