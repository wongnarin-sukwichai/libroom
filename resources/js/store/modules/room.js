import axios from "axios";

export default {
    state() {
        return {};
    },
    getters: {},
    mutations: {},
    actions: {
        async storeRoom({ dispatch }, payload) {
            try {
                await axios
                    .post("/api/room", payload)
                    .then((response) => {})
                    .catch((err) => {
                        throw err.response;
                    });
            } catch (e) {
                throw e;
            }
        },

        async updateRoom({ dispatch }, payload) {
            try {
                await axios
                    .put("/api/room/" + payload.id, payload)
                    .then((response) => {});
            } catch (e) {
                throw e;
            }
        },
    },
};
