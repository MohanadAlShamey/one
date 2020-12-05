<template>
    <ul class="navbar-nav mr-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fa fa-bell"></i>
                <span class="badge badge-warning navbar-badge">{{num_notify}}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">
                <span class="dropdown-item dropdown-header">{{num_notify}} إشعارات</span>
                <div class="dropdown-divider"></div>
<span v-for="not in notify">
   <a :href="`${url}/dashboard/examples/${not.data.example_id}/rate/user/${not.data.user_id}/notyfi/${not.id}`" class="dropdown-item">
                    <i class="fa fa-envelope ml-2"></i>{{not.data.user}}
                    <span class="float-left text-muted text-sm" style="white-space: initial">{{not.data.example_name}}</span>
                </a>
                <div class="dropdown-divider"></div>
</span>
                <a href="" class="dropdown-item dropdown-footer">مشاهده همه نوتیفیکیشن</a>
            </div>
        </li>
    </ul>
</template>

<script>
    export default {
        name: "AdminNotiFyComponent",
        data(){
            return {
                num_notify:0,
                notify:null,
                url,
            }
        },
        methods:{
            getNotify(){
                axios.get(`${url}/dashboard/getNotify`).then(({data})=>{
                    this.notify=data.notify;
                    this.num_notify=data.count;

                })
            }
        },
        created(){
            this.getNotify();
            setInterval(()=>{
                this.getNotify();
            },15000)
        }
    }
</script>

<style scoped>

</style>