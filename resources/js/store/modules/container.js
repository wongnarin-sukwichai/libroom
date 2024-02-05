import axios from "axios";

export default {
    state() {
        return {};
    },
    getters: {},
    mutations: {},
    actions: {
        async storeContainer({ dispatch }, payload) {
            try {
                await axios
                    .post("/api/container", payload)
                    .then((response) => {})
                    .catch((err) => {
                        throw err.response;
                    });
            } catch (e) {
                throw e;
            }
        },

        async updateContainer({ dispatch }, payload) {
            try {
                await axios
                    .put("/api/container/" + payload.id, payload)
                    .then((response) => {});
            } catch (e) {
                throw e;
            }
        },
    },
};
