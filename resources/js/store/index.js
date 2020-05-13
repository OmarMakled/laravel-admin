import Vue from "vue";
import Vuex from "vuex";
import auth from "./auth.module";
import user from "./user.module";
import admin from "./admin.module";

import {
    LOADING,
    ERROR,
    SUCCESS,
    CHANGE_URL
} from './mutations.type';

Vue.use(Vuex);
const state = {
    loading: false,
    error: [],
    success: false,
    url: Object.fromEntries(new URLSearchParams(location.search))
};
const mutations = {
    [LOADING](state, status) {
        state.loading = status;
    },
    [ERROR](state, error) {
        state.error = error
    },
    [SUCCESS](state, status) {
        state.success = status
    },
    [CHANGE_URL](state, {
        q,
        value
    }) {
        state.url = {
            ...state.url,
            [q]: value
        }
        // window.location.search = new URLSearchParams(state.url).toString();
    }
}

export default new Vuex.Store({
    state,
    mutations,
    modules: {
        auth,
        user,
        admin
    }
});
