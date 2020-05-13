import api from "../apis/admin";

import {
    ADMIN_DELETE,
    ADMIN_POST,
    ADMIN_PUT,
    ADMIN_SEARCH
} from './auctions.type';
const actions = {
    [ADMIN_POST](context, {
        model,
        credentials,
        headers
    }) {
        return api.request('post', `/create/${model}`, credentials, headers)
    },
    [ADMIN_PUT](context, {
        model,
        id,
        credentials,
    }) {
        return api.request('put', `/update/${model}/${id}`, credentials, {
            'Accept-Language': app.admin.locale
        })
    },
    [ADMIN_DELETE](context, {
        model,
        id
    }) {
        return api.delete(`/delete/${model}/${id}`, {
            'Accept-Language': app.admin.locale
        })
    },
    [ADMIN_SEARCH](context, {
        model,
        query
    }) {
        return api.get(`/search/${model}`, query)
    }
};
export default {
    actions,
};
