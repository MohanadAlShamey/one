<template>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">

                <div class="card-header">
                    <span>إضافة مستخدم جديد</span>
                </div>
                <div class="card-body">
                    <form @submit.prevent="save" @keydown="form.onKeydown($event)">
                    <div class="form-group">
                        <label >الاسم</label>
                        <input type="text" v-model="form.name" class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                        <has-error :form="form" field="name"></has-error>
                    </div>


                    <div class="form-group">
                        <label >اسم المستخدم</label>
                        <input type="text" v-model="form.username" class="form-control" :class="{ 'is-invalid': form.errors.has('username') }">
                        <has-error :form="form" field="username"></has-error>
                    </div>

                    <div class="form-group">
                        <label >البريد الإلكتروني</label>
                        <input type="email" v-model="form.email" class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                        <has-error :form="form" field="email"></has-error>
                    </div>

                    <div class="form-group">
                        <label >اسم الشركة</label>
                        <input type="text" v-model="form.company" class="form-control" :class="{ 'is-invalid': form.errors.has('company') }">
                        <has-error :form="form" field="company"></has-error>
                    </div>
                        <div class="form-group">
                            <label >موقع المستخدم</label>
                            <input type="url" placeholder="http://example.com" v-model="form.site" class="form-control" :class="{ 'is-invalid': form.errors.has('site') }">
                            <has-error :form="form" field="site"></has-error>
                        </div>
                    <div class="form-group">
                        <label >كلمة المرور</label>
                        <input type="password" v-model="form.password" class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                        <has-error :form="form" field="password"></has-error>
                    </div>

                        <div class="form-group">
                            <label >تاريخ التسجيل</label>
                            <input type="date" dataformatas="Y-m-d" v-model="form.created_at" class="form-control" :class="{ 'is-invalid': form.errors.has('created_at') }">
                            <!--<input type="time" dataformatas="H-m-i" v-model="form.time" class="form-control" :class="{ 'is-invalid': form.errors.has('created_at') }">-->
                            <has-error :form="form" field="created_at"></has-error>
                        </div>

                        <div class="form-group">
                            <label >إضافة أيام دوام</label>
                            <input type="number" step="1" v-model="form.reg_at" class="form-control" :class="{ 'is-invalid': form.errors.has('reg_at') }">
                            <!--<input type="time" dataformatas="H-m-i" v-model="form.time" class="form-control" :class="{ 'is-invalid': form.errors.has('created_at') }">-->
                            <has-error :form="form" field="reg_at"></has-error>
                        </div>

                    <div class="form-group">
                        <label >الصلاحيات</label>
                        <select multiple size="3" v-model="form.role_ids" class="form-control" :class="{ 'is-invalid': form.errors.has('role_ids') }">

                            <option v-for="role in roles" :value="role.id">{{role.display_name}}</option>

                        </select>
                        <has-error :form="form" field="role_ids"></has-error>
                    </div>
                        <button :disabled="form.busy" type="submit" class="btn btn-primary">حفظ</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    الميزات
                </div>
                <div class="card-body">
                    <div class="form-group" v-for="option in options">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" v-model="form.optionIds" :value="option.id" id="defaultCheck1">
                            <label class="form-check-label" for="defaultCheck1">
                               {{option.display}}
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AddUserComponent",
props:{
    date_now:String,
    options:Array,
},
        data(){
            return{
                roles:null,
                form:new Form({
                    name:'',
                    username:'',
                    site:'',
                    email:'',
                    company:'',
                    password:'',
                    role_ids:[],
                    created_at:this.date_now,
                    reg_at:0,
                    optionIds:[],
                })
            }
        },
         methods:{
            getRoles(){
                axios.get(`${url}/dashboard/roles/index`).then(({data})=>{
                    this.roles=data;
                   // this.form.fill(data.user);
                })
            },
             save(){
                this.form.post(`${url}/dashboard/users/store`).then(()=>{
                    Toast.fire({
                        icon:'success',
                        title:'تم إضافة المستخدم بنجاح',
                    })
                   this.form.clear()
                   this.form.reset()
                })
             }
         },
        created(){
            this.getRoles();
        }
    }
</script>

<style scoped>

</style>