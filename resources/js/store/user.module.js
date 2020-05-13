import api from '../apis';
import {
    CREATE_USER,
    UPDATE_USER
} from './auctions.type';
const actions = {
    [CREATE_USER](context, credentials) {
        return api.request('post', '/users', credentials)
    },
    [UPDATE_USER](context, {
        id,
        credentials
    }) {
        return api.request('put', `/users/${id}`, credentials)
    }
};
export default {
    actions,
};
