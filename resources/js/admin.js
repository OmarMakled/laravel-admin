import Vue from "vue";
import {
    BootstrapVue,
    IconsPlugin
} from 'bootstrap-vue'
import Toasted from 'vue-toasted';
import store from "./store";
import i18n from "./locale";
import vuetify from "./vuetify";
import './validation/index.js';
import request from './apis/admin';
import {
    ValidationProvider,
    ValidationObserver
} from 'vee-validate';
import lodash from 'lodash'
window._ = lodash

let files;
files = require.context('./admin/', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

files = require.context('./share/', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('ValidationProvider', ValidationProvider);
Vue.component('ValidationObserver', ValidationObserver);
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
Vue.use(Toasted)

class App {

    constructor(config) {
        this.config = config
        this.$request = request;
    }

    boot() {
        let _this = this;
        this.vue = new Vue({
            data: {
                drawer: false
            },
            store,
            i18n,
            vuetify,
            el: '#app',
            mounted() {
                _this.$loading = this.$refs.loading;
            }
        });
    }

    success(msg) {
        Vue.toasted.show(msg, {
            type: 'success'
        });
    }

    error(msg) {
        Vue.toasted.show(msg, {
            type: 'error'
        });
    }
}

(function () {
    this.CreateApp = function (config) {
        return new App(config)
    }
}.call(window))
