import Vuex from 'vuex';
import axios from "axios";
import router from "../router/router.js";

const state = {
    user: null,
    authenticated: false,
    authError: null, // Hataları saklamak için ek bir state
};

const getters = {
    user: state => state.user,
    authenticated: state => state.authenticated,
    authError: state => state.authError, // Getter for error
};

const actions = {
    async authenticate({ commit, state }) {
        if (!state.user) {
            try {
                const res = await axios.get('/api/user');
                commit('setAuthenticate', true);
                commit('setUser', res.data);
            } catch (err) {
                console.error('Authentication error:', err);
                commit('setAuthenticate', false);
                commit('setUser', null);
                commit('setAuthError', err.response?.data?.message || 'Authentication failed');
            }
        }
    },
    async login({ commit }, authData) {
        try {
            await axios.get('/sanctum/csrf-cookie');
            const res = await axios.post('/api/login', { ...authData });

            commit('setAuthenticate', true);
            commit('setUser', res.data.user);
            commit('setAuthError', null); // Başarılı girişte hatayı sıfırla

            // Kullanıcı rolüne göre yönlendirme
            if (res.data.user_type === 'owner') {
                await router.push('/owner'); // Doğru yönlendirme path'i
            } else if (res.data.user_type === 'worker') {
                await router.push('/auto'); // Doğru yönlendirme path'i
            }
        } catch (err) {
            console.error('Login error:', err);
            commit('setAuthError', err.response?.data?.message || 'Login failed');
        }
    },
    async logout({ commit }) {
        try {
            await axios.get('/api/logout');
            commit('setUser', null);
            commit('setAuthenticate', false);
            commit('setAuthError', null); // Logout'ta hatayı sıfırla
            await router.push('/login');
        } catch (err) {
            console.error('Logout error:', err);
            commit('setAuthError', err.response?.data?.message || 'Logout failed');
        }
    }
};

const mutations = {
    setAuthenticate(state, value) {
        state.authenticated = value;
    },
    setUser(state, value) {
        state.user = value;
    },
    setAuthError(state, error) {
        state.authError = error; // Hataları sakla
    }
};

const store = new Vuex.Store({
    state,
    getters,
    actions,
    mutations
});

export default store;
