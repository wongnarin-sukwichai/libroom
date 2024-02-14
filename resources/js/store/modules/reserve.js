import axios from "axios";

export default {
    state() {
        return {
            reserve: ""
        };
    },
    getters: {
        reserve(state) {
            return state.reserve
        }
    },
    mutations: {
        setReserve(state, payload) {
            state.reserve = payload
        }
    },
    actions: {
        async storeReserve({ dispatch }, payload) {
            try {
               axios.post('/api/reserve', payload).then((response) => {
                    commit('setReserve', response.data)
               })
            } catch (e) {
                throw e;
            }
        },
    },
};
