


window.Vue = require('vue');

window.$=window.jQuery=require('jquery');

import VueCountdown from '@chenfengyuan/vue-countdown';

Vue.component(VueCountdown.name, VueCountdown);

const app = new Vue({
    el: '#app',
});

