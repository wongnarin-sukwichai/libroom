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

    },
};
