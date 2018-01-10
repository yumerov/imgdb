import Vue from "vue";
import Vuex from "vuex";
Vue.use(Vuex);
import { images, tags } from "./api";

const Index = new Vuex.Store({
    state: {
        images: [],
        meta: {},
    },
    getters: {
        images: state => state.images,
        tags: state => state.tags,
    },
    mutations: {
        SET_IMAGES (state, payload) { state.images = payload; },
        SET_META (state, payload) { state.meta = payload; },
    },
    actions: {
        GET ({ commit }, page = 1) {
            images.get(page).then((data) => {
                commit("SET_IMAGES", data.data);
                commit("SET_META", data.meta);
            });
        },

    }
})

let Image = {
    namespaced: true,
    state: {
        title: "",
        file: {},
        tags: [],
    },
    getters: {
        form: state => {
            let data = new FormData();
            data.append("title", state.title);
            state.tags.forEach((tag) => { data.append("tags[]", tag.id); });
            data.append("file", state.file);

            return data;
        },
    },
    mutations: {
        reset (state) {
            state.title = "";
            state.file = {};
            state.tags = [];
        }
    },
};

const Create = new Vuex.Store({
    modules: {
        image: Image,
    },
    state: {
        tags: [],
        lastCreated: "",
        preview: "",
    },
    actions: {
        get_tags ({ commit, state }) {
            tags.get().then((data) => state.tags = data.data);
        },
        reset ({ state, commit }) {
            state.preview = "";
            commit("image/reset");
        },
        save ({ commit }, data) {
            return images.create(data);
        }
    }
})

export { Index, Create };