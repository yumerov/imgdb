const actions = {
    get(url, request) {
        return axios.get(url, request)
            .then((response) => Promise.resolve(response.data.data))
            .catch((error) => Promise.reject(error));
    },
    // post(url, request) {
    //     return Vue.http.post(url, request)
    //         .then((response) => Promise.resolve(response))
    //         .catch((error) => Promise.reject(error));
    // },
    // patch(url, request) {
    //     return Vue.http.patch(url, request)
    //         .then((response) => Promise.resolve(response))
    //         .catch((error) => Promise.reject(error));
    // },
    // delete(url, request) {
    //     return Vue.http.delete(url, request)
    //         .then((response) => Promise.resolve(response))
    //         .catch((error) => Promise.reject(error));
    // }
}

const images = {
    getNewest() {
        return actions.get("/api/images");
    }
}

const tags = {
    getAll() {
        return actions.get("/api/tags");
    }
}

export { images, tags, actions };