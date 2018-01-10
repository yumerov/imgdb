import Vue from "vue";
import Vuex from "vuex";
Vue.use(Vuex);
const api = require("./actions").default;

export default new Vuex.Store({
    state: {
        images: []
    },
    getters: {
        images: state => state.images
    },
    mutations: {
        SET_IMAGES (state, payload) {
            state.images = payload;
        }
    },
    actions: {
        GET ({ commit }) {
            api.get("/api/images").then((data) => commit("SET_IMAGES", data));
        }

    }
})