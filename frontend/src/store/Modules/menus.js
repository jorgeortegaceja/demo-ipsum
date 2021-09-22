export default {

    getters: {
        menu: (state) => state.menu,
        navigation_drawer: (state) => state.navigation_drawer
    },
    state: {
        menu: {},
        navigation_drawer: {}
    },
    mutations: {
        setAcl(state, data) {
            state.menu = data.menu;
            state.navigation_drawer = data.navigation_drawer;
        },
    },
    actions: {
        setAcl(context, data) {
            context.commit('setAcl', data);
        }
    }
}
