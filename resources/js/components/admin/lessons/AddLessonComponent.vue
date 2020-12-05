<template>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">

                <div class="card-header">
                    <span>إضافة درس جديد</span>
                </div>
                <div class="card-body">
                    <form @submit.prevent="save" @keydown="form.onKeydown($event)">
                        <div class="form-group">
                            <label>اسم الدرس</label>
                            <input type="text" v-model="form.name" class="form-control"
                                   :class="{ 'is-invalid': form.errors.has('name') }">
                            <has-error :form="form" field="name"></has-error>
                        </div>

                        <div class="form-group">
                            <label>ملف الدرس</label>
                            <input type="file" class="form-control" accept="image/jpeg,image/png,application/pdf,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-powerpoint" @change="form.url=$event.target.files[0]"
                                   :class="{ 'is-invalid': form.errors.has('name') }">
                            <has-error :form="form" field="name"></has-error>
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

                        <h3 class="title py-3">الفيديوهات</h3>
                        <div class="form-group row" v-for="(a,i) in videos">

                            <div class="col-md-6">
                                <label> اسم الفيديو</label>
                                <input type="text" class="form-control" v-model="form.videos[i].name">
                            </div>

                            <div class="col-md-6">
                                <label>رابط الفيديو</label>
                                <input type="text" class="form-control" v-model="form.videos[i].url">
                            </div>

                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-sm btn-outline-secondary" type="button" @click="videos++">فيديو جديد
                                <i class="fa fa-plus"></i></button>
                        </div>
                        <h3 class="title py-3">التدريبات</h3>
                        <div class="form-group row" v-for="(a,i) in example">

                            <div class="col-md-6">
                                <label> اسم التدريب</label>
                                <input type="text" class="form-control" v-model="form.examples[i].name">

                            </div>

                            <div class="col-md-6">
                                <label>وصف التدريب</label>
                                <input type="text" class="form-control" v-model="form.examples[i].body">
                            </div>

                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-sm btn-outline-secondary" type="button" @click="example++">تدريب جديد
                                <i class="fa fa-plus"></i></button>
                        </div>
                        <h3 class="title py-3">المرفقات</h3>
                        <div class="form-group row" v-for="(a,i) in attaches">

                            <div class="col-md-6">
                                <label> اسم المرفق</label>
                                <input type="text" class="form-control" v-model="form.attaches[i].name">

                            </div>

                            <div class="col-md-6">
                                <label>الملف المرفق</label>
                                <input accept="application/vnd.ms-powerpoint,image/jpeg,image/png,application/pdf,application/vnd.openxmlformats-officedocument.wordprocessingml.document" type="file"
                                       class="form-control-file" @change="changeFile($event,i)">
                            </div>

                        </div>
                        <div class="col-md-12 py-3">
                            <button class="btn btn-sm btn-outline-secondary" type="button" @click="attaches++">مرفق جديد
                                <i class="fa fa-plus"></i></button>
                        </div>
                        <button :disabled="form.busy" type="submit" class="btn btn-primary d-inline-block py-2">حفظ</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AddLessonComponent",
        props: ['section_id'],
        data() {
            return {
                editorConfig: {
                    language: 'ar',
                   /* uploadiamge: '',
                    filebrowserUploadUrl: url + '/uploadImg',
                    filebrowserBrowseUrl: url + '/browse',
                    filebrowserUploadMethod: 'form',
                    autoEmbed_widget: 'embedSemantic',*/
                },
                videos: 1,
                example: 1,
                attaches: 1,
                url,
                form: new Form({
                    url: '',
                    name: '',
                    after: 1,
                    body: '',
                    videos: [],
                    examples: [],
                    attaches: [],
                }),
                lesson_id: null,
            }
        },
        methods: {
            changeFile(e, i) {
                this.form.attaches[i].url = e.target.files[0];
            },
            save() {
                const fd = new FormData();
                this.form.examples.forEach((el, i) => {
                    fd.append(`examples[${i}][name]`, el.name);
                    fd.append(`examples[${i}][body]`, el.body);
                })
                this.form.videos.forEach((el, i) => {
                    fd.append(`videos[${i}][name]`, el.name);
                    fd.append(`videos[${i}][url]`, el.url);
                })
                this.form.attaches.forEach((el, i) => {
                    fd.append(`attach[${i}][name]`, el.name)
                    fd.append(`attach[${i}][url]`, el.url);
                })

                fd.append('url', this.form.url);
                fd.append('name', this.form.name);
                fd.append('body', this.form.body);
                fd.append('after', this.form.after);

                axios.post(`${url}/dashboard/sections/${this.section_id}/lessons/store`, fd).then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'تم إضافة الدرس بنجاح'
                    })
                    setTimeout(()=>{
                        window.location.href=`${url}/dashboard/sections/${this.section_id}/show`;
                    },500);
                    this.videos=1;
                    this.example= 1;
                    this.attaches= 1
                    this.form.reset();

                });

            },

        },
        created() {
            this.form.videos.push({name: '', url: ''})
            this.form.examples.push({name: '', body: ''})
            this.form.attaches.push({name: '', url: ''})
        },
        watch: {
            videos: function (i) {
                this.form.videos.push({name: '', url: ''})
            },
            example: function (i) {
                this.form.examples.push({name: '', body: ''})
            },
            attaches: function (i) {
                this.form.attaches.push({name: '', url: ''})
            }
        }
    }
</script>

<style scoped>

</style>