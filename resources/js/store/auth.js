import axios from "axios";
import router from '../router';

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
      axios
        .get("/api/user")
        .then(response => {
          commit("setUserData", response.data.data.user);
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
            if(response.data.success){
                commit("setUserData", response.data.data.user);
                localStorage.setItem("authToken", response.data.data.token);
            }else{
               return false;
            }

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
  }
};
