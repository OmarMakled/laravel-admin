import axios from "axios";
import store from "../store/index"
import {
    LOADING,
    ERROR,
    SUCCESS
} from '../store/mutations.type';
export default {
    init() {
        console.log(store);
        axios.defaults.baseURL = '/api/';
        axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
        // axios.defaults.headers.common['Accept-Language'] = window.app.locales.locale;
        axios.defaults.headers.common['X-CSRF-TOKEN'] = window.app.csrfToken;
    },
    request(method, url, data, headers = {}) {
        return new Promise((resolve, reject) => {
            let options = {
                method,
                url,
                data,
                headers
            }
            console.log(options)
            // App.$store.commit(LOADING, true);
            axios(options)
                .then(response => {
                    // App.$store.commit(LOADING, false);
                    // App.$store.commit(SUCCESS, true);
                    if (app.autoToast) {
                        // App.makeToast('Action has been done!', 'success');
                    }
                    resolve(response)
                }).catch(error => {
                    // App.$store.commit(LOADING, false);
                    // App.$store.commit(ERROR, error.response.data.errors);
                    if (app.autoToast) {
                        // App.makeToast('Something wrong happened!', 'danger');
                    }
                    reject(error)
                })
        })
    },
    delete(url, headers = {}) {
        return new Promise((resolve, reject) => {
            axios.delete(url, {
                    headers
                })
                .then(response => {
                    resolve(response)
                }).catch(error => {

                    reject(error)
                })
        })
    },
    fetch(url, params, headers = {}) {
        return new Promise((resolve, reject) => {
            axios.get(url, {
                    params,
                    headers
                })
                .then(response => {
                    resolve(response)
                }).catch(error => {
                    reject(error)
                })
        })
    }
}
