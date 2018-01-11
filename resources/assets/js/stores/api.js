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
}

const images = {
    paginate: (page = 1) => actions.get("/api/images", { params: { page } }),
    create: (data) => actions.post("/api/images", data),
    show: (slug) => actions.get("/api/images/" + slug),
    update: (slug, data) => {
        data.append("_method", "put");
        return actions.post("/api/images/" + slug, data);
    },
    destroy: (slug) => {
        let data = new FormData();
        data.append("_method", "delete");
        return actions.post("/api/images/" + slug, data);
    },
}

const tags = {
    get: () => actions.get("/api/tags"),
}

export { images, tags, actions };