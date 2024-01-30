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

    },
};
