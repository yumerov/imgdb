import Vue from "vue";
import Vuex from "vuex";
Vue.use(Vuex);
import { images, tags } from "./api";

const Home = new Vuex.Store({
    state: {
        images: [],
        tags: [],
    },
    getters: {
        images: state => state.images,
        tags: state => state.tags
    },
    mutations: {
        SET_IMAGES (state, payload) { state.images = payload; },
        SET_TAGS (state, payload) { state.tags = payload; }
    },
    actions: {
        GET_IMAGES ({ commit }) {
            images.get().then((data) => commit("SET_IMAGES", data.data));
        },
        GET_TAGS ({ commit }) {
            tags.get().then((data) => commit("SET_TAGS", data.data));
        },

    }
})

export { Home };