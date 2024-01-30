import { createStore } from "vuex";
import user from './modules/user';
import holiday from './modules/holiday';
import time from "./modules/time";

const store = createStore({
    modules:{
        user,
        holiday,
        time
    }
})

export default store