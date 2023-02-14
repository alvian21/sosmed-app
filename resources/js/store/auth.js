import axios from "axios";
import router from '../router';
import createPersistedState from "vuex-persistedstate";

export default {
    namespaced: true,

    state: {
        userData: null
    },

    getters: {
        user: state => state.userData
    },

    mutations: {
        setUserData(state, user) {
            state.userData = user;
        }
    },

    actions: {
        getUserData({ commit }) {
          return axios
                .post("/api/user")
                .then(response => {

                    localStorage.setItem("user",response.data.data.user)
                    commit("setUserData", response.data.data.user);

                    return response;
                })
                .catch(() => {
                    localStorage.removeItem("authToken");
                    window.location.reload();
                });
        },
        sendLoginRequest({ commit }, data) {
            commit("setErrors", {}, { root: true });
            return axios
                .post("/api/login", data)
                .then(response => {

                    commit("setUserData", response.data.data.user);
                    localStorage.setItem("authToken", response.data.data.token);
                });
        },
        sendRegisterRequest({ commit }, data) {
            commit("setErrors", {}, { root: true });
            return axios
                .post("/api/register", data)
                .then(response => {
                    commit("setUserData", response.data.data.user);
                    localStorage.setItem("authToken", response.data.data.token);

                });
        },
        sendLogoutRequest({ commit }) {

            axios.post("/api/logout").then(() => {
                commit("setUserData", null);
                localStorage.removeItem("authToken");
                router.push({
                    name: "login"
                });
            });
        },
    },

    plugins: [createPersistedState()]
};
