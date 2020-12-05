/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import "@fortawesome/fontawesome-free/js/all.min"

import StarRating from 'vue-star-rating'

Vue.component('star-rating',require('vue-star-rating').default);
import Swal from 'sweetalert2';

window.Swal = Swal;
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});

window.Toast = Toast;

window.Fire=new Vue();
/* End Sweet Alert*/

/* Pagination */
Vue.component('pagination', require('laravel-vue-pagination'));
// <pagination :data="laravelData" @pagination-change-page="getResults"></pagination>
/* End Pagination */


import {Form, HasError, AlertError} from 'vform'

Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);

window.Form = Form;

/* End Vue Form*/

import CKEditor from 'ckeditor4-vue';

Vue.use(CKEditor);
/*import { Datetime } from 'vue-datetime'
Vue.use(Datetime)
Vue.component('datetime', Datetime);*/

/*  jQuery */
window.$ = window.jQuery = require('jquery');
/* End jQuery*/
/* Admin3 RTL */
require("admin3-rtl/plugins/bootstrap/js/bootstrap.bundle.min");
require("admin3-rtl/plugins/slimScroll/jquery.slimscroll.min")
require("admin3-rtl/plugins/fastclick/fastclick.min")

require("admin3-rtl/dist/js/adminlte.min")
// require("admin3-rtl/dist/js/demo")
let url = $('meta[name="site_url"]').attr('content');

window.url = url;
/* End Admin3 RTL*/

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('admin-notify-component', require('./components/admin/notify/AdminNotiFyComponent').default);


Vue.component('rate-example-component', require('./components/admin/examples/RateExampleComponent').default);


Vue.component('index-user-component', require('./components/admin/users/IndexUserComponent').default);
Vue.component('edit-user-component', require('./components/admin/users/EditUserComponent').default);
Vue.component('add-user-component', require('./components/admin/users/AddUserComponent').default);

Vue.component('index-section-component', require('./components/admin/sections/IndexSectionComponent').default);
Vue.component('edit-section-component', require('./components/admin/sections/EditSectionComponent').default);
Vue.component('add-section-component', require('./components/admin/sections/AddSectionComponent').default);
Vue.component('show-section-component', require('./components/admin/sections/ShowSectionComponent').default);

Vue.component('index-lesson-component', require('./components/admin/lessons/IndexLessonComponent').default);
Vue.component('edit-lesson-component', require('./components/admin/lessons/EditLessonComponent').default);
Vue.component('add-lesson-component', require('./components/admin/lessons/AddLessonComponent').default);


Vue.component('show-videos-component', require('./components/student/videos/ShowVideosComponent').default);
Vue.component('all-example-component', require('./components/admin/examples/AllExampleComponent').default);
Vue.component('joker-component', require('./components/student/jokers/JokerComponent').default);
Vue.component('resive-session', require('./components/student/session/ResiveSession').default);
Vue.component('resive-session-component', require('./components/admin/sessions/ResiveSessionComponent').default);


Vue.component('student-projects-index-component', require('./components/student/projects/project-index/project-index').default);

Vue.component('student-projects-create-component', require('./components/student/projects/project-create/project-create').default);
Vue.component('student-projects-edit-component', require('./components/student/projects/project-edit/project-edit').default);

Vue.component('dash-all-page-component', require('./components/student/pages/dash-all-pages.vue').default);
// Vue.component('dash-create-page-component', require('./components/admin/pages/dash-create-page-component').default);
Vue.component('dash-edit-page-component', require('./components/student/pages/dash-edit-page-component').default);
Vue.component('add-page-component', require('./components/student/pages/add-page-component').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.filter('getStatus',(v)=>{
    if(v==1){
        return 'مفعل';
    }
    return "مقفل"
})
const app = new Vue({
    el: '#app',
});
