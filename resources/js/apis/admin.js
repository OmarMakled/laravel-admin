import axios from "axios";

const request = axios.create({
    baseURL: '/api/',
    headers: {
        'X-Requested-With': 'XMLHttpRequest'
    },
    timeout: 5000
})

request.interceptors.request.use(function (config) {
    App.$loading.start();
    return config;
}, function (error) {
    return Promise.reject(error);
});

request.interceptors.response.use(function (response) {
    App.$loading.finish();
    if (response.status == 201) {
        App.success('Success !');
    }
    return response;
}, function (error) {
    App.$loading.finish();
    if (error.response.status == 422) {
        App.error('Fix errors');
    }
    return Promise.reject(error);
});

export default {
    find(model, id = null, headers = {}) {
        return new Promise((resolve, reject) => {
            request.get(`${model}/${id}`, {
                headers
            }).then(response => {
                resolve(response.data)
            })
        })
    },
    get(model, params, headers = {}) {
        return new Promise((resolve, reject) => {
            request.get(`/search/${model}`, {
                params,
                headers
            }).then(response => {
                resolve(response.data)
            })
        })
    },
    delete(model, id) {
        return new Promise((resolve, reject) => {
            request.delete(`/delete/${model}/${id}`)
                .then(response => {
                    resolve(response)
                }).catch(error => {
                    reject(error)
                })
        })
    },
    post(model, data, headers = {}) {
        return new Promise((resolve, reject) => {
            request.post(`/create/${model}`, data, {
                    headers
                })
                .then(response => {
                    resolve(response)
                }).catch(error => {
                    reject(error)
                })
        })
    },
    put(model, id, data, headers = {}) {
        return new Promise((resolve, reject) => {
            request.put(`/update/${model}/${id}`, data, {
                    headers
                })
                .then(response => {
                    resolve(response)
                }).catch(error => {
                    reject(error)
                })
        })
    },
    signIn(data) {
        return new Promise((resolve, reject) => {
            request.post('/auth/signin', data)
                .then(response => {
                    resolve(response)
                })
                .catch(error => {
                    reject(error)
                })
        })
    },
    signOut() {
        request.post('/auth/signout')
            .then(() => {
                window.location = '/admin/auth'
            })
    }
}
