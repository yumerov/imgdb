const actions = {
    get(url, request) {
        return axios.get(url, request)
            .then((response) => Promise.resolve(response.data))
            .catch((error) => Promise.reject(error));
    },
    post(url, request) {
        return axios.post(url, request)
            .then((response) => Promise.resolve(response))
            .catch((error) => Promise.reject(error));
    },
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
    get: (page = 1) => actions.get("/api/images", { params: { page } }),
    create: (data) => actions.post("/api/images", data),
}

const tags = {
    get: () => actions.get("/api/tags"),
}

export { images, tags, actions };