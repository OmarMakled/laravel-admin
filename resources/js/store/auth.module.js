import api from '../apis';
import {
    SIGNIN,
    SIGNUP,
    SIGNOUT,
    PROFILE
} from './auctions.type';
const actions = {
    [SIGNIN](context, credentials) {
        return api.request('post', '/auth/signin', credentials)
    },
    [SIGNUP](context, credentials) {
        return api.request('post', '/auth/signup', credentials)
    },
    [SIGNOUT](context, credentials) {
        return api.request('post', '/auth/signout', credentials)
    },
    [PROFILE](context, credentials) {
        return api.request('patch', '/auth/profile', credentials)
    }
};
export default {
    actions,
};
