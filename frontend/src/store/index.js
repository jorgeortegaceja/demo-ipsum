import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from "vuex-persistedstate";



import session from './Modules/session'
import user from './Modules/user'
import menus from './Modules/menus'
import navigate from './Modules/navigate'
import settings from './Modules/settings'

Vue.use(Vuex);

export default new Vuex.Store({
    state: {},
    mutations: {},
    actions: {},
    modules: {
        session,
        user,
        menus,
        navigate,
        settings
    },
    plugins: [createPersistedState()],
})
