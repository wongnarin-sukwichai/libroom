import axios from "axios";

export default {

    state() {
        return {
            room: null,
        };
    },
    getters: {
        getRoomlist(state) {
            return state.room;
        }
    },
    mutations: {
        setRoom(state, payload) {
            state.room = payload
        }
    },
    actions: {
        async addReserve({ dispatch }, payload) {
            try {
                await axios
                    .post("/api/addReserve", payload)
                    .then((response) => {
                        return dispatch("getRoom", payload);
                    })
                    .catch((err) => {
                        throw err.response;
                    });
            } catch (e) {
                throw e;
            }
        },

        async getRoom({ commit }, payload) {
            var today = moment().format("YYYY-MM-DD");

            await axios
            .get("/api/reserveMain/" + today)
                .then((response) => {
                    console.log(response.data)
                    commit("setRoom", response.data); //commit คำสั่งเปลี่ยนแปลงข้อมูลใน mutation จากตัวอย่างหมายถึง mutaion function ชื่อ setUser (เลื่อนขึ้นไปดูข้างบน)
                })
                .catch((err) => {
                    throw err.response;
                });
        },
    },
};
