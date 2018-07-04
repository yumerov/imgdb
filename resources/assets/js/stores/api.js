/**
 * @type {{get(*=, *=): *, post(*=, *=): *}}
 */
const actions = {
    /**
     * @param url
     * @param request
     * @returns {*|Promise<T>}
     */
    get(url, request) {
        return axios.get(url, request)
            .then((response) => Promise.resolve(response.data))
            .catch((error) => Promise.reject(error));
    },
    /**
     * @param url
     * @param request
     * @returns {Promise<any>}
     */
    post(url, request) {
        return axios.post(url, request)
            .then((response) => Promise.resolve(response))
            .catch((error) => Promise.reject(error));
    },
}

/**
 * @type {{paginate: (function(*=): *), create: (function(*=): (*|Promise<any>)), show: (function(*): *), update: (function(*, *=): (*|Promise<any>)), destroy: (function(*): (*|Promise<any>))}}
 */
const images = {
    /**
     * @param page
     * @returns {*}
     */
    paginate: (page = 1) => actions.get("/api/images", { params: { page } }),
    /**
     * @param data
     * @returns {*|Promise<any>}
     */
    create: (data) => actions.post("/api/images", data),
    /**
     * @param slug
     * @returns {*}
     */
    show: (slug) => actions.get("/api/images/" + slug),
    /**
     * @param slug
     * @param data
     * @returns {*|Promise<any>}
     */
    update: (slug, data) => {
        data.append("_method", "put");
        return actions.post("/api/images/" + slug, data);
    },
    /**
     * @param slug
     * @returns {*|Promise<any>}
     */
    destroy: (slug) => {
        let data = new FormData();
        data.append("_method", "delete");
        return actions.post("/api/images/" + slug, data);
    },
}

/**
 * @type {{get: (function(): *)}}
 */
const tags = {
    /**
     * @returns {*}
     */
    get: () => actions.get("/api/tags"),
}

export { images, tags, actions };