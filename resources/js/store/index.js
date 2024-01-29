import { createStore } from "vuex";
import user from './modules/user';
import holiday from './modules/holiday';

const store = createStore({
    modules:{
        user,
        holiday
    }
})

export default store