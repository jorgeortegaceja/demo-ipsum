export default {

    getters: {
        user: (state) => ({
            name: state.name,
            email: state.email,
            user_id: state.user_id
        })
    },
    state: {
        name: null,
        email: null,
        user_id: null,
    },
    mutations: {
        setUser(state, data) {
            state.user_id = data.user_id;
            state.name = data.user_name;
            state.email = data.email;
        },
    },
    actions: {
        setUser(context, data) {
            context.commit('setUser', data);
        }
    }
}
