export default {

    getters: {
        session() {
            return state.session
        },
        token() {
            return state.token
        }
    },
    state: {
        session: false,
        token: null,
        expires_at: null
    },
    mutations: {
        authenticate(state, data) {
            state.session = true;
            state.token = data.token;
            state.expires_at = data.expires_at;
        },
    },
    actions: {
        authenticate(context, data) {
            context.commit('authenticate', data);
        }
    }
}
