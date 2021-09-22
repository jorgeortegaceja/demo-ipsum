export default {

    getters: {
        navigator: (state) => ({
            ...state
        })
    },
    state: {
        component: {},
        drawer: true
    },
    mutations: {
        setNavigate(state, data) {
            state.component = data.component;
            state.drawer = data.drawer;
        },
        updateDrawer(state) {
            state.drawer = !state.drawer;
        },
        updateComponent(state, data) {
            state.component = data
        },
    },
    actions: {
        setNavigate(context, data) {
            context.commit('setNavigate', data);
        },
        updateDrawer(context) {
            context.commit('updateDrawer');
        },
        updateComponent(context, data) {
            context.commit('updateComponent', data);
        },
    }
}
