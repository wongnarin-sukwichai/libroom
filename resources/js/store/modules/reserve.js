import axios from "axios";

export default {
    state() {
        return {
            reserve: "",
        };
    },
    getters: {

    },
    mutations: {
        setReserve(state, payload) {
            state.reserve = payload;
        },
    },
    actions: {
        async storeReserve({ dispatch }, payload) {
            try {
            } catch (e) {
                throw e;
            }
        },

    },
};
