export default {
    state() {
        return {

        };
    },
    getters: {
 
    },
    mutations: {
      
    },
    actions: {
        async storeTime({ dispatch }, payload) {
            try {
                await axios
                    .post("/api/time", payload)
                    .then((response) => {
             
                    })
                    .catch((err) => {
                        throw err.response;
                    });
            } catch (e) {
                throw e;
            }
        },

        async updateTime({ dispatch }, payload) {
            try {
                await axios
                    .put("/api/time/" + payload.id, payload)
                    .then((response) => {
             
                    })
                    .catch((err) => {
                        throw err.response;
                    });
            } catch (e) {
                throw e;
            }
        },
    },
};
