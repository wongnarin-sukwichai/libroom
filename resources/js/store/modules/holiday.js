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
        async storeHoliday({ dispatch }, payload) {
            try {
                await axios
                    .post("/api/holiday", payload)
                    .then((response) => {
             
                    })
                    .catch((err) => {
                        throw err.response;
                    });
            } catch (e) {
                throw e;
            }
        },

        async updateHoliday({ dispatch }, payload) {
            try {
                await axios
                    .put("/api/holiday/" + payload.id, payload)
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
