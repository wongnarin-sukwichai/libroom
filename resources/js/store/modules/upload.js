export default {

    state() {
        return {
            pic: null
        }
    },
    getters: {
        picName(state) {
            return state.pic
        }
    },
    mutations: {
        setPicName(state, payload) {
            state.pic = payload;
        },
    },
    actions: {

        async uploadPicContainer({ dispatch }, payload) { 
            const config = {                                    //ใส่ทุกครั้งที่รับ File เข้ามา
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }

            try {
                await axios.get('/sanctum/csrf-cookie'); 
                await axios
                    .post('/api/uploadPicContainer', payload, config) 
                    .then((response) => {        
                        return dispatch('getPicName', response.data)   
                    })
                    .catch((err) => {
                        //console.log("ERROR::",error.res.headers)
                        throw err.response
                    });
  
            } catch (err) {
                throw err
            }
        },

        async getPicName({ commit }, data) {
            commit('setPicName', data)
        }
    },
};
