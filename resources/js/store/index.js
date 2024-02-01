import { createStore } from "vuex";
import user from './modules/user';
import holiday from './modules/holiday';
import time from "./modules/time";
import upload from "./modules/upload";
import container from "./modules/container";

const store = createStore({
    modules:{
        user,
        holiday,
        time,
        upload,
        container
    }
})

export default store