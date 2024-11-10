import Vuex from 'vuex';
import axios from "axios";
import router from "../router/router.js";

const state = {
    user: null,
    authenticated: false,
};



const getters = {
    user: state => state.user,
    authenticated: state => state.authenticated,
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
        const recaptchaResponse  = grecaptcha.getResponse();
        if (!recaptchaResponse) {
            error('Lütfen reCAPTCHA doğrulamasını tamamlayın.');
            return;
        }
        try {
            await axios.get('/sanctum/csrf-cookie');
            const res = await axios.post('/api/login', { ...authData,
                'g-recaptcha-response': recaptchaResponse ,
            });

            commit('setAuthenticate', true);
            commit('setUser', res.data.user);

            // Kullanıcı rolüne göre yönlendirme
            if (res.data.user_type === 'owner') {
                await router.push('/owner'); // Doğru yönlendirme path'i
            } else if (res.data.user_type === 'worker') {
                await router.push('/auto'); // Doğru yönlendirme path'i
            }
        } catch (err) {
            console.error('Login error:', err);
            toast.commit('setAuthError', err.response?.data?.message || 'Login failed');
        }
    },
    async logout({ commit }) {
        try {
            await axios.get('/api/logout');
            commit('setUser', null);
            commit('setAuthenticate', false);
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

};

const store = new Vuex.Store({
    state,
    getters,
    actions,
    mutations
});

export default store;
