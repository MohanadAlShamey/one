<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <span>جميع التدريبات</span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th>اسم المتدرب</th>
                                <th>اسم الدرس</th>
                                <th>اسم التدريب</th>
                                <th>المرفقات</th>
                                <th>تصحيح</th>
                            </tr>
                            <tr v-if="examples!=null" v-for="example in examples.data">
                                <td>{{example.user.name}}</td>
                                <td>{{example.example.lesson.name}}</td>
                                <td>{{example.example.name}}</td>
                                <td><a target="_blank" :href="`${url}/dashboard/completeExample/${example.id}/getFile`">مشاهدة</a></td>
                                <td>
                                    <a v-if="example.rate=='pending'" :href="`${url}/dashboard/examples/${example.example.id}/rate/user/${example.user.id}`" class="btn btn-sm btn-block btn-outline-success"><i class="fa fa-check"></i></a>
                                <span class="small" v-else>تم التقييم</span>
                                </td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AllExampleComponent",
        data(){
            return {
                examples:null,
                url,
            }
        },
        methods:{
            getAllExample(){
                axios.get(`${url}/dashboard/examples/getAllData`).then(res=>{
                    console.log(res.data)
                    this.examples=res.data;
                })
            }
        },
        created(){
            this.getAllExample();
        }
    }
</script>

<style scoped>

</style>