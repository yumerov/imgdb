import Vue from "vue";
import Vuex from "vuex";
Vue.use(Vuex);
import { images, tags } from "./api";

let FormImage = {
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
            console.log(state.file);
            if (state.file instanceof File) {
                data.append("file", state.file);
            }

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

const Index = new Vuex.Store({
    state: {
        images: [],
        meta: {},
    },
    mutations: {
        set_images (state, payload) { state.images = payload; },
        set_meta (state, payload) { state.meta = payload; },
    },
    actions: {
        get ({ commit }, page = 1) {
            images.get(page).then((data) => {
                commit("set_images", data.data);
                commit("set_meta", data.meta);
            });
        },

    }
})

const Create = new Vuex.Store({
    modules: {
        image: FormImage,
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

const Show = new Vuex.Store({
    state: {
        image: {},
        links: {
            edit: "",
            destroy: "",
        }
    },
    actions: {
        show ({ state, }, slug) {
            return images.show(slug)
                .then((data) => {
                    const image = data.data;
                    state.image = image;
                    state.links = {
                        edit: "/images/" + image.slug + "/edit",
                        destroy: "/api/images/" + image.slug,
                    }

                })
                .catch((error) => {
                    if (error.response.status == 404) {
                        window.flash("Not found", "error");
                    }

                    setTimeout(function() {
                        window.location.hash = "#/images/";
                        window.location.reload();
                    }, 2000);
                });
        },
        destroy ({}, slug) {
            return images.destroy(slug)
                .then((response) => {
                    window.flash("The image is deleted.", "success");

                    setTimeout(function() {
                        window.location.hash = "#/images/";
                        window.location.reload();
                    }, 2000);
                })
                .catch((error) => {
                    if (error.response.status == 404) {
                        window.flash("Not found", "error");
                    }

                    setTimeout(function() {
                        window.location.hash = "#/images/";
                        window.location.reload();
                    }, 2000);
                });
        }

    }
})

const Edit = new Vuex.Store({
    modules: {
        image: FormImage,
    },
    state: {
        tags: [],
        preview: "",
    },
    actions: {
        load({ state }, slug) {
            tags.get()
                .then((data) => state.tags = data.data)
                .then(() => {
                    images.show(slug)
                        .then((response) => {
                            const image = response.data;
                            state.image = {
                                slug: image.slug,
                                title: image.title,
                                file: {},
                                tags: image.tags,
                            }
                            state.preview = image.file;
                        })
                        .catch((error) => {
                            if (error.response.status != 404) {
                                return;
                            }

                            window.flash("Not found", "error");
                            setTimeout(function() {
                                window.location.hash = "#/images/";
                                window.location.reload();
                            }, 2000);
                            return;

                        });
                });
        },
        save({ state, getters }) {
           return images.update(state.image.slug, getters["image/form"]);
        }
    }
})

export { Index, Create, Show, Edit };