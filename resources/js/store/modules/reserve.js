import axios from "axios";

export default {
    state() {
        return {
            reserve: [],
        };
    },
    getters: {
        reserve(state) {
            return state.reserve;
        },
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
