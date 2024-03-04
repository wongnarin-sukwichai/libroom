import { createStore } from "vuex";
import createPersistedState from 'vuex-persistedstate'
import user from './modules/user';
import holiday from './modules/holiday';
import time from "./modules/time";
import upload from "./modules/upload";
import container from "./modules/container";
import room from "./modules/room";
import reserve from "./modules/reserve";
import record from "./modules/record";
import main from "./modules/main";

const store = createStore({
    plugins:[
        createPersistedState()
    ],
    modules:{
        user,
        holiday,
        time,
        upload,
        container,
        room,
        reserve,
        record,
        main
    }
})

export default store