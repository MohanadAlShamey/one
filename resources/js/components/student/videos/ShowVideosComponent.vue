<template>
    <div>
        <h6 class="title mb-2">فيديوهات الدرس</h6>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th>اسم الفيديو</th>
                    <th>رابط الفيديو</th>
                    <th>الحالة</th>
                </tr>

                <tr v-for="video in videos">
                    <td>{{video.name}}</td>
                    <td>
                        <a :href="`${url}/student/${video.id}/getViedio`"
                           target="_blank">
                            مشاهدة الفيديو
                        </a>



                    </td>
                    <td>
                        <kbd v-if="video.visit" class="mx-2 small">لم تتم المشاهدة</kbd>

                        <i v-else class="fa fa-check-circle text-success"></i>
                    </td>
                </tr>

            </table>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ShowVideosComponent",
        props:['lesson_id'],

        data(){
            return {
                url,
                videos:null
            }
        },
        methods:{
            getVideos(){
                axios.get(`${url}/student/lessons/${this.lesson_id}/getVideos`).then(({data})=>{
                    this.videos=data.data;
                })
            }
        },
        created(){
            this.getVideos();
            setInterval(()=>{
                this.getVideos();
            },60000)
        }
    }
</script>

<style scoped>

</style>