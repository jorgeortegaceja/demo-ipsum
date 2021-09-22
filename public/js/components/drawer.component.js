const navigation_drawer = Vue.component('MyNavigationDrawer', {

    props: ['navigation', 'acl'],
    template: `
    <v-navigation-drawer stateless="stateless" floating="floating" width="220" enable-resize-watcher app dark  v-model="navigation.drawer" absolute>
            <v-list-item>
                <v-list-item-avatar>
                    <v-img src="https://randomuser.me/api/portraits/men/78.jpg"></v-img>
                </v-list-item-avatar>
                <v-list-item-content>
                    <v-list-item-title>John Leider</v-list-item-title>
                </v-list-item-content>
            </v-list-item>

            <v-divider></v-divider>

            <v-list dense>
                <v-list-item v-for="item in acl.navigation_drawer" :key="item.title" link @click="changeComponent(item)">
                    <v-list-item-icon>
                        <v-icon>{{ item.icon }}</v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                        <v-list-item-title>{{ item.title }}</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list>
        </v-navigation-drawer>
    `,
    data() {
        return {
            clipped: false
        }
    },
    methods: {
        changeComponent(newValue) {
            Object.assign(this.navigation.component, newValue);
            this.updateNavigation(newValue);
        },
        async updateNavigation(newValue) {
            try {
                let response = axios.post('/auth/update/navigation', {
                    component: newValue
                });
            } catch (error) {

            }
        }
    }
});
