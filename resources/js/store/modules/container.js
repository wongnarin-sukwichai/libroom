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
        async storeContainer({ dispatch }, payload) {
            try {
                await axios
                    .post("/api/container", payload)
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
