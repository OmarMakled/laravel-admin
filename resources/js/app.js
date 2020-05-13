import Vue from "vue";
import {
    BootstrapVue,
    IconsPlugin
} from 'bootstrap-vue'
import store from "./store";
import api from "./apis";
import i18n from "./locale";
import './validation/index.js';
import {
    ValidationProvider,
    ValidationObserver
} from 'vee-validate';

let files;
files = require.context('./app/', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

files = require.context('./share/', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('ValidationProvider', ValidationProvider);
Vue.component('ValidationObserver', ValidationObserver);
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
api.init()

import actions from './share/actions';

window.App = new Vue({
    store,
    i18n,
    el: '#app',
    methods: {
        ...actions
    }
});
