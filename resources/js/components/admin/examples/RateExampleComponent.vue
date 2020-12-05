<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
{{example_name}}
                </div>
                <div class="card-body" v-if="example!=null">
<div class="img-thumbnail" v-if="example.body!=null && example.body!=''">
    {{example.body}}
</div>
                    <span>الملف المرفق</span> | <a target="_blank" :href="`${url}/dashboard/completeExample/${example.id}/getFile`">مشاهدة</a>
                    <br>
                <h5 class="title py-2">تقييم</h5>
                    <star-rating v-if="example.rate!='pending'" :read-only="true" :rating="example.rate" :rtl="true"  :increment="0.5" :star-size="20" :max-rating="10"  text-class="custom-text" />
                    <div v-else>
                        <star-rating  :rtl="true" v-model="form.rate" :increment="0.5" :star-size="20" :max-rating="10"  text-class="custom-text" />
                        <button  class="btn btn-sm btn-outline-success" type="button" @click="rate()"><i class="fa fa-check"></i></button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "RateExampleComponent",
        props:['example_id','example_name','user_id','user_name'],
        data(){
            return {
example:null,
                url,
                form:new Form({
                    id:'',
                    rate:0,
                })
            }
        },
        methods:{
            getExample(){
                axios.get(`${url}/dashboard/examples/${this.example_id}/rate/user/${this.user_id}/getData`).then(({data})=>{
                    this.example=data.data;
                })
            },
            rate(){
                this.form.id=this.example.id;
                this.form.post(`${url}/dashboard/examples/${this.example.id}/rate`).then(()=>{
                    Toast.fire({
                        icon:'success',
                        title:'تم تقييم التدريب'
                    })
                })
            }
        },
        created(){
            this.getExample()
        }
    }
</script>

<style scoped>


</style>