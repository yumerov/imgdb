import Vue from "vue";
import Vuex from "vuex";
Vue.use(Vuex);
import { images, tags } from "./api";

/**
 * @type {Store}
 */
const Home = new Vuex.Store({
    state: {
        images: [],
        tags: [],
    },
    getters: {
        /**
         * @param state
         * @returns {Array}
         */
        images: state => state.images,
        /**
         * @param state
         * @returns {Array}
         */
        tags: state => state.tags
    },
    mutations: {
        /**
         * @param state
         * @param payload
         * @constructor
         */
        SET_IMAGES (state, payload) { state.images = payload; },
        /**
         * @param state
         * @param payload
         * @constructor
         */
        SET_TAGS (state, payload) { state.tags = payload; }
    },
    actions: {
        /**
         * @param commit
         */
        GET_IMAGES ({ commit }) {
            images.paginate().then((data) => commit("SET_IMAGES", data.data));
        },
        /**
         * @param commit
         */
        get_tags ({ commit }) {
            tags.get().then((data) => commit("SET_TAGS", data.data));
        },

    }
})

export { Home };