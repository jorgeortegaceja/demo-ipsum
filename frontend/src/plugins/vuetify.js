import Vue from 'vue';
import Vuetify from 'vuetify/lib/framework';
import es from 'vuetify/lib/locale/es';

Vue.use(Vuetify);

export default new Vuetify({
    theme: {
        options: {
            customProperties: true,
        },
        themes: {
            light: {
                primary: '#24b6e9',
                secondary: '#121818',
                accent: '#82B1FF',
                error: '#FF5252',
                info: '#81b6a1',
                success: '#8bc441',
                warning: '#FFC107'
            },
        },
    },
    lang: {
        locales: {
            es
        },
        current: 'es',
    },
});
