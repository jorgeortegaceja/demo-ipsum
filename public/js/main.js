const app = new Vue({
    el: '#app',
    vuetify: new Vuetify({

    }),

    created() {
        this.user.email = document.getElementById('email').value;
        this.user.name = document.getElementById('name').value;
        this.acl = JSON.parse(document.getElementById('acl').value);
        this.settings = JSON.parse(document.getElementById('settings').value);
        this.navigation = JSON.parse(document.getElementById('navigate').value);
    },
    data() {
        return {
            user: {
                email: '',
                name: ''
            },
            acl: {},
            settings: {},
            navigation: {}
        }
    },
    components: {
        MyNavigationDrawer: navigation_drawer,
        MyMenu: menu,
        home: home,
        risks: risk
    },
});
