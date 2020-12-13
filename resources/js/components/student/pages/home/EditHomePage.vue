<template>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form @submit.prevent="save" @keydown="form.onKeydown($event)">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label>عنوان الصفحة</label>
                            <input v-model="form.name" type="text" name="name"
                                   class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                            <has-error :form="form" field="name"></has-error>
                        </div>
                        <div class="form-group">
                            <label>لوغو الصفحة</label>
                            <input @change="changeImg($event,'logo')" type="file" name="name"
                                   class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                            <has-error :form="form" field="name"></has-error>
                        </div>
                    </div>
                </div>
                <div class="card group1">
                    <div class="card-header">

                        <div class="d-flex justify-content-start">
                            <div class="form-check-inline mx-2">
                                <input class="form-check-input" type="checkbox"  v-model="form.group1.active" :value="true" >
                            </div>
                            <span>المجموعة الأولى</span>
                            <!-- <a :href="`${url}/student/pages`"><i class="fa fa-backward"></i></a>-->
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>لون الخط</label>
                            <input type="color" v-model="form.group1.color" class="form-control">
                        </div>
                        <!--<div class="form-group">
                            <label>لوغو</label>
                            <input @change="changeImg($event,'logo')" type="file"
                                   class="form-control" :class="{ 'is-invalid': form.errors.has('img_video') }">
                            <span class="text-danger small" v-if="form.errors.has('img_video')">{{form.errors.get('img_video')}}</span>
                        </div>-->

                        <div class="form-group">
                            <label>عنوان رئيسي للموقع</label>
                            <input type="text" v-model="form.group1.title" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>نبذة عن الشركة</label>
                            <textarea type="text" v-model="form.group1.body" class="form-control"></textarea>
                        </div>
                        <!--Background-->
                        <div class="form-group">
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" v-model="group1_bg"
                                       value="img" checked>
                                <label class="form-check-label" for="">
                                    صورة
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" v-model="group1_bg"
                                       value="color">
                                <label class="form-check-label" for="">
                                    لون
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" v-model="group1_bg"
                                       value="css">
                                <label class="form-check-label" for="">
                                    تدرج لوني
                                </label>
                            </div>
                        </div>
                        <div class="form-group" v-if="group1_bg=='color'">
                            <label>الخلفية / لون</label>
                            <input type="color" v-model="form.group1.bg" class="form-control">
                        </div>
                        <div class="form-group" v-else-if="group1_bg=='img'">
                            <label>الخلفية/صورة</label>
                            <input @change="changeImg($event,'group1_bg')" type="file"
                                   class="form-control" :class="{ 'is-invalid': form.errors.has('img_video') }">
                            <!--<button type="button" @click="form.group1.bg='#000'" class="btn btn-sm"><i class="fa fa-plus"></i></button>-->
                        </div>
                        <div class="form-group"  v-else-if="group1_bg=='img'">
                            <label>نوع الخلفية</label>
                            <select v-model="form.group1.size" class="form-control">
                                <option value="cover">غلاف</option>
                                <option value="contain">إحتواء</option>
                                <option value="repeat">تكرار</option>
                            </select>
                        </div>
                        <div class="form-row" v-else-if="group1_bg=='css'">
                            <div class="col-6">
                                <label>الخلفية/تدرج لوني</label>
                                <select v-model="form.group1.bg" name="" id="" class="form-control">
                                    <option v-for="(bg,i) in bg_css" :value="bg.value">{{bg.name}} {{i}}</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <div style="min-height: 150px" class="w-100" :style="form.group1.bg"></div>
                            </div>

                            <!--<button type="button" @click="form.group1.bg='#000'" class="btn btn-sm"><i class="fa fa-plus"></i></button>-->
                        </div>
                        <!--End BackGround-->

                    </div>
                </div>


                <div class="card group2">
                    <div class="card-header">
                        <div class="form-check-inline">
                            <input class="form-check-input" type="checkbox"  v-model="form.group2.active" :value="true" >

                        </div>
                        <span> المجموعة الثانية</span>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>لون الخط</label>
                            <input type="color" v-model="form.group2.color" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>من نحن</label>
                            <textarea  v-model="form.group2.body" class="form-control"></textarea>
                        </div>
                        <!--Background-->
                        <div class="form-group">
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" v-model="group2_bg"
                                       value="img" checked>
                                <label class="form-check-label" for="">
                                    صورة
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" v-model="group2_bg"
                                       value="color">
                                <label class="form-check-label" for="">
                                    لون
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" v-model="group2_bg"
                                       value="css">
                                <label class="form-check-label" for="">
                                    تدرج لوني
                                </label>
                            </div>
                        </div>
                        <div class="form-group" v-if="group2_bg=='color'">
                            <label>الخلفية / لون</label>
                            <input type="color" v-model="form.group2.bg" class="form-control">
                        </div>
                        <div class="form-group" v-else-if="group2_bg=='img'">
                            <label>الخلفية/صورة</label>
                            <input @change="changeImg($event,'group2_bg')" type="file"
                                   class="form-control" :class="{ 'is-invalid': form.errors.has('img_video') }">
                            <!--<button type="button" @click="form.group1.bg='#000'" class="btn btn-sm"><i class="fa fa-plus"></i></button>-->
                        </div>
                        <div class="form-group"  v-else-if="group2_bg=='img'">
                            <label>نوع الخلفية</label>
                            <select v-model="form.group2.size" class="form-control">
                                <option value="cover">غلاف</option>
                                <option value="contain">إحتواء</option>
                                <option value="repeat">تكرار</option>
                            </select>
                        </div>
                        <div class="form-row" v-else-if="group2_bg=='css'">
                            <div class="col-6">
                                <label>الخلفية/تدرج لوني</label>
                                <select v-model="form.group2.bg" name=""  class="form-control">
                                    <option v-for="(bg,i) in bg_css" :value="bg.value">{{bg.name}} {{i}}</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <div style="min-height: 150px" class="w-100" :style="form.group2.bg"></div>
                            </div>

                            <!--<button type="button" @click="form.group1.bg='#000'" class="btn btn-sm"><i class="fa fa-plus"></i></button>-->
                        </div>
                        <!--End BackGround-->
                    </div>
                </div>


                <div class="card group3">
                    <div class="card-header">
                        <div class="form-check-inline">
                            <input class="form-check-input" type="checkbox"  v-model="form.group3.active" :value="true" >
                        </div>
                        <span> المجموعة الثالثة</span>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>لون الخط</label>
                            <input type="color" v-model="form.group3.color" class="form-control">
                        </div>
                        <div class="form-group">
                            <label >خدماتنا</label>
                            <service-template v-for="(item,index) in form.group3.services.length"
                                              :name="form.group3.services[index].name" :img="form.group3.services[index].img" :description="form.group3.services[index].description"
                                              :key="index" @change-value="changeService($event,index)"></service-template>
                            <button type="button" @click="form.group3.services.push({name:'',img:'',description:''})" class="btn btn-sm"><i class="fa fa-plus"></i></button>
                        </div>

                        <!--Background-->
                        <div class="form-group">
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" v-model="group3_bg"
                                       value="img" checked>
                                <label class="form-check-label" for="">
                                    صورة
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" v-model="group3_bg"
                                       value="color">
                                <label class="form-check-label" for="">
                                    لون
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" v-model="group3_bg"
                                       value="css">
                                <label class="form-check-label" for="">
                                    تدرج لوني
                                </label>
                            </div>
                        </div>
                        <div class="form-group" v-if="group3_bg=='color'">
                            <label>الخلفية / لون</label>
                            <input type="color" v-model="form.group3.bg" class="form-control">
                        </div>
                        <div class="form-group" v-else-if="group3_bg=='img'">
                            <label>الخلفية/صورة</label>
                            <input @change="changeImg($event,'group3_bg')" type="file"
                                   class="form-control" :class="{ 'is-invalid': form.errors.has('img_video') }">
                            <!--<button type="button" @click="form.group1.bg='#000'" class="btn btn-sm"><i class="fa fa-plus"></i></button>-->
                        </div>
                        <div class="form-group"  v-else-if="group3_bg=='img'">
                            <label>نوع الخلفية</label>
                            <select v-model="form.group3.size" class="form-control">
                                <option value="cover">غلاف</option>
                                <option value="contain">إحتواء</option>
                                <option value="repeat">تكرار</option>
                            </select>
                        </div>
                        <div class="form-row" v-else-if="group3_bg=='css'">
                            <div class="col-6">
                                <label>الخلفية/تدرج لوني</label>
                                <select v-model="form.group3.bg" name=""  class="form-control">
                                    <option v-for="(bg,i) in bg_css" :value="bg.value">{{bg.name}} {{i}}</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <div style="min-height: 150px" class="w-100" :style="form.group3.bg"></div>
                            </div>

                            <!--<button type="button" @click="form.group1.bg='#000'" class="btn btn-sm"><i class="fa fa-plus"></i></button>-->
                        </div>
                        <!--End BackGround-->

                    </div>
                </div>



                <div class="card group4">
                    <div class="card-header">
                        <div class="form-check-inline">
                            <input class="form-check-input" type="checkbox"  v-model="form.group4.active" :value="true" >

                        </div>
                        <span> المجموعة الرابعة</span>


                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>لون الخط</label>
                            <input type="color" v-model="form.group4.color" class="form-control">
                        </div>
                        <div class="form-group">
                            <label >المعرض</label>
                            <gallery-template v-for="(item,index) in form.group4.gallery.length"
                                              :name="form.group4.gallery[index].name" :img="form.group4.gallery[index].img" :description="form.group4.gallery[index].description"
                                              @change-value="changeGallery($event,index)" :key="index"></gallery-template>
                            <button type="button" @click="form.group4.gallery.push({name:'',img:'',description:''})" class="btn btn-sm"><i class="fa fa-plus"></i></button>
                        </div>


                        <!--Background-->
                        <div class="form-group">
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" v-model="group4_bg"
                                       value="img" checked>
                                <label class="form-check-label" for="">
                                    صورة
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" v-model="group4_bg"
                                       value="color">
                                <label class="form-check-label" for="">
                                    لون
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" v-model="group4_bg"
                                       value="css">
                                <label class="form-check-label" for="">
                                    تدرج لوني
                                </label>
                            </div>
                        </div>
                        <div class="form-group" v-if="group4_bg=='color'">
                            <label>الخلفية / لون</label>
                            <input type="color" v-model="form.group4.bg" class="form-control">
                        </div>
                        <div class="form-group" v-else-if="group4_bg=='img'">
                            <label>الخلفية/صورة</label>
                            <input @change="changeImg($event,'group4_bg')" type="file"
                                   class="form-control" :class="{ 'is-invalid': form.errors.has('img_video') }">
                            <!--<button type="button" @click="form.group1.bg='#000'" class="btn btn-sm"><i class="fa fa-plus"></i></button>-->
                        </div>
                        <div class="form-group"  v-else-if="group4_bg=='img'">
                            <label>نوع الخلفية</label>
                            <select v-model="form.group4.size" class="form-control">
                                <option value="cover">غلاف</option>
                                <option value="contain">إحتواء</option>
                                <option value="repeat">تكرار</option>
                            </select>
                        </div>
                        <div class="form-row" v-else-if="group4_bg=='css'">
                            <div class="col-6">
                                <label>الخلفية/تدرج لوني</label>
                                <select v-model="form.group4.bg" name=""  class="form-control">
                                    <option v-for="(bg,i) in bg_css" :value="bg.value">{{bg.name}} {{i}}</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <div style="min-height: 150px" class="w-100" :style="form.group4.bg"></div>
                            </div>

                            <!--<button type="button" @click="form.group1.bg='#000'" class="btn btn-sm"><i class="fa fa-plus"></i></button>-->
                        </div>
                        <!--End BackGround-->
                    </div>
                </div>


                <div class="card group5">
                    <div class="card-header">
                        <div class="form-check-inline">
                            <input class="form-check-input" type="checkbox"  v-model="form.group5.active" :value="true" >

                        </div>
                        <span>نموذج إتصل بنا</span>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>لون الخط</label>
                            <input type="color" v-model="form.group5.color" class="form-control">
                        </div>
                        <!--Background-->
                        <div class="form-group">
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" v-model="group5_bg"
                                       value="img" checked>
                                <label class="form-check-label" for="">
                                    صورة
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" v-model="group5_bg"
                                       value="color">
                                <label class="form-check-label" for="">
                                    لون
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" v-model="group5_bg"
                                       value="css">
                                <label class="form-check-label" for="">
                                    تدرج لوني
                                </label>
                            </div>
                        </div>
                        <div class="form-group" v-if="group5_bg=='color'">
                            <label>الخلفية / لون</label>
                            <input type="color" v-model="form.group5.bg" class="form-control">
                        </div>
                        <div class="form-group" v-else-if="group5_bg=='img'">
                            <label>الخلفية/صورة</label>
                            <input @change="changeImg($event,'group5_bg')" type="file"
                                   class="form-control" :class="{ 'is-invalid': form.errors.has('img_video') }">
                            <!--<button type="button" @click="form.group1.bg='#000'" class="btn btn-sm"><i class="fa fa-plus"></i></button>-->
                        </div>
                        <div class="form-group"  v-else-if="group5_bg=='img'">
                            <label>نوع الخلفية</label>
                            <select v-model="form.group5.size" class="form-control">
                                <option value="cover">غلاف</option>
                                <option value="contain">إحتواء</option>
                                <option value="repeat">تكرار</option>
                            </select>
                        </div>
                        <div class="form-row" v-else-if="group5_bg=='css'">
                            <div class="col-6">
                                <label>الخلفية/تدرج لوني</label>
                                <select v-model="form.group5.bg" name=""  class="form-control">
                                    <option v-for="(bg,i) in bg_css" :value="bg.value">{{bg.name}} {{i}}</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <div style="min-height: 150px" class="w-100" :style="form.group5.bg"></div>
                            </div>

                            <!--<button type="button" @click="form.group1.bg='#000'" class="btn btn-sm"><i class="fa fa-plus"></i></button>-->
                        </div>
                        <!--End BackGround-->
                    </div>
                </div>


                <div class="card group6">
                    <div class="card-header">
                        <div class="form-check-inline">
                            <input class="form-check-input" type="checkbox"  v-model="form.group6.active" :value="true" >

                        </div>
                        <span>المجموعة السادسة</span>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>لون الخط</label>
                            <input type="color" v-model="form.group6.color" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>صفحة فيسبوك</label>
                            <input type="url" v-model="form.group6.face" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>صفحة تويتر</label>
                            <input type="url" v-model="form.group6.twitter" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>صفحة إنستغرام</label>
                            <input type="url" v-model="form.group6.inestagram" class="form-control">
                        </div>
                        <!--Background-->
                        <div class="form-group">
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" v-model="group6_bg"
                                       value="img" checked>
                                <label class="form-check-label" for="">
                                    صورة
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" v-model="group6_bg"
                                       value="color">
                                <label class="form-check-label" for="">
                                    لون
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" v-model="group6_bg"
                                       value="css">
                                <label class="form-check-label" for="">
                                    تدرج لوني
                                </label>
                            </div>
                        </div>
                        <div class="form-group" v-if="group6_bg=='color'">
                            <label>الخلفية / لون</label>
                            <input type="color" v-model="form.group6.bg" class="form-control">
                        </div>
                        <div class="form-group" v-else-if="group6_bg=='img'">
                            <label>الخلفية/صورة</label>
                            <input @change="changeImg($event,'group6_bg')" type="file"
                                   class="form-control" :class="{ 'is-invalid': form.errors.has('img_video') }">
                            <!--<button type="button" @click="form.group1.bg='#000'" class="btn btn-sm"><i class="fa fa-plus"></i></button>-->
                        </div>
                        <div class="form-group"  v-else-if="group6_bg=='img'">
                            <label>نوع الخلفية</label>
                            <select v-model="form.group6.size" class="form-control">
                                <option value="cover">غلاف</option>
                                <option value="contain">إحتواء</option>
                                <option value="repeat">تكرار</option>
                            </select>
                        </div>
                        <div class="form-row" v-else-if="group6_bg=='css'">
                            <div class="col-6">
                                <label>الخلفية/تدرج لوني</label>
                                <select v-model="form.group6.bg" name=""  class="form-control">
                                    <option v-for="(bg,i) in bg_css" :value="bg.value">{{bg.name}} {{i}}</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <div style="min-height: 150px" class="w-100" :style="form.group6.bg"></div>
                            </div>

                            <!--<button type="button" @click="form.group1.bg='#000'" class="btn btn-sm"><i class="fa fa-plus"></i></button>-->
                        </div>
                        <!--End BackGround-->
                    </div>
                </div>


                <div class="card group7">
                    <div class="card-header">
                        <div class="form-check-inline">
                            <input class="form-check-input" type="checkbox"  v-model="form.group7.active" :value="true" >
                        </div>
                        <span> إعدادات الصفحة</span>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label>اسم المستخدم</label>
                            <input type="text" v-model="form.group7.name" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>البريد الإلكتروني</label>
                            <input type="email" v-model="form.group7.email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>اسم الشركة</label>
                            <input type="text" v-model="form.group7.company" class="form-control">
                        </div>


                    </div>
                </div>
                <button :disabled="form.busy" type="submit" class="btn btn-primary">حفظ</button>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        name: "EditHomePage",
        props:{page:Object},
        data() {
            return {
                bg_css:[
                    {name:'تدرج ',value:`background-image: radial-gradient(circle at center center, rgba(33,33,33,0),rgb(33,33,33)),repeating-linear-gradient(135deg, rgb(33,33,33) 0px, rgb(33,33,33) 1px,transparent 1px, transparent 4px),repeating-linear-gradient(45deg, rgb(56,56,56) 0px, rgb(56,56,56) 5px,transparent 5px, transparent 6px),linear-gradient(90deg, rgb(33,33,33),rgb(33,33,33));`,},
                    {name:'تدرج ',value:`background-image: repeating-linear-gradient(45deg, rgba(97,97,97,0.1) 0px, rgba(97,97,97,0.1) 2px,transparent 2px, transparent 4px),linear-gradient(90deg, rgb(43,43,43),rgb(43,43,43)`},
                    {name:'تدرج ',value:`background-image: repeating-linear-gradient(67.5deg, hsla(145,0%,97%,0.2) 0px, hsla(145,0%,97%,0.2) 0px,transparent 0px, transparent 1px,hsla(145,0%,97%,0.2) 1px, hsla(145,0%,97%,0.2) 4px,transparent 4px, transparent 5px,hsla(145,0%,97%,0.2) 5px, hsla(145,0%,97%,0.2) 8px),repeating-linear-gradient(0deg, hsla(145,0%,97%,0.2) 0px, hsla(145,0%,97%,0.2) 0px,transparent 0px, transparent 1px,hsla(145,0%,97%,0.2) 1px, hsla(145,0%,97%,0.2) 4px,transparent 4px, transparent 5px,hsla(145,0%,97%,0.2) 5px, hsla(145,0%,97%,0.2) 8px),linear-gradient(135deg, rgb(237, 237, 237),rgb(199, 199, 199));`},
                    {name:'تدرج ',value:`background-image: repeating-linear-gradient(22.5deg, hsla(337,0%,64%,0.2) 0px, hsla(337,0%,64%,0.2) 0px,transparent 0px, transparent 1px,hsla(337,0%,64%,0.2) 1px, hsla(337,0%,64%,0.2) 4px,transparent 4px, transparent 5px,hsla(337,0%,64%,0.2) 5px, hsla(337,0%,64%,0.2) 8px),repeating-linear-gradient(157.5deg, hsla(337,0%,64%,0.2) 0px, hsla(337,0%,64%,0.2) 0px,transparent 0px, transparent 1px,hsla(337,0%,64%,0.2) 1px, hsla(337,0%,64%,0.2) 4px,transparent 4px, transparent 5px,hsla(337,0%,64%,0.2) 5px, hsla(337,0%,64%,0.2) 8px),linear-gradient(135deg, rgb(168, 168, 168),rgb(60, 60, 60));`},
                    {name:'تدرج ',value:`background-image: repeating-linear-gradient(297deg, hsla(359,0%,70%,0.12) 0px,transparent 2px,hsla(359,0%,70%,0.12) 7px,transparent 9px,hsla(359,0%,70%,0.12) 14px,transparent 16px,hsla(359,0%,70%,0.12) 21px),repeating-linear-gradient(59deg, hsla(359,0%,70%,0.12) 0px,transparent 2px,hsla(359,0%,70%,0.12) 7px,transparent 9px,hsla(359,0%,70%,0.12) 14px,transparent 16px,hsla(359,0%,70%,0.12) 21px),repeating-linear-gradient(0deg, hsla(359,0%,70%,0.12) 0px,transparent 2px,hsla(359,0%,70%,0.12) 7px,transparent 9px,hsla(359,0%,70%,0.12) 14px,transparent 16px,hsla(359,0%,70%,0.12) 21px),linear-gradient(90deg, rgb(253,253,253),rgb(253,253,253));`},
                    {name:'تدرج ',value:`background-image: repeating-linear-gradient(140deg, hsla(295,0%,82%,0.12) 0px,transparent 2px,hsla(295,0%,82%,0.12) 7px,transparent 9px,hsla(295,0%,82%,0.12) 14px),repeating-linear-gradient(38deg, hsla(295,0%,82%,0.12) 0px,transparent 2px,hsla(295,0%,82%,0.12) 7px,transparent 9px,hsla(295,0%,82%,0.12) 14px),repeating-linear-gradient(0deg, hsla(295,0%,82%,0.15) 0px, hsla(295,0%,82%,0.15) 0px,transparent 0px, transparent 1px,hsla(295,0%,82%,0.15) 1px, hsla(295,0%,82%,0.15) 4px,transparent 4px, transparent 5px,hsla(295,0%,82%,0.15) 5px, hsla(295,0%,82%,0.15) 8px),repeating-linear-gradient(90deg, hsla(295,0%,82%,0.15) 0px, hsla(295,0%,82%,0.15) 0px,transparent 0px, transparent 1px,hsla(295,0%,82%,0.15) 1px, hsla(295,0%,82%,0.15) 4px,transparent 4px, transparent 5px,hsla(295,0%,82%,0.15) 5px, hsla(295,0%,82%,0.15) 8px),linear-gradient(90deg, rgb(58,58,58),rgb(58,58,58));`},
                    {name:'تدرج ',value:`background-image: repeating-linear-gradient(148deg, hsla(54,0%,87%,0.12) 0px, hsla(54,0%,87%,0.12) 1px,transparent 1px, transparent 4px,hsla(54,0%,87%,0.12) 4px, hsla(54,0%,87%,0.12) 5px,transparent 5px, transparent 7px,hsla(54,0%,87%,0.12) 7px, hsla(54,0%,87%,0.12) 8px),repeating-linear-gradient(119deg, hsla(54,0%,87%,0.12) 0px, hsla(54,0%,87%,0.12) 1px,transparent 1px, transparent 4px,hsla(54,0%,87%,0.12) 4px, hsla(54,0%,87%,0.12) 5px,transparent 5px, transparent 7px,hsla(54,0%,87%,0.12) 7px, hsla(54,0%,87%,0.12) 8px),repeating-linear-gradient(0deg, hsla(54,0%,87%,0.15) 0px, hsla(54,0%,87%,0.15) 0px,transparent 0px, transparent 1px,hsla(54,0%,87%,0.15) 1px, hsla(54,0%,87%,0.15) 4px,transparent 4px, transparent 5px,hsla(54,0%,87%,0.15) 5px, hsla(54,0%,87%,0.15) 8px),repeating-linear-gradient(90deg, hsla(54,0%,87%,0.15) 0px, hsla(54,0%,87%,0.15) 0px,transparent 0px, transparent 1px,hsla(54,0%,87%,0.15) 1px, hsla(54,0%,87%,0.15) 4px,transparent 4px, transparent 5px,hsla(54,0%,87%,0.15) 5px, hsla(54,0%,87%,0.15) 8px),linear-gradient(90deg, rgb(251,251,251),rgb(251,251,251));`},
                    {name:'تدرج ',value:`background-image: repeating-linear-gradient(188deg, hsla(171,0%,87%,0.12) 0px, hsla(171,0%,87%,0.12) 2px,transparent 2px, transparent 5px,hsla(171,0%,87%,0.12) 5px, hsla(171,0%,87%,0.12) 7px,transparent 7px, transparent 9px,hsla(171,0%,87%,0.12) 9px, hsla(171,0%,87%,0.12) 11px),repeating-linear-gradient(162deg, hsla(171,0%,87%,0.12) 0px, hsla(171,0%,87%,0.12) 2px,transparent 2px, transparent 5px,hsla(171,0%,87%,0.12) 5px, hsla(171,0%,87%,0.12) 7px,transparent 7px, transparent 14px,hsla(171,0%,87%,0.12) 14px, hsla(171,0%,87%,0.12) 16px),repeating-linear-gradient(0deg, hsla(171,0%,87%,0.15) 0px, hsla(171,0%,87%,0.15) 0px,transparent 0px, transparent 1px,hsla(171,0%,87%,0.15) 1px, hsla(171,0%,87%,0.15) 4px,transparent 4px, transparent 5px,hsla(171,0%,87%,0.15) 5px, hsla(171,0%,87%,0.15) 8px),repeating-linear-gradient(90deg, hsla(171,0%,87%,0.15) 0px, hsla(171,0%,87%,0.15) 0px,transparent 0px, transparent 1px,hsla(171,0%,87%,0.15) 1px, hsla(171,0%,87%,0.15) 4px,transparent 4px, transparent 5px,hsla(171,0%,87%,0.15) 5px, hsla(171,0%,87%,0.15) 8px),linear-gradient(90deg, rgb(251,251,251),rgb(251,251,251));`},
                    {name:'تدرج ',value:`background-image: repeating-linear-gradient(135deg, hsla(190,0%,89%,0.15) 0px, hsla(190,0%,89%,0.15) 0px,transparent 0px, transparent 1px,hsla(190,0%,89%,0.15) 1px, hsla(190,0%,89%,0.15) 4px,transparent 4px, transparent 5px,hsla(190,0%,89%,0.15) 5px, hsla(190,0%,89%,0.15) 10px),repeating-linear-gradient(45deg, hsla(190,0%,89%,0.15) 0px, hsla(190,0%,89%,0.15) 0px,transparent 0px, transparent 1px,hsla(190,0%,89%,0.15) 1px, hsla(190,0%,89%,0.15) 4px,transparent 4px, transparent 5px,hsla(190,0%,89%,0.15) 5px, hsla(190,0%,89%,0.15) 10px),repeating-linear-gradient(0deg, hsla(190,0%,89%,0.15) 0px, hsla(190,0%,89%,0.15) 0px,transparent 0px, transparent 1px,hsla(190,0%,89%,0.15) 1px, hsla(190,0%,89%,0.15) 4px,transparent 4px, transparent 5px,hsla(190,0%,89%,0.15) 5px, hsla(190,0%,89%,0.15) 10px),repeating-linear-gradient(90deg, hsla(190,0%,89%,0.15) 0px, hsla(190,0%,89%,0.15) 0px,transparent 0px, transparent 1px,hsla(190,0%,89%,0.15) 1px, hsla(190,0%,89%,0.15) 4px,transparent 4px, transparent 5px,hsla(190,0%,89%,0.15) 5px, hsla(190,0%,89%,0.15) 10px),linear-gradient(90deg, rgb(251,251,251),rgb(251,251,251));`},
                    {name:'تدرج ',value:`background-image: linear-gradient(0deg, rgb(249, 66, 6),rgb(250, 134, 22),rgb(251, 202, 37));`},
                    {name:'تدرج ',value:`background-image: linear-gradient(135deg, rgba(238, 238, 238, 0.1),rgba(16, 16, 16, 0.1)),linear-gradient(183deg, rgb(202, 255, 50),rgb(223, 14, 20));`},
                    {name:'تدرج ',value:`background-image: linear-gradient(37deg, rgb(32, 218, 233),rgb(40, 21, 236));`},
                    {name:'تدرج ',value:`background-image: linear-gradient(3deg, rgb(249, 144, 110),rgb(225, 14, 225));`},
                    {name:'تدرج ',value:`background-image: linear-gradient(90deg, rgb(62, 25, 113),rgb(72, 105, 206));`},
                    {name:'تدرج ',value:`background-image: linear-gradient(145deg, rgba(232, 87, 237, 0.15) 0%,rgba(109, 137, 69, 0.15) 100%),linear-gradient(75deg, rgb(33, 138, 184),rgb(0, 241, 181));`},
                    {name:'تدرج ',value:`background-image: linear-gradient(0deg, rgba(26, 228, 244, 0.15) 0%,rgba(50, 206, 35, 0.15) 100%),linear-gradient(90deg, rgb(44, 56, 250),rgb(88, 219, 228));`},
                    {name:'تدرج ',value:`background-image: linear-gradient(0deg, rgba(99, 109, 81, 0.3) 0%,rgba(198, 203, 94, 0.3) 100%),linear-gradient(90deg, rgb(18, 116, 125),rgb(20, 216, 80));`},
                    {name:'تدرج ',value:`background-image: linear-gradient(90deg, rgb(119, 14, 191),rgb(238, 141, 125));`},
                ],

                group1_bg: 'color',
                group2_bg: 'color',
                group3_bg: 'color',
                group4_bg: 'color',
                group5_bg: 'color',
                group6_bg: 'color',
                group7_bg: 'color',

                url,
                form: new Form({
                    name: '',
                    logo: '',
                    group1: {active:true,title: "", body: "", bg:"",css:"", size: "cover"},
                    group2: {active:true, body: "", bg:"",css:"", size: "cover"},
                    group3:{active:true,title:"",services:[],bg:"",css:"",size:"cover"},
                    group4:{active:true,gallery:[],bg:"",css:"",size:"cover"},
                    group5:{active:true,bg:"",css:"",size:"cover"},
                    group6:{active:true,face:"",twitter:"",inestagram:"",bg:"",css:"",size:""},
                    group7:{active:true,policy:"",terms:"",email:'',name:'',company:''},

                }),
            }
        },
        methods: {
            changeGallery(ev,index){
                this.form.group4.gallery[index].name=ev.name;
                this.form.group4.gallery[index].img=ev.img;
                this.form.group4.gallery[index].description=ev.description;
            },
            changeService(ev,index){
                console.log(ev)
                this.form.group3.services[index].name=ev.name;
                this.form.group3.services[index].img=ev.img;
                this.form.group3.services[index].description=ev.description;
            },
            save() {
                let terms=`<h5>شروط الاسخدام لأي زائر يدخل هذا الموقع :</h5>
<p>
إن ${this.form.group7.name} هو صاحب هذا الموقع وهو من يديره، و بالتالي فان استخدامك له يعني موافقتك بشكل كامل على الشروط الأحكام التالية الخاصة به ، لهذا فإننا نحب دائماً ان تقرأ هذه الصفحه لتعرف الشروط التي يجب أن تتقيدها لتتعامل مع هذا الموقع بشكل لا يخالف أي من سياساته .

</p>
<h5>سياسة الخصوصية :</h5>
<p>
موقع ${this.form.group7.company} يحترم سياسة الخصوصية لديك ، و لك كامل التحكم بمعلوماتك و لن يتم تجميعها الا بإذنك و برغبتك أنت طبعاً ، و قد قمنا بعمل صفحة كاملة تعرف فيها سياسة الخصوصية الخاصة بهذا الموقع.
</p>
<h5>
الملكية الفكرية :
</h5>
<p>
${this.form.group7.name} هو وحده من يملك محتوى هذا الموقع بالكامل
</p>


<h5>العلامات التجارية :</h5>
<p>
مركز ${this.form.group7.company} لا يقبل وجود علامات تجارية هنا على هذا الموقع ، هذا يضر بمصلحة الزائر .. و لا يجوز لك عمل اي عملية تهدف الى تسويق علامة تجارية معينة ، الا طبعا اذا استأذنت من صاحب الموقع و وافق هو على ذلك.

</p>


<p>لأي استفسار حول هذه الشروط ، يرجى ارسال ايميل الى <a href="mailto:${this.form.group7.email}">${this.form.group7.email}</a></p>



                `;
                let policy=`<h3>هدف الخصوصية :</h3>
<p>موقع ${this.form.group7.company} يتعهد باحترام خصوصية الزوار بشكل كامل, قمنا بعمل هذه الخصوصيه حتى تكون على ثقة كاملة بأننا سنحمي كل ما يتعلق بك و بخصوصيتك, وثيقة سياسة الخصوصية هذه تحدد الخطوط العريضة لأنواع المعلومات الشخصية التي سنهتم بها و نجمعها هنا في موقع ${this.form.group7.company}.
اذا كان لديك اي استفسار بخصوص هذه السياسة
نتمنى ان تراسلنا عبر هذا الايميل : ${this.form.group7.email}</p>
<h5>ما هي المعلومات التي يمكن ان نأخذها منك ؟؟</h5>
<p>
في هذا الموقع , تأكد اننا لا نأخذ اي معلومة شخصية منك دون علمك، وأي بيانات نحصل عليها تكون فقط بسبب أنك انت من قام بتسجيلها بناء على رغبته , للحصول على تقرير أو معلومات تهمك عبر الموقع .. و هذه البيانات تتضمن :
بريدك الإلكتروني
اسمك الأول
رقم الهاتف
اذا اردت تعديل اي معلومات قمت سابقا باعطائها لنا , فقط راسلنا عبر الايميل و سنعدلها لك متى ما شئت .
</p>
<h5>تعديل هذه السياسة كل فترة :</h5>
<p>نعم , من الممكن ان نقوم بتعديل هذه السياسة بين الفترة و الاخرى , و هذا طبعا لمصلحتك اولاً و لتعرف كيف نحترم خصوصيتك بالشكل الصحيح , و عند قيامنا بذلك , نضع ملاحظة في الموقع بالتغيير لتدخل و تقرأ و تعرف حقوقك معنا .
</p>
<h5>إشـــارات عدم التتبع :</h5>
<p>
حالياً لا نضع اشارات لعدم التتبع في موقع ${this.form.group7.company} , و هي التي تأتي مع المتصفح , حيث انك لو اردت ان لا يعرف المتصفح اين تذهب و كيف تتصفح … قم بالغائها من هناك .
</p>
<h5>الكوكيز و إعدادات الانترنت :</h5>
<p>
موقع ${this.form.group7.company} يستخدم الكوكيز لحفظ المعلومات عن الإعدادات الخاصة بالزوار ، حيث تسجل هذه المعلومات عند دخول أي صفحة من صفحات موقع ${this.form.group7.company} , و هذا لا يؤثر على اداءك او تصفحك ابدا , بل انه مفيد جدا في بعض الاحيان التي تتطلب دخول مستمر لحساباتك عبر الانترنت .
</p>
<h5>قبول شروط الاستخدام :</h5>
<p>
باستخدام هذا الموقع فإنك تقر أنك قرأت وفهمت، وقبلت، ومن ثم وافقت على الالتزام بهذه الشروط.
</p>`;
                this.form.group7.policy=policy;
                this.form.group7.terms=terms;
                this.form.post(`${url}/student/pages/homePage/${this.page.id}/update`).then(() => {
                    Toast.fire({icon:'success', title:'Done'});
                     setTimeout(()=>{
                          window.location.assign(`${url}/student/pages/homePage`);
                      },2000);
                })
            },
            changeImg(el, name) {
                let file = el.target.files[0];
                let reader = new FileReader();
                switch (name) {
                    case 'logo':
                        reader.onloadend = () => {
                            this.form.logo = reader.result

                        }
                        break;

                    case 'group1_img':
                        reader.onloadend = () => {
                            this.form.group1.video = reader.result

                        }
                        break;
                    case 'group1_bg':
                        reader.onloadend = () => {
                            this.form.group1.bg = reader.result

                        }
                        break;

                    case 'group2_img':
                        reader.onloadend = () => {
                            this.form.group2.img = reader.result

                        }
                        break;
                    case 'group2_bg':
                        reader.onloadend = () => {
                            this.form.group2.bg = reader.result

                        }
                        break;

                    case 'group3_img':
                        reader.onloadend = () => {
                            this.form.group3.img = reader.result

                        }
                        break;
                    case 'group3_bg':
                        reader.onloadend = () => {
                            this.form.group3.bg = reader.result

                        }
                        break;
                    case 'bg_story':
                        reader.onloadend = () => {
                            this.form.group3.bg_story = reader.result

                        }
                        break;
                    case 'group4_img':
                        reader.onloadend = () => {
                            this.form.group4.img = reader.result

                        }
                        break;
                    case 'group4_bg':
                        reader.onloadend = () => {
                            this.form.group4.bg = reader.result

                        }
                        break;
                    case 'group5_img':
                        reader.onloadend = () => {
                            this.form.group5.img = reader.result

                        }
                        break;
                    case 'group5_bg':
                        reader.onloadend = () => {
                            this.form.group4.bg = reader.result

                        }
                        break;
                    case 'group6_bg':
                        reader.onloadend = () => {
                            this.form.group6.bg = reader.result

                        }
                        break;

                    case 'group6_img':
                        reader.onloadend = () => {
                            this.form.group6.img = reader.result

                        }
                        break;
                    case 'group7_bg':
                        reader.onloadend = () => {
                            this.form.group7.bg = reader.result

                        }
                        break;
                    case 'group8_img':
                        reader.onloadend = () => {
                            this.form.group8.img = reader.result

                        }
                        break;
                    case 'group8_bg':
                        reader.onloadend = () => {
                            this.form.group8.bg = reader.result

                        }
                        break;
                    case 'group9_bg':
                        reader.onloadend = () => {
                            this.form.group9.bg = reader.result

                        }
                        break;
                    case 'group10_bg':
                        reader.onloadend = () => {
                            this.form.group10.bg = reader.result

                        }
                        break;
                }
                reader.readAsDataURL(file);
            },

        },

        created(){
            this.form.fill(this.page);
            if(this.form.group1.bg.includes('images')){
                this.group1_bg='img';

            }else if(this.form.group1.bg.length<9){
                this.group1_bg='color';
            }else{
                this.group1_bg='css';
            }

            if(this.form.group2.bg.includes('images')){
                this.group2_bg='img';

            }else if(this.form.group2.bg.length<9){
                this.group2_bg='color';
            }else{
                this.group2_bg='css';
            }

            if(this.form.group3.bg.includes('images')){
                this.group3_bg='img';

            }else if(this.form.group3.bg.length<9){
                this.group3_bg='color';
            }else{
                this.group3_bg='css';
            }

            if(this.form.group4.bg.includes('images')){
                this.group4_bg='img';

            }else if(this.form.group4.bg.length<9){
                this.group4_bg='color';
            }else{
                this.group4_bg='css';
            }

            if(this.form.group5.bg.includes('images')){
                this.group5_bg='img';

            }else if(this.form.group5.bg.length<9){
                this.group5_bg='color';
            }else{
                this.group5_bg='css';
            }

            if(this.form.group6.bg.includes('images')){
                this.group6_bg='img';

            }else if(this.form.group6.bg.length<9){
                this.group6_bg='color';
            }else{
                this.group6_bg='css';
            }

            if(this.form.group7.bg.includes('images')){
                this.group7_bg='img';

            }else if(this.form.group7.bg.length<9){
                this.group7_bg='color';
            }else{
                this.group7_bg='css';
            }


        },

    }
</script>

<style scoped>

</style>