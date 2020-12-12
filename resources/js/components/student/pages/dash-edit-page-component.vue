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
                    </div>
                </div>
                <div class="card group1">
                    <div class="card-header">

                        <div class="d-flex justify-content-start">
                            <div class="form-check-inline mx-2">
                                <input class="form-check-input" type="checkbox" v-model="form.group1.active"
                                       :value="true">
                            </div>
                            <span>المجموعة الأولى</span>
                            <!-- <a :href="`${url}/student/pages`"><i class="fa fa-backward"></i></a>-->
                        </div>
                    </div>
                    <div class="card-body">
                        <!--<div class="form-group">
                            <label>لوغو</label>
                            <input @change="changeImg($event,'logo')" type="file"
                                   class="form-control" :class="{ 'is-invalid': form.errors.has('img_video') }">
                            <span class="text-danger small" v-if="form.errors.has('img_video')">{{form.errors.get('img_video')}}</span>
                        </div>-->

                        <div class="form-group">
                            <label>هيد لاين</label>
                            <input type="text" v-model="form.group1.title" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>صب هيد لاين</label>
                            <input type="text" v-model="form.group1.sub_title" class="form-control">
                        </div>
                        <div class="form-group">
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" v-model="img_video_type"
                                       id="exampleRadios1" value="video" checked>
                                <label class="form-check-label" for="exampleRadios1">
                                    فيديو
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" v-model="img_video_type"
                                       id="exampleRadios2" value="img">
                                <label class="form-check-label" for="exampleRadios2">
                                    صورة
                                </label>
                            </div>
                        </div>
                        <div class="form-group" v-if="img_video_type=='video'">
                            <label>تضمين فيديو</label>
                            <textarea v-model="form.group1.video" class="form-control"></textarea>
                        </div>
                        <div class="form-group" v-else>
                            <label>رفع صورة</label>
                            <input @change="changeImg($event,'group1_img')" type="file"
                                   class="form-control" :class="{ 'is-invalid': form.errors.has('img_video') }">
                        </div>
                        <div class="form-group">
                            <label>عنوان CTA</label>
                            <input type="text" v-model="form.group1.cta" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>زر CTA</label>
                            <input type="text" v-model="form.group1.btn" class="form-control">
                        </div>

                        <!--Background-->
                        <div class="form-group">
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" v-model="group1_bg"
                                       value="img" checked>
                                <label class="form-check-label" for="exampleRadios1">
                                    صورة
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" v-model="group1_bg"
                                       value="color">
                                <label class="form-check-label" for="exampleRadios2">
                                    لون
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" v-model="group1_bg"
                                       value="css">
                                <label class="form-check-label" for="exampleRadios2">
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
                        <div class="form-group" v-else-if="group1_bg=='img'">
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
                            <input class="form-check-input" type="checkbox" v-model="form.group2.active" :value="true">

                        </div>
                        <span> المجموعة الثانية</span>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label>العنوان</label>
                            <input type="text" v-model="form.group2.title" class="form-control">
                        </div>
                        <!-- <div class="form-group">
                             <label>وصف</label>
                             <input type="text" v-model="form.group2.body" class="form-control">
                         </div>-->

                        <div class="form-group">
                            <label>العدد المتاح</label>
                            <input type="text" v-model="form.group2.qnt" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>تاريخ إنتهاء العرض</label>
                            <input type="date" v-model="form.group2.date" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>رفع صورة</label>
                            <input @change="changeImg($event,'group2_img')" type="file"
                                   class="form-control" :class="{ 'is-invalid': form.errors.has('img_video') }">
                        </div>
                        <!--Background-->
                        <div class="form-group">
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" v-model="group2_bg"
                                       value="img" checked>
                                <label class="form-check-label" for="exampleRadios1">
                                    صورة
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" v-model="group2_bg"
                                       value="color">
                                <label class="form-check-label" for="exampleRadios2">
                                    لون
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" v-model="group2_bg"
                                       value="css">
                                <label class="form-check-label" for="exampleRadios2">
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
                        <div class="form-group" v-else-if="group2_bg=='img'">
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
                                <select v-model="form.group2.bg" name="" class="form-control">
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
                            <input class="form-check-input" type="checkbox" v-model="form.group3.active" :value="true">
                        </div>
                        <span> المجموعة الثالثة</span>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label>المشاكل</label>
                            <input type="text" class="form-control my-1"
                                   v-for="(item,index) in form.group3.problems.length"
                                   v-model="form.group3.problems[index]">
                            <button type="button" @click="form.group3.problems.push('')" class="btn btn-sm"><i
                                    class="fa fa-plus"></i></button>
                        </div>

                        <div class="form-group">
                            <label>رفع صورة</label>
                            <input @change="changeImg($event,'group3_img')" type="file"
                                   class="form-control" :class="{ 'is-invalid': form.errors.has('img_video') }">
                        </div>
                        <div class="form-group">
                            <label>القصة</label>
                            <textarea v-model="form.group3.story" class="form-control"></textarea>
                        </div>
                        <!--<div class="form-group">
                            <label> صورة القصة</label>
                            <input @change="changeImg($event,'img_story')" type="file"
                                   class="form-control" :class="{ 'is-invalid': form.errors.has('img_video') }">
                        </div>-->
                        <!--Background-->
                        <div class="form-group">
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" v-model="group3_bg"
                                       value="img" checked>
                                <label class="form-check-label" for="exampleRadios1">
                                    صورة
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" v-model="group3_bg"
                                       value="color">
                                <label class="form-check-label" for="exampleRadios2">
                                    لون
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" v-model="group3_bg"
                                       value="css">
                                <label class="form-check-label" for="exampleRadios2">
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
                        <div class="form-group" v-else-if="group3_bg=='img'">
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
                                <select v-model="form.group3.bg" name="" class="form-control">
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
                            <input class="form-check-input" type="checkbox" v-model="form.group4.active" :value="true">

                        </div>
                        <span> المجموعة الرابعة</span>


                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label>الحلول</label>
                            <input type="text" class="form-control my-1"
                                   v-for="(item,index) in form.group4.solutions.length"
                                   v-model="form.group4.solutions[index]">
                            <button type="button" @click="form.group4.solutions.push('')" class="btn btn-sm"><i
                                    class="fa fa-plus"></i></button>
                        </div>
                        <div class="form-group">
                            <label>رفع صورة</label>
                            <input @change="changeImg($event,'group4_img')" type="file"
                                   class="form-control" :class="{ 'is-invalid': form.errors.has('img_video') }">
                        </div>
                        <!-- <div class="form-group">
                             <label>العنوان</label>
                             <input type="text" v-model="form.group4.title" class="form-control">
                         </div>-->
                        <!--<div class="form-group">
                            <label>وصف</label>
                            <input type="text" v-model="form.group4.body" class="form-control">
                        </div>-->
                        <div class="form-group">
                            <label>عنوان CTA</label>
                            <input type="text" v-model="form.group4.cta" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>زر CTA</label>
                            <input type="text" v-model="form.group4.btn" class="form-control">
                        </div>

                        <!--Background-->
                        <div class="form-group">
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" v-model="group4_bg"
                                       value="img" checked>
                                <label class="form-check-label" for="exampleRadios1">
                                    صورة
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" v-model="group4_bg"
                                       value="color">
                                <label class="form-check-label" for="exampleRadios2">
                                    لون
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" v-model="group4_bg"
                                       value="css">
                                <label class="form-check-label" for="exampleRadios2">
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
                        <div class="form-group" v-else-if="group4_bg=='img'">
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
                                <select v-model="form.group4.bg" name="" class="form-control">
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
                            <input class="form-check-input" type="checkbox" v-model="form.group5.active" :value="true">

                        </div>
                        <span>المموعة الخامسة</span>
                    </div>
                    <div class="card-body">

                        <!-- <div class="form-group">
                             <label>العنوان</label>
                             <input type="text" v-model="form.group5.title" class="form-control">
                         </div>-->
                        <div class="form-group">
                            <label>عنوان</label>
                            <input type="text" v-model="form.group5.price" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>رفع صورة</label>
                            <input @change="changeImg($event,'group5_img')" type="file"
                                   class="form-control" :class="{ 'is-invalid': form.errors.has('img_video') }">
                        </div>
                        <div class="form-group">
                            <label>الفوائد</label>
                            <input type="text" class="form-control my-1"
                                   v-for="(item,index) in form.group5.benefists.length"
                                   v-model="form.group5.benefists[index]">
                            <button type="button" @click="form.group5.benefists.push('')" class="btn btn-sm"><i
                                    class="fa fa-plus"></i></button>
                        </div>
                        <!--Background-->
                        <div class="form-group">
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" v-model="group5_bg"
                                       value="img" checked>
                                <label class="form-check-label" for="exampleRadios1">
                                    صورة
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" v-model="group5_bg"
                                       value="color">
                                <label class="form-check-label" for="exampleRadios2">
                                    لون
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" v-model="group5_bg"
                                       value="css">
                                <label class="form-check-label" for="exampleRadios2">
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
                        <div class="form-group" v-else-if="group5_bg=='img'">
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
                                <select v-model="form.group5.bg" name="" class="form-control">
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
                            <input class="form-check-input" type="checkbox" v-model="form.group6.active" :value="true">

                        </div>
                        <span>المجموعة السادسة</span>
                    </div>
                    <div class="card-body">

                        <!--<div class="form-group">
                            <label>العنوان</label>
                            <input type="text" v-model="form.group6.title" class="form-control">
                        </div>-->
                        <!--<div class="form-group">
                            <label>السعر مع القيمة المضافة</label>
                            <input type="text" v-model="form.group6.price" class="form-control">
                        </div>-->
                        <div class="form-group">
                            <label>المخاطر</label>
                            <input type="text" class="form-control my-1"
                                   v-for="(item,index) in form.group6.dangers.length"
                                   v-model="form.group6.dangers[index]">
                            <button type="button" @click="form.group6.dangers.push('')" class="btn btn-sm"><i
                                    class="fa fa-plus"></i></button>
                        </div>
                        <div class="form-group">
                            <label>رفع صورة</label>
                            <input @change="changeImg($event,'group6_img')" type="file"
                                   class="form-control" :class="{ 'is-invalid': form.errors.has('img_video') }">
                        </div>
                        <div class="form-group">
                            <label>فوتر</label>
                            <input type="text" v-model="form.group6.footer" class="form-control">
                        </div>
                        <!--Background-->
                        <div class="form-group">
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" v-model="group6_bg"
                                       value="img" checked>
                                <label class="form-check-label" for="exampleRadios1">
                                    صورة
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" v-model="group6_bg"
                                       value="color">
                                <label class="form-check-label" for="exampleRadios2">
                                    لون
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" v-model="group6_bg"
                                       value="css">
                                <label class="form-check-label" for="exampleRadios2">
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
                        <div class="form-group" v-else-if="group6_bg=='img'">
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
                                <select v-model="form.group6.bg" name="" class="form-control">
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
                            <input class="form-check-input" type="checkbox" v-model="form.group7.active" :value="true">
                        </div>
                        <span> المجموعة السابعة</span>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label>العنوان</label>
                            <input type="text" v-model="form.group7.title" class="form-control">
                        </div>
                        <!-- <div class="form-group">
                             <label>العنوان الفرعي</label>
                             <input type="text" v-model="form.group7.sub_title" class="form-control">
                         </div>-->
                        <div class="form-group">
                            <label>نص الحسم</label>
                            <input type="text" v-model="form.group7.price" class="form-control">
                        </div>
                        <!--Background-->
                        <div class="form-group">
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" v-model="group7_bg"
                                       value="img" checked>
                                <label class="form-check-label" for="exampleRadios1">
                                    صورة
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" v-model="group7_bg"
                                       value="color">
                                <label class="form-check-label" for="exampleRadios2">
                                    لون
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" v-model="group7_bg"
                                       value="css">
                                <label class="form-check-label" for="exampleRadios2">
                                    تدرج لوني
                                </label>
                            </div>
                        </div>
                        <div class="form-group" v-if="group7_bg=='color'">
                            <label>الخلفية / لون</label>
                            <input type="color" v-model="form.group7.bg" class="form-control">
                        </div>
                        <div class="form-group" v-else-if="group7_bg=='img'">
                            <label>الخلفية/صورة</label>
                            <input @change="changeImg($event,'group7_bg')" type="file"
                                   class="form-control" :class="{ 'is-invalid': form.errors.has('img_video') }">
                            <!--<button type="button" @click="form.group1.bg='#000'" class="btn btn-sm"><i class="fa fa-plus"></i></button>-->
                        </div>
                        <div class="form-group" v-else-if="group7_bg=='img'">
                            <label>نوع الخلفية</label>
                            <select v-model="form.group7.size" class="form-control">
                                <option value="cover">غلاف</option>
                                <option value="contain">إحتواء</option>
                                <option value="repeat">تكرار</option>
                            </select>
                        </div>
                        <div class="form-row" v-else-if="group7_bg=='css'">
                            <div class="col-6">
                                <label>الخلفية/تدرج لوني</label>
                                <select v-model="form.group7.bg" name="" class="form-control">
                                    <option v-for="(bg,i) in bg_css" :value="bg.value">{{bg.name}} {{i}}</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <div style="min-height: 150px" class="w-100" :style="form.group7.bg"></div>
                            </div>

                            <!--<button type="button" @click="form.group1.bg='#000'" class="btn btn-sm"><i class="fa fa-plus"></i></button>-->
                        </div>
                        <!--End BackGround-->
                    </div>
                </div>


                <div class="card group8">
                    <div class="card-header">
                        <div class="form-check-inline">
                            <input class="form-check-input" type="checkbox" v-model="form.group8.active" :value="true">

                        </div>
                        <span>المجموعة الثامنة</span>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label>العنوان</label>
                            <input type="text" v-model="form.group8.title" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>رفع صورة</label>
                            <input @change="changeImg($event,'group8_img')" type="file"
                                   class="form-control" :class="{ 'is-invalid': form.errors.has('img_video') }">
                        </div>

                        <div class="form-group">
                            <label>المميزات</label>
                            <input type="text" class="form-control my-1"
                                   v-for="(item,index) in form.group8.benefists.length"
                                   v-model="form.group8.benefists[index]">
                            <button type="button" @click="form.group8.benefists.push('')" class="btn btn-sm"><i
                                    class="fa fa-plus"></i></button>
                        </div>
                        <div class="form-group">
                            <label>فوتر</label>
                            <input type="text" v-model="form.group8.footer" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>عنوان CTA</label>
                            <input type="text" v-model="form.group8.cta" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>زر CTA</label>
                            <input type="text" v-model="form.group8.btn" class="form-control">
                        </div>

                        <!--Background-->
                        <div class="form-group">
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" v-model="group8_bg"
                                       value="img" checked>
                                <label class="form-check-label" for="exampleRadios1">
                                    صورة
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" v-model="group8_bg"
                                       value="color">
                                <label class="form-check-label" for="exampleRadios2">
                                    لون
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" v-model="group8_bg"
                                       value="css">
                                <label class="form-check-label" for="exampleRadios2">
                                    تدرج لوني
                                </label>
                            </div>
                        </div>
                        <div class="form-group" v-if="group8_bg=='color'">
                            <label>الخلفية / لون</label>
                            <input type="color" v-model="form.group8.bg" class="form-control">
                        </div>
                        <div class="form-group" v-else-if="group8_bg=='img'">
                            <label>الخلفية/صورة</label>
                            <input @change="changeImg($event,'group8_bg')" type="file"
                                   class="form-control" :class="{ 'is-invalid': form.errors.has('img_video') }">
                            <!--<button type="button" @click="form.group1.bg='#000'" class="btn btn-sm"><i class="fa fa-plus"></i></button>-->
                        </div>
                        <div class="form-group" v-else-if="group8_bg=='img'">
                            <label>نوع الخلفية</label>
                            <select v-model="form.group8.size" class="form-control">
                                <option value="cover">غلاف</option>
                                <option value="contain">إحتواء</option>
                                <option value="repeat">تكرار</option>
                            </select>
                        </div>
                        <div class="form-row" v-else-if="group8_bg=='css'">
                            <div class="col-6">
                                <label>الخلفية/تدرج لوني</label>
                                <select v-model="form.group8.bg" name="" class="form-control">
                                    <option v-for="(bg,i) in bg_css" :value="bg.value">{{bg.name}} {{i}}</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <div style="min-height: 150px" class="w-100" :style="form.group8.bg"></div>
                            </div>

                            <!--<button type="button" @click="form.group1.bg='#000'" class="btn btn-sm"><i class="fa fa-plus"></i></button>-->
                        </div>
                        <!--End BackGround-->
                    </div>
                </div>


                <div class="card group9">
                    <div class="card-header">
                        <div class="form-check-inline">
                            <input class="form-check-input" type="checkbox" v-model="form.group9.active" :value="true">

                        </div>
                        <span>المجموعة التاسعة</span>
                    </div>
                    <div class="card-body">

                        <!-- <div class="form-group">
                             <label>العنوان</label>
                             <input type="text" v-model="form.group9.title" class="form-control">
                         </div>-->
                        <!-- <div class="form-group">
                             <label>العنوان الفرعي</label>
                             <input type="text" v-model="form.group9.sub_title" class="form-control">
                         </div>-->
                        <div class="form-group">
                            <label>المميزات</label>
                            <input type="text" class="form-control my-1"
                                   v-for="(item,index) in form.group9.benefists.length"
                                   v-model="form.group9.benefists[index]">
                            <button type="button" @click="form.group9.benefists.push('')" class="btn btn-sm"><i
                                    class="fa fa-plus"></i></button>
                        </div>
                        <div class="form-group">
                            <label>عنوان CTA</label>
                            <input type="text" v-model="form.group9.cta" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>زر CTA</label>
                            <input type="text" v-model="form.group9.btn" class="form-control">
                        </div>
                        <!--Background-->
                        <div class="form-group">
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" v-model="group9_bg"
                                       value="img" checked>
                                <label class="form-check-label" for="exampleRadios1">
                                    صورة
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" v-model="group9_bg"
                                       value="color">
                                <label class="form-check-label" for="exampleRadios2">
                                    لون
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" v-model="group9_bg"
                                       value="css">
                                <label class="form-check-label" for="exampleRadios2">
                                    تدرج لوني
                                </label>
                            </div>
                        </div>
                        <div class="form-group" v-if="group9_bg=='color'">
                            <label>الخلفية / لون</label>
                            <input type="color" v-model="form.group9.bg" class="form-control">
                        </div>
                        <div class="form-group" v-else-if="group9_bg=='img'">
                            <label>الخلفية/صورة</label>
                            <input @change="changeImg($event,'group9_bg')" type="file"
                                   class="form-control" :class="{ 'is-invalid': form.errors.has('img_video') }">
                            <!--<button type="button" @click="form.group1.bg='#000'" class="btn btn-sm"><i class="fa fa-plus"></i></button>-->
                        </div>
                        <div class="form-group" v-else-if="group9_bg=='img'">
                            <label>نوع الخلفية</label>
                            <select v-model="form.group9.size" class="form-control">
                                <option value="cover">غلاف</option>
                                <option value="contain">إحتواء</option>
                                <option value="repeat">تكرار</option>
                            </select>
                        </div>
                        <div class="form-row" v-else-if="group9_bg=='css'">
                            <div class="col-6">
                                <label>الخلفية/تدرج لوني</label>
                                <select v-model="form.group9.bg" name="" class="form-control">
                                    <option v-for="(bg,i) in bg_css" :value="bg.value">{{bg.name}} {{i}}</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <div style="min-height: 150px" class="w-100" :style="form.group9.bg"></div>
                            </div>

                            <!--<button type="button" @click="form.group1.bg='#000'" class="btn btn-sm"><i class="fa fa-plus"></i></button>-->
                        </div>
                        <!--End BackGround-->
                    </div>
                </div>
                <!--   <div class="card group10">
                       <div class="card-header">المجموعة العاشرة</div>
                       <div class="card-body">
                           <div class="form-group">
                               <label >سؤال / جواب</label>
                              <div class="form-row" v-for="(item,index) in form.group10.questions.length">
                                  <div class="col-md-6"><input type="text" class="form-control " placeholder="سؤال"  v-model="form.group10.questions[index].ask"></div>
                                  <div class="col-md-6"> <input type="text" class="form-control"  placeholder="جواب" v-model="form.group10.questions[index].answer"></div>
                              </div>
                               <button type="button" @click="form.group10.questions.push({ask:'',answer:''})" class="btn btn-sm"><i class="fa fa-plus"></i></button>
                           </div>

                           <div class="form-group">
                               <label>عنوان CTA</label>
                               <input type="text" v-model="form.group10.cta" class="form-control">
                           </div>
                           <div class="form-group">
                               <label>زر CTA</label>
                               <input type="text" v-model="form.group10.btn" class="form-control">
                           </div>
                           &lt;!&ndash;Background&ndash;&gt;
                           <div class="form-group">
                               <div class="form-check-inline">
                                   <input class="form-check-input" type="radio" v-model="group10_bg"
                                          value="img" checked>
                                   <label class="form-check-label" for="exampleRadios1">
                                       صورة
                                   </label>
                               </div>
                               <div class="form-check-inline">
                                   <input class="form-check-input" type="radio" v-model="group10_bg"
                                          value="color">
                                   <label class="form-check-label" for="exampleRadios2">
                                       لون
                                   </label>
                               </div>
                           </div>
                           <div class="form-group" v-if="group10_bg=='color'">
                               <label>الخلفية / لون</label>
                               <input type="color" v-model="form.group10.bg" class="form-control">
                           </div>
                           <div class="form-group" v-else>
                               <label>الخلفية/صورة</label>
                               <input @change="changeImg($event,'group10_bg')" type="file"
                                      class="form-control" :class="{ 'is-invalid': form.errors.has('img_video') }">
                               &lt;!&ndash;<button type="button" @click="form.group1.bg='#000'" class="btn btn-sm"><i class="fa fa-plus"></i></button>&ndash;&gt;
                           </div>
                           <div class="form-group"  v-if="group10_bg!='color'">
                               <label>نوع الخلفية</label>
                               <select v-model="form.group10.size" class="form-control">
                                   <option value="cover">غلاف</option>
                                   <option value="contain">إحتواء</option>
                                   <option value="repeat">تكرار</option>
                               </select>
                           </div>
                           &lt;!&ndash;End BackGround&ndash;&gt;
                       </div>
                   </div>-->
                <button :disabled="form.busy" type="submit" class="btn btn-primary">حفظ</button>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        name: "dash-edit-page-component",
        props: {
            users: Array,
            page: Object,
        },
        data() {
            return {
                bg_css: [
                    {
                        name: 'تدرج ',
                        value: `background-image: radial-gradient(circle at center center, rgba(33,33,33,0),rgb(33,33,33)),repeating-linear-gradient(135deg, rgb(33,33,33) 0px, rgb(33,33,33) 1px,transparent 1px, transparent 4px),repeating-linear-gradient(45deg, rgb(56,56,56) 0px, rgb(56,56,56) 5px,transparent 5px, transparent 6px),linear-gradient(90deg, rgb(33,33,33),rgb(33,33,33));`,
                    },
                    {
                        name: 'تدرج ',
                        value: `background-image: repeating-linear-gradient(45deg, rgba(97,97,97,0.1) 0px, rgba(97,97,97,0.1) 2px,transparent 2px, transparent 4px),linear-gradient(90deg, rgb(43,43,43),rgb(43,43,43)`
                    },
                    {
                        name: 'تدرج ',
                        value: `background-image: repeating-linear-gradient(67.5deg, hsla(145,0%,97%,0.2) 0px, hsla(145,0%,97%,0.2) 0px,transparent 0px, transparent 1px,hsla(145,0%,97%,0.2) 1px, hsla(145,0%,97%,0.2) 4px,transparent 4px, transparent 5px,hsla(145,0%,97%,0.2) 5px, hsla(145,0%,97%,0.2) 8px),repeating-linear-gradient(0deg, hsla(145,0%,97%,0.2) 0px, hsla(145,0%,97%,0.2) 0px,transparent 0px, transparent 1px,hsla(145,0%,97%,0.2) 1px, hsla(145,0%,97%,0.2) 4px,transparent 4px, transparent 5px,hsla(145,0%,97%,0.2) 5px, hsla(145,0%,97%,0.2) 8px),linear-gradient(135deg, rgb(237, 237, 237),rgb(199, 199, 199));`
                    },
                    {
                        name: 'تدرج ',
                        value: `background-image: repeating-linear-gradient(22.5deg, hsla(337,0%,64%,0.2) 0px, hsla(337,0%,64%,0.2) 0px,transparent 0px, transparent 1px,hsla(337,0%,64%,0.2) 1px, hsla(337,0%,64%,0.2) 4px,transparent 4px, transparent 5px,hsla(337,0%,64%,0.2) 5px, hsla(337,0%,64%,0.2) 8px),repeating-linear-gradient(157.5deg, hsla(337,0%,64%,0.2) 0px, hsla(337,0%,64%,0.2) 0px,transparent 0px, transparent 1px,hsla(337,0%,64%,0.2) 1px, hsla(337,0%,64%,0.2) 4px,transparent 4px, transparent 5px,hsla(337,0%,64%,0.2) 5px, hsla(337,0%,64%,0.2) 8px),linear-gradient(135deg, rgb(168, 168, 168),rgb(60, 60, 60));`
                    },
                    {
                        name: 'تدرج ',
                        value: `background-image: repeating-linear-gradient(297deg, hsla(359,0%,70%,0.12) 0px,transparent 2px,hsla(359,0%,70%,0.12) 7px,transparent 9px,hsla(359,0%,70%,0.12) 14px,transparent 16px,hsla(359,0%,70%,0.12) 21px),repeating-linear-gradient(59deg, hsla(359,0%,70%,0.12) 0px,transparent 2px,hsla(359,0%,70%,0.12) 7px,transparent 9px,hsla(359,0%,70%,0.12) 14px,transparent 16px,hsla(359,0%,70%,0.12) 21px),repeating-linear-gradient(0deg, hsla(359,0%,70%,0.12) 0px,transparent 2px,hsla(359,0%,70%,0.12) 7px,transparent 9px,hsla(359,0%,70%,0.12) 14px,transparent 16px,hsla(359,0%,70%,0.12) 21px),linear-gradient(90deg, rgb(253,253,253),rgb(253,253,253));`
                    },
                    {
                        name: 'تدرج ',
                        value: `background-image: repeating-linear-gradient(140deg, hsla(295,0%,82%,0.12) 0px,transparent 2px,hsla(295,0%,82%,0.12) 7px,transparent 9px,hsla(295,0%,82%,0.12) 14px),repeating-linear-gradient(38deg, hsla(295,0%,82%,0.12) 0px,transparent 2px,hsla(295,0%,82%,0.12) 7px,transparent 9px,hsla(295,0%,82%,0.12) 14px),repeating-linear-gradient(0deg, hsla(295,0%,82%,0.15) 0px, hsla(295,0%,82%,0.15) 0px,transparent 0px, transparent 1px,hsla(295,0%,82%,0.15) 1px, hsla(295,0%,82%,0.15) 4px,transparent 4px, transparent 5px,hsla(295,0%,82%,0.15) 5px, hsla(295,0%,82%,0.15) 8px),repeating-linear-gradient(90deg, hsla(295,0%,82%,0.15) 0px, hsla(295,0%,82%,0.15) 0px,transparent 0px, transparent 1px,hsla(295,0%,82%,0.15) 1px, hsla(295,0%,82%,0.15) 4px,transparent 4px, transparent 5px,hsla(295,0%,82%,0.15) 5px, hsla(295,0%,82%,0.15) 8px),linear-gradient(90deg, rgb(58,58,58),rgb(58,58,58));`
                    },
                    {
                        name: 'تدرج ',
                        value: `background-image: repeating-linear-gradient(148deg, hsla(54,0%,87%,0.12) 0px, hsla(54,0%,87%,0.12) 1px,transparent 1px, transparent 4px,hsla(54,0%,87%,0.12) 4px, hsla(54,0%,87%,0.12) 5px,transparent 5px, transparent 7px,hsla(54,0%,87%,0.12) 7px, hsla(54,0%,87%,0.12) 8px),repeating-linear-gradient(119deg, hsla(54,0%,87%,0.12) 0px, hsla(54,0%,87%,0.12) 1px,transparent 1px, transparent 4px,hsla(54,0%,87%,0.12) 4px, hsla(54,0%,87%,0.12) 5px,transparent 5px, transparent 7px,hsla(54,0%,87%,0.12) 7px, hsla(54,0%,87%,0.12) 8px),repeating-linear-gradient(0deg, hsla(54,0%,87%,0.15) 0px, hsla(54,0%,87%,0.15) 0px,transparent 0px, transparent 1px,hsla(54,0%,87%,0.15) 1px, hsla(54,0%,87%,0.15) 4px,transparent 4px, transparent 5px,hsla(54,0%,87%,0.15) 5px, hsla(54,0%,87%,0.15) 8px),repeating-linear-gradient(90deg, hsla(54,0%,87%,0.15) 0px, hsla(54,0%,87%,0.15) 0px,transparent 0px, transparent 1px,hsla(54,0%,87%,0.15) 1px, hsla(54,0%,87%,0.15) 4px,transparent 4px, transparent 5px,hsla(54,0%,87%,0.15) 5px, hsla(54,0%,87%,0.15) 8px),linear-gradient(90deg, rgb(251,251,251),rgb(251,251,251));`
                    },
                    {
                        name: 'تدرج ',
                        value: `background-image: repeating-linear-gradient(188deg, hsla(171,0%,87%,0.12) 0px, hsla(171,0%,87%,0.12) 2px,transparent 2px, transparent 5px,hsla(171,0%,87%,0.12) 5px, hsla(171,0%,87%,0.12) 7px,transparent 7px, transparent 9px,hsla(171,0%,87%,0.12) 9px, hsla(171,0%,87%,0.12) 11px),repeating-linear-gradient(162deg, hsla(171,0%,87%,0.12) 0px, hsla(171,0%,87%,0.12) 2px,transparent 2px, transparent 5px,hsla(171,0%,87%,0.12) 5px, hsla(171,0%,87%,0.12) 7px,transparent 7px, transparent 14px,hsla(171,0%,87%,0.12) 14px, hsla(171,0%,87%,0.12) 16px),repeating-linear-gradient(0deg, hsla(171,0%,87%,0.15) 0px, hsla(171,0%,87%,0.15) 0px,transparent 0px, transparent 1px,hsla(171,0%,87%,0.15) 1px, hsla(171,0%,87%,0.15) 4px,transparent 4px, transparent 5px,hsla(171,0%,87%,0.15) 5px, hsla(171,0%,87%,0.15) 8px),repeating-linear-gradient(90deg, hsla(171,0%,87%,0.15) 0px, hsla(171,0%,87%,0.15) 0px,transparent 0px, transparent 1px,hsla(171,0%,87%,0.15) 1px, hsla(171,0%,87%,0.15) 4px,transparent 4px, transparent 5px,hsla(171,0%,87%,0.15) 5px, hsla(171,0%,87%,0.15) 8px),linear-gradient(90deg, rgb(251,251,251),rgb(251,251,251));`
                    },
                    {
                        name: 'تدرج ',
                        value: `background-image: repeating-linear-gradient(135deg, hsla(190,0%,89%,0.15) 0px, hsla(190,0%,89%,0.15) 0px,transparent 0px, transparent 1px,hsla(190,0%,89%,0.15) 1px, hsla(190,0%,89%,0.15) 4px,transparent 4px, transparent 5px,hsla(190,0%,89%,0.15) 5px, hsla(190,0%,89%,0.15) 10px),repeating-linear-gradient(45deg, hsla(190,0%,89%,0.15) 0px, hsla(190,0%,89%,0.15) 0px,transparent 0px, transparent 1px,hsla(190,0%,89%,0.15) 1px, hsla(190,0%,89%,0.15) 4px,transparent 4px, transparent 5px,hsla(190,0%,89%,0.15) 5px, hsla(190,0%,89%,0.15) 10px),repeating-linear-gradient(0deg, hsla(190,0%,89%,0.15) 0px, hsla(190,0%,89%,0.15) 0px,transparent 0px, transparent 1px,hsla(190,0%,89%,0.15) 1px, hsla(190,0%,89%,0.15) 4px,transparent 4px, transparent 5px,hsla(190,0%,89%,0.15) 5px, hsla(190,0%,89%,0.15) 10px),repeating-linear-gradient(90deg, hsla(190,0%,89%,0.15) 0px, hsla(190,0%,89%,0.15) 0px,transparent 0px, transparent 1px,hsla(190,0%,89%,0.15) 1px, hsla(190,0%,89%,0.15) 4px,transparent 4px, transparent 5px,hsla(190,0%,89%,0.15) 5px, hsla(190,0%,89%,0.15) 10px),linear-gradient(90deg, rgb(251,251,251),rgb(251,251,251));`
                    },
                    {
                        name: 'تدرج ',
                        value: `background-image: linear-gradient(0deg, rgb(249, 66, 6),rgb(250, 134, 22),rgb(251, 202, 37));`
                    },
                    {
                        name: 'تدرج ',
                        value: `background-image: linear-gradient(135deg, rgba(238, 238, 238, 0.1),rgba(16, 16, 16, 0.1)),linear-gradient(183deg, rgb(202, 255, 50),rgb(223, 14, 20));`
                    },
                    {
                        name: 'تدرج ',
                        value: `background-image: linear-gradient(37deg, rgb(32, 218, 233),rgb(40, 21, 236));`
                    },
                    {
                        name: 'تدرج ',
                        value: `background-image: linear-gradient(3deg, rgb(249, 144, 110),rgb(225, 14, 225));`
                    },
                    {
                        name: 'تدرج ',
                        value: `background-image: linear-gradient(90deg, rgb(62, 25, 113),rgb(72, 105, 206));`
                    },
                    {
                        name: 'تدرج ',
                        value: `background-image: linear-gradient(145deg, rgba(232, 87, 237, 0.15) 0%,rgba(109, 137, 69, 0.15) 100%),linear-gradient(75deg, rgb(33, 138, 184),rgb(0, 241, 181));`
                    },
                    {
                        name: 'تدرج ',
                        value: `background-image: linear-gradient(0deg, rgba(26, 228, 244, 0.15) 0%,rgba(50, 206, 35, 0.15) 100%),linear-gradient(90deg, rgb(44, 56, 250),rgb(88, 219, 228));`
                    },
                    {
                        name: 'تدرج ',
                        value: `background-image: linear-gradient(0deg, rgba(99, 109, 81, 0.3) 0%,rgba(198, 203, 94, 0.3) 100%),linear-gradient(90deg, rgb(18, 116, 125),rgb(20, 216, 80));`
                    },
                    {
                        name: 'تدرج ',
                        value: `background-image: linear-gradient(90deg, rgb(119, 14, 191),rgb(238, 141, 125));`
                    },
                ],
                img_video_type: 'img',
                group1_bg: 'color',
                group2_bg: 'color',
                group3_bg: 'color',
                group4_bg: 'color',
                group5_bg: 'color',
                group6_bg: 'color',
                group7_bg: 'color',
                group8_bg: 'color',
                group9_bg: 'color',
                group10_bg: 'color',
                url,
                form: new Form({
                    name: '',
                    logo: '',
                    group1: {
                        active: false,
                        title: "",
                        video: "",
                        img: "",
                        sub_title: "",
                        cta: "",
                        btn: "",
                        bg: "",
                        css: "",
                        size: "cover"
                    },
                    group2: {
                        active: false,
                        title: "",
                        body: "",
                        qnt: "",
                        date: "",
                        img: "",
                        cta: "",
                        btn: "",
                        bg: "",
                        css: "",
                        size: "cover"
                    },
                    group3: {
                        active: false,
                        problems: [],
                        img: "",
                        story: "",
                        img_story: "",
                        bg_story: "",
                        btn: "",
                        bg: "",
                        css: "",
                        size: "cover"
                    },
                    group4: {
                        active: false,
                        solutions: [],
                        img: "",
                        title: "",
                        body: "",
                        cta: "",
                        btn: "",
                        bg: "",
                        css: "",
                        size: "cover"
                    },
                    group5: {
                        active: false,
                        title: "",
                        price: "",
                        benefists: [],
                        img: "",
                        bg: "",
                        css: "",
                        size: "cover"
                    },
                    group6: {
                        active: false,
                        title: "",
                        price: "",
                        dangers: [],
                        img: "",
                        footer: "",
                        bg: "",
                        css: "",
                        size: ""
                    },
                    group7: {active: false, title: "", sub_title: "", price: "", bg: "", css: "", size: ""},
                    group8: {
                        active: false,
                        title: "",
                        benefists: [],
                        img: "",
                        footer: "",
                        cta: "",
                        btn: "",
                        bg: "",
                        css: "",
                        size: ""
                    },
                    group9: {
                        active: false,
                        title: "",
                        sub_title: "",
                        benefists: [],
                        cta: "",
                        btn: "",
                        bg: "",
                        css: "",
                        size: ""
                    },
                    group10: {
                        active: false,
                        questions: [{ask: "", answer: ""}],
                        cta: "",
                        btn: "",
                        bg: "",
                        css: "",
                        size: ""
                    },
                    group11: {active: false, bg: "", css: "", size: ""},
                }),
            }
        },
        methods: {
            addWindow1() {
                this.window1++;
            },
            minWindow1() {
                this.window1--;
            },
            save() {
                this.form.post(`${url}/student/pages/${this.page.id}/update`).then(() => {
                    Toast.fire({icon: 'success', title: 'Done'});
                    setTimeout(() => {
                        window.location.assign(`${url}/student/pages`);
                    }, 2000);
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

        created() {
            this.form.fill(this.page);
            // console.log(this.form.group1.css.contain('background'));
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

            if(this.form.group8.bg.includes('images')){
                this.group8_bg='img';

            }else if(this.form.group8.bg.length<9){
                this.group8_bg='color';
            }else{
                this.group8_bg='css';
            }

            if(this.form.group9.bg.includes('images')){
                this.group9_bg='img';

            }else if(this.form.group9.bg.length<9){
                this.group9_bg='color';
            }else{
                this.group9_bg='css';
            }

            /* this.group1 = this.form.why_now.group1.why.length;
             this.group2 = this.form.why_now.group2.why.length;
             this.group3 = this.form.why_now.group3.why.length;
             this.group4 = this.form.why_now.group4.why.length;
             this.problem_customer = this.form.problems.length;
             this.solutions_count = this.form.solutions.length;
             this.benefist_count = this.form.benefists.length;
             this.danger_count = this.form.dangers.length;
             this.offers_count = this.form.offers.length;
             this.ask_count = this.form.asks.length;*/
        },


    }
</script>

<style scoped>

</style>