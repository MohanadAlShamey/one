<template>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">

                <div class="card-header">
                    <span>{{lesson_name}}</span>
                </div>
                <div class="card-body">
                    <form @submit.prevent="save" @keydown="form.onKeydown($event)">
                        <div class="form-group">
                            <label>اسم الدرس</label>
                            <input type="text" v-model="form.name" class="form-control"
                                   :class="{ 'is-invalid': form.errors.has('name') }">
                            <has-error :form="form" field="name"></has-error>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label>ملف الدرس</label>
                                <a target="_blank" :href="`${url}/dashboard/lessons/${this.lesson_id}/file`">مشاهدة</a>
                                <input type="file" accept="application/vnd.ms-powerpoint,image/jpeg,image/png,application/pdf,application/vnd.openxmlformats-officedocument.wordprocessingml.document" class="form-control" @change="file=$event.target.files[0]"
                                       :class="{ 'is-invalid': form.errors.has('name') }">
                                <has-error :form="form" field="name"></has-error>
                            </div>

                        </div>
                        <div class="form-group">
                            <label>وصف الدرس</label>
                            <ckeditor name="body" v-model="form.body" :config="editorConfig"></ckeditor>
                        </div>

                        <div class="form-group">
                            <label>مدة تنفيذ الدرس</label>
                            <input type="number" v-model="form.after" class="form-control"
                                   :class="{ 'is-invalid': form.errors.has('after') }">
                            <has-error :form="form" field="after"></has-error>
                        </div>
                        <button :disabled="form.busy" type="submit" class="btn btn-primary">حفظ</button>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <span>الفيديوهات</span>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>اسم الفيديو</th>
                            <th>مشاهدة</th>
                            <th>رابط الفيديو</th>
                            <th>تحكم</th>
                        </tr>
                        <tr v-for="(video,i) in videos">

                            <td>
                                <input type="text" v-model="videos[i].name" class="form-control-sm">
                            </td>
                            <td><a target="_blank" :href="video.url">مشاهدة</a></td>

                            <td>
                                <input type="url" v-model="videos[i].url" class="form-control-sm">
                            </td>
                            <td>
                                <button class="btn-sm btn-sm btn-outline-primary" type="button" @click="updateVideo(i)"> تعديل <i class="fa fa-edit"></i></button>
                                <button class="btn-sm btn-sm btn-outline-danger" type="button" @click="deleteVideo(i)">حذف <i class="fa fa-trash"></i></button>
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <input type="text" v-model="new_videos.name" class="form-control-sm">
                            </td>
                            <td>
                                <a target="_blank" :href="new_videos.url">مشاهدة</a>
                            </td>
                            <td>
                                <input type="url" v-model="new_videos.url" class="form-control-sm">
                            </td>
                            <td>
                                <button class="btn-sm btn-primary" type="button" @click="saveVideo()">حفظ جديد</button>
                            </td>
                        </tr>
                    </table>
                </div>

            </div>



            <div class="card">
                <div class="card-header">
                    <span>التدريبات</span>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>اسم التدريب</th>
                            <th>وصف التدريب</th>

                            <th>تحكم</th>
                        </tr>
                        <tr v-for="(example,i) in examples">

                            <td>
                                <input type="text" v-model="examples[i].name" class="form-control-sm">
                            </td>
                            <td>
                                <textarea v-model="examples[i].body" class="form-control-sm"></textarea>
                            </td>
                            <td>
                                <button class="btn-sm btn-outline-primary" type="button" @click="updateExample(i)">
                                    تعديل <i class="fa fa-edit"></i>
                                </button>
                                <button class="btn-sm btn-outline-danger" type="button" @click="deleteExample(i)">
                                    حذف <i class="fa fa-trash"></i>
                                </button>
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <input type="text" v-model="new_example.name" class="form-control-sm">
                            </td>

                            <td>
                                <textarea v-model="new_example.body" class="form-control-sm"></textarea>
                            </td>
                            <td>
                                <button class="btn-sm btn-primary" type="button" @click="saveExample()">حفظ جديد</button>
                            </td>
                        </tr>
                    </table>
                </div>

            </div>



            <div class="card">
                <div class="card-header">
                    <span>المرفقات</span>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>اسم المرفق</th>
                            <th>مشاهدة</th>
                            <th>تحكم</th>
                        </tr>
                        <tr v-for="(attach,i) in attaches">

                            <td>
                                <input type="text" v-model="attaches[i].name" class="form-control-sm">
                            </td>
                            <td>
                                <a target="_blank" :href="`${url}/dashboard/attaches/${attaches[i].id}/file`">مشاهدة</a>
                            </td>
                            <td>
                                <button class="btn-sm btn-sm btn-outline-primary " type="button" @click="updateAttach(i)">    تعديل <i class="fa fa-edit"></i></button>
                                <button class="btn-sm btn-sm btn-outline-danger" type="button" @click="deleteAttach(i)">حذف <i class="fa fa-trash"></i></button>
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <input type="text" v-model="new_attach.name" class="form-control-sm">
                            </td>

                            <td>
                                <input accept="application/vnd.ms-powerpoint,image/jpeg,image/png,application/pdf,application/vnd.openxmlformats-officedocument.wordprocessingml.document" type="file" @change="new_attach.url=$event.target.files[0]" class="form-control-sm">
                            </td>
                            <td>
                                <button class="btn-sm btn-primary" type="button" @click="saveAttach()">حفظ جديد</button>
                            </td>
                        </tr>
                    </table>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "EditLessonComponent",
        props: ['lesson_id', 'lesson_name'],
        data() {
            return {

                new_videos: {
                        name:'',
                        url:''
                    },

                new_example: {
                    name:'',
                    body:''
                },
                new_attach:{
                    name:'',
                    url:''
                },
                url,
                file: '',
                editorConfig: {
                    language: 'ar',
                    /* uploadiamge: '',
                     filebrowserUploadUrl: url + '/uploadImg',
                     filebrowserBrowseUrl: url + '/browse',
                     filebrowserUploadMethod: 'form',
                     autoEmbed_widget: 'embedSemantic',*/
                },

                form: new Form({
                    name: '',
                    body: '',
                    after: '',
                    url: '',
                }),
                videos: null,
                examples:null,
                attaches:null,
            }
        },
        methods: {
            getSection() {
                axios.get(`${url}/dashboard/lessons/${this.lesson_id}/getLesson`).then(({data}) => {
                    //this.roles=data.roles;
                    this.form.fill(data.data);
                    this.videos = data.data.videos;
                    this.examples=data.data.examples
                    this.attaches=data.data.attaches
                })
            },
            save() {
                const fd = new FormData();
                fd.append('name', this.form.name);
                fd.append('body', this.form.body);
                fd.append('after', this.form.after);
                fd.append('url', this.file);
                axios.post(`${url}/dashboard/lessons/${this.lesson_id}/update`, fd).then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'تم تعديل الدرس بنجاح',
                    })

                    this.form.fill(data.data);

                })
            },
            updateVideo(i){
                axios.post(`${url}/dashboard/videos/${this.videos[i].id}/update`,this.videos[i]).then(({data})=>{
                    Toast.fire({
                        icon:'success',
                        title:'تم تعديل الفيديو بنجاح'
                    })
                    this.videos=data.data;
                })
            },
            saveVideo(i){
                axios.post(`${url}/dashboard/videos/${this.lesson_id}/store`,this.new_videos).then(({data})=>{
                    Toast.fire({
                        icon:'success',
                        title:'تم حفظ الفيديو بنجاح'
                    })
                    this.new_videos.name='';
                    this.new_videos.url='';
                    this.videos=data.data;
                })
            },
            deleteVideo(id){
                Swal.fire({
                    title: 'هل انت متأكد من حذف الفيديو',
                    text: "لن تستطيع التراجع",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'متأكد',
                    cancelButtonText:'إلغاء الأمر'
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.delete(`${url}/dashboard/videos/${this.videos[id].id}/delete`).then(({data})=>{
                            Swal.fire(
                                'تم الحذف',
                                '',
                                'success'
                            );
                            this.videos=data.data;
                        })
                    }
                })

            },

            updateExample(i){
                axios.post(`${url}/dashboard/examples/${this.examples[i].id}/update`,this.examples[i]).then(({data})=>{
                    Toast.fire({
                        icon:'success',
                        title:'تم تعديل التدريب بنجاح'
                    })
                    this.examples=data.data;
                })
            },
            saveExample(){
                axios.post(`${url}/dashboard/examples/${this.lesson_id}/store`,this.new_example).then(({data})=>{
                    Toast.fire({
                        icon:'success',
                        title:'تم حفظ التدريب بنجاح'
                    })
                    this.new_example.name='';
                    this.new_example.body='';
                    this.examples=data.data;
                })
            },
            deleteExample(id){
                Swal.fire({
                    title: 'هل انت متأكد من حذف التدريب',
                    text: "لن تستطيع التراجع",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'متأكد',
                    cancelButtonText:'إلغاء الأمر'
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.delete(`${url}/dashboard/examples/${this.examples[id].id}/delete`).then(({data})=>{
                            Swal.fire(
                                'تم الحذف',
                                '',
                                'success'
                            );
                            this.examples=data.data;
                        })
                    }
                })

            },

            updateAttach(i){
                axios.post(`${url}/dashboard/attaches/${this.attaches[i].id}/update`,this.attaches[i]).then(({data})=>{
                    Toast.fire({
                        icon:'success',
                        title:'تم تعديل المرفق بنجاح'
                    })
                    this.attaches=data.data;
                })
            },
            saveAttach(){
                const fd=new FormData();
                fd.append('name',this.new_attach.name);
                fd.append('url',this.new_attach.url);
                axios.post(`${url}/dashboard/attaches/${this.lesson_id}/store`,fd).then(({data})=>{
                    Toast.fire({
                        icon:'success',
                        title:'تم حفظ المرفق بنجاح'
                    })
                    this.new_example.name='';
                    this.new_example.body='';
                    this.attaches=data.data;
                })
            },
            deleteAttach(id){
                Swal.fire({
                    title: 'هل انت متأكد من حذف المرفق',
                    text: "لن تستطيع التراجع",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'متأكد',
                    cancelButtonText:'إلغاء الأمر'
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.delete(`${url}/dashboard/attaches/${this.attaches[id].id}/delete`).then(({data})=>{
                            Swal.fire(
                                'تم الحذف',
                                '',
                                'success'
                            );
                            this.attaches=data.data;
                        })
                    }
                })

            },
        },
        created() {
            this.getSection();
        },

    }
</script>

<style scoped>

</style>