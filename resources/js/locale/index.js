const LANG = document.documentElement.lang.substr(0, 2);
import Vue from "vue";
import VueInternationalization from 'vue-i18n';
import {
    localize
} from "vee-validate"
import trans from "./trans";
Vue.use(VueInternationalization);
localize({
    [LANG]: {
        messages: require(`vee-validate/dist/locale/${LANG}.json`).messages,
        names: trans[LANG].validation.attributes
    }
});
localize(LANG);
export default new VueInternationalization({
    locale: LANG,
    messages: trans
});
